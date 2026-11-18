@php($title = preg_replace('/\*(.+?)\*/', '<em>$1</em>', e($d['title'])))
<section id="{{ $sectionId }}" class="laundry-hero relative overflow-hidden">
    <div class="site-container grid items-center gap-12 py-16 sm:py-24 lg:grid-cols-2">
        <div>
            @if ($d['eyebrow'])<span class="laundry-chip">🫧 {{ $d['eyebrow'] }}</span>@endif
            <h1 class="hero-title mt-5 text-5xl leading-[1.05] sm:text-6xl">{!! $title !!}</h1>
            @if ($d['subtitle'])<p class="muted mt-5 max-w-lg text-lg leading-relaxed">{{ $d['subtitle'] }}</p>@endif
            @include('site.partials.hero-buttons')
        </div>
        @if ($site->image($d['image']))
            <div class="relative mx-auto w-full max-w-lg">
                <span class="laundry-bubble absolute -top-6 -left-6 size-24"></span>
                <span class="laundry-bubble absolute -right-4 bottom-10 size-16"></span>
                <img src="{{ $site->image($d['image']) }}" alt="" class="laundry-blob relative aspect-square w-full object-cover shadow-2xl">
            </div>
        @endif
    </div>
</section>
