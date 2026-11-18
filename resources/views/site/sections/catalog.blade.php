<section id="{{ $sectionId }}" class="sec catalog">
    <div class="site-container">
        @if ($d['title'] || $d['subtitle'])
            <div class="sec-head">
                @if ($d['title'])<h2 class="sec-title">{{ $d['title'] }}</h2>@endif
                @if ($d['subtitle'])<p class="sec-sub">{{ $d['subtitle'] }}</p>@endif
            </div>
        @endif
        <div @class(['grid gap-6 sm:grid-cols-2', count($d['items']) === 4 ? 'lg:grid-cols-4' : 'lg:grid-cols-3'])>
            @foreach ($d['items'] as $item)
                @php($link = $item['url'] ?: $site->whatsappUrl('Halo, saya mau tanya '.$item['name'].($item['price'] ? ' ('.$item['price'].$item['unit'].')' : '')))
                <article class="card catalog-card flex flex-col overflow-hidden p-0!">
                    <div class="catalog-media relative overflow-hidden">
                        @if ($site->image($item['image']))
                            <img src="{{ $site->image($item['image']) }}" alt="{{ $item['name'] }}" class="aspect-[4/3] w-full object-cover transition duration-500 hover:scale-105" loading="lazy">
                        @else
                            <div class="aspect-[4/3] w-full" style="background: var(--brand-soft)"></div>
                        @endif
                        @if ($item['badge'])<span class="catalog-badge absolute top-3 left-3 rounded-full px-3 py-1 text-xs font-bold">{{ $item['badge'] }}</span>@endif
                    </div>
                    <div class="flex flex-1 flex-col p-5">
                        @if ($item['category'])<span class="catalog-cat text-xs font-semibold tracking-wider uppercase">{{ $item['category'] }}</span>@endif
                        <h3 class="mt-1 text-xl leading-snug font-bold">{{ $item['name'] }}</h3>
                        @if ($item['specs'])
                            <ul class="mt-3 flex flex-wrap gap-2 text-xs">
                                @foreach (preg_split('/\R/', $item['specs']) as $spec)
                                    @if (trim($spec) !== '')<li class="catalog-spec rounded-full px-2.5 py-1">{{ trim($spec) }}</li>@endif
                                @endforeach
                            </ul>
                        @endif
                        <div class="mt-auto flex items-end justify-between gap-3 pt-5">
                            @if ($item['price'])
                                <div><span class="price text-2xl font-extrabold tracking-tight">{{ $item['price'] }}</span>@if ($item['unit'])<span class="muted text-sm"> {{ $item['unit'] }}</span>@endif</div>
                            @else
                                <span></span>
                            @endif
                            @if ($link)<a href="{{ $link }}" @if (! $item['url']) target="_blank" rel="noopener" @endif class="btn px-4! py-2! text-sm">{{ $d['button_label'] ?: 'Pesan' }}</a>@endif
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>
