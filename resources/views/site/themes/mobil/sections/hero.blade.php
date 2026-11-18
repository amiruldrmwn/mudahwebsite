<section id="{{ $sectionId }}" class="relative overflow-hidden bg-[#141416] text-white">
    @if ($site->image($d['image']))
        <img src="{{ $site->image($d['image']) }}" alt="" class="absolute inset-0 h-full w-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-r from-black/85 via-black/55 to-black/10"></div>
    @endif
    <div class="site-container relative py-20 sm:py-28 lg:py-36">
        <div class="max-w-2xl">
            @if ($d['eyebrow'])<span class="mobil-badge">{{ $d['eyebrow'] }}</span>@endif
            <h1 class="hero-title mt-5 text-5xl leading-[0.95] uppercase sm:text-7xl">{{ $d['title'] }}</h1>
            @if ($d['subtitle'])<p class="mt-6 max-w-xl text-lg leading-relaxed text-white/80">{{ $d['subtitle'] }}</p>@endif
            @include('site.partials.hero-buttons', ['secondary' => 'btn-ghost-light'])
        </div>
    </div>
    <div class="relative border-t border-white/10 bg-black/40 backdrop-blur">
        <div class="site-container grid grid-cols-2 gap-px text-sm sm:grid-cols-4">
            @foreach (['Diskon & cashback', 'DP rendah, cicilan ringan', 'Test drive ke rumah', 'Bonus aksesori'] as $perk)
                <div class="flex items-center gap-2 py-4"><span class="mobil-check">✓</span>{{ $perk }}</div>
            @endforeach
        </div>
    </div>
</section>
