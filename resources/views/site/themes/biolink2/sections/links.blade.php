{{-- A group of links in a rounded outline box, each link a pill with a hard shadow. --}}
<section id="{{ $sectionId }}" class="mx-auto max-w-md px-6 py-4">
    <div class="bl2-box px-5 py-6">
        @if ($d['title'])<h2 class="bl2-title text-center text-3xl">{{ $d['title'] }}</h2>@endif
        <div class="mt-5 flex flex-col gap-4">
            @foreach ($d['items'] as $item)
                @php($external = str_starts_with($item['url'], 'http'))
                <a href="{{ $item['url'] ?: '#' }}" @if ($external) target="_blank" rel="noopener" @endif class="bl2-pill link-row flex items-center justify-center gap-2 px-5 py-3 text-center text-sm font-bold">
                    @if ($site->image($item['image']))<img src="{{ $site->image($item['image']) }}" alt="" class="size-7 shrink-0 rounded-full object-cover">@endif
                    <span>{{ $item['title'] }}</span>
                    @if ($item['badge'])<span class="bl2-badge rounded-full px-2 py-0.5 text-[10px]">{{ $item['badge'] }}</span>@endif
                </a>
                @if ($item['text'])<p class="-mt-2 text-center text-xs opacity-75">{{ $item['text'] }}</p>@endif
            @endforeach
        </div>
    </div>
</section>
