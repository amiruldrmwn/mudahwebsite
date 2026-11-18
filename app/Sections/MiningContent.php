<?php

namespace App\Sections;

/**
 * Sample pages for the Pertambangan & Energi template: a coal mining company with performance
 * figures, mine sites and licences, products, sustainability, board of directors and news.
 */
class MiningContent
{
    /**
     * @return list<array<string, mixed>>
     */
    public static function pages(string $company): array
    {
        $sites = [
            ['title' => 'Site Tanah Bumbu', 'text' => "Izin: IUP Operasi Produksi\nLuas: 24.100 Ha\nLokasi: Kalimantan Selatan", 'image' => 'demo/mine-aerial.jpg'],
            ['title' => 'Site Musi Rawas', 'text' => "Izin: IUP Operasi Produksi\nLuas: 18.300 Ha\nLokasi: Sumatera Selatan", 'image' => 'demo/mine-excavator.jpg'],
            ['title' => 'Site Kutai Barat', 'text' => "Izin: IUP Eksplorasi\nLuas: 9.450 Ha\nLokasi: Kalimantan Timur", 'image' => 'demo/mine-hero.jpg'],
        ];

        $news = [
            ['image' => 'demo/mine-safety.jpg', 'category' => 'Penghargaan', 'date' => '12 Okt 2026', 'title' => 'Raih penghargaan keselamatan pertambangan tingkat nasional', 'text' => 'Tercapai 10 juta jam kerja tanpa kecelakaan berakibat hilang waktu kerja.'],
            ['image' => 'demo/mine-reclamation.jpg', 'category' => 'Keberlanjutan', 'date' => '28 Sep 2026', 'title' => 'Reklamasi 1.200 hektare lahan pascatambang', 'text' => 'Lebih dari 600 ribu bibit pohon ditanam bersama masyarakat sekitar.'],
            ['image' => 'demo/mine-barge.jpg', 'category' => 'Siaran Pers', 'date' => '15 Sep 2026', 'title' => 'Kinerja penjualan semester I tumbuh 12%', 'text' => 'Didorong permintaan pasar ekspor Asia Selatan dan Asia Tenggara.'],
        ];

        $cta = [
            'title' => 'Mitra energi yang dapat diandalkan',
            'text' => 'Hubungi tim kami untuk kerja sama pasokan, investasi, atau kemitraan vendor.',
            'button_label' => 'Hubungi Kami',
            'button_url' => '/kontak',
        ];

        return [
            [
                'title' => 'Beranda',
                'slug' => 'beranda',
                'is_home' => true,
                'sections' => [
                    ['type' => 'hero', 'data' => [
                        'eyebrow' => 'Pertambangan berkelanjutan',
                        'title' => 'Energi untuk negeri, tanggung jawab untuk bumi',
                        'subtitle' => "{$company} bergerak di bidang eksplorasi, penambangan, dan perdagangan batubara dengan mengutamakan keselamatan, efisiensi, dan kelestarian lingkungan.",
                        'button_label' => 'Profil Perusahaan',
                        'button_url' => '/tentang',
                        'button2_label' => 'Operasi Tambang',
                        'button2_url' => '/operasi',
                        'image' => 'demo/mine-hero.jpg',
                    ]],
                    ['type' => 'stats', 'data' => [
                        'title' => 'Kinerja 2025',
                        'items' => [
                            ['value' => '42,5 MT', 'label' => 'Produksi batubara (juta ton)'],
                            ['value' => '41,8 MT', 'label' => 'Penjualan batubara (juta ton)'],
                            ['value' => '650 MT', 'label' => 'Total cadangan (juta ton)'],
                            ['value' => '51.850 Ha', 'label' => 'Total wilayah tambang'],
                        ],
                    ]],
                    ['type' => 'image_text', 'data' => [
                        'title' => 'Lebih dari dua dekade memasok energi',
                        'body' => "Berdiri sejak 2001, {$company} tumbuh menjadi salah satu pemasok batubara terpercaya untuk pasar domestik dan internasional.\n\n- Operasi terintegrasi dari tambang hingga pelabuhan\n- Standar keselamatan kerja kelas dunia\n- Komitmen reklamasi dan pemberdayaan masyarakat",
                        'image' => 'demo/mine-excavator.jpg',
                        'image_position' => 'right',
                        'button_label' => 'Selengkapnya',
                        'button_url' => '/tentang',
                    ]],
                    ['type' => 'services', 'data' => [
                        'title' => 'Lokasi tambang & izin',
                        'subtitle' => 'Beroperasi di wilayah strategis di Kalimantan dan Sumatera.',
                        'items' => $sites,
                    ]],
                    ['type' => 'image_text', 'data' => [
                        'title' => 'Komitmen keberlanjutan',
                        'body' => "Kami menjalankan pertambangan yang bertanggung jawab: reklamasi lahan pascatambang, pengelolaan air, pengurangan emisi, serta program sosial bagi masyarakat sekitar.\n\n**1.200 Ha** lahan direklamasi · **600 ribu** bibit ditanam",
                        'image' => 'demo/mine-reclamation.jpg',
                        'image_position' => 'left',
                        'button_label' => 'Lihat program',
                        'button_url' => '/keberlanjutan',
                    ]],
                    ['type' => 'posts', 'data' => [
                        'title' => 'Berita terbaru',
                        'items' => $news,
                    ]],
                    ['type' => 'cta', 'data' => $cta],
                ],
            ],
            [
                'title' => 'Tentang',
                'slug' => 'tentang',
                'sections' => [
                    ['type' => 'page_header', 'data' => [
                        'title' => 'Profil Perusahaan',
                        'subtitle' => "Mengenal {$company}, visi, nilai, dan jajaran pimpinan kami.",
                        'image' => 'demo/mine-aerial.jpg',
                    ]],
                    ['type' => 'image_text', 'data' => [
                        'title' => 'Sekilas perusahaan',
                        'body' => "{$company} adalah perusahaan pertambangan batubara terintegrasi yang mencakup eksplorasi, produksi, pengolahan, hingga logistik dan pemasaran.\n\nKami memasok pembangkit listrik dan industri di dalam negeri serta pembeli di berbagai negara Asia.",
                        'image' => 'demo/mine-safety.jpg',
                        'image_position' => 'left',
                    ]],
                    ['type' => 'text', 'data' => [
                        'title' => 'Visi & Misi',
                        'body' => "**Visi:** menjadi perusahaan energi terdepan yang berkelanjutan dan memberi nilai tambah bagi seluruh pemangku kepentingan.\n\n**Misi:**\n\n- Menjalankan operasi yang aman, efisien, dan ramah lingkungan\n- Menghasilkan produk berkualitas yang memenuhi kebutuhan pelanggan\n- Mengembangkan sumber daya manusia yang unggul\n- Memberi manfaat nyata bagi masyarakat dan negara",
                    ]],
                    ['type' => 'services', 'data' => [
                        'title' => 'Nilai perusahaan',
                        'items' => [
                            ['title' => 'Keselamatan', 'text' => 'Keselamatan setiap pekerja adalah prioritas utama.'],
                            ['title' => 'Integritas', 'text' => 'Jujur, transparan, dan patuh pada peraturan.'],
                            ['title' => 'Keunggulan', 'text' => 'Terus meningkatkan kinerja dan efisiensi.'],
                            ['title' => 'Kepedulian', 'text' => 'Peduli pada lingkungan dan masyarakat sekitar.'],
                        ],
                    ]],
                    ['type' => 'team', 'data' => [
                        'title' => 'Direksi',
                        'items' => [
                            ['photo' => 'demo/mine-director-1.jpg', 'name' => 'Ir. Bambang Wiratmoko', 'role' => 'Presiden Direktur'],
                            ['photo' => 'demo/mine-director-2.jpg', 'name' => 'Ratna Sari Dewi, M.M.', 'role' => 'Direktur Keuangan'],
                            ['photo' => 'demo/mine-director-3.jpg', 'name' => 'Ir. Hendro Saputra', 'role' => 'Direktur Operasional'],
                        ],
                    ]],
                ],
            ],
            [
                'title' => 'Operasi',
                'slug' => 'operasi',
                'sections' => [
                    ['type' => 'page_header', 'data' => [
                        'title' => 'Operasi Tambang',
                        'subtitle' => 'Lokasi, izin, produk, dan rantai pasok dari tambang hingga pelanggan.',
                        'image' => 'demo/mine-excavator.jpg',
                    ]],
                    ['type' => 'services', 'data' => [
                        'title' => 'Lokasi & izin usaha',
                        'items' => $sites,
                    ]],
                    ['type' => 'pricelist', 'data' => [
                        'title' => 'Produk batubara',
                        'subtitle' => 'Spesifikasi tipikal (GAR).',
                        'items' => [
                            ['name' => 'Coal 4200', 'description' => 'Kalori menengah, sulfur rendah, untuk PLTU.', 'info' => 'TM 35%', 'price' => '4.200 kcal/kg'],
                            ['name' => 'Coal 4800', 'description' => 'Untuk PLTU dan industri semen.', 'info' => 'TM 28%', 'price' => '4.800 kcal/kg'],
                            ['name' => 'Coal 5500', 'description' => 'Kalori tinggi untuk pasar ekspor.', 'info' => 'TM 18%', 'price' => '5.500 kcal/kg'],
                        ],
                        'note' => 'Spesifikasi lengkap tersedia atas permintaan.',
                        'order_button' => 'no',
                    ]],
                    ['type' => 'image_text', 'data' => [
                        'title' => 'Rantai pasok terintegrasi',
                        'body' => "Batubara diangkut dari tambang melalui jalan angkut khusus ke pelabuhan sungai, lalu dimuat ke tongkang menuju kapal di titik muat lepas pantai.\n\n- Jalan angkut khusus sepanjang 60 km\n- Pelabuhan dengan kapasitas muat 40.000 ton per hari\n- Pengiriman ke pelanggan domestik dan ekspor",
                        'image' => 'demo/mine-barge.jpg',
                        'image_position' => 'right',
                    ]],
                    ['type' => 'steps', 'data' => [
                        'title' => 'Dari tambang ke pelanggan',
                        'items' => [
                            ['title' => 'Eksplorasi', 'text' => 'Pemetaan geologi dan pengeboran untuk menghitung cadangan.'],
                            ['title' => 'Penambangan', 'text' => 'Metode tambang terbuka dengan armada alat berat modern.'],
                            ['title' => 'Pengolahan', 'text' => 'Peremukan dan pencampuran sesuai spesifikasi pelanggan.'],
                            ['title' => 'Pengapalan', 'text' => 'Pengangkutan dengan tongkang dan kapal ke tujuan.'],
                        ],
                    ]],
                ],
            ],
            [
                'title' => 'Keberlanjutan',
                'slug' => 'keberlanjutan',
                'sections' => [
                    ['type' => 'page_header', 'data' => [
                        'title' => 'Keberlanjutan',
                        'subtitle' => 'Tanggung jawab sosial dan lingkungan dalam setiap langkah operasi.',
                        'image' => 'demo/mine-reclamation.jpg',
                    ]],
                    ['type' => 'stats', 'data' => [
                        'title' => 'Kinerja lingkungan & sosial 2025',
                        'items' => [
                            ['value' => '1.200 Ha', 'label' => 'Lahan direklamasi'],
                            ['value' => '600 rb', 'label' => 'Bibit pohon ditanam'],
                            ['value' => '85.000 t', 'label' => 'Pengurangan emisi CO₂e'],
                            ['value' => '45', 'label' => 'Desa binaan'],
                        ],
                    ]],
                    ['type' => 'image_text', 'data' => [
                        'title' => 'Aspek lingkungan',
                        'body' => 'Reklamasi dan revegetasi lahan pascatambang, pengelolaan air limbah tambang, serta penggunaan energi terbarukan di fasilitas kami.',
                        'image' => 'demo/mine-reclamation.jpg',
                        'image_position' => 'left',
                    ]],
                    ['type' => 'image_text', 'data' => [
                        'title' => 'Aspek sosial',
                        'body' => 'Program pendidikan, kesehatan, dan pemberdayaan ekonomi masyarakat di sekitar wilayah operasi, termasuk beasiswa dan pelatihan kerja.',
                        'image' => 'demo/mine-csr.jpg',
                        'image_position' => 'right',
                    ]],
                    ['type' => 'image_text', 'data' => [
                        'title' => 'Keselamatan & kesehatan kerja',
                        'body' => 'Briefing keselamatan setiap hari, pelatihan berkala, dan sistem manajemen K3 yang tersertifikasi untuk seluruh karyawan dan kontraktor.',
                        'image' => 'demo/mine-safety.jpg',
                        'image_position' => 'left',
                    ]],
                ],
            ],
            [
                'title' => 'Berita',
                'slug' => 'berita',
                'sections' => [
                    ['type' => 'page_header', 'data' => [
                        'title' => 'Berita & Siaran Pers',
                        'subtitle' => 'Informasi terbaru untuk investor, mitra, dan masyarakat.',
                        'image' => 'demo/mine-barge.jpg',
                    ]],
                    ['type' => 'posts', 'data' => ['items' => [
                        ...$news,
                        ['image' => 'demo/mine-csr.jpg', 'category' => 'CSR', 'date' => '2 Sep 2026', 'title' => 'Beasiswa untuk 300 pelajar di desa sekitar tambang', 'text' => 'Program beasiswa tahunan untuk jenjang SMA dan perguruan tinggi.'],
                        ['image' => 'demo/mine-coal.jpg', 'category' => 'Siaran Pers', 'date' => '20 Agu 2026', 'title' => 'Kontrak pasokan jangka panjang dengan PLTU baru', 'text' => 'Pasokan 3 juta ton per tahun selama 10 tahun.'],
                        ['image' => 'demo/mine-aerial.jpg', 'category' => 'Operasi', 'date' => '5 Agu 2026', 'title' => 'Peningkatan kapasitas jalan angkut', 'text' => 'Mendukung target produksi tahunan yang lebih tinggi.'],
                    ]]],
                ],
            ],
            [
                'title' => 'Kontak',
                'slug' => 'kontak',
                'sections' => [
                    ['type' => 'page_header', 'data' => [
                        'title' => 'Hubungi Kami',
                        'subtitle' => 'Kantor pusat dan perwakilan kami siap membantu.',
                        'image' => 'demo/mine-hero.jpg',
                    ]],
                    ['type' => 'contact', 'data' => [
                        'title' => 'Kantor pusat',
                        'text' => 'Untuk pertanyaan bisnis, investor, media, atau pengaduan, silakan kirim pesan melalui form ini.',
                        'show_form' => 'yes',
                    ]],
                ],
            ],
        ];
    }
}
