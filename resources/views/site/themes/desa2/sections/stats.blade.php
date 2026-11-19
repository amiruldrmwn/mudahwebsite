{{-- Population figures: a gradient number block beside each label, two per row. --}}
<section id="{{ $sectionId }}" class="sec">
    <div class="site-container">
        @if ($d['title'])<div class="sec-head"><h2 class="sec-title desa2-big">{{ $d['title'] }}</h2></div>@endif
        <div class="grid gap-4 sm:grid-cols-2">
            @foreach ($d['items'] as $item)
                <div class="desa2-stat">
                    <span class="desa2-stat-num">{{ $item['value'] }}</span>
                    <span class="desa2-stat-label">{{ $item['label'] }}</span>
                </div>
            @endforeach
        </div>
    </div>
</section>
