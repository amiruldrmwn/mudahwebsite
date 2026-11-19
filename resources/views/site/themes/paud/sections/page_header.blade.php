<section id="{{ $sectionId }}" class="paud-hero relative overflow-hidden">
    <span class="paud-blob paud-blob-1 absolute"></span><span class="paud-blob paud-blob-3 absolute"></span>
    <div class="site-container relative pt-14 pb-20 text-center sm:pt-20 sm:pb-24">
        <span class="paud-pill">{{ $page?->title }}</span>
        <h1 class="mx-auto mt-4 max-w-3xl text-4xl sm:text-5xl">{{ $d['title'] }}</h1>
        @if ($d['subtitle'])<p class="muted mx-auto mt-4 max-w-2xl text-lg">{{ $d['subtitle'] }}</p>@endif
    </div>
    <svg class="absolute bottom-0 left-0 h-10 w-full" viewBox="0 0 1440 80" preserveAspectRatio="none" aria-hidden="true"><path d="M0 40c120-30 240-30 360 0s240 30 360 0 240-30 360 0 240 30 360 0v40H0z" fill="#fff"/></svg>
</section>
