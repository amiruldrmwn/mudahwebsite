<header class="sticky top-0 z-30 bg-white/80 backdrop-blur">
    <div class="site-container flex items-center justify-between gap-6 py-5">
        @include('site.partials.logo')
        <nav class="hidden items-center gap-8 md:flex">
            @include('site.partials.menu', ['class' => 'text-sm'])
            <a href="{{ url('/kontak') }}" class="cv-link text-sm font-medium">Hubungi saya →</a>
        </nav>
        @include('site.partials.mobile-menu')
    </div>
</header>
