<section id="{{ $sectionId }}" class="dent-hero relative overflow-hidden">
    <div class="site-container grid items-center gap-12 py-14 sm:py-20 lg:grid-cols-2">
        <div>
            @if ($d['eyebrow'])<span class="eyebrow">{{ $d['eyebrow'] }}</span>@endif
            <h1 class="text-4xl leading-[1.1] font-semibold sm:text-6xl">{{ $d['title'] }}</h1>
            @if ($d['subtitle'])<p class="muted mt-6 max-w-xl text-lg leading-relaxed">{{ $d['subtitle'] }}</p>@endif
            @include('site.partials.hero-buttons')
        </div>
        @if ($site->image($d['image']))
            <div class="relative">
                <img src="{{ $site->image($d['image']) }}" alt="" class="dent-blob aspect-square w-full object-cover shadow-xl">
                @if ($site->whatsappUrl())
                    <a href="{{ $site->whatsappUrl('Halo, saya ingin booking jadwal periksa gigi') }}" target="_blank" rel="noopener" class="absolute bottom-6 -left-2 flex items-center gap-3 rounded-2xl bg-white px-4 py-3 shadow-xl sm:-left-6">
                        <span class="flex size-10 items-center justify-center rounded-full text-lg" style="background: var(--brand-soft)">📅</span>
                        <span class="text-sm"><span class="block font-semibold">Booking online</span><span class="muted text-xs">Konfirmasi cepat via WhatsApp</span></span>
                    </a>
                @endif
            </div>
        @endif
    </div>
</section>
