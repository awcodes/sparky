<style>
    @media (min-width: {{ $getBreakpoint() }}) {
        .sink-fixed-sidebar__wrapper {
            flex-direction: row;
            flex-wrap: nowrap;
        }

        .sink-fixed-sidebar__sidebar {
            width: {{ $getSidebarWidth() }};
        }
    }
</style>

<div {{ $attributes->merge(['class' => 'sink-fixed-sidebar']) }}>
    <div class="sink-fixed-sidebar__wrapper flex gap-6 flex-col flex-wrap">
        <section aria-label="Main content" class="sink-fixed-sidebar__main flex-1">
            {{ $getChildComponentContainer('main') }}
        </section>
        <section aria-label="Secondary content" class="sink-fixed-sidebar__sidebar w-full">
            {{ $getChildComponentContainer('sidebar') }}
        </section>
    </div>
</div>
