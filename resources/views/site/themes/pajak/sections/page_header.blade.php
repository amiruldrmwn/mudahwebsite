<section id="{{ $sectionId }}" class="pajak-paper relative overflow-hidden border-b" style="border-color: var(--line)">
    <div class="site-container relative grid items-center gap-10 py-14 sm:py-20 md:grid-cols-[1fr_auto]">
        <div class="pajak-margin">
            <span class="pajak-eyebrow">{{ $page?->title }}</span>
            <h1 class="mt-4 max-w-3xl text-4xl leading-tight sm:text-5xl">{{ $d['title'] }}</h1>
            @if ($d['subtitle'])<p class="muted mt-4 max-w-2xl text-lg">{{ $d['subtitle'] }}</p>@endif
        </div>
        @if ($site->image($d['image']))<img src="{{ $site->image($d['image']) }}" alt="" class="pajak-photo hidden aspect-square w-56 object-cover md:block">@endif
    </div>
</section>
