<section id="{{ $sectionId }}" class="sec sec-alt">
    <div class="site-container">
        @if ($d['title'] || $d['subtitle'])
            <div class="sec-head">
                @if ($d['title'])<h2 class="sec-title">{{ $d['title'] }}</h2>@endif
                @if ($d['subtitle'])<p class="sec-sub">{{ $d['subtitle'] }}</p>@endif
            </div>
        @endif
        <div @class(['grid gap-6 sm:grid-cols-2', count($d['items']) === 4 ? 'lg:grid-cols-4' : 'lg:grid-cols-3'])>
            @foreach ($d['items'] as $item)
                @if ($site->image($item['image']))
                    <div class="card card-media flex flex-col overflow-hidden p-0!">
                        <img src="{{ $site->image($item['image']) }}" alt="{{ $item['title'] }}" class="aspect-[16/10] w-full object-cover transition duration-500 hover:scale-105" loading="lazy">
                        <div class="flex-1 p-6">
                            <h3 class="text-xl font-semibold">{{ $item['title'] }}</h3>
                            @include('site.partials.card-text', ['text' => $item['text']])
                        </div>
                    </div>
                @else
                    <div class="card">
                        <div class="svc-num mb-5 flex size-12 items-center justify-center text-lg font-bold" style="border-radius: calc(var(--radius) * .75); background: var(--brand-soft); color: var(--brand)">{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</div>
                        <h3 class="text-xl font-semibold">{{ $item['title'] }}</h3>
                        @include('site.partials.card-text', ['text' => $item['text']])
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</section>
