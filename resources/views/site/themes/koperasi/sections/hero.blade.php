@php($title = preg_replace('/\*(.+?)\*/', '<em>$1</em>', e($d['title'])))
{{-- Light teal with a yellow underline on the key words, the photo with a floating SHU card. --}}
<section id="{{ $sectionId }}" class="koperasi-hero relative overflow-hidden">
    <div class="site-container relative grid items-center gap-12 py-16 sm:py-24 lg:grid-cols-2">
        <div>
            @if ($d['eyebrow'])<span class="koperasi-tag">{{ $d['eyebrow'] }}</span>@endif
            <h1 class="hero-title mt-5 text-4xl leading-[1.1] sm:text-6xl">{!! $title !!}</h1>
            @if ($d['subtitle'])<p class="muted mt-6 max-w-lg text-lg leading-relaxed">{{ $d['subtitle'] }}</p>@endif
            @include('site.partials.hero-buttons')
        </div>
        @if ($site->image($d['image']))
            <div class="relative mx-auto w-full max-w-lg">
                <img src="{{ $site->image($d['image']) }}" alt="" class="koperasi-photo aspect-[4/3] w-full object-cover">
                <div class="koperasi-card absolute -bottom-6 -left-2 sm:-left-8">
                    <span class="koperasi-coin" aria-hidden="true">Rp</span>
                    <span><strong class="block text-sm">SHU dibagikan setiap tahun</strong><span class="muted text-xs">untuk seluruh anggota aktif</span></span>
                </div>
            </div>
        @endif
    </div>
</section>
