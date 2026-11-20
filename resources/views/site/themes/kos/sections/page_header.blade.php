{{-- Cream band with a door-number plate showing the page name. --}}
<section id="{{ $sectionId }}" class="kos-hero kos-head relative overflow-hidden">
    <div class="site-container relative flex flex-col gap-6 py-14 sm:flex-row sm:items-end sm:justify-between sm:py-20">
        <div>
            <span class="kos-plate">{{ $page?->title }}</span>
            <h1 class="mt-5 max-w-3xl text-4xl leading-tight sm:text-5xl">{{ $d['title'] }}</h1>
            @if ($d['subtitle'])<p class="muted mt-4 max-w-2xl text-lg">{{ $d['subtitle'] }}</p>@endif
        </div>
    </div>
</section>
