<?php

namespace App\Sections;

/**
 * Sample pages for the Catering template: rice boxes, buffets and tumpeng, packages for events,
 * ordering steps and contact.
 */
class CateringContent
{
    /**
     * @return list<array<string, mixed>>
     */
    public static function pages(string $company): array
    {
        $menu = ['type' => 'pricelist', 'data' => ['title' => 'Menu favorit', 'subtitle' => 'Dimasak di hari yang sama dengan bahan segar.', 'items' => [
            ['name' => 'Nasi Box Ayam Bakar', 'description' => 'Nasi, ayam bakar, sayur, sambal, kerupuk.', 'info' => 'min. 20 box', 'price' => 'Rp28.000', 'image' => 'demo/catering-box.jpg'],
            ['name' => 'Paket Sate Nusantara', 'description' => 'Sate ayam, lontong, dan aneka lauk.', 'info' => 'min. 30 porsi', 'price' => 'Rp35.000', 'image' => 'demo/catering-sate.jpg'],
            ['name' => 'Prasmanan Rumahan', 'description' => '2 lauk, sayur, buah, air mineral.', 'info' => 'min. 50 pax', 'price' => 'Rp45.000', 'image' => 'demo/catering-spread.jpg'],
        ], 'order_button' => 'yes']];

        $plans = ['type' => 'plans', 'data' => ['title' => 'Paket acara', 'subtitle' => 'Untuk syukuran, kantor, arisan, sampai pernikahan.', 'items' => [
            ['name' => 'Hemat', 'price' => 'Rp35rb', 'info' => 'per pax, min. 50', 'features' => "Nasi + 2 lauk\nSayur & kerupuk\nAir mineral", 'highlight' => 'no'],
            ['name' => 'Favorit', 'badge' => 'Paling dipesan', 'price' => 'Rp55rb', 'info' => 'per pax, min. 50', 'features' => "Nasi + 3 lauk\nSayur, buah, puding\nPeralatan saji\n2 pramusaji", 'highlight' => 'yes'],
            ['name' => 'Istimewa', 'price' => 'Rp85rb', 'info' => 'per pax, min. 100', 'features' => "Prasmanan lengkap\nGubukan 2 menu\nDekor meja saji\n4 pramusaji", 'highlight' => 'no'],
        ], 'note' => 'Harga sudah termasuk ongkir dalam kota.']];

        return [
            ['title' => 'Beranda', 'slug' => 'beranda', 'is_home' => true, 'sections' => [
                ['type' => 'hero', 'data' => [
                    'eyebrow' => 'Katering rumahan sejak 2012',
                    'title' => 'Rasa *rumahan* untuk setiap acara Anda',
                    'subtitle' => "{$company} menyiapkan nasi box, prasmanan, dan tumpeng dengan bumbu asli dan porsi yang pas. Tepat waktu, rapi, dan higienis.",
                    'button_label' => 'Lihat Menu', 'button_url' => '/menu',
                    'button2_label' => 'Paket Acara', 'button2_url' => '/menu',
                    'image' => 'demo/catering-buffet.jpg',
                ]],
                $menu,
                ['type' => 'image_text', 'data' => ['title' => 'Dapur bersih, bahan segar setiap hari', 'body' => "Semua masakan disiapkan di dapur kami sendiri yang bersertifikat PIRT dan halal.\n\n- Tanpa pengawet\n- Bumbu racikan sendiri\n- Diantar hangat tepat waktu", 'image' => 'demo/catering-event.jpg', 'image_position' => 'left']],
                $plans,
                ['type' => 'testimonials', 'data' => ['title' => 'Kata pelanggan', 'items' => [
                    ['quote' => 'Nasi box untuk 200 karyawan datang tepat waktu dan semuanya habis!', 'name' => 'Bu Rina', 'role' => 'HRD perusahaan'],
                    ['quote' => 'Prasmanan syukuran rumah kami jadi sukses, tamu banyak yang tanya kateringnya.', 'name' => 'Keluarga Hadi', 'role' => 'Syukuran'],
                    ['quote' => 'Rasanya seperti masakan ibu sendiri. Langganan tiap arisan.', 'name' => 'Mbak Sari', 'role' => 'Arisan RT'],
                ]]],
                ['type' => 'cta', 'data' => ['title' => 'Ada acara sebentar lagi?', 'text' => 'Ceritakan jumlah tamu dan tanggalnya, kami bantu susun menunya.', 'button_label' => 'Konsultasi Menu', 'button_url' => '/kontak']],
            ]],
            ['title' => 'Menu', 'slug' => 'menu', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Menu & Paket', 'subtitle' => 'Bisa disesuaikan dengan selera dan anggaran.']],
                $menu,
                $plans,
                ['type' => 'faq', 'data' => ['title' => 'Pertanyaan umum', 'items' => [
                    ['question' => 'Berapa hari sebelumnya harus pesan?', 'answer' => 'Minimal H-2 untuk nasi box, H-7 untuk prasmanan di atas 100 pax.'],
                    ['question' => 'Apakah bisa tes rasa (food test)?', 'answer' => 'Bisa, untuk pesanan prasmanan dan pernikahan.'],
                ]]],
            ]],
            ['title' => 'Galeri', 'slug' => 'galeri', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Galeri', 'subtitle' => 'Sebagian acara yang sudah kami layani.']],
                ['type' => 'gallery', 'data' => ['items' => [
                    ['image' => 'demo/catering-buffet.jpg', 'caption' => 'Prasmanan pernikahan'],
                    ['image' => 'demo/catering-spread.jpg', 'caption' => 'Menu nusantara'],
                    ['image' => 'demo/catering-box.jpg', 'caption' => 'Nasi box kantor'],
                    ['image' => 'demo/catering-sate.jpg', 'caption' => 'Paket sate'],
                    ['image' => 'demo/catering-event.jpg', 'caption' => 'Acara perusahaan'],
                ]]],
            ]],
            ['title' => 'Kontak', 'slug' => 'kontak', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Pesan Katering', 'subtitle' => 'Admin siap membantu setiap hari 08.00–20.00.']],
                ['type' => 'contact', 'data' => ['title' => 'Ceritakan acara Anda', 'text' => 'Tanggal, jumlah tamu, dan menu yang diinginkan.', 'show_form' => 'yes']],
            ]],
        ];
    }
}
