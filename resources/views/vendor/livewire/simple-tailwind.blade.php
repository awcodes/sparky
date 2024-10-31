@php
    if (! isset($scrollTo)) {
        $scrollTo = 'body';
    }

    $scrollIntoViewJsSnippet = ($scrollTo !== false)
        ? <<<JS
           (\$el.closest('{$scrollTo}') || document.querySelector('{$scrollTo}')).scrollIntoView({ behavior: 'smooth' })
        JS
        : '';
@endphp

<div>
    @if ($paginator->hasPages())
        <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-between">
            <span>
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <x-button
                        :disabled="true"
                        class="opacity-20"
                        color="neutral"
                    >
                        {!! __('pagination.previous') !!}
                    </x-button>
                @else
                    @if(method_exists($paginator,'getCursorName'))
                        {{-- // @todo: Remove `wire:key` once mutation observer has been fixed to detect parameter change for the `setPage()` method call --}}
                        <x-button
                            type="button"
                            dusk="previousPage"
                            wire:key="cursor-{{ $paginator->getCursorName() }}-{{ $paginator->previousCursor()->encode() }}"
                            wire:click="setPage('{{$paginator->previousCursor()->encode()}}','{{ $paginator->getCursorName() }}')"
                            wire:loading.attr="disabled"
                            class="livewire-pagination-button"
                            x-on:click="{{ $scrollIntoViewJsSnippet }}"
                        >
                            {!! __('pagination.previous') !!}
                        </x-button>
                    @else
                        <x-button
                            type="button"
                            wire:click="previousPage('{{ $paginator->getPageName() }}')"
                            wire:loading.attr="disabled" dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}"
                            class="livewire-pagination-button"
                            x-on:click="{{ $scrollIntoViewJsSnippet }}"
                        >
                            {!! __('pagination.previous') !!}
                        </x-button>
                    @endif
                @endif
            </span>

            <span>
                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    @if(method_exists($paginator,'getCursorName'))
                        {{-- // @todo: Remove `wire:key` once mutation observer has been fixed to detect parameter change for the `setPage()` method call --}}
                        <x-button
                            type="button"
                            dusk="nextPage"
                            wire:key="cursor-{{ $paginator->getCursorName() }}-{{ $paginator->nextCursor()->encode() }}"
                            wire:click="setPage('{{$paginator->nextCursor()->encode()}}','{{ $paginator->getCursorName() }}')"
                            wire:loading.attr="disabled"
                            class="livewire-pagination-button"
                            x-on:click="{{ $scrollIntoViewJsSnippet }}"
                        >
                            {!! __('pagination.next') !!}
                        </x-button>
                    @else
                        <x-button
                            type="button"
                            wire:click="nextPage('{{ $paginator->getPageName() }}')"
                            wire:loading.attr="disabled"
                            dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}"
                            class="livewire-pagination-button"
                            x-on:click="{{ $scrollIntoViewJsSnippet }}"
                        >
                            {!! __('pagination.next') !!}
                        </x-button>
                    @endif
                @else
                    <x-button
                        :disabled="true"
                        class="opacity-20"
                        color="neutral"
                    >
                        {!! __('pagination.next') !!}
                    </x-button>
                @endif
            </span>
        </nav>
    @endif
</div>
