<section id="{{ $sectionId }}" class="oleh-hero relative overflow-hidden">
    <div class="site-container relative grid items-center gap-8 py-12 sm:py-16 md:grid-cols-[1fr_auto]">
        <div>
            <span class="oleh-label">{{ $page?->title }}</span>
            <h1 class="mt-4 max-w-3xl text-4xl leading-tight sm:text-5xl">{{ $d['title'] }}</h1>
            @if ($d['subtitle'])<p class="muted mt-4 max-w-2xl text-lg">{{ $d['subtitle'] }}</p>@endif
        </div>
        @if ($site->image($d['image']))<div class="oleh-photo hidden w-56 rotate-3 md:block"><img src="{{ $site->image($d['image']) }}" alt="" class="aspect-square w-full object-cover"></div>@endif
    </div>
    <div class="oleh-cut" aria-hidden="true"></div>
</section>
