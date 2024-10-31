@props([
    'seo' => null,
])

<x-layouts.base :seo="$seo">
    <x-skip-link />

    @yield('header')

    <main id="site-main" class="flex-1">
        {{ $slot }}
    </main>

    @yield('footer')
</x-layouts.base>
