<footer class="text-white/65" style="background: #1c1d21">
    <div class="mine-hazard h-1.5"></div>
    <div class="site-container grid gap-10 py-14 sm:grid-cols-2 lg:grid-cols-4">
        <div class="lg:col-span-2">
            <span class="text-white">@include('site.partials.logo')</span>
            @if ($site->get('footer_text'))<p class="mt-4 max-w-md text-sm leading-relaxed">{{ $site->get('footer_text') }}</p>@endif
            @if ($site->get('address'))<p class="mt-3 max-w-md text-sm leading-relaxed">{!! nl2br(e($site->get('address'))) !!}</p>@endif
        </div>
        <div>
            <div class="mb-3 text-sm font-bold tracking-wider text-white uppercase">Perusahaan</div>
            <nav class="flex flex-col gap-2 text-sm">
                @foreach ($menu as $item)<a href="{{ $item->url() }}" class="hover:text-white">{{ $item->title }}</a>@endforeach
            </nav>
        </div>
        <div>
            <div class="mb-3 text-sm font-bold tracking-wider text-white uppercase">Kontak</div>
            <div class="text-sm">@include('site.partials.contact-list', ['class' => 'space-y-2'])</div>
            <div class="mt-4 flex flex-wrap gap-4 text-sm">@include('site.partials.socials', ['class' => 'hover:text-white'])</div>
        </div>
    </div>
    <div class="border-t" style="border-color: rgb(255 255 255 / .1)">
        <div class="site-container flex flex-wrap justify-between gap-2 py-5 text-xs"><span>&copy; {{ date('Y') }} {{ $site->get('site_name') }}. Hak cipta dilindungi.</span><span>Keselamatan · Keberlanjutan · Integritas</span></div>
    </div>
</footer>
