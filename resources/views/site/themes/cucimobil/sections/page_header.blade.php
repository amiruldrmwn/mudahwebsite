<section id="{{ $sectionId }}" class="cuci-hero relative overflow-hidden">
    <div class="cuci-streaks absolute inset-0" aria-hidden="true"></div>
    <span class="cuci-bubble cuci-bubble-3" aria-hidden="true"></span>
    <div class="site-container relative py-14 sm:py-20">
        <span class="cuci-chip">{{ $page?->title }}</span>
        <h1 class="hero-title mt-4 max-w-3xl text-4xl text-white sm:text-5xl">{{ $d['title'] }}</h1>
        @if ($d['subtitle'])<p class="mt-4 max-w-2xl text-lg text-slate-300">{{ $d['subtitle'] }}</p>@endif
    </div>
</section>
