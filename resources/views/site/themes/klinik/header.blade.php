<header class="sticky top-0 z-30 border-b bg-white/95 backdrop-blur" style="border-color: var(--line)">
    <div class="klinik-topbar hidden text-xs sm:block">
        <div class="site-container flex justify-between gap-6 py-2">
            <span>Buka setiap hari 07.00–21.00 · Melayani BPJS</span>
            @if ($site->get('contact_phone'))<span>☎ {{ $site->get('contact_phone') }}</span>@endif
        </div>
    </div>
    <div class="site-container flex items-center justify-between gap-6 py-4">
        @include('site.partials.logo')
        <nav class="hidden items-center gap-7 md:flex">
            @include('site.partials.menu', ['class' => 'font-medium'])
            <a href="{{ url('/pendaftaran') }}" class="btn px-5! py-2.5! text-sm whitespace-nowrap">Daftar Berobat</a>
        </nav>
        @include('site.partials.mobile-menu')
    </div>
</header>
