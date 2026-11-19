<header class="caleg-bar sticky top-0 z-30">
    <div class="site-container flex items-center justify-between gap-6 py-3">
        <span class="text-white">@include('site.partials.logo')</span>
        <nav class="hidden items-center gap-7 md:flex">
            @include('site.partials.menu', ['class' => 'text-sm font-bold tracking-wide uppercase'])
            <a href="{{ url('/relawan') }}" class="btn px-5! py-2.5! text-sm whitespace-nowrap">Jadi Relawan</a>
        </nav>
        <span class="text-white">@include('site.partials.mobile-menu')</span>
    </div>
</header>
