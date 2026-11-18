<footer class="mx-auto max-w-2xl px-4 pb-10 text-center text-xs sm:px-0">
    <div class="muted flex flex-wrap justify-center gap-4">@include('site.partials.socials', ['class' => 'hover:underline'])</div>
    <p class="muted mt-3">&copy; {{ date('Y') }} {{ $site->get('site_name') }}. Semua hak dilindungi.</p>
</footer>
