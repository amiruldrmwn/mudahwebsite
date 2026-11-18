@php($phone = $site->get('contact_phone') ?: $site->get('whatsapp'))
<header class="sticky top-0 z-30">
    @if ($phone)
        <div class="ac-alert text-xs sm:text-sm">
            <div class="site-container flex items-center justify-center gap-2 py-2 text-center font-semibold">
                <span class="ac-pulse inline-block size-2 rounded-full bg-white"></span>
                AC mati mendadak? Teknisi siap datang hari ini &middot;
                <a href="{{ $site->whatsappUrl('Halo, AC saya bermasalah, butuh teknisi hari ini') ?? 'tel:'.preg_replace('/[^0-9+]/', '', $phone) }}" class="underline underline-offset-2" @if ($site->whatsappUrl()) target="_blank" rel="noopener" @endif>{{ $phone }}</a>
            </div>
        </div>
    @endif
    <div class="border-b bg-white/95 backdrop-blur" style="border-color: var(--line)">
        <div class="site-container flex items-center justify-between gap-6 py-3.5">
            @include('site.partials.logo')
            <nav class="hidden items-center gap-7 md:flex">
                @include('site.partials.menu', ['class' => 'font-semibold'])
                @if ($site->whatsappUrl())<a href="{{ $site->whatsappUrl('Halo, saya ingin memanggil teknisi AC') }}" target="_blank" rel="noopener" class="btn px-5! py-2.5! text-sm">Panggil Teknisi</a>@endif
            </nav>
            @include('site.partials.mobile-menu')
        </div>
    </div>
</header>
