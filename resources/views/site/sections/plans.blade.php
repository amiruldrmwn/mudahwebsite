<section id="{{ $sectionId }}" class="sec plans">
    <div class="site-container">
        @if ($d['title'] || $d['subtitle'])
            <div class="sec-head">
                @if ($d['title'])<h2 class="sec-title">{{ $d['title'] }}</h2>@endif
                @if ($d['subtitle'])<p class="sec-sub">{{ $d['subtitle'] }}</p>@endif
            </div>
        @endif
        <div @class(['grid items-stretch gap-6', [1 => 'mx-auto max-w-md', 2 => 'mx-auto max-w-4xl md:grid-cols-2', 3 => 'md:grid-cols-3'][count($d['items'])] ?? 'md:grid-cols-2 lg:grid-cols-4'])>
            @foreach ($d['items'] as $item)
                @php($hot = $item['highlight'] === 'yes')
                <div @class(['card plan-card relative flex flex-col p-7!', 'plan-hot' => $hot])>
                    @if ($item['badge'])<span class="plan-badge absolute -top-3 left-7 rounded-full px-3 py-1 text-xs font-bold">{{ $item['badge'] }}</span>@endif
                    <h3 class="text-sm font-bold tracking-wider uppercase">{{ $item['name'] }}</h3>
                    @if ($item['price'])
                        <div class="mt-4">
                            <span class="muted text-xs">mulai dari</span>
                            <div class="flex flex-wrap items-baseline gap-x-2">
                                <span class="price text-4xl font-extrabold tracking-tight">{{ $item['price'] }}</span>
                                @if ($item['old_price'])<span class="muted text-sm line-through">{{ $item['old_price'] }}</span>@endif
                            </div>
                        </div>
                    @endif
                    @if ($item['info'])<div class="price-info mt-3 self-start rounded-full px-3 py-1 text-xs font-semibold">⏱ {{ $item['info'] }}</div>@endif
                    @if ($item['features'])
                        <ul class="mt-6 flex-1 space-y-2.5 text-sm">
                            @foreach (preg_split('/\R/', $item['features']) as $feature)
                                @if (trim($feature) !== '')<li class="flex gap-2.5"><span class="plan-check mt-0.5 flex size-4 shrink-0 items-center justify-center rounded-full text-[10px] font-bold">✓</span><span>{{ trim($feature) }}</span></li>@endif
                            @endforeach
                        </ul>
                    @else
                        <div class="flex-1"></div>
                    @endif
                    @if ($site->whatsappUrl())
                        <a href="{{ $site->whatsappUrl('Halo, saya tertarik dengan paket '.$item['name']) }}" target="_blank" rel="noopener" @class(['btn mt-7 w-full', 'btn-outline' => ! $hot])>Pilih paket</a>
                    @endif
                </div>
            @endforeach
        </div>
        @if ($d['note'])<p class="muted mt-8 text-center text-sm">{{ $d['note'] }}</p>@endif
    </div>
</section>
