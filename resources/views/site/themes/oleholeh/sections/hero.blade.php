@php($title = preg_replace('/\*(.+?)\*/', '<em>$1</em>', e($d['title'])))
{{-- Kraft paper, the photo as a sticker-outlined box with a halal/PIRT seal, a price tag and a tear-off PO ticket. --}}
<section id="{{ $sectionId }}" class="oleh-hero relative overflow-hidden">
    <div class="site-container relative grid items-center gap-14 py-14 sm:py-20 lg:grid-cols-2">
        <div>
            @if ($d['eyebrow'])<span class="oleh-label">{{ $d['eyebrow'] }}</span>@endif
            <h1 class="hero-title mt-6 text-[2.5rem] leading-[1.04] sm:text-[3.7rem]">{!! $title !!}</h1>
            @if ($d['subtitle'])<p class="muted mt-6 max-w-lg text-lg leading-relaxed">{{ $d['subtitle'] }}</p>@endif
            @include('site.partials.hero-buttons', ['secondary' => 'oleh-outline'])
        </div>
        @if ($site->image($d['image']))
            <div class="relative mx-auto w-full max-w-lg pb-14">
                <div class="oleh-photo">
                    <img src="{{ $site->image($d['image']) }}" alt="" class="aspect-[5/4] w-full object-cover">
                </div>
                <span class="oleh-seal absolute -top-5 -right-2 sm:-right-5" aria-hidden="true"><b>HALAL</b>&amp; PIRT</span>
                <span class="oleh-pricetag absolute top-6 -left-3 sm:-left-6">mulai <b>Rp25rb</b></span>
                <div class="oleh-ticket absolute right-2 bottom-0 sm:right-8">
                    <span class="oleh-ticket-main"><span class="block text-[11px] font-bold tracking-wider uppercase opacity-70">PO berikutnya</span><strong class="block">Kirim Senin pagi</strong></span>
                    <span class="oleh-ticket-stub" aria-hidden="true">❄</span>
                </div>
            </div>
        @endif
    </div>
</section>
