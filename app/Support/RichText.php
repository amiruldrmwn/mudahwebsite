<?php

namespace App\Support;

use Symfony\Component\HtmlSanitizer\HtmlSanitizer;
use Symfony\Component\HtmlSanitizer\HtmlSanitizerAction;
use Symfony\Component\HtmlSanitizer\HtmlSanitizerConfig;
use Symfony\Component\HtmlSanitizer\Visitor\AttributeSanitizer\AttributeSanitizerInterface;

/**
 * HTML written in the blog editor, cleaned to an allow-list before it is stored.
 *
 * Kept: headings, paragraphs, lists, quotes, links (http, https, mailto, tel and site paths),
 * images from the site's own /storage/ or https, tables, code, and YouTube embeds. Dropped:
 * scripts, styles (except text alignment), event attributes, forms, other iframes, and
 * javascript: or data: addresses. Elements not on the list are unwrapped, keeping their text.
 */
class RichText implements AttributeSanitizerInterface
{
    private const YOUTUBE = '#^https://(www\.)?(youtube\.com|youtube-nocookie\.com)/embed/[A-Za-z0-9_-]{6,20}(\?[A-Za-z0-9_=&;.-]*)?$#';

    private const MAX_LENGTH = 1_000_000;

    public static function clean(?string $html): string
    {
        $html = trim((string) $html);

        if ($html === '') {
            return '';
        }

        // Images inserted with the site's full address are kept as /storage/... so a domain change keeps them.
        $html = str_replace(rtrim(url('/'), '/').'/storage/', '/storage/', $html);
        // Code and styles go with their contents; an h1 belongs to the post's title, so one in the body becomes an h2.
        $html = (string) preg_replace('#<(script|style)\b[^>]*>.*?</\1\s*>#is', '', $html);
        $html = (string) preg_replace('#<(/?)h1\b#i', '<$1h2', $html);

        $clean = (new HtmlSanitizer(self::config()))->sanitize($html);

        // Images and embeds that lost their address to the rules above are dropped altogether.
        $clean = (string) preg_replace('#<img\b(?![^>]*\ssrc=")[^>]*>#i', '', $clean);
        $clean = (string) preg_replace('#(<img\b[^>]*\s)alt(?=[\s/>])#i', '$1alt=""', $clean);
        $clean = (string) preg_replace('#<iframe\b(?![^>]*\ssrc=")[^>]*>\s*</iframe>#i', '', $clean);

        // A link opening a new tab never gets a handle on this page.
        $clean = (string) preg_replace_callback('#<a\b[^>]*\starget="_blank"[^>]*>#i', function (array $m) {
            if (preg_match('#\srel="([^"]*)"#i', $m[0], $rel)) {
                return str_contains($rel[1], 'noopener') ? $m[0] : str_replace($rel[0], ' rel="'.trim($rel[1].' noopener').'"', $m[0]);
            }

            return substr($m[0], 0, -1).' rel="noopener">';
        }, $clean);

        // Empty paragraphs the editor leaves at the start and end.
        return trim((string) preg_replace(['#^(\s*<p>\s*</p>)+#', '#(<p>\s*</p>\s*)+$#'], '', $clean));
    }

    /**
     * The words of the HTML, for counts, reading time and excerpts.
     */
    public static function text(?string $html): string
    {
        $html = (string) preg_replace('#<(br|/p|/h[1-6]|/li|/blockquote|/td|/th|/tr)\b[^>]*>#i', '$0 ', (string) $html);

        return trim((string) preg_replace('/\s+/u', ' ', html_entity_decode(strip_tags($html), ENT_QUOTES | ENT_HTML5)));
    }

    public static function words(?string $html): int
    {
        $text = self::text($html);

        return $text === '' ? 0 : count(preg_split('/\s+/u', $text) ?: []);
    }

    private static function config(): HtmlSanitizerConfig
    {
        $config = (new HtmlSanitizerConfig)
            ->defaultAction(HtmlSanitizerAction::Block)
            ->withMaxInputLength(self::MAX_LENGTH)
            ->allowLinkSchemes(['http', 'https', 'mailto', 'tel'])
            ->allowRelativeLinks()
            ->allowMediaSchemes(['https'])
            ->allowRelativeMedias()
            ->withAttributeSanitizer(new self);

        foreach (['script', 'style', 'noscript', 'template', 'object', 'embed', 'applet', 'form', 'input', 'button', 'select', 'textarea', 'svg', 'math', 'video', 'audio', 'canvas', 'head', 'title', 'meta', 'link', 'base', 'frame', 'frameset'] as $element) {
            $config = $config->dropElement($element);
        }

        $aligned = ['style'];
        $elements = [
            'p' => $aligned, 'h2' => $aligned, 'h3' => $aligned, 'h4' => $aligned,
            'br' => [], 'hr' => [],
            'strong' => [], 'b' => [], 'em' => [], 'i' => [], 'u' => [], 's' => [], 'del' => [], 'mark' => [], 'sub' => [], 'sup' => [],
            'code' => [], 'pre' => [],
            'ul' => [], 'ol' => ['start'], 'li' => [],
            'blockquote' => [],
            'a' => ['href', 'title', 'target', 'rel'],
            'img' => ['src', 'alt', 'title', 'width', 'height'],
            'figure' => [], 'figcaption' => [],
            'table' => [], 'thead' => [], 'tbody' => [], 'tfoot' => [], 'tr' => [], 'caption' => [],
            'th' => ['colspan', 'rowspan', 'style'], 'td' => ['colspan', 'rowspan', 'style'],
            'div' => ['data-youtube-video'],
            'iframe' => ['src', 'width', 'height', 'allowfullscreen', 'title', 'allow', 'frameborder'],
        ];

        foreach ($elements as $element => $attributes) {
            $config = $config->allowElement($element, $attributes);
        }

        return $config;
    }

    public function getSupportedElements(): ?array
    {
        return null;
    }

    public function getSupportedAttributes(): ?array
    {
        return ['src', 'style', 'target', 'rel', 'width', 'height', 'colspan', 'rowspan', 'start', 'allow', 'allowfullscreen', 'frameborder', 'data-youtube-video'];
    }

    public function sanitizeAttribute(string $element, string $attribute, string $value, HtmlSanitizerConfig $config): ?string
    {
        return match ($attribute) {
            'src' => match ($element) {
                'img' => str_starts_with($value, 'https://') || preg_match('#^/storage/[A-Za-z0-9/_.%-]+$#', $value) ? $value : null,
                'iframe' => preg_match(self::YOUTUBE, $value) ? $value : null,
                default => null,
            },
            // Only the alignment the editor sets.
            'style' => preg_match('/text-align:\s*(left|center|right|justify)/i', $value, $m) ? 'text-align: '.strtolower($m[1]) : null,
            'target' => $value === '_blank' ? '_blank' : null,
            'rel' => implode(' ', array_intersect(preg_split('/\s+/', strtolower($value)) ?: [], ['noopener', 'noreferrer', 'nofollow', 'ugc', 'sponsored'])) ?: null,
            'width', 'height', 'colspan', 'rowspan', 'start' => preg_match('/^\d{1,4}$/', $value) ? $value : null,
            'allow' => $element === 'iframe' ? 'accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share' : null,
            'allowfullscreen' => $element === 'iframe' ? 'true' : null,
            'frameborder' => $element === 'iframe' ? '0' : null,
            'data-youtube-video' => '',
            default => $value,
        };
    }
}
