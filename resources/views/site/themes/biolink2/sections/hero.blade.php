{{-- Playful profile: handle, big title beside a round photo, quote and an underlined link. --}}
<section id="{{ $sectionId }}" class="mx-auto max-w-md px-6 pt-10 pb-6">
    @if ($d['eyebrow'])<p class="text-xs font-bold">{{ $d['eyebrow'] }}</p>@endif
    <div class="mt-3 flex items-center justify-between gap-4">
        <h1 class="hero-title text-5xl leading-[0.95] sm:text-6xl">{{ $d['title'] }}</h1>
        @if ($site->image($d['image']))
            <img src="{{ $site->image($d['image']) }}" alt="{{ $d['title'] }}" class="bl2-avatar size-24 shrink-0 rounded-full object-cover sm:size-28">
        @endif
    </div>
    @if ($d['subtitle'])<p class="mt-5 text-sm leading-relaxed">{{ $d['subtitle'] }}</p>@endif
    @if ($d['button_label'] && $d['button_url'])
        <a href="{{ $d['button_url'] }}" class="bl2-more mt-6 flex items-center justify-between gap-3 pb-1 text-lg font-bold">{{ $d['button_label'] }}<span aria-hidden="true">→</span></a>
    @endif
    @if ($d['button2_label'] && $d['button2_url'])
        <a href="{{ $d['button2_url'] }}" class="bl2-more mt-4 flex items-center justify-between gap-3 pb-1 text-lg font-bold">{{ $d['button2_label'] }}<span aria-hidden="true">→</span></a>
    @endif
</section>
