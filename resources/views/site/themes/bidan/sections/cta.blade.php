{{-- Emergency card: a beating line, the call-to-action and the midwife on duty's phone number. --}}
<section id="{{ $sectionId }}" class="sec">
    <div class="site-container">
        <div class="bidan-sos grid items-center gap-8 px-6 py-10 sm:px-12 sm:py-12 md:grid-cols-[auto_1fr_auto]">
            <span class="bidan-sos-icon" aria-hidden="true"><svg viewBox="0 0 24 24" class="size-8" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1.9.4 1.8.7 2.7a2 2 0 0 1-.5 2.1L8 9.8a16 16 0 0 0 6 6l1.3-1.3a2 2 0 0 1 2.1-.4c.9.3 1.8.6 2.7.7a2 2 0 0 1 1.7 2Z"/></svg></span>
            <div>
                <h2 class="text-2xl leading-snug sm:text-3xl">{{ $d['title'] }}</h2>
                @if ($d['text'])<p class="mt-2 max-w-2xl text-white/85">{{ $d['text'] }}</p>@endif
            </div>
            <div class="flex flex-col gap-3 sm:flex-row md:flex-col">
                @if ($site->get('contact_phone'))<a href="tel:{{ preg_replace('/[^0-9+]/', '', $site->get('contact_phone')) }}" class="btn btn-light whitespace-nowrap">Telepon {{ $site->get('contact_phone') }}</a>@endif
                @if ($d['button_label'] && $d['button_url'])<a href="{{ $d['button_url'] }}" class="btn bidan-sos-ghost whitespace-nowrap">{{ $d['button_label'] }}</a>@endif
            </div>
        </div>
    </div>
</section>
