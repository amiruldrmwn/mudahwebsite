<?php

namespace App\Console\Commands;

use App\Models\Page;
use App\Sections\DefaultContent;
use App\Support\Site;
use App\Support\Themes;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('compro:install-content {--replace : Delete the current pages and start again from the sample content}')]
#[Description('Create the starting pages of the template in use (or SITE_THEME on a new site) when it has none yet')]
class InstallContentCommand extends Command
{
    public function handle(Site $site): int
    {
        $replace = (bool) $this->option('replace');

        if ($replace && ! $this->confirm('Delete every page and start again from the sample content?')) {
            return self::FAILURE;
        }

        // A brand-new site starts with the template chosen at order time (SITE_THEME).
        $theme = config('compro.theme');

        if (! Page::allPresets()->exists() && is_string($theme) && Themes::has($theme)) {
            $site->put(['theme' => $theme, 'primary_color' => Themes::all()[$theme]['color']]);
        }

        DefaultContent::install((string) $site->get('site_name'), $replace, Themes::all()[Themes::current($site)]['preset'])
            ? $this->components->info('Starting pages created.')
            : $this->components->info('The site already has pages.');

        return self::SUCCESS;
    }
}
