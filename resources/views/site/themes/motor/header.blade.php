<header class="sticky top-0 z-30 px-3 pt-3">
    <div class="site-container motor-bar flex items-center justify-between gap-6 rounded-full py-2.5 pr-2.5! pl-5!">
        @include('site.partials.logo')
        <nav class="hidden items-center gap-6 md:flex">
            @include('site.partials.menu', ['class' => 'text-sm font-semibold'])
            @if ($site->whatsappUrl())<a href="{{ $site->whatsappUrl('Halo, saya mau sewa motor') }}" target="_blank" rel="noopener" class="btn px-5! py-2.5! text-sm">Sewa Sekarang</a>@endif
        </nav>
        @include('site.partials.mobile-menu')
    </div>
</header>
