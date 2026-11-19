@php($title = preg_replace('/\*(.+?)\*/', '<em>$1</em>', e($d['title'])))
{{-- Cream with polka dots, the product photo in a soft blob with a round "halal" sticker. --}}
<section id="{{ $sectionId }}" class="umkm-hero relative overflow-hidden">
    <div class="site-container relative grid items-center gap-12 py-14 sm:py-20 lg:grid-cols-2">
        <div>
            @if ($d['eyebrow'])<span class="umkm-pill">{{ $d['eyebrow'] }}</span>@endif
            <h1 class="hero-title mt-5 text-4xl leading-[1.1] sm:text-6xl">{!! $title !!}</h1>
            @if ($d['subtitle'])<p class="muted mt-5 max-w-lg text-lg leading-relaxed">{{ $d['subtitle'] }}</p>@endif
            @include('site.partials.hero-buttons')
        </div>
        @if ($site->image($d['image']))
            <div class="relative mx-auto w-full max-w-md">
                <img src="{{ $site->image($d['image']) }}" alt="" class="umkm-blob aspect-square w-full object-cover">
                <div class="umkm-sticker absolute -top-2 -right-2 sm:-right-6"><span>100%</span>Halal</div>
                <div class="umkm-chip absolute bottom-6 -left-2 sm:-left-8">★ 4,9 · 5.000+ pesanan</div>
            </div>
        @endif
    </div>
</section>
