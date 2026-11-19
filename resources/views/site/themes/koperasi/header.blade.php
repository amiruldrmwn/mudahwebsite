<header class="sticky top-0 z-30 border-b bg-white" style="border-color: var(--line)">
    <div class="koperasi-topbar hidden text-xs font-semibold sm:block">
        <div class="site-container flex justify-between gap-6 py-2">
            <span>Badan hukum resmi · Diawasi Dinas Koperasi</span>
            @if ($site->get('contact_phone'))<span>Layanan anggota: {{ $site->get('contact_phone') }}</span>@endif
        </div>
    </div>
    <div class="site-container flex items-center justify-between gap-6 py-4">
        @include('site.partials.logo')
        <nav class="hidden items-center gap-7 md:flex">
            @include('site.partials.menu', ['class' => 'font-semibold'])
            <a href="{{ url('/keanggotaan') }}" class="btn px-5! py-2.5! text-sm whitespace-nowrap">Jadi Anggota</a>
        </nav>
        @include('site.partials.mobile-menu')
    </div>
</header>
