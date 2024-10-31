<?php

use App\Models\Post;
use Livewire\Volt\Component;
use Livewire\WithPagination;
use Illuminate\Support\Collection;

new class extends Component {
    use WithPagination;

    public function paginationView(): string
    {
        return 'vendor.livewire.simple-tailwind';
    }

    public function with(): array
    {
        return [
            'posts' => Post::query()
                ->published()
                ->with(['featuredImage'])
                ->orderBy('published_at', 'desc')
                ->paginate(9),
        ];
    }
}; ?>

<div class="not-prose">
    @if ($posts)
        <ul role="list" class="grid sm:grid-cols-2 md:grid-cols-3 mb-6 gap-6 items-stretch">
            @foreach ($posts as $post)
                <li>
                    <x-card class="h-full">
                        <x-slot name="cap">
                            <x-curator-glider
                                :media="$post->featuredImage"
                                width="640"
                                height="320"
                                fit="crop"
                                format="webp"
                                loading="lazy"
                                class="object-cover object-center w-full h-full group-hover:scale-110 transition ease-in"
                            />
                        </x-slot>

                        <div class="text-ellipsis flex flex-col h-full gap-2">
                            <div>
                                <a href="{{ route('posts.show', ['post' => $post]) }}" data-card-link>
                                    <h3 class="font-display font-bold text-neutral-900">{{$post->title}}</h3>
                                </a>
                            </div>
                            <div class="mt-auto">
                                <p class="text-xs font-light italic text-neutral-500">{{$post->published_at->format('M d, Y')}}</p>
                            </div>
                        </div>
                    </x-card>
                </li>
            @endforeach
        </ul>
    @endif

    {!! $posts->links() !!}
</div>

