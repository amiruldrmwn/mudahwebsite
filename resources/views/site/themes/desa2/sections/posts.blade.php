{{-- News cards with the date in a coloured corner tab. --}}
<section id="{{ $sectionId }}" class="sec">
    <div class="site-container">
        @if ($d['title'] || $d['subtitle'])
            <div class="sec-head">
                @if ($d['title'])<h2 class="sec-title desa2-big">{{ $d['title'] }}</h2>@endif
                @if ($d['subtitle'])<p class="sec-sub">{{ $d['subtitle'] }}</p>@endif
            </div>
        @endif
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($d['items'] as $item)
                <article class="desa2-news relative flex flex-col overflow-hidden">
                    @if ($site->image($item['image']))<img src="{{ $site->image($item['image']) }}" alt="{{ $item['title'] }}" class="aspect-[16/10] w-full object-cover" loading="lazy">@endif
                    <div class="flex flex-1 flex-col p-6 pb-14">
                        @if ($item['category'])<span class="desa2-cat">{{ $item['category'] }}</span>@endif
                        <h3 class="mt-2 text-lg leading-snug font-semibold">{{ $item['title'] }}</h3>
                        @if ($item['text'])<p class="muted mt-2 text-sm leading-relaxed">{{ $item['text'] }}</p>@endif
                        @if ($item['url'])<a href="{{ $item['url'] }}" class="mt-3 text-sm font-semibold" style="color: var(--brand)">Baca selengkapnya &rarr;</a>@endif
                    </div>
                    @if ($item['date'])<span class="desa2-date absolute right-0 bottom-0">{{ $item['date'] }}</span>@endif
                </article>
            @endforeach
        </div>
    </div>
</section>
