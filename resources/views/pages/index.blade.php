<?php

use App\Enums\Status;
use App\Models\Page;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Phiki\CommonMark\PhikiExtension;
use Phiki\Theme\Theme;
use function Laravel\Folio\{render, name};

name('home');

render(function (View $view, Page $page) {
    return $view->with(['page' => $page->where('front_page', true)->sole()]);
})
?>
<x-layouts.app :seo="$page">
    @section('header')
        <x-header />
    @endsection

    @if ($page->content)
        @foreach ($page->content as $block)
            @include('components.blocks.' . str($block['type'])->replace('_', '-'), [...$block['data']])
        @endforeach
    @endif

    @section('footer')
        <x-footer />
    @endsection
</x-layouts.app>
