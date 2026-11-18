<footer class="border-t" style="border-color: var(--line)">
    <div class="site-container grid gap-10 py-14 sm:grid-cols-2 lg:grid-cols-4">
        <div>
            <div class="font-semibold">{{ $site->get('site_name') }}</div>
            @if ($site->get('address'))<p class="muted mt-3 text-sm leading-relaxed">{!! nl2br(e($site->get('address'))) !!}</p>@endif
            @if ($site->get('footer_text'))<p class="muted mt-3 text-sm leading-relaxed">{{ $site->get('footer_text') }}</p>@endif
        </div>
        <div>
            <div class="sma-label mb-3">Kontak</div>
            <div class="text-sm">@include('site.partials.contact-list', ['class' => 'space-y-2'])</div>
        </div>
        <div>
            <div class="sma-label mb-3">Halaman</div>
            <nav class="flex flex-col gap-2 text-sm">
                @foreach ($menu as $item)<a href="{{ $item->url() }}" class="hover:underline">{{ $item->title }}</a>@endforeach
            </nav>
        </div>
        <div>
            <div class="sma-label mb-3">Media Sosial</div>
            <div class="flex flex-col gap-2 text-sm">@include('site.partials.socials', ['class' => 'hover:underline'])</div>
        </div>
    </div>
    <div class="site-container muted border-t py-6 text-xs" style="border-color: var(--line)">&copy; {{ date('Y') }} {{ $site->get('site_name') }}</div>
</footer>
