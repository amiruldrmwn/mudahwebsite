<section id="{{ $sectionId }}" class="border-b" style="border-color: var(--line)">
    <div class="site-container py-14 text-center sm:py-20">
        <span class="eyebrow">{{ $page?->title }}</span>
        <h1 class="text-5xl sm:text-6xl">{{ $d['title'] }}</h1>
        @if ($d['subtitle'])<p class="muted mx-auto mt-4 max-w-xl">{{ $d['subtitle'] }}</p>@endif
    </div>
</section>
