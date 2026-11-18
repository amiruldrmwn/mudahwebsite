<section id="{{ $sectionId }}" class="eo-hero relative overflow-hidden">
    @if ($site->image($d['image']))<img src="{{ $site->image($d['image']) }}" alt="" class="absolute inset-0 size-full object-cover opacity-30">@endif
    <div class="eo-glow absolute inset-0"></div>
    <div class="site-container relative py-16 text-center sm:py-24">
        <span class="eo-eyebrow">{{ $page?->title }}</span>
        <h1 class="mx-auto mt-4 max-w-3xl text-3xl break-words text-white sm:text-6xl">{{ $d['title'] }}</h1>
        @if ($d['subtitle'])<p class="mx-auto mt-4 max-w-2xl text-lg text-white/75">{{ $d['subtitle'] }}</p>@endif
    </div>
</section>
