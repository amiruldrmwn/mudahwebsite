<section id="{{ $sectionId }}" class="sec">
    <div class="site-container">
        @if ($d['title'] || $d['subtitle'])
            <div class="sec-head">
                @if ($d['title'])<h2 class="sec-title">{{ $d['title'] }}</h2>@endif
                @if ($d['subtitle'])<p class="sec-sub">{{ $d['subtitle'] }}</p>@endif
            </div>
        @endif
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($d['items'] as $item)
                @php($detail = $item['url'] ?: $site->whatsappUrl('Halo, saya tertarik dengan paket '.$item['name'].($item['date'] ? ' keberangkatan '.$item['date'] : '')))
                <article class="card package-card flex flex-col overflow-hidden p-0!">
                    <div class="relative">
                        @if ($site->image($item['image']))
                            <img src="{{ $site->image($item['image']) }}" alt="{{ $item['name'] }}" class="aspect-[16/10] w-full object-cover" loading="lazy">
                        @else
                            <div class="aspect-[16/10] w-full" style="background: var(--brand-soft)"></div>
                        @endif
                        @if ($item['date'] || $item['duration'])
                            <div class="absolute bottom-3 left-3 flex gap-2 text-xs font-semibold">
                                @if ($item['date'])<span class="package-chip rounded-full px-3 py-1">{{ $item['date'] }}</span>@endif
                                @if ($item['duration'])<span class="package-chip rounded-full px-3 py-1">{{ $item['duration'] }}</span>@endif
                            </div>
                        @endif
                    </div>
                    <div class="flex flex-1 flex-col p-5">
                        <h3 class="text-lg leading-snug font-bold">{{ $item['name'] }}</h3>
                        @if ($item['airline'] || $item['rating'])
                            <div class="mt-3 flex flex-wrap gap-2 text-xs">
                                @if ($item['airline'])<span class="rounded-full border px-2.5 py-1" style="border-color: var(--line)">✈ {{ $item['airline'] }}</span>@endif
                                @if ($item['rating'])<span class="rounded-full border px-2.5 py-1" style="border-color: var(--line)">★ {{ $item['rating'] }}</span>@endif
                            </div>
                        @endif
                        @if ($item['hotels'])
                            <ul class="muted mt-3 space-y-1 text-sm">
                                @foreach (preg_split('/\R/', $item['hotels']) as $hotel)
                                    @if (trim($hotel) !== '')<li class="flex gap-2"><span aria-hidden="true">🏨</span>{{ trim($hotel) }}</li>@endif
                                @endforeach
                            </ul>
                        @endif
                        <div class="mt-auto flex items-end justify-between gap-3 border-t pt-4" style="border-color: var(--line); margin-top: 1.25rem">
                            @if ($item['price'])
                                <div>
                                    <div class="muted text-xs">Harga mulai</div>
                                    <div class="price text-lg font-bold">{{ $item['price'] }}<span class="muted text-xs font-normal"> /orang</span></div>
                                </div>
                            @else
                                <span></span>
                            @endif
                            @if ($detail)<a href="{{ $detail }}" @if (! $item['url']) target="_blank" rel="noopener" @endif class="btn px-4! py-2! text-sm">Detail</a>@endif
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
        @if ($d['button_label'] && $d['button_url'])
            <div class="mt-10 text-center"><a href="{{ $d['button_url'] }}" class="btn btn-accent">{{ $d['button_label'] }} &rarr;</a></div>
        @endif
    </div>
</section>
