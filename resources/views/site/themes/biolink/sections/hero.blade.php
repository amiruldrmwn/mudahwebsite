{{-- Profile: photo, name, role, short bio, buttons and social links. --}}
<section id="{{ $sectionId }}" class="px-6 pt-10 pb-6 text-center sm:px-10">
    @if ($site->image($d['image']))
        <img src="{{ $site->image($d['image']) }}" alt="{{ $d['title'] }}" class="mx-auto size-28 rounded-full object-cover ring-4 ring-white shadow-lg">
    @endif
    <h1 class="mt-5 text-3xl sm:text-4xl">{{ $d['title'] }}</h1>
    @if ($d['eyebrow'])<p class="mt-1 font-medium" style="color: var(--brand)">{{ $d['eyebrow'] }}</p>@endif
    @if ($d['subtitle'])<p class="muted mx-auto mt-3 max-w-md leading-relaxed">{{ $d['subtitle'] }}</p>@endif
    @include('site.partials.hero-buttons', ['class' => 'mt-6! justify-center', 'primary' => 'px-5! py-2.5! text-sm', 'secondary' => 'btn-outline px-5! py-2.5! text-sm'])
    @if ($site->socials() !== [])
        <div class="mt-5 flex flex-wrap justify-center gap-2 text-sm">@include('site.partials.socials', ['class' => 'bio-social rounded-full border px-3 py-1.5 font-medium'])</div>
    @endif
</section>
