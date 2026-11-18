<section id="{{ $sectionId }}" class="relative z-10 -mt-px py-10">
    <div class="site-container">
        @if ($d['title'])<h2 class="sec-title mb-8 text-center">{{ $d['title'] }}</h2>@endif
        <div @class(['grid gap-4', [1 => '', 2 => 'sm:grid-cols-2', 3 => 'sm:grid-cols-3'][count($d['items'])] ?? 'grid-cols-2 lg:grid-cols-4'])>
            @foreach ($d['items'] as $item)
                <div class="card text-center">
                    <div class="text-3xl font-extrabold tracking-tight sm:text-4xl" style="color: var(--brand)">{{ $item['value'] }}</div>
                    <div class="muted mt-1 text-sm">{{ $item['label'] }}</div>
                </div>
            @endforeach
        </div>
    </div>
</section>
