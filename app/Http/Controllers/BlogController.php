<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Post;
use App\Models\SiteVisit;
use App\Support\Site;
use App\Support\Themes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * The public blog: the list of posts (/blog) and a post (/blog/{slug}), inside the site's template.
 * Only live posts are public; a signed-in admin can open drafts and scheduled posts to preview them.
 */
class BlogController extends Controller
{
    private const PER_PAGE = 9;

    public function index(Request $request, Site $site): View
    {
        $category = trim((string) $request->query('kategori'));

        $posts = Post::query()->published()
            ->when($category !== '', fn (Builder $q) => $q->where('category', $category))
            ->latestFirst()
            ->paginate(self::PER_PAGE)->withQueryString();

        $title = self::blogTitle($site);
        $this->countVisit();

        return view('site.blog.index', [
            ...$this->themeData($request, $site),
            'page' => self::pageFor($category !== '' ? "{$category} | {$title}" : $title),
            'posts' => $posts,
            'blogTitle' => $title,
            'category' => $category,
            'categories' => Post::categories(liveOnly: true),
        ]);
    }

    public function show(Request $request, Site $site, string $slug): View
    {
        $post = Post::query()->where('slug', $slug)->first();

        abort_if($post === null || (! $post->isLive() && ! $request->user()), 404);

        $newer = $older = null;

        if ($post->isLive()) {
            $older = Post::query()->published()->where(fn (Builder $q) => $q->where('published_at', '<', $post->published_at)->orWhere(fn (Builder $q) => $q->where('published_at', $post->published_at)->where('id', '<', $post->id)))->latestFirst()->first();
            $newer = Post::query()->published()->where(fn (Builder $q) => $q->where('published_at', '>', $post->published_at)->orWhere(fn (Builder $q) => $q->where('published_at', $post->published_at)->where('id', '>', $post->id)))->orderBy('published_at')->orderBy('id')->first();
        }

        $others = Post::query()->published()->whereKeyNot($post->id)->latestFirst();
        $related = $post->category ? (clone $others)->where('category', $post->category)->limit(3)->get() : collect();

        if ($related->count() < 3) {
            $related = $related->merge((clone $others)->whereNotIn('id', $related->pluck('id'))->limit(3 - $related->count())->get());
        }

        $this->countVisit();

        return view('site.blog.show', [
            ...$this->themeData($request, $site),
            'page' => self::pageFor($post->title, $post->meta_title, $post->meta_description ?: $post->summary(160)),
            'post' => $post,
            'blogTitle' => self::blogTitle($site),
            'newer' => $newer,
            'older' => $older,
            'related' => $related,
            'ogType' => 'article',
            'ogImage' => $post->coverUrl(),
        ]);
    }

    public static function blogTitle(Site $site): string
    {
        $title = $site->get('blog_title');

        return is_string($title) && trim($title) !== '' ? trim($title) : 'Blog';
    }

    /**
     * The menu's link to the blog, as a page the theme menus can show (id 0, never saved).
     */
    public static function menuItem(Site $site): Page
    {
        return (new Page)->forceFill(['id' => 0, 'title' => self::blogTitle($site), 'slug' => 'blog', 'is_home' => false, 'in_menu' => true, 'published' => true]);
    }

    /**
     * An unsaved page carrying the title and description to the site layout, and marking the blog
     * link in the menu as the current page.
     */
    private static function pageFor(string $title, ?string $metaTitle = null, ?string $metaDescription = null): Page
    {
        return (new Page)->forceFill(['id' => 0, 'title' => $title, 'slug' => 'blog', 'is_home' => false, 'meta_title' => $metaTitle, 'meta_description' => $metaDescription]);
    }

    /**
     * The template to render in: the site's own, or the one an admin is previewing.
     *
     * @return array{theme: string, brand?: string}
     */
    private function themeData(Request $request, Site $site): array
    {
        if ($request->user()) {
            if (Themes::has($request->query('preview_sample'))) {
                $theme = (string) $request->query('preview_sample');

                return ['theme' => $theme, 'brand' => Themes::all()[$theme]['color']];
            }

            if (Themes::has($request->query('preview_theme'))) {
                return ['theme' => (string) $request->query('preview_theme')];
            }
        }

        return ['theme' => Themes::current($site)];
    }

    private function countVisit(): void
    {
        if (! auth()->check() && ! preg_match('/bot|crawl|spider|slurp|preview|monitor|curl|wget|python|headless/i', (string) request()->userAgent())) {
            SiteVisit::bump('views');
        }
    }
}
