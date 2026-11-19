{{-- A round portrait beside the text, used for the head of village's welcome. --}}
<section id="{{ $sectionId }}" class="sec">
    <div class="site-container grid items-center gap-10 md:grid-cols-[2fr_3fr] md:gap-16">
        <div @class(['md:order-last' => $d['image_position'] === 'right'])>
            @if ($site->image($d['image']))
                <img src="{{ $site->image($d['image']) }}" alt="{{ $d['title'] }}" class="desa2-round mx-auto aspect-square w-full max-w-sm object-cover" loading="lazy">
            @endif
        </div>
        <div>
            @if ($d['title'])<h2 class="sec-title desa2-big mb-5">{{ $d['title'] }}</h2>@endif
            <div class="prose-site">{!! \Illuminate\Support\Str::markdown($d['body'], ['html_input' => 'strip', 'allow_unsafe_links' => false]) !!}</div>
            @if ($d['button_label'] && $d['button_url'])<a href="{{ $d['button_url'] }}" class="btn mt-8">{{ $d['button_label'] }}</a>@endif
        </div>
    </div>
</section>
