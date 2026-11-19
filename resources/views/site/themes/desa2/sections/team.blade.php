{{-- Officials as photo cards with a coloured name bar. --}}
<section id="{{ $sectionId }}" class="sec">
    <div class="site-container">
        @if ($d['title'] || $d['subtitle'])
            <div class="sec-head">
                @if ($d['title'])<h2 class="sec-title desa2-big">{{ $d['title'] }}</h2>@endif
                @if ($d['subtitle'])<p class="sec-sub">{{ $d['subtitle'] }}</p>@endif
            </div>
        @endif
        <div class="grid grid-cols-2 gap-4 sm:gap-6 lg:grid-cols-4">
            @foreach ($d['items'] as $item)
                <figure class="desa2-person overflow-hidden">
                    @if ($site->image($item['photo']))
                        <img src="{{ $site->image($item['photo']) }}" alt="{{ $item['name'] }}" class="aspect-[4/5] w-full object-cover object-top" loading="lazy">
                    @else
                        <div class="flex aspect-[4/5] w-full items-center justify-center text-5xl font-bold" style="background: var(--brand-soft); color: var(--brand)">{{ mb_substr($item['name'], 0, 1) }}</div>
                    @endif
                    <figcaption class="desa2-namebar">
                        <span class="block font-bold">{{ $item['name'] }}</span>
                        @if ($item['role'])<span class="block text-xs opacity-85">{{ $item['role'] }}</span>@endif
                    </figcaption>
                </figure>
            @endforeach
        </div>
    </div>
</section>
