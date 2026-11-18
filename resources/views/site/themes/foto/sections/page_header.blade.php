<section id="{{ $sectionId }}" class="foto-head">
    <div class="site-container py-14 sm:py-20 ">
        <span class="page-eyebrow">{{ $page?->title }}</span>
        <h1 class="mt-3 text-4xl sm:text-6xl">{{ $d['title'] }}</h1>
        @if ($d['subtitle'])<p class="page-sub mt-4 max-w-2xl text-lg ">{{ $d['subtitle'] }}</p>@endif
    </div>
</section>
