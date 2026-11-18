<header class="sticky top-0 z-30">
    <div class="bangunan-topbar hidden text-xs font-bold sm:block">
        <div class="site-container flex justify-between gap-6 py-2">
            <span>🚚 Gratis ongkir radius 5 km</span>
            @if ($site->get('contact_phone'))<span>Order: {{ $site->get('contact_phone') }}</span>@endif
        </div>
    </div>
    <div class="border-b bg-white" style="border-color: var(--line)">
        <div class="site-container flex items-center justify-between gap-6 py-4">
            @include('site.partials.logo')
            <nav class="hidden items-center gap-7 md:flex">
                @include('site.partials.menu', ['class' => 'font-bold'])
                <a href="{{ url('/produk') }}" class="btn px-5! py-2.5! text-sm whitespace-nowrap">Cek Harga</a>
            </nav>
            @include('site.partials.mobile-menu')
        </div>
    </div>
</header>
