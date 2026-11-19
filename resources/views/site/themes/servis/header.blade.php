<header class="servis-bar sticky top-0 z-30">
    <div class="site-container flex items-center justify-between gap-6 py-4">
        <span class="text-white">@include('site.partials.logo')</span>
        <nav class="hidden items-center gap-7 md:flex">
            @include('site.partials.menu', ['class' => 'font-medium'])
            <a href="{{ $site->whatsappUrl() ?: url('/kontak') }}" class="btn px-5! py-2.5! text-sm whitespace-nowrap">Chat Teknisi</a>
        </nav>
        <span class="text-white">@include('site.partials.mobile-menu')</span>
    </div>
</header>
