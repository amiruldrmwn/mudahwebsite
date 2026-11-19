@php($round = collect($d['items'])->contains(fn ($item) => $site->image($item['image'])))
{{-- With photos: round pictures and uppercase captions (village potential). Without: icon cards. --}}
<section id="{{ $sectionId }}" class="sec">
    <div class="site-container">
        @if ($d['title'] || $d['subtitle'])
            <div class="sec-head">
                @if ($d['title'])<h2 class="sec-title desa2-big">{{ $d['title'] }}</h2>@endif
                @if ($d['subtitle'])<p class="sec-sub">{{ $d['subtitle'] }}</p>@endif
            </div>
        @endif
        <div @class(['grid gap-8 sm:grid-cols-2', count($d['items']) === 4 ? 'lg:grid-cols-4' : 'lg:grid-cols-3'])>
            @foreach ($d['items'] as $item)
                @if ($round)
                    <div class="text-center">
                        @if ($site->image($item['image']))<img src="{{ $site->image($item['image']) }}" alt="{{ $item['title'] }}" class="desa2-round mx-auto aspect-square w-full max-w-64 object-cover" loading="lazy">@endif
                        <h3 class="mt-5 text-base font-bold tracking-wide uppercase">{{ $item['title'] }}</h3>
                        @if ($item['text'])<p class="muted mx-auto mt-1 max-w-xs text-sm">{{ $item['text'] }}</p>@endif
                    </div>
                @else
                    <div class="desa2-tile text-left!">
                        <span class="desa2-num">{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                        <h3 class="mt-4 text-lg font-bold">{{ $item['title'] }}</h3>
                        @include('site.partials.card-text', ['text' => $item['text']])
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</section>
