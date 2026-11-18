<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SiteSettingsRequest;
use App\Support\Site;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class SiteSettingsController extends Controller
{
    public function edit(Site $site): Response
    {
        return Inertia::render('site/Settings', [
            'settings' => [
                ...$site->all(),
                'logo_url' => $site->url('logo'),
                'favicon_url' => $site->url('favicon'),
            ],
            'sitemapUrl' => route('sitemap'),
        ]);
    }

    public function update(SiteSettingsRequest $request, Site $site): RedirectResponse
    {
        $values = collect($request->validated())
            ->except(['logo', 'favicon', 'remove_logo', 'remove_favicon'])
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

        $site->put($values);

        Inertia::flash('toast', ['type' => 'success', 'message' => 'Pengaturan situs disimpan.']);

        return to_route('site.edit');
    }
}
