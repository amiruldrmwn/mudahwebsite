<section id="{{ $sectionId }}" style="background: var(--surface-alt)">
    <div class="site-container py-14 sm:py-20">
        <span class="kaos-chip">{{ $page?->title }}</span>
        <h1 class="mt-4 text-5xl uppercase sm:text-6xl">{{ $d['title'] }}</h1>
        @if ($d['subtitle'])<p class="muted mt-4 max-w-2xl text-lg">{{ $d['subtitle'] }}</p>@endif
    </div>
</section>
