<section id="{{ $sectionId }}" class="pb-12" style="background: color-mix(in oklab, var(--brand) 96%, black)">
    <div class="site-container">
        <div class="relative overflow-hidden rounded-[1.75rem]" style="background: var(--brand)">
            @if ($site->image($d['image']))
                <img src="{{ $site->image($d['image']) }}" alt="" class="absolute inset-0 size-full object-cover">
                <div class="absolute inset-0" style="background: rgb(15 22 42 / .7)"></div>
            @endif
            <div class="relative px-6 py-16 text-center text-white sm:py-24">
                <span class="umroh-badge mb-4 inline-block rounded-full px-4 py-1.5 text-xs font-bold tracking-wide uppercase">{{ $page?->title }}</span>
                <h1 class="mx-auto max-w-3xl text-4xl font-extrabold sm:text-5xl">{{ $d['title'] }}</h1>
                @if ($d['subtitle'])<p class="mx-auto mt-4 max-w-2xl text-lg text-white/80">{{ $d['subtitle'] }}</p>@endif
            </div>
        </div>
    </div>
</section>
