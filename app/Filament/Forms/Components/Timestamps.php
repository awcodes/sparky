<?php

namespace App\Filament\Forms\Components;

use Filament\Forms\Components\Group;
use Filament\Forms\Components\Placeholder;
use Illuminate\Database\Eloquent\Model;

class Timestamps
{
    public static function make(): Group
    {
        return Group::make()
            ->schema([
                Placeholder::make('created_at')
                    ->content(fn (?Model $record): string => $record?->created_at?->diffForHumans() ?? '-'),
                Placeholder::make('updated_at')
                    ->content(fn (?Model $record): string => $record?->updated_at?->diffForHumans() ?? '-'),
            ])
            ->columnSpanFull()
            ->columns(['sm' => 2]);
    }
}
