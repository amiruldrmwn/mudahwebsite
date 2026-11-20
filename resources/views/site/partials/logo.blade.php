@php
    // Template demos always show the template's own sample logo and name, never the site's.
    $logo = isset($sampleLogo) ? $sampleLogo : $site->get('logo');
    $showName = isset($sampleLogo) || $site->get('show_name') !== 'no';
@endphp
<a href="{{ url('/') }}" class="flex items-center gap-3 {{ $class ?? '' }}">
    @if ($logo === \App\Sections\DefaultContent::LOGO)
        {{-- Sample logo: drawn in the site's colour, next to the company name. --}}
        @if ($theme === 'spa')
            @include('site.partials.spa-ornament', ['class' => 'size-10 shrink-0'])
        @elseif ($theme === 'kue')
            <svg viewBox="0 0 48 48" class="size-10 shrink-0" aria-hidden="true">
                <circle cx="24" cy="24" r="24" style="fill: var(--brand)"/>
                <path d="M13 31h22v6H13zM15 25h18v6H15z" style="fill: var(--on-brand)" opacity=".9"/>
                <path d="M15 25c2-3 4-3 6 0s4 3 6 0 4-3 6 0" fill="none" style="stroke: var(--brand)" stroke-width="2"/>
                <path d="M24 20v-5" style="stroke: var(--on-brand)" stroke-width="2.2" stroke-linecap="round"/>
                <circle cx="24" cy="12.5" r="2" style="fill: #f59e0b"/>
            </svg>
        @elseif ($theme === 'rental')
            {{-- Car. --}}
            <svg viewBox="0 0 48 48" class="size-10 shrink-0" aria-hidden="true">
                <rect width="48" height="48" rx="12" style="fill: var(--brand)"/>
                <path d="M10 29l3-8c.5-1.4 1.8-2.3 3.3-2.3h15.4c1.5 0 2.8.9 3.3 2.3l3 8v5H10z" fill="none" style="stroke: #fbbf24" stroke-width="2.4" stroke-linejoin="round"/>
                <circle cx="16.5" cy="33" r="2.6" fill="#fbbf24"/><circle cx="31.5" cy="33" r="2.6" fill="#fbbf24"/>
            </svg>
        @elseif ($theme === 'motor')
            {{-- Scooter. --}}
            <svg viewBox="0 0 48 48" class="size-10 shrink-0" aria-hidden="true">
                <rect x="1.5" y="1.5" width="45" height="45" rx="12" style="fill: var(--brand)" stroke="#111" stroke-width="3"/>
                <circle cx="15" cy="32" r="4" fill="none" stroke="#111" stroke-width="3"/><circle cx="33" cy="32" r="4" fill="none" stroke="#111" stroke-width="3"/>
                <path d="M15 32h12l4-12h4M27 32l-3-8h-8" fill="none" stroke="#111" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        @elseif ($theme === 'properti')
            {{-- House. --}}
            <svg viewBox="0 0 48 48" class="size-10 shrink-0" aria-hidden="true">
                <rect width="48" height="48" rx="10" style="fill: var(--brand)"/>
                <path d="M11 23L24 12l13 11" fill="none" style="stroke: #c9a227" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M15 21v15h18V21M21 36v-8h6v8" fill="none" style="stroke: var(--on-brand)" stroke-width="2.4" stroke-linejoin="round"/>
            </svg>
        @elseif ($theme === 'resto')
            {{-- Bowl and chopsticks. --}}
            <svg viewBox="0 0 48 48" class="size-10 shrink-0" aria-hidden="true">
                <circle cx="24" cy="24" r="24" style="fill: var(--brand)"/>
                <path d="M11 25h26a13 13 0 0 1-26 0z" style="fill: var(--on-brand)"/>
                <path d="M27 21l9-9M31 22l7-7" style="stroke: var(--on-brand)" stroke-width="2.2" stroke-linecap="round"/>
                <path d="M17 20c0-2 2-2 2-4M22 20c0-2 2-2 2-4" fill="none" style="stroke: var(--on-brand)" stroke-width="1.8" stroke-linecap="round"/>
            </svg>
        @elseif ($theme === 'gigi')
            {{-- Tooth. --}}
            <svg viewBox="0 0 48 48" class="size-10 shrink-0" aria-hidden="true">
                <rect width="48" height="48" rx="16" style="fill: var(--brand)"/>
                <path d="M17 12c-4 0-6 3-6 7 0 3 1.5 5 2.5 8s1 9 3.5 9c2.3 0 2.4-6 4-8.5.6-1 1.4-1 2-1s1.4 0 2 1c1.6 2.5 1.7 8.5 4 8.5 2.5 0 2.5-6 3.5-9s2.5-5 2.5-8c0-4-2-7-6-7-3 0-4 1.5-6 1.5S20 12 17 12z" style="fill: var(--on-brand)"/>
            </svg>
        @elseif ($theme === 'kecantikan')
            {{-- Sparkle in an arch. --}}
            <svg viewBox="0 0 48 48" class="size-10 shrink-0" aria-hidden="true">
                <path d="M6 46V22a18 18 0 0 1 36 0v24z" style="fill: var(--brand)"/>
                <path d="M24 16c1 6 3 8 9 9-6 1-8 3-9 9-1-6-3-8-9-9 6-1 8-3 9-9z" style="fill: var(--on-brand)"/>
            </svg>
        @elseif ($theme === 'villa')
            {{-- Sun over a palm roof. --}}
            <svg viewBox="0 0 48 48" class="size-10 shrink-0" aria-hidden="true">
                <rect width="48" height="48" rx="24" style="fill: var(--brand)"/>
                <circle cx="24" cy="20" r="6" fill="#f6d9a8"/>
                <path d="M9 33l15-9 15 9M14 30v8M34 30v8" fill="none" style="stroke: var(--on-brand)" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        @elseif ($theme === 'hijab')
            {{-- Crescent and a small flower. --}}
            <svg viewBox="0 0 48 48" class="size-9 shrink-0" aria-hidden="true">
                <circle cx="24" cy="24" r="24" style="fill: var(--brand)"/>
                <path d="M27 11a13 13 0 1 0 10 21 11 11 0 1 1-10-21z" style="fill: var(--on-brand)"/>
                <circle cx="31" cy="20" r="2.2" style="fill: var(--on-brand)"/>
            </svg>
        @elseif ($theme === 'kaos')
            {{-- T-shirt. --}}
            <svg viewBox="0 0 48 48" class="size-10 shrink-0" aria-hidden="true">
                <rect width="48" height="48" rx="12" style="fill: var(--brand)"/>
                <path d="M18 11l-9 5 3 7 4-2v16h16V21l4 2 3-7-9-5c-1 3-3 4-6 4s-5-1-6-4z" style="fill: var(--on-brand)"/>
            </svg>
        @elseif ($theme === 'mobil')
            {{-- Car front in a shield. --}}
            <svg viewBox="0 0 48 48" class="size-10 shrink-0" aria-hidden="true">
                <rect width="48" height="48" rx="10" style="fill: var(--brand)"/>
                <path d="M12 30v-5l4-8h16l4 8v5zM16 25h16l-2.5-5h-11z" style="fill: var(--on-brand)" fill-rule="evenodd"/>
                <rect x="12" y="30" width="5" height="4" rx="1" style="fill: var(--on-brand)"/>
                <rect x="31" y="30" width="5" height="4" rx="1" style="fill: var(--on-brand)"/>
            </svg>
        @elseif ($theme === 'masjid')
            {{-- Dome and crescent. --}}
            <svg viewBox="0 0 48 48" class="size-10 shrink-0" aria-hidden="true">
                <rect width="48" height="48" rx="24" style="fill: var(--brand)"/>
                <path d="M14 34v-6c0-5.5 4.5-9.5 10-11 5.5 1.5 10 5.5 10 11v6zM12 34h24" fill="none" style="stroke: var(--on-brand)" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M26.5 8.5a4 4 0 1 0 1.8 6.8 3.2 3.2 0 1 1-1.8-6.8z" fill="#e4c46a"/>
            </svg>
        @elseif ($theme === 'gym')
            {{-- Dumbbell. --}}
            <svg viewBox="0 0 48 48" class="size-10 shrink-0" aria-hidden="true">
                <rect width="48" height="48" rx="6" style="fill: var(--brand)"/>
                <path d="M15 24h18M11 17v14M37 17v14M7 20v8M41 20v8" fill="none" stroke="#fff" stroke-width="3.4" stroke-linecap="round"/>
            </svg>
        @elseif ($theme === 'klinik')
            {{-- Medical cross with a heartbeat. --}}
            <svg viewBox="0 0 48 48" class="size-10 shrink-0" aria-hidden="true">
                <rect width="48" height="48" rx="14" style="fill: var(--brand)"/>
                <path d="M19 10h10v9h9v10h-9v9H19v-9h-9V19h9z" fill="none" style="stroke: var(--on-brand)" stroke-width="2.2" stroke-linejoin="round"/>
                <path d="M15 25h5l2-4 3 7 2-3h6" fill="none" stroke="#7dd3fc" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        @elseif ($theme === 'bangunan')
            {{-- Bricks. --}}
            <svg viewBox="0 0 48 48" class="size-10 shrink-0" aria-hidden="true">
                <rect width="48" height="48" rx="8" fill="#1f2937"/>
                <path d="M9 14h14v6H9zM25 14h14v6H25zM16 22h16v6H16zM9 22h5v6H9zM34 22h5v6h-5zM9 30h14v6H9zM25 30h14v6H25z" style="fill: var(--brand)"/>
            </svg>
        @elseif ($theme === 'percetakan')
            {{-- Four CMYK drops. --}}
            <svg viewBox="0 0 48 48" class="size-10 shrink-0" aria-hidden="true">
                <rect width="48" height="48" rx="14" fill="#111827"/>
                <circle cx="18" cy="18" r="7" fill="#06b6d4"/><circle cx="30" cy="18" r="7" style="fill: var(--brand)" opacity=".9"/><circle cx="18" cy="30" r="7" fill="#facc15" opacity=".9"/><circle cx="30" cy="30" r="7" fill="#fff" opacity=".85"/>
            </svg>
        @elseif ($theme === 'eo')
            {{-- Spotlight star. --}}
            <svg viewBox="0 0 48 48" class="size-10 shrink-0" aria-hidden="true">
                <rect width="48" height="48" rx="12" fill="#0b0b12"/>
                <path d="M24 9l3.6 9.4L37 22l-9.4 3.6L24 35l-3.6-9.4L11 22l9.4-3.6z" style="fill: var(--brand)"/>
                <circle cx="36" cy="36" r="2.5" fill="#fbbf24"/>
            </svg>
        @elseif ($theme === 'desa')
            {{-- Rice field and roof. --}}
            <svg viewBox="0 0 48 48" class="size-10 shrink-0" aria-hidden="true">
                <rect width="48" height="48" rx="10" style="fill: var(--brand)"/>
                <path d="M12 24l12-10 12 10M16 22v10h16V22" fill="none" style="stroke: var(--on-brand)" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M8 37c5-3 9-3 16 0s11 3 16 0" fill="none" stroke="#fde047" stroke-width="2.4" stroke-linecap="round"/>
            </svg>
        @elseif ($theme === 'cv')
            {{-- Monogram. --}}
            <span class="flex size-10 shrink-0 items-center justify-center rounded-full text-lg font-semibold" style="background: var(--brand); color: var(--on-brand)">{{ mb_substr($site->get('site_name') ?: 'A', 0, 1) }}</span>
        @elseif ($theme === 'travel')
            {{-- Sun over a wave. --}}
            <svg viewBox="0 0 48 48" class="size-10 shrink-0" aria-hidden="true">
                <rect width="48" height="48" rx="24" style="fill: var(--brand)"/>
                <circle cx="24" cy="21" r="6" fill="#fdba74"/>
                <path d="M9 31c4-3 7-3 10 0s6 3 10 0 7-3 10 0M12 37c3-2 6-2 9 0s6 2 9 0 5-2 6-1" fill="none" stroke="#fff" stroke-width="2.4" stroke-linecap="round"/>
            </svg>
        @elseif ($theme === 'kontraktor')
            {{-- House frame under a crane hook. --}}
            <svg viewBox="0 0 48 48" class="size-10 shrink-0" aria-hidden="true">
                <rect width="48" height="48" rx="8" style="fill: var(--brand)"/>
                <path d="M10 26l14-12 14 12M14 23v13h20V23M21 36v-8h6v8" fill="none" stroke="#fff" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        @elseif ($theme === 'umkm')
            {{-- Shopping bag with a heart. --}}
            <svg viewBox="0 0 48 48" class="size-10 shrink-0" aria-hidden="true">
                <rect width="48" height="48" rx="16" style="fill: var(--brand)"/>
                <path d="M13 18h22l-2 18H15zM19 18v-3a5 5 0 0 1 10 0v3" fill="none" stroke="#fff" stroke-width="2.4" stroke-linejoin="round"/>
                <path d="M24 32s-5-3-5-6a2.5 2.5 0 0 1 5-1 2.5 2.5 0 0 1 5 1c0 3-5 6-5 6z" fill="#fde68a"/>
            </svg>
        @elseif ($theme === 'lpk')
            {{-- Red sun with a rising arrow. --}}
            <svg viewBox="0 0 48 48" class="size-10 shrink-0" aria-hidden="true">
                <rect width="48" height="48" rx="12" style="fill: var(--brand)"/>
                <circle cx="24" cy="24" r="10" fill="#ef4444"/>
                <path d="M14 34l10-10 4 4 7-7M30 21h5v5" fill="none" stroke="#fff" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        @elseif ($theme === 'ekspedisi')
            {{-- Parcel with speed lines. --}}
            <svg viewBox="0 0 48 48" class="size-10 shrink-0" aria-hidden="true">
                <rect width="48" height="48" rx="10" style="fill: var(--brand)"/>
                <path d="M20 16l12-4 10 4v14l-10 5-12-5zM20 16l12 5 10-5M32 21v14" fill="none" stroke="#fff" stroke-width="2.2" stroke-linejoin="round"/>
                <path d="M6 20h9M8 26h8M10 32h7" stroke="#facc15" stroke-width="2.4" stroke-linecap="round"/>
            </svg>
        @elseif ($theme === 'desa2')
            {{-- Shield with a tree. --}}
            <svg viewBox="0 0 48 48" class="size-10 shrink-0" aria-hidden="true">
                <path d="M24 3l17 6v13c0 11-7 19-17 23C14 41 7 33 7 22V9z" fill="#fff"/>
                <path d="M24 7l13 4.6V22c0 8.6-5.4 15-13 18.4C16.4 37 11 30.6 11 22V11.6z" style="fill: var(--brand)"/>
                <circle cx="24" cy="19" r="6" fill="#86efac"/>
                <path d="M24 22v11M18 33h12" stroke="#fde047" stroke-width="2.4" stroke-linecap="round"/>
            </svg>
        @elseif ($theme === 'servis')
            {{-- Phone with a wrench. --}}
            <svg viewBox="0 0 48 48" class="size-10 shrink-0" aria-hidden="true">
                <rect width="48" height="48" rx="12" fill="#0b1120"/>
                <rect x="15" y="9" width="15" height="27" rx="3" fill="none" style="stroke: var(--brand)" stroke-width="2.4"/>
                <path d="M30 30l7 7M34.5 26.5a4 4 0 0 0-5 5l-1.5 1.5 3 3 1.5-1.5a4 4 0 0 0 5-5l-2 2-2-1-1-2z" fill="#fff"/>
            </svg>
        @elseif ($theme === 'paud')
            {{-- Stacked play blocks. --}}
            <svg viewBox="0 0 48 48" class="size-10 shrink-0" aria-hidden="true">
                <rect x="6" y="24" width="17" height="17" rx="4" fill="#f472b6"/>
                <rect x="25" y="24" width="17" height="17" rx="4" fill="#facc15"/>
                <rect x="15.5" y="7" width="17" height="17" rx="4" style="fill: var(--brand)"/>
                <path d="M21 17c1.8 2 4.2 2 6 0" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round"/>
            </svg>
        @elseif ($theme === 'gereja')
            {{-- Cross in an arch. --}}
            <svg viewBox="0 0 48 48" class="size-10 shrink-0" aria-hidden="true">
                <path d="M8 44V22a16 16 0 0 1 32 0v22z" style="fill: var(--brand)"/>
                <path d="M24 13v22M17 20h14" stroke="#e8c96a" stroke-width="3" stroke-linecap="round"/>
            </svg>
        @elseif ($theme === 'koperasi')
            {{-- Linked hands around a coin. --}}
            <svg viewBox="0 0 48 48" class="size-10 shrink-0" aria-hidden="true">
                <circle cx="24" cy="24" r="24" style="fill: var(--brand)"/>
                <circle cx="24" cy="24" r="8" fill="#facc15"/>
                <path d="M10 26c4-6 9-6 14 0s10 6 14 0" fill="none" stroke="#fff" stroke-width="2.6" stroke-linecap="round"/>
            </svg>
        @elseif ($theme === 'caleg')
            {{-- Star on a ribbon badge. --}}
            <svg viewBox="0 0 48 48" class="size-10 shrink-0" aria-hidden="true">
                <path d="M14 30l-4 14 7-3 4 6 3-15zM34 30l4 14-7-3-4 6-3-15z" fill="#fff" opacity=".85"/>
                <circle cx="24" cy="20" r="16" style="fill: var(--brand)"/>
                <path d="M24 10l2.9 6.2 6.6.7-5 4.5 1.4 6.6L24 24.6l-5.9 3.4 1.4-6.6-5-4.5 6.6-.7z" fill="#fff"/>
            </svg>
        @elseif ($theme === 'bidan')
            {{-- Mother cradling a baby inside a heart. --}}
            <svg viewBox="0 0 48 48" class="size-10 shrink-0" aria-hidden="true">
                <circle cx="24" cy="24" r="24" style="fill: var(--brand)"/>
                <path d="M24 37s-11-6.6-11-14.2C13 18.6 15.9 16 19.2 16c2.2 0 3.8 1.2 4.8 2.7 1-1.5 2.6-2.7 4.8-2.7 3.3 0 6.2 2.6 6.2 6.8C35 30.4 24 37 24 37z" fill="#fff"/>
                <circle cx="24" cy="25.5" r="3.6" fill="#8fae94"/>
            </svg>
        @elseif ($theme === 'optik')
            {{-- Round spectacles. --}}
            <svg viewBox="0 0 48 48" class="size-10 shrink-0" aria-hidden="true">
                <rect width="48" height="48" rx="14" style="fill: var(--brand)"/>
                <circle cx="15.5" cy="26" r="7" fill="none" stroke="#fff" stroke-width="2.8"/>
                <circle cx="32.5" cy="26" r="7" fill="none" stroke="#fff" stroke-width="2.8"/>
                <path d="M22 24.5c1.4-1.6 2.6-1.6 4 0" fill="none" stroke="#fff" stroke-width="2.6" stroke-linecap="round"/>
                <circle cx="32.5" cy="26" r="3" fill="#7dd3fc"/>
            </svg>
        @elseif ($theme === 'emas')
            {{-- Cut gem in gold. --}}
            <svg viewBox="0 0 48 48" class="size-10 shrink-0" aria-hidden="true">
                <rect x="1" y="1" width="46" height="46" rx="4" fill="#3d0a12" stroke="#d4af5a" stroke-width="2"/>
                <path d="M14 19l5-7h10l5 7-10 17z" fill="#d4af5a"/>
                <path d="M14 19h20M19 12l5 7 5-7M24 19v17" fill="none" stroke="#3d0a12" stroke-width="1.4" stroke-linejoin="round"/>
            </svg>
        @elseif ($theme === 'oleholeh')
            {{-- Kraft gift box with a leaf. --}}
            <svg viewBox="0 0 48 48" class="size-10 shrink-0" aria-hidden="true">
                <rect width="48" height="48" rx="12" style="fill: var(--brand)"/>
                <path d="M11 21h26v16H11z" fill="#e8cfa2"/>
                <path d="M9 16h30v6H9z" fill="#f2b632"/>
                <path d="M24 16v21" stroke="#1f2937" stroke-width="2" opacity=".35"/>
                <path d="M24 16c-1-5 2-8 7-8 0 5-3 8-7 8z" fill="#bbf7d0"/>
        @elseif ($theme === 'kos')
            {{-- House with a key-hole door. --}}
            <svg viewBox="0 0 48 48" class="size-10 shrink-0" aria-hidden="true">
                <rect width="48" height="48" rx="14" style="fill: var(--brand)"/>
                <path d="M11 23L24 12l13 11v13H11z" fill="#fff"/>
                <path d="M20 36v-8a4 4 0 0 1 8 0v8z" fill="#f4b740"/>
                <circle cx="24" cy="29" r="1.6" style="fill: var(--brand)"/>
            </svg>
        @elseif ($theme === 'lapangan')
            {{-- Court with a centre circle. --}}
            <svg viewBox="0 0 48 48" class="size-10 shrink-0" aria-hidden="true">
                <rect width="48" height="48" rx="10" fill="#0b3d27"/>
                <rect x="7" y="11" width="34" height="26" rx="1.5" fill="none" stroke="#fff" stroke-width="2"/>
                <path d="M24 11v26M7 19h5v10H7M41 19h-5v10h5" fill="none" stroke="#fff" stroke-width="2"/>
                <circle cx="24" cy="24" r="5" style="fill: var(--brand)"/>
            </svg>
        @elseif ($theme === 'cucimobil')
            {{-- Water drop with a shine. --}}
            <svg viewBox="0 0 48 48" class="size-10 shrink-0" aria-hidden="true">
                <rect width="48" height="48" rx="12" fill="#11161d"/>
                <path d="M24 8c6 8 11 14 11 20a11 11 0 0 1-22 0c0-6 5-12 11-20z" style="fill: var(--brand)"/>
                <path d="M18.5 29a6 6 0 0 0 4 5" fill="none" stroke="#fff" stroke-width="2.4" stroke-linecap="round"/>
                <path d="M37 9l1 2.5 2.5 1-2.5 1-1 2.5-1-2.5-2.5-1 2.5-1z" fill="#fff"/>
            </svg>
        @elseif ($theme === 'interior')
            {{-- Arched window over a low cabinet. --}}
            <svg viewBox="0 0 48 48" class="size-10 shrink-0" aria-hidden="true">
                <circle cx="24" cy="24" r="23" fill="none" style="stroke: var(--brand)" stroke-width="1.5"/>
                <path d="M17 26V18a7 7 0 0 1 14 0v8z" fill="none" stroke="#b08d57" stroke-width="1.8"/>
                <rect x="13" y="28" width="22" height="7" style="fill: var(--brand)"/>
                <path d="M24 28v7M15 35v3M33 35v3" style="stroke: var(--brand)" stroke-width="1.8"/>
        @elseif ($theme === 'agency')
            {{-- Code brackets on an ink tile with a lime cursor. --}}
            <svg viewBox="0 0 48 48" class="size-10 shrink-0" aria-hidden="true">
                <rect x=".75" y=".75" width="46.5" height="46.5" rx="11" fill="#0c0c14" stroke="#fff" stroke-opacity=".2" stroke-width="1.5"/>
                <path d="M18 15l-8 9 8 9M30 15l8 9-8 9" fill="none" style="stroke: var(--brand)" stroke-width="3.4" stroke-linecap="round" stroke-linejoin="round"/>
                <rect x="21.5" y="27" width="5" height="6" rx="1" fill="#d4ff3a"/>
            </svg>
        @elseif ($theme === 'pajak')
            {{-- Ledger sheet with a tick and a percent mark. --}}
            <svg viewBox="0 0 48 48" class="size-10 shrink-0" aria-hidden="true">
                <rect x="6" y="4" width="36" height="40" rx="4" style="fill: var(--brand)"/>
                <path d="M13 14h22M13 21h22M13 28h12" stroke="#fff" stroke-width="2" stroke-linecap="round" opacity=".55"/>
                <circle cx="33" cy="33" r="8" fill="#f6d872"/>
                <path d="M29.5 33l2.5 2.5 4.5-5" fill="none" stroke="#1f1a17" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        @elseif ($theme === 'tani')
            {{-- Sprout over a rolling field under the sun. --}}
            <svg viewBox="0 0 48 48" class="size-10 shrink-0" aria-hidden="true">
                <circle cx="24" cy="24" r="24" style="fill: var(--brand)"/>
                <circle cx="33" cy="15" r="5" fill="#f2b632"/>
                <path d="M4 34c8-5 16-6 24-2s12 3 16 1v4a20 20 0 0 1-38 3z" fill="#f8f3e6" opacity=".9"/>
                <path d="M22 32c0-8 2-12 8-15-7 0-10 4-8 15zM22 32c-1-5-3-7-7-8 0 4 3 7 7 8z" fill="#f2b632"/>
            </svg>
        @elseif ($theme === 'instansi')
            {{-- Shield with a pillared hall, red-white band and a gold star. --}}
            <svg viewBox="0 0 48 48" class="size-10 shrink-0" aria-hidden="true">
                <path d="M24 3l17 6v13c0 11-7.5 19-17 23C14.5 41 7 33 7 22V9z" style="fill: var(--brand)"/>
                <path d="M15 31h18M17 29v-8M22 29v-8M26 29v-8M31 29v-8M14 21l10-6 10 6z" stroke="#fff" stroke-width="2" stroke-linejoin="round" fill="none"/>
                <path d="M24 6.5l1.1 2.3 2.5.3-1.8 1.7.5 2.5-2.3-1.2-2.3 1.2.5-2.5-1.8-1.7 2.5-.3z" fill="#f2b705"/>
                <path d="M14 35h20" stroke="#e11d2e" stroke-width="2.4"/><path d="M15.5 38h17" stroke="#fff" stroke-width="2.4"/>
            </svg>
        @elseif ($theme === 'pesantren')
            {{-- Mosque dome inside an eight-point star. --}}
            <svg viewBox="0 0 48 48" class="size-10 shrink-0" aria-hidden="true">
                <rect width="48" height="48" rx="12" style="fill: var(--brand)"/>
                <path d="M24 6l5 7h8v8l5 3-5 3v8h-8l-5 7-5-7h-8v-8l-5-3 5-3v-8h8z" fill="none" stroke="#d4af37" stroke-width="1.6" stroke-linejoin="round"/>
                <path d="M17 32v-5c0-4 3-7 7-8.5 4 1.5 7 4.5 7 8.5v5zM24 18.5V15" fill="none" style="stroke: var(--on-brand)" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        @elseif ($theme === 'cleaning')
            {{-- Sparkles. --}}
            <svg viewBox="0 0 48 48" class="size-10 shrink-0" aria-hidden="true">
                <rect width="48" height="48" rx="16" style="fill: var(--brand)"/>
                <path d="M21 11l2.6 7.4L31 21l-7.4 2.6L21 31l-2.6-7.4L11 21l7.4-2.6z" style="fill: var(--on-brand)"/>
                <path d="M33 27l1.4 3.6L38 32l-3.6 1.4L33 37l-1.4-3.6L28 32l3.6-1.4z" fill="#fde68a"/>
            </svg>
        @elseif ($theme === 'satpam')
            {{-- Shield with a star. --}}
            <svg viewBox="0 0 48 48" class="size-10 shrink-0" aria-hidden="true">
                <rect width="48" height="48" rx="8" style="fill: var(--brand)"/>
                <path d="M24 9l12 4.5v9c0 8-5.2 13.4-12 16.5-6.8-3.1-12-8.5-12-16.5v-9z" fill="none" stroke="#facc15" stroke-width="2.4" stroke-linejoin="round"/>
                <path d="M24 17l2 4.3 4.6.5-3.4 3.1 1 4.6-4.2-2.4-4.2 2.4 1-4.6-3.4-3.1 4.6-.5z" fill="#facc15"/>
            </svg>
        @elseif ($theme === 'biolink' || $theme === 'biolink2' || $theme === 'biolink3')
            {{-- Chain link. --}}
            <svg viewBox="0 0 48 48" class="size-9 shrink-0" aria-hidden="true">
                <rect width="48" height="48" rx="14" style="fill: var(--brand)"/>
                <path d="M21 27l6-6M19 23l-3 3a4.2 4.2 0 0 0 6 6l3-3M29 25l3-3a4.2 4.2 0 0 0-6-6l-3 3" fill="none" style="stroke: var(--on-brand)" stroke-width="3" stroke-linecap="round"/>
            </svg>
        @elseif ($theme === 'laundry')
            <svg viewBox="0 0 48 48" class="size-10 shrink-0" aria-hidden="true">
                <rect width="48" height="48" rx="14" style="fill: var(--brand)"/>
                <path d="M14 12h20v24a2 2 0 0 1-2 2H16a2 2 0 0 1-2-2z" fill="none" style="stroke: var(--on-brand)" stroke-width="2.4"/><circle cx="24" cy="26" r="6" fill="none" style="stroke: var(--on-brand)" stroke-width="2.4"/><circle cx="18.5" cy="16" r="1.4" style="fill: var(--on-brand)"/>
            </svg>
        @elseif ($theme === 'sepatu')
            {{-- Sneaker. --}}
            <svg viewBox="0 0 48 48" class="size-10 shrink-0" aria-hidden="true">
                <rect width="48" height="48" rx="14" style="fill: var(--brand)"/>
                <path d="M9 30c0-5 1.6-9 6.4-10.6l7.8-2.6c2.4-.8 4.2 0 5.3 1.6l2.6 3.6c1.1 1.6 3 2.4 5.3 2.6L39 25c2 .4 3 1.6 3 3.6v1.4z" fill="none" style="stroke: var(--on-brand)" stroke-width="2.4" stroke-linejoin="round"/>
                <path d="M8.5 30h33.5v2.6a2 2 0 0 1-2 2H11a2.5 2.5 0 0 1-2.5-2.5z" style="fill: var(--on-brand)"/>
            </svg>
        @elseif ($theme === 'lawfirm')
            {{-- Scales of justice. --}}
            <svg viewBox="0 0 48 48" class="size-10 shrink-0" aria-hidden="true">
                <rect width="48" height="48" rx="10" style="fill: var(--brand)"/>
                <path d="M24 11v26M16 37h16M13 15h22M13 15l-5 10h10zM35 15l-5 10h10z" fill="none" stroke="#d4af37" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
                <circle cx="24" cy="11" r="2" fill="#d4af37"/>
            </svg>
        @elseif ($theme === 'catering')
            <svg viewBox="0 0 48 48" class="size-10 shrink-0" aria-hidden="true">
                <rect width="48" height="48" rx="14" style="fill: var(--brand)"/>
                <path d="M11 30h26M13 30a11 11 0 0 1 22 0" fill="none" style="stroke: var(--on-brand)" stroke-width="2.6" stroke-linecap="round"/><circle cx="24" cy="16" r="2" style="fill: var(--on-brand)"/><path d="M10 34h28" style="stroke: var(--on-brand)" stroke-width="2.6" stroke-linecap="round"/>
            </svg>
        @elseif ($theme === 'bengkel')
            <svg viewBox="0 0 48 48" class="size-10 shrink-0" aria-hidden="true">
                <rect width="48" height="48" rx="14" style="fill: var(--brand)"/>
                <path d="M30 12a7 7 0 0 0-8 9L12 31a3 3 0 0 0 4 4l10-10a7 7 0 0 0 9-8l-4 4-4-1-1-4z" style="fill: var(--on-brand)"/>
            </svg>
        @elseif ($theme === 'foto')
            <svg viewBox="0 0 48 48" class="size-10 shrink-0" aria-hidden="true">
                <rect width="48" height="48" rx="14" style="fill: var(--brand)"/>
                <rect x="10" y="16" width="28" height="19" rx="4" fill="none" style="stroke: var(--on-brand)" stroke-width="2.4"/><circle cx="24" cy="25.5" r="5" fill="none" style="stroke: var(--on-brand)" stroke-width="2.4"/><path d="M18 16l2-4h8l2 4" fill="none" style="stroke: var(--on-brand)" stroke-width="2.4" stroke-linejoin="round"/>
            </svg>
        @elseif ($theme === 'wedding')
            <svg viewBox="0 0 48 48" class="size-10 shrink-0" aria-hidden="true">
                <rect width="48" height="48" rx="14" style="fill: var(--brand)"/>
                <circle cx="20" cy="27" r="7" fill="none" style="stroke: var(--on-brand)" stroke-width="2.4"/><circle cx="28" cy="27" r="7" fill="none" style="stroke: var(--on-brand)" stroke-width="2.4"/><path d="M21 14l3-3 3 3-3 3z" style="fill: var(--on-brand)"/>
            </svg>
        @elseif ($theme === 'bimbel')
            <svg viewBox="0 0 48 48" class="size-10 shrink-0" aria-hidden="true">
                <rect width="48" height="48" rx="14" style="fill: var(--brand)"/>
                <path d="M8 20l16-8 16 8-16 8z" style="fill: var(--on-brand)"/><path d="M15 24v7c0 2 4 4 9 4s9-2 9-4v-7" fill="none" style="stroke: var(--on-brand)" stroke-width="2.4"/>
            </svg>
        @elseif ($theme === 'apotek')
            <svg viewBox="0 0 48 48" class="size-10 shrink-0" aria-hidden="true">
                <rect width="48" height="48" rx="14" style="fill: var(--brand)"/>
                <rect x="20" y="11" width="8" height="26" rx="2" style="fill: var(--on-brand)"/><rect x="11" y="20" width="26" height="8" rx="2" style="fill: var(--on-brand)"/>
            </svg>
        @elseif ($theme === 'petshop')
            <svg viewBox="0 0 48 48" class="size-10 shrink-0" aria-hidden="true">
                <rect width="48" height="48" rx="14" style="fill: var(--brand)"/>
                <ellipse cx="24" cy="30" rx="7" ry="6" style="fill: var(--on-brand)"/><circle cx="15" cy="22" r="3" style="fill: var(--on-brand)"/><circle cx="20" cy="15" r="3" style="fill: var(--on-brand)"/><circle cx="28" cy="15" r="3" style="fill: var(--on-brand)"/><circle cx="33" cy="22" r="3" style="fill: var(--on-brand)"/>
            </svg>
        @elseif ($theme === 'tambang')
            {{-- Mountain with a pickaxe peak. --}}
            <svg viewBox="0 0 48 48" class="size-10 shrink-0" aria-hidden="true">
                <rect width="48" height="48" rx="8" style="fill: var(--brand)"/>
                <path d="M8 36l11-16 6 8 4-5 11 13z" style="fill: var(--on-brand)"/>
                <path d="M19 20l3 4.5-3 2.5-3-2.5z" style="fill: #facc15"/>
                <path d="M30 11l7 7M34 9l-8 8" style="stroke: #facc15" stroke-width="2.4" stroke-linecap="round"/>
            </svg>
        @elseif ($theme === 'kopi')
            {{-- Coffee bean in a leaf-green circle. --}}
            <svg viewBox="0 0 48 48" class="size-10 shrink-0" aria-hidden="true">
                <circle cx="24" cy="24" r="24" style="fill: var(--brand)"/>
                <ellipse cx="24" cy="24" rx="9" ry="12.5" transform="rotate(30 24 24)" fill="none" style="stroke: var(--on-brand)" stroke-width="2.4"/>
                <path d="M20 14c6 5 2 15 8 20" fill="none" style="stroke: var(--on-brand)" stroke-width="2.4" stroke-linecap="round"/>
            </svg>
        @elseif ($theme === 'barber')
            {{-- Barber pole. --}}
            <svg viewBox="0 0 48 48" class="size-10 shrink-0" aria-hidden="true">
                <rect width="48" height="48" rx="10" fill="#111"/>
                <defs><clipPath id="pole"><rect x="18" y="12" width="12" height="24" rx="3"/></clipPath></defs>
                <rect x="18" y="12" width="12" height="24" rx="3" fill="#fff"/>
                <g clip-path="url(#pole)" style="stroke: var(--brand)" stroke-width="3.2"><path d="M14 18l20-8M14 26l20-8M14 34l20-8M14 42l20-8"/></g>
                <rect x="16" y="8" width="16" height="4" rx="2" fill="#d4d4d4"/><rect x="16" y="36" width="16" height="4" rx="2" fill="#d4d4d4"/>
            </svg>
        @elseif ($theme === 'legal')
            {{-- Shield with a check mark. --}}
            <svg viewBox="0 0 48 48" class="size-10 shrink-0" aria-hidden="true">
                <rect width="48" height="48" rx="14" style="fill: var(--brand)"/>
                <path d="M24 10l11 4v9c0 7-4.7 12.3-11 15-6.3-2.7-11-8-11-15v-9z" fill="none" style="stroke: var(--on-brand)" stroke-width="2.4" stroke-linejoin="round"/>
                <path d="M18.5 24l4 4 7.5-8" fill="none" style="stroke: #fb923c" stroke-width="2.8" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        @elseif ($theme === 'ac')
            {{-- Snowflake. --}}
            <svg viewBox="0 0 48 48" class="size-10 shrink-0" aria-hidden="true">
                <rect width="48" height="48" rx="14" style="fill: var(--brand)"/>
                <g style="stroke: var(--on-brand)" stroke-width="2.6" stroke-linecap="round" fill="none">
                    <path d="M24 11v26M12.7 17.5l22.6 13M12.7 30.5l22.6-13"/>
                    <path d="M20 13l4 3 4-3M20 35l4-3 4 3M13 22.5l4.5-1.5-1-4.6M35 25.5l-4.5 1.5 1 4.6M13 25.5l4.5 1.5-1 4.6M35 22.5l-4.5-1.5 1-4.6"/>
                </g>
            </svg>
        @elseif ($theme === 'umroh')
            {{-- Crescent and Kaaba, in navy and gold. --}}
            <svg viewBox="0 0 48 48" class="size-10 shrink-0" aria-hidden="true">
                <rect width="48" height="48" rx="14" style="fill: var(--brand)"/>
                <path d="M16 20l8-4 8 4v12l-8 4-8-4z" fill="none" style="stroke: #d4b37a" stroke-width="2.2" stroke-linejoin="round"/>
                <path d="M16 24l8 4 8-4" fill="none" style="stroke: #d4b37a" stroke-width="2.2"/>
                <path d="M35 9.5a5 5 0 1 0 3.5 8.6A4 4 0 1 1 35 9.5z" style="fill: #d4b37a"/>
            </svg>
        @else
            <svg viewBox="0 0 48 48" class="size-10 shrink-0" aria-hidden="true">
                <rect width="48" height="48" rx="12" style="fill: var(--brand)"/>
                <path d="M13 34V14l11 9 11-9v20" fill="none" style="stroke: var(--on-brand)" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                <circle cx="24" cy="34" r="2.6" style="fill: var(--on-brand)"/>
            </svg>
        @endif
        @if ($showName)<span class="text-lg leading-tight font-bold" style="font-family: var(--font-head)">{{ $site->get('site_name') }}</span>@else<span class="sr-only">{{ $site->get('site_name') }}</span>@endif
    @elseif (\App\Sections\DefaultContent::isSampleLogo($logo))
        {{-- A template's sample emblem, next to the name until the owner uploads their logo. --}}
        <img src="{{ $site->image($logo) }}" alt="{{ $showName ? '' : $site->get('site_name') }}" class="h-12 w-auto shrink-0 object-contain">
        <span @class(['flex min-w-0 flex-col', 'sr-only' => ! $showName])>
            <span class="text-lg leading-tight font-bold" style="font-family: var(--font-head)">{{ $site->get('site_name') }}</span>
            @if (($tagline ?? false) && $site->get('tagline'))<span class="muted truncate text-xs">{{ $site->get('tagline') }}</span>@endif
        </span>
    @elseif ($logo)
        <img src="{{ $site->image($logo) }}" alt="{{ $site->get('site_name') }}" class="h-10 w-auto max-w-[180px] object-contain">
        @if ($showName)<span class="text-lg leading-tight font-bold" style="font-family: var(--font-head)">{{ $site->get('site_name') }}</span>@endif
    @else
        <span class="text-lg font-bold" style="font-family: var(--font-head)">{{ $site->get('site_name') }}</span>
    @endif
</a>
