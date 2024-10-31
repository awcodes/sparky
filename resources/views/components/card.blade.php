@props([
    'color' => null,
    'heading' => null,
    'footer' => null,
    'cap' => null,
    'flush' => false,
    'leaf' => false,
])

<div
    {{ $attributes->class([
        'group relative flex flex-col overflow-hidden border border-neutral-300',
        '[&:has([data-card-link])]:cursor-pointer',
        'bg-neutral-50' => $color,
        'rounded-tr-md rounded-bl-md' => $leaf,
        'rounded-md' => ! $leaf
    ]) }}
    x-data="{}"
    x-on:click="
        ($event) => {
            if ($el.querySelector('[data-card-link]')) {
                window.location = $el
                    .querySelector('[data-card-link]')
                    .getAttribute('href')
            }
        }
    "
>
    @if ($cap)
        <div class="overflow-hidden relative">
            {{ $cap }}
        </div>
    @endif

    @if ($heading)
        <h3
            @class([
                'text-lg text-center font-bold py-2 px-4 border-b',
                match ($color) {
                    'dominant' => 'border-dominant-300 bg-dominant-300 text-dominant-900',
                    'secondary' => 'border-secondary-300 bg-secondary-300 text-secondary-900',
                    'tertiary' => 'border-tertiary-300 bg-tertiary-300 text-tertiary-900',
                    'accent' => 'border-accent-300 bg-accent-300 text-accent-900',
                    'info' => 'border-info-300 bg-info-300 text-info-900',
                    'success' => 'border-success-300 bg-success-300 text-success-900',
                    'warning' => 'border-warning-300 bg-warning-300 text-warning-900',
                    'danger' => 'border-danger-300 bg-danger-300 text-danger-900',
                    default => 'border-neutral-300 bg-neutral-300 text-neutral-900',
                },
            ])
        >
            {{ $heading }}
        </h3>
    @endif

    <div @class(['flex-1 p-4' => ! $flush])>
        {{ $slot }}
    </div>

    @if ($footer)
        <div
            @class([
                'rounded-b-md border-t px-4 py-3',
                match ($color) {
                    'dominant' => 'bg-dominant-100 border-dominant-300 text-dominant-900',
                    'secondary' => 'bg-secondary-100 border-secondary-300 text-secondary-900',
                    'tertiary' => 'bg-tertiary-100 border-tertiary-300 text-tertiary-900',
                    'accent' => 'bg-accent-100 border-accent-300 text-accent-900',
                    'info' => 'bg-info-100 border-info-300 text-info-900',
                    'success' => 'bg-success-100 border-success-300 text-success-900',
                    'warning' => 'bg-warning-100 border-warning-300 text-warning-900',
                    'danger' => 'bg-danger-100 border-danger-300 text-danger-900',
                    default => 'border-neutral-300 bg-neutral-50 text-neutral-900',
                },
            ])
        >
            {{ $footer }}
        </div>
    @endif
</div>
