<header class="instansi-bar sticky top-0 z-30">
    <div class="instansi-gov text-xs">
        <div class="site-container flex items-center justify-between gap-6 py-1.5">
            <span class="flex items-center gap-2"><span class="instansi-flag" aria-hidden="true"></span>Situs resmi pemerintah daerah</span>
            @if ($site->get('contact_phone'))<span class="hidden sm:inline">Pengaduan: <strong>{{ $site->get('contact_phone') }}</strong></span>@endif
        </div>
    </div>
    <div class="site-container flex items-center justify-between gap-6 py-3">
        @include('site.partials.logo', ['tagline' => true])
        <nav class="hidden items-center gap-1 lg:flex">
            @include('site.partials.menu', ['class' => 'instansi-nav'])
        </nav>
        @include('site.partials.mobile-menu', ['breakpoint' => 'lg'])
    </div>
</header>
