<?php

namespace App\Filament\Tables\Columns;

use Awcodes\FilamentBadgeableColumn\Components\Badge;

class TrashedBadge extends Badge
{
    protected function setUp(): void
    {
        $this
            ->label('Trashed')
            ->color('danger')
            ->visible(fn ($record): bool => $record->deleted_at !== null ?? false);
    }
}
