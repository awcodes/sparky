@props([
    'name' => null,
    'items' => [],
])

<x-dropdown>
    <x-slot:trigger>
        <button type="button" class="text-primary-500 block">
            <span class="sr-only">{{ trans('site.mobile_menu') }}</span>
            @svg('heroicon-o-bars-4', 'h-8 w-8')
        </button>
    </x-slot>

    <nav id="mobile-menu" class="bg-gray-100">
        <ul>
            @foreach ($items as $item)
                <x-menus.mobile.item :item="$item" />
            @endforeach
        </ul>
    </nav>
</x-dropdown>
