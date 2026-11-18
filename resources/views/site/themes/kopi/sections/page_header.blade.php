<section id="{{ $sectionId }}" class="kopi-hero relative overflow-hidden">
    <div class="kopi-ghost pointer-events-none absolute inset-x-0 top-6 text-center whitespace-nowrap" aria-hidden="true">{{ $page?->title }} {{ $page?->title }}</div>
    <div class="site-container relative py-16 text-center sm:py-24">
        <h1 class="kopi-title text-5xl font-extrabold sm:text-6xl">{{ $d['title'] }}</h1>
        @if ($d['subtitle'])<p class="muted mx-auto mt-4 max-w-2xl text-lg">{{ $d['subtitle'] }}</p>@endif
    </div>
</section>
