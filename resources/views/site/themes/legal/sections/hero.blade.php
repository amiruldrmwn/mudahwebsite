@php($title = preg_replace('/\*(.+?)\*/', '<mark>$1</mark>', e($d['title'])))
<section id="{{ $sectionId }}" class="legal-hero relative overflow-hidden text-white">
    <div class="legal-grid pointer-events-none absolute inset-0" aria-hidden="true"></div>
    <div class="site-container relative grid items-center gap-12 py-16 sm:py-24 lg:grid-cols-[1.1fr_1fr]">
        <div>
            @if ($d['eyebrow'])<span class="mb-6 inline-flex items-center gap-2 rounded-full bg-white/12 px-4 py-1.5 text-xs font-bold tracking-wide uppercase ring-1 ring-white/20">✨ {{ $d['eyebrow'] }}</span>@endif
            <h1 class="hero-title text-4xl leading-[1.1] font-extrabold sm:text-6xl">{!! $title !!}</h1>
            @if ($d['subtitle'])<p class="mt-6 max-w-xl text-lg leading-relaxed text-white/85">{{ $d['subtitle'] }}</p>@endif
            @include('site.partials.hero-buttons', ['primary' => 'btn-accent', 'secondary' => 'btn-ghost-light'])
        </div>
        @if ($site->image($d['image']))
            <div class="relative">
                <div class="overflow-hidden rounded-[1.75rem] bg-white p-2 shadow-2xl">
                    <img src="{{ $site->image($d['image']) }}" alt="" class="aspect-[4/3] w-full rounded-[1.35rem] object-cover">
                </div>
                <div class="absolute -bottom-5 -left-4 flex items-center gap-3 rounded-2xl bg-white px-4 py-3 shadow-xl sm:-left-8" style="color: var(--ink)">
                    <span class="relative flex size-3"><span class="absolute inline-flex size-full animate-ping rounded-full bg-emerald-400 opacity-60"></span><span class="relative inline-flex size-3 rounded-full bg-emerald-500"></span></span>
                    <span class="text-sm"><span class="block font-bold">Konsultan online</span><span class="muted text-xs">Respons cepat di jam kerja</span></span>
                </div>
            </div>
        @endif
    </div>
</section>
