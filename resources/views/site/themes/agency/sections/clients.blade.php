{{-- Client names as word marks in a ruled strip. --}}
<section id="{{ $sectionId }}" class="agency-clients">
    <div class="site-container py-10">
        @if ($d['title'])<p class="agency-mono muted mb-6 text-xs tracking-widest uppercase">{{ $d['title'] }}</p>@endif
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6">
            @foreach ($d['items'] as $item)
                <div class="agency-client">
                    @if ($site->image($item['logo']))
                        <img src="{{ $site->image($item['logo']) }}" alt="{{ $item['name'] }}" class="h-8 w-auto object-contain opacity-70 grayscale" loading="lazy">
                    @else
                        <span class="agency-mark" aria-hidden="true">{{ mb_strtoupper(mb_substr($item['name'], 0, 1)) }}</span>
                        <span class="min-w-0 text-sm leading-tight font-bold tracking-tight sm:text-base">{{ $item['name'] }}</span>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</section>
