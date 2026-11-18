<?php

namespace App\Sections;

/**
 * Sample pages for the Klinik Kecantikan template: facial and laser treatments, prices, the
 * doctor, skincare and consultation.
 */
class BeautyClinicContent
{
    /**
     * @return list<array<string, mixed>>
     */
    public static function pages(string $company): array
    {
        $treatments = [
            ['title' => 'Facial Glow', 'text' => 'Membersihkan, melembapkan, dan mencerahkan kulit wajah.', 'image' => 'demo/beauty-hero.jpg'],
            ['title' => 'Laser Rejuvenation', 'text' => 'Menyamarkan noda, pori-pori, dan bekas jerawat.', 'image' => 'demo/beauty-laser.jpg'],
            ['title' => 'Skin Booster', 'text' => 'Hidrasi mendalam untuk kulit kenyal dan bercahaya.', 'image' => 'demo/beauty-glow.jpg'],
        ];

        $prices = [
            ['name' => 'Facial Glow Signature', 'description' => 'Cleansing, ekstraksi, masker, dan serum.', 'info' => '60 menit', 'price' => 'Rp350.000'],
            ['name' => 'Acne Facial', 'description' => 'Untuk kulit berjerawat, dengan high frequency.', 'info' => '60 menit', 'price' => 'Rp400.000'],
            ['name' => 'Chemical Peeling', 'description' => 'Mengangkat sel kulit mati, kulit lebih halus.', 'info' => '45 menit', 'price' => 'Rp550.000'],
            ['name' => 'Laser Rejuvenation', 'description' => 'Mencerahkan dan meratakan warna kulit.', 'info' => '30 menit', 'price' => 'Rp1.200.000'],
            ['name' => 'Skin Booster', 'description' => 'Injeksi hidrasi oleh dokter.', 'info' => '45 menit', 'price' => 'Rp2.500.000'],
        ];

        $cta = ['title' => 'Mulai perjalanan kulit sehatmu', 'text' => 'Konsultasi dengan dokter kami untuk rekomendasi treatment yang tepat.', 'button_label' => 'Konsultasi Gratis', 'button_url' => '/kontak'];

        return [
            ['title' => 'Beranda', 'slug' => 'beranda', 'is_home' => true, 'sections' => [
                ['type' => 'hero', 'data' => [
                    'eyebrow' => 'Aesthetic & skincare clinic',
                    'title' => 'Kulit sehat, *cantik* alami',
                    'subtitle' => "{$company} menghadirkan perawatan wajah dan kulit oleh dokter bersertifikat, dengan produk aman dan teknologi terkini.",
                    'button_label' => 'Lihat Treatment', 'button_url' => '/treatment',
                    'button2_label' => 'Konsultasi', 'button2_url' => '/kontak',
                    'image' => 'demo/beauty-glow.jpg',
                ]],
                ['type' => 'services', 'data' => ['title' => 'Treatment favorit', 'items' => $treatments]],
                ['type' => 'image_text', 'data' => ['title' => 'Ditangani dokter berpengalaman', 'body' => "Setiap treatment diawali konsultasi dan analisis kulit, sehingga perawatan sesuai jenis dan kebutuhan kulitmu.\n\n- Dokter estetika bersertifikat\n- Produk ber-BPOM\n- Alat steril dan modern", 'image' => 'demo/beauty-laser.jpg', 'image_position' => 'left']],
                ['type' => 'pricelist', 'data' => ['title' => 'Skincare klinik', 'items' => [
                    ['name' => 'Brightening Serum', 'description' => 'Mencerahkan dan meratakan warna kulit.', 'info' => '20 ml', 'price' => 'Rp185.000', 'image' => 'demo/beauty-products.jpg'],
                    ['name' => 'Hydrating Moisturizer', 'description' => 'Melembapkan tanpa terasa berat.', 'info' => '30 g', 'price' => 'Rp150.000', 'image' => 'demo/beauty-products.jpg'],
                    ['name' => 'Sunscreen SPF 50', 'description' => 'Ringan, tidak lengket, tanpa white cast.', 'info' => '50 ml', 'price' => 'Rp120.000', 'image' => 'demo/beauty-products.jpg'],
                ], 'order_button' => 'yes']],
                ['type' => 'testimonials', 'data' => ['title' => 'Kata mereka', 'items' => [
                    ['quote' => 'Bekas jerawat saya jauh lebih samar setelah 3x laser. Dokternya telaten.', 'name' => 'Nadia', 'role' => 'Pasien laser'],
                    ['quote' => 'Klinik nyaman dan bersih, facial-nya bikin kulit glowing seminggu.', 'name' => 'Putri', 'role' => 'Pasien facial'],
                    ['quote' => 'Konsultasinya detail, skincare yang dianjurkan cocok di kulit sensitif saya.', 'name' => 'Ayu', 'role' => 'Pasien konsultasi'],
                ]]],
                ['type' => 'cta', 'data' => $cta],
            ]],
            ['title' => 'Treatment', 'slug' => 'treatment', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Treatment & Harga', 'subtitle' => 'Pilih perawatan sesuai kebutuhan kulitmu.']],
                ['type' => 'services', 'data' => ['items' => $treatments]],
                ['type' => 'pricelist', 'data' => ['title' => 'Daftar harga', 'items' => $prices, 'note' => 'Harga belum termasuk konsultasi dokter (Rp100.000, gratis untuk member).', 'order_button' => 'yes']],
            ]],
            ['title' => 'Tentang', 'slug' => 'tentang', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Tentang Kami', 'subtitle' => 'Ruang nyaman untuk merawat diri.']],
                ['type' => 'image_text', 'data' => ['title' => 'Cantik dimulai dari kulit sehat', 'body' => "{$company} percaya setiap orang berhak merasa percaya diri. Kami menggabungkan ilmu kedokteran estetika dengan suasana klinik yang hangat dan privat.", 'image' => 'demo/beauty-lounge.jpg', 'image_position' => 'right']],
                ['type' => 'team', 'data' => ['title' => 'Dokter kami', 'items' => [
                    ['photo' => 'demo/beauty-doctor.jpg', 'name' => 'dr. Sabrina Putri, Dipl. AAAM', 'role' => 'Dokter estetika'],
                ]]],
                ['type' => 'gallery', 'data' => ['items' => [
                    ['image' => 'demo/beauty-lounge.jpg', 'caption' => 'Lounge'],
                    ['image' => 'demo/beauty-hero.jpg', 'caption' => 'Ruang facial'],
                    ['image' => 'demo/beauty-laser.jpg', 'caption' => 'Ruang laser'],
                ]]],
            ]],
            ['title' => 'Kontak', 'slug' => 'kontak', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Konsultasi', 'subtitle' => 'Buka setiap hari 10.00–20.00.']],
                ['type' => 'contact', 'data' => ['title' => 'Ceritakan keluhan kulitmu', 'text' => 'Tim kami akan merekomendasikan treatment dan jadwal yang sesuai.', 'show_form' => 'yes']],
            ]],
        ];
    }
}
