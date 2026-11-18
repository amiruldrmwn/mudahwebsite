@php($title = preg_replace('/\*(.+?)\*/', '<em>$1</em>', e($d['title'])))
<section id="{{ $sectionId }}" class="relative overflow-hidden text-white">
    @if ($site->image($d['image']))<img src="{{ $site->image($d['image']) }}" alt="" class="absolute inset-0 h-full w-full object-cover">@endif
    <div class="absolute inset-0 bg-[#2a170b]/65"></div>
    <div class="site-container relative flex min-h-[70vh] flex-col items-center justify-center py-24 text-center">
        @if ($d['eyebrow'])<span class="catering-eyebrow">{{ $d['eyebrow'] }}</span>@endif
        <h1 class="hero-title mt-4 max-w-3xl text-5xl leading-[1.05] sm:text-7xl">{!! $title !!}</h1>
        @if ($d['subtitle'])<p class="mt-6 max-w-2xl text-lg leading-relaxed text-white/85">{{ $d['subtitle'] }}</p>@endif
        @include('site.partials.hero-buttons', ['class' => 'justify-center', 'secondary' => 'btn-ghost-light'])
    </div>
</section>
