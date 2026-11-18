@php($title = preg_replace('/\*(.+?)\*/', '<em>$1</em>', e($d['title'])))
<section id="{{ $sectionId }}" class="lawfirm-hero relative overflow-hidden">
    @if ($site->image($d['image']))
        <img src="{{ $site->image($d['image']) }}" alt="" class="absolute inset-y-0 right-0 hidden h-full w-1/2 object-cover lg:block">
        <div class="lawfirm-fade absolute inset-y-0 right-0 hidden w-1/2 lg:block"></div>
    @endif
    <div class="site-container relative grid py-20 sm:py-28 lg:grid-cols-2">
        <div class="lg:pr-12">
            @if ($d['eyebrow'])<span class="lawfirm-eyebrow">{{ $d['eyebrow'] }}</span>@endif
            <h1 class="hero-title mt-6 text-4xl leading-[1.15] text-white sm:text-5xl">{!! $title !!}</h1>
            @if ($d['subtitle'])<p class="mt-6 max-w-xl text-lg leading-relaxed text-white/75">{{ $d['subtitle'] }}</p>@endif
            @include('site.partials.hero-buttons', ['secondary' => 'lawfirm-ghost'])
        </div>
    </div>
    @if ($site->image($d['image']))
        <img src="{{ $site->image($d['image']) }}" alt="" class="relative aspect-[16/10] w-full object-cover lg:hidden">
    @endif
</section>
