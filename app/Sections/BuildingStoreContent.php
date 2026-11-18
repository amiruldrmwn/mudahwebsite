<?php

namespace App\Sections;

/**
 * Sample pages for the Toko Bangunan template: material categories with prices, project
 * delivery and quotes for contractors.
 */
class BuildingStoreContent
{
    /**
     * @return list<array<string, mixed>>
     */
    public static function pages(string $company): array
    {
        $prices = ['type' => 'pricelist', 'data' => ['title' => 'Harga material hari ini', 'subtitle' => 'Harga bisa berubah sewaktu-waktu. Tanya stok dan harga grosir lewat WhatsApp.', 'items' => [
            ['name' => 'Semen 50 kg', 'description' => 'Semen PCC untuk cor dan plester', 'info' => 'per sak', 'price' => 'Rp68.000', 'image' => 'demo/bangunan-blocks.jpg'],
            ['name' => 'Bata merah', 'description' => 'Bata press oven, ukuran standar', 'info' => 'per 1.000 pcs', 'price' => 'Rp850.000', 'image' => 'demo/bangunan-bricks.jpg'],
            ['name' => 'Bata ringan 10 cm', 'description' => 'Hebel 60×20×10', 'info' => 'per m³', 'price' => 'Rp720.000', 'image' => 'demo/bangunan-blocks.jpg'],
            ['name' => 'Besi beton 10 mm', 'description' => 'Panjang 12 m, SNI', 'info' => 'per batang', 'price' => 'Rp92.000', 'image' => ''],
            ['name' => 'Pasir cor', 'description' => 'Diantar dengan truk', 'info' => 'per truk', 'price' => 'Rp1.750.000', 'image' => ''],
            ['name' => 'Cat tembok 5 kg', 'description' => 'Interior, banyak pilihan warna', 'info' => 'per galon', 'price' => 'Rp145.000', 'image' => ''],
        ], 'order_button' => 'yes']];

        $cats = ['type' => 'services', 'data' => ['title' => 'Kategori produk', 'subtitle' => 'Lebih dari 3.000 produk tersedia di gudang kami.', 'items' => [
            ['title' => 'Material struktur', 'text' => 'Semen, pasir, bata, besi, dan baja ringan.', 'image' => 'demo/bangunan-bricks.jpg'],
            ['title' => 'Perkakas & alat', 'text' => 'Alat tukang, mesin bor, gerinda, dan alat ukur.', 'image' => 'demo/bangunan-tools.jpg'],
            ['title' => 'Finishing', 'text' => 'Keramik, cat, sanitair, pipa, dan listrik.', 'image' => 'demo/bangunan-hammer.jpg'],
        ]]];

        return [
            ['title' => 'Beranda', 'slug' => 'beranda', 'is_home' => true, 'sections' => [
                ['type' => 'hero', 'data' => [
                    'eyebrow' => 'Toko bahan bangunan',
                    'title' => 'Material lengkap, harga *grosir*, diantar ke proyek',
                    'subtitle' => "{$company} menyediakan bahan bangunan untuk rumah, renovasi, dan proyek kontraktor. Pesan lewat WhatsApp, kami antar hari ini.",
                    'button_label' => 'Cek Harga', 'button_url' => '/produk',
                    'button2_label' => 'Minta Penawaran Proyek', 'button2_url' => '/kontak',
                    'image' => 'demo/bangunan-hero.jpg',
                ]],
                ['type' => 'stats', 'data' => ['items' => [
                    ['value' => '3.000+', 'label' => 'Produk tersedia'],
                    ['value' => '5 armada', 'label' => 'Truk & pikap'],
                    ['value' => 'Gratis', 'label' => 'Ongkir radius 5 km'],
                    ['value' => '25 thn', 'label' => 'Melayani warga'],
                ]]],
                $cats,
                $prices,
                ['type' => 'image_text', 'data' => ['title' => 'Untuk kontraktor & proyek', 'body' => "- Harga khusus pembelian partai besar\n- Pengiriman terjadwal sesuai progres proyek\n- Tempo pembayaran untuk pelanggan tetap\n- Faktur pajak tersedia", 'image' => 'demo/bangunan-gudang.jpg', 'image_position' => 'left', 'button_label' => 'Minta Penawaran', 'button_url' => '/kontak']],
                ['type' => 'cta', 'data' => ['title' => 'Kirim daftar belanja Anda', 'text' => 'Foto daftar material, kami hitung totalnya dalam 15 menit.', 'button_label' => 'Chat WhatsApp', 'button_url' => '/kontak']],
            ]],
            ['title' => 'Produk', 'slug' => 'produk', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Produk & Harga', 'subtitle' => 'Stok lengkap di gudang, siap kirim.', 'image' => 'demo/bangunan-gudang.jpg']],
                $prices,
                $cats,
            ]],
            ['title' => 'Tentang', 'slug' => 'tentang', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Tentang Kami', 'subtitle' => 'Toko bangunan keluarga sejak 2001.']],
                ['type' => 'image_text', 'data' => ['title' => 'Mitra membangun rumah impian', 'body' => "{$company} berawal dari toko kecil di pinggir jalan. Kini kami melayani ribuan pelanggan rumah tangga, tukang, dan kontraktor.", 'image' => 'demo/bangunan-site.jpg', 'image_position' => 'right']],
                ['type' => 'steps', 'data' => ['title' => 'Cara pesan', 'items' => [
                    ['title' => 'Kirim daftar', 'text' => 'Lewat WhatsApp atau formulir.'],
                    ['title' => 'Terima penawaran', 'text' => 'Harga, stok, dan ongkir dihitung.'],
                    ['title' => 'Bayar', 'text' => 'Transfer, QRIS, atau bayar di tempat.'],
                    ['title' => 'Diantar', 'text' => 'Truk kami antar ke lokasi.'],
                ]]],
            ]],
            ['title' => 'Kontak', 'slug' => 'kontak', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Pesan & Penawaran', 'subtitle' => 'Buka Senin–Sabtu 07.00–17.00, Minggu 08.00–12.00.']],
                ['type' => 'contact', 'data' => ['title' => 'Kirim daftar material', 'text' => 'Tulis material, jumlah, dan alamat pengiriman.', 'show_form' => 'yes']],
            ]],
        ];
    }
}
