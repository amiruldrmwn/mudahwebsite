{{-- Scoreboard: numbers in lit panels on a dark board. --}}
<section id="{{ $sectionId }}" class="lapangan-score py-12 sm:py-16">
    <div class="site-container">
        @if ($d['title'])<h2 class="sec-title mb-8 text-center text-white">{{ $d['title'] }}</h2>@endif
        <div @class(['grid gap-3 sm:gap-4', [1 => '', 2 => 'grid-cols-2', 3 => 'sm:grid-cols-3'][count($d['items'])] ?? 'grid-cols-2 lg:grid-cols-4'])>
            @foreach ($d['items'] as $item)
                <div class="lapangan-panel text-center">
                    <div class="lapangan-digits">{{ $item['value'] }}</div>
                    <div class="mt-2 text-xs font-bold tracking-widest text-white/70 uppercase">{{ $item['label'] }}</div>
                </div>
            @endforeach
        </div>
    </div>
</section>
