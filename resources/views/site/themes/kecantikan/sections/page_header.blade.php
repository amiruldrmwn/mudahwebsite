<section id="{{ $sectionId }}" class="relative overflow-hidden" style="background: var(--surface-alt)">
    <div class="site-container py-16 text-center sm:py-24">
        <span class="eyebrow">{{ $page?->title }}</span>
        <h1 class="text-5xl sm:text-6xl">{{ $d['title'] }}</h1>
        @if ($d['subtitle'])<p class="muted mx-auto mt-4 max-w-2xl text-lg">{{ $d['subtitle'] }}</p>@endif
    </div>
</section>
