<header class="gym-bar sticky top-0 z-30">
    <div class="site-container flex items-center justify-between gap-6 py-4">
        @include('site.partials.logo')
        <nav class="hidden items-center gap-8 md:flex">
            @include('site.partials.menu', ['class' => 'text-sm font-semibold tracking-wider uppercase'])
            <a href="{{ url('/kontak') }}" class="btn px-5! py-2.5! text-sm whitespace-nowrap">Free Pass</a>
        </nav>
        @include('site.partials.mobile-menu')
    </div>
</header>
