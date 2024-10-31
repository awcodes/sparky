@props([
    'id' => null,
    'is_full_width' => false,
    'background_color' => 'white',
    'text' => null,
    'actions' => [],
    'actions_alignment' => null,
    'category' => null,
    'count' => 3,
])

<x-section :color="$background_color['key'] ?? $background_color" :is-full-width="$is_full_width">
    @if ($text)
        <x-prose :color="$background_color['key'] ?? $background_color" class="mb-6">
            {!! $text !!}
        </x-prose>
    @endif

    <livewire:recent-blog-posts
        id="{{ $id }}"
        :category="$category"
        :count="$count"
        wire:key="{{ $id }}"
    />

    @if ($actions)
        <x-blocks.actions
            :actions="$actions"
            :actions_alignment="$actions_alignment"
        />
    @endif
</x-section>
