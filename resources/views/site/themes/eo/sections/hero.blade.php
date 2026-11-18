@php($title = preg_replace('/\*(.+?)\*/', '<em>$1</em>', e($d['title'])))
{{-- Full-bleed stage photo under a spotlight glow, oversized wide type, centred. --}}
<section id="{{ $sectionId }}" class="eo-hero relative overflow-hidden">
    @if ($site->image($d['image']))<img src="{{ $site->image($d['image']) }}" alt="" class="absolute inset-0 size-full object-cover">@endif
    <div class="eo-glow absolute inset-0"></div>
    <div class="site-container relative py-28 text-center sm:py-40">
        @if ($d['eyebrow'])<span class="eo-eyebrow">{{ $d['eyebrow'] }}</span>@endif
        <h1 class="hero-title mx-auto mt-5 max-w-4xl text-4xl leading-[1.05] break-words text-white sm:text-7xl">{!! $title !!}</h1>
        @if ($d['subtitle'])<p class="mx-auto mt-6 max-w-xl text-lg leading-relaxed text-white/75">{{ $d['subtitle'] }}</p>@endif
        @include('site.partials.hero-buttons', ['class' => 'justify-center', 'secondary' => 'eo-ghost'])
    </div>
</section>
