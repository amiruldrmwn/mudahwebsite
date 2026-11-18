<?php

namespace App\Http\Requests\Admin;

use App\Ai\AiCatalog;
use App\Support\Site;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class SiteSettingsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $url = ['nullable', 'string', 'url:http,https', 'max:255'];

        return [
            'site_name' => ['required', 'string', 'max:100'],
            'tagline' => ['nullable', 'string', 'max:150'],
            'description' => ['nullable', 'string', 'max:300'],
            'primary_color' => ['required', 'string', 'regex:/^#[0-9a-fA-F]{6}$/'],
            'logo' => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp,svg', 'max:2048'],
            'favicon' => ['nullable', 'image', 'mimes:png,ico,svg', 'max:512'],
            'remove_logo' => ['boolean'],
            'show_name' => ['nullable', 'in:yes,no'],
            'remove_favicon' => ['boolean'],
            'contact_email' => ['nullable', 'email', 'max:150'],
            'contact_phone' => ['nullable', 'string', 'max:30'],
            'whatsapp' => ['nullable', 'string', 'regex:/^[0-9+\s-]{6,20}$/'],
            'address' => ['nullable', 'string', 'max:500'],
            'maps_url' => $url,
            'show_map' => ['nullable', 'in:yes,no'],
            'maps_embed' => ['nullable', 'string', 'max:3000'],
            'google_verification' => ['nullable', 'string', 'max:255'],
            'ai_api_key' => ['nullable', 'string', 'max:500'],
            'ai_model' => ['nullable', 'string', 'max:100', function (string $attribute, mixed $value, \Closure $fail) {
                // One of the three choices, or the model already saved (picked before there were choices).
                $allowed = [...array_column(AiCatalog::TIERS, 'model'), (string) app(Site::class)->get('ai_model')];

                if (is_string($value) && $value !== '' && ! in_array($value, $allowed, true)) {
                    $fail('Pilih salah satu model AI yang tersedia.');
                }
            }],
            'remove_ai_key' => ['boolean'],
            'social_instagram' => $url,
            'social_facebook' => $url,
            'social_linkedin' => $url,
            'social_youtube' => $url,
            'social_tiktok' => $url,
            'social_x' => $url,
            'footer_text' => ['nullable', 'string', 'max:500'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'site_name' => 'nama perusahaan',
            'primary_color' => 'warna utama',
            'contact_email' => 'email',
            'contact_phone' => 'telepon',
            'maps_url' => 'link Google Maps',
            'maps_embed' => 'kode sematan peta',
            'google_verification' => 'kode verifikasi Google',
            'ai_api_key' => 'API key AI',
            'ai_model' => 'model AI',
            'footer_text' => 'teks footer',
            'social_instagram' => 'link Instagram',
            'social_facebook' => 'link Facebook',
            'social_linkedin' => 'link LinkedIn',
            'social_youtube' => 'link YouTube',
            'social_tiktok' => 'link TikTok',
            'social_x' => 'link X',
            'whatsapp' => 'nomor WhatsApp',
            'address' => 'alamat',
            'description' => 'deskripsi',
        ];
    }
}
