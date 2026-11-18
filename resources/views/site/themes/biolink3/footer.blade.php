<footer class="mx-auto max-w-md px-4 pb-10 text-center text-xs">
    <div class="flex flex-wrap justify-center gap-4 font-semibold">@include('site.partials.socials', ['class' => 'bl3-social'])</div>
    <p class="mt-4 opacity-60">&copy; {{ date('Y') }} {{ $site->get('site_name') }}</p>
</footer>
