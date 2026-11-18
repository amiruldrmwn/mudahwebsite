{{-- Cards with photos use the shared layout; text-only programmes sit on a dark band. --}}
@if (collect($d['items'])->contains(fn ($item) => $site->image($item['image'])))
    @include('site.sections.services')
@else
    <section id="{{ $sectionId }}" class="sec sma-dark">
        <div class="site-container">
            @if ($d['title'] || $d['subtitle'])
                <div class="sec-head">
                    @if ($d['title'])<h2 class="sec-title">{{ $d['title'] }}</h2>@endif
                    @if ($d['subtitle'])<p class="sec-sub">{{ $d['subtitle'] }}</p>@endif
                </div>
            @endif
            <div @class(['grid gap-px overflow-hidden rounded-2xl border sm:grid-cols-2', count($d['items']) === 4 ? 'lg:grid-cols-4' : 'lg:grid-cols-3']) style="border-color: rgb(255 255 255 / .12); background: rgb(255 255 255 / .12)">
                @foreach ($d['items'] as $item)
                    <div class="p-7" style="background: #111113">
                        <div class="text-sm text-white/50">{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</div>
                        <h3 class="mt-6 text-xl font-semibold text-white">{{ $item['title'] }}</h3>
                        @if ($item['text'])<p class="mt-2 text-sm leading-relaxed text-white/65">{{ $item['text'] }}</p>@endif
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif
