{{-- A post in a list: cover, category, date, title and summary. $post, optional $headingTag. --}}
@php($tag = $headingTag ?? 'h2')
<article class="blog-card">
    <a href="{{ $post->url() }}" class="blog-card-media" tabindex="-1" aria-hidden="true">
        @if ($post->coverUrl())
            <img src="{{ $post->coverUrl() }}" alt="" loading="lazy" decoding="async">
        @else
            <span class="blog-card-blank"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><path d="M4 5h16v14H4z"/><path d="M8 9h8M8 13h8M8 17h5"/></svg></span>
        @endif
    </a>
    <div class="blog-card-body">
        <div class="blog-meta">
            @if ($post->category)<span class="blog-badge">{{ $post->category }}</span>@endif
            <time datetime="{{ $post->published_at?->toAtomString() }}">{{ $post->dateLabel() }}</time>
        </div>
        <{{ $tag }} class="blog-card-title"><a href="{{ $post->url() }}">{{ $post->title }}</a></{{ $tag }}>
        @if ($post->summary(140) !== '')<p class="blog-card-text">{{ $post->summary(140) }}</p>@endif
    </div>
</article>
