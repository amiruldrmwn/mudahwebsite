<section id="{{ $sectionId }}" class="emas-hero relative overflow-hidden">
    @if ($site->image($d['image']))<img src="{{ $site->image($d['image']) }}" alt="" class="absolute inset-0 size-full object-cover opacity-15">@endif
    <div class="emas-lattice absolute inset-0" aria-hidden="true"></div>
    <div class="site-container relative py-16 text-center sm:py-24">
        <span class="emas-eyebrow">{{ $page?->title }}</span>
        <h1 class="mx-auto mt-5 max-w-3xl text-3xl leading-tight text-white sm:text-5xl">{{ $d['title'] }}</h1>
        @if ($d['subtitle'])<p class="mx-auto mt-4 max-w-2xl text-lg text-white/75">{{ $d['subtitle'] }}</p>@endif
        <span class="emas-rule mx-auto mt-8" aria-hidden="true"></span>
    </div>
</section>
