<section id="{{ $sectionId }}" class="pesantren-hero relative overflow-hidden">
    @if ($site->image($d['image']))
        <img src="{{ $site->image($d['image']) }}" alt="" class="absolute inset-0 size-full object-cover opacity-20">
    @endif
    <div class="site-container relative py-14 text-center sm:py-20">
        <span class="pesantren-eyebrow">{{ $page?->title }}</span>
        <h1 class="mx-auto mt-4 max-w-3xl text-4xl text-white sm:text-5xl">{{ $d['title'] }}</h1>
        @if ($d['subtitle'])<p class="mx-auto mt-4 max-w-2xl text-lg text-white/80">{{ $d['subtitle'] }}</p>@endif
    </div>
</section>
