<?php

namespace App\Http\Controllers\Admin;

use App\Ai\AiClient;
use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Sections\DefaultContent;
use App\Sections\SectionTypes;
use App\Support\Site;
use App\Support\Themes;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Inertia\Response;

class PageController extends Controller
{
    /** Addresses taken by the app itself. */
    public const RESERVED_SLUGS = ['admin', 'login', 'logout', 'kirim-pesan', 'klik-wa', 'sitemap', 'robots', 'storage', 'build', 'brand', 'up', 'user', 'two-factor-challenge'];

    public function index(): Response
    {
        return Inertia::render('pages/Index', [
            'pages' => Page::query()->orderBy('position')->orderBy('id')->get()->map(fn (Page $page) => [
                'id' => $page->id,
                'title' => $page->title,
                'slug' => $page->slug,
                'url' => $page->url(),
                'is_home' => $page->is_home,
                'in_menu' => $page->in_menu,
                'published' => $page->published,
                'sections' => count($page->sections),
                'updated_at' => $page->updated_at?->diffForHumans(),
            ]),
            'themeLabel' => Themes::all()[Themes::current(app(Site::class))]['label'],
            'aiEnabled' => app(AiClient::class)->enabled(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:100'],
        ], [], ['title' => 'judul']);

        $page = Page::query()->create([
            'title' => $data['title'],
            'slug' => $this->uniqueSlug($data['title']),
            'position' => (int) Page::query()->max('position') + 1,
            'sections' => [SectionTypes::blank('text')],
        ]);

        return to_route('pages.edit', $page);
    }

    public function edit(Page $page): Response
    {
        return Inertia::render('pages/Edit', [
            'page' => [
                'id' => $page->id,
                'title' => $page->title,
                'slug' => $page->slug,
                'url' => $page->url(),
                'is_home' => $page->is_home,
                'in_menu' => $page->in_menu,
                'published' => $page->published,
                'meta_title' => $page->meta_title ?? '',
                'meta_description' => $page->meta_description ?? '',
                'sections' => $page->sections,
            ],
            'sectionTypes' => SectionTypes::all(),
            'sectionPresets' => $this->sectionPresets(),
            'storageUrl' => rtrim(asset('storage'), '/'),
            'aiEnabled' => app(AiClient::class)->enabled(),
        ]);
    }

    /**
     * Ready-made sections from the current template's sample pages, offered when adding a
     * section so the owner starts from filled-in content instead of a blank block.
     *
     * @return list<array{key: string, type: string, label: string, page: string, image: string, data: array<string, mixed>}>
     */
    private function sectionPresets(): array
    {
        DefaultContent::ensurePhotos();
        $types = SectionTypes::all();
        $presets = [];

        foreach (DefaultContent::pagesFor(Themes::currentPreset(), (string) app(Site::class)->get('site_name')) as $samplePage) {
            foreach ($samplePage['sections'] as $section) {
                $clean = SectionTypes::clean($section);

                if ($clean === null) {
                    continue;
                }

                $data = $clean['data'];
                $key = md5($clean['type'].json_encode($data));

                if (isset($presets[$key])) {
                    continue;
                }

                $presets[$key] = [
                    'key' => $key,
                    'type' => $clean['type'],
                    'label' => is_string($data['title'] ?? null) && $data['title'] !== '' ? $data['title'] : (string) $types[$clean['type']]['label'],
                    'page' => (string) $samplePage['title'],
                    'image' => self::presetImage($data),
                    'data' => $data,
                ];
            }
        }

        return array_values($presets);
    }

    /**
     * A thumbnail for a ready-made section: its own image, else the first item's photo.
     *
     * @param  array<string, mixed>  $data
     */
    private static function presetImage(array $data): string
    {
        if (is_string($data['image'] ?? null) && $data['image'] !== '') {
            return $data['image'];
        }

        foreach (is_array($data['items'] ?? null) ? $data['items'] : [] as $item) {
            foreach (['image', 'photo'] as $field) {
                if (is_array($item) && is_string($item[$field] ?? null) && $item[$field] !== '') {
                    return $item[$field];
                }
            }
        }

        return '';
    }

    public function update(Request $request, Page $page): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:100'],
            'slug' => ['required', 'string', 'max:80', 'regex:/^[a-z0-9]+(-[a-z0-9]+)*$/', Rule::notIn(self::RESERVED_SLUGS), Rule::unique('pages', 'slug')->where('preset', $page->preset)->ignore($page->id)],
            'in_menu' => ['boolean'],
            'published' => ['boolean'],
            'meta_title' => ['nullable', 'string', 'max:150'],
            'meta_description' => ['nullable', 'string', 'max:300'],
            'sections' => ['present', 'array', 'max:40'],
            'sections.*.type' => ['required', 'string', Rule::in(array_keys(SectionTypes::all()))],
            'sections.*.data' => ['nullable', 'array'],
        ], [
            'slug.regex' => 'Alamat halaman hanya boleh huruf kecil, angka, dan tanda hubung.',
            'slug.not_in' => 'Alamat halaman ini dipakai sistem, pilih yang lain.',
        ], ['title' => 'judul', 'slug' => 'alamat halaman', 'meta_description' => 'deskripsi SEO']);

        $page->update([
            ...$data,
            // The home page is always published.
            'published' => $page->is_home || ($data['published'] ?? true),
            'sections' => self::cleanSections($request->array('sections')),
        ]);

        Inertia::flash('toast', ['type' => 'success', 'message' => 'Halaman disimpan.']);

        return to_route('pages.edit', $page);
    }

    public function destroy(Page $page): RedirectResponse
    {
        if ($page->is_home) {
            Inertia::flash('toast', ['type' => 'error', 'message' => 'Halaman beranda tidak bisa dihapus.']);

            return back();
        }

        $page->delete();
        Inertia::flash('toast', ['type' => 'success', 'message' => 'Halaman dihapus.']);

        return to_route('pages.index');
    }

    public function reorder(Request $request): RedirectResponse
    {
        $ids = $request->validate(['ids' => ['required', 'array'], 'ids.*' => ['integer']])['ids'];

        foreach (array_values($ids) as $position => $id) {
            Page::query()->whereKey($id)->update(['position' => $position]);
        }

        return back();
    }

    public function makeHome(Page $page): RedirectResponse
    {
        Page::query()->where('is_home', true)->update(['is_home' => false]);
        $page->update(['is_home' => true, 'published' => true]);

        Inertia::flash('toast', ['type' => 'success', 'message' => "{$page->title} sekarang jadi halaman beranda."]);

        return back();
    }

    /**
     * Sections as sent by the editor (or the AI assistant), cleaned to their types' fields.
     *
     * @param  array<mixed>  $sections
     * @return list<array{id: string, type: string, data: array<string, mixed>}>
     */
    public static function cleanSections(array $sections): array
    {
        return array_values(array_filter(array_map(
            fn ($section) => is_array($section) ? SectionTypes::clean($section) : null,
            $sections,
        )));
    }

    private function uniqueSlug(string $title): string
    {
        $base = Str::slug($title) ?: 'halaman';
        $base = in_array($base, self::RESERVED_SLUGS, true) ? "{$base}-1" : $base;
        $slug = $base;

        for ($i = 2; Page::query()->where('slug', $slug)->exists(); $i++) {
            $slug = "{$base}-{$i}";
        }

        return $slug;
    }
}
