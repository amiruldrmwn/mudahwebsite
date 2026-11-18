@if ($menu->count() > 1)
    <nav class="bl3-nav mx-auto flex max-w-md flex-wrap justify-center gap-2 px-4 pt-6" aria-label="Menu">
        @include('site.partials.menu', ['class' => 'rounded-full px-4 py-1.5 text-xs font-semibold'])
    </nav>
@endif
