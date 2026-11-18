<?php

namespace App\Http\Controllers\Admin;

use App\Ai\AiException;
use App\Ai\PageAssistant;
use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Support\Site;
use App\Support\Themes;
use App\Support\ThemeSwitcher;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

/**
 * AI that writes for the owner: a new page, the site's tagline and description, and the
 * "tell us about your business" setup that picks a template and rewrites every page.
 */
class AiWriterController extends Controller
{
    /**
     * Creates a page from the owner's description and returns where to edit it.
     */
    public function page(Request $request, PageAssistant $assistant): JsonResponse
    {
        $data = $request->validate(['request' => ['required', 'string', 'min:10', 'max:2000']], [], ['request' => 'keterangan halaman']);

        try {
            $result = $assistant->newPage($data['request'], $assistant->photosOn(Page::query()->get()));
        } catch (AiException $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }

        $page = Page::query()->create([
            'title' => $result['title'],
            'slug' => $this->uniqueSlug($result['title']),
            'position' => (int) Page::query()->max('position') + 1,
            'sections' => $result['sections'],
        ]);

        return response()->json(['redirect' => route('pages.edit', $page)]);
    }

    /**
     * Tagline, description and footer text for the settings form. Nothing is saved.
     */
    public function siteCopy(Request $request, PageAssistant $assistant): JsonResponse
    {
        $data = $request->validate(['story' => ['required', 'string', 'min:10', 'max:2000']], [], ['story' => 'cerita usaha']);

        try {
            return response()->json($assistant->siteCopy($data['story']));
        } catch (AiException $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }

    /**
     * Setup step 1: picks the template, starts its pages from the sample content, and saves the
     * site's name and texts. The pages are then rewritten one by one (rewritePage), so no single
     * request runs long.
     */
    public function setup(Request $request, PageAssistant $assistant, ThemeSwitcher $switcher, Site $site): JsonResponse
    {
        $data = $request->validate([
            'story' => ['required', 'string', 'min:20', 'max:3000'],
            'site_name' => ['required', 'string', 'max:100'],
        ], [], ['story' => 'cerita usaha', 'site_name' => 'nama usaha']);

        $templates = collect(Themes::all())->map(fn (array $t) => $t['label'].': '.$t['description'])->all();

        try {
            $result = $assistant->setup("Nama usaha: {$data['site_name']}\n\n{$data['story']}", $templates);
        } catch (AiException $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }

        $site->put(['site_name' => $data['site_name'], 'tagline' => $result['tagline'], 'description' => $result['description'], 'footer_text' => $result['footer_text']]);
        $switcher->apply($result['theme'], reset: true);

        return response()->json([
            'theme' => Themes::all()[$result['theme']]['label'],
            'pages' => Page::query()->orderBy('position')->get(['id', 'title'])->map(fn (Page $p) => ['id' => $p->id, 'title' => $p->title, 'url' => route('pages.rewrite', $p)]),
        ]);
    }

    /**
     * Setup step 2: rewrites one page for the business and saves it.
     */
    public function rewritePage(Request $request, Page $page, PageAssistant $assistant): JsonResponse
    {
        $data = $request->validate(['story' => ['required', 'string', 'max:3000']]);

        try {
            $result = $assistant->edit($page->title, $page->sections, "Sesuaikan SELURUH teks di halaman ini untuk usaha berikut, dengan struktur section dan foto yang sama. Ganti nama, layanan, produk, harga, dan contoh agar cocok dengan usaha ini:\n\n{$data['story']}");
        } catch (AiException $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }

        $page->update(['sections' => $result['sections']]);

        return response()->json(['ok' => true]);
    }

    private function uniqueSlug(string $title): string
    {
        $base = Str::slug($title) ?: 'halaman';
        $base = in_array($base, PageController::RESERVED_SLUGS, true) ? "{$base}-1" : $base;
        $slug = $base;

        for ($i = 2; Page::query()->where('slug', $slug)->exists(); $i++) {
            $slug = "{$base}-{$i}";
        }

        return $slug;
    }
}
