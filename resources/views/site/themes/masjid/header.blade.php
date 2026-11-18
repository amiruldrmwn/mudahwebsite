<header class="sticky top-0 z-30 border-b bg-white/95 backdrop-blur" style="border-color: var(--line)">
    <div class="masjid-topbar hidden text-xs sm:block">
        <div class="site-container flex justify-center gap-6 py-2">
            <span>Subuh 04.21</span><span>Dzuhur 11.48</span><span>Ashar 15.10</span><span>Maghrib 17.58</span><span>Isya 19.09</span>
        </div>
    </div>
    <div class="site-container flex items-center justify-between gap-6 py-4">
        @include('site.partials.logo')
        <nav class="hidden items-center gap-7 md:flex">
            @include('site.partials.menu', ['class' => 'font-semibold'])
            <a href="{{ url('/donasi') }}" class="btn px-5! py-2.5! text-sm whitespace-nowrap">Donasi</a>
        </nav>
        @include('site.partials.mobile-menu')
    </div>
</header>
