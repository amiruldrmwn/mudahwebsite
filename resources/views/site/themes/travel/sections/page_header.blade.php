<section id="{{ $sectionId }}" class="travel-page relative overflow-hidden">
    @if ($site->image($d['image']))<img src="{{ $site->image($d['image']) }}" alt="" class="absolute inset-0 size-full object-cover">@endif
    <div class="travel-shade absolute inset-0"></div>
    <div class="site-container relative py-16 sm:py-24">
        <span class="travel-script">{{ $page?->title }}</span>
        <h1 class="mt-2 max-w-3xl text-4xl text-white sm:text-6xl">{{ $d['title'] }}</h1>
        @if ($d['subtitle'])<p class="mt-4 max-w-2xl text-lg text-white/85">{{ $d['subtitle'] }}</p>@endif
    </div>
</section>
