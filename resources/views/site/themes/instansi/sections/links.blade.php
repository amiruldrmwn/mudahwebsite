{{-- Quick access tiles with an icon, pulled up against the hero. --}}
@php($icons = [
    '<path d="M7 3h7l4 4v14H7z"/><path d="M14 3v4h4M10 12h5M10 16h5"/>',
    '<path d="M4 5h16v11H8l-4 4z"/><path d="M8 9h8M8 12h5"/>',
    '<path d="M4 5h13v14H6a2 2 0 0 1-2-2zM17 9h3v8a2 2 0 0 1-2 2"/><path d="M8 9h5M8 13h5"/>',
    '<path d="M4 21h16M6 21V10M18 21V10M10 21v-6h4v6M3 10l9-6 9 6"/>',
    '<path d="M4 4v16h16"/><path d="M8 16v-3M12 16V9M16 16v-5"/>',
    '<path d="M12 21s-7-6.2-7-11.5a7 7 0 0 1 14 0C19 14.8 12 21 12 21z"/><circle cx="12" cy="9.5" r="2.5"/>',
])
<section id="{{ $sectionId }}" class="instansi-links relative z-10">
    <div class="site-container">
        @if ($d['title'])<h2 class="sr-only">{{ $d['title'] }}</h2>@endif
        <div @class(['grid grid-cols-2 gap-3 sm:gap-4', count($d['items']) >= 4 ? 'lg:grid-cols-4' : 'lg:grid-cols-3'])>
            @foreach ($d['items'] as $item)
                @php($external = str_starts_with($item['url'], 'http'))
                <a href="{{ $item['url'] ?: '#' }}" @if ($external) target="_blank" rel="noopener" @endif class="instansi-tile group">
                    @if ($site->image($item['image']))
                        <img src="{{ $site->image($item['image']) }}" alt="" class="size-11 shrink-0 object-contain">
                    @else
                        <span class="instansi-icon"><svg viewBox="0 0 24 24" class="size-6" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">{!! $icons[$loop->index % count($icons)] !!}</svg></span>
                    @endif
                    <span class="min-w-0 flex-1">
                        <span class="block font-bold">{{ $item['title'] }}@if ($item['badge']) <span class="instansi-badge">{{ $item['badge'] }}</span>@endif</span>
                        @if ($item['text'])<span class="muted mt-0.5 block text-sm leading-snug">{{ $item['text'] }}</span>@endif
                    </span>
                    <span class="instansi-go hidden sm:flex" aria-hidden="true">&rarr;</span>
                </a>
            @endforeach
        </div>
    </div>
</section>
