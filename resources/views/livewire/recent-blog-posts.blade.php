<?php

use App\Models\Post;
use Illuminate\Support\Collection;
use Livewire\Attributes\On;
use Livewire\Volt\Component;

new class extends Component {
    public ?string $id = null;

    public int $count = 3;

    public ?Collection $posts = null;

    public function mount(): void
    {
        $this->getPosts($this->id, $this->count);
    }

    #[On('categoryUpdated')]
    public function getPosts($id, $count): void
    {
        if ($this->id === $id) {
            $this->count = $count;

            $this->posts = Post::query()
                ->with(['featuredImage'])
                ->published()
                ->latest('published_at')
                ->take($count)
                ->get();
        }
    }
}; ?>

<div class="blog-list-container">
    @if ($posts)
        <div
            class="grid items-stretch justify-center gap-6 sm:grid-cols-2 md:grid-cols-3"
        >
            @foreach ($posts as $post)
                <x-card wire:key="{{ $post->slug }}">
                    <x-slot name="cap">
                        <x-curator-glider
                            :media="$post->featuredImage"
                            width="640"
                            height="320"
                            fit="crop"
                            format="webp"
                            loading="lazy"
                            class="h-full w-full object-cover object-center transition ease-in group-hover:scale-110"
                        />
                    </x-slot>

                    <div class="flex h-full flex-col gap-2 text-ellipsis">
                        <div class="">
                            <a
                                href="{{ route('posts.show', ['post' => $post]) }}"
                                data-card-link
                            >
                                <h3 class="text-neutral-900">
                                    {{ $post->title }}
                                </h3>
                            </a>
                        </div>
                        <div class="mt-auto">
                            <p class="text-xs font-light italic text-neutral-500">
                                {{ $post->published_at->format('M d, Y') }}
                            </p>
                        </div>
                    </div>
                </x-card>
            @endforeach
        </div>
    @endif
</div>
