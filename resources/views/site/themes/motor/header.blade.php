<header class="sticky top-0 z-30 border-b-[3px] border-black bg-[var(--surface)]">
    <div class="site-container flex items-center justify-between gap-6 py-3">
        @include('site.partials.logo')
        <nav class="hidden items-center gap-6 md:flex">
            @include('site.partials.menu', ['class' => 'font-bold'])
            @if ($site->whatsappUrl())<a href="{{ $site->whatsappUrl('Halo, saya mau sewa motor') }}" target="_blank" rel="noopener" class="btn px-5! py-2! text-sm">Sewa Motor ⚡</a>@endif
        </nav>
        @include('site.partials.mobile-menu')
    </div>
</header>
