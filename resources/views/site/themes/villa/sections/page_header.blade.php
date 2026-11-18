<section id="{{ $sectionId }}" class="relative overflow-hidden text-center text-white" style="background: #2b2118">
    @if ($site->image($d['image']))<img src="{{ $site->image($d['image']) }}" alt="" class="absolute inset-0 size-full object-cover opacity-55">@endif
    <div class="site-container relative py-24 sm:py-32">
        <div class="mb-3 text-xs tracking-[0.4em] uppercase">{{ $page?->title }}</div>
        <h1 class="mx-auto max-w-3xl text-5xl sm:text-6xl">{{ $d['title'] }}</h1>
        @if ($d['subtitle'])<p class="mx-auto mt-4 max-w-2xl text-lg text-white/90">{{ $d['subtitle'] }}</p>@endif
    </div>
</section>
