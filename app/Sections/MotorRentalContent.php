<?php

namespace App\Sections;

/**
 * Sample pages for the Rental Motor template: scooters for tourists, daily and monthly prices,
 * delivery and terms.
 */
class MotorRentalContent
{
    /**
     * @return list<array<string, mixed>>
     */
    public static function pages(string $company): array
    {
        $bikes = [
            ['image' => 'demo/moto-matic.jpg', 'name' => 'Honda Beat / Scoopy', 'category' => 'Matic 110cc', 'badge' => 'Terlaris', 'specs' => "Irit\nRingan\n2 helm", 'price' => 'Rp70.000', 'unit' => '/hari'],
            ['image' => 'demo/moto-maxi.jpg', 'name' => 'Yamaha NMAX', 'category' => 'Maxi 155cc', 'specs' => "Nyaman jarak jauh\nBagasi luas\n2 helm", 'price' => 'Rp150.000', 'unit' => '/hari'],
            ['image' => 'demo/moto-retro.jpg', 'name' => 'Vespa Primavera', 'category' => 'Retro 125cc', 'badge' => 'Instagramable', 'specs' => "Gaya klasik\n2 helm retro", 'price' => 'Rp250.000', 'unit' => '/hari'],
            ['image' => 'demo/moto-trail.jpg', 'name' => 'Kawasaki KLX 150', 'category' => 'Trail 150cc', 'specs' => "Off-road\nHelm full face", 'price' => 'Rp250.000', 'unit' => '/hari'],
        ];

        $cta = ['title' => 'Motor siap diantar ke penginapanmu', 'text' => 'Gratis antar jemput area kota. Tinggal chat, motor datang.', 'button_label' => 'Sewa Sekarang', 'button_url' => '/kontak'];

        return [
            ['title' => 'Beranda', 'slug' => 'beranda', 'is_home' => true, 'sections' => [
                ['type' => 'hero', 'data' => [
                    'eyebrow' => 'Gratis antar ke hotel!',
                    'title' => 'Keliling kota lebih bebas',
                    'subtitle' => "Sewa motor harian, mingguan, atau bulanan di {$company}. Motor terawat, helm bersih, dan diantar langsung ke penginapanmu.",
                    'button_label' => 'Pilih Motor', 'button_url' => '/motor',
                    'button2_label' => 'Cara Sewa', 'button2_url' => '/syarat',
                    'image' => 'demo/moto-hero.jpg',
                ]],
                ['type' => 'catalog', 'data' => ['title' => 'Pilih motormu', 'subtitle' => 'Harga per 24 jam, sudah termasuk 2 helm dan jas hujan.', 'items' => $bikes, 'button_label' => 'Sewa']],
                ['type' => 'services', 'data' => ['title' => 'Kenapa kami?', 'items' => [
                    ['title' => 'Antar jemput gratis', 'text' => 'Diantar ke hotel, villa, atau bandara di area kota.'],
                    ['title' => 'Helm bersih', 'text' => '2 helm yang dicuci setiap hari, plus jas hujan.'],
                    ['title' => 'Bantuan 24 jam', 'text' => 'Ban bocor atau mogok? Kami datang membantu.'],
                ]]],
                ['type' => 'testimonials', 'data' => ['title' => 'Kata mereka', 'items' => [
                    ['quote' => 'Motornya bersih dan diantar ke villa tepat waktu. Super praktis!', 'name' => 'Sarah', 'role' => 'Turis, Jakarta'],
                    ['quote' => 'Sewa bulanan harganya hemat banget. Motor juga diganti kalau servis.', 'name' => 'Tom', 'role' => 'Digital nomad'],
                    ['quote' => 'Vespa-nya cakep buat foto-foto. Adminnya fast response.', 'name' => 'Dinda', 'role' => 'Liburan bareng teman'],
                ]]],
                ['type' => 'cta', 'data' => $cta],
            ]],
            ['title' => 'Motor', 'slug' => 'motor', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Motor & Harga', 'subtitle' => 'Makin lama sewa, makin hemat.']],
                ['type' => 'catalog', 'data' => ['items' => $bikes, 'button_label' => 'Sewa']],
                ['type' => 'pricelist', 'data' => ['title' => 'Harga mingguan & bulanan', 'items' => [
                    ['name' => 'Matic 110cc', 'info' => 'Mingguan', 'price' => 'Rp400.000'],
                    ['name' => 'Matic 110cc', 'info' => 'Bulanan', 'price' => 'Rp1.200.000'],
                    ['name' => 'Maxi 155cc', 'info' => 'Mingguan', 'price' => 'Rp900.000'],
                    ['name' => 'Maxi 155cc', 'info' => 'Bulanan', 'price' => 'Rp2.800.000'],
                ], 'order_button' => 'yes']],
            ]],
            ['title' => 'Syarat', 'slug' => 'syarat', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Cara & Syarat Sewa', 'subtitle' => 'Mudah, cukup 4 langkah.']],
                ['type' => 'steps', 'data' => ['items' => [
                    ['title' => 'Chat admin', 'text' => 'Pilih motor, tanggal, dan lokasi antar.'],
                    ['title' => 'Kirim foto identitas', 'text' => 'KTP/paspor dan SIM C (atau SIM internasional).'],
                    ['title' => 'Motor diantar', 'text' => 'Cek kondisi motor bersama kurir.'],
                    ['title' => 'Bayar & jalan!', 'text' => 'Tunai, transfer, atau QRIS.'],
                ]]],
                ['type' => 'faq', 'data' => ['title' => 'Pertanyaan umum', 'items' => [
                    ['question' => 'Apakah perlu deposit?', 'answer' => 'Ya, identitas asli atau deposit tunai yang dikembalikan saat motor kembali.'],
                    ['question' => 'Bagaimana kalau ban bocor?', 'answer' => 'Hubungi kami, teknisi datang membantu. Biaya tambal ditanggung kami.'],
                    ['question' => 'Boleh dibawa ke luar kota?', 'answer' => 'Boleh untuk motor 150cc ke atas dengan pemberitahuan di awal.'],
                ]]],
                ['type' => 'image_text', 'data' => ['title' => 'Serah terima yang jelas', 'body' => 'Setiap motor difoto bersama sebelum dan sesudah sewa, supaya sama-sama tenang.', 'image' => 'demo/moto-handover.jpg', 'image_position' => 'right']],
            ]],
            ['title' => 'Kontak', 'slug' => 'kontak', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Sewa Sekarang', 'subtitle' => 'Admin online setiap hari 07.00–22.00.']],
                ['type' => 'contact', 'data' => ['title' => 'Kirim pesanan', 'text' => 'Sebutkan motor, tanggal, lama sewa, dan alamat penginapan.', 'show_form' => 'yes']],
            ]],
        ];
    }
}
