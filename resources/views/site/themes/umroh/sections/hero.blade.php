<section id="{{ $sectionId }}" class="pb-16" style="background: color-mix(in oklab, var(--brand) 96%, black)">
    <div class="site-container">
        <div class="relative overflow-hidden rounded-[1.75rem]">
            @if ($site->image($d['image']))
                <img src="{{ $site->image($d['image']) }}" alt="" class="absolute inset-0 size-full object-cover">
            @endif
            <div class="absolute inset-0" style="background: linear-gradient(0deg, rgb(15 22 42 / .92) 0%, rgb(15 22 42 / .45) 50%, rgb(15 22 42 / .15) 100%)"></div>
            <div class="relative flex min-h-[62vh] flex-col justify-end px-6 py-12 text-white sm:px-12 sm:py-16">
                @if ($d['eyebrow'])<span class="umroh-badge mb-5 self-start rounded-full px-4 py-1.5 text-xs font-bold tracking-wide uppercase">{{ $d['eyebrow'] }}</span>@endif
                <h1 class="max-w-3xl text-4xl leading-tight font-extrabold sm:text-6xl">{{ $d['title'] }}</h1>
                @if ($d['subtitle'])<p class="mt-5 max-w-2xl text-lg leading-relaxed text-white/80">{{ $d['subtitle'] }}</p>@endif
                @include('site.partials.hero-buttons', ['primary' => 'btn-accent', 'secondary' => 'btn-ghost-light'])
            </div>
        </div>
    </div>
</section>
