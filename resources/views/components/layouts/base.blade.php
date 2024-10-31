@props([
    'seo' => null,
])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        @if (! $seo)
            <title>{{ config('app.name') }}</title>
        @else
            {!! seo($seo) !!}
        @endif

        @yield('meta')

        <x-fonts />

        {!! \Filament\Support\Facades\FilamentAsset::renderStyles() !!}

        @vite('resources/css/app/app.css')

        @stack('styles')
    </head>

    <body class="font-body relative overflow-x-hidden bg-neutral-50 text-neutral-900">

        <div id="page-wrapper" class="flex min-h-dvh flex-col">
            {{ $slot }}
        </div>

        @vite('resources/js/app.js')
        @stack('scripts')
        @stack('modals')
    </body>
</html>
