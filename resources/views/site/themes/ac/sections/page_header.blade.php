<section id="{{ $sectionId }}" class="ac-hero relative overflow-hidden text-white">
    <div class="site-container relative pt-14 pb-24 sm:pt-16">
        <nav class="mb-4 text-sm text-white/70"><a href="{{ url('/') }}" class="hover:text-white">Beranda</a> <span class="mx-1">/</span> {{ $page?->title }}</nav>
        <h1 class="max-w-3xl text-4xl font-bold sm:text-5xl">{{ $d['title'] }}</h1>
        @if ($d['subtitle'])<p class="mt-4 max-w-2xl text-lg text-white/85">{{ $d['subtitle'] }}</p>@endif
    </div>
    <svg class="absolute bottom-0 left-0 h-10 w-full sm:h-14" viewBox="0 0 1200 80" preserveAspectRatio="none" aria-hidden="true"><path d="M0 40 C 300 90, 600 0, 900 40 S 1200 50, 1200 50 V80 H0Z" fill="var(--surface)"/></svg>
</section>
