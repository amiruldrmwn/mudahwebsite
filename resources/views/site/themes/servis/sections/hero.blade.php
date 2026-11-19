@php($title = preg_replace('/\*(.+?)\*/', '<em>$1</em>', e($d['title'])))
{{-- Dark tech hero on a dotted circuit grid, the photo with a glowing edge and a service status card. --}}
<section id="{{ $sectionId }}" class="servis-hero relative overflow-hidden">
    <div class="servis-dots absolute inset-0"></div>
    <div class="site-container relative grid items-center gap-12 py-16 sm:py-24 lg:grid-cols-2">
        <div>
            @if ($d['eyebrow'])<span class="servis-chip"><span class="servis-led"></span>{{ $d['eyebrow'] }}</span>@endif
            <h1 class="hero-title mt-5 text-4xl leading-[1.08] text-white sm:text-6xl">{!! $title !!}</h1>
            @if ($d['subtitle'])<p class="mt-6 max-w-lg text-lg leading-relaxed text-slate-300">{{ $d['subtitle'] }}</p>@endif
            @include('site.partials.hero-buttons', ['secondary' => 'servis-ghost'])
        </div>
        @if ($site->image($d['image']))
            <div class="relative mx-auto w-full max-w-lg">
                <img src="{{ $site->image($d['image']) }}" alt="" class="servis-photo aspect-[4/3] w-full object-cover">
                <div class="servis-status absolute -bottom-6 left-4 sm:-left-6">
                    <span class="text-xs text-slate-500">Status servis</span>
                    <strong class="mt-0.5 flex items-center gap-2 text-sm"><span class="servis-led"></span>Selesai · siap diambil</strong>
                </div>
            </div>
        @endif
    </div>
</section>
