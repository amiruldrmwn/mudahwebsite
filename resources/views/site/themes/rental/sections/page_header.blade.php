<section id="{{ $sectionId }}" class="relative overflow-hidden text-white" style="background: var(--brand)">
    <div class="rental-slash pointer-events-none absolute inset-y-0 right-0 w-1/3 opacity-60" aria-hidden="true"></div>
    <div class="site-container relative py-14 sm:py-20">
        <nav class="mb-3 text-sm text-white/70"><a href="{{ url('/') }}" class="hover:text-white">Beranda</a> / {{ $page?->title }}</nav>
        <h1 class="max-w-3xl text-4xl font-extrabold sm:text-5xl">{{ $d['title'] }}</h1>
        @if ($d['subtitle'])<p class="mt-4 max-w-2xl text-lg text-white/80">{{ $d['subtitle'] }}</p>@endif
    </div>
</section>
