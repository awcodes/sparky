@props([
    'color' => null,
    'flush' => false,
    'aside' => false,
    'isFullWidth' => false,
    'backgroundImage' => null,
    'overflow' => false,
])

@php
    use Awcodes\Curator\Glide\GlideBuilder;
    use Illuminate\Support\Arr;

    $backgroundImage = is_array(Arr::first($backgroundImage)) ? Arr::first($backgroundImage) : $backgroundImage;
@endphp

<{{ $aside ? 'aside' : 'section' }}
    {{ $attributes->class([
        'font-body branded',
        'py-8 lg:py-12' => ! $isFullWidth && ! $flush,
        'bg-cover bg-no-repeat bg-center' => filled($backgroundImage),
        'overflow-hidden' => ! $overflow,
        match ($color) {
            'dominant' => 'bg-dominant-500 text-white',
            'secondary' => 'bg-secondary-500 text-white',
            'tertiary' => 'bg-tertiary-500 text-white',
            'accent' => 'bg-accent-500 text-neutral-900',
            'neutral' => 'bg-neutral-100 text-neutral-900',
            'white' => 'bg-white text-neutral-900',
            default => $color,
        },
    ])->merge() }}
    @if (filled($backgroundImage))
        style="background-image: url('{{ \Awcodes\Curator\is_media_resizable($backgroundImage['path']) ? GlideBuilder::make()->toUrl($backgroundImage['path'] ?? '') : asset($backgroundImage['path']) }}')"
    @endif
>
@if (! $isFullWidth)
    <x-container>
        {{ $slot }}
    </x-container>
@else
    {{ $slot }}
@endif
</{{ $aside ? 'aside' : 'section' }}>
