@php($title = preg_replace('/\*(.+?)\*/', '<em>$1</em>', e($d['title'])))
{{-- Clean white with a large red sun behind the photo. --}}
<section id="{{ $sectionId }}" class="lpk-hero relative overflow-hidden">
    <div class="site-container relative grid items-center gap-12 py-16 sm:py-24 lg:grid-cols-2">
        <div>
            @if ($d['eyebrow'])<span class="lpk-eyebrow">{{ $d['eyebrow'] }}</span>@endif
            <h1 class="hero-title mt-5 text-4xl leading-[1.08] sm:text-6xl">{!! $title !!}</h1>
            @if ($d['subtitle'])<p class="muted mt-6 max-w-lg text-lg leading-relaxed">{{ $d['subtitle'] }}</p>@endif
            @include('site.partials.hero-buttons')
        </div>
        @if ($site->image($d['image']))
            <div class="relative mx-auto w-full max-w-lg">
                <div class="lpk-sun absolute"></div>
                <img src="{{ $site->image($d['image']) }}" alt="" class="lpk-photo relative aspect-[4/5] w-4/5 object-cover sm:w-3/4">
                <div class="lpk-badge absolute bottom-6 right-0 sm:right-4"><strong>92%</strong><span>lolos wawancara</span></div>
            </div>
        @endif
    </div>
</section>
