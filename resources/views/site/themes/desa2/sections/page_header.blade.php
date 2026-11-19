<section id="{{ $sectionId }}" class="desa2-hero relative overflow-hidden">
    @if ($site->image($d['image']))<img src="{{ $site->image($d['image']) }}" alt="" class="absolute inset-0 size-full object-cover">@endif
    <div class="desa2-shade absolute inset-0"></div>
    <div class="site-container relative py-16 text-center sm:py-24">
        <h1 class="mx-auto max-w-3xl text-4xl text-white uppercase sm:text-5xl">{{ $d['title'] }}</h1>
        @if ($d['subtitle'])<p class="mx-auto mt-3 max-w-2xl text-lg text-white/85">{{ $d['subtitle'] }}</p>@endif
    </div>
</section>
