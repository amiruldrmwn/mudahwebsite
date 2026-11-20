{{-- A loyalty stamp card: nine stamps filled, the tenth wash free. --}}
<section id="{{ $sectionId }}" class="sec">
    <div class="site-container">
        <div class="cuci-card grid items-center gap-10 p-7 sm:p-12 lg:grid-cols-2">
            <div>
                <span class="cuci-chip">Kartu member</span>
                <h2 class="mt-4 text-3xl font-bold text-white sm:text-4xl">{{ $d['title'] }}</h2>
                @if ($d['text'])<p class="mt-4 max-w-xl text-lg text-slate-300">{{ $d['text'] }}</p>@endif
                @if ($d['button_label'] && $d['button_url'])<a href="{{ $d['button_url'] }}" class="btn mt-8">{{ $d['button_label'] }}</a>@endif
            </div>
            <div class="cuci-stamps grid grid-cols-5 gap-3 sm:gap-4" aria-hidden="true">
                @for ($i = 1; $i <= 10; $i++)
                    <span @class(['cuci-stamp', 'cuci-stamp-on' => $i <= 7, 'cuci-stamp-free' => $i === 10])>{{ $i === 10 ? 'GRATIS' : ($i <= 7 ? '✓' : $i) }}</span>
                @endfor
            </div>
        </div>
    </div>
</section>
