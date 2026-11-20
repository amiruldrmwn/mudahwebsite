@php($title = preg_replace('/\*(.+?)\*/', '<em>$1</em>', e($d['title'])))
{{-- Paper with a blueprint grid, a huge headline with a lime marker, and the photo inside a browser window with a result card. --}}
<section id="{{ $sectionId }}" class="agency-hero relative overflow-hidden">
    <div class="agency-grid absolute inset-0" aria-hidden="true"></div>
    <div class="site-container relative grid items-center gap-14 py-16 sm:py-24 lg:grid-cols-[1.1fr_1fr]">
        <div class="min-w-0">
            @if ($d['eyebrow'])<span class="agency-label"><span class="agency-dot"></span>{{ $d['eyebrow'] }}</span>@endif
            <h1 class="hero-title mt-6 text-[2.6rem] leading-[1.02] break-words sm:text-7xl">{!! $title !!}</h1>
            @if ($d['subtitle'])<p class="muted mt-7 max-w-xl text-lg leading-relaxed">{{ $d['subtitle'] }}</p>@endif
            @include('site.partials.hero-buttons', ['secondary' => 'agency-outline'])
        </div>
        @if ($site->image($d['image']))
            <div class="relative mx-auto w-full max-w-xl pb-10 lg:pb-0">
                <div class="agency-window">
                    <div class="agency-window-bar" aria-hidden="true">
                        <span></span><span></span><span></span>
                        <code class="agency-url">https://bisnisanda.co.id</code>
                    </div>
                    <img src="{{ $site->image($d['image']) }}" alt="" class="aspect-[4/3] w-full object-cover">
                </div>
                <div class="agency-result absolute -bottom-2 left-3 sm:-left-8 lg:-bottom-8">
                    <span class="agency-mono text-[11px] opacity-70">konversi / 30 hari</span>
                    <strong class="mt-1 block text-3xl leading-none">+182%</strong>
                    <span class="agency-bars mt-3" aria-hidden="true"><i style="height: 30%"></i><i style="height: 45%"></i><i style="height: 40%"></i><i style="height: 65%"></i><i style="height: 80%"></i><i style="height: 100%"></i></span>
                </div>
                <span class="agency-deploy absolute -top-4 right-3 sm:-right-4">&#10003; deploy 42 dtk</span>
            </div>
        @endif
    </div>
</section>
