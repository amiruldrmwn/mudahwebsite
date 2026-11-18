<header class="sticky top-0 z-30 border-b bg-[var(--surface)]/95 backdrop-blur" style="border-color: var(--line)">
    <div class="site-container flex items-center justify-between gap-6 py-4">
        @include('site.partials.logo')
        <nav class="hidden items-center gap-8 md:flex">
            @include('site.partials.menu', ['class' => 'text-sm tracking-[0.12em] uppercase'])
            @if ($site->whatsappUrl())<a href="{{ $site->whatsappUrl('Halo, saya ingin cek ketersediaan villa') }}" target="_blank" rel="noopener" class="btn px-5! py-2.5! text-sm tracking-wide">Cek Ketersediaan</a>@endif
        </nav>
        @include('site.partials.mobile-menu')
    </div>
</header>
