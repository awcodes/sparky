@props([
    'actions' => [],
    'actions_alignment' => null,
])
<div
    @class([
        'mt-8 flex flex-wrap items-center gap-3',
        'justify-center' => $actions_alignment === 'center',
        'justify-end' => $actions_alignment === 'end',
    ])
>
    @foreach ($actions as $action)
        <a
            href="{{ $action['url'] }}"
            @if ($action['external'])
                target="_blank"
                rel="noopener noreferrer"
            @endif
            @class([
                'inline-block rounded-full px-4 py-2 no-underline',
                match ($action['color']['key'] ?? $action['color']) {
                    'secondary' => $action['outlined']
                        ? 'text-secondary-500 ring-secondary-500 ring-2 ring-inset'
                        : 'bg-secondary-500 text-white',
                    'tertiary' => $action['outlined']
                        ? 'text-tertiary-500 ring-tertiary-500 ring-2 ring-inset'
                        : 'bg-tertiary-500 text-white',
                    'accent' => $action['outlined']
                        ? 'text-accent-500 ring-accent-500 ring-2 ring-inset'
                        : 'bg-accent-500 text-neutral-900',
                    default => $action['outlined']
                        ? 'text-dominant-500 ring-dominant-500 ring-2 ring-inset'
                        : 'bg-dominant-500 text-white'
                },
            ])
        >
            {{ $action['label'] }}
        </a>
    @endforeach
</div>
