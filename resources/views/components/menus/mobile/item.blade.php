@props([
    'item' => null,
    'active' => false,
])

@php
    $itemClasses = 'hover:bg-secondary-500 focus:bg-secondary-500 inline-block w-full px-4 py-2 text-sm hover:text-white focus:text-white';
@endphp

<li>
    @if (filled($item['children']))
        <x-dropdown>
            <x-slot:trigger>
                <button
                    type="button"
                    {{ $attributes->class([
                            $itemClasses,
                            'bg-neutral-300' => $active,
                            'flex items-center gap-2',
                        ]) }}
                >
                    <span>{{ $item['label'] }}</span>
                    @svg('heroicon-s-chevron-down', '-me-2 h-3 w-3')
                </button>
            </x-slot>

            <ul class="bg-neutral-100">
                @foreach ($item['children'] as $child)
                    <x-menus.main.item :item="$child" />
                @endforeach
            </ul>
        </x-dropdown>
    @else
        <a
            href="{{ $item['url'] }}"
            @if ($item['target'])
                target="{{ $item['target'] }}"
            @endif
            @if ($item['rel'])
                rel="{{ $item['rel'] }}"
            @endif
            {{ $attributes->class([
                    $itemClasses,
                    'bg-neutral-300' => active_route($item['url']),
                ]) }}
        >
            {{ $item['label'] }}
        </a>
    @endif
</li>
