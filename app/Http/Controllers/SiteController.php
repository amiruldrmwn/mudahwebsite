<?php

namespace App\Http\Controllers;

use App\Mail\NewContactMessage;
use App\Models\Message;
use App\Models\Page;
use App\Models\Post;
use App\Models\SiteVisit;
use App\Models\User;
use App\Sections\DefaultContent;
use App\Sections\SectionTypes;
use App\Support\PageCache;
use App\Support\Site;
use App\Support\Themes;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Throwable;

/**
 * The public website: pages, the contact form and the sitemap.
 */
class SiteController extends Controller
{
    public function show(Site $site, ?string $slug = null): View|Response
    {
        if (request()->user() && Themes::has(request('preview_sample'))) {
            return $this->sample($site, (string) request('preview_sample'), $slug);
        }

        // A demo site: anyone can browse a template's sample pages.
        if (config('compro.demo') && Themes::has(request('tema'))) {
            return $this->sample($site, (string) request('tema'), $slug, 'tema');
        }

        $page = $slug === null
            ? Page::query()->where('is_home', true)->first() ?? Page::query()->orderBy('position')->first()
            : Page::query()->where('slug', $slug)->first();

        if ($page === null && $slug === null) {
            return view('site.empty');
        }

        abort_if($page === null || (! $page->published && ! auth()->check()), 404);

        // The home page lives at /, not at its slug.
        abort_if($slug !== null && $page->is_home, 404);

        // An admin previewing their own pages in another template keeps that template on every page.
        if (request()->user() && Themes::has(request('preview_theme'))) {
            $theme = (string) request('preview_theme');

            return response($this->keepPreviewLinks(view('site.page', ['page' => $page, 'theme' => $theme])->render(), 'preview_theme', $theme));
        }

        $this->countVisit();
        $render = fn () => view('site.page', ['page' => $page, 'theme' => Themes::current($site)])->render();

        // Admins always see the page as it is now (and their unpublished pages are never kept).
        return response(auth()->check() ? $render() : PageCache::remember(url()->current(), $render));
    }

    /**
     * A click on a WhatsApp button, sent by the page as a beacon.
     */
    public function whatsappClick(): Response
    {
        // One click per visitor every 10 minutes, so the figure can't be pumped up by repeating it.
        if (! $this->isBot() && Cache::add('wa-click:'.sha1((string) request()->ip()), true, now()->addMinutes(10))) {
            SiteVisit::bump('whatsapp_clicks');
        }

        return response()->noContent();
    }

    /**
     * Count a page view, leaving out the site's own admins and search engine bots.
     */
    private function countVisit(): void
    {
        if (! auth()->check() && ! $this->isBot()) {
            SiteVisit::bump('views');
        }
    }

    private function isBot(): bool
    {
        return (bool) preg_match('/bot|crawl|spider|slurp|preview|monitor|curl|wget|python|headless/i', (string) request()->userAgent());
    }

    /**
     * A page of a template's sample content, without saving anything: the admin's template
     * previews show what a template looks like with content made for it. Links inside the page
     * keep the preview going, so every sample page can be browsed.
     */
    private function sample(Site $site, string $theme, ?string $slug, string $key = 'preview_sample'): Response
    {
        DefaultContent::ensurePhotos();

        $pages = collect(DefaultContent::pagesFor(Themes::all()[$theme]['preset'], (string) $site->get('site_name')))
            ->map(fn (array $p, int $i) => (new Page)->forceFill([
                'id' => $i + 1,
                'title' => $p['title'],
                'slug' => $p['slug'],
                'is_home' => $p['is_home'] ?? false,
                'in_menu' => true,
                'published' => true,
                'sections' => array_map(fn (array $s) => SectionTypes::clean($s), $p['sections']),
            ]));

        $page = $slug === null ? $pages->firstWhere('is_home', true) : $pages->first(fn (Page $p) => $p->slug === $slug && ! $p->is_home);
        abort_if($page === null, 404);

        $html = view('site.page', [
            'page' => $page,
            'menu' => $pages,
            'theme' => $theme,
            'brand' => Themes::all()[$theme]['color'],
            'sampleLogo' => DefaultContent::sampleLogo(Themes::all()[$theme]['preset']),
        ])->render();

        // The same sample pages on every demo address: kept out of search results.
        return response($this->keepPreviewLinks($html, $key, $theme))->header('X-Robots-Tag', 'noindex');
    }

    /**
     * Adds ?<key>=<theme> to the links that point to pages of this site.
     */
    private function keepPreviewLinks(string $html, string $key, string $theme): string
    {
        $base = rtrim(url('/'), '/');

        return (string) preg_replace_callback('/href="([^"]*)"/', function (array $m) use ($base, $key, $theme) {
            $url = html_entity_decode($m[1]);

            if (str_starts_with($url, $base)) {
                $path = substr($url, strlen($base));
            } elseif (str_starts_with($url, '/') && ! str_starts_with($url, '//')) {
                $path = $url;
            } else {
                return $m[0];
            }

            $path = $path === '' ? '/' : $path;

            if (preg_match('#^/(storage|build|admin|kirim-pesan|favicon)#', $path)) {
                return $m[0];
            }

            [$path, $fragment] = array_pad(explode('#', $path, 2), 2, null);
            $path .= (str_contains($path, '?') ? '&' : '?').$key.'='.$theme;

            return 'href="'.e($base.$path.($fragment !== null ? '#'.$fragment : '')).'"';
        }, $html);
    }

    public function contact(Request $request): RedirectResponse
    {
        // Bots fill the hidden field; they get the same answer without a message being kept.
        if (filled($request->input('website'))) {
            return back()->with('contact_sent', true);
        }

        $data = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:150'],
            'phone' => ['nullable', 'string', 'max:30'],
            'body' => ['required', 'string', 'max:3000'],
        ], [], ['name' => 'nama', 'body' => 'pesan']);

        $message = Message::query()->create([...$data, 'ip' => $request->ip()]);

        $this->notifyOwner($message);

        return back()->with('contact_sent', true);
    }

    /**
     * Email the owner about a new message: to the site's contact email, else the admin's. Sent by
     * the queue worker, so a slow mail server never holds up the visitor (or a flood of them).
     * A mail failure never stops the visitor's message from being kept.
     */
    private function notifyOwner(Message $message): void
    {
        $site = app(Site::class);
        $to = $site->get('contact_email') ?: User::query()->value('email');

        if (! is_string($to) || $to === '') {
            return;
        }

        try {
            Mail::to($to)->queue(new NewContactMessage($message, (string) $site->get('site_name')));
        } catch (Throwable $e) {
            report($e);
        }
    }

    public function sitemap(): Response
    {
        $pages = Page::query()->where('published', true)->orderBy('position')->get();

        $xml = '<?xml version="1.0" encoding="UTF-8"?>'."\n".'<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        foreach ($pages as $page) {
            $xml .= '<url><loc>'.e($page->url()).'</loc><lastmod>'.$page->updated_at?->toAtomString().'</lastmod></url>';
        }

        $xml .= $this->blogSitemap();

        return response($xml.'</urlset>', 200, ['Content-Type' => 'application/xml']);
    }

    /**
     * The blog and its live posts, once there is one.
     */
    private function blogSitemap(): string
    {
        $posts = Post::query()->published()->latestFirst()->get(['slug', 'updated_at', 'published_at']);

        if ($posts->isEmpty()) {
            return '';
        }

        $xml = '<url><loc>'.e(route('blog.index')).'</loc><lastmod>'.$posts->max('updated_at')?->toAtomString().'</lastmod></url>';

        foreach ($posts as $post) {
            $xml .= '<url><loc>'.e($post->url()).'</loc><lastmod>'.$post->updated_at?->toAtomString().'</lastmod></url>';
        }

        return $xml;
    }

    public function robots(): Response
    {
        return response("User-agent: *\nDisallow: /admin\nSitemap: ".url('sitemap.xml')."\n", 200, ['Content-Type' => 'text/plain']);
    }
}
