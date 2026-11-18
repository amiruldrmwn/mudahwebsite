<section id="{{ $sectionId }}" class="desa-head relative overflow-hidden">
    @if ($site->image($d['image']))<img src="{{ $site->image($d['image']) }}" alt="" class="absolute inset-0 size-full object-cover opacity-25">@endif
    <div class="site-container relative py-12 sm:py-16">
        <p class="text-sm text-white/70">Beranda / {{ $page?->title }}</p>
        <h1 class="mt-2 max-w-3xl text-3xl text-white sm:text-5xl">{{ $d['title'] }}</h1>
        @if ($d['subtitle'])<p class="mt-3 max-w-2xl text-lg text-white/80">{{ $d['subtitle'] }}</p>@endif
    </div>
</section>
