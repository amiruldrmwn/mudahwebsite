<section id="{{ $sectionId }}" class="relative overflow-hidden">
    <div class="site-container grid items-center gap-12 py-14 sm:py-20 lg:grid-cols-2">
        <div>
            @if ($d['eyebrow'])<span class="eyebrow">{{ $d['eyebrow'] }}</span>@endif
            <h1 class="text-5xl leading-[1.05] sm:text-7xl" style="color: var(--brand)">{{ $d['title'] }}</h1>
            @if ($d['subtitle'])<p class="muted mt-6 max-w-lg text-lg leading-relaxed">{{ $d['subtitle'] }}</p>@endif
            @include('site.partials.hero-buttons')
        </div>
        @if ($site->image($d['image']))
            <div class="relative mx-auto w-full max-w-lg">
                <div class="absolute -inset-3 rounded-t-full border-2 border-dashed" style="border-color: color-mix(in oklab, var(--brand) 35%, transparent)"></div>
                <img src="{{ $site->image($d['image']) }}" alt="" class="relative aspect-[4/5] w-full rounded-t-full object-cover shadow-xl">
            </div>
        @endif
    </div>
</section>
