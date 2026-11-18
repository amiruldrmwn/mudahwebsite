@php($title = preg_replace('/\*(.+?)\*/', '<em>$1</em>', e($d['title'])))
{{-- Charcoal hero with a hazard-stripe corner, the photo with a thick amber offset frame. --}}
<section id="{{ $sectionId }}" class="bangunan-hero relative overflow-hidden">
    <div class="bangunan-stripes absolute top-0 right-0 h-full w-24 sm:w-40"></div>
    <div class="site-container relative grid items-center gap-12 py-16 sm:py-24 lg:grid-cols-2">
        <div>
            @if ($d['eyebrow'])<span class="bangunan-tag">{{ $d['eyebrow'] }}</span>@endif
            <h1 class="hero-title mt-5 text-4xl leading-[1.05] text-white sm:text-6xl">{!! $title !!}</h1>
            @if ($d['subtitle'])<p class="mt-5 max-w-lg text-lg leading-relaxed text-white/75">{{ $d['subtitle'] }}</p>@endif
            @include('site.partials.hero-buttons', ['secondary' => 'bangunan-ghost'])
        </div>
        @if ($site->image($d['image']))
            <div class="relative mx-auto w-full max-w-lg pr-4 pb-4">
                <div class="bangunan-offset absolute top-4 left-4 right-0 bottom-0"></div>
                <img src="{{ $site->image($d['image']) }}" alt="" class="relative aspect-[4/3] w-full object-cover">
            </div>
        @endif
    </div>
</section>
