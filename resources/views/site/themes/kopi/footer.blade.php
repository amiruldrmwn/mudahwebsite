<footer class="text-white/75" style="background: color-mix(in oklab, var(--brand) 70%, #06140d)">
    <div class="site-container grid gap-10 py-14 sm:grid-cols-2 lg:grid-cols-4">
        <div class="lg:col-span-2">
            <span class="text-white">@include('site.partials.logo')</span>
            @if ($site->get('footer_text'))<p class="mt-4 max-w-md text-sm leading-relaxed">{{ $site->get('footer_text') }}</p>@endif
            <div class="mt-5 flex flex-wrap gap-3 text-sm">@include('site.partials.socials', ['class' => 'rounded-full border border-white/25 px-4 py-1.5 hover:bg-white/10'])</div>
        </div>
        <div>
            <div class="mb-3 font-bold text-white">Jelajahi</div>
            <nav class="flex flex-col gap-2 text-sm">
                @foreach ($menu as $item)<a href="{{ $item->url() }}" class="hover:text-white">{{ $item->title }}</a>@endforeach
            </nav>
        </div>
        <div>
            <div class="mb-3 font-bold text-white">Kontak</div>
            <div class="text-sm">@include('site.partials.contact-list', ['class' => 'space-y-2'])</div>
        </div>
    </div>
    <div class="border-t" style="border-color: rgb(255 255 255 / .12)">
        <div class="site-container py-5 text-center text-xs">&copy; {{ date('Y') }} {{ $site->get('site_name') }}. Dibuat dari biji kopi pilihan.</div>
    </div>
</footer>
