<?php

namespace App\Filament\Tables\Columns;

use Filament\Tables\Columns\IconColumn;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class IndexedColumn extends IconColumn
{
    protected function setUp(): void
    {
        parent::setUp();

        $this
            ->label('Indexed')
            ->alignCenter()
            ->getStateUsing(fn (Model $record) => Str::of($record->seo->robots)->contains('noindex'))
            ->size('md')
            ->icons([
                'heroicon-o-check-badge' => false,
                'heroicon-o-no-symbol' => true,
            ])
            ->colors([
                'success' => false,
                'danger' => true,
            ]);
    }
}
