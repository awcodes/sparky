<?php

namespace App\Filament\Actions\Forms;

use Filament\Actions\Action;

class CreateAction extends Action
{
    protected function setUp(): void
    {
        $this->name('custom_create')
            ->label(__('Create'))
            ->button()
            ->action('create');
    }
}
