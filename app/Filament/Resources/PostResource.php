<?php

namespace App\Filament\Resources;

use App\Enums\Status;
use App\Filament\Actions\Forms\NowAction;
use App\Filament\Actions\Tables\PreviewAction;
use App\Filament\Forms\Components\Meta;
use App\Filament\Forms\Components\SidebarLayout;
use App\Filament\Forms\Components\Slugger;
use App\Filament\Forms\Components\Timestamps;
use App\Filament\Tables\Columns\IndexedColumn;
use App\Filament\Tables\Columns\ScheduledBadge;
use App\Filament\Tables\Columns\StatusBadge;
use App\Filament\Tables\Columns\TrashedBadge;
use App\Models\Post;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Awcodes\FilamentBadgeableColumn\Components\BadgeableColumn;
use Filament\Forms;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Resources\Resource;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $label = 'Post';

    protected static ?string $navigationGroup = 'Site';

    protected static ?string $navigationLabel = 'Blog';

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?int $navigationSort = 3;

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?string $recordRouteKeyName = 'id';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            Slugger::make(fieldTitle: 'title', fieldSlug: 'slug', urlPath: '/posts/')
                ->columnSpanFull(),
            SidebarLayout::make()
                ->mainSchema([
                    Forms\Components\Tabs::make()
                        ->tabs([
                            Tab::make('Content')
                                ->schema([
                                    Forms\Components\MarkdownEditor::make('content')
                                        ->columnSpanFull(),
                                ]),
                            Tab::make('SEO')
                                ->schema([
                                    Meta::make(),
                                ]),
                        ]),
                ])
                ->sidebarSchema([
                    Forms\Components\Section::make('Details')
                        ->collapsible()
                        ->columns(['md' => 2])
                        ->schema([
                            Forms\Components\Select::make('status')
                                ->default(Status::Draft)
                                ->options(Status::class)
                                ->required()
                                ->columnSpanFull(),
                            Forms\Components\DateTimePicker::make('published_at')
                                ->seconds(false)
                                ->columnSpanFull()
                                ->hintAction(NowAction::make('now_published_at')->icon(false)),
                            CuratorPicker::make('featured_image_id')
                                ->columnSpanFull(),
                            Timestamps::make(),
                        ]),

                ]),
        ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                BadgeableColumn::make('title')
                    ->asPills(false)
                    ->suffixBadges([
                        TrashedBadge::make('trashed'),
                        StatusBadge::make('status'),
                        ScheduledBadge::make('scheduled'),
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
            ])
            ->defaultSort('published_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => PostResource\Pages\ListPosts::route('/'),
            'create' => PostResource\Pages\CreatePost::route('/create'),
            'edit' => PostResource\Pages\EditPost::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
