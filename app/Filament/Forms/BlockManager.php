<?php

namespace App\Filament\Forms;

use App\Filament\Forms\Blocks\RecentBlogPosts;
use App\Filament\Forms\Blocks\Section;
use App\Filament\Forms\Blocks\SectionWithSidebar;
use Awcodes\Palette\Forms\Components\ColorPickerSelect;
use Awcodes\TableRepeater\Components\TableRepeater;
use Awcodes\TableRepeater\Header;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Support\Facades\FilamentColor;
use Illuminate\Support\Arr;

class BlockManager
{
    public static function getBlocks(): array
    {
        return [
            Section::make('section'),
            SectionWithSidebar::make('section_with_sidebar'),
            RecentBlogPosts::make('recent_blog_posts'),
        ];
    }

    public static function getCommonBlockSettings(): array
    {
        return [
            Grid::make()->schema([
                ColorPickerSelect::make('background_color')
                    ->label('Background Color')
                    ->colors(static::getColors())
                    ->withWhite()
                    ->shades(static::getShades())
                    ->extraInputAttributes(['class' => 'branded']),
                ToggleButtons::make('is_full_width')
                    ->options([
                        true => 'Full Width',
                        false => 'Contained',
                    ])
                    ->grouped()
                    ->default(false),
            ]),
        ];
    }

    public static function getActionsSettings(): array
    {
        return [
            ToggleButtons::make('actions_alignment')
                ->options([
                    'start' => 'Start',
                    'center' => 'Center',
                    'end' => 'End',
                ])
                ->grouped()
                ->default('start'),
            TableRepeater::make('actions')
                ->defaultItems(0)
                ->streamlined()
                ->addActionLabel('Add Action')
                ->emptyLabel('No actions')
                ->headers([
                    Header::make('label')->width('150px'),
                    Header::make('url')->width('auto'),
                    Header::make('color')->align('center'),
                    Header::make('outlined')->width('24px')->align('center'),
                    Header::make('external')->width('24px')->align('center'),
                ])
                ->schema([
                    TextInput::make('label')
                        ->label('Label')
                        ->required(),
                    TextInput::make('url')
                        ->label('URL')
                        ->required(),
                    ColorPickerSelect::make('color')
                        ->label('Color')
                        ->extraAttributes(['class' => 'mx-auto'])
                        ->colors(Arr::only(static::getColors(), ['dominant', 'secondary', 'tertiary', 'accent', 'neutral']))
                        ->default('dominant')
                        ->required()
                        ->extraInputAttributes(['class' => 'branded']),
                    Checkbox::make('outlined')
                        ->label('Outlined')
                        ->extraInputAttributes(['class' => 'mx-auto'])
                        ->default(false),
                    Checkbox::make('external')
                        ->label('External')
                        ->extraInputAttributes(['class' => 'mx-auto'])
                        ->default(true),
                ]),
        ];
    }

    public static function getColors(): array
    {
        $registeredColors = FilamentColor::getColors();

        return [
            'dominant' => $registeredColors['dominant'],
            'secondary' => $registeredColors['secondary'],
            'tertiary' => $registeredColors['tertiary'],
            'accent' => $registeredColors['accent'],
            'neutral' => $registeredColors['neutral'],
        ];
    }

    public static function getShades(): array
    {
        return [
            'neutral' => 300,
        ];
    }
}
