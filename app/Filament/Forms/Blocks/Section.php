<?php

namespace App\Filament\Forms\Blocks;

use App\Filament\Forms\BlockManager;
use App\Filament\Forms\BlockSchema;
use App\Filament\Forms\Components\CobblerCuratorPicker;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\ToggleButtons;

class Section extends Block
{
    protected string|\Closure|null $preview = 'components.blocks.section';

    protected function setUp(): void
    {
        $this->schema([
            BlockSchema::make(
                common: BlockManager::getCommonBlockSettings(),
                content: [
                    RichEditor::make('text'),
                ],
                media: [
                    Grid::make()->schema([
                        CobblerCuratorPicker::make('image'),
                        CobblerCuratorPicker::make('background_image'),
                    ]),
                ],
                actions: BlockManager::getActionsSettings(),
                variants: [
                    Grid::make(3)->schema([
                        ToggleButtons::make('image_position')
                            ->options([
                                'start' => 'Start',
                                'end' => 'End',
                            ])
                            ->grouped()
                            ->default('start'),
                        ToggleButtons::make('image_alignment')
                            ->options([
                                'top' => 'Top',
                                'middle' => 'Middle',
                                'bottom' => 'Bottom',
                            ])
                            ->grouped()
                            ->default('top'),
                        ToggleButtons::make('image_flush')
                            ->options([
                                false => 'No',
                                true => 'Yes',
                            ])
                            ->grouped()
                            ->default(false),
                        ToggleButtons::make('image_rounded')
                            ->options([
                                false => 'No',
                                true => 'Yes',
                            ])
                            ->grouped()
                            ->default(false),
                        ToggleButtons::make('image_shadow')
                            ->options([
                                false => 'No',
                                true => 'Yes',
                            ])
                            ->grouped()
                            ->default(false),
                    ]),
                ]
            ),
        ]);
    }
}
