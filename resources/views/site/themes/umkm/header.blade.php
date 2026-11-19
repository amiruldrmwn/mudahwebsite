<header class="sticky top-0 z-30">
    <div class="umkm-announce text-center text-xs font-semibold sm:text-sm">
        <div class="site-container py-2">Gratis ongkir min. Rp200rb · Halal · Tanpa pengawet</div>
    </div>
    <div class="umkm-bar">
        <div class="site-container flex items-center justify-between gap-6 py-4">
            @include('site.partials.logo')
            <nav class="hidden items-center gap-7 md:flex">
                @include('site.partials.menu', ['class' => 'font-semibold'])
                <a href="{{ $site->whatsappUrl() ?: url('/kontak') }}" class="btn px-5! py-2.5! text-sm whitespace-nowrap">Pesan Sekarang</a>
            </nav>
            @include('site.partials.mobile-menu')
        </div>
    </div>
</header>
