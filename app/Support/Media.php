<?php

namespace App\Support;

use App\Models\MediaMeta;
use App\Models\Page;
use enshrined\svgSanitize\Sanitizer;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

/**
 * The owner's uploaded images (media/ on the public disk), shared by every section.
 *
 * Photos are made web sized on upload: turned upright, shrunk to MAX_SIDE and saved as WebP,
 * unless the original is already smaller. SVGs are cleaned of scripts, event handlers and
 * outside references, since they are served from the site's own address. GIFs stay as they are
 * so animations keep playing.
 */
class Media
{
    public const DIR = 'media';

    /** Longest side of a stored photo, in pixels. */
    public const MAX_SIDE = 1920;

    public const QUALITY = 80;

    /** Larger images aren't decoded (40 MP would need over 160 MB of memory). */
    private const MAX_PIXELS = 40_000_000;

    /**
     * Store an uploaded image under $dir and return its path on the public disk. With $webp off, a
     * photo keeps its own format (PNG stays PNG): for the logo and favicon, which link previews and
     * older browsers must read.
     *
     * @throws ValidationException when the file can't be read as an image or a clean SVG
     */
    public function store(UploadedFile $file, string $dir = self::DIR, int $maxSide = self::MAX_SIDE, string $field = 'file', bool $webp = true): string
    {
        $name = $this->baseName($file);
        $ext = strtolower($file->getClientOriginalExtension() ?: (string) $file->extension());

        [$contents, $ext] = match (true) {
            $ext === 'svg' || $file->getMimeType() === 'image/svg+xml' => [$this->cleanSvg((string) file_get_contents($file->getRealPath()), $field), 'svg'],
            in_array($ext, ['gif', 'ico'], true) => [(string) file_get_contents($file->getRealPath()), $ext],
            default => $this->webSized($file, $maxSide, $field, $webp),
        };

        $path = $dir.'/'.$name.'-'.Str::lower(Str::random(6)).'.'.$ext;

        if (! Storage::disk('public')->put($path, $contents)) {
            throw ValidationException::withMessages([$field => 'Gambar gagal disimpan, coba lagi.']);
        }

        return $path;
    }

    /**
     * Every image in the library, newest first, with where it is used.
     *
     * @return list<array{path: string, url: string, name: string, size: int, width: int|null, height: int|null, modified: int, alt: string, used_in: list<array{label: string, href: string}>}>
     */
    public function all(): array
    {
        $disk = Storage::disk('public');
        $usage = $this->usage();
        $alts = MediaMeta::query()->pluck('alt', 'path')->all();

        $files = collect($disk->files(self::DIR))
            ->filter(fn (string $path) => preg_match('/\.(jpe?g|png|webp|gif|svg|avif)$/i', $path) === 1)
            ->map(function (string $path) use ($disk, $usage, $alts) {
                $size = @getimagesize($disk->path($path)) ?: null;

                return [
                    'path' => $path,
                    'url' => $disk->url($path),
                    'name' => basename($path),
                    'size' => $disk->size($path),
                    'width' => $size[0] ?? null,
                    'height' => $size[1] ?? null,
                    'modified' => $disk->lastModified($path),
                    'alt' => (string) ($alts[$path] ?? ''),
                    'used_in' => $usage[$path] ?? [],
                ];
            });

        return array_values($files->sortByDesc('modified')->all());
    }

    /**
     * Put a new file in place of a library image: every page (of every template group) and setting
     * that used it now uses the new one, its description carries over, and the old file goes.
     * Returns the new path (its name, and often its format, differ from the old one).
     */
    public function replace(string $old, UploadedFile $file): string
    {
        $new = $this->store($file);

        Page::allPresets()->get()->each(function (Page $page) use ($old, $new) {
            $sections = $page->sections ?? [];
            $changed = false;

            array_walk_recursive($sections, function (&$value) use ($old, $new, &$changed) {
                if ($value === $old) {
                    $value = $new;
                    $changed = true;
                }
            });

            if ($changed) {
                $page->update(['sections' => $sections]);
            }
        });

        $site = app(Site::class);

        foreach (['logo', 'favicon'] as $key) {
            if ($site->get($key) === $old) {
                $site->put([$key => $new]);
            }
        }

        if ($meta = MediaMeta::query()->find($old)) {
            MediaMeta::query()->updateOrCreate(['path' => $new], ['alt' => $meta->alt]);
            $meta->delete();
        }

        Storage::disk('public')->delete($old);

        return $new;
    }

    /**
     * Delete a library image and what was written about it.
     */
    public function delete(string $path): void
    {
        Storage::disk('public')->delete($path);
        MediaMeta::query()->whereKey($path)->delete();
    }

    /**
     * Whether $path is an image directly in the library (never a template photo or a path outside it).
     */
    public function isLibraryPath(string $path): bool
    {
        return preg_match('#^'.self::DIR.'/[A-Za-z0-9._-]+$#', $path) === 1 && Storage::disk('public')->exists($path);
    }

    /**
     * Where each stored image is used: pages (of every template group) and settings, each with
     * the admin page to change it on.
     *
     * @return array<string, list<array{label: string, href: string}>>
     */
    public function usage(): array
    {
        $used = [];

        foreach (Page::allPresets()->get(['id', 'title', 'sections']) as $page) {
            $sections = $page->sections ?? [];
            array_walk_recursive($sections, function ($value) use (&$used, $page) {
                if (is_string($value) && str_starts_with($value, self::DIR.'/')) {
                    $used[$value][$page->title] = ['label' => $page->title, 'href' => route('pages.edit', $page->id)];
                }
            });
        }

        $site = app(Site::class);

        foreach (['logo' => 'Logo', 'favicon' => 'Favicon'] as $key => $label) {
            $path = $site->get($key);

            if (is_string($path) && $path !== '') {
                $used[$path][$label] = ['label' => $label, 'href' => route('site.edit')];
            }
        }

        return array_map(array_values(...), $used);
    }

    /**
     * A safe, readable file name from the upload's own name ("Foto Toko (1).JPG" → "foto-toko-1").
     */
    private function baseName(UploadedFile $file): string
    {
        $slug = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));

        return Str::limit($slug, 40, '') ?: 'gambar';
    }

    /**
     * The SVG without anything that runs or loads from elsewhere.
     */
    private function cleanSvg(string $svg, string $field): string
    {
        $sanitizer = new Sanitizer;
        $sanitizer->removeRemoteReferences(true);
        $clean = $sanitizer->sanitize($svg);

        if (! is_string($clean) || trim($clean) === '') {
            throw ValidationException::withMessages([$field => 'File SVG tidak bisa dibaca. Simpan ulang dari aplikasi desainnya lalu coba lagi.']);
        }

        return $clean;
    }

    /**
     * A JPEG/PNG/WebP/AVIF no larger than $maxSide, upright, with transparency kept: as WebP, or in
     * its own format with $webp off. An original already within size and smaller is kept as it is.
     *
     * @return array{0: string, 1: string} contents and extension
     */
    private function webSized(UploadedFile $file, int $maxSide, string $field, bool $webp): array
    {
        $original = (string) file_get_contents($file->getRealPath());
        $info = @getimagesizefromstring($original);

        if (! $info) {
            throw ValidationException::withMessages([$field => 'Gambar tidak bisa dibaca. Pilih file JPG, PNG, atau WebP lain.']);
        }

        if ($info[0] * $info[1] > self::MAX_PIXELS) {
            throw ValidationException::withMessages([$field => 'Resolusi gambar terlalu besar. Perkecil dulu hingga di bawah 40 megapiksel.']);
        }

        $image = @imagecreatefromstring($original);

        if ($image === false) {
            throw ValidationException::withMessages([$field => 'Gambar tidak bisa dibaca. Pilih file JPG, PNG, atau WebP lain.']);
        }

        $rotated = $this->upright($image, $file);
        $width = imagesx($image);
        $height = imagesy($image);
        $resized = max($width, $height) > $maxSide;

        if ($resized) {
            $scale = $maxSide / max($width, $height);
            $image = $this->resize($image, max(1, (int) round($width * $scale)), max(1, (int) round($height * $scale)));
        }

        imagepalettetotruecolor($image);
        imagealphablending($image, false);
        imagesavealpha($image, true);

        $ext = match ($info[2]) {
            IMAGETYPE_JPEG => 'jpg',
            IMAGETYPE_PNG => 'png',
            IMAGETYPE_WEBP => 'webp',
            default => null,
        };
        $format = $webp || $ext === null ? 'webp' : $ext;

        ob_start();
        match ($format) {
            'jpg' => imagejpeg($image, null, 85),
            'png' => imagepng($image, null, 9),
            default => imagewebp($image, null, self::QUALITY),
        };
        $encoded = (string) ob_get_clean();
        imagedestroy($image);

        $keepOriginal = ! $resized && ! $rotated && $ext !== null && strlen($original) <= strlen($encoded);

        return $keepOriginal ? [$original, $ext] : [$encoded, $format];
    }

    /**
     * Turn a phone photo the way its EXIF says it was held. Returns whether it was turned.
     */
    private function upright(\GdImage &$image, UploadedFile $file): bool
    {
        if (! function_exists('exif_read_data') || ! in_array($file->getMimeType(), ['image/jpeg', 'image/webp'], true)) {
            return false;
        }

        $exif = @exif_read_data($file->getRealPath());
        $angle = match ((int) ($exif['Orientation'] ?? 1)) {
            3 => 180,
            6 => -90,
            8 => 90,
            default => 0,
        };

        if ($angle === 0) {
            return false;
        }

        $turned = imagerotate($image, $angle, 0);

        if ($turned === false) {
            return false;
        }

        $image = $turned;

        return true;
    }

    /**
     * @param  int<1, max>  $width
     * @param  int<1, max>  $height
     */
    private function resize(\GdImage $image, int $width, int $height): \GdImage
    {
        $canvas = imagecreatetruecolor($width, $height);
        imagealphablending($canvas, false);
        imagesavealpha($canvas, true);
        imagefill($canvas, 0, 0, (int) imagecolorallocatealpha($canvas, 0, 0, 0, 127));
        imagecopyresampled($canvas, $image, 0, 0, 0, 0, $width, $height, imagesx($image), imagesy($image));

        return $canvas;
    }
}
