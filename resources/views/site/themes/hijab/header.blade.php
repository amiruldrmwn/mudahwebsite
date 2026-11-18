@if ($site->get('tagline'))
    <div class="hijab-promo py-2 text-center text-[11px] tracking-[0.25em] uppercase">{{ $site->get('tagline') }}</div>
@endif
<header class="sticky top-0 z-30 border-b bg-[var(--surface)]/95 backdrop-blur" style="border-color: var(--line)">
    <div class="site-container grid grid-cols-[1fr_auto_1fr] items-center gap-4 py-5">
        <nav class="hidden items-center gap-7 lg:flex">
            @include('site.partials.menu', ['class' => 'text-[11px] tracking-[0.22em] uppercase'])
        </nav>
        <div class="lg:hidden">@include('site.partials.mobile-menu', ['breakpoint' => 'lg'])</div>
        <div class="hijab-logo justify-self-center">@include('site.partials.logo')</div>
        <div class="flex items-center justify-end gap-4">
            @if ($site->whatsappUrl())<a href="{{ $site->whatsappUrl('Halo, saya ingin bertanya tentang koleksi terbaru') }}" target="_blank" rel="noopener" class="hidden text-[11px] tracking-[0.22em] uppercase underline-offset-4 hover:underline sm:inline">Belanja via WhatsApp</a>@endif
        </div>
    </div>
</header>
