@extends('site.layout')

@php
    $shareUrl = $post->url();
    $logo = $site->get('logo') && ! \App\Sections\DefaultContent::isSampleLogo($site->get('logo')) ? $site->url('logo') : null;
    $organization = array_filter(['@type' => 'Organization', 'name' => (string) $site->get('site_name'), 'url' => url('/')]);
    $schema = array_filter([
        '@context' => 'https://schema.org',
        '@type' => 'BlogPosting',
        'mainEntityOfPage' => ['@type' => 'WebPage', '@id' => $post->url()],
        'headline' => \Illuminate\Support\Str::limit($post->title, 110, ''),
        'description' => $post->meta_description ?: $post->summary(160),
        'image' => $post->coverUrl() ? [$post->coverUrl()] : null,
        'datePublished' => ($post->published_at ?? $post->created_at)?->toAtomString(),
        'dateModified' => ($post->updated_at ?? $post->published_at)?->toAtomString(),
        'articleSection' => $post->category,
        'wordCount' => \App\Support\RichText::words($post->body),
        'inLanguage' => 'id-ID',
        'author' => $organization,
        'publisher' => $organization + ($logo ? ['logo' => ['@type' => 'ImageObject', 'url' => $logo]] : []),
    ]);
@endphp

@push('head')
    @if ($post->coverUrl())
        <meta property="og:image" content="{{ $post->coverUrl() }}">
        <meta name="twitter:card" content="summary_large_image">
    @endif
    <meta property="article:published_time" content="{{ $post->published_at?->toAtomString() }}">
    <meta property="article:modified_time" content="{{ $post->updated_at?->toAtomString() }}">
    @if ($post->category)
        <meta property="article:section" content="{{ $post->category }}">
    @endif
    @unless ($post->isLive())
        <meta name="robots" content="noindex">
    @endunless
    <script type="application/ld+json">{!! json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP) !!}</script>
@endpush

@section('content')
    @unless ($post->isLive())
        <div class="blog-preview-bar" role="status">
            <div class="site-container">
                Pratinjau: tulisan ini {{ $post->state() === 'scheduled' ? 'dijadwalkan terbit '.$post->dateLabel('j F Y, H.i') : 'masih draf' }} dan belum bisa dilihat pengunjung.
                <a href="{{ route('posts.edit', $post) }}">Edit tulisan</a>
            </div>
        </div>
    @endunless

    <article class="blog-post">
        <header class="blog-post-head site-container">
            <nav class="blog-crumbs" aria-label="Breadcrumb">
                <a href="{{ url('/') }}">Beranda</a><span aria-hidden="true">/</span><a href="{{ route('blog.index') }}">{{ $blogTitle }}</a>
                @if ($post->category)<span aria-hidden="true">/</span><a href="{{ route('blog.index', ['kategori' => $post->category]) }}">{{ $post->category }}</a>@endif
            </nav>
            <h1 class="blog-post-title">{{ $post->title }}</h1>
            @if ($post->excerpt)<p class="blog-post-lead">{{ $post->excerpt }}</p>@endif
            <div class="blog-meta">
                @if ($post->category)<a href="{{ route('blog.index', ['kategori' => $post->category]) }}" class="blog-badge">{{ $post->category }}</a>@endif
                <time datetime="{{ $post->published_at?->toAtomString() }}">{{ $post->dateLabel() }}</time>
                <span aria-hidden="true">&middot;</span>
                <span>{{ $post->readingMinutes() }} menit baca</span>
            </div>
        </header>

        @if ($post->coverUrl())
            <figure class="blog-post-cover site-container">
                {!! \App\Support\SiteImages::section('<img src="'.e($post->coverUrl()).'" alt="'.e(\App\Support\SiteImages::alt((string) $post->cover) ?: $post->title).'" width="1600" height="900">', 0) !!}
            </figure>
        @endif

        <div class="site-container">
            <div class="site-article">
                {!! \App\Support\SiteImages::section(str_replace(['<table>', '</table>'], ['<div class="table-wrap"><table>', '</table></div>'], $post->body), 1) !!}
            </div>

            <div class="blog-share" data-share>
                <span class="blog-share-label">Bagikan</span>
                <a href="https://wa.me/?text={{ rawurlencode($post->title.' '.$shareUrl) }}" target="_blank" rel="noopener" aria-label="Bagikan ke WhatsApp">
                    <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2a10 10 0 0 0-8.6 15.1L2 22l5-1.3A10 10 0 1 0 12 2Zm0 18.2c-1.5 0-3-.4-4.3-1.2l-.3-.2-3 .8.8-2.9-.2-.3A8.2 8.2 0 1 1 12 20.2Zm4.5-6.1c-.2-.1-1.5-.7-1.7-.8-.2-.1-.4-.1-.6.1l-.8 1c-.1.2-.3.2-.5.1a6.7 6.7 0 0 1-3.3-2.9c-.2-.4.2-.4.7-1.3.1-.2 0-.3 0-.4l-.8-1.8c-.2-.5-.4-.4-.6-.4h-.5c-.2 0-.4.1-.7.3-.2.3-.9.9-.9 2.2s.9 2.5 1 2.7c.1.2 1.8 2.8 4.4 3.9 1.6.7 2.3.8 3.1.6.5-.1 1.5-.6 1.7-1.2.2-.6.2-1.1.2-1.2-.1-.1-.3-.2-.5-.3Z"/></svg>
                    <span>WhatsApp</span>
                </a>
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ rawurlencode($shareUrl) }}" target="_blank" rel="noopener" aria-label="Bagikan ke Facebook">
                    <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M13.5 22v-8h2.7l.4-3.2h-3.1V8.8c0-.9.3-1.5 1.6-1.5h1.7V4.4c-.3 0-1.3-.1-2.5-.1-2.4 0-4.1 1.5-4.1 4.2v2.3H7.5V14h2.7v8h3.3Z"/></svg>
                    <span>Facebook</span>
                </a>
                <a href="https://x.com/intent/post?text={{ rawurlencode($post->title) }}&amp;url={{ rawurlencode($shareUrl) }}" target="_blank" rel="noopener" aria-label="Bagikan ke X">
                    <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M17.8 3h3.1l-6.8 7.7L22 21h-6.2l-4.9-6.4L5.3 21H2.2l7.2-8.3L1.8 3h6.4l4.4 5.8L17.8 3Zm-1.1 16.2h1.7L7.4 4.7H5.6l11.1 14.5Z"/></svg>
                    <span>X</span>
                </a>
                <button type="button" data-copy="{{ $shareUrl }}" aria-label="Salin link">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M10 13a5 5 0 0 0 7.5.5l3-3a5 5 0 0 0-7-7l-1.7 1.7"/><path d="M14 11a5 5 0 0 0-7.5-.5l-3 3a5 5 0 0 0 7 7l1.7-1.7"/></svg>
                    <span data-copy-label>Salin link</span>
                </button>
            </div>

            @if ($newer || $older)
                <nav class="blog-adjacent" aria-label="Tulisan lain">
                    @if ($older)
                        <a href="{{ $older->url() }}" rel="prev"><span class="muted">&larr; Sebelumnya</span><strong>{{ $older->title }}</strong></a>
                    @else
                        <span></span>
                    @endif
                    @if ($newer)
                        <a href="{{ $newer->url() }}" rel="next" class="is-next"><span class="muted">Berikutnya &rarr;</span><strong>{{ $newer->title }}</strong></a>
                    @endif
                </nav>
            @endif
        </div>
    </article>

    @if ($related->isNotEmpty())
        <section class="sec sec-alt blog-related">
            <div class="site-container">
                <div class="blog-related-head">
                    <h2 class="sec-title">Baca juga</h2>
                    <a href="{{ route('blog.index') }}" class="blog-more">Semua tulisan &rarr;</a>
                </div>
                <div class="blog-grid">
                    @foreach ($related as $item)
                        @include('site.blog.card', ['post' => $item, 'headingTag' => 'h3'])
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <script>
        document.querySelectorAll('[data-copy]').forEach((button) => button.addEventListener('click', async () => {
            const label = button.querySelector('[data-copy-label]');
            try {
                await navigator.clipboard.writeText(button.dataset.copy);
                label.textContent = 'Tersalin!';
            } catch {
                window.prompt('Salin link ini:', button.dataset.copy);
            }
            setTimeout(() => (label.textContent = 'Salin link'), 2000);
        }));
    </script>
@endsection
