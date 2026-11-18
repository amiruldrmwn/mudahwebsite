<section id="{{ $sectionId }}" class="gym-hero relative overflow-hidden">
    @if ($site->image($d['image']))<img src="{{ $site->image($d['image']) }}" alt="" class="absolute inset-0 size-full object-cover opacity-35">@endif
    <div class="site-container relative py-16 sm:py-24">
        <span class="gym-tag">{{ $page?->title }}</span>
        <h1 class="mt-4 text-6xl text-white uppercase sm:text-8xl">{{ $d['title'] }}</h1>
        @if ($d['subtitle'])<p class="mt-3 max-w-2xl text-lg text-white/75">{{ $d['subtitle'] }}</p>@endif
    </div>
</section>
