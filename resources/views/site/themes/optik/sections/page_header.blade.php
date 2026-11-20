<section id="{{ $sectionId }}" class="optik-hero relative overflow-hidden">
    <div class="site-container relative grid items-end gap-8 py-14 sm:py-20 md:grid-cols-[1fr_auto]">
        <div>
            <span class="optik-chip"><span class="optik-iris" aria-hidden="true"></span>{{ $page?->title }}</span>
            <h1 class="mt-5 max-w-3xl text-4xl leading-tight sm:text-5xl">{{ $d['title'] }}</h1>
            @if ($d['subtitle'])<p class="muted mt-4 max-w-2xl text-lg">{{ $d['subtitle'] }}</p>@endif
        </div>
        <div class="optik-chartmini hidden text-center md:block" aria-hidden="true">
            <b class="text-6xl">E</b><b class="text-4xl">F P</b><b class="text-2xl">T O Z</b><b class="text-base">L P E D</b><b class="text-xs">P E C F D</b>
        </div>
    </div>
</section>
