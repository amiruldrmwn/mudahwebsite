<div class="kaos-topbar py-2 text-center text-xs font-semibold">
    {{ $site->get('tagline') ?: 'Tanpa minimum order · Jadi dalam 1 hari · Kirim ke seluruh Indonesia' }}
</div>
<header class="sticky top-0 z-30 border-b bg-white/95 backdrop-blur" style="border-color: var(--line)">
    <div class="site-container flex items-center justify-between gap-6 py-4">
        @include('site.partials.logo')
        <nav class="hidden items-center gap-7 md:flex">
            @include('site.partials.menu', ['class' => 'text-sm font-semibold'])
            @if ($site->whatsappUrl())<a href="{{ $site->whatsappUrl('Halo, saya ingin order kaos custom') }}" target="_blank" rel="noopener" class="btn px-5! py-2.5! text-sm whitespace-nowrap">Order Custom</a>@endif
        </nav>
        @include('site.partials.mobile-menu')
    </div>
</header>
