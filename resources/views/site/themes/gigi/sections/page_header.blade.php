<section id="{{ $sectionId }}" class="dent-hero">
    <div class="site-container py-14 text-center sm:py-20">
        <h1 class="text-4xl font-semibold sm:text-5xl">{{ $d['title'] }}</h1>
        @if ($d['subtitle'])<p class="muted mx-auto mt-4 max-w-2xl text-lg">{{ $d['subtitle'] }}</p>@endif
    </div>
</section>
