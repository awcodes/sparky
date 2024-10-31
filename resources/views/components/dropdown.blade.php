@props([
    'maxHeight' => null,
    'offset' => 8,
    'placement' => 'bottom-start',
    'shift' => false,
    'teleport' => false,
    'trigger' => null,
    'width' => null,
])

@php
    use Filament\Support\Enums\MaxWidth;
@endphp

<div
    x-data="{
        toggle: function (event) {
            $refs.panel.toggle(event)
        },

        open: function (event) {
            $refs.panel.open(event)
        },

        close: function (event) {
            $refs.panel.close(event)
        },
    }"
    {{ $attributes->class(['dropdown relative']) }}
>
    <div
        x-on:click="toggle"
        {{ $trigger->attributes->class(['dropdown-trigger flex cursor-pointer']) }}
    >
        {{ $trigger }}
    </div>
    <div
        x-cloak
        x-ref="panel"
        x-float{{ $placement ? ".placement.{$placement}" : '' }}.flip{{ $shift ? '.shift' : '' }}{{ $teleport ? '.teleport' : '' }}{{ $offset ? '.offset' : '' }}="{ offset: {{ $offset }} }"
        x-ref="panel"
        x-transition:enter-start="opacity-0"
        x-transition:leave-end="opacity-0"
        @class([
            'dropdown-panel absolute z-10 w-screen divide-y divide-neutral-100 overflow-scroll rounded-lg bg-white shadow-lg ring-1 ring-neutral-950/5 transition',
            match ($width) {
                MaxWidth::ExtraSmall, 'xs' => 'max-w-xs',
                MaxWidth::Small, 'sm' => 'max-w-sm',
                MaxWidth::Medium, 'md' => 'max-w-md',
                MaxWidth::Large, 'lg' => 'max-w-lg',
                MaxWidth::ExtraLarge, 'xl' => 'max-w-xl',
                MaxWidth::TwoExtraLarge, '2xl' => 'max-w-2xl',
                MaxWidth::ThreeExtraLarge, '3xl' => 'max-w-3xl',
                MaxWidth::FourExtraLarge, '4xl' => 'max-w-4xl',
                MaxWidth::FiveExtraLarge, '5xl' => 'max-w-5xl',
                MaxWidth::SixExtraLarge, '6xl' => 'max-w-6xl',
                MaxWidth::SevenExtraLarge, '7xl' => 'max-w-7xl',
                null => 'max-w-[14rem]',
                default => $width,
            },
            'overflow-y-auto' => $maxHeight,
        ])
        @style([
            "max-height: {$maxHeight}" => $maxHeight,
        ])
    >
        {{ $slot }}
    </div>
</div>
