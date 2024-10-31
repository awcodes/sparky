<?php

namespace App\Filament\Forms;

use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;

class BlockSchema
{
    public static function make(
        array $common = [],
        array $content = [],
        array $media = [],
        array $actions = [],
        array $variants = [],
    ) {
        $tabs = collect([
            'Common' => $common,
            'Content' => $content,
            'Media' => $media,
            'Actions' => $actions,
            'Variants' => $variants,
        ])
            ->filter(fn ($item) => filled($item))
            ->map(function ($item, $name) {
                return Tab::make($name)->schema($item);
            });

        return Tabs::make()
            ->tabs($tabs->toArray());
    }
}
