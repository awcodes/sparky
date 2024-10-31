<?php

use App\Enums\Status;
use App\Models\Post;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Phiki\CommonMark\PhikiExtension;
use Phiki\Theme\Theme;
use function Laravel\Folio\{render,name};

name('posts.show');

render(function (View $view, Post $post) {
    abort_unless(
        Auth::check() ||
        $post->isPublished
    , 404);

    return $view;
})
?>
<x-layouts.app :seo="$post">
    @section('header')
        <x-header />
    @endsection

    <x-section>
        <x-prose>
            {!! str($post->content)->markdown(extensions: [
                new PhikiExtension(Theme::NightOwl),
            ])->sanitizeHtml() !!}
        </x-prose>
    </x-section>

    @section('footer')
        <x-footer />
    @endsection
</x-layouts.app>
