<section id="{{ $sectionId }}" class="relative flex min-h-[82vh] items-end overflow-hidden" style="background: #0b0b0d">
    @if ($site->image($d['image']))
        <img src="{{ $site->image($d['image']) }}" alt="" class="absolute inset-0 size-full object-cover opacity-70">
    @endif
    <div class="absolute inset-0" style="background: linear-gradient(0deg, #0b0b0d 0%, rgb(11 11 13 / .55) 50%, rgb(11 11 13 / .25) 100%)"></div>
    <div class="site-container relative pt-32 pb-20 text-white">
        @if ($d['eyebrow'])<span class="mb-4 inline-flex items-center gap-3 text-sm font-semibold tracking-[0.3em] uppercase" style="color: var(--brand)"><span class="h-px w-10" style="background: var(--brand)"></span>{{ $d['eyebrow'] }}</span>@endif
        <h1 class="barber-display max-w-4xl text-7xl leading-[0.9] sm:text-9xl">{{ $d['title'] }}</h1>
        @if ($d['subtitle'])<p class="mt-6 max-w-xl text-lg leading-relaxed text-white/75">{{ $d['subtitle'] }}</p>@endif
        @include('site.partials.hero-buttons', ['secondary' => 'btn-ghost-light'])
    </div>
</section>
