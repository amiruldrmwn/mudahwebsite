<header class="sticky top-0 z-30 bg-white/95 shadow-[0_1px_0_var(--line)] backdrop-blur">
    <div class="site-container flex items-center justify-between gap-6 py-3.5">
        @include('site.partials.logo')
        <nav class="hidden items-center gap-7 md:flex">
            @include('site.partials.menu', ['class' => 'font-medium'])
            @if ($site->whatsappUrl())<a href="{{ $site->whatsappUrl('Halo, saya ingin jadwalkan survei lokasi') }}" target="_blank" rel="noopener" class="btn px-5! py-2.5! text-sm">Jadwalkan Survei</a>@endif
        </nav>
        @include('site.partials.mobile-menu')
    </div>
</header>
