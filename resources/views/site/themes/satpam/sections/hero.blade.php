@php($title = preg_replace('/\*(.+?)\*/', '<em>$1</em>', e($d['title'])))
{{-- Full-bleed dark photo, uppercase title with a yellow word, a hazard stripe at the foot. --}}
<section id="{{ $sectionId }}" class="satpam-hero relative overflow-hidden">
    @if ($site->image($d['image']))
        <img src="{{ $site->image($d['image']) }}" alt="" class="absolute inset-0 size-full object-cover">
    @endif
    <div class="satpam-shade absolute inset-0"></div>
    <div class="site-container relative py-24 sm:py-32">
        <div class="max-w-2xl">
            @if ($d['eyebrow'])<span class="satpam-eyebrow">{{ $d['eyebrow'] }}</span>@endif
            <h1 class="hero-title mt-5 text-5xl leading-[1.02] text-white uppercase sm:text-7xl">{!! $title !!}</h1>
            @if ($d['subtitle'])<p class="mt-6 max-w-xl text-lg leading-relaxed text-white/80">{{ $d['subtitle'] }}</p>@endif
            @include('site.partials.hero-buttons', ['secondary' => 'satpam-ghost'])
        </div>
    </div>
    <div class="satpam-stripe relative h-2"></div>
</section>
