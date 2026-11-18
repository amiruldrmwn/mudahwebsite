<?php

namespace App\Sections;

/**
 * Sample pages for the Rental Mobil template: fleet with daily prices, self-drive or with a
 * driver, terms and booking.
 */
class CarRentalContent
{
    /**
     * @return list<array<string, mixed>>
     */
    public static function pages(string $company): array
    {
        $fleet = [
            ['image' => 'demo/car-mpv.jpg', 'name' => 'Toyota Avanza / Xenia', 'category' => 'MPV · 7 kursi', 'badge' => 'Terlaris', 'specs' => "7 penumpang\nManual / Matic\nBensin\nAC dingin", 'price' => 'Rp350.000', 'unit' => '/hari'],
            ['image' => 'demo/car-suv.jpg', 'name' => 'Toyota Fortuner / Pajero', 'category' => 'SUV · 7 kursi', 'specs' => "7 penumpang\nMatic\nDiesel\nCocok luar kota", 'price' => 'Rp1.100.000', 'unit' => '/hari'],
            ['image' => 'demo/car-city.jpg', 'name' => 'Honda Brio / Agya', 'category' => 'City car · 5 kursi', 'specs' => "5 penumpang\nMatic\nIrit BBM\nMudah parkir", 'price' => 'Rp275.000', 'unit' => '/hari'],
            ['image' => 'demo/car-van.jpg', 'name' => 'Toyota Alphard', 'category' => 'Premium MPV', 'badge' => 'Premium', 'specs' => "7 penumpang\nMatic\nKursi captain\nDengan sopir", 'price' => 'Rp2.500.000', 'unit' => '/hari'],
            ['image' => 'demo/car-mpv.jpg', 'name' => 'Toyota Innova Zenix', 'category' => 'MPV · 7 kursi', 'specs' => "7 penumpang\nMatic\nHybrid\nNyaman & lega", 'price' => 'Rp650.000', 'unit' => '/hari'],
            ['image' => 'demo/car-van.jpg', 'name' => 'Toyota Hiace', 'category' => 'Minibus · 14 kursi', 'specs' => "14 penumpang\nDengan sopir\nRombongan & wisata", 'price' => 'Rp1.300.000', 'unit' => '/hari'],
        ];

        $cta = ['title' => 'Butuh mobil hari ini?', 'text' => 'Chat admin kami, unit bisa diantar ke rumah, hotel, atau bandara.', 'button_label' => 'Sewa Sekarang', 'button_url' => '/kontak'];

        return [
            ['title' => 'Beranda', 'slug' => 'beranda', 'is_home' => true, 'sections' => [
                ['type' => 'hero', 'data' => [
                    'eyebrow' => 'Antar jemput bandara & hotel',
                    'title' => 'Sewa mobil mudah, siap jalan kapan saja',
                    'subtitle' => "{$company} menyediakan mobil bersih dan terawat, lepas kunci atau dengan sopir berpengalaman, dengan harga jelas tanpa biaya tersembunyi.",
                    'button_label' => 'Lihat Armada', 'button_url' => '/armada',
                    'button2_label' => 'Cek Harga', 'button2_url' => '/armada',
                    'image' => 'demo/car-hero.jpg',
                ]],
                ['type' => 'catalog', 'data' => ['title' => 'Armada favorit', 'subtitle' => 'Harga per 24 jam. Lepas kunci atau dengan sopir.', 'items' => array_slice($fleet, 0, 3), 'button_label' => 'Sewa']],
                ['type' => 'services', 'data' => ['title' => 'Kenapa sewa di kami?', 'items' => [
                    ['title' => 'Unit bersih & terawat', 'text' => 'Servis rutin, dicuci sebelum diserahkan.'],
                    ['title' => 'Antar ke lokasi', 'text' => 'Diantar ke rumah, hotel, atau bandara.'],
                    ['title' => 'Sopir berpengalaman', 'text' => 'Ramah, hafal rute, dan tepat waktu.'],
                    ['title' => 'Harga transparan', 'text' => 'Tanpa biaya tersembunyi, bisa harian atau bulanan.'],
                ]]],
                ['type' => 'steps', 'data' => ['title' => 'Cara sewa', 'items' => [
                    ['title' => 'Pilih mobil', 'text' => 'Tentukan unit, tanggal, dan lokasi penjemputan.'],
                    ['title' => 'Kirim dokumen', 'text' => 'KTP dan SIM A untuk lepas kunci.'],
                    ['title' => 'Bayar DP', 'text' => 'Transfer uang muka untuk mengunci jadwal.'],
                    ['title' => 'Mobil diantar', 'text' => 'Unit siap di lokasi sesuai jadwal.'],
                ]]],
                ['type' => 'testimonials', 'data' => ['title' => 'Kata pelanggan', 'items' => [
                    ['quote' => 'Mobilnya bersih dan wangi, diantar tepat waktu ke bandara. Pasti sewa lagi.', 'name' => 'Rizky', 'role' => 'Liburan keluarga'],
                    ['quote' => 'Sopirnya ramah dan hafal jalan. Perjalanan dinas jadi lancar.', 'name' => 'Ibu Nita', 'role' => 'Perjalanan bisnis'],
                    ['quote' => 'Harga jelas dari awal, proses cepat cukup lewat WhatsApp.', 'name' => 'Andre', 'role' => 'Sewa lepas kunci'],
                ]]],
                ['type' => 'cta', 'data' => $cta],
            ]],
            ['title' => 'Armada', 'slug' => 'armada', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Armada & Harga', 'subtitle' => 'Pilih mobil sesuai kebutuhan perjalanan Anda.']],
                ['type' => 'catalog', 'data' => ['items' => $fleet, 'button_label' => 'Sewa']],
                ['type' => 'pricelist', 'data' => ['title' => 'Biaya tambahan', 'items' => [
                    ['name' => 'Sopir', 'info' => '12 jam', 'price' => 'Rp200.000'],
                    ['name' => 'BBM (paket dalam kota)', 'info' => 'Per hari', 'price' => 'Rp200.000'],
                    ['name' => 'Antar jemput bandara', 'info' => 'Sekali jalan', 'price' => 'Rp100.000'],
                    ['name' => 'Overtime', 'info' => 'Per jam', 'price' => 'Rp50.000'],
                ], 'order_button' => 'yes']],
            ]],
            ['title' => 'Layanan', 'slug' => 'layanan', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Layanan Kami', 'subtitle' => 'Dari harian sampai kontrak bulanan perusahaan.']],
                ['type' => 'services', 'data' => ['items' => [
                    ['title' => 'Lepas kunci', 'text' => 'Kemudikan sendiri dengan SIM A, cocok untuk liburan keluarga.', 'image' => 'demo/car-hero.jpg'],
                    ['title' => 'Dengan sopir', 'text' => 'Santai di perjalanan, sopir kami yang mengemudi.', 'image' => 'demo/car-driver.jpg'],
                    ['title' => 'Antar jemput bandara', 'text' => 'Dijemput tepat waktu dengan papan nama.', 'image' => 'demo/car-van.jpg'],
                ]]],
                ['type' => 'image_text', 'data' => ['title' => 'Sewa bulanan untuk perusahaan', 'body' => "Kontrak sewa bulanan atau tahunan untuk operasional kantor, lengkap dengan perawatan dan mobil pengganti.\n\n- Harga khusus korporat\n- Servis dan asuransi ditanggung\n- Mobil pengganti bila ada kendala", 'image' => 'demo/car-driver.jpg', 'image_position' => 'left', 'button_label' => 'Minta Penawaran', 'button_url' => '/kontak']],
                ['type' => 'faq', 'data' => ['title' => 'Syarat & pertanyaan', 'items' => [
                    ['question' => 'Apa syarat sewa lepas kunci?', 'answer' => 'KTP, SIM A aktif, dan satu identitas pendukung (NPWP/kartu kerja). Deposit sesuai unit.'],
                    ['question' => 'Apakah harga sudah termasuk BBM?', 'answer' => 'Belum. BBM, tol, dan parkir ditanggung penyewa, kecuali memilih paket all-in.'],
                    ['question' => 'Bisa sewa ke luar kota?', 'answer' => 'Bisa, dengan pemberitahuan di awal. Ada tambahan biaya untuk sopir menginap.'],
                ]]],
            ]],
            ['title' => 'Kontak', 'slug' => 'kontak', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Pesan Mobil', 'subtitle' => 'Admin siap 24 jam. Respons tercepat via WhatsApp.']],
                ['type' => 'contact', 'data' => ['title' => 'Kirim detail sewa', 'text' => 'Sebutkan unit, tanggal, lama sewa, lokasi jemput, dan lepas kunci atau dengan sopir.', 'show_form' => 'yes']],
            ]],
        ];
    }
}
