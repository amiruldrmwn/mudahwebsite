<header class="sticky top-0 z-30 bg-white shadow-[0_1px_0_var(--line)]">
    <div class="site-container flex items-center justify-between gap-6 py-3">
        @include('site.partials.logo')
        <nav class="hidden items-center gap-1 lg:flex">
            @include('site.partials.menu', ['class' => 'mine-nav whitespace-nowrap px-3 py-2 font-semibold'])
            @if ($site->whatsappUrl())<a href="{{ $site->whatsappUrl() }}" target="_blank" rel="noopener" class="btn ml-3 px-5! py-2! text-sm">Hubungi Kami</a>@endif
        </nav>
        @include('site.partials.mobile-menu', ['breakpoint' => 'lg'])
    </div>
    <div class="mine-hazard h-1"></div>
</header>
