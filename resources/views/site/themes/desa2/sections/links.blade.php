{{-- Quick links: the heading on the left, icon cards on the right. --}}
@php($icons = [
    '<path d="M4 21h16M6 21V10M18 21V10M10 21v-6h4v6M3 10l9-6 9 6"/><path d="M12 4V1.5h3"/>',
    '<path d="M4 4v16h16"/><path d="M8 16v-3M12 16V9M16 16v-5M7 10l4-4 3 3 5-5"/>',
    '<path d="M7 3h7l4 4v14H7z"/><path d="M14 3v4h4M10 12h5M10 16h5"/>',
    '<path d="M4 5h13v14H6a2 2 0 0 1-2-2zM17 9h3v8a2 2 0 0 1-2 2"/><path d="M8 9h5M8 13h5"/>',
    '<path d="M3 9l2-5h14l2 5M4 9v11h16V9M3 9h18M9 20v-6h6v6"/>',
    '<path d="M4 5h16v14H4z"/><path d="M4 15l5-5 4 4 3-3 4 4"/><circle cx="15.5" cy="8.5" r="1.5"/>',
])
<section id="{{ $sectionId }}" class="sec">
    <div class="site-container grid items-center gap-10 lg:grid-cols-2">
        <div>
            @if ($d['title'])<h2 class="sec-title desa2-big">{{ $d['title'] }}</h2>@endif
            <p class="mt-3 max-w-md text-lg leading-relaxed">Melalui website ini Anda dapat menjelajahi segala hal tentang desa: pemerintahan, penduduk, anggaran, potensi, dan berita desa.</p>
        </div>
        <div class="grid grid-cols-2 gap-4 sm:gap-6">
            @foreach ($d['items'] as $item)
                <a href="{{ $item['url'] ?: '#' }}" class="desa2-tile">
                    @if ($site->image($item['image']))
                        <img src="{{ $site->image($item['image']) }}" alt="" class="size-14 object-contain">
                    @else
                        <svg viewBox="0 0 24 24" class="size-14" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">{!! $icons[$loop->index % count($icons)] !!}</svg>
                    @endif
                    <span class="mt-4 block text-sm font-bold tracking-wide uppercase">{{ $item['title'] }}</span>
                    @if ($item['text'])<span class="muted mt-1 block text-xs">{{ $item['text'] }}</span>@endif
                </a>
            @endforeach
        </div>
    </div>
</section>
