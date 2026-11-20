<section id="{{ $sectionId }}" class="agency-dark relative overflow-hidden">
    <div class="agency-grid agency-grid-dark absolute inset-0" aria-hidden="true"></div>
    <div class="site-container relative py-16 sm:py-24">
        <span class="agency-mono text-sm text-[#d4ff3a]">~/{{ \Illuminate\Support\Str::slug($page?->title ?? '') }}</span>
        <h1 class="mt-4 max-w-4xl text-4xl leading-[1.05] text-white sm:text-6xl">{{ $d['title'] }}</h1>
        @if ($d['subtitle'])<p class="mt-5 max-w-2xl text-lg text-white/70">{{ $d['subtitle'] }}</p>@endif
    </div>
</section>
