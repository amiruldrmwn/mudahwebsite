<section id="{{ $sectionId }}" class="catering-head">
    <div class="site-container py-14 sm:py-20 text-center">
        <span class="page-eyebrow">{{ $page?->title }}</span>
        <h1 class="mt-3 text-4xl sm:text-6xl">{{ $d['title'] }}</h1>
        @if ($d['subtitle'])<p class="page-sub mt-4 max-w-2xl text-lg mx-auto">{{ $d['subtitle'] }}</p>@endif
    </div>
</section>
