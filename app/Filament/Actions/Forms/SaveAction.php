<?php

namespace App\Filament\Actions\Forms;

use Filament\Actions\Action;

class SaveAction extends Action
{
    protected function setUp(): void
    {
        $this->name('custom_save')
            ->label(__('Save changes'))
            ->button()
            ->action('save');
    }
}
