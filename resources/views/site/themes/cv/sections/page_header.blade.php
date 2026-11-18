<section id="{{ $sectionId }}" class="cv-hero">
    <div class="site-container py-14 sm:py-20">
        <p class="cv-eyebrow">{{ $page?->title }}</p>
        <h1 class="mt-3 max-w-3xl text-4xl sm:text-6xl">{{ $d['title'] }}</h1>
        @if ($d['subtitle'])<p class="muted mt-4 max-w-2xl text-lg">{{ $d['subtitle'] }}</p>@endif
    </div>
</section>
