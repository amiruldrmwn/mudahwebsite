{{-- Outlined cards with a mono index; several lines of text become tags (a tech stack). --}}
<section id="{{ $sectionId }}" class="sec">
    <div class="site-container">
        @if ($d['title'] || $d['subtitle'])
            <div class="agency-head">
                @if ($d['title'])<h2 class="sec-title">{{ $d['title'] }}</h2>@endif
                @if ($d['subtitle'])<p class="sec-sub max-w-xl">{{ $d['subtitle'] }}</p>@endif
            </div>
        @endif
        <div @class(['grid gap-5 sm:grid-cols-2', count($d['items']) === 4 ? 'lg:grid-cols-4' : 'lg:grid-cols-3'])>
            @foreach ($d['items'] as $item)
                @php($lines = array_values(array_filter(array_map('trim', preg_split('/\R/', $item['text'])), fn ($l) => $l !== '')))
                <div class="agency-card group flex flex-col">
                    @if ($site->image($item['image']))
                        <img src="{{ $site->image($item['image']) }}" alt="{{ $item['title'] }}" class="mb-5 aspect-[16/10] w-full rounded-md object-cover" loading="lazy">
                    @endif
                    <div class="flex items-center justify-between">
                        <span class="agency-mono text-sm" style="color: var(--brand)">/{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                        <span class="agency-arrow" aria-hidden="true">&nearr;</span>
                    </div>
                    <h3 class="mt-8 text-xl leading-snug font-bold">{{ $item['title'] }}</h3>
                    @if (count($lines) > 1)
                        <div class="mt-4 flex flex-wrap gap-2">
                            @foreach ($lines as $line)<span class="agency-tag">{{ ltrim($line, '-• ') }}</span>@endforeach
                        </div>
                    @elseif ($lines)
                        <p class="muted mt-3 leading-relaxed">{{ $lines[0] }}</p>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</section>
