<?php

namespace App\Filament\Tables\Columns;

use Awcodes\FilamentBadgeableColumn\Components\Badge;
use Filament\Support\Colors\Color;

class ScheduledBadge extends Badge
{
    protected function setUp(): void
    {
        $this
            ->label('Scheduled')
            ->color(Color::Yellow)
            ->visible(fn ($record): bool => $record->published_at?->isAfter(now()) ?? false);
    }
}
