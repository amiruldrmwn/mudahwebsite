<section id="{{ $sectionId }}" class="bidan-hero relative overflow-hidden">
    <div class="bidan-blob bidan-blob-1 absolute" aria-hidden="true"></div>
    <div class="site-container relative grid items-center gap-10 py-14 sm:py-16 md:grid-cols-[1fr_auto]">
        <div>
            <nav class="bidan-crumb text-sm"><a href="{{ url('/') }}" class="hover:underline">Beranda</a> <span class="mx-1.5">·</span> {{ $page?->title }}</nav>
            <h1 class="mt-3 max-w-2xl text-4xl leading-tight sm:text-5xl">{{ $d['title'] }}</h1>
            @if ($d['subtitle'])<p class="muted mt-4 max-w-xl text-lg">{{ $d['subtitle'] }}</p>@endif
        </div>
        @if ($site->image($d['image']))<img src="{{ $site->image($d['image']) }}" alt="" class="bidan-arch hidden h-52 w-44 object-cover md:block">@endif
    </div>
    <svg class="bidan-wave absolute bottom-0 left-0 h-6 w-full" viewBox="0 0 1200 40" preserveAspectRatio="none" aria-hidden="true"><path d="M0 40V22C200 0 400 0 600 18s400 22 600 0v22z"/></svg>
</section>
