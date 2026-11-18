@php
    // Template previews show the template's own sample logo while the site still has a sample one.
    $logo = isset($sampleLogo) && \App\Sections\DefaultContent::isSampleLogo($site->get('logo')) ? $sampleLogo : $site->get('logo');
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
        <span class="text-lg leading-tight font-bold" style="font-family: var(--font-head)">{{ $site->get('site_name') }}</span>
    @elseif (\App\Sections\DefaultContent::isSampleLogo($logo))
        {{-- A template's sample emblem, next to the name until the owner uploads their logo. --}}
        <img src="{{ $site->image($logo) }}" alt="" class="h-12 w-auto shrink-0 object-contain">
        <span class="flex min-w-0 flex-col">
            <span class="text-lg leading-tight font-bold" style="font-family: var(--font-head)">{{ $site->get('site_name') }}</span>
            @if (($tagline ?? false) && $site->get('tagline'))<span class="muted truncate text-xs">{{ $site->get('tagline') }}</span>@endif
        </span>
    @elseif ($logo)
        <img src="{{ $site->image($logo) }}" alt="{{ $site->get('site_name') }}" class="h-10 w-auto max-w-[180px] object-contain">
    @else
        <span class="text-lg font-bold" style="font-family: var(--font-head)">{{ $site->get('site_name') }}</span>
    @endif
</a>
