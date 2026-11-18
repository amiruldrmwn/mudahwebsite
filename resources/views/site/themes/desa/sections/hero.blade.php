@php($title = preg_replace('/\*(.+?)\*/', '<em>$1</em>', e($d['title'])))
{{-- Wide landscape photo with a white welcome card overlapping its lower-left corner. --}}
<section id="{{ $sectionId }}" class="desa-hero relative">
    @if ($site->image($d['image']))
        <img src="{{ $site->image($d['image']) }}" alt="" class="h-72 w-full object-cover sm:h-[30rem]">
    @endif
    <div class="site-container relative">
        <div class="desa-card relative -mt-24 max-w-2xl p-6 sm:-mt-40 sm:p-10">
            @if ($d['eyebrow'])<span class="desa-eyebrow">{{ $d['eyebrow'] }}</span>@endif
            <h1 class="hero-title mt-3 text-3xl leading-tight sm:text-5xl">{!! $title !!}</h1>
            @if ($d['subtitle'])<p class="muted mt-4 text-lg leading-relaxed">{{ $d['subtitle'] }}</p>@endif
            @include('site.partials.hero-buttons', ['class' => 'mt-6!'])
        </div>
    </div>
</section>
