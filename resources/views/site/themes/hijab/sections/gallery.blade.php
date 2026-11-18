{{-- Shop-by-category circles. --}}
<section id="{{ $sectionId }}" class="sec">
    <div class="site-container">
        @if ($d['title'])<div class="sec-head"><h2 class="sec-title">{{ $d['title'] }}</h2></div>@endif
        <div class="flex flex-wrap justify-center gap-x-8 gap-y-10">
            @foreach ($d['items'] as $item)
                @if ($site->image($item['image']))
                    <figure class="w-28 text-center sm:w-36">
                        <img src="{{ $site->image($item['image']) }}" alt="{{ $item['caption'] }}" class="aspect-square w-full rounded-full object-cover object-top transition duration-500 hover:scale-105" loading="lazy">
                        @if ($item['caption'])<figcaption class="mt-3 text-[11px] tracking-[0.22em] uppercase">{{ $item['caption'] }}</figcaption>@endif
                    </figure>
                @endif
            @endforeach
        </div>
    </div>
</section>
