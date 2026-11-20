<section id="{{ $sectionId }}" class="tani-hero relative overflow-hidden">
    @if ($site->image($d['image']))<img src="{{ $site->image($d['image']) }}" alt="" class="absolute inset-0 size-full object-cover">@endif
    <div class="tani-shade absolute inset-0"></div>
    <div class="site-container relative pt-16 pb-24 sm:pt-20 sm:pb-32">
        <span class="tani-chip">{{ $page?->title }}</span>
        <h1 class="mt-4 max-w-3xl text-4xl leading-tight text-white sm:text-5xl">{{ $d['title'] }}</h1>
        @if ($d['subtitle'])<p class="mt-4 max-w-2xl text-lg text-white/90">{{ $d['subtitle'] }}</p>@endif
    </div>
    <svg class="absolute -bottom-px left-0 h-12 w-full sm:h-16" viewBox="0 0 1440 100" preserveAspectRatio="none" aria-hidden="true">
        <path d="M0 60c180-40 360-50 560-20s400 50 600 10c120-24 210-30 280-28v78H0z" fill="var(--surface)"/>
    </svg>
</section>
