{{-- Case studies: big image cards, the category as a tag and the date field as the result badge. --}}
<section id="{{ $sectionId }}" class="sec sec-alt">
    <div class="site-container">
        @if ($d['title'] || $d['subtitle'])
            <div class="agency-head">
                @if ($d['title'])<h2 class="sec-title">{{ $d['title'] }}</h2>@endif
                @if ($d['subtitle'])<p class="sec-sub max-w-xl">{{ $d['subtitle'] }}</p>@endif
            </div>
        @endif
        <div class="grid gap-6 md:grid-cols-2">
            @foreach ($d['items'] as $item)
                <article class="agency-case group flex flex-col">
                    @if ($site->image($item['image']))
                        <div class="relative overflow-hidden">
                            <img src="{{ $site->image($item['image']) }}" alt="{{ $item['title'] }}" class="aspect-[16/10] w-full object-cover transition duration-500 group-hover:scale-105" loading="lazy">
                            @if ($item['date'])<span class="agency-metric absolute bottom-4 left-4">&#8599; {{ $item['date'] }}</span>@endif
                        </div>
                    @endif
                    <div class="flex flex-1 flex-col p-6 sm:p-7">
                        @if ($item['category'])<span class="agency-mono text-xs tracking-wider uppercase" style="color: var(--brand)">{{ $item['category'] }}</span>@endif
                        @if ($item['date'] && ! $site->image($item['image']))<span class="agency-metric mt-3 self-start">&#8599; {{ $item['date'] }}</span>@endif
                        <h3 class="mt-3 text-xl leading-snug font-bold sm:text-2xl">{{ $item['title'] }}</h3>
                        @if ($item['text'])<p class="muted mt-3 flex-1 leading-relaxed">{{ $item['text'] }}</p>@endif
                        @if ($item['url'])<a href="{{ $item['url'] }}" class="agency-mono mt-5 text-sm font-bold" style="color: var(--brand)">Baca studi kasus &rarr;</a>@endif
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>
