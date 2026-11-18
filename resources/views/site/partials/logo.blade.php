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
