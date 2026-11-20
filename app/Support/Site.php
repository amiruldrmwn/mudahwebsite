<?php

namespace App\Support;

use App\Models\Setting;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
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
        // Show the site name next to the logo in the header and footer ('no' = logo only).
        'show_name' => 'yes',
        'favicon' => null,
        'contact_email' => '',
        'contact_phone' => '',
        'whatsapp' => '',
        'address' => '',
        'maps_url' => '',
        // Embedded map on the contact section: Google's "embed a map" code, else the address.
        'show_map' => 'yes',
        'maps_embed' => '',
        // Google Search Console ownership code, printed as a meta tag.
        'google_verification' => '',
        // AI assistant on MudahCloud AI. The key is stored encrypted.
        'ai_api_key' => '',
        'ai_model' => '',
        // Set once the owner picks a template, for the dashboard's getting-started steps.
        'theme_chosen' => false,
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
        'color_umroh' => null,
        'color_ac' => null,
        'color_legal' => null,
        'color_kopi' => null,
        'color_barber' => null,
        'color_tambang' => null,
        'color_rental' => null,
        'color_motor' => null,
        'color_properti' => null,
        'color_resto' => null,
        'color_gigi' => null,
        'color_kecantikan' => null,
        'color_villa' => null,
        'color_hijab' => null,
        'color_kaos' => null,
        'color_mobil' => null,
        'color_biolink' => null,
        'color_laundry' => null,
        'color_sepatu' => null,
        'color_lawfirm' => null,
        'color_pesantren' => null,
        'color_cleaning' => null,
        'color_satpam' => null,
        'color_biolink3' => null,
        'color_masjid' => null,
        'color_gym' => null,
        'color_klinik' => null,
        'color_bangunan' => null,
        'color_percetakan' => null,
        'color_eo' => null,
        'color_desa' => null,
        'color_cv' => null,
        'color_travel' => null,
        'color_kontraktor' => null,
        'color_umkm' => null,
        'color_lpk' => null,
        'color_ekspedisi' => null,
        'color_desa2' => null,
        'color_servis' => null,
        'color_paud' => null,
        'color_gereja' => null,
        'color_koperasi' => null,
        'color_caleg' => null,
        'color_bidan' => null,
        'color_optik' => null,
        'color_emas' => null,
        'color_oleholeh' => null,
        'color_kos' => null,
        'color_lapangan' => null,
        'color_cucimobil' => null,
        'color_interior' => null,
        'color_agency' => null,
        'color_pajak' => null,
        'color_tani' => null,
        'color_instansi' => null,
        'color_catering' => null,
        'color_bengkel' => null,
        'color_foto' => null,
        'color_wedding' => null,
        'color_bimbel' => null,
        'color_apotek' => null,
        'color_petshop' => null,
        'color_biolink2' => null,
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
    /**
     * The map shown on contact sections: the src of Google's embed code when given, else a
     * map searched from the address. Null when the map is off or there is nothing to show.
     */
    public function mapEmbedUrl(): ?string
    {
        if ($this->get('show_map') === 'no') {
            return null;
        }

        if (preg_match('#https://www\.google\.com/maps/embed\?[^"\'\s<>]+#', (string) $this->get('maps_embed'), $m)) {
            return html_entity_decode($m[0]);
        }

        $address = trim((string) $this->get('address'));

        return $address === '' ? null : 'https://maps.google.com/maps?q='.rawurlencode($address).'&z=15&output=embed';
    }

    /**
     * The Search Console code, from either the bare code or the whole meta tag.
     */
    public function googleVerification(): ?string
    {
        $value = (string) $this->get('google_verification');

        if (preg_match('/content=["\']([^"\']+)["\']/', $value, $m)) {
            $value = $m[1];
        }

        $value = preg_replace('/[^A-Za-z0-9_-]/', '', $value) ?? '';

        return $value === '' ? null : $value;
    }

    /**
     * The AI API key in plain text, or null when none is saved or it can't be decrypted
     * (for example after APP_KEY changed).
     */
    public function aiApiKey(): ?string
    {
        $stored = (string) $this->get('ai_api_key');

        if ($stored === '') {
            return null;
        }

        try {
            return Crypt::decryptString($stored);
        } catch (DecryptException) {
            return null;
        }
    }

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
