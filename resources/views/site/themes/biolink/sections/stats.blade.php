<section id="{{ $sectionId }}" class="px-6 pb-4 sm:px-10">
    <div class="grid grid-cols-3 divide-x rounded-2xl border text-center" style="border-color: var(--line); --tw-divide-opacity: 1">
        @foreach (array_slice($d['items'], 0, 3) as $item)
            <div class="px-2 py-5" style="border-color: var(--line)">
                <div class="text-2xl font-extrabold" style="font-family: var(--font-head)">{{ $item['value'] }}</div>
                <div class="muted mt-1 text-xs">{{ $item['label'] }}</div>
            </div>
        @endforeach
    </div>
</section>
