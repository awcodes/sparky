@php
    $statePath = $getStatePath();
    $state = $getState();
    $record = $getRecord();
    $isFrontPage = false;

    if ($record && is_a($record, \App\Models\Page::class) && $record->front_page) {
        $isFrontPage = true;
    }
@endphp

<x-dynamic-component :component="$getFieldWrapperView()" :field="$field" class="-mt-3">
    <div
        x-data="{
            context: '{{ $getContext() }}', // edit or create
            state: $wire.entangle('{{ $statePath }}'), // current slug value
            statePersisted: '', // slug value received from db
            stateInitial: '', // slug value before modification
            editing: false,
            modified: false,
            initModification: function() {
                this.stateInitial = this.state;

                if(!this.statePersisted) {
                    this.statePersisted = this.state;
                }

                this.editing = true;

                setTimeout(() => $refs.slugInput.focus(), 75);
            },
            submitModification: function() {
                if (!this.stateInitial) {
                    this.stateInitial = '';
                } else {
                    this.state = this.stateInitial;
                }
                this.detectModification();
                this.editing = false;
           },
           cancelModification: function() {
                this.stateInitial = this.state;
                this.detectModification();
                this.editing = false;
           },
           resetModification: function() {
                this.stateInitial = this.statePersisted;
                this.detectModification();
           },
           detectModification: function() {
                this.modified = this.stateInitial !== this.statePersisted;
           },
        }"
        x-on:submit.document="modified = false"
    >

        <div
            {{ $attributes->merge($getExtraAttributes())->class(['flex mx-1 items-center justify-between group text-sm']) }}
        >

            @if($isReadOnly())
                <span class="flex max-w-sm">
                    <span class="mr-1">{{ $getLabelPrefix() }}</span>
                    <span class="text-gray-500 dark:text-gray-400">{{ $getFullBaseUrl() }}</span>
                    <span class="text-gray-500 dark:text-gray-400 font-semibold">{{ $state }}</span>
                </span>

                @if($getSlugInputUrlVisitLinkVisible())
                    <a
                        href="{{ $getRecordUrl() }}"
                        target="_blank"
                        class="
                            cursor-pointer text-sm text-primary-600 underline
                            inline-flex items-center justify-center space-x-1
                            hover:text-primary-500
                            dark:text-primary-500 dark:hover:text-primary-400
                        "
                    >
                        <span>{{ $getVisitLinkLabel() }}</span>
                        <x-filament::icon
                            icon="heroicon-o-arrow-top-right-on-square"
                            class="h-4 w-4"
                        />
                    </a>
                @endif
            @else
                <span
                    class="
                        @if(!$state) flex items-center gap-1 @endif
                    "
                >
                    <span>{{ $getLabelPrefix() }}</span>

                    <span
                        x-text="!editing ? '{{ $getFullBaseUrl() }}' : '{{ $getBasePath() }}'"
                        class="text-gray-500 dark:text-gray-400"
                    ></span>

                    @if (! $isFrontPage)
                        <button
                            type="button"
                            x-on:click.prevent="initModification()"
                            x-show="!editing"
                            class="
                                cursor-pointer
                                font-semibold text-gray-500
                                inline-flex items-center justify-center
                                hover:underline hover:text-primary-500
                                dark:text-gray-400 dark:hover:text-primary-400
                            "
                            :class="context !== 'create' && modified ? 'text-gray-600 bg-gray-100 dark:text-gray-400 dark:bg-gray-700 px-1 rounded-md' : ''"
                        >
                            <span class="mr-1" x-text="state"></span>

                            <x-filament::icon
                                icon="heroicon-o-pencil-square"
                                class="h-4 w-4 text-primary-600 dark:text-primary-500"
                            />

                            <span class="sr-only">Edit</span>
                        </button>

                        @if($getSlugLabelPostfix())
                            <span
                                x-show="!editing"
                                class="ml-0.5 text-gray-400"
                            >{{ $getSlugLabelPostfix() }}</span>
                        @endif

                        <span x-show="!editing && context !== 'create' && modified"> [changed]</span>
                    @endif
                </span>

                <div
                    class="flex-1 mx-2"
                    x-show="editing"
                    style="display: none; color:black"
                >
                    <x-filament::input.wrapper
                        :disabled="$isDisabled()"
                        :valid="! $errors->has($statePath)"
                        class="fi-fo-text-input"
                        :attributes="
                            \Filament\Support\prepare_inherited_attributes($getExtraAttributeBag())
                                ->class(['overflow-hidden'])
                        "
                    >
                        <input
                            type="text"
                            x-ref="slugInput"
                            x-model="stateInitial"
                            x-bind:disabled="!editing"
                            x-on:keydown.enter="submitModification()"
                            x-on:keydown.escape="cancelModification()"
                            {!! ($autocomplete = $getAutocomplete()) ? "autocomplete=\"{$autocomplete}\"" : null !!}
                            id="{{ $getId() }}"
                            {!! ($placeholder = $getPlaceholder()) ? "placeholder=\"{$placeholder}\"" : null !!}
                            {!! $isRequired() ? 'required' : null !!}
                            {{ $getExtraInputAttributeBag()->class([
                            'fi-input block w-full border-none py-1.5 text-base text-gray-950 transition duration-75 placeholder:text-gray-400 focus:ring-0 disabled:text-gray-500 disabled:[-webkit-text-fill-color:theme(colors.gray.500)] disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.400)] dark:text-white dark:placeholder:text-gray-500 dark:disabled:text-gray-400 dark:disabled:[-webkit-text-fill-color:theme(colors.gray.400)] dark:disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.500)] sm:text-sm sm:leading-6 bg-white/0',
                            ]) }}
                        />
                    </x-filament::input.wrapper>

                    <input type="hidden" {{ $applyStateBindingModifiers('wire:model') }}="{{ $statePath }}" />
                </div>

                <div
                    x-show="editing"
                    class="flex px-2 gap-2"
                    style="display: none;"
                >
                    <x-filament::icon-button
                        x-on:click="submitModification()"
                        icon="heroicon-o-check"
                        color="success"
                        size="sm"
                        title="OK"
                    />

                    <x-filament::icon-button
                        x-show="context === 'edit' && modified"
                        x-on:click="resetModification()"
                        icon="heroicon-o-arrow-path"
                        color="gray"
                        size="sm"
                        title="Reset"
                    />

                    <x-filament::icon-button
                        x-on:click="cancelModification()"
                        icon="heroicon-o-x-mark"
                        color="danger"
                        size="sm"
                        title="Cancel"
                    />
                </div>

                <div x-show="context === 'edit' && !editing" class="flex items-center gap-2">
                    <span class="flex items-center space-x-2">
                        <button
                            type="button"
                            x-on:click="
                                window.navigator.clipboard.writeText(@js($isFrontPage ? config('app.url') : $getRecordUrl()))
                                $tooltip('Copied', {
                                    theme: $store.theme,
                                    timeout: 1000,
                                })
                            "
                            class="filament-link inline-flex items-center justify-center space-x-1 hover:underline focus:outline-none focus:underline text-sm text-primary-600 hover:text-primary-500 dark:text-primary-500 dark:hover:text-primary-400 cursor-pointer"
                        >
                            <span>{{ trans('Copy') }}</span>

                            <x-filament::icon
                                icon="heroicon-o-clipboard"
                                class="h-4 w-4"
                            />
                        </button>
                    </span>
                    <span class="flex items-center space-x-2">
                        @if($getSlugInputUrlVisitLinkVisible())
                            <a
                                href="{{ $getRecordUrl() }}"
                                target="_blank"
                                class="filament-link inline-flex items-center justify-center space-x-1 hover:underline focus:outline-none focus:underline text-sm text-primary-600 hover:text-primary-500 dark:text-primary-500 dark:hover:text-primary-400 cursor-pointer"
                            >
                                <span>{{ $getVisitLinkLabel() }}</span>

                                <x-filament::icon
                                    icon="heroicon-o-arrow-top-right-on-square"
                                    class="h-4 w-4"
                                />
                            </a>
                        @endif
                    </span>
                </div>
            @endif
        </div>
    </div>
</x-dynamic-component>
