<header class="emas-bar sticky top-0 z-30">
    <div class="site-container flex items-center justify-between gap-6 py-4">
        <span class="text-white">@include('site.partials.logo')</span>
        <nav class="hidden items-center gap-7 md:flex">
            @include('site.partials.menu', ['class' => 'font-medium'])
            <a href="{{ url('/harga') }}" class="emas-pricebtn whitespace-nowrap"><span class="emas-dot" aria-hidden="true"></span>Harga Hari Ini</a>
        </nav>
        <span class="text-white">@include('site.partials.mobile-menu')</span>
    </div>
</header>
