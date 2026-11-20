{{-- Big lime numbers on ink, split by thin rules. --}}
<section id="{{ $sectionId }}" class="agency-dark">
    <div class="site-container py-14 sm:py-20">
        @if ($d['title'])<h2 class="sec-title mb-10 text-white">{{ $d['title'] }}</h2>@endif
        <div @class(['agency-stats grid grid-cols-2', [1 => 'grid-cols-1!', 3 => 'lg:grid-cols-3'][count($d['items'])] ?? 'lg:grid-cols-4'])>
            @foreach ($d['items'] as $item)
                <div class="agency-stat">
                    <div class="text-4xl font-extrabold tracking-tight text-[#d4ff3a] sm:text-6xl">{{ $item['value'] }}</div>
                    <div class="agency-mono mt-3 text-xs tracking-wider text-white/60 uppercase">{{ $item['label'] }}</div>
                </div>
            @endforeach
        </div>
    </div>
</section>
