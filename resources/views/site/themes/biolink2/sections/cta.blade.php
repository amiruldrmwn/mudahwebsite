<section id="{{ $sectionId }}" class="mx-auto max-w-md px-6 py-10 text-center">
    <div class="flex items-center justify-center gap-5">
        <span class="bl2-dot relative flex size-20 shrink-0 items-center justify-center rounded-full text-4xl" aria-hidden="true">🍳</span>
        <h2 class="bl2-title text-left text-3xl">{{ $d['title'] }}</h2>
    </div>
    @if ($d['text'])<p class="mt-4 text-sm">{{ $d['text'] }}</p>@endif
    @if ($d['button_label'] && $d['button_url'])<a href="{{ $d['button_url'] }}" class="bl2-pill mt-6 inline-flex px-6 py-3 text-sm font-bold">{{ $d['button_label'] }}</a>@endif
</section>
