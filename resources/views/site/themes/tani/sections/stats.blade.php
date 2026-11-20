{{-- Harvest figures on leaf green, each under a small sprout. --}}
<section id="{{ $sectionId }}" class="tani-stats">
    <div class="site-container py-14 sm:py-20">
        @if ($d['title'])<h2 class="sec-title mb-10 text-center text-white">{{ $d['title'] }}</h2>@endif
        <div @class(['grid grid-cols-2 gap-x-6 gap-y-10 text-center', [1 => 'grid-cols-1!', 3 => 'sm:grid-cols-3'][count($d['items'])] ?? 'lg:grid-cols-4'])>
            @foreach ($d['items'] as $item)
                <div>
                    <svg viewBox="0 0 24 24" class="mx-auto size-7 text-[#f2b632]" fill="currentColor" aria-hidden="true"><path d="M12 21c0-7 1.5-11 7-15-6.5.5-9.8 4.3-7 15zM12 21c-.5-5-2.4-8-6.5-9.5.5 4.7 2.8 7.5 6.5 9.5z"/></svg>
                    <div class="mt-3 text-4xl text-white sm:text-5xl" style="font-family: var(--font-head)">{{ $item['value'] }}</div>
                    <div class="mt-2 text-sm font-semibold text-white/80">{{ $item['label'] }}</div>
                </div>
            @endforeach
        </div>
    </div>
</section>
