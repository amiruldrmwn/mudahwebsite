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
            'tambang' => [
                'label' => 'Pertambangan & Energi',
                'description' => 'Kokoh dan berwibawa: crimson dan arang, garis pengaman kuning-hitam, panel angka kinerja, lokasi tambang, keberlanjutan, dan direksi. Cocok untuk perusahaan tambang, energi, migas, kontraktor alat berat, dan industri.',
                'fonts' => 'archivo:400,500,600,700,800',
                'preset' => 'tambang',
                'color' => '#b91c1c',
            ],
            'rental' => [
                'label' => 'Rental Mobil',
                'description' => 'Sigap dan tepercaya: biru navy dengan aksen kuning, katalog armada lengkap dengan harga per hari, pilihan lepas kunci atau dengan sopir. Cocok untuk rental mobil, travel, dan sewa bus.',
                'fonts' => 'outfit:400,500,600,700,800',
                'preset' => 'rental',
                'color' => '#0f2a5f',
            ],
            'motor' => [
                'label' => 'Rental Motor',
                'description' => 'Santai dan tropis: nuansa krem dan jingga senja, foto besar, kotak booking langsung ke WhatsApp, katalog motor dengan harga per hari. Cocok untuk rental motor wisata, sewa skuter, dan sewa sepeda.',
                'fonts' => 'outfit:400,500,600,700,800',
                'preset' => 'motor',
                'color' => '#f05a28',
            ],
            'properti' => [
                'label' => 'Properti & Perumahan',
                'description' => 'Mewah dan meyakinkan: hijau toska dengan sentuhan emas, judul serif, tipe rumah dengan spesifikasi, fasilitas, dan kalkulator cicilan KPR. Cocok untuk developer perumahan, apartemen, dan agen properti.',
                'fonts' => 'prata:400|dm-sans:400,500,600,700',
                'preset' => 'properti',
                'color' => '#0f4c5c',
            ],
            'resto' => [
                'label' => 'Restoran & Rumah Makan',
                'description' => 'Hangat dan menggugah selera: terakota dan krem, foto lengkung, menu bergambar per kategori, reservasi, dan cabang. Cocok untuk restoran, rumah makan, warung, dan katering.',
                'fonts' => 'young-serif:400|karla:400,500,600,700',
                'preset' => 'resto',
                'color' => '#c2410c',
            ],
            'gigi' => [
                'label' => 'Klinik Gigi',
                'description' => 'Bersih dan menenangkan: hijau mint, sudut sangat membulat, layanan dan harga, profil dokter, jadwal praktik, dan booking. Cocok untuk klinik gigi, klinik umum, dan praktik dokter.',
                'fonts' => 'lexend:300,400,500,600,700',
                'preset' => 'gigi',
                'color' => '#0d9488',
            ],
            'kecantikan' => [
                'label' => 'Klinik Kecantikan',
                'description' => 'Anggun dan feminin: merah muda lembut, huruf serif klasik, foto lengkung, treatment dan harga, dokter, serta hasil perawatan. Cocok untuk klinik kecantikan, skincare, salon, dan nail art.',
                'fonts' => 'bodoni-moda:400,500,400i|raleway:400,500,600',
                'preset' => 'kecantikan',
                'color' => '#b4537a',
            ],
            'villa' => [
                'label' => 'Villa & Penginapan',
                'description' => 'Tenang dan eksklusif: nuansa pasir dan kayu, foto besar, tipe kamar dengan harga per malam, fasilitas, dan galeri. Cocok untuk villa, guest house, homestay, dan resort kecil.',
                'fonts' => 'gilda-display:400|mulish:400,500,600,700',
                'preset' => 'villa',
                'color' => '#8a6a46',
            ],
            'hijab' => [
                'label' => 'Hijab & Fashion Muslim',
                'description' => 'Lembut dan elegan: warna krem dan terakota, logo di tengah, huruf serif tipis, kategori bulat, kartu produk dengan diskon, dan lookbook. Cocok untuk toko hijab, busana muslim, dan butik.',
                'fonts' => 'italiana:400|work-sans:300,400,500',
                'preset' => 'hijab',
                'color' => '#a4532f',
            ],
            'kaos' => [
                'label' => 'Jualan Kaos & Konveksi',
                'description' => 'Tegas dan energik: huruf tebal kapital, ubin kategori, kartu produk dengan warna dan ukuran, harga cetak, serta cara order custom. Cocok untuk toko kaos, sablon, konveksi, dan merchandise.',
                'fonts' => 'archivo:500,700,800,900|dm-sans:400,500,700',
                'preset' => 'kaos',
                'color' => '#e4572e',
            ],
            'mobil' => [
                'label' => 'Sales Mobil & Dealer',
                'description' => 'Bersih dan modern ala showroom: latar terang, foto mobil lebar, filter tipe mobil, tombol tanya promo dan test drive, serta simulasi kredit. Cocok untuk dealer mobil, sales mobil, showroom, dan mobil bekas.',
                'fonts' => 'manrope:400,500,600,700,800',
                'preset' => 'mobil',
                'color' => '#1d4ed8',
            ],
            'biolink' => [
                'label' => 'Bio Link',
                'description' => 'Satu kartu ringkas ala link in bio: foto profil, angka pencapaian, tombol link bertumpuk, produk unggulan, dan ulasan. Cocok untuk kreator, influencer, freelancer, dan personal brand.',
                'fonts' => 'plus-jakarta-sans:400,500,600,700,800',
                'preset' => 'biolink',
                'color' => '#6d28d9',
            ],
            'laundry' => [
                'label' => 'Laundry',
                'description' => 'Segar dan bersih: biru langit, sudut membulat, daftar harga per kilo, cara pesan antar jemput. Cocok untuk laundry kiloan, dry clean, dan cuci sepatu.',
                'fonts' => 'nunito:400,600,700,800',
                'preset' => 'laundry',
                'color' => '#0284c7',
            ],
            'catering' => [
                'label' => 'Catering',
                'description' => 'Hangat dan menggugah selera: foto makanan besar, judul serif, menu dengan harga, paket acara. Cocok untuk katering, nasi box, tumpeng, dan prasmanan.',
                'fonts' => 'fraunces:500,600,700|dm-sans:400,500,700',
                'preset' => 'catering',
                'color' => '#b45309',
            ],
            'bengkel' => [
                'label' => 'Bengkel Mobil & Motor',
                'description' => 'Tangguh dan meyakinkan: latar gelap, aksen kuning, huruf tegas kapital, layanan dan harga jasa. Cocok untuk bengkel mobil, bengkel motor, dan servis AC mobil.',
                'fonts' => 'oswald:500,600,700|inter:400,500,600',
                'preset' => 'bengkel',
                'color' => '#facc15',
            ],
            'foto' => [
                'label' => 'Fotografer',
                'description' => 'Elegan dan sinematik: foto penuh layar, huruf serif besar, portofolio bergaya masonry, paket foto. Cocok untuk fotografer, videografer, dan studio foto.',
                'fonts' => 'dm-serif-display:400,400i|inter:400,500,600',
                'preset' => 'foto',
                'color' => '#111111',
            ],
            'wedding' => [
                'label' => 'Wedding Organizer',
                'description' => 'Romantis dan anggun: warna blush dan emas, tulisan sambung, foto lengkung, paket pernikahan dan galeri. Cocok untuk wedding organizer, dekorasi, dan venue.',
                'fonts' => 'pinyon-script:400|lora:400,500,600,400i',
                'preset' => 'wedding',
                'color' => '#a47148',
            ],
            'bimbel' => [
                'label' => 'Kursus & Bimbel',
                'description' => 'Ceria dan bersemangat: warna cerah, bentuk bermain, program belajar, pengajar, dan testimoni. Cocok untuk bimbel, kursus bahasa, les privat, dan kursus musik.',
                'fonts' => 'baloo-2:500,600,700,800|nunito:400,600,700',
                'preset' => 'bimbel',
                'color' => '#4f46e5',
            ],
            'apotek' => [
                'label' => 'Apotek',
                'description' => 'Bersih dan terpercaya: hijau medis, kotak tanya obat via WhatsApp, produk dan layanan apoteker. Cocok untuk apotek, toko obat, dan toko alat kesehatan.',
                'fonts' => 'figtree:400,500,600,700',
                'preset' => 'apotek',
                'color' => '#059669',
            ],
            'petshop' => [
                'label' => 'Pet Shop & Dokter Hewan',
                'description' => 'Ramah dan menggemaskan: warna toska, bentuk membulat, grooming, dokter hewan, pet hotel, dan produk. Cocok untuk pet shop, grooming, klinik hewan, dan penitipan.',
                'fonts' => 'fredoka:400,500,600,700',
                'preset' => 'petshop',
                'color' => '#0d9488',
            ],
            'biolink2' => [
                'label' => 'Bio Link Ceria',
                'description' => 'Ceria dan berani: latar pink, huruf oranye tebal, tombol link kapsul bergaya retro, dan link dikelompokkan dalam kotak. Cocok untuk food blogger, kreator konten, dan UMKM kuliner.',
                'fonts' => 'rubik:600,700,800|space-mono:400,700',
                'preset' => 'biolink2',
                'color' => '#e8552a',
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

    /**
     * Categories for the template gallery, in display order. A template missing from every
     * category is listed under "Lainnya".
     *
     * @return array<string, array{label: string, themes: list<string>}>
     */
    public static function categories(): array
    {
        return [
            'bisnis' => ['label' => 'Bisnis & Perusahaan', 'themes' => ['korporat', 'modern', 'minimalis', 'legal', 'tambang']],
            'kuliner' => ['label' => 'Kuliner', 'themes' => ['resto', 'kopi', 'kue', 'catering']],
            'toko' => ['label' => 'Toko & Fashion', 'themes' => ['hijab', 'kaos', 'apotek', 'petshop']],
            'kesehatan' => ['label' => 'Kesehatan & Kecantikan', 'themes' => ['gigi', 'kecantikan', 'spa', 'barber']],
            'otomotif' => ['label' => 'Otomotif & Transportasi', 'themes' => ['mobil', 'rental', 'motor', 'bengkel']],
            'jasa' => ['label' => 'Jasa & Layanan', 'themes' => ['ac', 'laundry', 'foto', 'wedding']],
            'pendidikan' => ['label' => 'Pendidikan', 'themes' => ['sekolah', 'sma', 'bimbel']],
            'properti' => ['label' => 'Properti, Wisata & Travel', 'themes' => ['properti', 'villa', 'umroh']],
            'personal' => ['label' => 'Personal & Kreator', 'themes' => ['biolink', 'biolink2']],
        ];
    }

    /**
     * The gallery category of a template.
     */
    public static function categoryOf(string $theme): string
    {
        foreach (self::categories() as $key => $category) {
            if (in_array($theme, $category['themes'], true)) {
                return $key;
            }
        }

        return 'lainnya';
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
