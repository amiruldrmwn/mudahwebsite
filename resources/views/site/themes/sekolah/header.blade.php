@php($spmb = $menu->firstWhere('slug', 'spmb'))
<header class="sticky top-0 z-30 border-b bg-white/95 backdrop-blur" style="border-color: var(--line)">
    <div class="h-1" style="background: var(--brand)"></div>
    <div class="site-container flex items-center justify-between gap-6 py-3">
        @include('site.partials.logo', ['tagline' => true])
        <nav class="hidden items-center gap-5 lg:flex">
            {{-- The registration page gets the button instead of a menu link. --}}
            @include('site.partials.menu', ['class' => 'font-semibold whitespace-nowrap', 'menu' => $spmb ? $menu->reject(fn ($item) => $item->is($spmb)) : $menu])
            @if ($spmb)
                <a href="{{ $spmb->url() }}" class="btn px-5! py-2! text-sm whitespace-nowrap">Daftar {{ $spmb->title }}</a>
            @elseif ($site->whatsappUrl())
                <a href="{{ $site->whatsappUrl() }}" target="_blank" rel="noopener" class="btn px-5! py-2! text-sm whitespace-nowrap">Hubungi Kami</a>
            @endif
        </nav>
        @include('site.partials.mobile-menu', ['breakpoint' => 'lg'])
    </div>
</header>
