<section id="{{ $sectionId }}" class="caleg-hero relative overflow-hidden">
    @if ($site->image($d['image']))<img src="{{ $site->image($d['image']) }}" alt="" class="absolute inset-0 size-full object-cover opacity-20">@endif
    <div class="caleg-band absolute"></div>
    <div class="site-container relative py-14 sm:py-20">
        <span class="caleg-eyebrow">{{ $page?->title }}</span>
        <h1 class="caleg-name mt-4 max-w-3xl text-white">{{ $d['title'] }}</h1>
        @if ($d['subtitle'])<p class="mt-4 max-w-2xl text-lg text-white/80">{{ $d['subtitle'] }}</p>@endif
    </div>
</section>
