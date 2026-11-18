<header class="sticky top-0 z-30 border-b bg-white/95 backdrop-blur" style="border-color: var(--line)">
    @if ($site->get('contact_phone') || $site->get('contact_email'))
        <div class="lawfirm-topbar hidden text-xs sm:block">
            <div class="site-container flex justify-end gap-6 py-2">
                @if ($site->get('contact_phone'))<span>☎ {{ $site->get('contact_phone') }}</span>@endif
                @if ($site->get('contact_email'))<span>✉ {{ $site->get('contact_email') }}</span>@endif
            </div>
        </div>
    @endif
    <div class="site-container flex items-center justify-between gap-6 py-4">
        @include('site.partials.logo')
        <nav class="hidden items-center gap-8 md:flex">
            @include('site.partials.menu', ['class' => 'text-sm tracking-wide uppercase'])
            <a href="{{ url('/kontak') }}" class="btn px-5! py-2.5! text-sm whitespace-nowrap">Konsultasi</a>
        </nav>
        @include('site.partials.mobile-menu')
    </div>
</header>
