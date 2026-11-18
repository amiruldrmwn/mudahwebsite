@php($title = preg_replace('/\*(.+?)\*/', '<em>$1</em>', e($d['title'])))
{{-- Soft mint hero, the photo in a rounded blob with floating trust badges. --}}
<section id="{{ $sectionId }}" class="cleaning-hero relative overflow-hidden">
    <div class="site-container grid items-center gap-12 py-14 sm:py-20 lg:grid-cols-2">
        <div>
            @if ($d['eyebrow'])<span class="cleaning-chip">✨ {{ $d['eyebrow'] }}</span>@endif
            <h1 class="hero-title mt-5 text-4xl leading-[1.08] sm:text-6xl">{!! $title !!}</h1>
            @if ($d['subtitle'])<p class="muted mt-5 max-w-lg text-lg leading-relaxed">{{ $d['subtitle'] }}</p>@endif
            @include('site.partials.hero-buttons')
        </div>
        @if ($site->image($d['image']))
            <div class="relative mx-auto w-full max-w-lg">
                <img src="{{ $site->image($d['image']) }}" alt="" class="cleaning-blob aspect-square w-full object-cover">
                <span class="cleaning-float absolute top-8 -left-2 sm:-left-6">🛡️ Petugas terverifikasi</span>
                <span class="cleaning-float absolute right-0 bottom-10 sm:-right-4">⭐ 4,9 dari pelanggan</span>
            </div>
        @endif
    </div>
</section>
