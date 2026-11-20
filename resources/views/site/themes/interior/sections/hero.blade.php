@php($title = preg_replace('/\*(.+?)\*/', '<em>$1</em>', e($d['title'])))
{{-- Editorial split: serif title with a thin rule, a tall photo set off by a brass frame, a cost note and material swatches. --}}
<section id="{{ $sectionId }}" class="interior-hero relative overflow-hidden">
    <div class="site-container relative grid items-center gap-14 py-14 sm:py-24 lg:grid-cols-[1fr_1fr] lg:gap-20">
        <div>
            @if ($d['eyebrow'])<p class="interior-kicker">{{ $d['eyebrow'] }}</p>@endif
            <h1 class="hero-title mt-6 text-4xl leading-[1.12] sm:text-6xl">{!! $title !!}</h1>
            @if ($d['subtitle'])<p class="muted mt-7 max-w-lg text-lg leading-relaxed">{{ $d['subtitle'] }}</p>@endif
            @include('site.partials.hero-buttons')
            <div class="mt-12 flex flex-wrap items-center gap-x-6 gap-y-3" aria-label="Contoh material">
                @foreach (['Oak' => '#c8a273', 'Walnut' => '#6b4a33', 'Putih doff' => '#f1eee8', 'Marmer' => 'linear-gradient(135deg,#f4f2ee 30%,#cfcac2 45%,#f4f2ee 60%)', 'Zaitun' => 'var(--brand)'] as $name => $fill)
                    <span class="flex items-center gap-2 text-xs tracking-wide"><span class="interior-swatch" style="background: {{ $fill }}"></span>{{ $name }}</span>
                @endforeach
            </div>
        </div>
        @if ($site->image($d['image']))
            <div class="relative mx-auto w-full max-w-md pb-8 lg:max-w-none">
                <div class="interior-frame" aria-hidden="true"></div>
                <img src="{{ $site->image($d['image']) }}" alt="" class="relative aspect-[4/5] w-full object-cover">
                <div class="interior-note absolute bottom-0 left-4 sm:-left-10" aria-hidden="true">
                    <span class="text-[11px] tracking-[.2em] uppercase opacity-80">Kitchen set HPL</span>
                    <strong class="mt-1 block text-2xl font-normal" style="font-family: var(--font-head)">Rp2,6 jt</strong>
                    <span class="text-xs opacity-80">per meter lari, sudah terpasang</span>
                </div>
            </div>
        @endif
    </div>
</section>
