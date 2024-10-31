<?php

namespace App\Filament\Forms\Blocks;

use App\Filament\Forms\BlockManager;
use App\Filament\Forms\BlockSchema;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;

class RecentBlogPosts extends Block
{
    protected string|\Closure|null $preview = 'components.blocks.recent-blog-posts';

    protected function setUp(): void
    {
        $this->schema([
            BlockSchema::make(
                common: BlockManager::getCommonBlockSettings(),
                content: [
                    RichEditor::make('text')
                        ->columnSpanFull(),
                    TextInput::make('count')
                        ->label('Number of Posts')
                        ->numeric()
                        ->step(1)
                        ->minValue(1)
                        ->maxValue(9)
                        ->default(3)
                        ->required(),
                ],
                actions: BlockManager::getActionsSettings(),
            ),
        ]);
    }
}
