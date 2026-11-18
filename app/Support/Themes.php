<?php

namespace App\Support;

/**
 * The website templates. Each has its own header, footer, hero and look (resources/views/site
 * and resources/css/site.css); every other section is shared and styled by the theme.
 */
class Themes
{
    public const DEFAULT = 'korporat';

    /**
     * preset: which sample content (DefaultContent) suits the template; color: its suggested
     * brand colour, applied together with that sample content.
     *
     * @return array<string, array{label: string, description: string, fonts: string, preset: string, color: string}>
     */
    public static function all(): array
    {
        return [
            'korporat' => [
                'label' => 'Korporat',
                'description' => 'Rapi dan meyakinkan: header dengan info kontak, hero berwarna penuh, kartu bergaris. Cocok untuk kontraktor, konsultan, dan industri.',
                'fonts' => 'inter:400,500,600,700',
                'preset' => 'korporat',
                'color' => '#2563eb',
            ],
            'modern' => [
                'label' => 'Modern',
                'description' => 'Segar dan berani: gradasi warna, sudut membulat, huruf tebal. Cocok untuk startup, agensi, dan teknologi.',
                'fonts' => 'plus-jakarta-sans:400,500,600,700,800',
                'preset' => 'korporat',
                'color' => '#7c3aed',
            ],
            'minimalis' => [
                'label' => 'Minimalis',
                'description' => 'Elegan dan lapang: huruf serif untuk judul, banyak ruang kosong, garis tipis. Cocok untuk arsitek, butik, dan firma hukum.',
                'fonts' => 'fraunces:400,600|inter:400,500',
                'preset' => 'korporat',
                'color' => '#1c1917',
            ],
            'spa' => [
                'label' => 'Spa',
                'description' => 'Mewah dan menenangkan: latar gelap, aksen emas, huruf serif klasik, daftar harga perawatan. Cocok untuk spa, salon, pijat, dan klinik kecantikan.',
                'fonts' => 'cormorant-garamond:400,500,600,400i|jost:300,400,500',
                'preset' => 'spa',
                'color' => '#c9a45c',
            ],
            'kue' => [
                'label' => 'Kue & Bakery',
                'description' => 'Hangat dan menggugah selera: warna krem dan cokelat, sudut membulat, kartu produk dengan harga dan tombol pesan. Cocok untuk toko kue, bakery, kafe, dan kuliner.',
                'fonts' => 'playfair-display:500,600,700,500i,600i|nunito:400,600,700,800',
                'preset' => 'kue',
                'color' => '#5b3423',
            ],
            'sekolah' => [
                'label' => 'Sekolah',
                'description' => 'Ceria dan tepercaya: putih bersih dengan aksen merah, judul serif, sambutan kepala sekolah, guru, berita, dan info pendaftaran siswa baru. Cocok untuk SD, SMP, SMA, TK, dan lembaga kursus.',
                'fonts' => 'dm-serif-display:400,400i|plus-jakarta-sans:400,500,600,700',
                'preset' => 'sekolah',
                'color' => '#b3261e',
            ],
            'umroh' => [
                'label' => 'Travel Umroh',
                'description' => 'Elegan dan menenangkan: biru navy dengan aksen emas, kartu paket lengkap (tanggal, maskapai, hotel, harga), program haji, jadwal keberangkatan, dan testimoni jamaah. Cocok untuk travel umroh, haji, dan wisata halal.',
                'fonts' => 'manrope:400,500,600,700,800',
                'preset' => 'umroh',
                'color' => '#1f2b4d',
            ],
            'ac' => [
                'label' => 'Jasa AC & Servis',
                'description' => 'Segar dan sigap: gradasi biru es, info darurat di atas, tabel harga jelas, alur pesan, dan area layanan. Cocok untuk jasa AC, servis elektronik, plumbing, dan teknisi panggilan.',
                'fonts' => 'sora:400,500,600,700',
                'preset' => 'ac',
                'color' => '#0369a1',
            ],
            'legal' => [
                'label' => 'Jasa Legal & Perizinan',
                'description' => 'Tepercaya dan modern: biru royal dengan aksen oranye, ringkasan syarat dan dokumen, alur 3 langkah, paket harga bertingkat, dan tim konsultan. Cocok untuk jasa pendirian PT/CV, perizinan, notaris, konsultan pajak, dan agensi.',
                'fonts' => 'onest:400,500,600,700,800',
                'preset' => 'legal',
                'color' => '#3048e8',
            ],
            'kopi' => [
                'label' => 'Coffee Shop',
                'description' => 'Segar dan kekinian: krem dengan hijau hutan, judul besar membulat, tulisan berjalan, menu minuman bergambar, dan lokasi gerai. Cocok untuk coffee shop, kafe, kedai teh, dan minuman kekinian.',
                'fonts' => 'poppins:400,500,600,700,800',
                'preset' => 'kopi',
                'color' => '#1f5c3d',
            ],
            'barber' => [
                'label' => 'Barbershop',
                'description' => 'Maskulin dan tegas: latar gelap, huruf kondensed besar, garis tiang barber, daftar harga gaya "65K", dan tim barber. Cocok untuk barbershop, salon pria, dan studio tato.',
                'fonts' => 'bebas-neue:400|inter:400,500,600',
                'preset' => 'barber',
                'color' => '#d32f2f',
            ],
            'sma' => [
                'label' => 'SMP & SMA',
                'description' => 'Modern dan berwibawa: hitam-putih elegan, foto besar, judul serif, program unggulan berlatar gelap, guru, berita, dan info PPDB. Cocok untuk SMP, SMA, SMK, dan madrasah.',
                'fonts' => 'instrument-serif:400,400i|inter:400,500,600',
                'preset' => 'sma',
                'color' => '#18181b',
            ],
        ];
    }

    public static function has(?string $theme): bool
    {
        return is_string($theme) && array_key_exists($theme, self::all());
    }

    public static function current(Site $site): string
    {
        $theme = $site->get('theme');

        return self::has($theme) ? $theme : self::DEFAULT;
    }

    /**
     * The page group of the template in use: its pages are the ones the site shows and edits.
     */
    public static function currentPreset(): string
    {
        return self::all()[self::current(app(Site::class))]['preset'];
    }

    /**
     * fonts.bunny.net stylesheet for a theme (privacy-friendly Google Fonts mirror).
     */
    public static function fontsUrl(string $theme): string
    {
        return 'https://fonts.bunny.net/css?family='.self::all()[$theme]['fonts'].'&display=swap';
    }
}
