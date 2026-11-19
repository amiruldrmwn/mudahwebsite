@php($title = preg_replace('/\*(.+?)\*/', '$1', e($d['title'])))
{{-- Full-bleed landscape, centred bold uppercase title like an official village banner. --}}
<section id="{{ $sectionId }}" class="desa2-hero relative overflow-hidden">
    @if ($site->image($d['image']))<img src="{{ $site->image($d['image']) }}" alt="" class="absolute inset-0 size-full object-cover">@endif
    <div class="desa2-shade absolute inset-0"></div>
    <div class="site-container relative flex min-h-[70vh] flex-col items-center justify-center py-24 text-center">
        @if ($d['eyebrow'])<span class="desa2-eyebrow">{{ $d['eyebrow'] }}</span>@endif
        <h1 class="hero-title mt-3 max-w-4xl text-4xl leading-[1.05] break-words text-white uppercase sm:text-6xl">{!! $title !!}</h1>
        @if ($d['subtitle'])<p class="mt-4 max-w-2xl text-base font-semibold tracking-wide text-white/90 uppercase sm:text-lg">{{ $d['subtitle'] }}</p>@endif
        @include('site.partials.hero-buttons', ['class' => 'justify-center', 'secondary' => 'desa2-ghost'])
    </div>
</section>
