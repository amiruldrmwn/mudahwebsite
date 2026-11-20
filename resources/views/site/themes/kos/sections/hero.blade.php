@php($title = preg_replace('/\*(.+?)\*/', '<em>$1</em>', e($d['title'])))
{{-- Warm cream hero: the room photo in an arched window frame, a room-board card showing which rooms are free, and a price tag. --}}
<section id="{{ $sectionId }}" class="kos-hero relative overflow-hidden">
    <div class="site-container relative grid items-center gap-14 py-14 sm:py-20 lg:grid-cols-[1.05fr_.95fr]">
        <div>
            @if ($d['eyebrow'])<span class="kos-tag">{{ $d['eyebrow'] }}</span>@endif
            <h1 class="hero-title mt-5 text-4xl leading-[1.05] sm:text-6xl">{!! $title !!}</h1>
            @if ($d['subtitle'])<p class="muted mt-6 max-w-xl text-lg leading-relaxed">{{ $d['subtitle'] }}</p>@endif
            @include('site.partials.hero-buttons')
            <ul class="kos-perks mt-9 flex flex-wrap gap-2 text-sm font-semibold" aria-label="Fasilitas utama">
                <li>WiFi</li><li>AC</li><li>Kamar mandi dalam</li><li>Parkir</li><li>CCTV 24 jam</li>
            </ul>
        </div>
        @if ($site->image($d['image']))
            <div class="relative mx-auto w-full max-w-md pb-10 lg:max-w-none">
                <div class="kos-arch">
                    <img src="{{ $site->image($d['image']) }}" alt="" class="aspect-[4/5] w-full object-cover sm:aspect-[5/6]">
                </div>
                <div class="kos-board absolute bottom-0 left-0 sm:-left-8" aria-hidden="true">
                    <div class="flex items-center justify-between gap-6 text-xs font-bold tracking-wide uppercase"><span>Papan kamar</span><span class="kos-free-label">3 kosong</span></div>
                    <div class="mt-3 grid grid-cols-8 gap-1.5">
                        @foreach ([1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1] as $taken)
                            <span @class(['kos-room', 'kos-room-free' => ! $taken])></span>
                        @endforeach
                    </div>
                </div>
                <div class="kos-price absolute top-6 -right-2 sm:-right-5" aria-hidden="true">
                    <span class="text-xs font-semibold">mulai</span>
                    <strong class="block text-2xl leading-none">850rb</strong>
                    <span class="text-xs font-semibold">/bulan</span>
                </div>
            </div>
        @endif
    </div>
</section>
