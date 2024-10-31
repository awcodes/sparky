@props([
    'id' => null,
    'is_full_width' => false,
    'background_color' => 'white',
    'image_position' => null,
    'image_alignment' => null,
    'image_flush' => false,
    'image_rounded' => false,
    'image_shadow' => false,
    'text' => null,
    'image' => null,
    'background_image' => null,
    'actions' => [],
    'actions_alignment' => null,
])

@php
    use Awcodes\Curator\Glide\GlideBuilder;
    use Illuminate\Support\Arr;

    $image = is_array(Arr::first($image)) ? Arr::first($image) : $image;
@endphp

<x-section
    :color="$background_color['key'] ?? $background_color"
    :is-full-width="$is_full_width"
    :background-image="$background_image"
>
    <div
        @class([
            'grid gap-6 md:grid-cols-3',
            'items-center' => ! $image_flush,
            'items-end' => $image_alignment === 'bottom' && $image_flush,
            'items-start' => $image_alignment === 'top' && $image_flush,
        ])
    >
        @if (filled($image))
            <div
                @class([
                    'grid h-full w-full',
                    'order-0' => $image_position === 'start',
                    'order-1' => $image_position === 'end',
                    'items-end' => $image_alignment === 'bottom' && $image_flush,
                    'items-start' => $image_alignment === 'top' && $image_flush,
                ])
            >
                <img
                    src="{{ \Awcodes\Curator\is_media_resizable($image['path'])
                        ? GlideBuilder::make()
                            ->format('webp')
                            ->width(640)
                            ->toUrl($image['path'] ?? '')
                        : asset($image['path']) }}"
                    alt="{{ $image['alt'] }}"
                    width="{{ $image['width'] }}"
                    height="{{ $image['height'] }}"
                    @class([
                        'rounded-lg' => $image_rounded,
                        'shadow-md' => $image_shadow,
                        'max-h-64 w-auto md:max-h-none' => ! $is_full_width,
                        'h-full w-full object-cover' => $is_full_width,
                        'md:-mb-12' => $image_alignment === 'bottom' && $image_flush,
                        'md:-mt-12' => $image_alignment === 'top' && $image_flush,
                    ])
                />
            </div>
        @endif

        <div
            @class([
                'md:col-span-2' => filled($image),
                'md:col-span-3' => ! filled($image),
                'px-6 py-8 md:px-8 md:py-12' => $is_full_width,
            ])
        >
            @if ($text)
                <x-prose :color="$background_color['key'] ?? $background_color">
                    {!! $text !!}
                </x-prose>
            @endif

            @if ($actions)
                <x-blocks.actions
                    :actions="$actions"
                    :actions_alignment="$actions_alignment"
                />
            @endif
        </div>
    </div>
</x-section>
