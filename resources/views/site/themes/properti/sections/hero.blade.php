<section id="{{ $sectionId }}" class="relative flex min-h-[80vh] items-end overflow-hidden text-white" style="background: var(--brand)">
    @if ($site->image($d['image']))<img src="{{ $site->image($d['image']) }}" alt="" class="absolute inset-0 size-full object-cover">@endif
    <div class="absolute inset-0" style="background: linear-gradient(0deg, color-mix(in oklab, var(--brand) 92%, black) 0%, color-mix(in oklab, var(--brand) 40%, transparent) 55%, transparent 100%)"></div>
    <div class="absolute inset-0" style="background: linear-gradient(90deg, color-mix(in oklab, var(--brand) 70%, transparent) 0%, transparent 60%)"></div>
    <div class="site-container relative grid items-end gap-8 pt-40 pb-16 lg:grid-cols-[1.4fr_1fr]">
        <div>
            @if ($d['eyebrow'])<span class="prop-gold mb-4 inline-block rounded-full bg-black/40 px-4 py-1.5 text-xs font-semibold tracking-[0.25em] uppercase backdrop-blur">{{ $d['eyebrow'] }}</span>@endif
            <h1 class="text-4xl leading-tight sm:text-6xl">{{ $d['title'] }}</h1>
            @if ($d['subtitle'])<p class="mt-5 max-w-xl text-lg leading-relaxed text-white/85">{{ $d['subtitle'] }}</p>@endif
            @include('site.partials.hero-buttons', ['primary' => 'btn-gold', 'secondary' => 'btn-ghost-light'])
        </div>
        <div class="rounded-2xl bg-white/10 p-6 ring-1 ring-white/20 backdrop-blur-md">
            <div class="prop-gold text-xs font-semibold tracking-[0.2em] uppercase">Lokasi Marketing Gallery</div>
            <p class="mt-2 text-sm leading-relaxed text-white/90">{!! nl2br(e($site->get('address') ?: 'Kunjungi marketing gallery kami untuk melihat rumah contoh.')) !!}</p>
            @if ($site->whatsappUrl())<a href="{{ $site->whatsappUrl('Halo, saya ingin info harga dan promo') }}" target="_blank" rel="noopener" class="btn btn-light mt-5 w-full">Minta Info Harga & Promo</a>@endif
        </div>
    </div>
</section>
