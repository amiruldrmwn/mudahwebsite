<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Page;
use App\Sections\DefaultContent;
use App\Sections\SectionTypes;
use App\Support\Site;
use App\Support\Themes;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

/**
 * The public website: pages, the contact form and the sitemap.
 */
class SiteController extends Controller
{
    public function show(Site $site, ?string $slug = null): View
    {
        if ($slug === null && request()->user() && Themes::has(request('preview_sample'))) {
            return $this->sample($site, (string) request('preview_sample'));
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

        return view('site.page', [
            'page' => $page,
            'theme' => request()->user() && Themes::has(request('preview_theme')) ? request('preview_theme') : Themes::current($site),
        ]);
    }

    /**
     * The home page of a template's sample content, without saving anything: the admin's
     * template previews show what a template looks like with content made for it.
     */
    private function sample(Site $site, string $theme): View
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

        return view('site.page', ['page' => $pages->first(), 'menu' => $pages, 'theme' => $theme, 'brand' => Themes::all()[$theme]['color'], 'sampleLogo' => DefaultContent::sampleLogo(Themes::all()[$theme]['preset'])]);
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

        Message::query()->create([...$data, 'ip' => $request->ip()]);

        return back()->with('contact_sent', true);
    }

    public function sitemap(): Response
    {
        $pages = Page::query()->where('published', true)->orderBy('position')->get();

        $xml = '<?xml version="1.0" encoding="UTF-8"?>'."\n".'<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        foreach ($pages as $page) {
            $xml .= '<url><loc>'.e($page->url()).'</loc><lastmod>'.$page->updated_at?->toAtomString().'</lastmod></url>';
        }

        return response($xml.'</urlset>', 200, ['Content-Type' => 'application/xml']);
    }

    public function robots(): Response
    {
        return response("User-agent: *\nDisallow: /admin\nSitemap: ".url('sitemap.xml')."\n", 200, ['Content-Type' => 'text/plain']);
    }
}
