<section id="{{ $sectionId }}" class="mx-auto max-w-md px-6 py-8 text-center">
    <h2 class="hero-title text-2xl">{{ $d['title'] }}</h2>
    @if ($d['text'])<p class="mt-3 text-sm opacity-75">{{ $d['text'] }}</p>@endif
    @if ($d['button_label'] && $d['button_url'])<a href="{{ $d['button_url'] }}" class="bl3-cta mt-5 inline-flex rounded-2xl px-6 py-3 text-sm font-semibold">{{ $d['button_label'] }}</a>@endif
</section>
