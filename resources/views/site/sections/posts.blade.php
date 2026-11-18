<section id="{{ $sectionId }}" class="sec">
    <div class="site-container">
        @if ($d['title'] || $d['subtitle'])
            <div class="sec-head">
                @if ($d['title'])<h2 class="sec-title">{{ $d['title'] }}</h2>@endif
                @if ($d['subtitle'])<p class="sec-sub">{{ $d['subtitle'] }}</p>@endif
            </div>
        @endif
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($d['items'] as $item)
                <article class="card post-card flex flex-col overflow-hidden p-0!">
                    @if ($site->image($item['image']))
                        <div class="overflow-hidden"><img src="{{ $site->image($item['image']) }}" alt="{{ $item['title'] }}" class="aspect-[16/10] w-full object-cover transition duration-500 hover:scale-105" loading="lazy"></div>
                    @endif
                    <div class="flex flex-1 flex-col p-6">
                        @if ($item['category'] || $item['date'])
                            <div class="mb-3 flex flex-wrap items-center gap-3 text-xs">
                                @if ($item['category'])<span class="post-badge rounded-full px-2.5 py-1 font-semibold" style="background: var(--brand); color: var(--on-brand)">{{ $item['category'] }}</span>@endif
                                @if ($item['date'])<span class="muted">{{ $item['date'] }}</span>@endif
                            </div>
                        @endif
                        <h3 class="text-lg leading-snug font-semibold">{{ $item['title'] }}</h3>
                        @if ($item['text'])<p class="muted mt-2 flex-1 text-sm leading-relaxed">{{ $item['text'] }}</p>@endif
                        @if ($item['url'])<a href="{{ $item['url'] }}" class="mt-4 text-sm font-semibold" style="color: var(--brand)">Baca selengkapnya &rarr;</a>@endif
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>
