<section id="{{ $sectionId }}" class="border-b" style="border-color: var(--line)">
    <div @class(['site-container grid items-end gap-10 py-14 sm:py-20', 'lg:grid-cols-2' => $site->image($d['image'])])>
        <div>
            <nav class="muted mb-6 text-sm"><a href="{{ url('/') }}" class="hover:underline">Beranda</a> <span class="mx-1">/</span> {{ $page?->title }}</nav>
            <h1 class="text-5xl leading-tight sm:text-6xl">{{ $d['title'] }}</h1>
            @if ($d['subtitle'])<p class="muted mt-5 max-w-2xl text-lg leading-relaxed">{{ $d['subtitle'] }}</p>@endif
        </div>
        @if ($site->image($d['image']))
            <img src="{{ $site->image($d['image']) }}" alt="" class="aspect-[16/9] w-full rounded-2xl object-cover">
        @endif
    </div>
</section>
