{{-- Full-bleed travel photo with a booking box that composes a WhatsApp message. --}}
<section id="{{ $sectionId }}" class="relative px-3 pt-3">
    <div class="motor-hero relative overflow-hidden rounded-[2rem] text-white">
        @if ($site->image($d['image']))
            <img src="{{ $site->image($d['image']) }}" alt="" class="absolute inset-0 h-full w-full object-cover">
        @endif
        <div class="absolute inset-0 bg-gradient-to-t from-black/75 via-black/30 to-black/10"></div>
        <div class="site-container relative flex min-h-[560px] flex-col justify-end pt-24 pb-36 sm:min-h-[620px]">
            @if ($d['eyebrow'])<span class="motor-pill self-start">{{ $d['eyebrow'] }}</span>@endif
            <h1 class="hero-title mt-4 max-w-3xl text-5xl leading-[1] sm:text-7xl">{{ $d['title'] }}</h1>
            @if ($d['subtitle'])<p class="mt-5 max-w-xl text-lg leading-relaxed text-white/85">{{ $d['subtitle'] }}</p>@endif
        </div>
    </div>
    @if ($site->whatsappUrl())
        <form class="motor-book site-container relative z-10 -mt-24 mb-4" data-motor-book data-wa="{{ $site->whatsappUrl() }}">
            <div class="grid gap-3 rounded-3xl bg-white p-4 shadow-2xl sm:grid-cols-2 sm:p-5 lg:grid-cols-[1fr_1fr_1fr_1.2fr_auto] lg:items-end">
                <label class="grid gap-1 text-xs font-semibold">Tanggal ambil<input type="date" name="from" class="field" required></label>
                <label class="grid gap-1 text-xs font-semibold">Tanggal kembali<input type="date" name="to" class="field" required></label>
                <label class="grid gap-1 text-xs font-semibold">Jenis motor
                    <select name="type" class="field">
                        <option>Matic 110cc</option><option>Maxi 155cc</option><option>Vespa / retro</option><option>Trail</option>
                    </select>
                </label>
                <label class="grid gap-1 text-xs font-semibold">Lokasi antar<input type="text" name="place" class="field" placeholder="Nama hotel / alamat"></label>
                <button type="submit" class="btn h-[46px] px-6! text-sm sm:col-span-2 lg:col-span-1">Cek via WhatsApp</button>
            </div>
        </form>
        <script>
            (() => {
                const form = document.currentScript.previousElementSibling;
                form.addEventListener('submit', (e) => {
                    e.preventDefault();
                    const f = new FormData(form);
                    const text = `Halo, saya mau sewa motor ${f.get('type')} dari ${f.get('from')} sampai ${f.get('to')}` + (f.get('place') ? `, diantar ke ${f.get('place')}` : '') + '. Apakah tersedia?';
                    if (navigator.sendBeacon) navigator.sendBeacon(@json(route('stats.whatsapp')));
                    window.open(form.dataset.wa + '?text=' + encodeURIComponent(text), '_blank', 'noopener');
                });
            })();
        </script>
    @else
        <div class="h-12"></div>
    @endif
</section>
