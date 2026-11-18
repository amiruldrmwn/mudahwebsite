{{-- Bikes as soft cards with the daily price on the photo. --}}
<section id="{{ $sectionId }}" class="sec catalog">
    <div class="site-container">
        @if ($d['title'] || $d['subtitle'])
            <div class="sec-head">
                @if ($d['title'])<h2 class="sec-title">{{ $d['title'] }}</h2>@endif
                @if ($d['subtitle'])<p class="sec-sub">{{ $d['subtitle'] }}</p>@endif
            </div>
        @endif
        <div @class(['grid gap-5 sm:grid-cols-2', count($d['items']) === 4 ? 'lg:grid-cols-4' : 'lg:grid-cols-3'])>
            @foreach ($d['items'] as $item)
                @php($link = $item['url'] ?: $site->whatsappUrl('Halo, saya mau sewa '.$item['name'].($item['price'] ? ' ('.$item['price'].$item['unit'].')' : '')))
                <article class="motor-card flex flex-col p-3">
                    <div class="relative overflow-hidden rounded-2xl">
                        @if ($site->image($item['image']))<img src="{{ $site->image($item['image']) }}" alt="{{ $item['name'] }}" class="aspect-square w-full object-cover transition duration-500 hover:scale-105" loading="lazy">@endif
                        @if ($item['badge'])<span class="absolute top-3 left-3 rounded-full bg-white/95 px-3 py-1 text-xs font-bold">{{ $item['badge'] }}</span>@endif
                        @if ($item['price'])<span class="motor-price absolute right-3 bottom-3 rounded-full px-3 py-1.5 text-sm font-bold">{{ $item['price'] }}<span class="font-medium opacity-80">{{ $item['unit'] }}</span></span>@endif
                    </div>
                    <div class="flex flex-1 flex-col px-2 pt-4 pb-1">
                        @if ($item['category'])<span class="motor-cat text-xs font-semibold">{{ $item['category'] }}</span>@endif
                        <h3 class="text-lg font-bold">{{ $item['name'] }}</h3>
                        @if ($item['specs'])
                            <ul class="muted mt-2 space-y-1 text-sm">
                                @foreach (preg_split('/\R/', $item['specs']) as $spec)
                                    @if (trim($spec) !== '')<li class="flex items-center gap-2"><span class="motor-dot"></span>{{ trim($spec) }}</li>@endif
                                @endforeach
                            </ul>
                        @endif
                        @if ($link)<div class="mt-auto pt-4"><a href="{{ $link }}" @if (! $item['url']) target="_blank" rel="noopener" @endif class="btn w-full py-2.5! text-sm">{{ $d['button_label'] ?: 'Sewa' }}</a></div>@endif
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>
