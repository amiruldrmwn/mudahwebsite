<section id="{{ $sectionId }}" class="border-b-[3px] border-black" style="background: var(--brand)">
    <div class="site-container py-14 sm:py-20">
        <h1 class="text-5xl font-bold tracking-tight sm:text-6xl" style="color: var(--on-brand)">{{ $d['title'] }}</h1>
        @if ($d['subtitle'])<p class="mt-4 max-w-2xl text-lg font-medium" style="color: var(--on-brand)">{{ $d['subtitle'] }}</p>@endif
    </div>
</section>
