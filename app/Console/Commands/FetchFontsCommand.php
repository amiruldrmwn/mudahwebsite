<?php

namespace App\Console\Commands;

use App\Support\Themes;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;

#[Signature('compro:fonts')]
#[Description('Download every template\'s fonts into public/fonts, so sites serve them themselves (run when the image is built)')]
class FetchFontsCommand extends Command
{
    /** Indonesian text needs no more than these. */
    private const SUBSETS = ['latin', 'latin-ext'];

    public function handle(): int
    {
        $files = public_path(Themes::FONTS_DIR.'/files');
        File::ensureDirectoryExists($files);
        $fetched = 0;

        foreach (array_keys(Themes::all()) as $theme) {
            $css = Http::retry(3, 500)->timeout(30)->get(Themes::remoteFontsUrl($theme))->throw()->body();
            $faces = [];

            // One block per family, weight, style and subset: "/* latin */ @font-face { ... }".
            preg_match_all('#/\* ([a-z-]+) \*/\s*(@font-face \{.*?\})#s', $css, $blocks, PREG_SET_ORDER);

            foreach ($blocks as [, $subset, $face]) {
                if (! in_array($subset, self::SUBSETS, true) || ! preg_match('#url\((https://fonts\.bunny\.net/[^)]+\.woff2)\)#', $face, $url)) {
                    continue;
                }

                $name = basename($url[1]);

                if (! is_file("{$files}/{$name}")) {
                    File::put("{$files}/{$name}", Http::retry(3, 500)->timeout(30)->get($url[1])->throw()->body());
                    $fetched++;
                }

                $faces[] = (string) preg_replace('#src: [^;]+;#', 'src: url(/'.Themes::FONTS_DIR."/files/{$name}) format('woff2');", $face);
            }

            File::put(public_path(Themes::FONTS_DIR."/{$theme}.css"), implode("\n", $faces)."\n");
        }

        $this->components->info(count(Themes::all())." templates, {$fetched} font files downloaded.");

        return self::SUCCESS;
    }
}
