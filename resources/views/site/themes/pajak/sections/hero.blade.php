@php($title = preg_replace('/\*(.+?)\*/', '<em>$1</em>', e($d['title'])))
{{-- Ledger paper with a red margin rule, a serif headline and the next deadlines on a receipt beside the photo. --}}
<section id="{{ $sectionId }}" class="pajak-paper relative overflow-hidden">
    <div class="site-container relative grid items-center gap-14 py-16 sm:py-24 lg:grid-cols-2">
        <div class="pajak-margin">
            @if ($d['eyebrow'])<span class="pajak-eyebrow">{{ $d['eyebrow'] }}</span>@endif
            <h1 class="hero-title mt-5 text-4xl leading-[1.1] sm:text-6xl">{!! $title !!}</h1>
            @if ($d['subtitle'])<p class="muted mt-6 max-w-lg text-lg leading-relaxed">{{ $d['subtitle'] }}</p>@endif
            @include('site.partials.hero-buttons')
            <ul class="pajak-num mt-9 flex flex-wrap gap-x-6 gap-y-2 text-xs tracking-wide uppercase" style="color: var(--muted)">
                <li>✓ Brevet A/B/C</li><li>✓ Lapor via Coretax</li><li>✓ Kerahasiaan terjamin</li>
            </ul>
        </div>
        <div class="relative mx-auto w-full max-w-lg sm:pb-16">
            @if ($site->image($d['image']))<img src="{{ $site->image($d['image']) }}" alt="" class="pajak-photo aspect-[5/4] w-full object-cover">@endif
            <div class="relative mx-3 -mt-12 sm:absolute sm:bottom-0 sm:-left-10 sm:mx-0 sm:mt-0 sm:w-80">
                @include('site.themes.pajak.deadlines')
            </div>
        </div>
    </div>
</section>
