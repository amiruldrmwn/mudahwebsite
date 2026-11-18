@php($title = preg_replace('/\*(.+?)\*/', '<em>$1</em>', e($d['title'])))
<section id="{{ $sectionId }}" class="relative overflow-hidden">
    <div class="grid lg:grid-cols-[5fr_7fr]">
        <div class="flex items-center px-6 py-16 sm:px-12 lg:py-24 lg:pl-[max(1.5rem,calc((100vw-80rem)/2+1.5rem))]">
            <div class="max-w-lg">
                @if ($d['eyebrow'])<span class="eyebrow">{{ $d['eyebrow'] }}</span>@endif
                <h1 class="hero-title text-5xl leading-[1.05] sm:text-7xl">{!! $title !!}</h1>
                @if ($d['subtitle'])<p class="muted mt-6 text-base leading-relaxed">{{ $d['subtitle'] }}</p>@endif
                @include('site.partials.hero-buttons')
            </div>
        </div>
        @if ($site->image($d['image']))
            <div class="relative min-h-[420px] lg:min-h-[640px]">
                <img src="{{ $site->image($d['image']) }}" alt="" class="absolute inset-0 h-full w-full object-cover">
            </div>
        @endif
    </div>
</section>
