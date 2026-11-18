{{-- Dark profile: photo in a glowing gradient ring, name, bio and one big button. --}}
<section id="{{ $sectionId }}" class="mx-auto max-w-md px-6 pt-12 pb-4 text-center">
    @if ($site->image($d['image']))
        <span class="bl3-ring mx-auto block size-32 rounded-full p-1"><img src="{{ $site->image($d['image']) }}" alt="{{ $d['title'] }}" class="size-full rounded-full object-cover"></span>
    @endif
    <h1 class="hero-title mt-5 text-3xl">{{ $d['title'] }}</h1>
    @if ($d['eyebrow'])<p class="bl3-handle mt-1 text-sm font-semibold">{{ $d['eyebrow'] }}</p>@endif
    @if ($d['subtitle'])<p class="mt-4 text-sm leading-relaxed opacity-80">{{ $d['subtitle'] }}</p>@endif
    @if ($d['button_label'] && $d['button_url'])
        <a href="{{ $d['button_url'] }}" class="bl3-cta mt-6 flex items-center justify-center gap-2 rounded-2xl px-5 py-4 font-semibold"><span aria-hidden="true">▶</span>{{ $d['button_label'] }}</a>
    @endif
    @if ($d['button2_label'] && $d['button2_url'])
        <a href="{{ $d['button2_url'] }}" class="bl3-card mt-3 flex items-center justify-center rounded-2xl px-5 py-4 font-semibold">{{ $d['button2_label'] }}</a>
    @endif
</section>
