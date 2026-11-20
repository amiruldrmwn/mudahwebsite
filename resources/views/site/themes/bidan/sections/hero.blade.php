@php($title = preg_replace('/\*(.+?)\*/', '<em>$1</em>', e($d['title'])))
{{-- Warm cream with soft blobs, the photo in an arch with an offset outline, a 24-hour midwife card and a BPJS stamp. --}}
<section id="{{ $sectionId }}" class="bidan-hero relative overflow-hidden">
    <div class="bidan-blob bidan-blob-1 absolute" aria-hidden="true"></div>
    <div class="bidan-blob bidan-blob-2 absolute" aria-hidden="true"></div>
    <div class="site-container relative grid items-center gap-14 py-14 sm:py-20 lg:grid-cols-[1.05fr_.95fr]">
        <div>
            @if ($d['eyebrow'])<span class="bidan-eyebrow"><svg viewBox="0 0 24 24" class="size-4" fill="currentColor" aria-hidden="true"><path d="M12 21s-7.5-4.6-9.6-9.3C.9 8.2 3 4.5 6.7 4.5c2.1 0 3.6 1.2 4.3 2.4h2c.7-1.2 2.2-2.4 4.3-2.4 3.7 0 5.8 3.7 4.3 7.2C19.5 16.4 12 21 12 21Z"/></svg>{{ $d['eyebrow'] }}</span>@endif
            <h1 class="hero-title mt-6 text-4xl leading-[1.12] sm:text-[3.6rem]">{!! $title !!}</h1>
            @if ($d['subtitle'])<p class="muted mt-6 max-w-xl text-lg leading-relaxed">{{ $d['subtitle'] }}</p>@endif
            @include('site.partials.hero-buttons', ['secondary' => 'bidan-soft'])
        </div>
        @if ($site->image($d['image']))
            <div class="relative mx-auto w-full max-w-[26rem] pb-10 sm:pb-6">
                <div class="bidan-arch-line absolute" aria-hidden="true"></div>
                <img src="{{ $site->image($d['image']) }}" alt="" class="bidan-arch relative aspect-[4/5] w-full object-cover">
                <span class="bidan-stamp absolute -top-4 -right-2 sm:-right-6" aria-hidden="true">BPJS<small>diterima</small></span>
                <div class="bidan-card absolute bottom-0 left-0 sm:-left-12">
                    <span class="bidan-card-icon" aria-hidden="true"><svg viewBox="0 0 24 24" class="size-5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 12h4l2-5 4 10 2-5h6"/></svg></span>
                    <span><strong class="block text-sm">Bidan jaga 24 jam</strong><span class="muted text-xs">{{ $site->get('contact_phone') ?: 'Persalinan & keadaan darurat' }}</span></span>
                </div>
            </div>
        @endif
    </div>
</section>
