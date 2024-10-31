<?php

namespace App\Filament\Resources;

use App\Enums\PageLayout;
use App\Enums\Status;
use App\Filament\Actions\Forms\NowAction;
use App\Filament\Actions\Tables\PreviewAction;
use App\Filament\Forms\BlockManager;
use App\Filament\Forms\Components\Meta;
use App\Filament\Forms\Components\Slugger;
use App\Filament\Forms\Components\Timestamps;
use App\Filament\Tables\Columns\IndexedColumn;
use App\Filament\Tables\Columns\ScheduledBadge;
use App\Filament\Tables\Columns\StatusBadge;
use App\Models\Page;
use Awcodes\FilamentBadgeableColumn\Components\Badge;
use Awcodes\FilamentBadgeableColumn\Components\BadgeableColumn;
use Exception;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Filament\Tables;
use Filament\Tables\Filters\BaseFilter;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static ?string $label = 'Page';

    protected static ?string $navigationGroup = 'Site';

    protected static ?string $navigationIcon = 'heroicon-o-document';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Slugger::make(
                fieldTitle: 'title',
                fieldSlug: 'slug',
                urlPath: function (Forms\Get $get) {
                    return $get('parent') ? '/' . $get('parent') . '/' : '/';
                },
                slugRules: []
            )->columnSpanFull(),
            Forms\Components\Section::make('Details')
                ->collapsible()
                ->columnSpan(1)
                ->columns()
                ->collapsed(fn ($operation) => $operation === 'edit')
                ->schema([
                    Forms\Components\Select::make('status')
                        ->hidden(fn (Forms\Get $get): bool => $get('front_page'))
                        ->default(Status::Draft)
                        ->options(Status::class)
                        ->required(),
                    Forms\Components\DatePicker::make('published_at')
                        ->hidden(fn (Forms\Get $get): bool => $get('front_page'))
                        ->seconds(false)
                        ->suffixAction(NowAction::make('published_at')),
                    Forms\Components\Select::make('layout')
                        ->hidden(fn (Forms\Get $get): bool => $get('front_page'))
                        ->default(PageLayout::Default)
                        ->live()
                        ->options(PageLayout::class),
                    Forms\Components\Select::make('parent')
                        ->hidden(fn (Forms\Get $get): bool => $get('front_page'))
                        ->label('Parent page')
                        ->live()
                        ->searchable()
                        ->options(fn (): Collection => Page::all()->pluck('title', 'slug')),
                    Forms\Components\Toggle::make('front_page')
                        ->disabled(fn (?Page $record): bool => $record ? $record->front_page : false)
                        ->inline(false)
                        ->onColor('success')
                        ->columnSpanFull()
                        ->live(),
                    Timestamps::make(),
                ]),
            Forms\Components\Section::make('SEO')
                ->collapsible()
                ->columnSpan(1)
                ->collapsed(fn ($operation) => $operation === 'edit')
                ->schema([
                    Meta::make(),
                ]),
            Forms\Components\Builder::make('content')
                ->hidden(fn (Forms\Get $get): bool => $get('layout') == PageLayout::Static->value)
                ->collapsible()
                ->addActionLabel('Add Section')
                ->addBetweenActionLabel('Add Between Sections')
                ->blockPreviews()
                ->blocks(BlockManager::getBlocks())
                ->addAction(fn ($action) => $action->slideOver())
                ->addBetweenAction(fn ($action) => $action->slideOver())
                ->editAction(fn ($action) => $action->slideOver())
                ->columnSpanFull(),
        ]);
    }

    /**
     * @throws Exception
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                BadgeableColumn::make('title')
                    ->asPills(false)
                    ->limit(50)
                    ->description(function (Page $record, Table $table): ?Htmlable {
                        if ($record->parent) {
                            return new HtmlString('<span>Parent: ' . Str::of($record->parent)->replace('-', ' ')->title() . '</span>');
                        }

                        return null;
                    })
                    ->suffixBadges([
                        Badge::make('front_page')
                            ->color('primary')
                            ->visible(fn (Page $record): bool => $record->front_page),
                        Badge::make('trashed')
                            ->color('danger')
                            ->visible(fn (Page $record): bool => $record->deleted_at ?? false),
                        StatusBadge::make('status'),
                        ScheduledBadge::make('scheduled'),
                        Badge::make('custom')
                            ->color(Color::Yellow)
                            ->visible(fn (Page $record): bool => $record->layout === PageLayout::Static ?? false),
                    ])
                    ->searchable()
                    ->sortable(),
                IndexedColumn::make('seo.robots'),
                Tables\Columns\TextColumn::make('published_at')
                    ->label('Published')
                    ->date()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options(Status::class),
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                PreviewAction::make()->label('View'),
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                    Tables\Actions\RestoreAction::make(),
                    Tables\Actions\ForceDeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\RestoreBulkAction::make(),
                Tables\Actions\ForceDeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => PageResource\Pages\ListPages::route('/'),
            'create' => PageResource\Pages\CreatePage::route('/create'),
            'edit' => PageResource\Pages\EditPage::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function shouldShowParent(Table $table): bool
    {
        $isSearching = $table->hasSearch();
        $isSorting = $table->getSortColumn();
        $hasActiveFilters = collect($table->getFilters())
            ->filter(fn (BaseFilter $filter) => $filter->getIndicators())
            ->isNotEmpty();

        return $isSearching || $isSorting || $hasActiveFilters;
    }
}
