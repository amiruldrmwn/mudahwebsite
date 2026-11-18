<section id="{{ $sectionId }}" class="relative overflow-hidden" style="background: #0b0b0d">
    @if ($site->image($d['image']))
        <img src="{{ $site->image($d['image']) }}" alt="" class="absolute inset-0 size-full object-cover opacity-35">
    @endif
    <div class="site-container relative py-20 text-white sm:py-28">
        <span class="mb-3 block text-sm font-semibold tracking-[0.3em] uppercase" style="color: var(--brand)">{{ $page?->title }}</span>
        <h1 class="barber-display text-6xl leading-none sm:text-8xl">{{ $d['title'] }}</h1>
        @if ($d['subtitle'])<p class="mt-4 max-w-2xl text-lg text-white/70">{{ $d['subtitle'] }}</p>@endif
    </div>
    <div class="barber-pole relative h-1.5"></div>
</section>
