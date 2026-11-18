@php($title = preg_replace('/\*(.+?)\*/', '<em>$1</em>', e($d['title'])))
{{-- Cream hero, the photo framed in a pointed arch like a mihrab. --}}
<section id="{{ $sectionId }}" class="masjid-hero relative overflow-hidden">
    <div class="site-container grid items-center gap-12 py-16 sm:py-24 lg:grid-cols-[1.1fr_1fr]">
        <div>
            @if ($d['eyebrow'])<span class="masjid-eyebrow">{{ $d['eyebrow'] }}</span>@endif
            <h1 class="hero-title mt-4 text-5xl leading-[1.05] sm:text-7xl">{!! $title !!}</h1>
            @if ($d['subtitle'])<p class="muted mt-6 max-w-lg text-lg leading-relaxed">{{ $d['subtitle'] }}</p>@endif
            @include('site.partials.hero-buttons')
        </div>
        @if ($site->image($d['image']))
            <div class="relative mx-auto w-full max-w-sm">
                <div class="masjid-arch-back absolute inset-0"></div>
                <img src="{{ $site->image($d['image']) }}" alt="" class="masjid-arch relative aspect-[3/4] w-full object-cover">
            </div>
        @endif
    </div>
</section>
