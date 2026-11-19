<section id="{{ $sectionId }}" class="gereja-hero relative overflow-hidden">
    @if ($site->image($d['image']))<img src="{{ $site->image($d['image']) }}" alt="" class="absolute inset-0 size-full object-cover">@endif
    <div class="gereja-veil absolute inset-0"></div>
    <div class="site-container relative py-16 text-center sm:py-24">
        <div class="gereja-rule mx-auto" aria-hidden="true"><svg viewBox="0 0 12 16" class="h-4 w-3" fill="currentColor"><path d="M5 0h2v4h5v2H7v10H5V6H0V4h5z"/></svg></div>
        <h1 class="mx-auto mt-5 max-w-3xl text-4xl text-white sm:text-5xl">{{ $d['title'] }}</h1>
        @if ($d['subtitle'])<p class="mx-auto mt-4 max-w-2xl text-lg text-white/80">{{ $d['subtitle'] }}</p>@endif
    </div>
</section>
