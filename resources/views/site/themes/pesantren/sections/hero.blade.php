@php($title = preg_replace('/\*(.+?)\*/', '<em>$1</em>', e($d['title'])))
{{-- Green hero with a geometric star pattern, the photo in an arched frame. --}}
<section id="{{ $sectionId }}" class="pesantren-hero relative overflow-hidden">
    <div class="site-container relative grid items-center gap-12 py-16 sm:py-24 lg:grid-cols-2">
        <div>
            @if ($d['eyebrow'])<span class="pesantren-eyebrow">{{ $d['eyebrow'] }}</span>@endif
            <h1 class="hero-title mt-5 text-4xl leading-tight text-white sm:text-6xl">{!! $title !!}</h1>
            @if ($d['subtitle'])<p class="mt-5 max-w-lg text-lg leading-relaxed text-white/80">{{ $d['subtitle'] }}</p>@endif
            @include('site.partials.hero-buttons', ['secondary' => 'pesantren-ghost'])
        </div>
        @if ($site->image($d['image']))
            <div class="relative mx-auto w-full max-w-md">
                <img src="{{ $site->image($d['image']) }}" alt="" class="pesantren-arch aspect-[4/5] w-full object-cover">
            </div>
        @endif
    </div>
</section>
