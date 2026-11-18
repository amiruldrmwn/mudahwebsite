<section id="{{ $sectionId }}" class="border-b" style="background: var(--surface-alt); border-color: var(--line)">
    <div @class(['site-container grid items-center gap-10 py-14 sm:py-20', 'lg:grid-cols-2' => $site->image($d['image'])])>
        <div>
            <nav class="muted mb-5 text-sm"><a href="{{ url('/') }}" class="hover:underline">Beranda</a> <span class="mx-1">/</span> {{ $page?->title }}</nav>
            <span class="eyebrow flex items-center gap-3"><span class="inline-block h-px w-8" style="background: var(--brand)"></span>{{ $page?->title }}</span>
            <h1 class="max-w-3xl text-4xl leading-tight sm:text-5xl">{{ $d['title'] }}</h1>
            @if ($d['subtitle'])<p class="muted mt-5 max-w-2xl text-lg leading-relaxed">{{ $d['subtitle'] }}</p>@endif
        </div>
        @if ($site->image($d['image']))
            <img src="{{ $site->image($d['image']) }}" alt="" class="aspect-[16/9] w-full rounded-3xl object-cover">
        @endif
    </div>
</section>
