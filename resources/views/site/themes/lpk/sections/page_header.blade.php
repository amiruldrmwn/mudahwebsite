<section id="{{ $sectionId }}" class="lpk-hero relative overflow-hidden">
    <div class="lpk-sun lpk-sun-sm absolute"></div>
    <div class="site-container relative py-14 sm:py-20">
        <span class="lpk-eyebrow">{{ $page?->title }}</span>
        <h1 class="mt-4 max-w-3xl text-4xl sm:text-5xl">{{ $d['title'] }}</h1>
        @if ($d['subtitle'])<p class="muted mt-4 max-w-2xl text-lg">{{ $d['subtitle'] }}</p>@endif
    </div>
</section>
