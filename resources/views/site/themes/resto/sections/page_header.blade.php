<section id="{{ $sectionId }}" class="relative overflow-hidden text-center" style="background: var(--surface-alt)">
    <div class="site-container py-16 sm:py-24">
        <span class="eyebrow">{{ $page?->title }}</span>
        <h1 class="text-5xl sm:text-6xl" style="color: var(--brand)">{{ $d['title'] }}</h1>
        @if ($d['subtitle'])<p class="muted mx-auto mt-4 max-w-2xl text-lg">{{ $d['subtitle'] }}</p>@endif
    </div>
    <svg class="block h-6 w-full" viewBox="0 0 1200 40" preserveAspectRatio="none" aria-hidden="true"><path d="M0 20 Q 50 0 100 20 T 200 20 T 300 20 T 400 20 T 500 20 T 600 20 T 700 20 T 800 20 T 900 20 T 1000 20 T 1100 20 T 1200 20 V40 H0Z" fill="var(--surface)"/></svg>
</section>
