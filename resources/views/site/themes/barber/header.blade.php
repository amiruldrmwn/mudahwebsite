@php($phone = $site->get('contact_phone') ?: $site->get('whatsapp'))
<header class="sticky top-0 z-30" style="background: #0b0b0d">
    @if ($phone || $site->get('address'))
        <div class="hidden border-b text-xs text-white/60 sm:block" style="border-color: rgb(255 255 255 / .08)">
            <div class="site-container flex items-center justify-between gap-6 py-2">
                @if ($site->get('address'))<span class="truncate">📍 {{ \Illuminate\Support\Str::limit(str_replace("\n", ', ', $site->get('address')), 80) }}</span>@else<span></span>@endif
                @if ($phone)<span class="shrink-0">📞 {{ $phone }}</span>@endif
            </div>
        </div>
    @endif
    <div class="site-container flex items-center justify-between gap-6 py-4 text-white">
        @include('site.partials.logo')
        <nav class="hidden items-center gap-8 md:flex">
            @include('site.partials.menu', ['class' => 'barber-nav tracking-[0.15em] uppercase text-sm'])
            @if ($site->whatsappUrl())<a href="{{ $site->whatsappUrl('Halo, saya mau booking potong rambut') }}" target="_blank" rel="noopener" class="btn px-6! py-2.5! text-sm">Booking</a>@endif
        </nav>
        @include('site.partials.mobile-menu')
    </div>
    <div class="barber-pole h-1.5"></div>
</header>
