@php
    $price = (int) preg_replace('/\D/', '', $d['price']) ?: 500000000;
    $dp = min(90, max(0, (int) $d['down_payment'] ?: 20));
    $rate = (float) str_replace(',', '.', $d['rate'] ?: '7.5');
    $years = min(30, max(1, (int) $d['years'] ?: 15));
    $car = ($theme ?? null) === 'mobil';
@endphp
<section id="{{ $sectionId }}" class="sec sec-alt">
    <div class="site-container">
        @if ($d['title'] || $d['subtitle'])
            <div class="sec-head">
                @if ($d['title'])<h2 class="sec-title">{{ $d['title'] }}</h2>@endif
                @if ($d['subtitle'])<p class="sec-sub">{{ $d['subtitle'] }}</p>@endif
            </div>
        @endif
        <div class="kpr card mx-auto grid max-w-4xl gap-8 p-6! sm:p-8! md:grid-cols-2" data-kpr>
            <div class="grid gap-4">
                <label class="grid gap-1.5 text-sm font-medium">{{ $car ? 'Harga mobil (Rp)' : 'Harga properti (Rp)' }}
                    <input type="text" inputmode="numeric" class="field" data-kpr-price value="{{ number_format($price, 0, ',', '.') }}">
                </label>
                <label class="grid gap-1.5 text-sm font-medium">Uang muka: <span data-kpr-dp-label>{{ $dp }}%</span>
                    <input type="range" min="0" max="90" step="5" value="{{ $dp }}" data-kpr-dp class="accent-[var(--brand)]">
                </label>
                <label class="grid gap-1.5 text-sm font-medium">Bunga per tahun (%)
                    <input type="number" step="0.1" min="0" max="30" class="field" data-kpr-rate value="{{ $rate }}">
                </label>
                <label class="grid gap-1.5 text-sm font-medium">Tenor: <span data-kpr-years-label>{{ $years }} tahun</span>
                    <input type="range" min="1" max="30" value="{{ $years }}" data-kpr-years class="accent-[var(--brand)]">
                </label>
            </div>
            <div class="kpr-result flex flex-col justify-center rounded-2xl p-6 text-center" style="background: var(--brand); color: var(--on-brand)">
                <div class="text-sm opacity-80">Perkiraan cicilan per bulan</div>
                <div class="mt-2 text-4xl font-extrabold tracking-tight" data-kpr-monthly>-</div>
                <div class="mt-5 grid grid-cols-2 gap-3 text-left text-sm">
                    <div class="rounded-xl bg-white/10 p-3"><div class="opacity-75">Uang muka</div><div class="font-bold" data-kpr-dp-amount>-</div></div>
                    <div class="rounded-xl bg-white/10 p-3"><div class="opacity-75">Pokok pinjaman</div><div class="font-bold" data-kpr-loan>-</div></div>
                </div>
                @if ($site->whatsappUrl())<a href="{{ $site->whatsappUrl($car ? 'Halo, saya ingin mengajukan kredit mobil' : 'Halo, saya ingin konsultasi KPR') }}" target="_blank" rel="noopener" class="btn btn-light mt-6">{{ $car ? 'Ajukan Kredit' : 'Konsultasi KPR' }}</a>@endif
            </div>
            @if ($d['note'])<p class="muted text-xs md:col-span-2">{{ $d['note'] }}</p>@endif
        </div>
    </div>
</section>
@once
    <script>
        // Annuity instalment: P × r / (1 − (1 + r)^−n), with monthly rate r and n months.
        document.addEventListener('DOMContentLoaded', () => document.querySelectorAll('[data-kpr]').forEach((el) => {
            const $ = (s) => el.querySelector(s);
            const rp = (n) => 'Rp' + Math.round(n).toLocaleString('id-ID');
            const update = () => {
                const price = Number($('[data-kpr-price]').value.replace(/\D/g, '')) || 0;
                const dp = Number($('[data-kpr-dp]').value);
                const years = Number($('[data-kpr-years]').value);
                const r = Number($('[data-kpr-rate]').value) / 100 / 12;
                const n = years * 12;
                const loan = price * (1 - dp / 100);
                const monthly = r > 0 ? (loan * r) / (1 - Math.pow(1 + r, -n)) : loan / n;
                $('[data-kpr-dp-label]').textContent = dp + '%';
                $('[data-kpr-years-label]').textContent = years + ' tahun';
                $('[data-kpr-dp-amount]').textContent = rp(price * dp / 100);
                $('[data-kpr-loan]').textContent = rp(loan);
                $('[data-kpr-monthly]').textContent = rp(monthly);
            };
            el.querySelectorAll('input').forEach((i) => i.addEventListener('input', update));
            $('[data-kpr-price]').addEventListener('blur', (e) => {
                const v = Number(e.target.value.replace(/\D/g, '')) || 0;
                e.target.value = v.toLocaleString('id-ID');
            });
            update();
        }));
    </script>
@endonce
