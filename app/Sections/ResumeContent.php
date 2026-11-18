<?php

namespace App\Sections;

/**
 * Sample pages for the CV Online / Portfolio template: a designer's profile, skills,
 * experience, selected work and contact.
 */
class ResumeContent
{
    /**
     * @return list<array<string, mixed>>
     */
    public static function pages(string $company): array
    {
        $work = ['type' => 'gallery', 'data' => ['title' => 'Karya pilihan', 'items' => [
            ['image' => 'demo/cv-work.jpg', 'caption' => 'Redesain aplikasi kasir UMKM'],
            ['image' => 'demo/cv-sketch.jpg', 'caption' => 'Ilustrasi untuk buku anak'],
            ['image' => 'demo/cetak-swatch.jpg', 'caption' => 'Identitas merek kedai kopi'],
            ['image' => 'demo/cv-desk.jpg', 'caption' => 'Website company profile'],
        ]]];

        return [
            ['title' => 'Beranda', 'slug' => 'beranda', 'is_home' => true, 'sections' => [
                ['type' => 'hero', 'data' => [
                    'eyebrow' => 'UI/UX & Brand Designer',
                    'title' => "Halo, saya {$company}. Saya merancang produk digital yang *mudah dipakai*.",
                    'subtitle' => '7 tahun membantu startup dan UMKM membuat aplikasi, website, dan identitas merek. Saat ini terbuka untuk proyek freelance.',
                    'button_label' => 'Lihat Karya', 'button_url' => '/portofolio',
                    'button2_label' => 'Unduh CV', 'button2_url' => '/kontak',
                    'image' => 'demo/cv-avatar.jpg',
                ]],
                ['type' => 'stats', 'data' => ['items' => [
                    ['value' => '7 thn', 'label' => 'Pengalaman'],
                    ['value' => '80+', 'label' => 'Proyek selesai'],
                    ['value' => '35', 'label' => 'Klien'],
                    ['value' => '3', 'label' => 'Penghargaan desain'],
                ]]],
                ['type' => 'services', 'data' => ['title' => 'Yang bisa saya bantu', 'items' => [
                    ['title' => 'UI/UX design', 'text' => 'Riset pengguna, wireframe, dan desain aplikasi siap dikembangkan.', 'image' => ''],
                    ['title' => 'Brand identity', 'text' => 'Logo, palet warna, dan panduan merek.', 'image' => ''],
                    ['title' => 'Website design', 'text' => 'Desain website yang cepat dan mudah dikelola.', 'image' => ''],
                ]]],
                $work,
                ['type' => 'steps', 'data' => ['title' => 'Pengalaman kerja', 'items' => [
                    ['title' => '2023 – sekarang · Freelance', 'text' => 'Desainer produk untuk klien Indonesia dan Singapura.'],
                    ['title' => '2020 – 2023 · Lead Designer', 'text' => 'Startup fintech, memimpin tim 4 desainer.'],
                    ['title' => '2018 – 2020 · UI Designer', 'text' => 'Agensi digital, 30+ proyek website.'],
                    ['title' => '2014 – 2018 · S1 DKV', 'text' => 'Desain Komunikasi Visual.'],
                ]]],
                ['type' => 'testimonials', 'data' => ['title' => 'Kata klien', 'items' => [
                    ['quote' => 'Aplikasi kami jadi jauh lebih mudah dipakai. Ulasan pengguna naik drastis.', 'name' => 'Yusuf', 'role' => 'CEO, startup logistik'],
                    ['quote' => 'Logo dan kemasan baru bikin produk kami tampil beda di rak.', 'name' => 'Bu Ratna', 'role' => 'Pemilik UMKM camilan'],
                ]]],
                ['type' => 'cta', 'data' => ['title' => 'Punya proyek?', 'text' => 'Ceritakan idenya, saya balas dalam 24 jam.', 'button_label' => 'Hubungi Saya', 'button_url' => '/kontak']],
            ]],
            ['title' => 'Portofolio', 'slug' => 'portofolio', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Portofolio', 'subtitle' => 'Beberapa proyek yang saya kerjakan.']],
                $work,
                ['type' => 'clients', 'data' => ['title' => 'Pernah bekerja dengan', 'items' => [
                    ['name' => 'Kopi Senja', 'logo' => ''], ['name' => 'PayKita', 'logo' => ''], ['name' => 'Kirim.in', 'logo' => ''], ['name' => 'Toko Nusantara', 'logo' => ''],
                ]]],
            ]],
            ['title' => 'Kontak', 'slug' => 'kontak', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Mari bekerja sama', 'subtitle' => 'Untuk proyek freelance, kerja penuh waktu, atau sekadar menyapa.']],
                ['type' => 'contact', 'data' => ['title' => 'Kirim pesan', 'text' => 'Ceritakan proyek, tenggat, dan anggaran Anda.', 'show_form' => 'yes']],
            ]],
        ];
    }
}
