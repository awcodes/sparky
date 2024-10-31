<?php

use App\Enums\Status;
use App\Models\Page;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Phiki\CommonMark\PhikiExtension;
use Phiki\Theme\Theme;
use function Laravel\Folio\{render, name};

name('sink');

render(function (View $view) {
    abort_unless(Auth::check(), 404);
    return $view->with(['page' => Page::query()->where('slug', 'about')->sole()]);
})
?>
<x-layouts.app :seo="$page">
    @section('header')
        <x-header />
    @endsection

    <x-section>
        <x-button color="dominant">Dominant</x-button>
        <x-button color="secondary">Secondary</x-button>
        <x-button color="tertiary">Tertiary</x-button>
        <x-button color="accent">Accent</x-button>
        <x-button color="neutral">Neutral</x-button>
    </x-section>

    <x-section>
        <x-button color="dominant" outlined>Dominant</x-button>
        <x-button color="secondary" outlined>Secondary</x-button>
        <x-button color="tertiary" outlined>Tertiary</x-button>
        <x-button color="accent" outlined>Accent</x-button>
        <x-button color="neutral" outlined>Neutral</x-button>
    </x-section>

    <x-section>
        <x-prose>
            {!! str($page->content)->markdown(extensions: [
                new PhikiExtension(Theme::NightOwl),
            ])->sanitizeHtml() !!}
        </x-prose>
    </x-section>

    <x-section color="white">
        <x-prose>
            {!! str($page->content)->markdown(extensions: [
                new PhikiExtension(Theme::NightOwl),
            ])->sanitizeHtml() !!}
        </x-prose>
    </x-section>

    <x-section color="dominant">
        <x-prose color="dominant">
            {!! str($page->content)->markdown(extensions: [
                new PhikiExtension(Theme::NightOwl),
            ])->sanitizeHtml() !!}
        </x-prose>
    </x-section>

        <x-section color="secondary">
            <x-prose color="secondary">
                {!! str($page->content)->markdown(extensions: [
                    new PhikiExtension(Theme::NightOwl),
                ])->sanitizeHtml() !!}
            </x-prose>
        </x-section>

        <x-section color="tertiary">
            <x-prose color="tertiary">
                {!! str($page->content)->markdown(extensions: [
                    new PhikiExtension(Theme::NightOwl),
                ])->sanitizeHtml() !!}
            </x-prose>
        </x-section>

        <x-section color="accent">
            <x-prose color="accent">
                {!! str($page->content)->markdown(extensions: [
                    new PhikiExtension(Theme::NightOwl),
                ])->sanitizeHtml() !!}
            </x-prose>
        </x-section>

        <x-section color="neutral">
            <x-prose color="neutral">
                {!! str($page->content)->markdown(extensions: [
                    new PhikiExtension(Theme::NightOwl),
                ])->sanitizeHtml() !!}
            </x-prose>
        </x-section>

    @section('footer')
        <x-footer />
    @endsection
</x-layouts.app>
