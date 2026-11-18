<section id="{{ $sectionId }}" class="relative overflow-hidden text-white" style="background: #1c1d21">
    @if ($site->image($d['image']))
        <img src="{{ $site->image($d['image']) }}" alt="" class="absolute inset-0 size-full object-cover opacity-60">
    @endif
    <div class="absolute inset-0" style="background: linear-gradient(90deg, color-mix(in oklab, var(--brand) 90%, transparent), color-mix(in oklab, var(--brand) 40%, transparent))"></div>
    <div class="site-container relative py-16 sm:py-24">
        <nav class="mb-4 text-sm text-white/75"><a href="{{ url('/') }}" class="hover:text-white">Beranda</a> <span class="mx-1">/</span> {{ $page?->title }}</nav>
        <h1 class="max-w-3xl text-4xl font-extrabold sm:text-5xl">{{ $d['title'] }}</h1>
        @if ($d['subtitle'])<p class="mt-4 max-w-2xl text-lg text-white/85">{{ $d['subtitle'] }}</p>@endif
    </div>
</section>
