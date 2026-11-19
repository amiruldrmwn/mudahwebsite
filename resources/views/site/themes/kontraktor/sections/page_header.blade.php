<section id="{{ $sectionId }}" class="kontraktor-hero relative overflow-hidden">
    @if ($site->image($d['image']))<img src="{{ $site->image($d['image']) }}" alt="" class="absolute inset-0 size-full object-cover opacity-20">@endif
    <div class="kontraktor-grid absolute inset-0"></div>
    <div class="site-container relative py-14 sm:py-20">
        <span class="kontraktor-tag">{{ $page?->title }}</span>
        <h1 class="mt-5 max-w-3xl text-4xl text-white sm:text-5xl">{{ $d['title'] }}</h1>
        @if ($d['subtitle'])<p class="mt-4 max-w-2xl text-lg text-slate-300">{{ $d['subtitle'] }}</p>@endif
    </div>
</section>
