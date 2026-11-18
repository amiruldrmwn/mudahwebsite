@php($title = preg_replace('/\*(.+?)\*/', '<em>$1</em>', e($d['title'])))
<section id="{{ $sectionId }}" class="relative overflow-hidden bg-black text-white">
    @if ($site->image($d['image']))<img src="{{ $site->image($d['image']) }}" alt="" class="absolute inset-0 h-full w-full object-cover opacity-80">@endif
    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/10 to-transparent"></div>
    <div class="site-container relative flex min-h-[85vh] flex-col justify-end pt-32 pb-16">
        @if ($d['eyebrow'])<span class="text-xs tracking-[0.35em] uppercase text-white/70">{{ $d['eyebrow'] }}</span>@endif
        <h1 class="hero-title mt-4 max-w-4xl text-5xl leading-[1] sm:text-8xl">{!! $title !!}</h1>
        <div class="mt-8 flex flex-col gap-6 sm:flex-row sm:items-end sm:justify-between">
            @if ($d['subtitle'])<p class="max-w-md leading-relaxed text-white/75">{{ $d['subtitle'] }}</p>@endif
            @include('site.partials.hero-buttons', ['class' => 'mt-0!', 'primary' => 'btn-light', 'secondary' => 'btn-ghost-light'])
        </div>
    </div>
</section>
