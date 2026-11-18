<?php

namespace App\Support;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

/**
 * The website's own settings (identity, contact, social links, footer), kept in the settings
 * table and cached as one array. Unset keys fall back to DEFAULTS.
 */
class Site
{
    private const CACHE_KEY = 'site.settings';

    public const DEFAULTS = [
        'site_name' => null,
        'theme' => 'korporat',
        'tagline' => '',
        'description' => '',
        'primary_color' => '#2563eb',
        'logo' => null,
        'favicon' => null,
        'contact_email' => '',
        'contact_phone' => '',
        'whatsapp' => '',
        'address' => '',
        'maps_url' => '',
        'social_instagram' => '',
        'social_facebook' => '',
        'social_linkedin' => '',
        'social_youtube' => '',
        'social_tiktok' => '',
        'social_x' => '',
        'footer_text' => '',
        // Brand colour last used with each template group, restored when switching back.
        'color_korporat' => null,
        'color_spa' => null,
        'color_kue' => null,
        'color_sekolah' => null,
        'color_sma' => null,
    ];

    public const SOCIALS = ['instagram', 'facebook', 'linkedin', 'youtube', 'tiktok', 'x'];

    /** @var array<string, mixed>|null */
    private ?array $values = null;

    /**
     * @return array<string, mixed>
     */
    public function all(): array
    {
        if ($this->values === null) {
            $stored = Cache::rememberForever(self::CACHE_KEY, fn () => Schema::hasTable('settings')
                ? Setting::query()->pluck('value', 'key')->all()
                : []);

            $this->values = [...self::DEFAULTS, ...array_intersect_key($stored, self::DEFAULTS)];
            $this->values['site_name'] ??= config('app.name');
        }

        return $this->values;
    }

    public function get(string $key, mixed $default = null): mixed
    {
        return $this->all()[$key] ?? $default;
    }

    /**
     * @param  array<string, mixed>  $values
     */
    public function put(array $values): void
    {
        foreach (array_intersect_key($values, self::DEFAULTS) as $key => $value) {
            Setting::query()->updateOrCreate(['key' => $key], ['value' => $value]);
        }

        Cache::forget(self::CACHE_KEY);
        $this->values = null;
    }

    /**
     * Public address of an uploaded file setting (logo, favicon), or null when there is none.
     */
    public function url(string $key): ?string
    {
        $path = $this->get($key);

        return is_string($path) && $path !== '' ? Storage::disk('public')->url($path) : null;
    }

    /**
     * Public address of an uploaded image path (from a section), or null when it is empty.
     */
    public function image(?string $path): ?string
    {
        return $path ? Storage::disk('public')->url($path) : null;
    }

    /**
     * Black or white, whichever reads better on the brand colour.
     */
    public function onBrand(?string $color = null): string
    {
        $hex = ltrim($color ?? (string) $this->get('primary_color'), '#');

        if (! preg_match('/^[0-9a-f]{6}$/i', $hex)) {
            return '#ffffff';
        }

        [$r, $g, $b] = array_map(fn (string $c) => hexdec($c) / 255, str_split($hex, 2));
        $lum = fn (float $c) => $c <= 0.03928 ? $c / 12.92 : (($c + 0.055) / 1.055) ** 2.4;
        $l = 0.2126 * $lum($r) + 0.7152 * $lum($g) + 0.0722 * $lum($b);

        return $l > 0.45 ? '#0f172a' : '#ffffff';
    }

    /**
     * wa.me link for the WhatsApp number, or null.
     */
    public function whatsappUrl(?string $text = null): ?string
    {
        $number = preg_replace('/\D/', '', (string) $this->get('whatsapp'));

        if ($number === '') {
            return null;
        }

        if (str_starts_with($number, '0')) {
            $number = '62'.substr($number, 1);
        }

        return 'https://wa.me/'.$number.($text ? '?text='.rawurlencode($text) : '');
    }

    /**
     * Filled social links, keyed by network.
     *
     * @return array<string, string>
     */
    public function socials(): array
    {
        return collect(self::SOCIALS)
            ->mapWithKeys(fn (string $network) => [$network => (string) $this->get("social_{$network}")])
            ->filter()
            ->all();
    }
}
