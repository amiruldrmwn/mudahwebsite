<header class="kos-bar sticky top-0 z-30">
    <div class="kos-strip text-xs font-semibold">
        <div class="site-container flex items-center justify-center gap-2 py-2 sm:justify-between">
            <span class="flex items-center gap-2"><span class="kos-dot"></span>Kamar kosong tersedia · Survei setiap hari 08.00–20.00</span>
            @if ($site->get('contact_phone'))<span class="hidden sm:inline">Ibu kos: {{ $site->get('contact_phone') }}</span>@endif
        </div>
    </div>
    <div class="site-container flex items-center justify-between gap-6 py-3.5">
        @include('site.partials.logo')
        <nav class="hidden items-center gap-7 md:flex">
            @include('site.partials.menu', ['class' => 'font-semibold'])
            <a href="{{ $site->whatsappUrl('Halo, saya mau tanya kamar kosong') ?: url('/lokasi') }}" class="btn px-5! py-2.5! text-sm whitespace-nowrap">Tanya Kamar Kosong</a>
        </nav>
        @include('site.partials.mobile-menu')
    </div>
</header>
