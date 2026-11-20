{{-- Project gallery: the first photo large, the rest beside it, captions set like an exhibition label. --}}
@php($items = array_values(array_filter($d['items'], fn ($item) => $site->image($item['image']))))
<section id="{{ $sectionId }}" class="sec interior-gallery">
    <div class="site-container">
        @if ($d['title'])
            <div class="mb-10 flex items-end justify-between gap-6 sm:mb-14">
                <h2 class="sec-title">{{ $d['title'] }}</h2>
                <span class="interior-count hidden sm:block">{{ str_pad((string) count($items), 2, '0', STR_PAD_LEFT) }} foto</span>
            </div>
        @endif
        <div @class(['grid gap-x-5 gap-y-8 sm:grid-cols-2', count($items) === 3 ? 'lg:grid-cols-3' : 'lg:grid-cols-4'])>
            @foreach ($items as $item)
                <figure @class(['group flex flex-col', 'sm:col-span-2 lg:row-span-2' => $loop->first])>
                    <div @class(['relative aspect-[4/3] overflow-hidden', 'lg:aspect-auto lg:min-h-80 lg:flex-1' => $loop->first])>
                        <img src="{{ $site->image($item['image']) }}" alt="{{ $item['caption'] }}" class="absolute inset-0 size-full object-cover transition duration-700 group-hover:scale-[1.03]" loading="lazy">
                    </div>
                    @if ($item['caption'])<figcaption class="interior-caption mt-3">{{ $item['caption'] }}</figcaption>@endif
                </figure>
            @endforeach
        </div>
    </div>
</section>
