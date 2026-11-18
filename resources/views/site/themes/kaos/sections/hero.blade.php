@php($title = preg_replace('/\*(.+?)\*/', '<em>$1</em>', e($d['title'])))
<section id="{{ $sectionId }}" class="relative overflow-hidden" style="background: var(--surface-alt)">
    <div class="site-container grid items-center gap-10 py-14 sm:py-20 lg:grid-cols-2">
        <div>
            @if ($d['eyebrow'])<span class="kaos-chip">{{ $d['eyebrow'] }}</span>@endif
            <h1 class="hero-title mt-5 text-5xl leading-[0.95] uppercase sm:text-7xl">{!! $title !!}</h1>
            @if ($d['subtitle'])<p class="muted mt-6 max-w-lg text-lg leading-relaxed">{{ $d['subtitle'] }}</p>@endif
            @include('site.partials.hero-buttons')
        </div>
        @if ($site->image($d['image']))
            <div class="relative">
                <img src="{{ $site->image($d['image']) }}" alt="" class="aspect-[4/3] w-full rounded-3xl object-cover">
                <div class="absolute -bottom-5 left-5 flex gap-2 rounded-full bg-white px-4 py-3 shadow-xl">
                    @foreach (['#111111', '#ffffff', '#e4572e', '#f2c94c', '#2f6fde', '#3b7d4f'] as $c)
                        <span class="size-5 rounded-full border border-black/10" style="background: {{ $c }}"></span>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</section>
