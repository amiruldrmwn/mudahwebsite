<section id="{{ $sectionId }}" class="masjid-head relative overflow-hidden">
    @if ($site->image($d['image']))<img src="{{ $site->image($d['image']) }}" alt="" class="absolute inset-0 size-full object-cover opacity-20">@endif
    <div class="site-container relative py-14 text-center sm:py-20">
        <span class="masjid-eyebrow text-[#e4c46a]!">{{ $page?->title }}</span>
        <h1 class="mx-auto mt-3 max-w-3xl text-4xl text-white sm:text-6xl">{{ $d['title'] }}</h1>
        @if ($d['subtitle'])<p class="mx-auto mt-4 max-w-2xl text-lg text-white/80">{{ $d['subtitle'] }}</p>@endif
    </div>
</section>
