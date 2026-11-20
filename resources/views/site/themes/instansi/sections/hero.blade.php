@php($title = preg_replace('/\*(.+?)\*/', '<em>$1</em>', e($d['title'])))
{{-- Official split: a solid blue panel with the headline, the office photo, and a service pledge card. --}}
<section id="{{ $sectionId }}" class="instansi-hero relative overflow-hidden">
    <div class="site-container relative grid items-center gap-10 py-14 sm:py-20 lg:grid-cols-[1.05fr_1fr]">
        <div>
            @if ($d['eyebrow'])<span class="instansi-eyebrow">{{ $d['eyebrow'] }}</span>@endif
            <h1 class="hero-title mt-5 text-4xl leading-[1.12] text-white sm:text-[3.4rem]">{!! $title !!}</h1>
            @if ($d['subtitle'])<p class="mt-5 max-w-xl text-lg leading-relaxed text-white/85">{{ $d['subtitle'] }}</p>@endif
            @include('site.partials.hero-buttons', ['primary' => 'instansi-gold', 'secondary' => 'btn-ghost-light'])
        </div>
        <div class="relative">
            @if ($site->image($d['image']))<img src="{{ $site->image($d['image']) }}" alt="" class="instansi-photo aspect-[4/3] w-full object-cover">@endif
            <div class="instansi-pledge relative mx-3 -mt-10 sm:absolute sm:-bottom-8 sm:-left-8 sm:mx-0 sm:mt-0 sm:w-72">
                <strong class="block text-sm tracking-wide uppercase" style="color: var(--brand)">Maklumat pelayanan</strong>
                <ul class="mt-2 space-y-1.5 text-sm font-medium">
                    <li class="flex gap-2"><span class="instansi-tick" aria-hidden="true">✓</span>Gratis, tanpa pungutan</li>
                    <li class="flex gap-2"><span class="instansi-tick" aria-hidden="true">✓</span>Tanpa calo, dilayani langsung</li>
                    <li class="flex gap-2"><span class="instansi-tick" aria-hidden="true">✓</span>Ramah lansia & disabilitas</li>
                </ul>
            </div>
        </div>
    </div>
</section>
