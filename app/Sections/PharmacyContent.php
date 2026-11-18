<?php

namespace App\Sections;

/**
 * Sample pages for the Apotek template: medicines and vitamins, pharmacist services, delivery
 * and contact.
 */
class PharmacyContent
{
    /**
     * @return list<array<string, mixed>>
     */
    public static function pages(string $company): array
    {
        $products = ['type' => 'pricelist', 'data' => ['title' => 'Produk pilihan', 'subtitle' => 'Obat bebas, vitamin, dan alat kesehatan. Obat resep dilayani dengan resep dokter.', 'items' => [
            ['name' => 'Multivitamin Harian', 'description' => 'Daya tahan tubuh, 30 tablet.', 'info' => 'Promo', 'price' => 'Rp65.000', 'image' => 'demo/apotek-vitamin.jpg'],
            ['name' => 'Vitamin C 1000 mg', 'description' => 'Isi 10 tablet effervescent.', 'info' => 'Terlaris', 'price' => 'Rp32.000', 'image' => 'demo/apotek-capsule.jpg'],
            ['name' => 'Paket P3K Rumah', 'description' => 'Plester, kasa, antiseptik, dan termometer.', 'info' => 'Baru', 'price' => 'Rp89.000', 'image' => 'demo/apotek-meds.jpg'],
        ], 'order_button' => 'yes']];

        $services = ['type' => 'services', 'data' => ['title' => 'Layanan apotek', 'items' => [
            ['title' => 'Konsultasi apoteker', 'text' => 'Tanya dosis, efek samping, dan interaksi obat, gratis.'],
            ['title' => 'Tebus resep', 'text' => 'Kirim foto resep, obat disiapkan sebelum Anda datang.'],
            ['title' => 'Antar ke rumah', 'text' => 'Pesan lewat WhatsApp, diantar di hari yang sama.'],
            ['title' => 'Cek kesehatan', 'text' => 'Gula darah, kolesterol, asam urat, dan tensi.'],
        ]]];

        return [
            ['title' => 'Beranda', 'slug' => 'beranda', 'is_home' => true, 'sections' => [
                ['type' => 'hero', 'data' => [
                    'eyebrow' => 'Apotek terdaftar & apoteker berizin',
                    'title' => 'Obat *tepat*, konsultasi gratis',
                    'subtitle' => "{$company} menyediakan obat, vitamin, dan alat kesehatan lengkap. Tanya apoteker kami kapan saja lewat WhatsApp.",
                    'button_label' => 'Lihat Produk', 'button_url' => '/produk',
                    'button2_label' => 'Layanan', 'button2_url' => '/layanan',
                    'image' => 'demo/apotek-pharmacist.jpg',
                ]],
                $services,
                $products,
                ['type' => 'image_text', 'data' => ['title' => 'Dilayani apoteker, bukan sekadar kasir', 'body' => "Setiap obat diserahkan dengan penjelasan cara pakai yang benar.\n\n- Obat asli dan terdaftar BPOM\n- Penyimpanan sesuai standar suhu\n- Harga wajar dan jelas", 'image' => 'demo/apotek-shelf.jpg', 'image_position' => 'right']],
                ['type' => 'testimonials', 'data' => ['title' => 'Kata pelanggan', 'items' => [
                    ['quote' => 'Apotekernya ramah dan menjelaskan obat anak saya dengan sabar.', 'name' => 'Ibu Melati', 'role' => 'Pelanggan'],
                    ['quote' => 'Kirim foto resep lewat WA, obat sudah siap waktu saya datang.', 'name' => 'Pak Yusuf', 'role' => 'Pelanggan'],
                    ['quote' => 'Bisa antar ke rumah, sangat membantu untuk orang tua saya.', 'name' => 'Rina', 'role' => 'Pelanggan'],
                ]]],
                ['type' => 'cta', 'data' => ['title' => 'Butuh obat sekarang?', 'text' => 'Chat apoteker kami, kami bantu carikan dan antar ke rumah.', 'button_label' => 'Tanya Apoteker', 'button_url' => '/kontak']],
            ]],
            ['title' => 'Produk', 'slug' => 'produk', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Produk', 'subtitle' => 'Stok dapat berubah, tanyakan ketersediaan lewat WhatsApp.']],
                $products,
                ['type' => 'pricelist', 'data' => ['title' => 'Cek kesehatan', 'items' => [
                    ['name' => 'Cek gula darah', 'info' => '5 menit', 'price' => 'Rp20.000'],
                    ['name' => 'Cek kolesterol', 'info' => '5 menit', 'price' => 'Rp30.000'],
                    ['name' => 'Cek asam urat', 'info' => '5 menit', 'price' => 'Rp25.000'],
                    ['name' => 'Cek tensi', 'info' => '3 menit', 'price' => 'Gratis'],
                ]]],
            ]],
            ['title' => 'Layanan', 'slug' => 'layanan', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Layanan', 'subtitle' => 'Kesehatan keluarga Anda, prioritas kami.']],
                $services,
                ['type' => 'faq', 'data' => ['title' => 'Pertanyaan umum', 'items' => [
                    ['question' => 'Apakah bisa membeli obat keras tanpa resep?', 'answer' => 'Tidak. Obat keras hanya dapat diberikan dengan resep dokter sesuai peraturan.'],
                    ['question' => 'Berapa ongkos antar?', 'answer' => 'Gratis untuk radius 3 km dengan minimal belanja Rp100.000.'],
                ]]],
            ]],
            ['title' => 'Kontak', 'slug' => 'kontak', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Hubungi Kami', 'subtitle' => 'Buka setiap hari 07.00–22.00.']],
                ['type' => 'contact', 'data' => ['title' => 'Tanya apoteker', 'text' => 'Tulis nama obat atau keluhan Anda.', 'show_form' => 'yes']],
            ]],
        ];
    }
}
