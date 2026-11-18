<header class="sticky top-0 z-30 py-3" style="background: color-mix(in oklab, var(--brand) 96%, black)">
    <div class="site-container flex items-center justify-between gap-6">
        <span class="text-white">@include('site.partials.logo')</span>
        <nav class="hidden items-center gap-1 rounded-full border p-1 lg:flex" style="border-color: rgb(255 255 255 / .12); background: rgb(255 255 255 / .05)">
            @include('site.partials.menu', ['class' => 'umroh-nav whitespace-nowrap rounded-full px-4 py-2'])
        </nav>
        @if ($site->whatsappUrl())
            <a href="{{ $site->whatsappUrl('Halo, saya ingin konsultasi paket umroh') }}" target="_blank" rel="noopener" class="btn btn-accent hidden px-5! py-2! text-sm whitespace-nowrap lg:inline-flex">Konsultasi</a>
        @endif
        <span class="text-white">@include('site.partials.mobile-menu', ['breakpoint' => 'lg'])</span>
    </div>
</header>
