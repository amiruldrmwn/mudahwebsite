<?php

namespace App\Support;

use App\Sections\DefaultContent;

/**
 * Switches the template. Pages follow it: a template of another group shows that group's pages
 * (its sample content the first time) and brand colour, and the current pages are kept for when
 * the owner switches back. With reset, the group starts over from its sample content.
 */
class ThemeSwitcher
{
    public function __construct(private Site $site) {}

    /**
     * @return bool Whether the group's sample pages were installed
     */
    public function apply(string $key, bool $reset = false): bool
    {
        $theme = Themes::all()[$key];
        $from = Themes::currentPreset();
        $to = $theme['preset'];

        $this->site->put(['color_'.$from => $this->site->get('primary_color'), 'theme' => $key, 'theme_chosen' => true]);

        $installed = DefaultContent::install((string) $this->site->get('site_name'), $reset, $to);

        if ($from !== $to || $installed) {
            $this->site->put(['primary_color' => $installed ? $theme['color'] : ($this->site->get('color_'.$to) ?: $theme['color'])]);

            // A sample logo follows the template group; an uploaded logo stays.
            if (blank($this->site->get('logo')) || DefaultContent::isSampleLogo($this->site->get('logo'))) {
                $this->site->put(['logo' => DefaultContent::sampleLogo($to)]);
            }
        }

        return $installed;
    }
}
