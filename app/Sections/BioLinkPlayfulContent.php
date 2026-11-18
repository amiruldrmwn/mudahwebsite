<?php

namespace App\Sections;

/**
 * Sample pages for the playful Bio Link template: a food creator's profile with grouped
 * recipe and class links, and a contact page.
 */
class BioLinkPlayfulContent
{
    /**
     * @return list<array<string, mixed>>
     */
    public static function pages(string $company): array
    {
        return [
            ['title' => 'Beranda', 'slug' => 'beranda', 'is_home' => true, 'sections' => [
                ['type' => 'hero', 'data' => [
                    'eyebrow' => '@dapurceria',
                    'title' => $company,
                    'subtitle' => '"Halo pencinta makanan! Aku berbagi resep rumahan yang gampang, review tempat makan, dan trik dapur hemat. Yuk masak bareng! #MasakItuSeru"',
                    'button_label' => 'Baca blog resepku', 'button_url' => '/kontak',
                    'button2_label' => '', 'button2_url' => '',
                    'image' => 'demo/bio2-avatar.jpg',
                ]],
                ['type' => 'links', 'data' => ['title' => 'Resep favorit', 'items' => [
                    ['title' => 'Nasi goreng kampung', 'text' => '', 'url' => '/kontak', 'badge' => 'Baru', 'image' => ''],
                    ['title' => 'Soto ayam bening', 'text' => '', 'url' => '/kontak', 'badge' => '', 'image' => ''],
                    ['title' => 'Rendang tanpa ribet', 'text' => '', 'url' => '/kontak', 'badge' => '', 'image' => ''],
                    ['title' => 'Bakwan sayur renyah', 'text' => '', 'url' => '/kontak', 'badge' => '', 'image' => ''],
                ]]],
                ['type' => 'links', 'data' => ['title' => 'Kelas masak online', 'items' => [
                    ['title' => 'Menu 30 menit untuk pemula', 'text' => 'Kelas rekaman, akses selamanya.', 'url' => '/kontak', 'badge' => 'Terlaris', 'image' => ''],
                    ['title' => 'Roti rumahan tanpa mixer', 'text' => '', 'url' => '/kontak', 'badge' => '', 'image' => ''],
                    ['title' => 'Kue bolu sekali aduk', 'text' => '', 'url' => '/kontak', 'badge' => '', 'image' => ''],
                ]]],
                ['type' => 'links', 'data' => ['title' => 'Kerja sama', 'items' => [
                    ['title' => 'Endorse & review produk', 'text' => '', 'url' => '/kontak', 'badge' => '', 'image' => ''],
                    ['title' => 'Undang aku jadi juri / pengisi acara', 'text' => '', 'url' => '/kontak', 'badge' => '', 'image' => ''],
                ]]],
                ['type' => 'cta', 'data' => ['title' => 'Selamat mencoba!', 'text' => '', 'button_label' => '', 'button_url' => '']],
            ]],
            ['title' => 'Kontak', 'slug' => 'kontak', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Sapa aku', 'subtitle' => 'Untuk kerja sama, pertanyaan resep, atau sekadar ngobrol soal makanan.']],
                ['type' => 'contact', 'data' => ['title' => 'Kirim pesan', 'text' => 'Aku balas secepatnya, biasanya dalam 1x24 jam.', 'show_form' => 'yes']],
            ]],
        ];
    }
}
