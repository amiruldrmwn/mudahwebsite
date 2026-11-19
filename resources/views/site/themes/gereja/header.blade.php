<header class="gereja-bar sticky top-0 z-30">
    <div class="site-container flex items-center justify-between gap-6 py-4">
        @include('site.partials.logo')
        <nav class="hidden items-center gap-7 md:flex">
            @include('site.partials.menu', ['class' => 'text-sm font-semibold tracking-wide uppercase'])
        </nav>
        @include('site.partials.mobile-menu')
    </div>
</header>
