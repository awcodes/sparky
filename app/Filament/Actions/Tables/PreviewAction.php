<?php

namespace App\Filament\Actions\Tables;

use Filament\Support\Colors\Color;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Model;

class PreviewAction extends Action
{
    protected function setUp(): void
    {
        parent::setUp();

        $this
            ->name('preview')
            ->label('Preview')
            ->color(Color::Zinc)
            ->icon('heroicon-o-eye')
            ->url(fn (Model $record): string => $record?->getPublicUrl() ?? '', true)
            ->hidden(static function (Model $record): bool {
                if (! method_exists($record, 'trashed')) {
                    return false;
                }

                return $record->trashed();
            });
    }
}
