@php($title = preg_replace('/\*(.+?)\*/', '<em>$1</em>', e($d['title'])))
{{-- Violet with a yellow speed stripe, the truck photo and a parcel tracking card. --}}
<section id="{{ $sectionId }}" class="ekspedisi-hero relative overflow-hidden">
    <div class="ekspedisi-stripe absolute hidden lg:block"></div>
    <div class="site-container relative grid items-center gap-12 py-16 sm:py-24 lg:grid-cols-2">
        <div>
            @if ($d['eyebrow'])<span class="ekspedisi-tag">{{ $d['eyebrow'] }}</span>@endif
            <h1 class="hero-title mt-5 text-4xl leading-[1.08] text-white sm:text-6xl">{!! $title !!}</h1>
            @if ($d['subtitle'])<p class="mt-6 max-w-lg text-lg leading-relaxed text-white/80">{{ $d['subtitle'] }}</p>@endif
            @include('site.partials.hero-buttons', ['secondary' => 'ekspedisi-ghost'])
        </div>
        <div class="relative mx-auto w-full max-w-lg">
            @if ($site->image($d['image']))<img src="{{ $site->image($d['image']) }}" alt="" class="ekspedisi-photo aspect-[4/3] w-full object-cover">@endif
            <div class="ekspedisi-track absolute -bottom-8 left-4 right-4 sm:-left-8 sm:right-auto sm:w-80">
                <strong class="text-sm">Lacak kiriman</strong>
                <div class="mt-2 flex gap-2">
                    <span class="ekspedisi-input flex-1">Nomor resi</span>
                    <a href="{{ $site->whatsappUrl() ?: url('/kontak') }}" class="btn px-4! py-2! text-sm">Lacak</a>
                </div>
            </div>
        </div>
    </div>
</section>
