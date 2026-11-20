{{-- Without photos a price list becomes a gold-rimmed price board (pulled up over the hero when it follows it);
     with photos it uses the shared product cards. --}}
@if (collect($d['items'])->contains(fn ($item) => $site->image($item['image'])))
    @include('site.sections.pricelist')
@else
    @php($order = $d['order_button'] === 'yes' && $site->whatsappUrl())
    <section id="{{ $sectionId }}" @class(['relative z-10', '-mt-16 pb-16 sm:-mt-20 sm:pb-24' => ($index ?? 0) === 1, 'sec' => ($index ?? 0) !== 1])>
        <div class="site-container">
            <div class="emas-board mx-auto max-w-4xl">
                <div class="emas-board-head flex flex-wrap items-end justify-between gap-4 px-5 py-5 sm:px-8">
                    <div>
                        @if ($d['title'])<h2 class="text-2xl text-white sm:text-3xl">{{ $d['title'] }}</h2>@endif
                        @if ($d['subtitle'])<p class="mt-1 flex items-center gap-2 text-sm text-white/70"><svg viewBox="0 0 24 24" class="size-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2" stroke-linecap="round"/></svg>{{ $d['subtitle'] }}</p>@endif
                    </div>
                    @if ($order)<a href="{{ $site->whatsappUrl('Halo, saya ingin tanya harga emas hari ini') }}" target="_blank" rel="noopener" class="btn emas-gold px-4! py-2! text-sm">Tanya via WhatsApp</a>@endif
                </div>
                <div class="emas-board-body">
                    @foreach ($d['items'] as $item)
                        <div class="emas-row grid gap-x-6 gap-y-1 px-5 py-4 sm:grid-cols-[1fr_auto] sm:px-8">
                            <div>
                                <h3 class="text-base font-semibold">{{ $item['name'] }}</h3>
                                @if ($item['description'])<p class="muted text-sm">{{ $item['description'] }}</p>@endif
                            </div>
                            <div class="sm:text-right">
                                @if ($item['price'])<div class="emas-price text-lg font-bold">{{ $item['price'] }}</div>@endif
                                @if ($item['info'])<div class="muted text-xs">{{ $item['info'] }}</div>@endif
                            </div>
                        </div>
                    @endforeach
                </div>
                @if ($d['note'])
                    <p class="emas-note flex gap-2.5 px-5 py-4 text-sm sm:px-8"><svg viewBox="0 0 24 24" class="mt-0.5 size-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path d="M12 11v5M12 8h.01" stroke-linecap="round"/></svg><span>{{ $d['note'] }}</span></p>
                @endif
            </div>
        </div>
    </section>
@endif
