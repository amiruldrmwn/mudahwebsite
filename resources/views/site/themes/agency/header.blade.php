<header class="agency-bar sticky top-0 z-30">
    <div class="site-container flex items-center justify-between gap-6 py-3.5">
        @include('site.partials.logo')
        <nav class="hidden items-center gap-6 lg:flex">
            @include('site.partials.menu', ['class' => 'agency-nav'])
            <a href="{{ url('/kontak') }}" class="agency-go whitespace-nowrap">Mulai Proyek <span aria-hidden="true">&rarr;</span></a>
        </nav>
        @include('site.partials.mobile-menu', ['breakpoint' => 'lg'])
    </div>
</header>
