@php($title = preg_replace('/\*(.+?)\*/', '<em>$1</em>', e($d['title'])))
<section id="{{ $sectionId }}" class="overflow-hidden">
    <div class="site-container grid items-center gap-12 py-16 sm:py-20 lg:grid-cols-2">
        <div>
            @if ($d['eyebrow'])<span class="eyebrow flex items-center gap-3"><span class="inline-block h-px w-8" style="background: var(--brand)"></span>{{ $d['eyebrow'] }}</span>@endif
            <h1 class="hero-title text-4xl leading-[1.1] sm:text-6xl">{!! $title !!}</h1>
            @if ($d['subtitle'])<p class="muted mt-6 max-w-xl text-lg leading-relaxed">{{ $d['subtitle'] }}</p>@endif
            @include('site.partials.hero-buttons')
        </div>
        @if ($site->image($d['image']))
            <div class="relative">
                <div class="absolute -top-4 -right-4 h-2/3 w-2/3 rounded-3xl" style="background: var(--brand)"></div>
                <img src="{{ $site->image($d['image']) }}" alt="" class="relative aspect-[4/3] w-full rounded-3xl object-cover shadow-xl">
            </div>
        @endif
    </div>
</section>
