@php($title = preg_replace('/\*(.+?)\*/', '<em>$1</em>', e($d['title'])))
<section id="{{ $sectionId }}" class="apotek-hero relative overflow-hidden">
    <div class="site-container grid items-center gap-12 py-16 sm:py-24 lg:grid-cols-2">
        <div>
            @if ($d['eyebrow'])<span class="apotek-chip">{{ $d['eyebrow'] }}</span>@endif
            <h1 class="hero-title mt-5 text-5xl leading-[1.05] sm:text-6xl">{!! $title !!}</h1>
            @if ($d['subtitle'])<p class="muted mt-5 max-w-lg text-lg leading-relaxed">{{ $d['subtitle'] }}</p>@endif
            @if ($site->whatsappUrl())
                <form class="mt-8 flex max-w-lg gap-2 rounded-full bg-white p-1.5 shadow-lg" data-ask-drug>
                    <input type="text" name="q" required placeholder="Cari obat atau tanya keluhan…" class="min-w-0 flex-1 rounded-full bg-transparent px-4 text-sm outline-none" aria-label="Nama obat atau keluhan">
                    <button type="submit" class="btn px-5! py-2.5! text-sm">Tanya</button>
                </form>
                <script>
                    (() => {
                        const form = document.currentScript.previousElementSibling;
                        form.addEventListener('submit', (e) => {
                            e.preventDefault();
                            if (navigator.sendBeacon) navigator.sendBeacon(@json(route('stats.whatsapp')));
                            window.open(@json($site->whatsappUrl()) + '?text=' + encodeURIComponent('Halo apoteker, saya mau tanya: ' + form.q.value), '_blank', 'noopener');
                        });
                    })();
                </script>
            @else
                @include('site.partials.hero-buttons')
            @endif
        </div>
        @if ($site->image($d['image']))
            <div class="relative mx-auto w-full max-w-md">
                <img src="{{ $site->image($d['image']) }}" alt="" class="aspect-[4/5] w-full rounded-[2rem] object-cover shadow-2xl">
                <span class="absolute top-6 -left-6 flex items-center gap-2 rounded-2xl bg-white px-4 py-3 text-sm font-semibold shadow-xl"><span class="apotek-dot"></span>Apoteker siap membantu</span>
            </div>
        @endif
    </div>
</section>
