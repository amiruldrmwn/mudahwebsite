@php($title = preg_replace('/\*(.+?)\*/', '<em>$1</em>', e($d['title'])))
{{-- A pair of spectacles: the photo in the left lens, an eye-chart lens on the right, joined by a bridge. --}}
<section id="{{ $sectionId }}" class="optik-hero relative overflow-hidden">
    <div class="site-container relative grid items-center gap-12 py-16 sm:py-24 lg:grid-cols-2">
        <div>
            @if ($d['eyebrow'])<span class="optik-chip"><span class="optik-iris" aria-hidden="true"></span>{{ $d['eyebrow'] }}</span>@endif
            <h1 class="hero-title mt-6 text-[2.6rem] leading-[1.05] sm:text-6xl">{!! $title !!}</h1>
            @if ($d['subtitle'])<p class="muted mt-6 max-w-lg text-lg leading-relaxed">{{ $d['subtitle'] }}</p>@endif
            @include('site.partials.hero-buttons', ['secondary' => 'optik-outline'])
        </div>
        @if ($site->image($d['image']))
            <div class="optik-specs relative mx-auto w-full max-w-xl">
                <svg class="optik-frame absolute inset-0 size-full" viewBox="0 0 500 300" fill="none" aria-hidden="true">
                    <path d="M248 112c12-14 30-14 42 0" stroke-width="7" stroke-linecap="round"/>
                </svg>
                <div class="optik-lens optik-lens-photo absolute">
                    <img src="{{ $site->image($d['image']) }}" alt="" class="size-full object-cover">
                </div>
                <div class="optik-lens optik-lens-chart absolute" aria-hidden="true">
                    <span class="optik-snellen"><b class="text-[2.4em]">E</b><b class="text-[1.4em]">F P</b><b class="text-[.95em]">T O Z</b><b class="text-[.6em]">L P E D</b></span>
                </div>
                <div class="optik-tag absolute">
                    <strong class="block text-sm">Refraksi komputer</strong>
                    <span class="muted text-xs">Gratis · selesai 2 menit</span>
                </div>
            </div>
        @endif
    </div>
</section>
