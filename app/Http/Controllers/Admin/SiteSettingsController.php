<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SiteSettingsRequest;
use App\Support\Site;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class SiteSettingsController extends Controller
{
    public function edit(Site $site): Response
    {
        return Inertia::render('site/Settings', [
            'settings' => [
                // The AI key never goes back to the browser, only whether one is saved.
                ...collect($site->all())->except('ai_api_key')->all(),
                'ai_key_set' => $site->aiApiKey() !== null,
                'logo_url' => $site->url('logo'),
                'favicon_url' => $site->url('favicon'),
            ],
            'sitemapUrl' => route('sitemap'),
        ]);
    }

    public function update(SiteSettingsRequest $request, Site $site): RedirectResponse
    {
        $values = collect($request->validated())
            ->except(['logo', 'favicon', 'remove_logo', 'remove_favicon', 'ai_api_key', 'remove_ai_key'])
            ->map(fn ($value) => $value ?? '')
            ->all();

        foreach (['logo', 'favicon'] as $file) {
            $old = $site->get($file);

            if ($request->hasFile($file)) {
                $values[$file] = $request->file($file)->store('site', 'public');
            } elseif ($request->boolean("remove_{$file}")) {
                $values[$file] = null;
            } else {
                continue;
            }

            if (is_string($old) && $old !== '') {
                Storage::disk('public')->delete($old);
            }
        }

        // A blank key field keeps the saved key; a new one is stored encrypted.
        if ($request->boolean('remove_ai_key')) {
            $values['ai_api_key'] = '';
        } elseif (filled($request->input('ai_api_key'))) {
            $values['ai_api_key'] = Crypt::encryptString((string) $request->input('ai_api_key'));
        }

        $site->put($values);

        Inertia::flash('toast', ['type' => 'success', 'message' => 'Pengaturan situs disimpan.']);

        return to_route('site.edit');
    }
}
