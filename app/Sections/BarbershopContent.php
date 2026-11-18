<?php

namespace App\Sections;

/**
 * Sample pages for the Barbershop template: services and prices, the barbers, a gallery of cuts
 * and booking.
 */
class BarbershopContent
{
    /**
     * @return list<array<string, mixed>>
     */
    public static function pages(string $company): array
    {
        $cuts = [
            ['name' => 'Premium Cut', 'description' => 'Konsultasi gaya, potong, keramas, pijat kepala, hot towel, dan styling.', 'info' => '60 menit', 'price' => '75K'],
            ['name' => 'Regular Cut', 'description' => 'Potong rambut, keramas, dan styling.', 'info' => '40 menit', 'price' => '55K'],
            ['name' => 'Kids Cut', 'description' => 'Untuk anak di bawah 12 tahun.', 'info' => '30 menit', 'price' => '45K'],
            ['name' => 'Shaving & Beard Trim', 'description' => 'Cukur bersih atau rapikan janggut dengan pisau cukur dan hot towel.', 'info' => '30 menit', 'price' => '40K'],
        ];

        $color = [
            ['name' => 'Hair Coloring Black/Brown', 'description' => 'Warna hitam atau cokelat gelap yang berkilau.', 'price' => '120K'],
            ['name' => 'Highlight', 'description' => 'Tambahan highlight untuk kesan modern.', 'price' => '300K'],
            ['name' => 'Hair Perming', 'description' => 'Tekstur ikal atau bergelombang yang tahan lama.', 'price' => '350K'],
            ['name' => 'Creambath', 'description' => 'Keramas, creambath, pijat, dan styling.', 'price' => '60K'],
        ];

        $cta = [
            'title' => 'Siap tampil beda?',
            'text' => 'Booking jadwalmu sekarang, tanpa antre. Walk-in juga tetap kami layani.',
            'button_label' => 'Booking Sekarang',
            'button_url' => '/kontak',
        ];

        $barbers = [
            ['photo' => 'demo/barber-1.jpg', 'name' => 'Bima', 'role' => 'Head Barber · Fade specialist'],
            ['photo' => 'demo/barber-2.jpg', 'name' => 'Dika', 'role' => 'Barber · Pompadour & texture'],
            ['photo' => 'demo/barber-3.jpg', 'name' => 'Pak Hadi', 'role' => 'Senior Barber · Classic cut & shave'],
        ];

        return [
            [
                'title' => 'Beranda',
                'slug' => 'beranda',
                'is_home' => true,
                'sections' => [
                    ['type' => 'hero', 'data' => [
                        'eyebrow' => 'Barbershop sejak 2015',
                        'title' => 'Sharp cut. Fresh look.',
                        'subtitle' => "Potongan rapi, suasana santai, dan barber yang paham gaya kamu. Selamat datang di {$company}.",
                        'button_label' => 'Booking Sekarang',
                        'button_url' => '/kontak',
                        'button2_label' => 'Lihat Harga',
                        'button2_url' => '/harga',
                        'image' => 'demo/barber-hero.jpg',
                    ]],
                    ['type' => 'services', 'data' => [
                        'title' => 'Layanan kami',
                        'items' => [
                            ['title' => 'Haircut', 'text' => 'Fade, undercut, crop, pompadour, sampai classic cut.', 'image' => 'demo/barber-result.jpg'],
                            ['title' => 'Shaving & Beard', 'text' => 'Cukur bersih atau rapikan janggut dengan hot towel.', 'image' => 'demo/barber-shave.jpg'],
                            ['title' => 'Styling & Coloring', 'text' => 'Pomade, perming, coloring, dan highlight.', 'image' => 'demo/barber-styling.jpg'],
                        ],
                    ]],
                    ['type' => 'pricelist', 'data' => [
                        'title' => 'Harga',
                        'items' => $cuts,
                        'note' => 'Semua potong rambut sudah termasuk keramas dan styling.',
                        'order_button' => 'yes',
                    ]],
                    ['type' => 'team', 'data' => [
                        'title' => 'Barber kami',
                        'items' => $barbers,
                    ]],
                    ['type' => 'testimonials', 'data' => [
                        'title' => 'Kata pelanggan',
                        'items' => [
                            ['quote' => 'Fade-nya rapi banget, detail sampai garis pinggir. Sudah 2 tahun nggak pindah ke barbershop lain.', 'name' => 'Arya', 'role' => 'Pelanggan'],
                            ['quote' => 'Tempatnya nyaman, barbernya asik diajak ngobrol dan kasih saran gaya yang cocok.', 'name' => 'Fadli', 'role' => 'Pelanggan'],
                            ['quote' => 'Booking lewat WhatsApp gampang, datang langsung dilayani tanpa antre.', 'name' => 'Kevin', 'role' => 'Pelanggan'],
                        ],
                    ]],
                    ['type' => 'cta', 'data' => $cta],
                ],
            ],
            [
                'title' => 'Harga',
                'slug' => 'harga',
                'sections' => [
                    ['type' => 'page_header', 'data' => [
                        'title' => 'Layanan & Harga',
                        'subtitle' => 'Harga jelas, tanpa biaya tambahan.',
                        'image' => 'demo/barber-interior.jpg',
                    ]],
                    ['type' => 'pricelist', 'data' => [
                        'title' => 'Haircut & Shave',
                        'items' => $cuts,
                        'order_button' => 'no',
                    ]],
                    ['type' => 'pricelist', 'data' => [
                        'title' => 'Coloring & Treatment',
                        'items' => $color,
                        'note' => 'Harga coloring dapat berbeda sesuai panjang rambut.',
                        'order_button' => 'yes',
                    ]],
                    ['type' => 'faq', 'data' => [
                        'title' => 'Pertanyaan umum',
                        'items' => [
                            ['question' => 'Apakah harus booking dulu?', 'answer' => 'Tidak wajib, tapi booking membuat kamu langsung dilayani tanpa antre.'],
                            ['question' => 'Jam buka?', 'answer' => 'Setiap hari pukul 10.00–22.00, termasuk hari libur.'],
                            ['question' => 'Bisa bayar non-tunai?', 'answer' => 'Bisa, kami menerima QRIS, kartu debit, dan kartu kredit.'],
                        ],
                    ]],
                ],
            ],
            [
                'title' => 'Tentang',
                'slug' => 'tentang',
                'sections' => [
                    ['type' => 'page_header', 'data' => [
                        'title' => 'Tentang Kami',
                        'subtitle' => 'Lebih dari sekadar potong rambut.',
                        'image' => 'demo/barber-interior.jpg',
                    ]],
                    ['type' => 'image_text', 'data' => [
                        'title' => 'Your look, your legacy',
                        'body' => "{$company} hadir untuk pria yang peduli penampilan. Setiap potongan dimulai dengan konsultasi, supaya hasilnya sesuai bentuk wajah dan gaya hidupmu.\n\nBarber kami terus belajar teknik terbaru, dengan peralatan yang selalu disterilkan.",
                        'image' => 'demo/barber-styling.jpg',
                        'image_position' => 'right',
                    ]],
                    ['type' => 'stats', 'data' => [
                        'items' => [
                            ['value' => '10+', 'label' => 'Tahun pengalaman'],
                            ['value' => '50.000+', 'label' => 'Kepala dicukur'],
                            ['value' => '6', 'label' => 'Barber profesional'],
                            ['value' => '4,9', 'label' => 'Rating Google'],
                        ],
                    ]],
                    ['type' => 'team', 'data' => [
                        'title' => 'Tim barber',
                        'items' => $barbers,
                    ]],
                ],
            ],
            [
                'title' => 'Galeri',
                'slug' => 'galeri',
                'sections' => [
                    ['type' => 'page_header', 'data' => [
                        'title' => 'Galeri',
                        'subtitle' => 'Hasil potongan dan suasana barbershop kami.',
                        'image' => 'demo/barber-hero.jpg',
                    ]],
                    ['type' => 'gallery', 'data' => [
                        'items' => [
                            ['image' => 'demo/barber-result.jpg', 'caption' => 'Textured crop & skin fade'],
                            ['image' => 'demo/barber-hero.jpg', 'caption' => 'Skin fade'],
                            ['image' => 'demo/barber-shave.jpg', 'caption' => 'Hot towel shave'],
                            ['image' => 'demo/barber-styling.jpg', 'caption' => 'Pomade styling'],
                            ['image' => 'demo/barber-interior.jpg', 'caption' => 'Ruang potong'],
                            ['image' => 'demo/barber-1.jpg', 'caption' => 'Head barber kami'],
                        ],
                    ]],
                    ['type' => 'cta', 'data' => $cta],
                ],
            ],
            [
                'title' => 'Kontak',
                'slug' => 'kontak',
                'sections' => [
                    ['type' => 'page_header', 'data' => [
                        'title' => 'Booking',
                        'subtitle' => 'Buka setiap hari, 10.00–22.00.',
                        'image' => 'demo/barber-interior.jpg',
                    ]],
                    ['type' => 'contact', 'data' => [
                        'title' => 'Atur jadwalmu',
                        'text' => 'Booking lewat WhatsApp untuk respons tercepat. Sebutkan layanan, tanggal, jam, dan barber pilihanmu.',
                        'show_form' => 'yes',
                    ]],
                ],
            ],
        ];
    }
}
