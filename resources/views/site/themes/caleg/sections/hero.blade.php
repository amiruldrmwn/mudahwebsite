@php($title = preg_replace('/\*(.+?)\*/', '<em>$1</em>', e($d['title'])))
{{-- Poster style: navy with a diagonal brand band, the name in tall condensed type, the portrait and a ballot number badge. --}}
<section id="{{ $sectionId }}" class="caleg-hero relative overflow-hidden">
    <div class="caleg-band absolute"></div>
    <div class="site-container relative grid items-end gap-8 pt-14 lg:grid-cols-[1.1fr_1fr]">
        <div class="pb-14 sm:pb-20">
            @if ($d['eyebrow'])<span class="caleg-eyebrow">{{ $d['eyebrow'] }}</span>@endif
            <p class="caleg-name mt-4 text-white">{{ $site->get('site_name') }}</p>
            <h1 class="hero-title mt-3 text-3xl leading-[1.1] text-white sm:text-5xl">{!! $title !!}</h1>
            @if ($d['subtitle'])<p class="mt-5 max-w-lg text-lg leading-relaxed text-white/80">{{ $d['subtitle'] }}</p>@endif
            @include('site.partials.hero-buttons', ['secondary' => 'caleg-ghost'])
        </div>
        @if ($site->image($d['image']))
            <div class="relative mx-auto w-full max-w-md self-end">
                <img src="{{ $site->image($d['image']) }}" alt="" class="caleg-photo aspect-[4/5] w-full object-cover object-top">
                @if (preg_match('/nomor urut\s*(\d+)/i', $d['eyebrow'], $m))
                    <div class="caleg-number absolute top-6 right-0 sm:-right-4"><span>No.</span>{{ $m[1] }}</div>
                @endif
            </div>
        @endif
    </div>
</section>
