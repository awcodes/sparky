<?php

namespace App\Filament\Forms\Components;

use Awcodes\Curator\Components\Forms\CuratorPicker;
use Illuminate\Support\Arr;

use function Awcodes\Curator\get_media_items;

class CobblerCuratorPicker extends CuratorPicker
{
    protected function setUp(): void
    {
        parent::setUp();

        $this
            ->afterStateHydrated(function (CuratorPicker $component, $state) {
                if (blank($state)) {
                    $component->state([]);

                    return;
                }

                $state = is_array(Arr::first($state)) ? Arr::first($state)['id'] : $state['id'];
                $component->state(get_media_items(Arr::wrap($state)));
            })
            ->dehydrateStateUsing(function ($state) {
                if (filled($state)) {
                    $state = Arr::first($state);

                    return [
                        'id' => $state['id'],
                        'path' => $state['path'],
                        'alt' => $state['alt'] ?? null,
                        'width' => $state['width'],
                        'height' => $state['height'],
                    ];
                }

                return $state;
            });
    }
}
