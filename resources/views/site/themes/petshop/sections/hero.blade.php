@php($title = preg_replace('/\*(.+?)\*/', '<em>$1</em>', e($d['title'])))
<section id="{{ $sectionId }}" class="pet-hero relative overflow-hidden">
    <div class="site-container grid items-center gap-12 py-16 sm:py-24 lg:grid-cols-2">
        <div>
            @if ($d['eyebrow'])<span class="pet-chip">🐾 {{ $d['eyebrow'] }}</span>@endif
            <h1 class="hero-title mt-5 text-5xl leading-[1.05] sm:text-6xl">{!! $title !!}</h1>
            @if ($d['subtitle'])<p class="muted mt-5 max-w-lg text-lg leading-relaxed">{{ $d['subtitle'] }}</p>@endif
            @include('site.partials.hero-buttons')
        </div>
        @if ($site->image($d['image']))
            <div class="relative mx-auto w-full max-w-md">
                <span class="pet-blob-bg absolute inset-0 -rotate-6"></span>
                <img src="{{ $site->image($d['image']) }}" alt="" class="pet-blob relative aspect-square w-full object-cover">
                <span class="absolute -bottom-3 right-4 rounded-full bg-white px-4 py-2 text-sm font-semibold shadow-lg">❤️ 3.000+ anabul bahagia</span>
            </div>
        @endif
    </div>
</section>
