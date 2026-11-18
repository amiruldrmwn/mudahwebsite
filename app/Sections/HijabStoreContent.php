<?php

namespace App\Sections;

/**
 * Sample pages for the Hijab Store template: new collection, categories, products with
 * discounts, an editorial lookbook, journal and contact.
 */
class HijabStoreContent
{
    /**
     * @return list<array<string, mixed>>
     */
    public static function pages(string $company): array
    {
        $categories = ['type' => 'gallery', 'data' => ['title' => 'Belanja per kategori', 'items' => [
            ['image' => 'demo/hijab-pashmina.jpg', 'caption' => 'Hijab'],
            ['image' => 'demo/hijab-gamis.jpg', 'caption' => 'Gamis'],
            ['image' => 'demo/hijab-tunik.jpg', 'caption' => 'Atasan'],
            ['image' => 'demo/hijab-kulot.jpg', 'caption' => 'Bawahan'],
            ['image' => 'demo/hijab-tas.jpg', 'caption' => 'Tas'],
            ['image' => 'demo/hijab-parfum.jpg', 'caption' => 'Parfum'],
            ['image' => 'demo/hijab-keluarga.jpg', 'caption' => 'Set Keluarga'],
        ]]];

        $newest = [
            ['name' => 'Pashmina Satin Kirana', 'description' => 'Satin lembut berkilau, mudah dibentuk.', 'info' => '-20%', 'price' => 'Rp119.000', 'image' => 'demo/hijab-pashmina.jpg'],
            ['name' => 'Gamis Linen Laras', 'description' => 'Linen adem dengan rok bertingkat.', 'info' => 'Baru', 'price' => 'Rp389.000', 'image' => 'demo/hijab-gamis.jpg'],
            ['name' => 'Tunik Bunga Sekar', 'description' => 'Motif bunga kecil, kancing depan.', 'info' => '-15%', 'price' => 'Rp229.000', 'image' => 'demo/hijab-tunik.jpg'],
            ['name' => 'Kulot Wide Leg Arum', 'description' => 'Pinggang tinggi, jatuh dan rapi.', 'info' => 'Terlaris', 'price' => 'Rp199.000', 'image' => 'demo/hijab-kulot.jpg'],
            ['name' => 'Tote Bag Kulit Saras', 'description' => 'Muat laptop 13 inci, bonus scarf.', 'info' => 'Baru', 'price' => 'Rp459.000', 'image' => 'demo/hijab-tas.jpg'],
            ['name' => 'Parfum Embun Pagi', 'description' => 'Wangi musk dan bunga, tahan lama.', 'info' => '50 ml', 'price' => 'Rp179.000', 'image' => 'demo/hijab-parfum.jpg'],
        ];

        $testimonials = ['type' => 'testimonials', 'data' => ['title' => 'Kata pelanggan', 'items' => [
            ['quote' => 'Bahan pashminanya jatuh dan tidak licin, warnanya persis seperti di foto.', 'name' => 'Rahma', 'role' => 'Jakarta'],
            ['quote' => 'Gamis linennya adem banget, dipakai seharian tetap nyaman.', 'name' => 'Salsabila', 'role' => 'Bandung'],
            ['quote' => 'Pengiriman cepat, packing rapi dan wangi. Pasti belanja lagi.', 'name' => 'Nisa', 'role' => 'Surabaya'],
        ]]];

        return [
            ['title' => 'Beranda', 'slug' => 'beranda', 'is_home' => true, 'sections' => [
                ['type' => 'hero', 'data' => [
                    'eyebrow' => 'Koleksi Hari Raya',
                    'title' => 'Anggun dalam *kesederhanaan*',
                    'subtitle' => "Koleksi terbaru {$company} dalam warna tanah yang hangat: gamis, tunik, dan pashmina yang nyaman dipakai dari pagi hingga malam.",
                    'button_label' => 'Belanja Sekarang', 'button_url' => '/koleksi',
                    'button2_label' => 'Lihat Lookbook', 'button2_url' => '/lookbook',
                    'image' => 'demo/hijab-hero.jpg',
                ]],
                $categories,
                ['type' => 'pricelist', 'data' => ['title' => 'Koleksi terbaru', 'subtitle' => 'Dibuat dalam jumlah terbatas setiap musim.', 'items' => $newest, 'order_button' => 'yes']],
                ['type' => 'image_text', 'data' => ['title' => 'Pilihan editor: Seri Taman Pagi', 'body' => "Palet sage, krem, dan terakota yang terinspirasi dari pagi di taman. Dipadukan dengan potongan longgar yang tetap rapi.\n\n- Bahan premium yang adem\n- Jahitan rapi dan kuat\n- Ukuran S sampai XXL", 'image' => 'demo/hijab-editorial.jpg', 'image_position' => 'left', 'button_label' => 'Jelajahi Seri', 'button_url' => '/lookbook']],
                ['type' => 'stats', 'data' => ['items' => [
                    ['value' => '50rb+', 'label' => 'Pelanggan setia'],
                    ['value' => '4.9/5', 'label' => 'Rating ulasan'],
                    ['value' => '1–3 hari', 'label' => 'Pengiriman'],
                    ['value' => '7 hari', 'label' => 'Garansi tukar'],
                ]]],
                $testimonials,
                ['type' => 'cta', 'data' => ['title' => 'Gratis ongkir untuk belanja Rp250.000', 'text' => 'Pesan lewat WhatsApp, admin kami bantu pilih ukuran dan warna.', 'button_label' => 'Chat Admin', 'button_url' => '/kontak']],
            ]],
            ['title' => 'Koleksi', 'slug' => 'koleksi', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Semua Koleksi', 'subtitle' => 'Hijab, busana, dan aksesori untuk setiap momen.']],
                $categories,
                ['type' => 'pricelist', 'data' => ['title' => 'Produk', 'items' => $newest, 'note' => 'Harga sudah termasuk diskon. Stok dapat berubah sewaktu-waktu.', 'order_button' => 'yes']],
                ['type' => 'faq', 'data' => ['title' => 'Pertanyaan seputar belanja', 'items' => [
                    ['question' => 'Bagaimana cara memesan?', 'answer' => 'Klik tombol Pesan pada produk, lalu admin akan membantu lewat WhatsApp untuk ukuran, warna, dan ongkir.'],
                    ['question' => 'Apakah bisa tukar ukuran?', 'answer' => 'Bisa, maksimal 7 hari setelah barang diterima dengan label masih terpasang.'],
                    ['question' => 'Metode pembayaran apa saja?', 'answer' => 'Transfer bank, QRIS, e-wallet, dan COD untuk wilayah tertentu.'],
                ]]],
            ]],
            ['title' => 'Lookbook', 'slug' => 'lookbook', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Lookbook & Jurnal', 'subtitle' => 'Inspirasi gaya dan cerita di balik koleksi kami.']],
                ['type' => 'image_text', 'data' => ['title' => 'Seri Taman Pagi', 'body' => 'Koleksi musim ini memadukan siluet longgar dengan warna lembut, cocok untuk kerja, kajian, maupun silaturahmi.', 'image' => 'demo/hijab-editorial.jpg', 'image_position' => 'right']],
                ['type' => 'image_text', 'data' => ['title' => 'Set Keluarga Hari Raya', 'body' => 'Gamis, koko, dan dress anak dengan motif serasi. Tersedia ukuran ayah, ibu, dan anak.', 'image' => 'demo/hijab-keluarga.jpg', 'image_position' => 'left']],
                ['type' => 'posts', 'data' => ['title' => 'Jurnal', 'items' => [
                    ['image' => 'demo/hijab-pashmina.jpg', 'category' => 'Tips', 'date' => '12 Nov 2026', 'title' => '5 gaya pashmina satin untuk acara formal', 'text' => 'Tutorial singkat agar pashmina tetap rapi seharian.'],
                    ['image' => 'demo/hijab-gamis.jpg', 'category' => 'Perawatan', 'date' => '3 Nov 2026', 'title' => 'Cara merawat gamis linen agar awet', 'text' => 'Mencuci, menjemur, dan menyetrika dengan benar.'],
                    ['image' => 'demo/hijab-kulot.jpg', 'category' => 'Padu padan', 'date' => '25 Okt 2026', 'title' => 'Satu kulot, tiga gaya kerja', 'text' => 'Ide padu padan untuk ke kantor sepanjang minggu.'],
                ]]],
            ]],
            ['title' => 'Tentang', 'slug' => 'tentang', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Tentang Kami', 'subtitle' => 'Busana muslim yang anggun dan nyaman.']],
                ['type' => 'image_text', 'data' => ['title' => 'Dibuat dengan hati', 'body' => "{$company} berawal dari keinginan sederhana: busana muslim yang sopan, nyaman, dan tetap modis. Setiap koleksi kami rancang sendiri dan dijahit oleh penjahit lokal.", 'image' => 'demo/hijab-hero.jpg', 'image_position' => 'right']],
                $testimonials,
            ]],
            ['title' => 'Kontak', 'slug' => 'kontak', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Hubungi Kami', 'subtitle' => 'Admin online setiap hari 08.00–21.00.']],
                ['type' => 'contact', 'data' => ['title' => 'Ada pertanyaan?', 'text' => 'Tanyakan stok, ukuran, atau pesanan reseller. Kami balas secepatnya.', 'show_form' => 'yes']],
            ]],
        ];
    }
}
