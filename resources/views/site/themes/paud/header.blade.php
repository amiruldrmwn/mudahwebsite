<header class="paud-bar sticky top-0 z-30">
    <div class="site-container flex items-center justify-between gap-6 py-4">
        @include('site.partials.logo')
        <nav class="hidden items-center gap-6 md:flex">
            @include('site.partials.menu', ['class' => 'font-bold'])
            <a href="{{ url('/pendaftaran') }}" class="btn px-5! py-2.5! text-sm whitespace-nowrap">Daftar</a>
        </nav>
        @include('site.partials.mobile-menu')
    </div>
</header>
