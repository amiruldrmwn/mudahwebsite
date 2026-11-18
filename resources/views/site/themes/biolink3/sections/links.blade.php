{{-- A group of links as dark glass cards; a link with a picture shows it as a cover on the left. --}}
<section id="{{ $sectionId }}" class="mx-auto max-w-md px-6 py-3">
    @if ($d['title'])<h2 class="bl3-title mb-3 text-xs font-semibold tracking-[0.2em] uppercase">{{ $d['title'] }}</h2>@endif
    <div class="flex flex-col gap-3">
        @foreach ($d['items'] as $item)
            @php($external = str_starts_with($item['url'], 'http'))
            <a href="{{ $item['url'] ?: '#' }}" @if ($external) target="_blank" rel="noopener" @endif class="bl3-card link-row flex items-center gap-3 rounded-2xl p-2.5 pr-4">
                @if ($site->image($item['image']))
                    <img src="{{ $site->image($item['image']) }}" alt="" class="size-14 shrink-0 rounded-xl object-cover">
                @else
                    <span class="bl3-dot ml-1.5 size-2.5 shrink-0 rounded-full" aria-hidden="true"></span>
                @endif
                <span class="min-w-0 flex-1 text-left">
                    <span class="block text-sm font-semibold">{{ $item['title'] }}</span>
                    @if ($item['text'])<span class="block truncate text-xs opacity-60">{{ $item['text'] }}</span>@endif
                </span>
                @if ($item['badge'])<span class="bl3-badge shrink-0 rounded-full px-2.5 py-0.5 text-[10px] font-bold">{{ $item['badge'] }}</span>@endif
            </a>
        @endforeach
    </div>
</section>
