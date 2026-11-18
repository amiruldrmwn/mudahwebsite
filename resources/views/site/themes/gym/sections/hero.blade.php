@php($title = preg_replace('/\*(.+?)\*/', '<em>$1</em>', e($d['title'])))
{{-- Dark full-bleed photo, a red slanted slab behind huge condensed type. --}}
<section id="{{ $sectionId }}" class="gym-hero relative overflow-hidden">
    @if ($site->image($d['image']))<img src="{{ $site->image($d['image']) }}" alt="" class="absolute inset-0 size-full object-cover">@endif
    <div class="gym-shade absolute inset-0"></div>
    <div class="gym-slab absolute top-0 bottom-0 -left-24 hidden w-1/2 lg:block"></div>
    <div class="site-container relative py-24 sm:py-36">
        @if ($d['eyebrow'])<span class="gym-tag">{{ $d['eyebrow'] }}</span>@endif
        <h1 class="hero-title mt-4 max-w-3xl text-7xl leading-[0.9] text-white uppercase sm:text-9xl">{!! $title !!}</h1>
        @if ($d['subtitle'])<p class="mt-6 max-w-lg text-lg leading-relaxed text-white/80">{{ $d['subtitle'] }}</p>@endif
        @include('site.partials.hero-buttons', ['secondary' => 'gym-ghost'])
    </div>
</section>
