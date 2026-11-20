<header class="pajak-bar sticky top-0 z-30">
    <div class="pajak-strip text-xs">
        <div class="site-container flex items-center justify-between gap-6 py-2">
            @include('site.themes.pajak.deadlines', ['mode' => 'bar'])
            @if ($site->get('contact_phone'))<span class="hidden sm:inline">Konsultasi: {{ $site->get('contact_phone') }}</span>@endif
        </div>
    </div>
    <div class="site-container flex items-center justify-between gap-6 py-4">
        @include('site.partials.logo')
        <nav class="hidden items-center gap-7 lg:flex">
            @include('site.partials.menu', ['class' => 'font-medium'])
            <a href="{{ url('/konsultasi') }}" class="btn px-5! py-2.5! text-sm whitespace-nowrap">Booking Konsultasi</a>
        </nav>
        @include('site.partials.mobile-menu', ['breakpoint' => 'lg'])
    </div>
</header>
