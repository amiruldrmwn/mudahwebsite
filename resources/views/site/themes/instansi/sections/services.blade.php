{{-- Service cards: several lines of text are listed as numbered requirements. --}}
<section id="{{ $sectionId }}" class="sec">
    <div class="site-container">
        @if ($d['title'] || $d['subtitle'])
            <div class="instansi-head">
                @if ($d['title'])<h2 class="sec-title">{{ $d['title'] }}</h2>@endif
                @if ($d['subtitle'])<p class="sec-sub">{{ $d['subtitle'] }}</p>@endif
            </div>
        @endif
        <div @class(['grid gap-5 sm:grid-cols-2', count($d['items']) === 4 ? 'lg:grid-cols-4' : 'lg:grid-cols-3'])>
            @foreach ($d['items'] as $item)
                @php($lines = array_values(array_filter(array_map('trim', preg_split('/\R/', $item['text'])), fn ($l) => $l !== '')))
                <div class="instansi-svc flex flex-col">
                    @if ($site->image($item['image']))<img src="{{ $site->image($item['image']) }}" alt="{{ $item['title'] }}" class="mb-4 aspect-[16/10] w-full rounded object-cover" loading="lazy">@endif
                    <div class="flex items-center gap-3">
                        <span class="instansi-icon instansi-icon-sm"><svg viewBox="0 0 24 24" class="size-5" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M7 3h7l4 4v14H7z"/><path d="M14 3v4h4M10 12h5M10 16h5"/></svg></span>
                        <h3 class="text-lg leading-snug font-bold">{{ $item['title'] }}</h3>
                    </div>
                    @if (count($lines) > 1)
                        <p class="mt-4 text-xs font-bold tracking-wider uppercase" style="color: var(--muted)">Persyaratan</p>
                        <ol class="mt-2 space-y-2 text-[0.95rem] leading-snug">
                            @foreach ($lines as $line)<li class="flex gap-2.5"><span class="instansi-n">{{ $loop->iteration }}</span><span>{{ ltrim($line, '-• ') }}</span></li>@endforeach
                        </ol>
                    @elseif ($lines)
                        <p class="muted mt-3 leading-relaxed">{{ $lines[0] }}</p>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</section>
