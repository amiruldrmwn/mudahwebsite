@php($ppdb = $menu->firstWhere('slug', 'ppdb'))
<header class="sticky top-0 z-30 border-b bg-white/90 backdrop-blur" style="border-color: var(--line)">
    <div class="site-container flex items-center justify-between gap-6 py-3">
        @include('site.partials.logo', ['tagline' => true])
        <nav class="hidden items-center gap-6 lg:flex">
            {{-- The admission page gets the button instead of a menu link. --}}
            @include('site.partials.menu', ['class' => 'whitespace-nowrap', 'menu' => $ppdb ? $menu->reject(fn ($item) => $item->is($ppdb)) : $menu])
            @if ($ppdb)
                <a href="{{ $ppdb->url() }}" class="btn px-5! py-2! text-sm whitespace-nowrap">Daftar {{ $ppdb->title }}</a>
            @elseif ($site->whatsappUrl())
                <a href="{{ $site->whatsappUrl() }}" target="_blank" rel="noopener" class="btn px-5! py-2! text-sm whitespace-nowrap">Hubungi Kami</a>
            @endif
        </nav>
        @include('site.partials.mobile-menu', ['breakpoint' => 'lg'])
    </div>
</header>
