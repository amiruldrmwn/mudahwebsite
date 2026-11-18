{{-- Car line-up with type filter chips; each card asks for a promo or a test drive on WhatsApp. --}}
@php($categories = collect($d['items'])->pluck('category')->filter()->unique()->values())
<section id="{{ $sectionId }}" class="sec catalog" data-car-filter>
    <div class="site-container">
        @if ($d['title'] || $d['subtitle'])
            <div class="sec-head">
                @if ($d['title'])<h2 class="sec-title">{{ $d['title'] }}</h2>@endif
                @if ($d['subtitle'])<p class="sec-sub">{{ $d['subtitle'] }}</p>@endif
            </div>
        @endif
        @if ($categories->count() > 1)
            <div class="mb-8 flex flex-wrap justify-center gap-2" role="group" aria-label="Filter tipe mobil">
                <button type="button" class="mobil-filter is-active" data-cat="">Semua</button>
                @foreach ($categories as $cat)<button type="button" class="mobil-filter" data-cat="{{ $cat }}">{{ $cat }}</button>@endforeach
            </div>
        @endif
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($d['items'] as $item)
                @php($ask = $item['url'] ?: $site->whatsappUrl('Halo, saya mau tanya promo '.$item['name']))
                <article class="mobil-car flex flex-col" data-cat="{{ $item['category'] }}">
                    <div class="mobil-car-media relative overflow-hidden">
                        @if ($site->image($item['image']))<img src="{{ $site->image($item['image']) }}" alt="{{ $item['name'] }}" class="aspect-[16/10] w-full object-cover transition duration-700 hover:scale-105" loading="lazy">@endif
                        @if ($item['badge'])<span class="absolute top-3 left-3 rounded-full bg-white px-3 py-1 text-xs font-bold shadow">{{ $item['badge'] }}</span>@endif
                    </div>
                    <div class="flex flex-1 flex-col px-1 pt-5">
                        <div class="flex items-baseline justify-between gap-3">
                            <h3 class="text-xl font-extrabold">{{ $item['name'] }}</h3>
                            @if ($item['category'])<span class="muted text-xs font-semibold tracking-wider uppercase">{{ $item['category'] }}</span>@endif
                        </div>
                        @if ($item['specs'])<p class="muted mt-1 text-sm">{{ collect(preg_split('/\R/', $item['specs']))->map(fn ($s) => trim($s))->filter()->implode(' · ') }}</p>@endif
                        @if ($item['price'])
                            <div class="mt-4"><span class="muted text-xs">Mulai dari</span><div class="price text-2xl font-extrabold tracking-tight">{{ $item['price'] }}@if ($item['unit'])<span class="muted text-sm font-medium"> {{ $item['unit'] }}</span>@endif</div></div>
                        @endif
                        <div class="mt-5 grid grid-cols-2 gap-2">
                            @if ($ask)<a href="{{ $ask }}" @if (! $item['url']) target="_blank" rel="noopener" @endif class="btn px-3! py-2.5! text-sm">{{ $d['button_label'] ?: 'Tanya Promo' }}</a>@endif
                            @if ($site->whatsappUrl())<a href="{{ $site->whatsappUrl('Halo, saya ingin test drive '.$item['name']) }}" target="_blank" rel="noopener" class="btn btn-outline px-3! py-2.5! text-sm">Test Drive</a>@endif
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
    <script>
        (() => {
            const root = document.currentScript.closest('[data-car-filter]');
            root.querySelectorAll('.mobil-filter').forEach((chip) => chip.addEventListener('click', () => {
                root.querySelectorAll('.mobil-filter').forEach((c) => c.classList.toggle('is-active', c === chip));
                root.querySelectorAll('.mobil-car').forEach((card) => { card.hidden = chip.dataset.cat !== '' && card.dataset.cat !== chip.dataset.cat; });
            }));
        })();
    </script>
</section>
