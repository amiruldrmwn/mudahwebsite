<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Sections\DefaultContent;
use App\Support\Site;
use App\Support\Themes;
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
                'sample_url' => url('/').'?preview_sample='.$key,
                'preview_url' => url('/').'?preview_theme='.$key,
            ])->values(),
            'current' => Themes::current($site),
            'current_preset' => Themes::currentPreset(),
            'saved_presets' => Page::allPresets()->distinct()->pluck('preset'),
        ]);
    }

    /**
     * Switches the template. Pages follow it: a template of another group shows that group's
     * pages (its sample content the first time) and brand colour, and the current pages are kept
     * for when the owner switches back. With reset, the group starts over from its sample content.
     */
    public function update(Request $request, Site $site): RedirectResponse
    {
        $data = $request->validate([
            'theme' => ['required', Rule::in(array_keys(Themes::all()))],
            'reset' => ['boolean'],
        ]);

        $theme = Themes::all()[$data['theme']];
        $from = Themes::currentPreset();
        $to = $theme['preset'];
        $reset = (bool) ($data['reset'] ?? false);

        $site->put(['color_'.$from => $site->get('primary_color'), 'theme' => $data['theme']]);

        $installed = DefaultContent::install((string) $site->get('site_name'), $reset, $to);

        if ($from !== $to || $installed) {
            $site->put(['primary_color' => $installed ? $theme['color'] : ($site->get('color_'.$to) ?: $theme['color'])]);

            // A sample logo follows the template group; an uploaded logo stays.
            if (blank($site->get('logo')) || DefaultContent::isSampleLogo($site->get('logo'))) {
                $site->put(['logo' => DefaultContent::sampleLogo($to)]);
            }
        }

        Inertia::flash('toast', ['type' => 'success', 'message' => 'Template '.$theme['label'].' dipakai'.($installed ? ' dengan halaman contohnya.' : '.')]);

        return back();
    }
}
