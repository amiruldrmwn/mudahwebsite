<section id="{{ $sectionId }}" class="sec">
    <div class="site-container">
        <div class="agency-cta relative overflow-hidden px-6 py-14 sm:px-14 sm:py-20">
            <div class="agency-grid agency-grid-dark absolute inset-0" aria-hidden="true"></div>
            <div class="relative grid items-end gap-8 lg:grid-cols-[1fr_auto]">
                <div>
                    <span class="agency-mono text-sm text-[#d4ff3a]">// ayo mulai</span>
                    <h2 class="mt-3 text-4xl leading-[1.05] font-extrabold text-white sm:text-6xl">{{ $d['title'] }}</h2>
                    @if ($d['text'])<p class="mt-5 max-w-2xl text-lg text-white/70">{{ $d['text'] }}</p>@endif
                </div>
                @if ($d['button_label'] && $d['button_url'])<a href="{{ $d['button_url'] }}" class="agency-lime self-start lg:self-end">{{ $d['button_label'] }} <span aria-hidden="true">&rarr;</span></a>@endif
            </div>
        </div>
    </div>
</section>
