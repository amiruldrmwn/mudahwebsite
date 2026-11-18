<section id="{{ $sectionId }}" class="kopi-hero relative overflow-hidden">
    <div class="site-container relative grid items-center gap-10 py-14 sm:py-20 lg:grid-cols-2">
        <div class="relative z-10">
            @if ($d['eyebrow'])<span class="eyebrow">{{ $d['eyebrow'] }}</span>@endif
            <h1 class="kopi-title text-5xl leading-[0.95] font-extrabold sm:text-7xl">{{ $d['title'] }}</h1>
            @if ($d['subtitle'])<p class="muted mt-6 max-w-md text-lg leading-relaxed">{{ $d['subtitle'] }}</p>@endif
            @include('site.partials.hero-buttons')
        </div>
        @if ($site->image($d['image']))
            <div class="relative mx-auto w-full max-w-md">
                <div class="kopi-blob absolute inset-4 rounded-full"></div>
                <img src="{{ $site->image($d['image']) }}" alt="" class="relative aspect-square w-full rounded-full object-cover shadow-2xl ring-8 ring-white">
                <span class="kopi-leaf absolute -top-2 right-6 text-4xl" aria-hidden="true">🌿</span>
                <span class="kopi-leaf absolute bottom-6 -left-3 text-3xl" aria-hidden="true">☕</span>
            </div>
        @endif
    </div>
    {{-- Outlined marquee --}}
    <div class="kopi-marquee overflow-hidden border-t py-3" style="border-color: var(--line)" aria-hidden="true">
        <div class="kopi-marquee-track flex w-max gap-10 whitespace-nowrap">
            @for ($i = 0; $i < 8; $i++)<span>{{ $site->get('site_name') }}</span><span>✦</span>@endfor
        </div>
    </div>
</section>
