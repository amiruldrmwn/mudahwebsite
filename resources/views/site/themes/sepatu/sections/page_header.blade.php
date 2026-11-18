<section id="{{ $sectionId }}" class="sepatu-head">
    <div class="site-container py-14 sm:py-20">
        <span class="sepatu-chip">{{ $page?->title }}</span>
        <h1 class="mt-4 max-w-3xl text-4xl sm:text-6xl">{{ $d['title'] }}</h1>
        @if ($d['subtitle'])<p class="mt-4 max-w-2xl text-lg text-white/80">{{ $d['subtitle'] }}</p>@endif
    </div>
</section>
