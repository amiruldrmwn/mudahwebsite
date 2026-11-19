<header class="desa2-bar sticky top-0 z-30">
    <div class="site-container flex items-center justify-between gap-6 py-3">
        <span class="text-white">@include('site.partials.logo')</span>
        <nav class="hidden items-center gap-6 md:flex">
            @include('site.partials.menu', ['class' => 'text-sm font-semibold text-white/85 hover:text-white'])
        </nav>
        <span class="text-white">@include('site.partials.mobile-menu')</span>
    </div>
</header>
