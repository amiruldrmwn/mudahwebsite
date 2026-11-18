@php($title = preg_replace('/\*(.+?)\*/', '<em>$1</em>', e($d['title'])))
<section id="{{ $sectionId }}" class="relative flex min-h-[78vh] items-center overflow-hidden bg-white">
    @if ($site->image($d['image']))
        <img src="{{ $site->image($d['image']) }}" alt="" class="absolute inset-0 size-full object-cover object-right">
        <div class="absolute inset-0" style="background: linear-gradient(90deg, #fff 0%, rgb(255 255 255 / .92) 35%, rgb(255 255 255 / .35) 65%, transparent 100%)"></div>
    @endif
    <div class="site-container relative py-20">
        <div class="max-w-2xl">
            @if ($d['eyebrow'])<span class="eyebrow">{{ $d['eyebrow'] }}</span>@endif
            <h1 class="hero-title text-5xl leading-[1.02] sm:text-7xl">{!! $title !!}</h1>
            @if ($d['subtitle'])<p class="muted mt-6 max-w-lg text-lg leading-relaxed">{{ $d['subtitle'] }}</p>@endif
            @include('site.partials.hero-buttons', ['secondary' => 'btn-soft'])
        </div>
    </div>
</section>
