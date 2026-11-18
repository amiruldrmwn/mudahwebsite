<footer class="text-white/70" style="background: #0e1433">
    <div class="site-container grid gap-10 py-14 sm:grid-cols-2 lg:grid-cols-4">
        <div class="lg:col-span-2">
            <span class="text-white">@include('site.partials.logo')</span>
            @if ($site->get('footer_text'))<p class="mt-4 max-w-md text-sm leading-relaxed">{{ $site->get('footer_text') }}</p>@endif
            @if ($site->get('address'))<p class="mt-3 max-w-md text-sm leading-relaxed">{!! nl2br(e($site->get('address'))) !!}</p>@endif
        </div>
        <div>
            <div class="mb-3 font-semibold text-white">Halaman</div>
            <nav class="flex flex-col gap-2 text-sm">
                @foreach ($menu as $item)<a href="{{ $item->url() }}" class="hover:text-white">{{ $item->title }}</a>@endforeach
            </nav>
        </div>
        <div>
            <div class="mb-3 font-semibold text-white">Hubungi Kami</div>
            <div class="text-sm">@include('site.partials.contact-list', ['class' => 'space-y-2'])</div>
            <div class="mt-4 flex flex-wrap gap-4 text-sm">@include('site.partials.socials', ['class' => 'hover:text-white'])</div>
        </div>
    </div>
    <div class="border-t" style="border-color: rgb(255 255 255 / .1)">
        <div class="site-container py-5 text-center text-xs">&copy; {{ date('Y') }} {{ $site->get('site_name') }}. Semua hak dilindungi.</div>
    </div>
</footer>
