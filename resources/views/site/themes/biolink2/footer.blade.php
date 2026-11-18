<footer class="mx-auto max-w-md px-4 pb-10 text-center text-xs">
    <div class="flex flex-wrap justify-center gap-4 font-bold">@include('site.partials.socials', ['class' => 'underline underline-offset-4'])</div>
    <p class="mt-3 opacity-70">&copy; {{ date('Y') }} {{ $site->get('site_name') }}</p>
</footer>
