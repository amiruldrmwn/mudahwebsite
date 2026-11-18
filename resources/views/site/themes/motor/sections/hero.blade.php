<section id="{{ $sectionId }}" class="relative overflow-hidden">
    <div class="site-container grid items-center gap-12 py-14 sm:py-20 lg:grid-cols-2">
        <div>
            @if ($d['eyebrow'])<span class="moto-sticker mb-6 inline-block -rotate-2 px-3 py-1 text-sm font-bold">{{ $d['eyebrow'] }}</span>@endif
            <h1 class="text-5xl leading-[0.95] font-bold tracking-tight sm:text-7xl">{{ $d['title'] }}</h1>
            @if ($d['subtitle'])<p class="muted mt-6 max-w-xl text-lg leading-relaxed">{{ $d['subtitle'] }}</p>@endif
            @include('site.partials.hero-buttons')
        </div>
        @if ($site->image($d['image']))
            <div class="relative">
                <img src="{{ $site->image($d['image']) }}" alt="" class="moto-frame aspect-[4/3] w-full rotate-1 object-cover">
                <span class="moto-sticker absolute -top-4 -right-2 rotate-6 px-3 py-1 text-sm font-bold">Helm gratis! 🪖</span>
            </div>
        @endif
    </div>
</section>
