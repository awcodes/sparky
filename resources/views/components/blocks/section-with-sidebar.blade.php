@props([
    'id' => null,
    'is_full_width' => false,
    'background_color' => 'white',
    'text' => null,
    'sidebar' => 'default',
    'alignment' => 'top',
    'is_hero' => 'no'
])

<x-section
    :color="$background_color['key'] ?? $background_color"
    :is-full-width="$is_full_width"
    @class([
      'is-hero' => $is_hero === 'yes'
    ])
>
    <x-layouts.sidebar :alignment="$alignment" :sidebar="$sidebar">
        @if ($text)
            <x-prose :color="$background_color['key'] ?? $background_color">
                {!! $text !!}
            </x-prose>
        @endif
    </x-layouts.sidebar>
</x-section>
