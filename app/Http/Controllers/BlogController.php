<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Post;
use App\Models\SiteVisit;
use App\Sections\SamplePosts;
use App\Support\SampleSite;
use App\Support\Site;
use App\Support\Themes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\View\View;

/**
 * The public blog: the list of posts (/blog) and a post (/blog/{slug}), inside the site's template.
 * Only live posts are public; a signed-in admin can open drafts and scheduled posts to preview them.
 * A demo site's template demos (?tema=) show sample posts written for the template's kind of business.
 */
class BlogController extends Controller
{
    private const PER_PAGE = 9;

    public function index(Request $request, Site $site): View|Response
    {
        $category = trim((string) $request->query('kategori'));

        if ($theme = $this->demoTheme($request)) {
            $all = SamplePosts::for($theme);
            $shown = $all->when($category !== '', fn (Collection $posts) => $posts->where('category', $category))->values();

            return SampleSite::response(view('site.blog.index', [
                ...SampleSite::viewData($site, $theme),
                'page' => self::pageFor(self::blogTitle($site)),
                'posts' => new LengthAwarePaginator($shown, $shown->count(), self::PER_PAGE, 1, ['path' => route('blog.index')]),
                'blogTitle' => self::blogTitle($site),
                'category' => $category,
                'categories' => $all->pluck('category')->unique()->values()->all(),
            ])->render(), 'tema', $theme);
        }

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

    public function show(Request $request, Site $site, string $slug): View|Response
    {
        if ($theme = $this->demoTheme($request)) {
            $all = SamplePosts::for($theme);
            $index = $all->search(fn (Post $p) => $p->slug === $slug);
            abort_if($index === false, 404);
            $post = $all[$index];

            return SampleSite::response(view('site.blog.show', [
                ...SampleSite::viewData($site, $theme),
                'page' => self::pageFor($post->title, null, $post->summary(160)),
                'post' => $post,
                'blogTitle' => self::blogTitle($site),
                'newer' => $all[$index - 1] ?? null,
                'older' => $all[$index + 1] ?? null,
                'related' => $all->except([$index])->values(),
                'ogType' => 'article',
                'ogImage' => $post->coverUrl(),
            ])->render(), 'tema', $theme);
        }

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

    /**
     * A demo site's template demo (?tema=), shown with sample posts.
     */
    private function demoTheme(Request $request): ?string
    {
        $theme = $request->query('tema');

        return config('compro.demo') && Themes::has($theme) ? (string) $theme : null;
    }

    private function countVisit(): void
    {
        if (! auth()->check() && ! preg_match('/bot|crawl|spider|slurp|preview|monitor|curl|wget|python|headless/i', (string) request()->userAgent())) {
            SiteVisit::bump('views');
        }
    }
}
