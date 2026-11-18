@php($title = preg_replace('/\*(.+?)\*/', '<em>$1</em>', e($d['title'])))
<section id="{{ $sectionId }}" class="bimbel-hero relative overflow-hidden">
    <div class="site-container grid items-center gap-12 py-16 sm:py-24 lg:grid-cols-2">
        <div>
            @if ($d['eyebrow'])<span class="bimbel-chip">🎯 {{ $d['eyebrow'] }}</span>@endif
            <h1 class="hero-title mt-5 text-5xl leading-[1.05] sm:text-6xl">{!! $title !!}</h1>
            @if ($d['subtitle'])<p class="muted mt-5 max-w-lg text-lg leading-relaxed">{{ $d['subtitle'] }}</p>@endif
            @include('site.partials.hero-buttons')
        </div>
        @if ($site->image($d['image']))
            <div class="relative mx-auto w-full max-w-lg">
                <span class="absolute -top-5 -right-5 size-28 rounded-3xl bg-[#facc15] rotate-12"></span>
                <span class="absolute -bottom-6 -left-6 size-24 rounded-full bg-[#22c55e]"></span>
                <img src="{{ $site->image($d['image']) }}" alt="" class="relative aspect-[4/3] w-full rounded-[2rem] object-cover shadow-2xl">
                <span class="absolute bottom-6 -left-4 rounded-2xl bg-white px-4 py-3 text-sm font-bold shadow-xl">⭐ 4.9 dari 1.200 ulasan</span>
            </div>
        @endif
    </div>
</section>
