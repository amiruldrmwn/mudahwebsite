<section id="{{ $sectionId }}" class="instansi-hero relative overflow-hidden">
    @if ($site->image($d['image']))<img src="{{ $site->image($d['image']) }}" alt="" class="absolute inset-0 size-full object-cover opacity-25 mix-blend-luminosity">@endif
    <div class="site-container relative py-12 sm:py-16">
        <nav class="text-sm text-white/75" aria-label="Lokasi halaman"><a href="{{ url('/') }}" class="hover:text-white">Beranda</a> <span aria-hidden="true">/</span> <span class="text-white">{{ $page?->title }}</span></nav>
        <h1 class="mt-3 max-w-3xl text-3xl leading-tight text-white sm:text-5xl">{{ $d['title'] }}</h1>
        @if ($d['subtitle'])<p class="mt-3 max-w-2xl text-lg text-white/85">{{ $d['subtitle'] }}</p>@endif
    </div>
</section>
