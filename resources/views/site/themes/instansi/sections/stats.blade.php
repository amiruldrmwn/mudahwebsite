{{-- Regional figures as white cards with a gold rule, on a light blue band. --}}
<section id="{{ $sectionId }}" class="sec instansi-band">
    <div class="site-container">
        @if ($d['title'])<div class="instansi-head"><h2 class="sec-title">{{ $d['title'] }}</h2></div>@endif
        <div @class(['grid grid-cols-2 gap-4', [3 => 'lg:grid-cols-3', 6 => 'lg:grid-cols-3', 5 => 'lg:grid-cols-5'][count($d['items'])] ?? 'lg:grid-cols-4'])>
            @foreach ($d['items'] as $item)
                <div class="instansi-stat">
                    <div class="text-3xl font-extrabold tracking-tight sm:text-4xl" style="color: var(--brand)">{{ $item['value'] }}</div>
                    <div class="mt-1.5 text-sm font-medium" style="color: var(--muted)">{{ $item['label'] }}</div>
                </div>
            @endforeach
        </div>
    </div>
</section>
