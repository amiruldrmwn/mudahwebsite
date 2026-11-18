@php
    /** @var \App\Support\Site $site */
    $title = $page?->meta_title ?: ($page && ! $page->is_home ? $page->title.' | '.$site->get('site_name') : $site->get('site_name').($site->get('tagline') ? ' | '.$site->get('tagline') : ''));
    $description = $page?->meta_description ?: $site->get('description');
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    @if ($description)
        <meta name="description" content="{{ $description }}">
    @endif
    <link rel="canonical" href="{{ url()->current() }}">
    @if ($site->googleVerification())
        <meta name="google-site-verification" content="{{ $site->googleVerification() }}">
    @endif
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $title }}">
    @if ($description)
        <meta property="og:description" content="{{ $description }}">
    @endif
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="{{ $site->get('site_name') }}">
    @if ($site->url('logo') && ! isset($sampleLogo))
        <meta property="og:image" content="{{ $site->url('logo') }}">
    @endif
    {{-- The site's favicon, else its own uploaded logo, else the MudahCloud mark (always in template demos). --}}
    @if (isset($sampleLogo))
        <link rel="icon" href="/favicon.ico" sizes="any">
    @elseif ($site->url('favicon'))
        <link rel="icon" href="{{ $site->url('favicon') }}">
    @elseif ($site->get('logo') && ! \App\Sections\DefaultContent::isSampleLogo($site->get('logo')))
        <link rel="icon" href="{{ $site->url('logo') }}">
    @else
        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    @endif
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="stylesheet" href="{{ \App\Support\Themes::fontsUrl($theme) }}">
    @vite('resources/css/site.css')
    <style>
        body.site { --brand: {{ $brand ?? $site->get('primary_color') }}; --on-brand: {{ $site->onBrand($brand ?? null) }}; }
    </style>
</head>
<body class="site theme-{{ $theme }}">
    @include("site.themes.{$theme}.header")

    <main>
        @yield('content')
    </main>

    @include("site.themes.{$theme}.footer")

    @if ($site->whatsappUrl())
        <a href="{{ $site->whatsappUrl() }}" target="_blank" rel="noopener" aria-label="Chat WhatsApp"
           class="fixed right-5 bottom-5 z-40 flex size-14 items-center justify-center rounded-full bg-[#25d366] text-white shadow-lg transition hover:scale-105">
            <svg viewBox="0 0 24 24" class="size-7" fill="currentColor" aria-hidden="true"><path d="M12 2a10 10 0 0 0-8.6 15.1L2 22l5-1.3A10 10 0 1 0 12 2Zm0 18.2c-1.5 0-3-.4-4.3-1.2l-.3-.2-3 .8.8-2.9-.2-.3A8.2 8.2 0 1 1 12 20.2Zm4.5-6.1c-.2-.1-1.5-.7-1.7-.8-.2-.1-.4-.1-.6.1l-.8 1c-.1.2-.3.2-.5.1a6.7 6.7 0 0 1-3.3-2.9c-.2-.4.2-.4.7-1.3.1-.2 0-.3 0-.4l-.8-1.8c-.2-.5-.4-.4-.6-.4h-.5c-.2 0-.4.1-.7.3-.2.3-.9.9-.9 2.2s.9 2.5 1 2.7c.1.2 1.8 2.8 4.4 3.9 1.6.7 2.3.8 3.1.6.5-.1 1.5-.6 1.7-1.2.2-.6.2-1.1.2-1.2-.1-.1-.3-.2-.5-.3Z"/></svg>
        </a>
    @endif
    <script>
        // Counts WhatsApp button clicks for the dashboard (no personal data is sent).
        document.addEventListener('click', (e) => {
            if (e.target.closest('a[href^="https://wa.me/"]') && navigator.sendBeacon) navigator.sendBeacon(@json(route('stats.whatsapp')));
        });
    </script>
</body>
</html>
