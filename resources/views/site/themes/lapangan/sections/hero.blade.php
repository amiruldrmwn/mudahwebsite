@php($title = preg_replace('/\*(.+?)\*/', '<em>$1</em>', e($d['title'])))
{{-- Mown-turf stripes with white court lines, a big condensed title, and today's booking board over the photo. --}}
<section id="{{ $sectionId }}" class="lapangan-hero relative overflow-hidden">
    @include('site.themes.lapangan.court')
    <div class="site-container relative grid items-center gap-12 py-14 sm:py-20 lg:grid-cols-2">
        <div>
            @if ($d['eyebrow'])<span class="lapangan-chip">{{ $d['eyebrow'] }}</span>@endif
            <h1 class="hero-title mt-5 text-5xl leading-[.92] text-white sm:text-7xl">{!! $title !!}</h1>
            @if ($d['subtitle'])<p class="mt-6 max-w-lg text-lg leading-relaxed text-white/80">{{ $d['subtitle'] }}</p>@endif
            @include('site.partials.hero-buttons', ['secondary' => 'lapangan-ghost'])
        </div>
        @if ($site->image($d['image']))
            <div class="relative mx-auto w-full max-w-lg pb-16 sm:pb-10">
                <img src="{{ $site->image($d['image']) }}" alt="" class="lapangan-photo aspect-[4/3] w-full object-cover">
                <div class="lapangan-board absolute right-3 bottom-0 left-3 sm:right-auto sm:-bottom-4 sm:-left-8 sm:w-80" aria-hidden="true">
                    <div class="flex items-center justify-between text-xs font-bold tracking-wider uppercase">
                        <span>Jadwal hari ini</span><span class="lapangan-live">Live</span>
                    </div>
                    @foreach (['Futsal A' => [1, 1, 0, 1, 0], 'Badminton 2' => [0, 1, 1, 0, 0]] as $court => $slots)
                        <div class="mt-3">
                            <div class="text-sm font-semibold">{{ $court }}</div>
                            <div class="mt-1.5 grid grid-cols-5 gap-1.5">
                                @foreach ($slots as $i => $taken)
                                    <span @class(['lapangan-slot', 'lapangan-slot-free' => ! $taken])>{{ 18 + $i }}.00</span>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</section>
