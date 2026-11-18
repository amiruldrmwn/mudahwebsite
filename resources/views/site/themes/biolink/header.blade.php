<header class="bio-header mx-auto flex max-w-2xl items-center justify-between gap-4 px-4 pt-6 sm:px-0">
    @include('site.partials.logo')
    @if ($menu->count() > 1)
        <nav class="hidden items-center gap-1 rounded-full bg-white p-1 text-sm shadow-sm sm:flex">
            @include('site.partials.menu', ['class' => 'rounded-full px-3 py-1.5 font-medium'])
        </nav>
        <div class="sm:hidden">@include('site.partials.mobile-menu', ['breakpoint' => 'md'])</div>
    @endif
</header>
