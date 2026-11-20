@php
    $latest = \App\Models\Post::query()->published()
        ->when($d['category'] !== '', fn ($q) => $q->where('category', $d['category']))
        ->latestFirst()->limit((int) $d['count'] ?: 3)->get();
@endphp
@if ($latest->isNotEmpty() || auth()->check())
    <section id="{{ $sectionId }}" class="sec">
        <div class="site-container">
            @if ($d['title'] || $d['subtitle'])
                <div class="sec-head">
                    @if ($d['title'])<h2 class="sec-title">{{ $d['title'] }}</h2>@endif
                    @if ($d['subtitle'])<p class="sec-sub">{{ $d['subtitle'] }}</p>@endif
                </div>
            @endif
            @if ($latest->isEmpty())
                {{-- Only the signed-in owner sees this; visitors see nothing until a post is published. --}}
                <div class="blog-empty">
                    <p class="font-semibold">Belum ada tulisan yang terbit{{ $d['category'] !== '' ? ' di kategori '.$d['category'] : '' }}.</p>
                    <p class="muted mt-1 text-sm">Bagian ini tampil untuk pengunjung setelah Anda menerbitkan tulisan di menu Blog.</p>
                </div>
            @else
                <div class="blog-grid">
                    @foreach ($latest as $post)
                        @include('site.blog.card', ['post' => $post, 'headingTag' => 'h3'])
                    @endforeach
                </div>
                <div class="mt-10 text-center">
                    <a href="{{ $d['category'] !== '' ? route('blog.index', ['kategori' => $d['category']]) : route('blog.index') }}" class="btn btn-outline">{{ $d['button_label'] ?: 'Lihat semua tulisan' }}</a>
                </div>
            @endif
        </div>
    </section>
@endif
