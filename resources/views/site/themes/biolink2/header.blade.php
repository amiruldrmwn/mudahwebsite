@if ($menu->count() > 1)
    <nav class="bl2-nav mx-auto flex max-w-md flex-wrap justify-center gap-2 px-4 pt-6" aria-label="Menu">
        @include('site.partials.menu', ['class' => 'rounded-full px-3 py-1 text-xs font-bold'])
    </nav>
@endif
