@extends('site.layout')

@push('head')
    @if ($posts->currentPage() > 1 || $category !== '')
        <meta name="robots" content="noindex, follow">
    @endif
@endpush

@section('content')
    @includeFirst(["site.themes.{$theme}.sections.page_header", 'site.sections.page_header'], [
        'd' => ['title' => $category !== '' ? $category : $blogTitle, 'subtitle' => $category !== '' ? 'Tulisan dalam kategori '.$category.'.' : 'Kabar, kegiatan, dan tulisan terbaru dari '.$site->get('site_name').'.', 'image' => ''],
        'sectionId' => 'blog',
        'index' => 0,
    ])

    <section class="sec blog-list pt-10! sm:pt-14!">
        <div class="site-container">
            @if (count($categories) > 1)
                <nav class="blog-chips" aria-label="Kategori">
                    <a href="{{ route('blog.index') }}" @if ($category === '') aria-current="page" @endif>Semua</a>
                    @foreach ($categories as $name)
                        <a href="{{ route('blog.index', ['kategori' => $name]) }}" @if ($category === $name) aria-current="page" @endif>{{ $name }}</a>
                    @endforeach
                </nav>
            @endif

            @if ($posts->isEmpty())
                <div class="blog-empty">
                    <p class="text-lg font-semibold">Belum ada tulisan{{ $category !== '' ? ' di kategori ini' : '' }}.</p>
                    <p class="muted mt-1">Kunjungi lagi nanti untuk kabar terbaru.</p>
                    @if ($category !== '')<a href="{{ route('blog.index') }}" class="btn mt-5">Lihat semua tulisan</a>@endif
                </div>
            @else
                <div class="blog-grid">
                    @foreach ($posts as $post)
                        @include('site.blog.card', ['post' => $post])
                    @endforeach
                </div>

                @if ($posts->hasPages())
                    <nav class="blog-pager" aria-label="Halaman">
                        @if ($posts->onFirstPage())
                            <span aria-disabled="true">&larr; Sebelumnya</span>
                        @else
                            <a href="{{ $posts->previousPageUrl() }}" rel="prev">&larr; Sebelumnya</a>
                        @endif
                        <span class="muted text-sm">Halaman {{ $posts->currentPage() }} dari {{ $posts->lastPage() }}</span>
                        @if ($posts->hasMorePages())
                            <a href="{{ $posts->nextPageUrl() }}" rel="next">Berikutnya &rarr;</a>
                        @else
                            <span aria-disabled="true">Berikutnya &rarr;</span>
                        @endif
                    </nav>
                @endif
            @endif
        </div>
    </section>
@endsection
