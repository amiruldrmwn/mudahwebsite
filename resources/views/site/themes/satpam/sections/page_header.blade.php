<section id="{{ $sectionId }}" class="satpam-hero relative overflow-hidden">
    @if ($site->image($d['image']))
        <img src="{{ $site->image($d['image']) }}" alt="" class="absolute inset-0 size-full object-cover opacity-30">
    @endif
    <div class="site-container relative py-16 sm:py-24">
        <span class="satpam-eyebrow">{{ $page?->title }}</span>
        <h1 class="mt-4 max-w-3xl text-4xl text-white uppercase sm:text-6xl">{{ $d['title'] }}</h1>
        @if ($d['subtitle'])<p class="mt-4 max-w-2xl text-lg text-white/75">{{ $d['subtitle'] }}</p>@endif
    </div>
    <div class="satpam-stripe relative h-2"></div>
</section>
