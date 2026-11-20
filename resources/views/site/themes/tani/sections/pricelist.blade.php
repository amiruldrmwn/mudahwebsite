@php
    $withPhotos = collect($d['items'])->contains(fn ($item) => $site->image($item['image']));
    $order = $d['order_button'] === 'yes' && $site->whatsappUrl();
@endphp
{{-- With photos: harvest cards with a hanging price tag. Without: ticket rows (farm visit packages). --}}
<section id="{{ $sectionId }}" class="sec pricelist">
    <div class="site-container">
        @if ($d['title'] || $d['subtitle'])
            <div class="sec-head">
                @if ($d['title'])<h2 class="sec-title">{{ $d['title'] }}</h2>@endif
                @if ($d['subtitle'])<p class="sec-sub">{{ $d['subtitle'] }}</p>@endif
            </div>
        @endif

        @if ($withPhotos)
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($d['items'] as $item)
                    <div class="tani-crop flex flex-col">
                        <div class="relative">
                            @if ($site->image($item['image']))
                                <img src="{{ $site->image($item['image']) }}" alt="{{ $item['name'] }}" class="aspect-[4/3] w-full object-cover" loading="lazy">
                            @else
                                <div class="tani-noimg aspect-[4/3] w-full"></div>
                            @endif
                            @if ($item['info'])<span class="tani-info absolute top-3 left-3">{{ $item['info'] }}</span>@endif
                            @if ($item['price'])<span class="tani-tag absolute -bottom-4 right-4">{{ $item['price'] }}</span>@endif
                        </div>
                        <div class="flex flex-1 flex-col p-5 pt-7">
                            <h3 class="text-xl leading-snug">{{ $item['name'] }}</h3>
                            @if ($item['description'])<p class="muted mt-1.5 flex-1 text-sm leading-relaxed">{{ $item['description'] }}</p>@else<div class="flex-1"></div>@endif
                            @if ($order)
                                <a href="{{ $site->whatsappUrl('Halo, saya ingin memesan '.$item['name']) }}" target="_blank" rel="noopener" class="tani-order mt-4">Pesan via WhatsApp &rarr;</a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="mx-auto grid max-w-5xl gap-5 md:grid-cols-2">
                @foreach ($d['items'] as $item)
                    <div class="tani-ticket">
                        <div class="min-w-0 flex-1">
                            @if ($item['info'])<span class="tani-info tani-info-soft">{{ $item['info'] }}</span>@endif
                            <h3 class="mt-2.5 text-lg leading-snug">{{ $item['name'] }}</h3>
                            @if ($item['description'])<p class="muted mt-1 text-sm leading-relaxed">{{ $item['description'] }}</p>@endif
                        </div>
                        @if ($item['price'])<div class="tani-ticket-price">{{ $item['price'] }}</div>@endif
                    </div>
                @endforeach
            </div>
        @endif

        @if ($d['note'] || ($order && ! $withPhotos))
            <div class="mt-10 flex flex-col items-center gap-5 text-center">
                @if ($d['note'])<p class="muted text-sm">{{ $d['note'] }}</p>@endif
                @if ($order && ! $withPhotos)
                    <a href="{{ $site->whatsappUrl('Halo, saya ingin reservasi '.$d['title']) }}" target="_blank" rel="noopener" class="btn">Reservasi via WhatsApp</a>
                @endif
            </div>
        @endif
    </div>
</section>
