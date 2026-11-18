<footer class="text-white/60" style="background: #060607">
    <div class="barber-pole h-1.5"></div>
    <div class="site-container py-14 text-center">
        <span class="inline-block text-white">@include('site.partials.logo')</span>
        @if ($site->get('tagline'))<div class="barber-display mt-6 text-4xl text-white sm:text-5xl">{{ $site->get('tagline') }}</div>@endif
        @if ($site->get('footer_text'))<p class="mx-auto mt-4 max-w-xl text-sm leading-relaxed">{{ $site->get('footer_text') }}</p>@endif
        <nav class="mt-8 flex flex-wrap justify-center gap-x-8 gap-y-2 text-sm tracking-[0.15em] uppercase">
            @foreach ($menu as $item)<a href="{{ $item->url() }}" class="hover:text-white">{{ $item->title }}</a>@endforeach
        </nav>
        <div class="mt-6 flex flex-wrap justify-center gap-5 text-sm">@include('site.partials.socials', ['class' => 'hover:text-white'])</div>
        <div class="mx-auto mt-6 max-w-md text-sm">@include('site.partials.contact-list', ['class' => 'space-y-1'])</div>
    </div>
    <div class="border-t py-5 text-center text-xs" style="border-color: rgb(255 255 255 / .08)">&copy; {{ date('Y') }} {{ $site->get('site_name') }}</div>
</footer>
