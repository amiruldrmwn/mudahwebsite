@php($title = preg_replace('/\*(.+?)\*/', '<em>$1</em>', e($d['title'])))
{{-- Deep maroon with a faint diamond lattice, the photo in a gold double frame with corner marks. --}}
<section id="{{ $sectionId }}" class="emas-hero relative overflow-hidden">
    <div class="emas-lattice absolute inset-0" aria-hidden="true"></div>
    <div class="site-container relative grid items-center gap-14 pt-16 pb-24 sm:pt-24 sm:pb-32 lg:grid-cols-[1.1fr_.9fr]">
        <div>
            @if ($d['eyebrow'])<span class="emas-eyebrow">{{ $d['eyebrow'] }}</span>@endif
            <h1 class="hero-title mt-6 text-[2.2rem] leading-[1.15] text-white sm:text-[3.4rem]">{!! $title !!}</h1>
            @if ($d['subtitle'])<p class="mt-6 max-w-lg text-lg leading-relaxed text-white/75">{{ $d['subtitle'] }}</p>@endif
            @include('site.partials.hero-buttons', ['primary' => 'emas-gold', 'secondary' => 'emas-ghost'])
        </div>
        @if ($site->image($d['image']))
            <div class="emas-frame relative mx-auto w-full max-w-md">
                <img src="{{ $site->image($d['image']) }}" alt="" class="aspect-[4/5] w-full object-cover">
                <span class="emas-corner emas-corner-tl" aria-hidden="true"></span><span class="emas-corner emas-corner-br" aria-hidden="true"></span>
                <span class="emas-seal absolute -bottom-6 -left-4 sm:-left-8" aria-hidden="true"><b>XRF</b>Kadar<br>teruji</span>
            </div>
        @endif
    </div>
</section>
