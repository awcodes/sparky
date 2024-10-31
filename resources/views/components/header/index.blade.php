<header class="sticky top-0 z-10 bg-white shadow-md">
    <x-section :flush="true" class="py-4" :overflow="true">
        <div class="flex items-center justify-between gap-6">
            <a href="{{ route('home') }}" class="flex items-center gap-2">
                @svg('heroicon-s-bolt', 'size-8 text-amber-500') <span class="font-bold text-dominant-600 text-2xl">{{ config('app.name') }}</span>
            </a>
            <div class="flex items-center gap-4">
                <div class="relative lg:hidden">
                    <livewire:menu slug="mobile" />
                </div>
                <div class="hidden lg:block">
                    <livewire:menu slug="main" />
                </div>
                <x-lighting />
            </div>
        </div>
    </x-section>
</header>
