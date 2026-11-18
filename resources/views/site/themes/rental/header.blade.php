<header class="sticky top-0 z-30 bg-white shadow-[0_1px_0_var(--line)]">
    <div class="site-container flex items-center justify-between gap-6 py-3.5">
        @include('site.partials.logo')
        <nav class="hidden items-center gap-7 md:flex">
            @include('site.partials.menu', ['class' => 'font-semibold'])
            @if ($site->whatsappUrl())<a href="{{ $site->whatsappUrl('Halo, saya mau sewa mobil') }}" target="_blank" rel="noopener" class="btn btn-accent px-5! py-2.5! text-sm">Sewa Sekarang</a>@endif
        </nav>
        @include('site.partials.mobile-menu')
    </div>
</header>
