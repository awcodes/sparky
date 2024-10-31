@props([
    'color' => null,
])

<div
    {{ $attributes->class([
        '
        prose max-w-none
        prose-headings:font-display prose-headings:mb-6
        prose-h1:text-2xl prose-h1:md:text-4xl
        prose-h2:text-xl prose-h2:md:text-3xl
        prose-h3:text-lg prose-h3:md:text-2xl
        ',
        match ($color) {
            'dominant', 'bg-gradient-bars-dominant', 'bg-gradient-radial-dominant' => 'prose-dominant',
            'secondary', 'bg-gradient-bars-secondary', 'bg-gradient-radial-secondary' => 'prose-secondary',
            'tertiary', 'bg-gradient-bars-tertiary', 'bg-gradient-radial-tertiary' => 'prose-tertiary',
            'accent', 'bg-gradient-bars-accent', 'bg-gradient-radial-accent' => 'prose-accent',
            default => null,
        },
    ])->merge() }}
>
    {!! $slot !!}
</div>
