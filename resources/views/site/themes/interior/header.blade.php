<header class="interior-bar sticky top-0 z-30">
    <div class="site-container flex items-center justify-between gap-6 py-5">
        @include('site.partials.logo')
        <nav class="hidden items-center gap-8 lg:flex">
            @include('site.partials.menu', ['class' => 'interior-nav'])
            <a href="{{ url('/kontak') }}" class="btn btn-outline px-5! py-2.5! text-sm whitespace-nowrap">Konsultasi Gratis</a>
        </nav>
        @include('site.partials.mobile-menu', ['breakpoint' => 'lg'])
    </div>
</header>
