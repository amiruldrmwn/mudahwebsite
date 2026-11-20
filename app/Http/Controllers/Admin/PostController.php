<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Support\RichText;
use App\Support\Site;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Inertia\Response;

/**
 * Blog posts in the admin: the list, the editor, autosave of drafts, and the blog's menu link.
 */
class PostController extends Controller
{
    public const UNTITLED = 'Tulisan tanpa judul';

    private const STATES = ['published', 'scheduled', 'draft'];

    public function index(Request $request, Site $site): Response
    {
        $search = trim((string) $request->query('q'));
        $state = in_array($request->query('status'), self::STATES, true) ? (string) $request->query('status') : '';

        $posts = Post::query()
            ->when($search !== '', fn (Builder $q) => $q->where(fn (Builder $q) => $q->where('title', 'like', "%{$search}%")->orWhere('category', 'like', "%{$search}%")))
            ->when($state === 'published', fn (Builder $q) => $q->published())
            ->when($state === 'scheduled', fn (Builder $q) => $q->scheduled())
            ->when($state === 'draft', fn (Builder $q) => $q->draft())
            ->orderByRaw('published_at is null desc')->latestFirst()
            ->paginate(20)->withQueryString()
            ->through(fn (Post $post) => [
                'id' => $post->id,
                'title' => $post->title,
                'slug' => $post->slug,
                'url' => $post->url(),
                'state' => $post->state(),
                'category' => $post->category,
                'cover_url' => $post->coverUrl(),
                'date' => $post->state() === 'draft'
                    ? 'Diubah '.$post->updated_at?->diffForHumans()
                    : $post->dateLabel('j M Y, H.i'),
            ]);

        return Inertia::render('posts/Index', [
            'posts' => $posts,
            'filters' => ['q' => $search, 'status' => $state],
            'counts' => [
                'all' => Post::query()->count(),
                'published' => Post::query()->published()->count(),
                'scheduled' => Post::query()->scheduled()->count(),
                'draft' => Post::query()->draft()->count(),
            ],
            'settings' => [
                'blog_menu' => $site->get('blog_menu') !== 'no',
                'blog_title' => (string) ($site->get('blog_title') ?: 'Blog'),
            ],
            'blogUrl' => url('blog'),
        ]);
    }

    public function store(): RedirectResponse
    {
        // Drafts opened and left without a word are cleared away after a while.
        Post::query()->draft()->where('title', self::UNTITLED)->where('body', '')->where('updated_at', '<', now()->subDay())->delete();

        $post = Post::query()->create([
            'title' => self::UNTITLED,
            'slug' => self::uniqueSlug('tulisan-'.Str::lower(Str::random(6))),
            'body' => '',
        ]);

        return to_route('posts.edit', $post);
    }

    public function edit(Post $post, Site $site): Response
    {
        return Inertia::render('posts/Edit', [
            'post' => [
                'id' => $post->id,
                'title' => $post->title === self::UNTITLED ? '' : $post->title,
                'slug' => $post->slug,
                'excerpt' => $post->excerpt ?? '',
                'body' => $post->body,
                'cover' => $post->cover ?? '',
                'category' => $post->category ?? '',
                'status' => $post->status,
                'published_at' => $post->published_at?->toIso8601String() ?? '',
                'meta_title' => $post->meta_title ?? '',
                'meta_description' => $post->meta_description ?? '',
                'state' => $post->state(),
                'url' => $post->url(),
                'ever_published' => $post->published_at !== null,
                'updated_at' => $post->updated_at?->toIso8601String(),
            ],
            'categories' => Post::categories(),
            'storageUrl' => rtrim(asset('storage'), '/'),
            'blogUrl' => url('blog'),
            'siteName' => (string) $site->get('site_name'),
        ]);
    }

    public function update(Request $request, Post $post): RedirectResponse
    {
        $data = $this->validated($request, $post);

        $publish = $data['status'] === Post::PUBLISHED;
        $at = filled($data['published_at'] ?? null) ? Carbon::parse($data['published_at'])->utc() : null;
        $data['published_at'] = $publish ? ($at ?? now()) : $at;

        $post->update($data);

        $message = match ($post->state()) {
            'published' => 'Tulisan diterbitkan.',
            'scheduled' => 'Tulisan dijadwalkan terbit '.$post->dateLabel('j F Y, H.i').'.',
            default => 'Draf disimpan.',
        };
        Inertia::flash('toast', ['type' => 'success', 'message' => $message]);

        return to_route('posts.edit', $post);
    }

    /**
     * Saves a draft as it is written. Published posts aren't autosaved: what visitors see changes
     * only when the owner saves.
     */
    public function autosave(Request $request, Post $post): JsonResponse
    {
        if ($post->state() !== 'draft') {
            return response()->json(['saved' => false], 409);
        }

        $data = $this->validated($request, $post, autosave: true);
        $post->update($data);

        return response()->json(['saved' => true, 'slug' => $post->slug, 'updated_at' => $post->updated_at?->toIso8601String()]);
    }

    public function destroy(Post $post): RedirectResponse
    {
        $post->delete();
        Inertia::flash('toast', ['type' => 'success', 'message' => 'Tulisan dihapus.']);

        return to_route('posts.index');
    }

    /**
     * The blog's name and whether the menu links to it.
     */
    public function settings(Request $request, Site $site): RedirectResponse
    {
        $data = $request->validate([
            'blog_menu' => ['required', 'boolean'],
            'blog_title' => ['required', 'string', 'max:40'],
        ], [], ['blog_title' => 'nama blog']);

        $site->put(['blog_menu' => $data['blog_menu'] ? 'yes' : 'no', 'blog_title' => trim($data['blog_title'])]);
        Inertia::flash('toast', ['type' => 'success', 'message' => 'Pengaturan blog disimpan.']);

        return back();
    }

    /**
     * @return array<string, mixed>
     */
    private function validated(Request $request, Post $post, bool $autosave = false): array
    {
        // A slug the editor made from the title gets a number when another post has it.
        if ($request->boolean('slug_auto') && is_string($request->input('slug')) && $request->input('slug') !== '') {
            $request->merge(['slug' => self::uniqueSlug((string) $request->input('slug'), $post->id)]);
        }

        $data = $request->validate([
            'title' => [$autosave ? 'nullable' : 'required', 'string', 'max:200'],
            'slug' => ['required', 'string', 'max:120', 'regex:/^[a-z0-9]+(-[a-z0-9]+)*$/', Rule::unique('posts', 'slug')->ignore($post->id)],
            'excerpt' => ['nullable', 'string', 'max:300'],
            'body' => ['nullable', 'string', 'max:1000000'],
            'cover' => ['nullable', 'string', 'max:255', 'regex:#^media/[A-Za-z0-9._-]+$#'],
            'category' => ['nullable', 'string', 'max:50'],
            'meta_title' => ['nullable', 'string', 'max:150'],
            'meta_description' => ['nullable', 'string', 'max:300'],
            ...($autosave ? [] : [
                'status' => ['required', Rule::in([Post::DRAFT, Post::PUBLISHED])],
                'published_at' => ['nullable', 'date'],
            ]),
        ], [
            'slug.regex' => 'Alamat tulisan hanya boleh huruf kecil, angka, dan tanda hubung.',
            'slug.unique' => 'Alamat ini sudah dipakai tulisan lain.',
        ], ['title' => 'judul', 'slug' => 'alamat tulisan', 'excerpt' => 'ringkasan', 'cover' => 'gambar sampul', 'category' => 'kategori', 'meta_description' => 'deskripsi SEO']);

        return [
            ...$data,
            'title' => trim((string) ($data['title'] ?? '')) ?: self::UNTITLED,
            'body' => RichText::clean($data['body'] ?? ''),
            'category' => trim((string) ($data['category'] ?? '')) ?: null,
            'excerpt' => trim((string) ($data['excerpt'] ?? '')) ?: null,
        ];
    }

    private static function uniqueSlug(string $base, ?int $ignore = null): string
    {
        $slug = $base;

        for ($i = 2; Post::query()->where('slug', $slug)->when($ignore, fn (Builder $q) => $q->whereKeyNot($ignore))->exists(); $i++) {
            $slug = "{$base}-{$i}";
        }

        return $slug;
    }
}
