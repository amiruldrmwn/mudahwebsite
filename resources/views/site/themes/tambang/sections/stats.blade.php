{{-- Performance panel: a white card, pulled up over the hero when it comes right after it. --}}
<section id="{{ $sectionId }}" @class(['relative z-10', '-mt-14 pb-6' => ($index ?? 0) === 1, 'py-12' => ($index ?? 0) !== 1])>
    <div class="site-container">
        <div class="overflow-hidden rounded-xl bg-white shadow-2xl ring-1 ring-black/5">
            @if ($d['title'])<div class="border-b px-6 py-4 text-sm font-bold tracking-wider uppercase" style="border-color: var(--line); color: var(--brand)">{{ $d['title'] }}</div>@endif
            <div @class(['grid divide-y sm:divide-x sm:divide-y-0', [1 => '', 2 => 'sm:grid-cols-2', 3 => 'sm:grid-cols-3'][count($d['items'])] ?? 'sm:grid-cols-2 lg:grid-cols-4']) style="border-color: var(--line)">
                @foreach ($d['items'] as $item)
                    <div class="px-6 py-6" style="border-color: var(--line)">
                        <div class="text-3xl font-extrabold tracking-tight sm:text-4xl" style="color: var(--brand)">{{ $item['value'] }}</div>
                        <div class="muted mt-1 text-sm">{{ $item['label'] }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
