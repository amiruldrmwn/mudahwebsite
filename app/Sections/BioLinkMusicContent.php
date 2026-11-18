<?php

namespace App\Sections;

/**
 * Sample pages for the dark Bio Link template: a singer's link page with the new single, streaming
 * links with cover pictures, upcoming shows and booking.
 */
class BioLinkMusicContent
{
    /**
     * @return list<array<string, mixed>>
     */
    public static function pages(string $company): array
    {
        return [
            ['title' => 'Beranda', 'slug' => 'beranda', 'is_home' => true, 'sections' => [
                ['type' => 'hero', 'data' => [
                    'eyebrow' => '@nadiramusik',
                    'title' => $company,
                    'subtitle' => 'Penyanyi & penulis lagu. Single baru "Langit Sore" sudah tayang di semua platform musik.',
                    'button_label' => 'Dengarkan sekarang', 'button_url' => '/kontak',
                    'button2_label' => '', 'button2_url' => '',
                    'image' => 'demo/bio3-avatar.jpg',
                ]],
                ['type' => 'links', 'data' => ['title' => 'Dengarkan', 'items' => [
                    ['title' => 'Langit Sore – single baru', 'text' => 'Spotify, Apple Music, YouTube Music', 'url' => '/kontak', 'badge' => 'Baru', 'image' => 'demo/bio3-studio.jpg'],
                    ['title' => 'Video klip di YouTube', 'text' => '', 'url' => '/kontak', 'badge' => '', 'image' => 'demo/bio3-live.jpg'],
                    ['title' => 'Album "Pulang" (2025)', 'text' => '', 'url' => '/kontak', 'badge' => '', 'image' => 'demo/bio3-stage.jpg'],
                ]]],
                ['type' => 'links', 'data' => ['title' => 'Jadwal manggung', 'items' => [
                    ['title' => '6 Des · Bandung – Festival Kopi Kota', 'text' => '', 'url' => '/kontak', 'badge' => 'Tiket', 'image' => ''],
                    ['title' => '14 Des · Jakarta – Showcase akustik', 'text' => '', 'url' => '/kontak', 'badge' => '', 'image' => ''],
                    ['title' => '31 Des · Yogyakarta – Malam tahun baru', 'text' => '', 'url' => '/kontak', 'badge' => '', 'image' => ''],
                ]]],
                ['type' => 'links', 'data' => ['title' => 'Lainnya', 'items' => [
                    ['title' => 'Merchandise resmi', 'text' => '', 'url' => '/kontak', 'badge' => '', 'image' => ''],
                    ['title' => 'Booking manggung & kolaborasi', 'text' => '', 'url' => '/kontak', 'badge' => '', 'image' => ''],
                ]]],
            ]],
            ['title' => 'Kontak', 'slug' => 'kontak', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Booking & kolaborasi', 'subtitle' => 'Untuk manggung, endorse, dan kolaborasi lagu.']],
                ['type' => 'contact', 'data' => ['title' => 'Kirim pesan', 'text' => 'Manajemen akan membalas dalam 1x24 jam.', 'show_form' => 'yes']],
            ]],
        ];
    }
}
