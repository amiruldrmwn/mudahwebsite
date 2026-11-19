@php($title = preg_replace('/\*(.+?)\*/', '<em>$1</em>', e($d['title'])))
{{-- Full-bleed destination photo, handwritten eyebrow, and a trip bar card overlapping the bottom edge. --}}
<section id="{{ $sectionId }}" class="travel-hero relative">
    <div class="relative overflow-hidden">
        @if ($site->image($d['image']))<img src="{{ $site->image($d['image']) }}" alt="" class="absolute inset-0 size-full object-cover">@endif
        <div class="travel-shade absolute inset-0"></div>
        <div class="site-container relative pt-24 pb-36 sm:pt-32 sm:pb-44">
            @if ($d['eyebrow'])<span class="travel-script">{{ $d['eyebrow'] }}</span>@endif
            <h1 class="hero-title mt-3 max-w-3xl text-4xl leading-[1.05] text-white sm:text-7xl">{!! $title !!}</h1>
            @if ($d['subtitle'])<p class="mt-6 max-w-xl text-lg leading-relaxed text-white/85">{{ $d['subtitle'] }}</p>@endif
            @include('site.partials.hero-buttons', ['secondary' => 'travel-ghost'])
        </div>
    </div>
    <div class="site-container relative -mt-16 sm:-mt-20">
        <div class="travel-tripbar grid gap-4 sm:grid-cols-3">
            <div><span class="travel-ico">⛵</span><strong class="block">Open trip</strong><span class="muted text-sm">Berangkat setiap minggu</span></div>
            <div><span class="travel-ico">🗺️</span><strong class="block">Private trip</strong><span class="muted text-sm">Tanggal & itinerary bebas</span></div>
            <div><span class="travel-ico">🧭</span><strong class="block">Pemandu lokal</strong><span class="muted text-sm">Berlisensi & berpengalaman</span></div>
        </div>
    </div>
</section>
