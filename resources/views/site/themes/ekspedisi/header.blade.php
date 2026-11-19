<header class="sticky top-0 z-30 border-b bg-white" style="border-color: var(--line)">
    <div class="ekspedisi-topbar hidden text-xs font-semibold sm:block">
        <div class="site-container flex justify-between gap-6 py-2">
            <span>Layanan 24 jam · Lacak kiriman lewat WhatsApp</span>
            @if ($site->get('contact_phone'))<span>Hotline {{ $site->get('contact_phone') }}</span>@endif
        </div>
    </div>
    <div class="site-container flex items-center justify-between gap-6 py-4">
        @include('site.partials.logo')
        <nav class="hidden items-center gap-7 md:flex">
            @include('site.partials.menu', ['class' => 'font-semibold'])
            <a href="{{ url('/tarif') }}" class="btn px-5! py-2.5! text-sm whitespace-nowrap">Cek Tarif</a>
        </nav>
        @include('site.partials.mobile-menu')
    </div>
</header>
