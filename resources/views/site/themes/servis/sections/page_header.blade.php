<section id="{{ $sectionId }}" class="servis-hero relative overflow-hidden">
    <div class="servis-dots absolute inset-0"></div>
    <div class="site-container relative py-14 sm:py-20">
        <span class="servis-chip"><span class="servis-led"></span>{{ $page?->title }}</span>
        <h1 class="mt-4 max-w-3xl text-4xl text-white sm:text-5xl">{{ $d['title'] }}</h1>
        @if ($d['subtitle'])<p class="mt-4 max-w-2xl text-lg text-slate-300">{{ $d['subtitle'] }}</p>@endif
    </div>
</section>
