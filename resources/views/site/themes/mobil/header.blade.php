<div class="mobil-topbar hidden py-2 text-[11px] font-semibold tracking-[0.2em] uppercase sm:block">
    <div class="site-container flex items-center justify-between gap-4">
        <span>Penjualan unit · Service resmi · Suku cadang asli · Body &amp; paint</span>
        @if ($site->get('contact_phone'))<a href="tel:{{ preg_replace('/[^\d+]/', '', $site->get('contact_phone')) }}" class="hover:underline">{{ $site->get('contact_phone') }}</a>@endif
    </div>
</div>
<header class="sticky top-0 z-30 bg-white shadow-[0_1px_0_var(--line)]">
    <div class="site-container flex items-center justify-between gap-6 py-3.5">
        @include('site.partials.logo')
        <nav class="hidden items-center gap-7 lg:flex">
            @include('site.partials.menu', ['class' => 'text-sm font-semibold uppercase tracking-wide'])
            @if ($site->whatsappUrl())<a href="{{ $site->whatsappUrl('Halo, saya ingin info harga dan promo mobil') }}" target="_blank" rel="noopener" class="btn px-5! py-2.5! text-sm whitespace-nowrap">Chat Sales</a>@endif
        </nav>
        @include('site.partials.mobile-menu', ['breakpoint' => 'lg'])
    </div>
</header>
{{-- Quick actions pinned to the bottom on phones. --}}
<nav class="mobil-dock fixed inset-x-3 bottom-3 z-40 grid grid-cols-4 rounded-2xl px-2 py-2 text-center text-[11px] font-semibold shadow-2xl lg:hidden" aria-label="Aksi cepat">
    @foreach ($menu->take(3) as $item)
        <a href="{{ $item->url() }}" class="truncate rounded-xl px-1 py-2">{{ $item->title }}</a>
    @endforeach
    @if ($site->whatsappUrl())<a href="{{ $site->whatsappUrl('Halo, saya ingin info harga dan promo mobil') }}" target="_blank" rel="noopener" class="rounded-xl bg-[#25d366] px-1 py-2 text-white">Chat Sales</a>@endif
</nav>
