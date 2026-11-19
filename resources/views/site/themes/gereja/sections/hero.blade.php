@php($title = preg_replace('/\*(.+?)\*/', '<em>$1</em>', e($d['title'])))
{{-- Photo under a deep navy veil, centred serif title between thin gold rules with a small cross. --}}
<section id="{{ $sectionId }}" class="gereja-hero relative overflow-hidden">
    @if ($site->image($d['image']))<img src="{{ $site->image($d['image']) }}" alt="" class="absolute inset-0 size-full object-cover">@endif
    <div class="gereja-veil absolute inset-0"></div>
    <div class="site-container relative py-24 text-center sm:py-36">
        <div class="gereja-rule mx-auto" aria-hidden="true"><svg viewBox="0 0 12 16" class="h-4 w-3" fill="currentColor"><path d="M5 0h2v4h5v2H7v10H5V6H0V4h5z"/></svg></div>
        @if ($d['eyebrow'])<p class="gereja-eyebrow mt-5">{{ $d['eyebrow'] }}</p>@endif
        <h1 class="hero-title mx-auto mt-4 max-w-4xl text-4xl leading-[1.1] text-white sm:text-6xl">{!! $title !!}</h1>
        @if ($d['subtitle'])<p class="mx-auto mt-6 max-w-xl text-lg leading-relaxed text-white/80">{{ $d['subtitle'] }}</p>@endif
        @include('site.partials.hero-buttons', ['class' => 'justify-center', 'secondary' => 'gereja-ghost'])
    </div>
</section>
