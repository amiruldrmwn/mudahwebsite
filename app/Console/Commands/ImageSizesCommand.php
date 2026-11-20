<?php

namespace App\Console\Commands;

use App\Models\Page;
use App\Sections\DefaultContent;
use App\Support\ImageSizes;
use App\Support\Media;
use App\Support\PageCache;
use App\Support\Themes;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

#[Signature('compro:image-sizes')]
#[Description('Make the smaller copies of the photos the site shows (the media library and the photos its pages use)')]
class ImageSizesCommand extends Command
{
    public function handle(): int
    {
        $paths = collect(Storage::disk('public')->files(Media::DIR));

        // Photos the pages use, of every template group (switching back keeps them fast).
        Page::allPresets()->pluck('sections')->each(function ($sections) use ($paths) {
            array_walk_recursive($sections, function ($value) use ($paths) {
                if (is_string($value) && preg_match('#^(demo|media)/[^/]+\.(jpe?g|png|webp)$#i', $value)) {
                    $paths->push($value);
                }
            });
        });

        // A demo site shows every template's sample pages.
        if (config('compro.demo')) {
            foreach (array_unique(array_column(Themes::all(), 'preset')) as $preset) {
                $sections = DefaultContent::pagesFor($preset, '');
                array_walk_recursive($sections, function ($value) use ($paths) {
                    if (is_string($value) && str_starts_with($value, 'demo/')) {
                        $paths->push($value);
                    }
                });
            }
        }

        $made = $paths->unique()->sum(fn (string $path) => ImageSizes::ensure($path));

        // Kept pages were made without the new copies.
        if ($made > 0) {
            PageCache::flush();
        }

        $this->components->info("{$made} smaller copies made.");

        return self::SUCCESS;
    }
}
