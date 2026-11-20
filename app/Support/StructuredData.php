<?php

namespace App\Support;

use App\Models\Page;

/**
 * schema.org data (JSON-LD) for Google: who the site belongs to, from its settings, typed by
 * template (a clinic is a MedicalClinic, a bakery a Bakery); a breadcrumb on inner pages; and
 * the questions of FAQ sections, so results can show more than a title and a line.
 */
class StructuredData
{
    /** schema.org type per template; others follow their category (TYPE_BY_CATEGORY). */
    private const TYPE_BY_THEME = [
        'resto' => 'Restaurant', 'catering' => 'Restaurant', 'kopi' => 'CafeOrCoffeeShop', 'kue' => 'Bakery', 'oleholeh' => 'Store',
        'hijab' => 'ClothingStore', 'kaos' => 'ClothingStore', 'apotek' => 'Pharmacy', 'petshop' => 'PetStore', 'bangunan' => 'HardwareStore', 'emas' => 'JewelryStore',
        'klinik' => 'MedicalClinic', 'bidan' => 'MedicalClinic', 'optik' => 'Optician', 'gigi' => 'Dentist', 'kecantikan' => 'BeautySalon', 'spa' => 'DaySpa', 'barber' => 'HairSalon', 'gym' => 'ExerciseGym',
        'mobil' => 'AutoDealer', 'rental' => 'AutoRental', 'motor' => 'AutoRental', 'bengkel' => 'AutoRepair', 'cucimobil' => 'AutoWash',
        'ac' => 'HVACBusiness', 'laundry' => 'DryCleaningOrLaundry', 'kontraktor' => 'GeneralContractor', 'interior' => 'HomeAndConstructionBusiness', 'lapangan' => 'SportsActivityLocation', 'foto' => 'ProfessionalService',
        'legal' => 'LegalService', 'lawfirm' => 'LegalService', 'pajak' => 'AccountingService', 'agency' => 'ProfessionalService',
        'paud' => 'Preschool', 'sekolah' => 'School', 'sma' => 'HighSchool', 'pesantren' => 'School',
        'properti' => 'RealEstateAgent', 'kos' => 'LodgingBusiness', 'villa' => 'LodgingBusiness', 'umroh' => 'TravelAgency', 'travel' => 'TravelAgency',
        'masjid' => 'Mosque', 'gereja' => 'Church', 'desa' => 'GovernmentOrganization', 'desa2' => 'GovernmentOrganization', 'instansi' => 'GovernmentOrganization',
    ];

    private const TYPE_BY_CATEGORY = [
        'bisnis' => 'Organization',
        'pendidikan' => 'EducationalOrganization',
        'personal' => 'Person',
        'komunitas' => 'Organization',
    ];

    /** Types that aren't a place of business: no address-based business fields. */
    private const NOT_A_BUSINESS = ['Organization', 'EducationalOrganization', 'GovernmentOrganization', 'Person'];

    /**
     * The JSON-LD blocks for a page (null page: a page that isn't built from sections).
     *
     * @return list<array<string, mixed>>
     */
    public static function for(Site $site, ?Page $page, string $theme): array
    {
        $home = url('/');
        $owner = self::owner($site, $theme, $home);
        $blocks = [$owner];

        if ($page === null || $page->is_home) {
            $blocks[] = ['@context' => 'https://schema.org', '@type' => 'WebSite', 'name' => $site->get('site_name'), 'url' => $home];
        } else {
            $blocks[] = ['@context' => 'https://schema.org', '@type' => 'BreadcrumbList', 'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'Beranda', 'item' => $home],
                ['@type' => 'ListItem', 'position' => 2, 'name' => $page->title, 'item' => url()->current()],
            ]];
        }

        $questions = [];

        foreach ($page->sections ?? [] as $section) {
            foreach ($section['type'] === 'faq' ? (array) ($section['data']['items'] ?? []) : [] as $q) {
                if (is_array($q) && filled($q['question'] ?? null) && filled($q['answer'] ?? null)) {
                    $questions[] = ['@type' => 'Question', 'name' => $q['question'], 'acceptedAnswer' => ['@type' => 'Answer', 'text' => $q['answer']]];
                }
            }
        }

        if ($questions !== []) {
            $blocks[] = ['@context' => 'https://schema.org', '@type' => 'FAQPage', 'mainEntity' => $questions];
        }

        return $blocks;
    }

    /**
     * The blocks as <script> tags, safe inside HTML.
     *
     * @param  list<array<string, mixed>>  $blocks
     */
    public static function render(array $blocks): string
    {
        return collect($blocks)
            ->map(fn (array $b) => '<script type="application/ld+json">'.json_encode($b, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP).'</script>')
            ->implode("\n    ");
    }

    public static function typeOf(string $theme): string
    {
        return self::TYPE_BY_THEME[$theme] ?? self::TYPE_BY_CATEGORY[Themes::categoryOf($theme)] ?? 'LocalBusiness';
    }

    /**
     * @return array<string, mixed>
     */
    private static function owner(Site $site, string $theme, string $home): array
    {
        $type = self::typeOf($theme);
        $logo = $site->url('logo');
        $address = trim((string) $site->get('address'));

        $data = [
            '@context' => 'https://schema.org',
            '@type' => $type,
            '@id' => $home.'#owner',
            'name' => $site->get('site_name'),
            'url' => $home,
            'description' => $site->get('description') ?: $site->get('tagline'),
            $type === 'Person' ? 'image' : 'logo' => $logo,
            'telephone' => $site->get('contact_phone') ?: $site->get('whatsapp'),
            'email' => $site->get('contact_email'),
            'address' => $address !== '' && $type !== 'Person'
                ? ['@type' => 'PostalAddress', 'streetAddress' => preg_replace('/\s*\n\s*/', ', ', $address), 'addressCountry' => 'ID']
                : null,
            'sameAs' => array_values(array_filter(array_map(
                fn (string $key) => $site->get($key),
                ['social_instagram', 'social_facebook', 'social_linkedin', 'social_youtube', 'social_tiktok', 'social_x'],
            ))),
        ];

        if (! in_array($type, self::NOT_A_BUSINESS, true)) {
            $data['image'] = $logo;
            $data['hasMap'] = $site->get('maps_url');
        }

        return array_filter($data, fn ($v) => $v !== null && $v !== '' && $v !== []);
    }
}
