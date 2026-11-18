@php($title = preg_replace('/\*(.+?)\*/', '<em>$1</em>', e($d['title'])))
<section id="{{ $sectionId }}" class="sepatu-hero relative overflow-hidden">
    <div class="site-container grid items-center gap-12 py-16 sm:py-24 lg:grid-cols-2">
        <div>
            @if ($d['eyebrow'])<span class="sepatu-chip">👟 {{ $d['eyebrow'] }}</span>@endif
            <h1 class="hero-title mt-5 text-5xl leading-[1.02] sm:text-6xl">{!! $title !!}</h1>
            @if ($d['subtitle'])<p class="muted mt-5 max-w-lg text-lg leading-relaxed">{{ $d['subtitle'] }}</p>@endif
            @include('site.partials.hero-buttons')
        </div>
        @if ($site->image($d['image']))
            <div class="relative mx-auto w-full max-w-lg">
                <div class="sepatu-tilt absolute inset-0"></div>
                <img src="{{ $site->image($d['image']) }}" alt="" class="sepatu-frame relative aspect-square w-full object-cover">
                <span class="sepatu-badge absolute -bottom-4 left-6">✓ Garansi cuci ulang</span>
            </div>
        @endif
    </div>
</section>
