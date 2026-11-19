<?php

namespace App\Sections;

/**
 * Sample pages for the Portal Desa template: a full village portal home with quick links, the
 * head's welcome, village officials, population figures, APBDes, news, potential, village
 * products and a gallery.
 */
class VillagePortalContent
{
    /**
     * @return list<array<string, mixed>>
     */
    public static function pages(string $company): array
    {
        $officials = ['type' => 'team', 'data' => ['title' => 'SOTK', 'subtitle' => 'Struktur organisasi dan tata kerja pemerintah desa.', 'items' => [
            ['photo' => 'demo/desa2-kades.jpg', 'name' => 'I Made Suarta', 'role' => 'Kepala Desa'],
            ['photo' => 'demo/desa2-sekdes.jpg', 'name' => 'Nur Aini', 'role' => 'Sekretaris Desa'],
            ['photo' => 'demo/desa2-kaur.jpg', 'name' => 'Rina Kartika', 'role' => 'Kaur Keuangan'],
            ['photo' => 'demo/desa2-kasi.jpg', 'name' => 'Dimas Saputra', 'role' => 'Kasi Pelayanan'],
        ]]];

        $population = ['type' => 'stats', 'data' => ['title' => 'Administrasi Penduduk', 'items' => [
            ['value' => '3.218', 'label' => 'Penduduk'],
            ['value' => '1.604', 'label' => 'Laki-laki'],
            ['value' => '1.614', 'label' => 'Perempuan'],
            ['value' => '942', 'label' => 'Kepala keluarga'],
            ['value' => '6', 'label' => 'Dusun'],
            ['value' => '18', 'label' => 'RT / RW'],
        ]]];

        $budget = ['type' => 'pricelist', 'data' => ['title' => 'APB Desa 2026', 'subtitle' => 'Akses terbuka anggaran pendapatan dan belanja desa.', 'items' => [
            ['name' => 'Pendapatan desa', 'description' => 'Dana Desa, ADD, bagi hasil pajak, dan PADes', 'info' => '', 'price' => 'Rp2.148.300.000'],
            ['name' => 'Belanja desa', 'description' => 'Pembangunan, pemberdayaan, dan pelayanan', 'info' => '', 'price' => 'Rp2.096.750.000'],
            ['name' => 'Pembiayaan', 'description' => 'SiLPA tahun sebelumnya', 'info' => '', 'price' => 'Rp51.550.000'],
        ], 'note' => 'Rincian per bidang tersedia di kantor desa dan baliho APBDes.', 'order_button' => 'no']];

        $news = ['type' => 'posts', 'data' => ['title' => 'Berita Desa', 'subtitle' => 'Kabar terbaru tentang kegiatan dan pembangunan desa.', 'items' => [
            ['image' => 'demo/desa-jalan.jpg', 'category' => 'Pembangunan', 'date' => '14 Nov 2026', 'title' => 'Rabat beton jalan dusun Sukamaju sepanjang 800 meter selesai', 'text' => 'Dikerjakan secara swakelola dengan tenaga kerja warga setempat.'],
            ['image' => 'demo/desa2-jagung.jpg', 'category' => 'Pertanian', 'date' => '5 Nov 2026', 'title' => 'Panen jagung kelompok tani naik 25 persen', 'text' => 'Berkat bantuan bibit unggul dan pendampingan penyuluh.'],
            ['image' => 'demo/desa-budaya.jpg', 'category' => 'Kegiatan', 'date' => '28 Okt 2026', 'title' => 'Pentas seni pemuda memeriahkan Hari Sumpah Pemuda', 'text' => 'Tari tradisional dan lomba kreativitas antar-dusun.'],
        ]]];

        $potential = ['type' => 'services', 'data' => ['title' => 'Potensi Desa', 'subtitle' => 'Pertanian, wisata, dan ekonomi kreatif warga.', 'items' => [
            ['title' => 'Pertanian & perkebunan', 'text' => 'Padi, jagung, dan kopi dari lahan seluas 420 ha.', 'image' => 'demo/desa2-petani.jpg'],
            ['title' => 'Wisata alam', 'text' => 'Bukit, sawah terasering, dan embung desa.', 'image' => 'demo/desa-gunung.jpg'],
            ['title' => 'Seni & budaya', 'text' => 'Sanggar tari dan kerajinan tangan warga.', 'image' => 'demo/desa-budaya.jpg'],
        ]]];

        $products = ['type' => 'pricelist', 'data' => ['title' => 'Beli dari Desa', 'subtitle' => 'Produk UMKM warga. Pesan langsung ke penjual lewat WhatsApp.', 'items' => [
            ['name' => 'Beras organik', 'description' => 'Hasil sawah kelompok tani', 'info' => '5 kg', 'price' => 'Rp85.000', 'image' => 'demo/desa-sawah.jpg'],
            ['name' => 'Keripik singkong', 'description' => 'Produksi ibu-ibu PKK', 'info' => '250 gr', 'price' => 'Rp15.000', 'image' => 'demo/umkm-toples.jpg'],
            ['name' => 'Sambal khas desa', 'description' => 'Tanpa pengawet', 'info' => '150 gr', 'price' => 'Rp25.000', 'image' => 'demo/umkm-sambal.jpg'],
        ], 'order_button' => 'yes']];

        $gallery = ['type' => 'gallery', 'data' => ['title' => 'Galeri Desa', 'items' => [
            ['image' => 'demo/desa-udara.jpg', 'caption' => 'Pemandangan desa dari udara'],
            ['image' => 'demo/desa2-petani.jpg', 'caption' => 'Petani di sawah'],
            ['image' => 'demo/desa-budaya.jpg', 'caption' => 'Pentas seni budaya'],
            ['image' => 'demo/desa-jalan.jpg', 'caption' => 'Jalan desa yang baru'],
            ['image' => 'demo/desa2-jagung.jpg', 'caption' => 'Panen jagung'],
            ['image' => 'demo/desa-sawah.jpg', 'caption' => 'Sawah terasering'],
        ]]];

        return [
            ['title' => 'Beranda', 'slug' => 'beranda', 'is_home' => true, 'sections' => [
                ['type' => 'hero', 'data' => [
                    'eyebrow' => 'Website resmi',
                    'title' => "Pemerintah {$company}",
                    'subtitle' => 'Sumber informasi terbaru tentang pemerintahan, pelayanan, dan potensi desa.',
                    'button_label' => 'Layanan Warga', 'button_url' => '/layanan',
                    'button2_label' => 'Profil Desa', 'button2_url' => '/profil',
                    'image' => 'demo/desa-gunung.jpg',
                ]],
                ['type' => 'links', 'data' => ['title' => 'Jelajahi Desa', 'items' => [
                    ['title' => 'Profil Desa', 'text' => 'Sejarah, visi misi, dan wilayah', 'url' => '/profil', 'badge' => '', 'image' => ''],
                    ['title' => 'Infografis', 'text' => 'Data penduduk dan APBDes', 'url' => '/infografis', 'badge' => '', 'image' => ''],
                    ['title' => 'Layanan Surat', 'text' => 'Ajukan surat dari rumah', 'url' => '/layanan', 'badge' => '', 'image' => ''],
                    ['title' => 'Berita', 'text' => 'Kabar dan kegiatan desa', 'url' => '/berita', 'badge' => '', 'image' => ''],
                ]]],
                ['type' => 'image_text', 'data' => ['title' => 'Sambutan Kepala Desa', 'body' => "**I Made Suarta**, Kepala Desa\n\nSelamat datang di website resmi {$company}. Website ini kami hadirkan sebagai sarana informasi dan pelayanan yang terbuka bagi seluruh warga. Mari bersama membangun desa yang maju, mandiri, dan sejahtera.", 'image' => 'demo/desa2-kades.jpg', 'image_position' => 'left']],
                $officials,
                $population,
                $budget,
                $news,
                $potential,
                $products,
                $gallery,
            ]],
            ['title' => 'Profil', 'slug' => 'profil', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Profil Desa', 'subtitle' => 'Sejarah, visi misi, dan pemerintahan desa.', 'image' => 'demo/desa-udara.jpg']],
                ['type' => 'text', 'data' => ['title' => 'Sejarah & visi misi', 'body' => "Desa dibuka oleh para leluhur pada awal abad ke-20 dan berkembang menjadi sentra pertanian di kecamatan.\n\n**Visi:** Desa maju, mandiri, dan sejahtera berlandaskan gotong royong.\n\n**Misi:**\n\n1. Meningkatkan kualitas pelayanan publik\n2. Membangun infrastruktur yang merata\n3. Mengembangkan ekonomi warga melalui BUMDes dan UMKM\n4. Melestarikan seni dan budaya desa"]],
                $officials,
            ]],
            ['title' => 'Infografis', 'slug' => 'infografis', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Infografis Desa', 'subtitle' => 'Data kependudukan dan anggaran yang terbuka untuk warga.']],
                $population,
                $budget,
            ]],
            ['title' => 'Layanan', 'slug' => 'layanan', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Layanan Warga', 'subtitle' => 'Kantor desa buka Senin–Jumat, 08.00–15.00.']],
                ['type' => 'services', 'data' => ['title' => 'Jenis layanan', 'items' => [
                    ['title' => 'Surat keterangan', 'text' => 'Domisili, usaha, tidak mampu, dan pengantar SKCK.', 'image' => ''],
                    ['title' => 'Kependudukan', 'text' => 'Pengantar KTP, KK, akta, dan pindah datang.', 'image' => ''],
                    ['title' => 'Pengaduan', 'text' => 'Saran dan keluhan warga ditindaklanjuti perangkat desa.', 'image' => ''],
                ]]],
                ['type' => 'contact', 'data' => ['title' => 'Ajukan surat atau pengaduan', 'text' => 'Tulis nama, NIK, jenis layanan, dan keperluan. Kami kabari lewat WhatsApp saat surat siap.', 'show_form' => 'yes']],
            ]],
            ['title' => 'Berita', 'slug' => 'berita', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Berita Desa', 'subtitle' => 'Peristiwa, kegiatan, dan pengumuman.']],
                $news,
                $gallery,
            ]],
            ['title' => 'Belanja', 'slug' => 'belanja', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Beli dari Desa', 'subtitle' => 'Dukung ekonomi warga dengan membeli produk desa.']],
                $products,
                $potential,
            ]],
        ];
    }
}
