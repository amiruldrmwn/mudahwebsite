<header class="tani-bar sticky top-0 z-30">
    <div class="tani-strip text-xs font-semibold sm:text-sm">
        <div class="site-container flex items-center justify-between gap-6 py-2">
            <span class="flex items-center gap-2"><svg viewBox="0 0 24 24" class="size-4 shrink-0 text-[#f2b632]" fill="currentColor" aria-hidden="true"><path d="M12 21c0-7 1.5-11 7-15-6.5.5-9.8 4.3-7 15zM12 21c-.5-5-2.4-8-6.5-9.5.5 4.7 2.8 7.5 6.5 9.5z"/></svg>Panen segar diantar Selasa, Kamis & Sabtu pagi</span>
            @if ($site->get('contact_phone'))<span class="hidden md:inline">Pesan: {{ $site->get('contact_phone') }}</span>@endif
        </div>
    </div>
    <div class="site-container flex items-center justify-between gap-6 py-3.5">
        @include('site.partials.logo')
        <nav class="hidden items-center gap-6 lg:flex">
            @include('site.partials.menu', ['class' => 'font-bold'])
            <a href="{{ $site->whatsappUrl('Halo, saya ingin memesan hasil panen') ?: url('/kontak') }}" class="tani-sun whitespace-nowrap">Pesan Sekarang</a>
        </nav>
        @include('site.partials.mobile-menu', ['breakpoint' => 'lg'])
    </div>
</header>
