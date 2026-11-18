<?php

namespace App\Sections;

/**
 * Sample pages for the Coffee Shop template: signature drinks, the brand story, outlets and
 * contact.
 */
class CoffeeShopContent
{
    /**
     * @return list<array<string, mixed>>
     */
    public static function pages(string $company): array
    {
        $menu = [
            ['name' => 'Es Kopi Susu Aren', 'description' => 'Espresso, susu segar, dan gula aren asli. Favorit sepanjang masa.', 'info' => 'Best seller', 'price' => 'Rp22.000', 'image' => 'demo/kopi-aren.jpg'],
            ['name' => 'Cappuccino', 'description' => 'Espresso dengan foam susu lembut dan latte art.', 'info' => 'Hot', 'price' => 'Rp25.000', 'image' => 'demo/kopi-cappuccino.jpg'],
            ['name' => 'Iced Matcha Latte', 'description' => 'Matcha Jepang premium dengan susu segar.', 'info' => 'Non-kopi', 'price' => 'Rp27.000', 'image' => 'demo/kopi-matcha.jpg'],
            ['name' => 'Iced Americano', 'description' => 'Espresso double shot dan air dingin, segar tanpa gula.', 'info' => 'Less sugar', 'price' => 'Rp20.000', 'image' => 'demo/kopi-americano.jpg'],
            ['name' => 'Iced Chocolate', 'description' => 'Cokelat pekat dengan whipped cream di atasnya.', 'info' => 'Non-kopi', 'price' => 'Rp26.000', 'image' => 'demo/kopi-chocolate.jpg'],
            ['name' => 'Donat & Croissant', 'description' => 'Teman ngopi yang dipanggang segar setiap pagi.', 'info' => 'Pastry', 'price' => 'Rp15.000', 'image' => 'demo/kopi-pastry.jpg'],
        ];

        $cta = [
            'title' => 'Ngopi sekarang, nggak pakai antre',
            'text' => 'Pesan lewat WhatsApp atau aplikasi ojek online favoritmu. Kopi siap diantar.',
            'button_label' => 'Pesan Sekarang',
            'button_url' => '/kontak',
        ];

        return [
            [
                'title' => 'Beranda',
                'slug' => 'beranda',
                'is_home' => true,
                'sections' => [
                    ['type' => 'hero', 'data' => [
                        'eyebrow' => 'Menu baru: Es Kopi Susu Aren',
                        'title' => 'Kopi baik untuk harimu',
                        'subtitle' => "{$company} menyeduh biji kopi Nusantara pilihan, dipanggang sendiri, untuk secangkir semangat setiap hari.",
                        'button_label' => 'Lihat Menu',
                        'button_url' => '/menu',
                        'button2_label' => 'Cari Gerai',
                        'button2_url' => '/gerai',
                        'image' => 'demo/kopi-hero.jpg',
                    ]],
                    ['type' => 'pricelist', 'data' => [
                        'title' => 'Minuman favorit',
                        'subtitle' => 'Paling sering dipesan pelanggan setia kami.',
                        'items' => array_slice($menu, 0, 3),
                        'order_button' => 'yes',
                    ]],
                    ['type' => 'image_text', 'data' => [
                        'title' => 'Cerita kami',
                        'body' => "Berawal dari kecintaan pada kopi Indonesia, {$company} lahir untuk menghadirkan kopi spesial yang bisa dinikmati setiap hari.\n\nBiji kopi kami ambil langsung dari petani di dataran tinggi Nusantara, dipanggang sendiri, dan diseduh barista terlatih.",
                        'image' => 'demo/kopi-barista.jpg',
                        'image_position' => 'left',
                        'button_label' => 'Selengkapnya',
                        'button_url' => '/tentang',
                    ]],
                    ['type' => 'stats', 'data' => [
                        'items' => [
                            ['value' => '25+', 'label' => 'Gerai'],
                            ['value' => '1 juta+', 'label' => 'Cangkir per tahun'],
                            ['value' => '12', 'label' => 'Petani mitra'],
                            ['value' => '4,8/5', 'label' => 'Rating pelanggan'],
                        ],
                    ]],
                    ['type' => 'testimonials', 'data' => [
                        'title' => 'Kata mereka',
                        'items' => [
                            ['quote' => 'Es kopi susu arennya pas banget, manisnya nggak berlebihan. Jadi langganan tiap pagi sebelum kerja.', 'name' => 'Dinda', 'role' => 'Pelanggan setia'],
                            ['quote' => 'Tempatnya nyaman buat kerja, Wi-Fi kencang, baristanya ramah.', 'name' => 'Reza', 'role' => 'Freelancer'],
                            ['quote' => 'Kami pesan untuk acara kantor 100 cup, datang tepat waktu dan rasanya konsisten.', 'name' => 'Maya', 'role' => 'HR Manager'],
                        ],
                    ]],
                    ['type' => 'cta', 'data' => $cta],
                ],
            ],
            [
                'title' => 'Menu',
                'slug' => 'menu',
                'sections' => [
                    ['type' => 'page_header', 'data' => [
                        'title' => 'Menu Kami',
                        'subtitle' => 'Dari kopi klasik sampai minuman non-kopi yang menyegarkan.',
                    ]],
                    ['type' => 'pricelist', 'data' => [
                        'title' => 'Signature',
                        'items' => $menu,
                        'note' => 'Bisa request less sugar, less ice, atau ganti susu oat (+Rp5.000).',
                        'order_button' => 'yes',
                    ]],
                    ['type' => 'pricelist', 'data' => [
                        'title' => 'Tambahan',
                        'items' => [
                            ['name' => 'Extra shot espresso', 'price' => 'Rp6.000'],
                            ['name' => 'Ganti susu oat', 'price' => 'Rp5.000'],
                            ['name' => 'Sirup (vanila, hazelnut, karamel)', 'price' => 'Rp5.000'],
                            ['name' => 'Ukuran besar (Large)', 'price' => 'Rp4.000'],
                        ],
                        'order_button' => 'no',
                    ]],
                ],
            ],
            [
                'title' => 'Tentang',
                'slug' => 'tentang',
                'sections' => [
                    ['type' => 'page_header', 'data' => [
                        'title' => 'Cerita Kami',
                        'subtitle' => 'Tumbuh bersama petani, barista, dan pencinta kopi Indonesia.',
                    ]],
                    ['type' => 'image_text', 'data' => [
                        'title' => 'Dari kebun ke cangkirmu',
                        'body' => "Kami bekerja langsung dengan petani kopi di Gayo, Toraja, dan Flores. Harga yang adil untuk petani, kualitas terbaik untuk kamu.\n\n- Biji kopi dipanggang sendiri setiap minggu\n- Barista terlatih dan bersertifikat\n- Gula aren asli tanpa pemanis buatan",
                        'image' => 'demo/kopi-farmer.jpg',
                        'image_position' => 'right',
                    ]],
                    ['type' => 'services', 'data' => [
                        'title' => 'Yang kami pegang',
                        'items' => [
                            ['title' => 'Kopi Nusantara', 'text' => '100% biji kopi dari petani Indonesia.'],
                            ['title' => 'Segar setiap hari', 'text' => 'Diseduh saat dipesan, bukan dari stok kemarin.'],
                            ['title' => 'Ramah lingkungan', 'text' => 'Diskon untuk pelanggan yang membawa tumbler sendiri.'],
                        ],
                    ]],
                    ['type' => 'gallery', 'data' => [
                        'items' => [
                            ['image' => 'demo/kopi-interior.jpg', 'caption' => 'Suasana gerai'],
                            ['image' => 'demo/kopi-barista.jpg', 'caption' => 'Barista kami'],
                            ['image' => 'demo/kopi-farmer.jpg', 'caption' => 'Panen kopi bersama petani'],
                        ],
                    ]],
                ],
            ],
            [
                'title' => 'Gerai',
                'slug' => 'gerai',
                'sections' => [
                    ['type' => 'page_header', 'data' => [
                        'title' => 'Gerai Kami',
                        'subtitle' => 'Mampir ke gerai terdekat, atau pesan antar dari rumah.',
                    ]],
                    ['type' => 'pricelist', 'data' => [
                        'title' => 'Lokasi gerai',
                        'items' => [
                            ['name' => 'Gerai Kemang', 'description' => 'Jl. Kemang Raya No. 12, Jakarta Selatan', 'info' => '07.00–22.00', 'price' => 'Dine-in'],
                            ['name' => 'Gerai Senopati', 'description' => 'Jl. Senopati No. 45, Jakarta Selatan', 'info' => '07.00–22.00', 'price' => 'Dine-in'],
                            ['name' => 'Gerai Dago', 'description' => 'Jl. Ir. H. Juanda No. 88, Bandung', 'info' => '08.00–22.00', 'price' => 'Dine-in'],
                            ['name' => 'Gerai Stasiun Sudirman', 'description' => 'Area komersial Stasiun Sudirman, Jakarta', 'info' => '06.00–20.00', 'price' => 'Grab & go'],
                        ],
                        'order_button' => 'no',
                    ]],
                    ['type' => 'image_text', 'data' => [
                        'title' => 'Tempat nyaman untuk kerja dan ngobrol',
                        'body' => "Setiap gerai dilengkapi Wi-Fi cepat, colokan di setiap meja, dan area outdoor.\n\nCocok untuk kerja, meeting kecil, atau sekadar santai bersama teman.",
                        'image' => 'demo/kopi-interior.jpg',
                        'image_position' => 'left',
                    ]],
                ],
            ],
            [
                'title' => 'Kontak',
                'slug' => 'kontak',
                'sections' => [
                    ['type' => 'page_header', 'data' => [
                        'title' => 'Hubungi Kami',
                        'subtitle' => 'Pesanan acara, kerja sama, atau sekadar menyapa.',
                    ]],
                    ['type' => 'contact', 'data' => [
                        'title' => 'Halo!',
                        'text' => 'Untuk pesanan dalam jumlah besar dan acara kantor, hubungi kami lewat WhatsApp atau form ini.',
                        'show_form' => 'yes',
                    ]],
                ],
            ],
        ];
    }
}
