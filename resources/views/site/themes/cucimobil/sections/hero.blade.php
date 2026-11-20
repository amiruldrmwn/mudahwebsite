@php($title = preg_replace('/\*(.+?)\*/', '<em>$1</em>', e($d['title'])))
{{-- Graphite hero with light streaks and soap bubbles; the photo is a before/after slider (the "before" side is the same photo, dulled). --}}
<section id="{{ $sectionId }}" class="cuci-hero relative overflow-hidden">
    <div class="cuci-streaks absolute inset-0" aria-hidden="true"></div>
    <span class="cuci-bubble cuci-bubble-1" aria-hidden="true"></span><span class="cuci-bubble cuci-bubble-2" aria-hidden="true"></span><span class="cuci-bubble cuci-bubble-3" aria-hidden="true"></span>
    <div class="site-container relative grid items-center gap-12 py-14 sm:py-20 lg:grid-cols-[1fr_1.1fr]">
        <div>
            @if ($d['eyebrow'])<span class="cuci-chip">{{ $d['eyebrow'] }}</span>@endif
            <h1 class="hero-title mt-5 text-4xl leading-[1.02] text-white sm:text-6xl">{!! $title !!}</h1>
            @if ($d['subtitle'])<p class="mt-6 max-w-lg text-lg leading-relaxed text-slate-300">{{ $d['subtitle'] }}</p>@endif
            @include('site.partials.hero-buttons', ['secondary' => 'cuci-ghost'])
            <div class="mt-9 flex flex-wrap gap-2 text-xs font-semibold text-slate-300" aria-label="Ukuran mobil">
                <span class="cuci-size">City car</span><span class="cuci-size">Sedan</span><span class="cuci-size">SUV / MPV</span>
            </div>
        </div>
        @if ($site->image($d['image']))
            <div class="cuci-compare relative mx-auto aspect-[4/3] w-full max-w-xl" style="--pos: 50%">
                <img src="{{ $site->image($d['image']) }}" alt="Mobil sesudah dicuci" class="absolute inset-0 size-full object-cover">
                <div class="cuci-before absolute inset-0" aria-hidden="true"><img src="{{ $site->image($d['image']) }}" alt="" class="size-full object-cover"></div>
                <span class="cuci-handle" aria-hidden="true"></span>
                <span class="cuci-label left-3">Sebelum</span><span class="cuci-label right-3">Sesudah</span>
                <input type="range" min="0" max="100" value="50" class="cuci-range" aria-label="Geser untuk membandingkan sebelum dan sesudah" oninput="this.parentNode.style.setProperty('--pos', this.value + '%')">
            </div>
        @endif
    </div>
</section>
