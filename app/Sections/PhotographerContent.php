<?php

namespace App\Sections;

/**
 * Sample pages for the Fotografer template: portfolio, photo packages, booking steps and
 * contact.
 */
class PhotographerContent
{
    /**
     * @return list<array<string, mixed>>
     */
    public static function pages(string $company): array
    {
        $portfolio = ['type' => 'gallery', 'data' => ['title' => 'Portofolio pilihan', 'items' => [
            ['image' => 'demo/foto-couple.jpg', 'caption' => 'Prewedding'],
            ['image' => 'demo/foto-studio.jpg', 'caption' => 'Studio'],
            ['image' => 'demo/foto-portrait.jpg', 'caption' => 'Portrait'],
            ['image' => 'demo/foto-smile.jpg', 'caption' => 'Golden hour'],
            ['image' => 'demo/foto-gear.jpg', 'caption' => 'Behind the scene'],
            ['image' => 'demo/foto-corner.jpg', 'caption' => 'Studio kami'],
        ]]];

        $plans = ['type' => 'plans', 'data' => ['title' => 'Paket foto', 'items' => [
            ['name' => 'Portrait', 'price' => 'Rp750rb', 'info' => '1 jam, 1 lokasi', 'features' => "30 foto edit\nSemua file asli\n1 kali ganti baju", 'highlight' => 'no'],
            ['name' => 'Prewedding', 'badge' => 'Favorit', 'price' => 'Rp3,5jt', 'info' => '4 jam, 2 lokasi', 'features' => "80 foto edit\nVideo teaser 1 menit\n2 kali ganti baju\nCetak 1 album", 'highlight' => 'yes'],
            ['name' => 'Wedding Day', 'price' => 'Rp7,5jt', 'info' => '8 jam, 2 fotografer', 'features' => "300 foto edit\nAlbum premium\nVideo highlight 3 menit\nFlashdisk kayu", 'highlight' => 'no'],
        ], 'note' => 'Biaya transport di luar kota menyesuaikan.']];

        return [
            ['title' => 'Beranda', 'slug' => 'beranda', 'is_home' => true, 'sections' => [
                ['type' => 'hero', 'data' => [
                    'eyebrow' => 'Fotografer & videografer',
                    'title' => 'Momen yang *layak* dikenang',
                    'subtitle' => "{$company} mengabadikan prewedding, pernikahan, keluarga, dan produk dengan gaya natural dan hangat.",
                    'button_label' => 'Lihat Portofolio', 'button_url' => '/portofolio',
                    'button2_label' => 'Paket & Harga', 'button2_url' => '/paket',
                    'image' => 'demo/foto-portrait.jpg',
                ]],
                $portfolio,
                ['type' => 'image_text', 'data' => ['title' => 'Natural, tanpa pose kaku', 'body' => 'Kami membiarkan cerita Anda mengalir. Arahan ringan, cahaya alami, dan editing yang menjaga warna kulit tetap jujur.', 'image' => 'demo/foto-studio.jpg', 'image_position' => 'left', 'button_label' => 'Cek Jadwal', 'button_url' => '/kontak']],
                $plans,
                ['type' => 'testimonials', 'data' => ['title' => 'Kata klien', 'items' => [
                    ['quote' => 'Hasil prewedding kami cantik banget, natural dan tidak berlebihan.', 'name' => 'Dinda & Raka', 'role' => 'Prewedding'],
                    ['quote' => 'Fotografernya sabar dengan anak-anak, foto keluarga jadi seru.', 'name' => 'Keluarga Putra', 'role' => 'Family session'],
                    ['quote' => 'Foto produk kami langsung naik kelas di marketplace.', 'name' => 'Nina', 'role' => 'Pemilik brand skincare'],
                ]]],
                ['type' => 'cta', 'data' => ['title' => 'Tanggal Anda masih tersedia?', 'text' => 'Jadwal cepat penuh di akhir pekan. Cek ketersediaan sekarang.', 'button_label' => 'Cek Jadwal', 'button_url' => '/kontak']],
            ]],
            ['title' => 'Portofolio', 'slug' => 'portofolio', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Portofolio', 'subtitle' => 'Sebagian cerita yang pernah kami abadikan.']],
                $portfolio,
            ]],
            ['title' => 'Paket', 'slug' => 'paket', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Paket & Harga', 'subtitle' => 'Pilih sesuai kebutuhan, bisa disesuaikan.']],
                $plans,
                ['type' => 'faq', 'data' => ['title' => 'Pertanyaan umum', 'items' => [
                    ['question' => 'Berapa lama foto selesai diedit?', 'answer' => 'Portrait 3 hari, prewedding 7 hari, wedding 14 hari kerja.'],
                    ['question' => 'Bagaimana cara booking tanggal?', 'answer' => 'Dengan DP 30%. Tanggal dikunci setelah DP diterima.'],
                ]]],
            ]],
            ['title' => 'Kontak', 'slug' => 'kontak', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Cek Jadwal', 'subtitle' => 'Ceritakan rencana pemotretan Anda.']],
                ['type' => 'contact', 'data' => ['title' => 'Mari berkenalan', 'text' => 'Tulis tanggal, lokasi, dan jenis sesi foto.', 'show_form' => 'yes']],
            ]],
        ];
    }
}
