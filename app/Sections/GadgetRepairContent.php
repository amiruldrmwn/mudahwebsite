<?php

namespace App\Sections;

/**
 * Sample pages for the Servis HP & Laptop template: repair price list, warranty, service status
 * by WhatsApp and pickup.
 */
class GadgetRepairContent
{
    /**
     * @return list<array<string, mixed>>
     */
    public static function pages(string $company): array
    {
        $prices = ['type' => 'pricelist', 'data' => ['title' => 'Harga servis', 'subtitle' => 'Harga sudah termasuk sparepart dan jasa. Cek gratis sebelum dikerjakan.', 'items' => [
            ['name' => 'Ganti LCD HP', 'description' => 'Android & iPhone, kualitas original', 'info' => '1 jam', 'price' => 'mulai Rp350.000', 'image' => 'demo/servis-lcd.jpg'],
            ['name' => 'Ganti baterai HP', 'description' => 'Baterai baru, kesehatan 100%', 'info' => '30 menit', 'price' => 'mulai Rp150.000', 'image' => 'demo/servis-hp.jpg'],
            ['name' => 'Servis mati total', 'description' => 'Perbaikan mesin & IC', 'info' => '1–3 hari', 'price' => 'mulai Rp250.000', 'image' => 'demo/servis-hero.jpg'],
            ['name' => 'Upgrade SSD laptop', 'description' => 'Termasuk pindah data & instal ulang', 'info' => '2 jam', 'price' => 'mulai Rp450.000', 'image' => 'demo/servis-laptop.jpg'],
            ['name' => 'Cleaning & ganti pasta', 'description' => 'Laptop panas dan berisik', 'info' => '1 jam', 'price' => 'Rp120.000', 'image' => 'demo/servis-board.jpg'],
            ['name' => 'Ganti keyboard laptop', 'description' => 'Semua merek', 'info' => '1 hari', 'price' => 'mulai Rp275.000', 'image' => 'demo/servis-macbook.jpg'],
        ], 'note' => 'Garansi 30–90 hari sesuai jenis perbaikan.', 'order_button' => 'yes']];

        $services = ['type' => 'services', 'data' => ['title' => 'Yang kami perbaiki', 'items' => [
            ['title' => 'HP Android & iPhone', 'text' => 'LCD, baterai, kamera, port cas, speaker, dan mati total.', 'image' => 'demo/servis-part.jpg'],
            ['title' => 'Laptop & MacBook', 'text' => 'Upgrade SSD/RAM, keyboard, engsel, layar, dan motherboard.', 'image' => 'demo/servis-laptop.jpg'],
            ['title' => 'Software & data', 'text' => 'Instal ulang, hapus virus, dan penyelamatan data.', 'image' => 'demo/servis-macbook.jpg'],
        ]]];

        return [
            ['title' => 'Beranda', 'slug' => 'beranda', 'is_home' => true, 'sections' => [
                ['type' => 'hero', 'data' => [
                    'eyebrow' => 'Servis HP & laptop',
                    'title' => 'HP rusak? *Beres hari ini*, bergaransi',
                    'subtitle' => "{$company} memperbaiki HP dan laptop semua merek dengan sparepart berkualitas. Cek gratis, harga jelas di awal, dan bisa ditunggu.",
                    'button_label' => 'Cek Harga Servis', 'button_url' => '/harga',
                    'button2_label' => 'Tanya Teknisi', 'button2_url' => '/kontak',
                    'image' => 'demo/servis-hero.jpg',
                ]],
                ['type' => 'stats', 'data' => ['items' => [
                    ['value' => '15.000+', 'label' => 'Perangkat diperbaiki'],
                    ['value' => '1 jam', 'label' => 'Ganti LCD & baterai'],
                    ['value' => '90 hari', 'label' => 'Garansi servis'],
                    ['value' => 'Gratis', 'label' => 'Cek kerusakan'],
                ]]],
                $services,
                $prices,
                ['type' => 'steps', 'data' => ['title' => 'Cara servis', 'items' => [
                    ['title' => 'Datang atau kirim', 'text' => 'Bawa ke toko, atau pakai jasa jemput-antar.'],
                    ['title' => 'Cek gratis', 'text' => 'Teknisi memeriksa dan memberi harga sebelum dikerjakan.'],
                    ['title' => 'Dikerjakan', 'text' => 'Pantau status servis lewat WhatsApp.'],
                    ['title' => 'Selesai & bergaransi', 'text' => 'Uji bersama sebelum diambil, nota garansi diberikan.'],
                ]]],
                ['type' => 'testimonials', 'data' => ['title' => 'Kata pelanggan', 'items' => [
                    ['quote' => 'LCD iPhone saya pecah, ditunggu 1 jam langsung beres. Harganya sesuai yang disebut di awal.', 'name' => 'Dina', 'role' => 'Ganti LCD'],
                    ['quote' => 'Laptop kantor yang lemot jadi ngebut setelah ganti SSD. Data aman semua.', 'name' => 'Pak Rudi', 'role' => 'Upgrade SSD'],
                    ['quote' => 'HP mati total kirain sudah tidak bisa, ternyata bisa hidup lagi.', 'name' => 'Fajar', 'role' => 'Servis mati total'],
                ]]],
                ['type' => 'cta', 'data' => ['title' => 'Kirim foto kerusakannya', 'text' => 'Teknisi kami beri perkiraan harga lewat WhatsApp dalam 5 menit.', 'button_label' => 'Chat Teknisi', 'button_url' => '/kontak']],
            ]],
            ['title' => 'Harga', 'slug' => 'harga', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Daftar Harga Servis', 'subtitle' => 'Harga final diberikan setelah cek gratis.']],
                $prices,
                ['type' => 'faq', 'data' => ['title' => 'Pertanyaan umum', 'items' => [
                    ['question' => 'Apakah data saya aman?', 'answer' => 'Kami tidak membuka data pribadi. Untuk servis besar, kami sarankan backup dulu atau kami bantu backup.'],
                    ['question' => 'Bagaimana jika tidak jadi diperbaiki?', 'answer' => 'Tidak ada biaya. Cek kerusakan selalu gratis.'],
                    ['question' => 'Apa saja yang tidak ditanggung garansi?', 'answer' => 'Kerusakan karena jatuh, terkena air, atau dibuka pihak lain setelah servis.'],
                ]]],
            ]],
            ['title' => 'Cek Status', 'slug' => 'status', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Cek Status Servis', 'subtitle' => 'Kirim nomor nota Anda, kami balas status terbarunya.']],
                ['type' => 'contact', 'data' => ['title' => 'Tanya status', 'text' => 'Tulis nomor nota dan nama pemilik perangkat. Kami balas lewat WhatsApp.', 'show_form' => 'yes']],
            ]],
            ['title' => 'Kontak', 'slug' => 'kontak', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Hubungi Teknisi', 'subtitle' => 'Buka setiap hari 09.00–21.00. Jemput-antar tersedia.']],
                ['type' => 'contact', 'data' => ['title' => 'Konsultasi kerusakan', 'text' => 'Tulis merek, tipe, dan keluhan perangkat Anda.', 'show_form' => 'yes']],
            ]],
        ];
    }
}
