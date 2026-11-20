<section id="{{ $sectionId }}" class="lapangan-hero relative overflow-hidden">
    @include('site.themes.lapangan.court')
    <div class="site-container relative py-14 sm:py-20">
        <span class="lapangan-chip">{{ $page?->title }}</span>
        <h1 class="hero-title mt-4 max-w-3xl text-5xl leading-[.95] text-white sm:text-6xl">{{ $d['title'] }}</h1>
        @if ($d['subtitle'])<p class="mt-4 max-w-2xl text-lg text-white/80">{{ $d['subtitle'] }}</p>@endif
    </div>
</section>
