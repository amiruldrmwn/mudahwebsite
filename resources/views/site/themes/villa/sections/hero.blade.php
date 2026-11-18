<section id="{{ $sectionId }}" class="relative flex min-h-[88vh] items-center justify-center overflow-hidden text-center text-white" style="background: #2b2118">
    @if ($site->image($d['image']))<img src="{{ $site->image($d['image']) }}" alt="" class="absolute inset-0 size-full object-cover">@endif
    <div class="absolute inset-0" style="background: rgb(30 22 14 / .45)"></div>
    <div class="pointer-events-none absolute inset-5 border border-white/40 sm:inset-8" aria-hidden="true"></div>
    <div class="site-container relative py-24">
        @if ($d['eyebrow'])<div class="mb-5 text-xs tracking-[0.4em] uppercase">{{ $d['eyebrow'] }}</div>@endif
        <h1 class="mx-auto max-w-4xl text-5xl leading-[1.05] sm:text-7xl">{{ $d['title'] }}</h1>
        @if ($d['subtitle'])<p class="mx-auto mt-6 max-w-2xl text-lg leading-relaxed text-white/90">{{ $d['subtitle'] }}</p>@endif
        @include('site.partials.hero-buttons', ['class' => 'justify-center', 'primary' => 'btn-light', 'secondary' => 'btn-ghost-light'])
    </div>
</section>
