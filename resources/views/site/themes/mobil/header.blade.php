<header class="sticky top-0 z-30 border-b bg-white/90 backdrop-blur" style="border-color: var(--line)">
    <div class="site-container flex items-center justify-between gap-6 py-4">
        @include('site.partials.logo')
        <nav class="hidden items-center gap-1 lg:flex">
            @include('site.partials.menu', ['class' => 'rounded-full px-4 py-2 text-sm font-semibold'])
        </nav>
        <div class="hidden items-center gap-2 lg:flex">
            @if ($site->whatsappUrl())
                <a href="{{ $site->whatsappUrl('Halo, saya ingin jadwalkan test drive') }}" target="_blank" rel="noopener" class="btn btn-outline px-5! py-2.5! text-sm">Test Drive</a>
                <a href="{{ $site->whatsappUrl('Halo, saya ingin info harga dan promo mobil') }}" target="_blank" rel="noopener" class="btn px-5! py-2.5! text-sm">Chat Sales</a>
            @endif
        </div>
        @include('site.partials.mobile-menu', ['breakpoint' => 'lg'])
    </div>
</header>
