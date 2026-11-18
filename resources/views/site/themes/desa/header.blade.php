<header class="sticky top-0 z-30 bg-white shadow-sm">
    <div class="desa-flag h-1.5"></div>
    <div class="site-container flex items-center justify-between gap-6 py-3">
        <div class="flex items-center gap-3">
            @include('site.partials.logo')
        </div>
        @include('site.partials.mobile-menu')
        <a href="{{ url('/layanan') }}" class="btn hidden px-5! py-2.5! text-sm whitespace-nowrap md:inline-flex">Layanan Warga</a>
    </div>
    <nav class="desa-nav hidden md:block">
        <div class="site-container flex gap-1">
            @include('site.partials.menu', ['class' => 'px-4 py-3 text-sm font-semibold'])
        </div>
    </nav>
</header>
