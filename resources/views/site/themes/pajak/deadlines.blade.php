{{-- The next tax deadlines counted from today: $mode 'bar' prints the nearest one, 'card' the next three. --}}
@php
    $today = now()->startOfDay();
    $months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
    $dates = [];
    foreach ([0, 1, 2] as $add) {
        $month = $today->copy()->startOfMonth()->addMonths($add);
        $dates[] = [$month->copy()->day(15), 'Setor PPh & PPN masa'];
        $dates[] = [$month->copy()->day(20), 'Lapor SPT Masa PPh'];
        $dates[] = [$month->copy()->endOfMonth()->startOfDay(), 'Lapor SPT Masa PPN'];
    }
    foreach ([$today->year, $today->year + 1] as $year) {
        $dates[] = [\Illuminate\Support\Carbon::create($year, 3, 31), 'SPT Tahunan pribadi'];
        $dates[] = [\Illuminate\Support\Carbon::create($year, 4, 30), 'SPT Tahunan badan'];
    }
    $next = collect($dates)->filter(fn ($x) => $x[0]->gte($today))->sortBy(fn ($x) => $x[0]->timestamp)->values()->take(3);
@endphp
@if (($mode ?? 'card') === 'bar')
    @php([$date, $label] = $next[0])
    <span>Tenggat terdekat: <strong>{{ $label }}</strong> · <span class="pajak-num">{{ $date->day }} {{ $months[$date->month - 1] }}</span></span>
@else
    <div class="pajak-receipt">
        <div class="flex items-center justify-between gap-3">
            <span class="pajak-num text-[11px] tracking-widest uppercase opacity-70">Kalender pajak</span>
            <span class="pajak-num text-[11px] opacity-70">{{ $today->day }} {{ $months[$today->month - 1] }} {{ $today->year }}</span>
        </div>
        <ul class="mt-3">
            @foreach ($next as [$date, $label])
                @php($days = (int) $today->diffInDays($date))
                <li class="pajak-due">
                    <span class="pajak-day"><strong>{{ $date->day }}</strong><small>{{ $months[$date->month - 1] }}</small></span>
                    <span class="min-w-0 flex-1 text-sm leading-snug font-semibold">{{ $label }}</span>
                    <span @class(['pajak-left', 'pajak-left-hot' => $days <= 5])>{{ $days === 0 ? 'Hari ini' : 'H-'.$days }}</span>
                </li>
            @endforeach
        </ul>
    </div>
@endif
