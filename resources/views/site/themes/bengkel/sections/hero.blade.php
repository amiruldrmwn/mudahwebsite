@php($title = preg_replace('/\*(.+?)\*/', '<em>$1</em>', e($d['title'])))
<section id="{{ $sectionId }}" class="relative overflow-hidden bg-[#111214] text-white">
    <div class="bengkel-stripes pointer-events-none absolute inset-x-0 bottom-0 h-3" aria-hidden="true"></div>
    <div class="grid lg:grid-cols-2">
        <div class="site-container flex items-center py-16 sm:py-24 lg:pr-12 lg:pl-[max(1.5rem,calc((100vw-80rem)/2+1.5rem))]">
            <div>
                @if ($d['eyebrow'])<span class="bengkel-tag">{{ $d['eyebrow'] }}</span>@endif
                <h1 class="hero-title mt-5 text-5xl leading-[0.95] uppercase sm:text-7xl">{!! $title !!}</h1>
                @if ($d['subtitle'])<p class="mt-6 max-w-lg text-lg leading-relaxed text-white/70">{{ $d['subtitle'] }}</p>@endif
                @include('site.partials.hero-buttons', ['secondary' => 'btn-ghost-light'])
            </div>
        </div>
        @if ($site->image($d['image']))
            <div class="bengkel-cut relative min-h-[340px] lg:min-h-[600px]"><img src="{{ $site->image($d['image']) }}" alt="" class="absolute inset-0 h-full w-full object-cover"></div>
        @endif
    </div>
</section>
