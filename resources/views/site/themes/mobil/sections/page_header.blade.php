<section id="{{ $sectionId }}" class="relative overflow-hidden bg-[#141416] text-white">
    <div class="mobil-stripe pointer-events-none absolute inset-y-0 right-0 w-1/3" aria-hidden="true"></div>
    <div class="site-container relative py-14 sm:py-20">
        <span class="mobil-badge">{{ $page?->title }}</span>
        <h1 class="mt-4 text-5xl uppercase sm:text-6xl">{{ $d['title'] }}</h1>
        @if ($d['subtitle'])<p class="mt-4 max-w-2xl text-lg text-white/75">{{ $d['subtitle'] }}</p>@endif
    </div>
</section>
