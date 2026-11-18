<section id="{{ $sectionId }}" class="sec">
    <div class="site-container">
        @if ($d['title'] || $d['subtitle'])
            <div class="sec-head">
                @if ($d['title'])<h2 class="sec-title">{{ $d['title'] }}</h2>@endif
                @if ($d['subtitle'])<p class="sec-sub">{{ $d['subtitle'] }}</p>@endif
            </div>
        @endif
        <div @class(['grid gap-6', [1 => 'mx-auto max-w-xs', 2 => 'mx-auto max-w-2xl grid-cols-2', 3 => 'mx-auto max-w-4xl grid-cols-2 sm:grid-cols-3'][count($d['items'])] ?? 'grid-cols-2 lg:grid-cols-4'])>
            @foreach ($d['items'] as $item)
                <figure class="team-card text-center">
                    @if ($site->image($item['photo']))
                        <img src="{{ $site->image($item['photo']) }}" alt="{{ $item['name'] }}" class="team-photo mx-auto aspect-square w-full object-cover" loading="lazy">
                    @else
                        <div class="team-photo mx-auto flex aspect-square w-full items-center justify-center text-4xl font-bold" style="background: var(--brand-soft); color: var(--brand)">{{ mb_substr($item['name'], 0, 1) }}</div>
                    @endif
                    <figcaption class="mt-4">
                        <div class="text-lg font-semibold">{{ $item['name'] }}</div>
                        @if ($item['role'])<div class="muted text-sm">{{ $item['role'] }}</div>@endif
                    </figcaption>
                </figure>
            @endforeach
        </div>
    </div>
</section>
