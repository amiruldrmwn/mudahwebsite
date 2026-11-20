<?php

namespace App\Support;

use App\Http\Controllers\BlogController;
use App\Models\Page;
use App\Sections\DefaultContent;
use App\Sections\SectionTypes;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;

/**
 * A template's sample site, never saved: the admin's template previews and the demo site's
 * ?tema= pages, including the blog with sample posts. Links inside keep the preview going.
 */
class SampleSite
{
    /**
     * @return Collection<int, Page>
     */
    public static function pages(Site $site, string $theme): Collection
    {
        DefaultContent::ensurePhotos();

        return collect(DefaultContent::pagesFor(Themes::all()[$theme]['preset'], (string) $site->get('site_name')))
            ->map(fn (array $p, int $i) => (new Page)->forceFill([
                'id' => $i + 1,
                'title' => $p['title'],
                'slug' => $p['slug'],
                'is_home' => $p['is_home'] ?? false,
                'in_menu' => true,
                'published' => true,
                'sections' => array_map(fn (array $s) => SectionTypes::clean($s), $p['sections']),
            ]));
    }

    /**
     * What the site layout needs to show a sample page: its menu (with the blog, before Kontak,
     * unless the template has its own news page), the template, its colour and sample logo.
     *
     * @param  Collection<int, Page>|null  $pages
     * @return array{menu: Collection<int, Page>, theme: string, brand: string, sampleLogo: string}
     */
    public static function viewData(Site $site, string $theme, ?Collection $pages = null): array
    {
        $menu = ($pages ?? self::pages($site, $theme))->values();

        if (! $menu->contains(fn (Page $p) => in_array($p->slug, ['blog', 'berita'], true))) {
            $contact = $menu->search(fn (Page $p) => $p->slug === 'kontak');
            $menu->splice($contact === false ? $menu->count() : $contact, 0, [BlogController::menuItem($site)]);
        }

        return [
            'menu' => $menu,
            'theme' => $theme,
            'brand' => Themes::all()[$theme]['color'],
            'sampleLogo' => DefaultContent::sampleLogo(Themes::all()[$theme]['preset']),
        ];
    }

    /**
     * A rendered sample page, with its links kept in the preview and out of search results
     * (the same sample pages are on every demo address).
     */
    public static function response(string $html, string $key, string $theme): Response
    {
        return response(self::keepLinks($html, $key, $theme))->header('X-Robots-Tag', 'noindex');
    }

    /**
     * Adds ?<key>=<theme> to the links that point to pages of this site.
     */
    public static function keepLinks(string $html, string $key, string $theme): string
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
}
