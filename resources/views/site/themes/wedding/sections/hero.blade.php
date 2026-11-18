@php($title = preg_replace('/\*(.+?)\*/', '<em>$1</em>', e($d['title'])))
<section id="{{ $sectionId }}" class="relative overflow-hidden">
    <div class="site-container py-16 text-center sm:py-20">
        @if ($d['eyebrow'])<span class="wedding-script text-4xl sm:text-5xl">{{ $d['eyebrow'] }}</span>@endif
        <h1 class="hero-title mx-auto mt-3 max-w-3xl text-4xl leading-[1.1] sm:text-6xl">{!! $title !!}</h1>
        @if ($d['subtitle'])<p class="muted mx-auto mt-5 max-w-xl text-lg leading-relaxed">{{ $d['subtitle'] }}</p>@endif
        @include('site.partials.hero-buttons', ['class' => 'justify-center'])
        @if ($site->image($d['image']))
            <div class="relative mx-auto mt-14 max-w-4xl">
                <span class="wedding-frame absolute -inset-3 sm:-inset-5"></span>
                <img src="{{ $site->image($d['image']) }}" alt="" class="relative aspect-[16/9] w-full rounded-t-[999px] object-cover">
            </div>
        @endif
    </div>
</section>
