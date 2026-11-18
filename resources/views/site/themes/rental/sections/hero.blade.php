<section id="{{ $sectionId }}" class="relative overflow-hidden text-white" style="background: var(--brand)">
    <div class="rental-slash pointer-events-none absolute inset-y-0 right-0 hidden w-1/2 lg:block" aria-hidden="true"></div>
    <div class="site-container relative grid items-center gap-10 py-16 sm:py-20 lg:grid-cols-2">
        <div>
            @if ($d['eyebrow'])<span class="rental-chip mb-5 inline-block rounded-md px-3 py-1 text-xs font-bold tracking-wider uppercase">{{ $d['eyebrow'] }}</span>@endif
            <h1 class="text-4xl leading-[1.05] font-extrabold sm:text-6xl">{{ $d['title'] }}</h1>
            @if ($d['subtitle'])<p class="mt-6 max-w-xl text-lg leading-relaxed text-white/80">{{ $d['subtitle'] }}</p>@endif
            @include('site.partials.hero-buttons', ['primary' => 'btn-accent', 'secondary' => 'btn-ghost-light'])
        </div>
        @if ($site->image($d['image']))
            <div class="relative">
                <img src="{{ $site->image($d['image']) }}" alt="" class="aspect-[4/3] w-full rounded-3xl object-cover shadow-2xl">
                <div class="absolute -bottom-5 left-6 flex gap-2">
                    <span class="rounded-full bg-white px-4 py-2 text-sm font-bold shadow-lg" style="color: var(--brand)">🔑 Lepas kunci</span>
                    <span class="rounded-full bg-white px-4 py-2 text-sm font-bold shadow-lg" style="color: var(--brand)">🧑‍✈️ Dengan sopir</span>
                </div>
            </div>
        @endif
    </div>
</section>
