{{-- Quiet linen band: small kicker, serif title and a thin brass rule. --}}
<section id="{{ $sectionId }}" class="interior-hero relative overflow-hidden">
    <div class="site-container relative py-16 sm:py-24">
        <p class="interior-kicker">{{ $page?->title }}</p>
        <h1 class="mt-5 max-w-3xl text-4xl leading-tight sm:text-6xl">{{ $d['title'] }}</h1>
        @if ($d['subtitle'])<p class="muted mt-5 max-w-2xl text-lg">{{ $d['subtitle'] }}</p>@endif
    </div>
</section>
