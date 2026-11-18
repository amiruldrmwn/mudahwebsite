@php($title = preg_replace('/\*(.+?)\*/', '<em>$1</em>', e($d['title'])))
<section id="{{ $sectionId }}" class="relative overflow-hidden">
    <div class="site-container grid items-center gap-12 py-16 sm:py-24 lg:grid-cols-2">
        <div>
            @if ($d['eyebrow'])<span class="eyebrow">{{ $d['eyebrow'] }}</span>@endif
            <h1 class="hero-title text-5xl leading-[1.05] sm:text-7xl">{!! $title !!}</h1>
            @if ($d['subtitle'])<p class="muted mt-6 max-w-lg text-lg leading-relaxed">{{ $d['subtitle'] }}</p>@endif
            @include('site.partials.hero-buttons')
        </div>
        @if ($site->image($d['image']))
            <div class="relative mx-auto w-full max-w-md">
                <div class="absolute -top-6 -right-6 size-40 rounded-full" style="background: var(--brand-soft)"></div>
                <img src="{{ $site->image($d['image']) }}" alt="" class="relative aspect-[3/4] w-full rounded-t-full object-cover">
                <span class="absolute bottom-8 -left-6 rounded-full bg-white px-5 py-3 text-sm shadow-xl" style="font-family: var(--font-head)"><em>Glow</em> from within ✨</span>
            </div>
        @endif
    </div>
</section>
