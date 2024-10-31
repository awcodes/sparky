@props([
    'forceMode' => null,
])

@if (config('site.lighting'))
<div
    x-data="{
        mode: null,

        init () {
            this.mode = localStorage.getItem('lighting')

            if (! this.mode) {
                this.mode = '{{ $forceMode ?? "system" }}'
                localStorage.setItem('lighting', this.mode)
            }

            this.handleAttribute()

            $dispatch('lighting-mode-changed', this.mode)

            $watch('mode', (theme) => {
                this.handleAttribute()
                localStorage.setItem('lighting', theme)
                $dispatch('lighting-mode-changed', theme)
            })
        },
        handleAttribute() {
            if (
                this.mode === 'dark' ||
                (this.mode === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches)
            ) {
                document.documentElement.classList.add('dark')
            } else {
                document.documentElement.classList.remove('dark')
            }
        },
    }"
    class="lighting-controls flex items-center gap-x-1"
>
    <button
        type="button"
        x-bind:class="{'bg-neutral-50 text-accent-500 dark:bg-white/5 dark:text-accent-400': mode === 'light'}"
        x-on:click="mode = 'light'"
        class="flex justify-center rounded-lg p-2 outline-none transition duration-75 hover:bg-neutral-50 focus:bg-neutral-50 dark:hover:bg-white/5 dark:focus:bg-white/5"
    >
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
            <title>{{ trans('lighting.light') }}</title>
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
        </svg>
    </button>

    <button
        type="button"
        x-bind:class="{'bg-neutral-50 text-accent-500 dark:bg-white/5 dark:text-accent-400': mode === 'dark'}"
        x-on:click="mode = 'dark'"
        class="flex justify-center rounded-lg p-2 outline-none transition duration-75 hover:bg-neutral-50 focus:bg-neutral-50 dark:hover:bg-white/5 dark:focus:bg-white/5"
    >
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
            <title>{{ trans('lighting.dark') }}</title>
            <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z" />
        </svg>
    </button>

    <button
        type="button"
        x-bind:class="{'bg-neutral-50 text-accent-500 dark:bg-white/5 dark:text-accent-400': mode === 'system'}"
        x-on:click="mode = 'system'"
        class="flex justify-center rounded-lg p-2 outline-none transition duration-75 hover:bg-neutral-50 focus:bg-neutral-50 dark:hover:bg-white/5 dark:focus:bg-white/5"
    >
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
            <title>{{ trans('lighting.system') }}</title>
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25m18 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m18 0V12a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 12V5.25" />
        </svg>
    </button>
</div>
@endif
