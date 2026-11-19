<section id="{{ $sectionId }}" class="umkm-hero relative overflow-hidden">
    <div class="site-container relative py-14 text-center sm:py-20">
        <span class="umkm-pill">{{ $page?->title }}</span>
        <h1 class="mx-auto mt-4 max-w-3xl text-4xl sm:text-5xl">{{ $d['title'] }}</h1>
        @if ($d['subtitle'])<p class="muted mx-auto mt-4 max-w-2xl text-lg">{{ $d['subtitle'] }}</p>@endif
    </div>
</section>
