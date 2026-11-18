<header class="sticky top-0 z-30 bg-white/90 backdrop-blur">
    <div class="site-container flex items-center justify-between gap-6 py-4">
        @include('site.partials.logo')
        <nav class="cleaning-nav hidden items-center gap-2 rounded-full p-1.5 md:flex">
            @include('site.partials.menu', ['class' => 'rounded-full px-4 py-2 text-sm font-medium'])
        </nav>
        @if ($site->whatsappUrl())<a href="{{ $site->whatsappUrl('Halo, saya mau pesan jasa bersih rumah.') }}" target="_blank" rel="noopener" class="btn hidden px-5! py-2.5! text-sm whitespace-nowrap md:inline-flex">Pesan Sekarang</a>@endif
        @include('site.partials.mobile-menu')
    </div>
</header>
