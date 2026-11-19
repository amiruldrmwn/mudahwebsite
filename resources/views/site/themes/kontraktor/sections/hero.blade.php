@php($title = preg_replace('/\*(.+?)\*/', '<em>$1</em>', e($d['title'])))
{{-- Dark slate on a blueprint grid, the photo framed by orange corner brackets and a warranty card. --}}
<section id="{{ $sectionId }}" class="kontraktor-hero relative overflow-hidden">
    <div class="kontraktor-grid absolute inset-0"></div>
    <div class="site-container relative grid items-center gap-14 py-16 sm:py-24 lg:grid-cols-[1.05fr_1fr]">
        <div>
            @if ($d['eyebrow'])<span class="kontraktor-tag">{{ $d['eyebrow'] }}</span>@endif
            <h1 class="hero-title mt-6 text-4xl leading-[1.08] text-white sm:text-6xl">{!! $title !!}</h1>
            @if ($d['subtitle'])<p class="mt-6 max-w-lg text-lg leading-relaxed text-slate-300">{{ $d['subtitle'] }}</p>@endif
            @include('site.partials.hero-buttons', ['secondary' => 'kontraktor-ghost'])
        </div>
        @if ($site->image($d['image']))
            <div class="kontraktor-frame relative mx-auto w-full max-w-xl p-4">
                <img src="{{ $site->image($d['image']) }}" alt="" class="aspect-[4/3] w-full object-cover">
                <div class="kontraktor-card absolute -bottom-6 left-0 sm:-left-6">
                    <span class="kontraktor-card-num">10</span>
                    <span><strong class="block text-sm">Tahun garansi</strong><span class="text-xs text-slate-500">struktur bangunan</span></span>
                </div>
            </div>
        @endif
    </div>
</section>
