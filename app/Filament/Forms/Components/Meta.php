<?php

namespace App\Filament\Forms\Components;

use Filament\Forms;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\HtmlString;

class Meta
{
    public static function make(): Forms\Components\Group
    {
        return Forms\Components\Group::make([
            Forms\Components\TextInput::make('title')
                ->label('Title')
                ->live(debounce: 500)
                ->helperText(function (?string $state): Htmlable {
                    $count = strlen($state);
                    $color = $count > 60 ? 'rgb(var(--warning-500))' : 'inherit';

                    return new HtmlString('<span style="color: ' . $color . ';">' . $count . ' / 60 characters</span>');
                }),
            Forms\Components\Textarea::make('description')
                ->label('Description')
                ->rows(3)
                ->live(debounce: 500)
                ->helperText(function (?string $state): Htmlable {
                    $count = strlen($state);
                    $color = $count > 160 ? 'rgb(var(--warning-500))' : 'inherit';

                    return new HtmlString('<span style="color: ' . $color . ';">' . $count . ' / 160 characters</span>');
                }),
            Forms\Components\CheckboxList::make('robots')
                ->options([
                    'noindex' => 'No Index',
                    'nofollow' => 'No Follow',
                ])
                ->gridDirection('row')
                ->columns(4)
                ->afterStateHydrated(function ($component, $state) {
                    if ($state && ! is_array($state)) {
                        $state = explode(',', $state);
                    }

                    $component->state($state ?? []);
                })
                ->dehydrateStateUsing(function (?array $state): ?string {
                    return filled($state) ? implode(',', $state) : null;
                }),
        ])->relationship('seo');
    }
}
