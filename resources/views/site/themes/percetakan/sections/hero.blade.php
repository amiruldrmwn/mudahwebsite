@php($title = preg_replace('/\*(.+?)\*/', '<em>$1</em>', e($d['title'])))
{{-- White hero with cyan, magenta and yellow blobs; the photo tilted like a fresh print. --}}
<section id="{{ $sectionId }}" class="cetak-hero relative overflow-hidden">
    <div class="site-container relative grid items-center gap-12 py-16 sm:py-24 lg:grid-cols-2">
        <div>
            @if ($d['eyebrow'])<span class="cetak-chip">{{ $d['eyebrow'] }}</span>@endif
            <h1 class="hero-title mt-5 text-4xl leading-[1.08] sm:text-6xl">{!! $title !!}</h1>
            @if ($d['subtitle'])<p class="muted mt-5 max-w-lg text-lg leading-relaxed">{{ $d['subtitle'] }}</p>@endif
            @include('site.partials.hero-buttons')
            <div class="mt-8 flex items-center gap-2" aria-hidden="true"><span class="cetak-ink bg-[#06b6d4]"></span><span class="cetak-ink" style="background: var(--brand)"></span><span class="cetak-ink bg-[#facc15]"></span><span class="cetak-ink bg-[#111827]"></span></div>
        </div>
        @if ($site->image($d['image']))
            <div class="relative mx-auto w-full max-w-lg">
                <img src="{{ $site->image($d['image']) }}" alt="" class="cetak-print relative aspect-[4/3] w-full object-cover">
            </div>
        @endif
    </div>
</section>
