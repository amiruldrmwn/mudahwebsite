{{-- Stacked link buttons, link-in-bio style. --}}
<section id="{{ $sectionId }}" class="sec links-sec">
    <div class="site-container">
        @if ($d['title'])<div class="sec-head"><h2 class="sec-title">{{ $d['title'] }}</h2></div>@endif
        <div class="mx-auto flex max-w-xl flex-col gap-3">
            @foreach ($d['items'] as $item)
                @php($external = str_starts_with($item['url'], 'http'))
                <a href="{{ $item['url'] ?: '#' }}" @if ($external) target="_blank" rel="noopener" @endif class="link-row card flex items-center gap-4 p-3! transition hover:-translate-y-0.5 hover:shadow-md">
                    @if ($site->image($item['image']))
                        <img src="{{ $site->image($item['image']) }}" alt="" class="size-12 shrink-0 object-cover" style="border-radius: calc(var(--radius) * .75)" loading="lazy">
                    @else
                        <span class="link-icon flex size-12 shrink-0 items-center justify-center text-lg font-bold" style="border-radius: calc(var(--radius) * .75); background: var(--brand-soft); color: var(--brand)">{{ mb_strtoupper(mb_substr($item['title'], 0, 1)) }}</span>
                    @endif
                    <span class="min-w-0 flex-1">
                        <span class="flex flex-wrap items-center gap-2 font-semibold">{{ $item['title'] }}@if ($item['badge'])<span class="link-badge rounded-full px-2 py-0.5 text-[11px] font-semibold" style="background: var(--brand-soft); color: var(--brand)">{{ $item['badge'] }}</span>@endif</span>
                        @if ($item['text'])<span class="muted mt-0.5 block text-sm">{{ $item['text'] }}</span>@endif
                    </span>
                    <svg class="muted size-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="m9 6 6 6-6 6"/></svg>
                </a>
            @endforeach
        </div>
    </div>
</section>
