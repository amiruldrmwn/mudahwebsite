<section id="{{ $sectionId }}" class="relative overflow-hidden text-white" style="background: var(--brand)">
    @if ($site->image($d['image']))<img src="{{ $site->image($d['image']) }}" alt="" class="absolute inset-0 size-full object-cover opacity-40">@endif
    <div class="site-container relative py-20 sm:py-28">
        <span class="prop-gold mb-3 block text-sm font-semibold tracking-[0.25em] uppercase">{{ $page?->title }}</span>
        <h1 class="max-w-3xl text-4xl sm:text-5xl">{{ $d['title'] }}</h1>
        @if ($d['subtitle'])<p class="mt-4 max-w-2xl text-lg text-white/85">{{ $d['subtitle'] }}</p>@endif
    </div>
</section>
