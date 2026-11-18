<?php

namespace App\Sections;

/**
 * Sample pages for the Travel Umroh template: umrah packages, special hajj, departure schedule,
 * FAQ and contact.
 */
class UmrohContent
{
    /**
     * @return list<array<string, mixed>>
     */
    public static function pages(string $company): array
    {
        $packages = [
            ['image' => 'demo/umroh-hero.jpg', 'name' => 'Umroh Reguler 9 Hari', 'date' => '19 Nov', 'duration' => '9 Hari', 'airline' => 'Garuda Indonesia', 'rating' => 'Bintang 4', 'hotels' => "Madinah: Al Haram Hotel\nMakkah: Al Kiswah Towers", 'price' => 'Rp29.900.000'],
            ['image' => 'demo/umroh-nabawi.jpg', 'name' => 'Umroh Signature 9 Hari', 'date' => '23 Nov', 'duration' => '9 Hari', 'airline' => 'Saudia Airlines', 'rating' => 'Bintang 5', 'hotels' => "Madinah: Pullman Madinah\nMakkah: Swissotel Al Maqam", 'price' => 'Rp39.500.000'],
            ['image' => 'demo/umroh-kaaba-night.jpg', 'name' => 'Umroh Premium 12 Hari', 'date' => '2 Des', 'duration' => '12 Hari', 'airline' => 'Garuda Indonesia', 'rating' => 'Bintang 5', 'hotels' => "Madinah: Anwar Al Madinah\nMakkah: Hilton Suites Makkah", 'price' => 'Rp47.900.000'],
            ['image' => 'demo/umroh-group.jpg', 'name' => 'Umroh Keluarga Akhir Tahun', 'date' => '20 Des', 'duration' => '9 Hari', 'airline' => 'Saudia Airlines', 'rating' => 'Bintang 5', 'hotels' => "Madinah: Shaza Regency\nMakkah: Le Meridien Towers", 'price' => 'Rp42.500.000'],
            ['image' => 'demo/umroh-ziarah.jpg', 'name' => 'Umroh Plus Thaif 10 Hari', 'date' => '10 Jan', 'duration' => '10 Hari', 'airline' => 'Garuda Indonesia', 'rating' => 'Bintang 4', 'hotels' => "Madinah: Grand Plaza Madinah\nMakkah: Elaf Kinda", 'price' => 'Rp33.750.000'],
            ['image' => 'demo/umroh-hotel.jpg', 'name' => 'Umroh VIP Ramadhan', 'date' => '1 Mar', 'duration' => '14 Hari', 'airline' => 'Garuda Indonesia', 'rating' => 'Bintang 5', 'hotels' => "Madinah: The Oberoi Madinah\nMakkah: Raffles Makkah Palace", 'price' => 'Rp98.000.000'],
        ];

        $services = [
            ['title' => 'Umroh Reguler', 'text' => 'Paket hemat dengan hotel nyaman dan jadwal setiap bulan.', 'image' => 'demo/umroh-hero.jpg'],
            ['title' => 'Umroh Plus Wisata', 'text' => 'Umroh dilanjutkan wisata halal ke Turki, Dubai, atau Mesir.', 'image' => 'demo/umroh-ziarah.jpg'],
            ['title' => 'Umroh Private', 'text' => 'Untuk keluarga atau rombongan, tanggal dan hotel bebas dipilih.', 'image' => 'demo/umroh-group.jpg'],
            ['title' => 'Haji Khusus', 'text' => 'Program haji plus dengan masa tunggu lebih singkat dan layanan premium.', 'image' => 'demo/umroh-arafah.jpg'],
        ];

        $reasons = [
            ['title' => 'Izin Resmi PPIU & PIHK', 'text' => 'Terdaftar dan diawasi Kementerian Agama Republik Indonesia.'],
            ['title' => 'Pembimbing Berpengalaman', 'text' => 'Muthawif dan ustadz pendamping sejak manasik hingga pulang.'],
            ['title' => 'Hotel Dekat Masjid', 'text' => 'Hotel pilihan berjarak dekat dengan Masjidil Haram dan Nabawi.'],
            ['title' => 'Harga Transparan', 'text' => 'Semua biaya jelas di awal, tanpa biaya tersembunyi.'],
        ];

        $testimonials = [
            ['quote' => 'Pelayanannya di atas ekspektasi. Pembimbingnya sabar, hotelnya dekat sekali dengan masjid. Insyaallah kami berangkat lagi bersama keluarga.', 'name' => 'Bapak Hasan & Ibu Fatimah', 'role' => 'Jamaah Umroh Signature'],
            ['quote' => 'Dari manasik sampai pulang semuanya teratur. Orang tua saya yang sudah sepuh merasa sangat terbantu.', 'name' => 'Rina Marlina', 'role' => 'Jamaah Umroh Keluarga'],
            ['quote' => 'Tim selalu sigap menjawab pertanyaan. Rombongannya kompak dan ibadah terasa khusyuk.', 'name' => 'Ahmad Fauzi', 'role' => 'Jamaah Umroh Reguler'],
        ];

        $faq = [
            ['question' => 'Apa saja yang termasuk dalam harga paket?', 'answer' => 'Tiket pesawat pulang-pergi, visa umroh, hotel, makan 3 kali sehari, transportasi bus, muthawif, ziarah, perlengkapan, dan manasik.'],
            ['question' => 'Berapa uang muka untuk mendaftar?', 'answer' => 'Uang muka Rp5.000.000 per orang untuk mengunci kursi. Pelunasan paling lambat 30 hari sebelum keberangkatan.'],
            ['question' => 'Dokumen apa saja yang perlu disiapkan?', 'answer' => 'Paspor dengan masa berlaku minimal 8 bulan, KTP, Kartu Keluarga, pas foto latar putih, dan buku vaksin meningitis.'],
            ['question' => 'Apakah bisa berangkat dari luar Jakarta?', 'answer' => 'Bisa. Kami melayani keberangkatan dari Jakarta, Surabaya, Medan, dan Makassar, atau dengan penerbangan sambungan dari kota Anda.'],
            ['question' => 'Apakah ada manasik sebelum berangkat?', 'answer' => 'Ya, manasik dilaksanakan dua kali sebelum keberangkatan bersama ustadz pembimbing.'],
        ];

        $cta = [
            'title' => 'Siap menunaikan ibadah ke Tanah Suci?',
            'text' => 'Konsultasikan paket yang sesuai dengan kebutuhan dan anggaran Anda. Gratis, tanpa komitmen.',
            'button_label' => 'Konsultasi Sekarang',
            'button_url' => '/kontak',
        ];

        return [
            [
                'title' => 'Beranda',
                'slug' => 'beranda',
                'is_home' => true,
                'sections' => [
                    ['type' => 'hero', 'data' => [
                        'eyebrow' => 'Izin resmi Kemenag RI',
                        'title' => 'Saatnya wujudkan mimpi ke Tanah Suci',
                        'subtitle' => "{$company} menghadirkan perjalanan ibadah umroh dan haji yang aman, nyaman, dan dibimbing dengan sepenuh hati.",
                        'button_label' => 'Lihat Paket Umroh',
                        'button_url' => '/paket',
                        'button2_label' => 'Jadwal Keberangkatan',
                        'button2_url' => '/jadwal',
                        'image' => 'demo/umroh-hero.jpg',
                    ]],
                    ['type' => 'services', 'data' => [
                        'title' => 'Layanan Kami',
                        'subtitle' => 'Rasakan pengalaman ibadah yang aman dan nyaman bersama kami.',
                        'items' => $services,
                    ]],
                    ['type' => 'packages', 'data' => [
                        'title' => 'Paket Umroh Terdekat',
                        'subtitle' => 'Tanggal keberangkatan terdekat. Klik Detail untuk tanya langsung via WhatsApp.',
                        'items' => array_slice($packages, 0, 3),
                        'button_label' => 'Lihat Semua Paket Umroh',
                        'button_url' => '/paket',
                    ]],
                    ['type' => 'image_text', 'data' => [
                        'title' => 'Paket Haji Khusus',
                        'body' => "Wujudkan panggilan haji dengan layanan terbaik bersama pembimbing bersertifikat.\n\n- Akomodasi hotel bintang 5 dekat Masjidil Haram\n- Tenda Mina dan Arafah dengan fasilitas VIP\n- Konsumsi menu Indonesia selama ibadah\n\n**Mulai USD 11.750** — daftar sebelum kuota habis.",
                        'image' => 'demo/umroh-arafah.jpg',
                        'image_position' => 'left',
                        'button_label' => 'Lihat Detail Haji',
                        'button_url' => '/haji',
                    ]],
                    ['type' => 'services', 'data' => [
                        'title' => 'Kenapa Memilih Kami?',
                        'items' => $reasons,
                    ]],
                    ['type' => 'stats', 'data' => [
                        'items' => [
                            ['value' => '13 thn+', 'label' => 'Pengalaman'],
                            ['value' => '25.000+', 'label' => 'Jamaah diberangkatkan'],
                            ['value' => '4,9/5', 'label' => 'Kepuasan jamaah'],
                            ['value' => '12', 'label' => 'Kantor cabang'],
                        ],
                    ]],
                    ['type' => 'testimonials', 'data' => [
                        'title' => 'Apa Kata Jamaah Kami',
                        'items' => $testimonials,
                    ]],
                    ['type' => 'gallery', 'data' => [
                        'title' => 'Momen Perjalanan',
                        'items' => [
                            ['image' => 'demo/umroh-airport.jpg', 'caption' => 'Keberangkatan rombongan dari Jakarta'],
                            ['image' => 'demo/umroh-group.jpg', 'caption' => 'Jamaah di Masjid Nabawi'],
                            ['image' => 'demo/umroh-manasik.jpg', 'caption' => 'Manasik bersama ustadz pembimbing'],
                        ],
                    ]],
                    ['type' => 'cta', 'data' => $cta],
                ],
            ],
            [
                'title' => 'Paket Umroh',
                'slug' => 'paket',
                'sections' => [
                    ['type' => 'page_header', 'data' => [
                        'title' => 'Paket Umroh',
                        'subtitle' => 'Pilih paket sesuai waktu, kenyamanan, dan anggaran Anda.',
                        'image' => 'demo/umroh-nabawi.jpg',
                    ]],
                    ['type' => 'packages', 'data' => ['items' => $packages]],
                    ['type' => 'services', 'data' => [
                        'title' => 'Sudah Termasuk dalam Paket',
                        'items' => [
                            ['title' => 'Tiket Pesawat PP', 'text' => 'Penerbangan langsung dengan maskapai pilihan.'],
                            ['title' => 'Visa & Asuransi', 'text' => 'Visa umroh dan asuransi perjalanan.'],
                            ['title' => 'Hotel & Makan', 'text' => 'Hotel dekat masjid dan makan 3 kali sehari menu Indonesia.'],
                            ['title' => 'Muthawif & Ziarah', 'text' => 'Pembimbing ibadah dan ziarah kota Makkah dan Madinah.'],
                            ['title' => 'Perlengkapan', 'text' => 'Koper, kain ihram atau mukena, tas, dan buku doa.'],
                            ['title' => 'Manasik', 'text' => 'Dua kali manasik sebelum keberangkatan.'],
                        ],
                    ]],
                    ['type' => 'cta', 'data' => $cta],
                ],
            ],
            [
                'title' => 'Haji Khusus',
                'slug' => 'haji',
                'sections' => [
                    ['type' => 'page_header', 'data' => [
                        'title' => 'Haji Khusus',
                        'subtitle' => 'Program haji plus dengan masa tunggu lebih singkat dan pelayanan premium.',
                        'image' => 'demo/umroh-arafah.jpg',
                    ]],
                    ['type' => 'image_text', 'data' => [
                        'title' => 'Ibadah haji yang khusyuk dan nyaman',
                        'body' => "Program Haji Khusus kami resmi terdaftar sebagai PIHK. Jamaah didampingi pembimbing bersertifikat sejak manasik hingga kembali ke tanah air.\n\n- Hotel bintang 5 di Makkah dan Madinah\n- Tenda VIP di Mina dan Arafah\n- Menu masakan Indonesia\n- Bimbingan ibadah intensif",
                        'image' => 'demo/umroh-kaaba-night.jpg',
                        'image_position' => 'right',
                    ]],
                    ['type' => 'pricelist', 'data' => [
                        'title' => 'Pilihan Program Haji',
                        'items' => [
                            ['name' => 'Haji Khusus Reguler', 'description' => 'Masa tunggu sesuai kuota haji khusus Kemenag.', 'info' => '25 hari', 'price' => 'USD 11.750'],
                            ['name' => 'Haji Khusus Premium', 'description' => 'Hotel lebih dekat dan tenda VIP.', 'info' => '25 hari', 'price' => 'USD 14.500'],
                            ['name' => 'Haji Furoda', 'description' => 'Visa mujamalah, berangkat tahun yang sama tanpa antre.', 'info' => '21 hari', 'price' => 'USD 22.000'],
                        ],
                        'note' => 'Harga dapat berubah mengikuti kebijakan pemerintah Arab Saudi dan kurs.',
                        'order_button' => 'yes',
                    ]],
                    ['type' => 'steps', 'data' => [
                        'title' => 'Alur Pendaftaran Haji',
                        'items' => [
                            ['title' => 'Konsultasi', 'text' => 'Pilih program dan cek kelengkapan dokumen.'],
                            ['title' => 'Setoran Awal', 'text' => 'Pembayaran setoran awal untuk mendapat nomor porsi.'],
                            ['title' => 'Manasik', 'text' => 'Bimbingan manasik berkala menjelang keberangkatan.'],
                            ['title' => 'Berangkat', 'text' => 'Pelunasan, pembagian perlengkapan, dan keberangkatan.'],
                        ],
                    ]],
                ],
            ],
            [
                'title' => 'Jadwal Keberangkatan',
                'slug' => 'jadwal',
                'sections' => [
                    ['type' => 'page_header', 'data' => [
                        'title' => 'Jadwal Keberangkatan',
                        'subtitle' => 'Jadwal umroh beberapa bulan ke depan. Kursi terbatas di setiap tanggal.',
                        'image' => 'demo/umroh-plane.jpg',
                    ]],
                    ['type' => 'pricelist', 'data' => [
                        'title' => 'Jadwal Terdekat',
                        'items' => array_map(fn (array $p) => [
                            'name' => $p['date'].' · '.$p['name'],
                            'description' => $p['airline'].' · '.str_replace("\n", ' · ', $p['hotels']),
                            'info' => $p['duration'],
                            'price' => $p['price'],
                        ], $packages),
                        'note' => 'Harga per orang untuk kamar quad. Tambahan biaya untuk kamar triple atau double.',
                        'order_button' => 'yes',
                    ]],
                ],
            ],
            [
                'title' => 'FAQ',
                'slug' => 'faq',
                'sections' => [
                    ['type' => 'page_header', 'data' => [
                        'title' => 'Pertanyaan yang Sering Diajukan',
                        'subtitle' => 'Belum menemukan jawaban? Hubungi tim kami lewat WhatsApp.',
                        'image' => 'demo/umroh-manasik.jpg',
                    ]],
                    ['type' => 'faq', 'data' => ['items' => $faq]],
                    ['type' => 'cta', 'data' => $cta],
                ],
            ],
            [
                'title' => 'Kontak',
                'slug' => 'kontak',
                'sections' => [
                    ['type' => 'page_header', 'data' => [
                        'title' => 'Hubungi Kami',
                        'subtitle' => 'Kantor buka Senin–Sabtu pukul 08.00–17.00.',
                        'image' => 'demo/umroh-airport.jpg',
                    ]],
                    ['type' => 'contact', 'data' => [
                        'title' => 'Konsultasi gratis',
                        'text' => 'Tim kami siap membantu memilih paket terbaik untuk Anda dan keluarga.',
                        'show_form' => 'yes',
                    ]],
                ],
            ],
        ];
    }
}
