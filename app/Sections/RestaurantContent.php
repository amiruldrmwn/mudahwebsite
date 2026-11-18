<?php

namespace App\Sections;

/**
 * Sample pages for the Restoran & Rumah Makan template: signature dishes, full menu by category,
 * story, outlets and reservations.
 */
class RestaurantContent
{
    /**
     * @return list<array<string, mixed>>
     */
    public static function pages(string $company): array
    {
        $signature = [
            ['name' => 'Ayam Bakar Madu', 'description' => 'Ayam kampung bakar bumbu kecap madu, nasi, lalapan, dan sambal.', 'info' => 'Favorit', 'price' => 'Rp38.000', 'image' => 'demo/resto-ayam.jpg'],
            ['name' => 'Nasi Goreng Spesial', 'description' => 'Nasi goreng kampung dengan telur, sate ayam, dan kerupuk.', 'info' => 'Pedas level', 'price' => 'Rp32.000', 'image' => 'demo/resto-nasgor.jpg'],
            ['name' => 'Soto Ayam Lamongan', 'description' => 'Kuah kuning gurih, koya, telur, dan soun.', 'info' => 'Berkuah', 'price' => 'Rp28.000', 'image' => 'demo/resto-soto.jpg'],
        ];

        $cta = ['title' => 'Pesan meja untuk acara keluarga', 'text' => 'Tersedia ruang privat untuk 20–50 orang. Bisa pesan paket prasmanan.', 'button_label' => 'Reservasi', 'button_url' => '/kontak'];

        return [
            ['title' => 'Beranda', 'slug' => 'beranda', 'is_home' => true, 'sections' => [
                ['type' => 'hero', 'data' => [
                    'eyebrow' => 'Masakan Nusantara sejak 1998',
                    'title' => 'Rasa rumahan yang bikin kangen',
                    'subtitle' => "{$company} menyajikan masakan Nusantara dari resep keluarga, dimasak segar setiap hari dengan bumbu rempah pilihan.",
                    'button_label' => 'Lihat Menu', 'button_url' => '/menu',
                    'button2_label' => 'Reservasi', 'button2_url' => '/kontak',
                    'image' => 'demo/resto-hero.jpg',
                ]],
                ['type' => 'pricelist', 'data' => ['title' => 'Menu andalan', 'subtitle' => 'Paling sering dipesan pelanggan setia kami.', 'items' => $signature, 'order_button' => 'yes']],
                ['type' => 'image_text', 'data' => ['title' => 'Dari dapur keluarga', 'body' => "Berawal dari warung kecil pada 1998, {$company} kini melayani ribuan pelanggan setiap bulan tanpa meninggalkan resep aslinya.\n\nBumbu diulek setiap pagi, ayam kampung dari peternak lokal, dan sambal dibuat segar.", 'image' => 'demo/resto-chef.jpg', 'image_position' => 'left', 'button_label' => 'Cerita kami', 'button_url' => '/tentang']],
                ['type' => 'stats', 'data' => ['items' => [
                    ['value' => '25+', 'label' => 'Tahun melayani'],
                    ['value' => '4', 'label' => 'Cabang'],
                    ['value' => '60+', 'label' => 'Menu Nusantara'],
                    ['value' => '4,7/5', 'label' => 'Rating pelanggan'],
                ]]],
                ['type' => 'testimonials', 'data' => ['title' => 'Kata pelanggan', 'items' => [
                    ['quote' => 'Ayam bakarnya juara, bumbunya meresap sampai ke dalam. Sambalnya bikin nagih.', 'name' => 'Pak Hendra', 'role' => 'Pelanggan sejak 2010'],
                    ['quote' => 'Tempatnya nyaman buat makan bareng keluarga besar. Pelayanan cepat.', 'name' => 'Ibu Wati', 'role' => 'Acara keluarga'],
                    ['quote' => 'Soto ayamnya mengingatkan masakan nenek. Harganya juga bersahabat.', 'name' => 'Rani', 'role' => 'Mahasiswa'],
                ]]],
                ['type' => 'cta', 'data' => $cta],
            ]],
            ['title' => 'Menu', 'slug' => 'menu', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Menu Kami', 'subtitle' => 'Klik Pesan untuk pesan antar via WhatsApp.']],
                ['type' => 'pricelist', 'data' => ['title' => 'Makanan', 'items' => [
                    ...$signature,
                    ['name' => 'Sate Ayam (10 tusuk)', 'description' => 'Bumbu kacang dan lontong.', 'price' => 'Rp35.000', 'image' => 'demo/resto-hero.jpg'],
                ], 'order_button' => 'yes']],
                ['type' => 'pricelist', 'data' => ['title' => 'Minuman', 'items' => [
                    ['name' => 'Es Teh Manis', 'price' => 'Rp6.000'],
                    ['name' => 'Es Jeruk Peras', 'price' => 'Rp10.000'],
                    ['name' => 'Es Campur', 'price' => 'Rp18.000'],
                    ['name' => 'Wedang Jahe', 'price' => 'Rp12.000'],
                    ['name' => 'Kopi Tubruk', 'price' => 'Rp10.000'],
                ], 'order_button' => 'no']],
                ['type' => 'image_text', 'data' => ['title' => 'Minuman segar pelepas dahaga', 'body' => 'Es teh manis, es jeruk peras, sampai es campur dengan topping melimpah.', 'image' => 'demo/resto-drinks.jpg', 'image_position' => 'right']],
                ['type' => 'pricelist', 'data' => ['title' => 'Paket prasmanan', 'items' => [
                    ['name' => 'Paket Hemat', 'description' => 'Nasi, 1 lauk, sayur, kerupuk, air mineral.', 'info' => 'Min. 30 pax', 'price' => 'Rp35.000/pax'],
                    ['name' => 'Paket Komplit', 'description' => 'Nasi, 2 lauk, sayur, sambal, buah, es teh.', 'info' => 'Min. 30 pax', 'price' => 'Rp55.000/pax'],
                ], 'order_button' => 'yes']],
            ]],
            ['title' => 'Tentang', 'slug' => 'tentang', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Cerita Kami', 'subtitle' => 'Resep keluarga yang dijaga lintas generasi.']],
                ['type' => 'image_text', 'data' => ['title' => 'Dimasak dengan cinta sejak 1998', 'body' => 'Ibu Siti memulai warung kecil di depan rumah dengan tiga menu andalan. Kini usaha keluarga ini dijalankan anak dan cucunya, dengan resep yang sama.', 'image' => 'demo/resto-chef.jpg', 'image_position' => 'right']],
                ['type' => 'gallery', 'data' => ['title' => 'Suasana', 'items' => [
                    ['image' => 'demo/resto-interior.jpg', 'caption' => 'Ruang makan'],
                    ['image' => 'demo/resto-chef.jpg', 'caption' => 'Dapur terbuka'],
                    ['image' => 'demo/resto-hero.jpg', 'caption' => 'Hidangan Nusantara'],
                ]]],
                ['type' => 'pricelist', 'data' => ['title' => 'Cabang kami', 'items' => [
                    ['name' => 'Cabang Pusat', 'description' => 'Jl. Merdeka No. 10', 'info' => '10.00–22.00', 'price' => 'Dine-in'],
                    ['name' => 'Cabang Kota Baru', 'description' => 'Ruko Kota Baru Blok B2', 'info' => '10.00–22.00', 'price' => 'Dine-in'],
                    ['name' => 'Cabang Mal Raya', 'description' => 'Food court lantai 3', 'info' => '10.00–21.30', 'price' => 'Express'],
                ], 'order_button' => 'no']],
            ]],
            ['title' => 'Kontak', 'slug' => 'kontak', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Reservasi & Pesan Antar', 'subtitle' => 'Buka setiap hari 10.00–22.00.']],
                ['type' => 'contact', 'data' => ['title' => 'Pesan meja', 'text' => 'Sebutkan tanggal, jam, jumlah orang, dan cabang pilihan.', 'show_form' => 'yes']],
            ]],
        ];
    }
}
