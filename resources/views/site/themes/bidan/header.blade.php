<header class="bidan-bar sticky top-0 z-30">
    <div class="bidan-alert text-xs font-semibold sm:text-sm">
        <div class="site-container flex items-center justify-center gap-2 py-2 sm:justify-between">
            <span class="flex items-center gap-2"><span class="bidan-pulse" aria-hidden="true"></span>Siaga persalinan 24 jam, setiap hari</span>
            @if ($site->get('contact_phone'))<a href="tel:{{ preg_replace('/[^0-9+]/', '', $site->get('contact_phone')) }}" class="hidden hover:underline sm:inline">Bidan jaga: {{ $site->get('contact_phone') }}</a>@endif
        </div>
    </div>
    <div class="site-container flex items-center justify-between gap-6 py-4">
        @include('site.partials.logo')
        <nav class="hidden items-center gap-6 lg:flex">
            @include('site.partials.menu', ['class' => 'font-semibold'])
            <a href="{{ $site->whatsappUrl('Halo, saya ingin daftar periksa') ?: url('/kontak') }}" class="btn px-5! py-2.5! text-sm whitespace-nowrap">Daftar Periksa</a>
        </nav>
        @include('site.partials.mobile-menu', ['breakpoint' => 'lg'])
    </div>
</header>
