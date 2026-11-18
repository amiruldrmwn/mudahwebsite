<section id="{{ $sectionId }}" class="px-3 pt-3">
    <div class="motor-head rounded-[2rem]">
        <div class="site-container py-14 sm:py-20">
            <span class="motor-pill">{{ $page?->title }}</span>
            <h1 class="mt-4 text-5xl sm:text-6xl">{{ $d['title'] }}</h1>
            @if ($d['subtitle'])<p class="mt-4 max-w-2xl text-lg opacity-85">{{ $d['subtitle'] }}</p>@endif
        </div>
    </div>
</section>
