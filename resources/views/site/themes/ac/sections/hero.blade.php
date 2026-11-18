@php($phone = $site->get('contact_phone') ?: $site->get('whatsapp'))
<section id="{{ $sectionId }}" class="ac-hero relative overflow-hidden text-white">
    {{-- Airflow lines --}}
    <svg class="pointer-events-none absolute inset-0 size-full opacity-20" viewBox="0 0 1200 600" preserveAspectRatio="none" aria-hidden="true">
        <g fill="none" stroke="#fff" stroke-width="1.5">
            <path d="M-50 120 C 200 60, 400 180, 650 110 S 1050 60, 1250 130"/>
            <path d="M-50 200 C 250 140, 450 260, 700 190 S 1100 140, 1250 210"/>
            <path d="M-50 280 C 200 220, 420 340, 680 270 S 1080 220, 1250 290"/>
            <path d="M-50 360 C 230 300, 460 420, 720 350 S 1120 300, 1250 370"/>
        </g>
    </svg>
    <div class="site-container relative grid items-center gap-12 pt-16 pb-28 lg:grid-cols-2 lg:pt-20">
        <div>
            @if ($d['eyebrow'])<span class="mb-6 inline-flex items-center gap-2 rounded-full bg-white/15 px-4 py-1.5 text-xs font-semibold tracking-wide ring-1 ring-white/25">❄ {{ $d['eyebrow'] }}</span>@endif
            <h1 class="text-4xl leading-[1.08] font-bold sm:text-6xl">{{ $d['title'] }}</h1>
            @if ($d['subtitle'])<p class="mt-6 max-w-xl text-lg leading-relaxed text-white/85">{{ $d['subtitle'] }}</p>@endif
            @include('site.partials.hero-buttons', ['primary' => 'btn-light', 'secondary' => 'btn-ghost-light'])
        </div>
        @if ($site->image($d['image']))
            <div class="relative">
                <img src="{{ $site->image($d['image']) }}" alt="" class="aspect-[4/3] w-full rounded-[2rem] object-cover shadow-2xl ring-8 ring-white/10">
                @if ($phone)
                    <div class="absolute -bottom-6 left-6 flex items-center gap-3 rounded-2xl bg-white px-5 py-4 text-left shadow-xl" style="color: var(--ink)">
                        <span class="flex size-11 items-center justify-center rounded-full text-xl" style="background: var(--brand-soft); color: var(--brand)">☎</span>
                        <span><span class="muted block text-xs">Butuh cepat? Hubungi</span><span class="font-bold">{{ $phone }}</span></span>
                    </div>
                @endif
            </div>
        @endif
    </div>
    {{-- Wave into the next section --}}
    <svg class="absolute bottom-0 left-0 h-12 w-full sm:h-16" viewBox="0 0 1200 80" preserveAspectRatio="none" aria-hidden="true"><path d="M0 40 C 300 90, 600 0, 900 40 S 1200 50, 1200 50 V80 H0Z" fill="var(--surface)"/></svg>
</section>
