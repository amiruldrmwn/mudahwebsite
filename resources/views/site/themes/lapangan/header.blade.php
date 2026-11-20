<header class="lapangan-bar sticky top-0 z-30">
    <div class="site-container flex items-center justify-between gap-6 py-3.5">
        <span class="text-white">@include('site.partials.logo')</span>
        <nav class="hidden items-center gap-7 md:flex">
            @include('site.partials.menu', ['class' => 'font-semibold uppercase tracking-wide'])
            <a href="{{ $site->whatsappUrl('Halo, saya mau booking lapangan') ?: url('/booking') }}" class="btn px-5! py-2.5! text-sm whitespace-nowrap">Booking Lapangan</a>
        </nav>
        <span class="text-white">@include('site.partials.mobile-menu')</span>
    </div>
    <div class="lapangan-ticker text-xs font-bold tracking-wider uppercase">
        <div class="site-container flex justify-center gap-6 py-1.5 sm:justify-between">
            <span>Buka setiap hari 07.00–24.00</span>
            <span class="hidden sm:inline">Booking sampai 7 hari ke depan via WhatsApp</span>
        </div>
    </div>
</header>
