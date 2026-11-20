@php($title = preg_replace('/\*(.+?)\*/', '<em>$1</em>', e($d['title'])))
{{-- Full-bleed field photo washed in leaf green, a rolling hill edge and a round harvest stamp. --}}
<section id="{{ $sectionId }}" class="tani-hero relative overflow-hidden">
    @if ($site->image($d['image']))<img src="{{ $site->image($d['image']) }}" alt="" class="absolute inset-0 size-full object-cover">@endif
    <div class="tani-shade absolute inset-0"></div>
    <div class="site-container relative flex min-h-[78vh] items-center pt-16 pb-36 sm:pt-24 sm:pb-44">
        <div class="max-w-2xl">
            @if ($d['eyebrow'])<span class="tani-chip">{{ $d['eyebrow'] }}</span>@endif
            <h1 class="hero-title mt-5 text-4xl leading-[1.08] text-white sm:text-6xl">{!! $title !!}</h1>
            @if ($d['subtitle'])<p class="mt-6 max-w-xl text-lg leading-relaxed text-white/90">{{ $d['subtitle'] }}</p>@endif
            @include('site.partials.hero-buttons', ['primary' => 'tani-sun-btn', 'secondary' => 'btn-ghost-light'])
        </div>
    </div>
    <svg class="tani-stamp absolute right-6 bottom-24 hidden size-36 md:block lg:right-16 lg:size-44" viewBox="0 0 200 200" aria-hidden="true">
        <defs><path id="tani-ring" d="M100 100m-72 0a72 72 0 1 1 144 0a72 72 0 1 1-144 0"/></defs>
        <circle cx="100" cy="100" r="96" fill="#f2b632"/>
        <circle cx="100" cy="100" r="88" fill="none" stroke="#2a2016" stroke-width="1.5" stroke-dasharray="3 5"/>
        <text font-size="17" font-weight="700" letter-spacing="3.2" fill="#2a2016"><textPath href="#tani-ring">PANEN PAGI · ANTAR SIANG · SEGAR ·</textPath></text>
        <path d="M100 135c0-30 6-50 30-66-28 2-42 18-30 66zM100 135c-2-22-10-34-28-40 2 20 12 32 28 40z" fill="#3f6b1f"/>
    </svg>
    <svg class="absolute -bottom-px left-0 h-16 w-full sm:h-24" viewBox="0 0 1440 100" preserveAspectRatio="none" aria-hidden="true">
        <path d="M0 60c180-40 360-50 560-20s400 50 600 10c120-24 210-30 280-28v78H0z" fill="var(--surface)"/>
        <path d="M0 80c240-30 480-34 720-10s480 24 720-6v36H0z" fill="var(--surface)" opacity=".6"/>
    </svg>
</section>
