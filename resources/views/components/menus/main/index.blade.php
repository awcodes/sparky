@props([
    'name' => null,
    'items' => [],
])

<nav id="main-menu">
    <ul class="flex items-center">
        @foreach ($items as $item)
            <x-menus.main.item :item="$item" />
        @endforeach
    </ul>
</nav>
