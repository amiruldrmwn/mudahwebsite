<footer class="border-t" style="border-color: var(--line)">
    <div class="site-container grid gap-10 py-14 sm:grid-cols-2 lg:grid-cols-4">
        <div class="lg:col-span-2">
            @include('site.partials.logo')
            @if ($site->get('footer_text'))<p class="muted mt-4 max-w-md text-sm leading-relaxed">{{ $site->get('footer_text') }}</p>@endif
            @if ($site->get('address'))<p class="muted mt-3 max-w-md text-sm leading-relaxed">{!! nl2br(e($site->get('address'))) !!}</p>@endif
        </div>
        <div>
            <div class="mb-3 font-semibold">Menu</div>
            <nav class="muted flex flex-col gap-2 text-sm">
                @foreach ($menu as $item)<a href="{{ $item->url() }}" class="hover:text-[var(--brand)]">{{ $item->title }}</a>@endforeach
            </nav>
        </div>
        <div>
            <div class="mb-3 font-semibold">Kontak</div>
            <div class="muted text-sm">@include('site.partials.contact-list', ['class' => 'space-y-2'])</div>
        </div>
    </div>
    <div class="border-t" style="border-color: var(--line)">
        <div class="site-container muted flex flex-wrap items-center justify-between gap-4 py-5 text-sm">
            <span>&copy; {{ date('Y') }} {{ $site->get('site_name') }}. Hak cipta dilindungi.</span>
            <span class="flex flex-wrap gap-4">@include('site.partials.socials', ['class' => 'hover:text-[var(--brand)]'])</span>
        </div>
    </div>
</footer>
