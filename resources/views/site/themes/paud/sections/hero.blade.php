@php($title = preg_replace('/\*(.+?)\*/', '<em>$1</em>', e($d['title'])))
{{-- Soft sky background with crayon-coloured blobs, the photo in a dashed rounded frame, a wavy bottom. --}}
<section id="{{ $sectionId }}" class="paud-hero relative overflow-hidden">
    <span class="paud-blob paud-blob-1 absolute"></span><span class="paud-blob paud-blob-2 absolute"></span><span class="paud-blob paud-blob-3 absolute"></span>
    <div class="site-container relative grid items-center gap-12 pt-14 pb-24 sm:pt-20 sm:pb-32 lg:grid-cols-2">
        <div>
            @if ($d['eyebrow'])<span class="paud-pill">{{ $d['eyebrow'] }}</span>@endif
            <h1 class="hero-title mt-5 text-4xl leading-[1.1] sm:text-6xl">{!! $title !!}</h1>
            @if ($d['subtitle'])<p class="muted mt-5 max-w-lg text-lg leading-relaxed">{{ $d['subtitle'] }}</p>@endif
            @include('site.partials.hero-buttons')
        </div>
        @if ($site->image($d['image']))
            <div class="relative mx-auto w-full max-w-md">
                <div class="paud-frame">
                    <img src="{{ $site->image($d['image']) }}" alt="" class="aspect-square w-full object-cover">
                </div>
                <span class="paud-star absolute -top-4 -left-4" aria-hidden="true">★</span>
                <span class="paud-tag absolute -right-2 bottom-8">Rasio 1 guru : 6 anak</span>
            </div>
        @endif
    </div>
    <svg class="absolute bottom-0 left-0 h-12 w-full sm:h-16" viewBox="0 0 1440 80" preserveAspectRatio="none" aria-hidden="true"><path d="M0 40c120-30 240-30 360 0s240 30 360 0 240-30 360 0 240 30 360 0v40H0z" fill="#fff"/></svg>
</section>
