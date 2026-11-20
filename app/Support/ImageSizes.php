<?php

namespace App\Support;

use Illuminate\Support\Facades\Storage;

/**
 * Smaller copies of a site photo, so a phone downloads one that fits its screen instead of the
 * full 1920 px: sizes/{width}/{path}.webp on the public disk, offered to the browser in srcset.
 */
class ImageSizes
{
    public const WIDTHS = [480, 800, 1280];

    private const DIR = 'sizes';

    /** Photos only: icons and logos (SVG, GIF, ICO) stay as they are. */
    private const RASTER = '/\.(jpe?g|png|webp)$/i';

    /**
     * Make the copies a photo is missing. Returns how many were made.
     */
    public static function ensure(string $path): int
    {
        $disk = Storage::disk('public');

        if (! preg_match(self::RASTER, $path) || ! $disk->exists($path)) {
            return 0;
        }

        $missing = array_filter(self::WIDTHS, fn (int $w) => ! $disk->exists(self::path($path, $w)));
        $info = $missing ? @getimagesize($disk->path($path)) : false;

        if (! $info || $info[0] * $info[1] > 40_000_000) {
            return 0;
        }

        $missing = array_filter($missing, fn (int $w) => $w < $info[0]);
        $image = $missing ? @imagecreatefromstring((string) $disk->get($path)) : false;

        if ($image === false) {
            return 0;
        }

        foreach ($missing as $width) {
            $height = max(1, (int) round($info[1] * $width / $info[0]));
            $copy = imagecreatetruecolor($width, $height);
            imagealphablending($copy, false);
            imagesavealpha($copy, true);
            imagecopyresampled($copy, $image, 0, 0, 0, 0, $width, $height, $info[0], $info[1]);

            ob_start();
            imagewebp($copy, null, Media::QUALITY);
            $disk->put(self::path($path, $width), (string) ob_get_clean());
            imagedestroy($copy);
        }

        imagedestroy($image);

        return count($missing);
    }

    /**
     * The srcset for a photo with copies (the copies plus the photo itself), else null.
     */
    public static function srcset(string $path): ?string
    {
        $disk = Storage::disk('public');

        if (! preg_match(self::RASTER, $path)) {
            return null;
        }

        $sources = [];

        foreach (self::WIDTHS as $width) {
            if (is_file($disk->path(self::path($path, $width)))) {
                $sources[] = $disk->url(self::path($path, $width))." {$width}w";
            }
        }

        $info = $sources ? @getimagesize($disk->path($path)) : false;

        if (! $info) {
            return null;
        }

        $sources[] = $disk->url($path)." {$info[0]}w";

        return implode(', ', $sources);
    }

    public static function forget(string $path): void
    {
        Storage::disk('public')->delete(array_map(fn (int $w) => self::path($path, $w), self::WIDTHS));
    }

    private static function path(string $path, int $width): string
    {
        return self::DIR."/{$width}/{$path}.webp";
    }
}
