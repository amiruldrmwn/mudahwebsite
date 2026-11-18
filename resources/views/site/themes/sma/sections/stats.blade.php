<section id="{{ $sectionId }}" class="py-10">
    <div class="site-container">
        @if ($d['title'])<h2 class="sec-title mb-8">{{ $d['title'] }}</h2>@endif
        <div @class(['grid border-y', [1 => '', 2 => 'sm:grid-cols-2', 3 => 'sm:grid-cols-3'][count($d['items'])] ?? 'grid-cols-2 lg:grid-cols-4']) style="border-color: var(--line)">
            @foreach ($d['items'] as $item)
                <div class="border-l py-8 pl-6 first:border-l-0 first:pl-0" style="border-color: var(--line)">
                    <div class="text-5xl" style="font-family: var(--font-head)">{{ $item['value'] }}</div>
                    <div class="muted mt-2 text-sm">{{ $item['label'] }}</div>
                </div>
            @endforeach
        </div>
    </div>
</section>
