<?php

namespace App\Sections;

/**
 * Sample pages for the Jasa AC & Servis template: installation, repair and cleaning, a clear
 * price list, how to order and service areas.
 */
class AcServiceContent
{
    /**
     * @return list<array<string, mixed>>
     */
    public static function pages(string $company): array
    {
        $services = [
            ['title' => 'Cuci AC', 'text' => 'Bersihkan filter, evaporator, dan saluran air agar AC dingin maksimal dan udara lebih sehat.', 'image' => 'demo/ac-cleaning.jpg'],
            ['title' => 'Perbaikan & Isi Freon', 'text' => 'AC tidak dingin, bocor, berisik, atau mati? Kami cek dulu, jelaskan, baru perbaiki setelah Anda setuju.', 'image' => 'demo/ac-freon.jpg'],
            ['title' => 'Pasang & Bongkar AC', 'text' => 'Pemasangan unit baru atau pindahan dengan pipa rapi, vakum, dan uji kebocoran.', 'image' => 'demo/ac-outdoor.jpg'],
        ];

        $steps = [
            ['title' => 'Chat atau telepon', 'text' => 'Ceritakan keluhan, merek, dan jumlah unit AC Anda.'],
            ['title' => 'Atur jadwal', 'text' => 'Pilih waktu kunjungan. Estimasi biaya kami sampaikan di awal.'],
            ['title' => 'Teknisi datang', 'text' => 'Pengecekan menyeluruh, pengerjaan dimulai setelah Anda setuju.'],
            ['title' => 'Bayar & bergaransi', 'text' => 'Bayar setelah selesai. Nota dan garansi 30 hari dikirim via WhatsApp.'],
        ];

        $testimonials = [
            ['quote' => 'Teknisi datang tepat waktu, kerjanya rapi, dan kamar langsung dingin lagi. Harganya sesuai yang disampaikan di awal.', 'name' => 'Ibu Sari', 'role' => 'Rumah tinggal, Depok'],
            ['quote' => 'Pasang 4 unit AC di kantor kami selesai dalam sehari. Pipanya dirapikan dan dijelaskan cara merawatnya.', 'name' => 'Pak Yudi', 'role' => 'Pemilik kantor, Tangerang'],
            ['quote' => 'Sudah langganan cuci AC tiap 3 bulan. Diingatkan lewat WhatsApp, jadi tidak pernah lupa.', 'name' => 'Mbak Lia', 'role' => 'Apartemen, Jakarta Barat'],
        ];

        $cta = [
            'title' => 'AC bermasalah? Teknisi bisa datang hari ini.',
            'text' => 'Konsultasi gratis via WhatsApp sebelum kunjungan, tanpa biaya cek untuk area layanan kami.',
            'button_label' => 'Hubungi Kami',
            'button_url' => '/kontak',
        ];

        $cleaning = [
            ['name' => 'Cuci AC split 0,5 – 1 PK', 'description' => 'Filter, evaporator, dan saluran pembuangan.', 'info' => '45 menit', 'price' => 'Rp75.000'],
            ['name' => 'Cuci AC split 1,5 – 2 PK', 'description' => 'Termasuk pengecekan tekanan freon.', 'info' => '60 menit', 'price' => 'Rp90.000'],
            ['name' => 'Cuci AC cassette / standing', 'description' => 'Untuk kantor, ruko, dan ruang besar.', 'info' => '90 menit', 'price' => 'Rp175.000'],
            ['name' => 'Cuci besar (bongkar unit)', 'description' => 'Untuk AC yang sangat kotor atau berbau.', 'info' => '2 jam', 'price' => 'Rp250.000'],
        ];

        return [
            [
                'title' => 'Beranda',
                'slug' => 'beranda',
                'is_home' => true,
                'sections' => [
                    ['type' => 'hero', 'data' => [
                        'eyebrow' => 'Cuci · Perbaikan · Pasang AC',
                        'title' => 'Ruangan sejuk lagi, tanpa tunggu lama.',
                        'subtitle' => "Teknisi {$company} datang ke rumah atau kantor Anda untuk servis AC semua merek. Harga jelas di awal dan bergaransi 30 hari.",
                        'button_label' => 'Panggil Teknisi',
                        'button_url' => '/kontak',
                        'button2_label' => 'Lihat Harga',
                        'button2_url' => '/harga',
                        'image' => 'demo/ac-hero.jpg',
                    ]],
                    ['type' => 'services', 'data' => [
                        'title' => 'Satu tim untuk semua urusan AC',
                        'subtitle' => 'AC split, cassette, standing, hingga central untuk rumah, kantor, dan toko.',
                        'items' => $services,
                    ]],
                    ['type' => 'stats', 'data' => [
                        'items' => [
                            ['value' => '12.000+', 'label' => 'Unit AC diservis'],
                            ['value' => '35', 'label' => 'Teknisi bersertifikat'],
                            ['value' => '4,9/5', 'label' => 'Rating pelanggan'],
                            ['value' => '30 hari', 'label' => 'Garansi pengerjaan'],
                        ],
                    ]],
                    ['type' => 'steps', 'data' => [
                        'title' => 'Cara pesan, cukup 4 langkah',
                        'items' => $steps,
                    ]],
                    ['type' => 'pricelist', 'data' => [
                        'title' => 'Harga cuci AC',
                        'subtitle' => 'Transparan sejak awal. Daftar lengkap ada di halaman Harga.',
                        'items' => array_slice($cleaning, 0, 3),
                        'order_button' => 'yes',
                    ]],
                    ['type' => 'testimonials', 'data' => [
                        'title' => 'Kata pelanggan kami',
                        'items' => $testimonials,
                    ]],
                    ['type' => 'cta', 'data' => $cta],
                ],
            ],
            [
                'title' => 'Layanan',
                'slug' => 'layanan',
                'sections' => [
                    ['type' => 'page_header', 'data' => [
                        'title' => 'Layanan Kami',
                        'subtitle' => 'Dari cuci rutin sampai pemasangan unit baru, semua dikerjakan teknisi berpengalaman.',
                    ]],
                    ['type' => 'services', 'data' => [
                        'items' => [
                            ...$services,
                            ['title' => 'Perbaikan Mesin & PCB', 'text' => 'Kerusakan kompresor, kapasitor, sensor, hingga modul elektronik.', 'image' => 'demo/ac-repair.jpg'],
                            ['title' => 'AC Kantor & Gedung', 'text' => 'Servis AC cassette dan standing untuk kantor, ruko, dan restoran.', 'image' => 'demo/ac-office.jpg'],
                            ['title' => 'Kontrak Perawatan', 'text' => 'Jadwal cuci berkala dengan harga khusus dan pengingat otomatis.', 'image' => 'demo/ac-customer.jpg'],
                        ],
                    ]],
                    ['type' => 'image_text', 'data' => [
                        'title' => 'Kenapa AC perlu dicuci rutin?',
                        'body' => "AC yang kotor bekerja lebih berat sehingga **boros listrik hingga 30%** dan cepat rusak.\n\n- Dingin lebih cepat dan merata\n- Udara lebih bersih, bebas bau apek\n- Umur mesin lebih panjang\n\nKami sarankan cuci AC setiap 3 bulan untuk pemakaian harian.",
                        'image' => 'demo/ac-cleaning.jpg',
                        'image_position' => 'right',
                        'button_label' => 'Jadwalkan Cuci AC',
                        'button_url' => '/kontak',
                    ]],
                    ['type' => 'faq', 'data' => [
                        'title' => 'Pertanyaan umum',
                        'items' => [
                            ['question' => 'Apakah ada biaya pengecekan?', 'answer' => 'Gratis jika Anda melanjutkan perbaikan. Jika tidak, biaya kunjungan Rp50.000.'],
                            ['question' => 'Merek AC apa saja yang dilayani?', 'answer' => 'Semua merek: Daikin, Panasonic, Sharp, LG, Samsung, Gree, Midea, Polytron, dan lainnya.'],
                            ['question' => 'Berapa lama garansinya?', 'answer' => 'Garansi 30 hari untuk setiap pengerjaan. Jika keluhan sama muncul lagi, kami perbaiki gratis.'],
                            ['question' => 'Bisa datang di hari Minggu?', 'answer' => 'Bisa. Kami buka setiap hari pukul 08.00–20.00, termasuk hari libur.'],
                        ],
                    ]],
                ],
            ],
            [
                'title' => 'Harga',
                'slug' => 'harga',
                'sections' => [
                    ['type' => 'page_header', 'data' => [
                        'title' => 'Daftar Harga',
                        'subtitle' => 'Harga sudah termasuk jasa teknisi. Tidak ada biaya tersembunyi.',
                    ]],
                    ['type' => 'pricelist', 'data' => [
                        'title' => 'Cuci AC',
                        'items' => $cleaning,
                        'order_button' => 'no',
                    ]],
                    ['type' => 'pricelist', 'data' => [
                        'title' => 'Perbaikan & Freon',
                        'items' => [
                            ['name' => 'Isi freon R32 / R410 (tambah)', 'info' => 'Per unit', 'price' => 'Rp150.000'],
                            ['name' => 'Isi freon full (setelah vakum)', 'info' => 'Per unit', 'price' => 'Rp350.000'],
                            ['name' => 'Ganti kapasitor', 'info' => 'Termasuk part', 'price' => 'Rp175.000'],
                            ['name' => 'Perbaikan kebocoran pipa', 'info' => 'Mulai', 'price' => 'Rp200.000'],
                            ['name' => 'Perbaikan PCB / modul', 'info' => 'Setelah cek', 'price' => 'Mulai Rp350.000'],
                        ],
                        'order_button' => 'no',
                    ]],
                    ['type' => 'pricelist', 'data' => [
                        'title' => 'Pasang & Bongkar',
                        'items' => [
                            ['name' => 'Pasang AC baru 0,5 – 1 PK', 'description' => 'Termasuk pipa 3 meter, kabel, dan bracket.', 'price' => 'Rp350.000'],
                            ['name' => 'Pasang AC baru 1,5 – 2 PK', 'description' => 'Termasuk pipa 3 meter, kabel, dan bracket.', 'price' => 'Rp450.000'],
                            ['name' => 'Bongkar AC', 'price' => 'Rp150.000'],
                            ['name' => 'Bongkar pasang (pindah lokasi)', 'price' => 'Rp450.000'],
                            ['name' => 'Tambahan pipa', 'info' => 'Per meter', 'price' => 'Rp100.000'],
                        ],
                        'note' => 'Harga dapat berbeda untuk lokasi khusus (lantai tinggi atau akses sulit). Konfirmasi ke admin sebelum kunjungan.',
                        'order_button' => 'yes',
                    ]],
                ],
            ],
            [
                'title' => 'Tentang',
                'slug' => 'tentang',
                'sections' => [
                    ['type' => 'page_header', 'data' => [
                        'title' => 'Tentang Kami',
                        'subtitle' => "Mengenal {$company} dan tim teknisi kami.",
                    ]],
                    ['type' => 'image_text', 'data' => [
                        'title' => 'Teknisi jujur, kerja rapi',
                        'body' => "{$company} berawal dari dua teknisi pada 2016. Kini kami punya puluhan teknisi bersertifikat yang melayani rumah, kantor, dan toko setiap hari.\n\nPrinsip kami sederhana: jelaskan masalahnya, sampaikan harga di awal, dan kerjakan dengan rapi.",
                        'image' => 'demo/ac-team.jpg',
                        'image_position' => 'left',
                    ]],
                    ['type' => 'services', 'data' => [
                        'title' => 'Janji kami',
                        'items' => [
                            ['title' => 'Harga di depan', 'text' => 'Estimasi biaya disampaikan sebelum pengerjaan dimulai.'],
                            ['title' => 'Tepat waktu', 'text' => 'Teknisi datang sesuai jadwal, dengan kabar jika terlambat.'],
                            ['title' => 'Bersih & rapi', 'text' => 'Area kerja ditutup plastik dan dibersihkan setelah selesai.'],
                            ['title' => 'Bergaransi', 'text' => 'Garansi 30 hari untuk setiap pekerjaan.'],
                        ],
                    ]],
                    ['type' => 'text', 'data' => [
                        'title' => 'Area layanan',
                        'body' => "Kami melayani seluruh **Jabodetabek**:\n\n- Jakarta Selatan, Barat, Timur, Utara, dan Pusat\n- Depok dan Bogor\n- Tangerang dan Tangerang Selatan\n- Bekasi\n\nDi luar area tersebut? Hubungi kami, mungkin masih bisa kami jangkau.",
                    ]],
                ],
            ],
            [
                'title' => 'Kontak',
                'slug' => 'kontak',
                'sections' => [
                    ['type' => 'page_header', 'data' => [
                        'title' => 'Panggil Teknisi',
                        'subtitle' => 'Buka setiap hari, 08.00–20.00. Respons tercepat lewat WhatsApp.',
                    ]],
                    ['type' => 'contact', 'data' => [
                        'title' => 'Ceritakan keluhan AC Anda',
                        'text' => 'Sebutkan merek, ukuran PK, jumlah unit, dan alamat. Admin akan menghubungi untuk konfirmasi jadwal.',
                        'show_form' => 'yes',
                    ]],
                ],
            ],
        ];
    }
}
