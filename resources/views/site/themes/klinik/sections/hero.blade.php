@php($title = preg_replace('/\*(.+?)\*/', '<em>$1</em>', e($d['title'])))
{{-- Soft blue hero, the photo in a rounded card with a floating "open today" card. --}}
<section id="{{ $sectionId }}" class="klinik-hero relative overflow-hidden">
    <div class="site-container grid items-center gap-12 py-16 sm:py-20 lg:grid-cols-2">
        <div>
            @if ($d['eyebrow'])<span class="klinik-chip">✚ {{ $d['eyebrow'] }}</span>@endif
            <h1 class="hero-title mt-5 text-4xl leading-[1.1] sm:text-6xl">{!! $title !!}</h1>
            @if ($d['subtitle'])<p class="muted mt-5 max-w-lg text-lg leading-relaxed">{{ $d['subtitle'] }}</p>@endif
            @include('site.partials.hero-buttons')
        </div>
        @if ($site->image($d['image']))
            <div class="relative mx-auto w-full max-w-lg">
                <img src="{{ $site->image($d['image']) }}" alt="" class="klinik-photo aspect-[4/3] w-full object-cover">
                <div class="klinik-float absolute -bottom-6 left-4 sm:-left-6">
                    <span class="klinik-dot"></span>
                    <span><strong class="block text-sm">Buka hari ini</strong><span class="muted text-xs">07.00 – 21.00 WIB</span></span>
                </div>
            </div>
        @endif
    </div>
</section>
