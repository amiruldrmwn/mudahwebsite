{{-- Category tiles with the caption on the photo. --}}
<section id="{{ $sectionId }}" class="sec">
    <div class="site-container">
        @if ($d['title'])<div class="sec-head"><h2 class="sec-title">{{ $d['title'] }}</h2></div>@endif
        <div class="grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-5">
            @foreach ($d['items'] as $item)
                @if ($site->image($item['image']))
                    <figure class="group relative overflow-hidden rounded-2xl">
                        <img src="{{ $site->image($item['image']) }}" alt="{{ $item['caption'] }}" class="aspect-square w-full object-cover transition duration-500 group-hover:scale-105" loading="lazy">
                        @if ($item['caption'])<figcaption class="absolute inset-x-3 bottom-3 rounded-full bg-white px-4 py-2 text-center text-sm font-bold">{{ $item['caption'] }}</figcaption>@endif
                    </figure>
                @endif
            @endforeach
        </div>
    </div>
</section>
