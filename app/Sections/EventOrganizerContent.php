<?php

namespace App\Sections;

/**
 * Sample pages for the Event Organizer template: event types, packages, portfolio and the
 * planning flow.
 */
class EventOrganizerContent
{
    /**
     * @return list<array<string, mixed>>
     */
    public static function pages(string $company): array
    {
        $services = ['type' => 'services', 'data' => ['title' => 'Acara yang kami tangani', 'subtitle' => 'Dari 50 sampai 10.000 tamu.', 'items' => [
            ['title' => 'Corporate event', 'text' => 'Gathering, seminar, peluncuran produk, dan rapat tahunan.', 'image' => 'demo/eo-seminar.jpg'],
            ['title' => 'Konser & festival', 'text' => 'Panggung, sound, lighting, tiket, dan keamanan.', 'image' => 'demo/eo-concert.jpg'],
            ['title' => 'Pernikahan & private party', 'text' => 'Dekorasi, rundown, MC, dan dokumentasi.', 'image' => 'demo/eo-wedding.jpg'],
        ]]];

        $packages = ['type' => 'plans', 'data' => ['title' => 'Paket layanan', 'subtitle' => 'Bisa disesuaikan dengan anggaran dan konsep Anda.', 'items' => [
            ['name' => 'Basic', 'badge' => '', 'price' => 'Rp15jt', 'old_price' => '', 'info' => 'hingga 100 tamu', 'features' => "Konsep & rundown\nMC profesional\nSound system standar\nKoordinator acara", 'highlight' => 'no'],
            ['name' => 'Professional', 'badge' => 'Paling dipilih', 'price' => 'Rp45jt', 'old_price' => '', 'info' => 'hingga 500 tamu', 'features' => "Semua isi Basic\nPanggung & lighting\nDekorasi tematik\nFoto & video\nTim lapangan 10 orang", 'highlight' => 'yes'],
            ['name' => 'Premium', 'badge' => '', 'price' => 'Custom', 'old_price' => '', 'info' => '500+ tamu', 'features' => "Konsep kreatif penuh\nTalent & artis\nLED screen & live streaming\nManajemen vendor penuh", 'highlight' => 'no'],
        ]]];

        return [
            ['title' => 'Beranda', 'slug' => 'beranda', 'is_home' => true, 'sections' => [
                ['type' => 'hero', 'data' => [
                    'eyebrow' => 'Event organizer',
                    'title' => 'Acara Anda, kami buat *tak terlupakan*',
                    'subtitle' => "{$company} merancang dan menjalankan acara perusahaan, konser, dan pernikahan, dari konsep sampai acara selesai.",
                    'button_label' => 'Konsultasi Gratis', 'button_url' => '/kontak',
                    'button2_label' => 'Lihat Portofolio', 'button2_url' => '/portofolio',
                    'image' => 'demo/eo-hero.jpg',
                ]],
                ['type' => 'stats', 'data' => ['items' => [
                    ['value' => '650+', 'label' => 'Acara sukses'],
                    ['value' => '120', 'label' => 'Klien perusahaan'],
                    ['value' => '10rb', 'label' => 'Tamu terbanyak'],
                    ['value' => '12 thn', 'label' => 'Pengalaman'],
                ]]],
                $services,
                $packages,
                ['type' => 'steps', 'data' => ['title' => 'Cara kami bekerja', 'items' => [
                    ['title' => 'Briefing', 'text' => 'Ceritakan tujuan, tamu, tanggal, dan anggaran.'],
                    ['title' => 'Konsep & proposal', 'text' => 'Konsep kreatif, rundown, dan rincian biaya.'],
                    ['title' => 'Persiapan', 'text' => 'Vendor, venue, dan gladi bersih kami urus.'],
                    ['title' => 'Hari H', 'text' => 'Tim kami di lapangan, Anda cukup menikmati.'],
                ]]],
                ['type' => 'testimonials', 'data' => ['title' => 'Kata klien', 'items' => [
                    ['quote' => 'Gathering 800 karyawan berjalan mulus, rundown tepat waktu.', 'name' => 'Lina', 'role' => 'HR Manager, perusahaan FMCG'],
                    ['quote' => 'Peluncuran produk kami jadi viral. Konsepnya segar.', 'name' => 'Arif', 'role' => 'Marketing Director'],
                    ['quote' => 'Pernikahan impian kami terwujud, semua detail diurus.', 'name' => 'Dina & Raka', 'role' => 'Pengantin'],
                ]]],
                ['type' => 'cta', 'data' => ['title' => 'Punya acara dalam 3 bulan ke depan?', 'text' => 'Kunci tanggal Anda sekarang, konsultasi gratis.', 'button_label' => 'Hubungi Kami', 'button_url' => '/kontak']],
            ]],
            ['title' => 'Layanan', 'slug' => 'layanan', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Layanan & Paket', 'subtitle' => 'Satu tim untuk seluruh kebutuhan acara.', 'image' => 'demo/eo-ballroom.jpg']],
                $services,
                $packages,
            ]],
            ['title' => 'Portofolio', 'slug' => 'portofolio', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Portofolio', 'subtitle' => 'Acara yang pernah kami tangani.']],
                ['type' => 'gallery', 'data' => ['title' => 'Galeri acara', 'items' => [
                    ['image' => 'demo/eo-hero.jpg', 'caption' => 'Festival musik kota'],
                    ['image' => 'demo/eo-seminar.jpg', 'caption' => 'Konferensi nasional'],
                    ['image' => 'demo/eo-wedding.jpg', 'caption' => 'Pernikahan adat'],
                    ['image' => 'demo/eo-launch.jpg', 'caption' => 'Peluncuran produk'],
                    ['image' => 'demo/eo-gathering.jpg', 'caption' => 'Networking night'],
                    ['image' => 'demo/eo-ballroom.jpg', 'caption' => 'Gala dinner'],
                ]]],
            ]],
            ['title' => 'Kontak', 'slug' => 'kontak', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Konsultasi Acara', 'subtitle' => 'Proposal dikirim dalam 3 hari kerja.']],
                ['type' => 'contact', 'data' => ['title' => 'Ceritakan acara Anda', 'text' => 'Jenis acara, tanggal, jumlah tamu, dan perkiraan anggaran.', 'show_form' => 'yes']],
            ]],
        ];
    }
}
