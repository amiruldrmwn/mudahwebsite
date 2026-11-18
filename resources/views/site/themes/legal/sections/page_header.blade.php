<section id="{{ $sectionId }}" class="legal-hero relative overflow-hidden text-white">
    <div class="legal-grid pointer-events-none absolute inset-0" aria-hidden="true"></div>
    <div class="site-container relative py-14 sm:py-20">
        <nav class="mb-4 text-sm text-white/70"><a href="{{ url('/') }}" class="hover:text-white">Beranda</a> <span class="mx-1">›</span> {{ $page?->title }}</nav>
        <h1 class="max-w-3xl text-4xl font-extrabold sm:text-5xl">{{ $d['title'] }}</h1>
        @if ($d['subtitle'])<p class="mt-4 max-w-2xl text-lg text-white/85">{{ $d['subtitle'] }}</p>@endif
    </div>
</section>
