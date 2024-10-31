<?php

namespace App\Filament\Forms\Blocks;

use App\Filament\Forms\BlockManager;
use App\Filament\Forms\BlockSchema;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\ToggleButtons;

class SectionWithSidebar extends Block
{
    protected string|\Closure|null $preview = 'components.blocks.section-with-sidebar';

    protected function setUp(): void
    {
        $this->schema([
            BlockSchema::make(
                common: [
                    ...BlockManager::getCommonBlockSettings(),
                    Select::make('sidebar')
                        ->label('Sidebar')
                        ->default('default')
                        ->options([
                            'default' => 'Default',
                        ]),
                    ToggleButtons::make('is_hero')
                        ->options([
                            'no' => 'No',
                            'yes' => 'Yes',
                        ])
                        ->grouped()
                        ->default('no'),
                ],
                content: [
                    RichEditor::make('text'),
                ],
                variants: [
                    ToggleButtons::make('alignment')
                        ->options([
                            'top' => 'Top',
                            'middle' => 'Middle',
                            'bottom' => 'Bottom',
                        ])
                        ->grouped()
                        ->default('top'),
                ]
            ),
        ]);
    }
}
