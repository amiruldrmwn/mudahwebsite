{{-- Portfolio as a masonry wall. --}}
<section id="{{ $sectionId }}" class="sec">
    <div class="site-container">
        @if ($d['title'])<div class="sec-head"><h2 class="sec-title">{{ $d['title'] }}</h2></div>@endif
        <div class="columns-2 gap-4 md:columns-3 [&>figure]:mb-4">
            @foreach ($d['items'] as $item)
                @if ($site->image($item['image']))
                    <figure class="group relative break-inside-avoid overflow-hidden">
                        <img src="{{ $site->image($item['image']) }}" alt="{{ $item['caption'] }}" class="w-full transition duration-700 group-hover:scale-105" loading="lazy">
                        @if ($item['caption'])<figcaption class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/70 to-transparent p-4 text-xs tracking-[0.2em] text-white uppercase opacity-0 transition group-hover:opacity-100">{{ $item['caption'] }}</figcaption>@endif
                    </figure>
                @endif
            @endforeach
        </div>
    </div>
</section>
