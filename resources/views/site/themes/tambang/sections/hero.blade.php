<section id="{{ $sectionId }}" class="relative flex min-h-[72vh] items-center overflow-hidden text-white" style="background: #1c1d21">
    @if ($site->image($d['image']))
        <img src="{{ $site->image($d['image']) }}" alt="" class="absolute inset-0 size-full object-cover">
    @endif
    <div class="absolute inset-0" style="background: linear-gradient(90deg, color-mix(in oklab, var(--brand) 88%, transparent) 0%, color-mix(in oklab, var(--brand) 55%, transparent) 45%, transparent 80%)"></div>
    <div class="site-container relative py-24">
        <div class="max-w-2xl">
            @if ($d['eyebrow'])<span class="mb-5 inline-flex items-center gap-3 text-sm font-bold tracking-[0.2em] uppercase"><span class="mine-hazard inline-block h-2 w-10"></span>{{ $d['eyebrow'] }}</span>@endif
            <h1 class="text-4xl leading-[1.05] font-extrabold sm:text-6xl">{{ $d['title'] }}</h1>
            @if ($d['subtitle'])<p class="mt-6 max-w-xl text-lg leading-relaxed text-white/90">{{ $d['subtitle'] }}</p>@endif
            @include('site.partials.hero-buttons', ['primary' => 'btn-light', 'secondary' => 'btn-ghost-light'])
        </div>
    </div>
</section>
