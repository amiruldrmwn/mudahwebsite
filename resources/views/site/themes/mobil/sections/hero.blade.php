{{-- Showroom hero: centred headline, wide car photo, and a perks bar overlapping it. --}}
<section id="{{ $sectionId }}" class="mobil-hero relative overflow-hidden">
    <div class="site-container pt-14 text-center sm:pt-20">
        @if ($d['eyebrow'])<span class="mobil-chip">{{ $d['eyebrow'] }}</span>@endif
        <h1 class="hero-title mx-auto mt-5 max-w-4xl text-5xl leading-[1.02] sm:text-7xl">{{ $d['title'] }}</h1>
        @if ($d['subtitle'])<p class="muted mx-auto mt-5 max-w-2xl text-lg leading-relaxed">{{ $d['subtitle'] }}</p>@endif
        @include('site.partials.hero-buttons', ['class' => 'justify-center mt-8!'])
    </div>
    @if ($site->image($d['image']))
        <div class="site-container relative mt-12 pb-16">
            <img src="{{ $site->image($d['image']) }}" alt="" class="aspect-[4/3] w-full rounded-[2rem] sm:aspect-[21/9] object-cover shadow-[0_30px_80px_-30px_rgb(11_18_32/0.45)]">
            <div class="mobil-perks relative z-10 mx-auto -mt-10 grid max-w-4xl grid-cols-2 gap-px overflow-hidden rounded-2xl bg-[var(--line)] shadow-xl sm:grid-cols-4">
                @foreach ([['DP mulai', '15%'], ['Tenor hingga', '6 tahun'], ['Garansi', '5 tahun'], ['Test drive', 'ke rumah']] as [$label, $value])
                    <div class="bg-white px-4 py-4 text-center">
                        <div class="muted text-xs">{{ $label }}</div>
                        <div class="mt-0.5 text-lg font-extrabold" style="color: var(--ink)">{{ $value }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</section>
