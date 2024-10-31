<?php

use App\Models\Menu;
use Livewire\Volt\Component;

new class extends Component {

    public ?Menu $menu = null;

    public ?string $slug = null;

    public function mount(): void
    {
        $this->menu = Menu::query()->where('slug', $this->slug)->first() ?? null;
    }
}; ?>

<div
    @class([
        'hidden' => ! $menu
    ])
>
    <x-dynamic-component :component="'menus.' . $slug" :name="$menu->name" :items="$menu->items" />
</div>
