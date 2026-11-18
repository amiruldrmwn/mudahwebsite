<header class="sticky top-0 z-30">
    @if ($site->get('tagline'))
        <div class="kopi-bar text-center text-xs font-semibold sm:text-sm">
            <div class="site-container py-2"><span aria-hidden="true">☕</span>&nbsp; {{ $site->get('tagline') }}</div>
        </div>
    @endif
    <div class="border-b bg-white/95 backdrop-blur" style="border-color: var(--line)">
        <div class="site-container flex items-center justify-between gap-6 py-3.5">
            @include('site.partials.logo')
            <nav class="hidden items-center gap-7 md:flex">
                @include('site.partials.menu', ['class' => 'font-semibold'])
                @if ($site->whatsappUrl())<a href="{{ $site->whatsappUrl('Halo, saya mau pesan kopi') }}" target="_blank" rel="noopener" class="btn btn-outline px-5! py-2! text-sm">Pesan Sekarang</a>@endif
            </nav>
            @include('site.partials.mobile-menu')
        </div>
    </div>
</header>
