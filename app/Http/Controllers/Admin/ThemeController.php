<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Support\Site;
use App\Support\Themes;
use App\Support\ThemeSwitcher;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Inertia\Response;

class ThemeController extends Controller
{
    public function index(Site $site): Response
    {
        return Inertia::render('themes/Index', [
            'themes' => collect(Themes::all())->map(fn (array $t, string $key) => [
                'key' => $key,
                'label' => $t['label'],
                'description' => $t['description'],
                'color' => $t['color'],
                'preset' => $t['preset'],
                'category' => Themes::categoryOf($key),
                'sample_url' => url('/').'?preview_sample='.$key,
                'preview_url' => url('/').'?preview_theme='.$key,
            ])->values(),
            'categories' => collect(Themes::categories())->map(fn (array $c, string $key) => ['key' => $key, 'label' => $c['label'], 'themes' => $c['themes']])->values(),
            'current' => Themes::current($site),
            'current_preset' => Themes::currentPreset(),
            'saved_presets' => Page::allPresets()->distinct()->pluck('preset'),
        ]);
    }

    public function update(Request $request, ThemeSwitcher $switcher): RedirectResponse
    {
        $data = $request->validate([
            'theme' => ['required', Rule::in(array_keys(Themes::all()))],
            'reset' => ['boolean'],
        ]);

        $theme = Themes::all()[$data['theme']];
        $installed = $switcher->apply($data['theme'], (bool) ($data['reset'] ?? false));

        Inertia::flash('toast', ['type' => 'success', 'message' => 'Template '.$theme['label'].' dipakai'.($installed ? ' dengan halaman contohnya.' : '.')]);

        return back();
    }
}
