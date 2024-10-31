<?php

namespace App\Filament\Tables\Columns;

use App\Enums\Status;
use Awcodes\FilamentBadgeableColumn\Components\Badge;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class StatusBadge extends Badge
{
    protected function setUp(): void
    {
        $this
            ->color(function (Model $record) {
                return match ($record->status) {
                    Status::Published => 'success',
                    Status::InReview => 'danger',
                    default => 'gray',
                };
            })
            ->label(fn (Model $record): string => Str::ucfirst($record->status->value))
            ->visible(fn (Model $record): bool => $record->status !== Status::Published);
    }
}
