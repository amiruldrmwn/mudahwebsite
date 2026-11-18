<section id="{{ $sectionId }}" class="cetak-head relative overflow-hidden">
    <div class="site-container relative py-14 sm:py-20">
        <span class="cetak-chip bg-white/15! text-white!">{{ $page?->title }}</span>
        <h1 class="mt-4 max-w-3xl text-4xl text-white sm:text-5xl">{{ $d['title'] }}</h1>
        @if ($d['subtitle'])<p class="mt-4 max-w-2xl text-lg text-white/85">{{ $d['subtitle'] }}</p>@endif
    </div>
</section>
