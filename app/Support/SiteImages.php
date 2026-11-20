<?php

namespace App\Support;

use App\Models\MediaMeta;

/**
 * Finishes the images of a rendered section: the first section's load at once (the first one
 * with high priority), later ones only when scrolled near; photos with smaller copies get a
 * srcset; and a library image without alt text gets the description the owner wrote in Media,
 * else one made from its file name.
 */
class SiteImages
{
    /** @var array<string, string>|null */
    private static ?array $alts = null;

    public static function section(string $html, int $index): string
    {
        $first = true;

        return (string) preg_replace_callback('/<img\b[^>]*>/i', function (array $m) use ($index, &$first) {
            $tag = $m[0];

            if (! preg_match('/\sloading=/i', $tag)) {
                $tag = self::attr($tag, $index > 0 ? 'loading="lazy"' : ($first ? 'fetchpriority="high"' : ''));
            }

            if (! preg_match('/\sdecoding=/i', $tag)) {
                $tag = self::attr($tag, 'decoding="async"');
            }

            // A phone picks a smaller copy (ImageSizes); the widths say how wide the image shows.
            if (! preg_match('/\ssrcset=/i', $tag) && preg_match('#\ssrc="[^"]*/storage/((?:demo|'.Media::DIR.')/[^"/?]+)"#i', $tag, $src) && ($srcset = ImageSizes::srcset($src[1]))) {
                $tag = self::attr($tag, 'srcset="'.e($srcset).'" sizes="100vw"');
            }

            if (preg_match('/\salt=""/i', $tag) && preg_match('#\ssrc="[^"]*/storage/('.Media::DIR.'/[^"/?]+)"#i', $tag, $src)) {
                $alt = self::alt($src[1]);
                $tag = $alt === '' ? $tag : (string) preg_replace('/\salt=""/i', ' alt="'.e($alt).'"', $tag, 1);
            }

            $first = false;

            return $tag;
        }, $html);
    }

    /**
     * The owner's description of a library image, else its file name as words ("foto-toko-a1b2c3.webp"
     * → "Foto toko"), or nothing for a name that says nothing ("IMG_2024", a hash).
     */
    public static function alt(string $path): string
    {
        self::$alts ??= MediaMeta::query()->where('alt', '!=', '')->pluck('alt', 'path')->all();

        if (($alt = self::$alts[$path] ?? '') !== '') {
            return $alt;
        }

        $name = preg_replace('/-[a-z0-9]{6}$/', '', pathinfo($path, PATHINFO_FILENAME)) ?? '';
        $words = trim((string) preg_replace('/[-_\s]+/', ' ', $name));

        if ($words === '' || (! str_contains($words, ' ') && strlen($words) > 20) || preg_match('/^(img|dsc|pxl|image|gambar|foto|photo|screenshot|whatsapp image|wa)?[\s\d]*$/i', $words)) {
            return '';
        }

        return ucfirst($words);
    }

    /** Forget the descriptions read for this request (after the owner edits one). */
    public static function flush(): void
    {
        self::$alts = null;
    }

    private static function attr(string $tag, string $attr): string
    {
        return $attr === '' ? $tag : (string) preg_replace('/^<img\b/i', '<img '.$attr, $tag, 1);
    }
}
