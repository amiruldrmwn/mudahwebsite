<header class="sticky top-0 z-30">
    <div class="satpam-topbar hidden text-xs sm:block">
        <div class="site-container flex justify-between gap-6 py-2">
            <span>● Control room siaga 24 jam</span>
            @if ($site->get('contact_phone'))<span>Darurat: {{ $site->get('contact_phone') }}</span>@endif
        </div>
    </div>
    <div class="satpam-bar">
        <div class="site-container flex items-center justify-between gap-6 py-4">
            @include('site.partials.logo')
            <nav class="hidden items-center gap-8 md:flex">
                @include('site.partials.menu', ['class' => 'text-sm font-semibold tracking-wider uppercase'])
                <a href="{{ url('/kontak') }}" class="satpam-btn px-5 py-2.5 text-sm whitespace-nowrap">Minta Penawaran</a>
            </nav>
            @include('site.partials.mobile-menu')
        </div>
    </div>
</header>
