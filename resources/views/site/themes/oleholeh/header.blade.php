<header class="sticky top-0 z-30">
    <div class="oleh-strip text-xs font-bold sm:text-sm">
        <div class="site-container flex justify-center gap-6 py-2 text-center">
            <span>PO frozen batch Senin tutup Sabtu 20.00</span>
            <span class="hidden sm:inline">Kirim frozen ke luar kota</span>
            <span class="hidden md:inline">Halal · PIRT</span>
        </div>
    </div>
    <div class="oleh-bar">
        <div class="site-container flex items-center justify-between gap-6 py-4">
            @include('site.partials.logo')
            <nav class="hidden items-center gap-7 md:flex">
                @include('site.partials.menu', ['class' => 'font-semibold'])
                <a href="{{ $site->whatsappUrl('Halo, saya mau pesan') ?: url('/kontak') }}" class="btn px-5! py-2.5! text-sm whitespace-nowrap">Pesan Sekarang</a>
            </nav>
            @include('site.partials.mobile-menu')
        </div>
    </div>
</header>
