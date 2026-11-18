<header class="sticky top-0 z-30 border-b bg-white/90 backdrop-blur" style="border-color: var(--line)">
    <div class="site-container flex items-center justify-between gap-6 py-4">
        @include('site.partials.logo')
        <nav class="hidden items-center gap-7 md:flex">
            @include('site.partials.menu', ['class' => 'font-semibold'])
            @if ($site->whatsappUrl())<a href="{{ $site->whatsappUrl('Halo, saya mau laundry, bisa jemput?') }}" target="_blank" rel="noopener" class="btn px-5! py-2.5! text-sm whitespace-nowrap">Jemput Cucian</a>@endif
        </nav>
        @include('site.partials.mobile-menu')
    </div>
</header>
