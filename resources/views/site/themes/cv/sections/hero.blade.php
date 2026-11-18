@php($title = preg_replace('/\*(.+?)\*/', '<em>$1</em>', e($d['title'])))
{{-- Personal intro: big serif statement, a round portrait with an "available" badge. --}}
<section id="{{ $sectionId }}" class="cv-hero">
    <div class="site-container grid items-center gap-10 py-16 sm:py-24 lg:grid-cols-[1.4fr_1fr]">
        <div class="order-2 lg:order-1">
            @if ($d['eyebrow'])<p class="cv-eyebrow">{{ $d['eyebrow'] }}</p>@endif
            <h1 class="hero-title mt-4 text-4xl leading-[1.1] sm:text-6xl">{!! $title !!}</h1>
            @if ($d['subtitle'])<p class="muted mt-6 max-w-xl text-lg leading-relaxed">{{ $d['subtitle'] }}</p>@endif
            @include('site.partials.hero-buttons')
        </div>
        @if ($site->image($d['image']))
            <div class="relative order-1 mx-auto w-56 sm:w-72 lg:order-2">
                <img src="{{ $site->image($d['image']) }}" alt="" class="cv-photo aspect-square w-full rounded-full object-cover">
                <span class="cv-badge absolute bottom-3 -left-2"><span class="cv-dot"></span> Tersedia untuk proyek</span>
            </div>
        @endif
    </div>
</section>
