<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum PageLayout: string implements HasLabel
{
    case Default = 'default';
    case Unbranded = 'unbranded';
    case Static = 'static';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Default => 'Default',
            self::Unbranded => 'Unbranded',
            self::Static => 'Static',
        };
    }
}
