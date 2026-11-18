<?php

namespace App\Sections;

/**
 * Sample pages for the Wedding Organizer template: services, packages, gallery and
 * consultation.
 */
class WeddingContent
{
    /**
     * @return list<array<string, mixed>>
     */
    public static function pages(string $company): array
    {
        $plans = ['type' => 'plans', 'data' => ['title' => 'Paket pernikahan', 'subtitle' => 'Semua paket bisa disesuaikan dengan adat dan jumlah tamu.', 'items' => [
            ['name' => 'Intimate', 'price' => 'Rp45jt', 'info' => 'hingga 100 tamu', 'features' => "Dekorasi pelaminan\nKatering 100 pax\nMC & dokumentasi\nWedding organizer hari H", 'highlight' => 'no'],
            ['name' => 'Classic', 'badge' => 'Paling dipilih', 'price' => 'Rp95jt', 'info' => 'hingga 300 tamu', 'features' => "Dekorasi & bunga segar\nKatering 300 pax\nRias & busana pengantin\nFoto & video\nWO sejak 3 bulan sebelum", 'highlight' => 'yes'],
            ['name' => 'Grand', 'price' => 'Rp180jt', 'info' => 'hingga 700 tamu', 'features' => "Venue ballroom\nKatering 700 pax\nEntertainment & band\nSame day edit video\nWO lengkap", 'highlight' => 'no'],
        ], 'note' => 'Harga belum termasuk venue untuk paket Intimate dan Classic.']];

        $gallery = ['type' => 'gallery', 'data' => ['title' => 'Momen yang kami rangkai', 'items' => [
            ['image' => 'demo/wedding-couple.jpg', 'caption' => 'Adat Jawa'],
            ['image' => 'demo/wedding-tables.jpg', 'caption' => 'Resepsi'],
            ['image' => 'demo/wedding-happy.jpg', 'caption' => 'Akad'],
            ['image' => 'demo/wedding-venue.jpg', 'caption' => 'Ballroom'],
            ['image' => 'demo/wedding-table.jpg', 'caption' => 'Dekor meja'],
            ['image' => 'demo/wedding-setup.jpg', 'caption' => 'Pelaminan'],
        ]]];

        return [
            ['title' => 'Beranda', 'slug' => 'beranda', 'is_home' => true, 'sections' => [
                ['type' => 'hero', 'data' => [
                    'eyebrow' => 'Your happily ever after',
                    'title' => 'Hari bahagia, *tanpa* repot',
                    'subtitle' => "{$company} merencanakan pernikahan dari konsep, vendor, sampai hari H, agar Anda dan keluarga cukup menikmati momennya.",
                    'button_label' => 'Lihat Paket', 'button_url' => '/paket',
                    'button2_label' => 'Konsultasi Gratis', 'button2_url' => '/kontak',
                    'image' => 'demo/wedding-tables.jpg',
                ]],
                ['type' => 'services', 'data' => ['title' => 'Layanan kami', 'items' => [
                    ['title' => 'Perencanaan', 'text' => 'Konsep, anggaran, dan jadwal persiapan yang rapi.'],
                    ['title' => 'Dekorasi & venue', 'text' => 'Pelaminan, bunga, dan tata ruang sesuai impian.'],
                    ['title' => 'Koordinasi hari H', 'text' => 'Tim kami memastikan acara berjalan tepat waktu.'],
                ]]],
                ['type' => 'image_text', 'data' => ['title' => 'Setiap pasangan punya cerita', 'body' => "Kami mendengarkan dulu, lalu merancang pernikahan yang terasa seperti Anda: adat, modern, intimate, atau megah.\n\n- 400+ pernikahan sejak 2015\n- Jaringan 80+ vendor terpercaya\n- Pendampingan hingga akhir acara", 'image' => 'demo/wedding-couple.jpg', 'image_position' => 'left']],
                $plans,
                $gallery,
                ['type' => 'testimonials', 'data' => ['title' => 'Cerita mereka', 'items' => [
                    ['quote' => 'Kami tinggal datang dan menikmati. Semua detail diurus dengan sangat rapi.', 'name' => 'Ayu & Bima', 'role' => 'Menikah 2026'],
                    ['quote' => 'Dekorasinya persis seperti yang kami bayangkan, bahkan lebih indah.', 'name' => 'Sinta & Fajar', 'role' => 'Menikah 2025'],
                    ['quote' => 'Timnya sigap menangani keluarga besar kami. Terima kasih!', 'name' => 'Keluarga Wibowo', 'role' => 'Adat Jawa'],
                ]]],
                ['type' => 'cta', 'data' => ['title' => 'Mulai rencanakan hari bahagia', 'text' => 'Jadwalkan konsultasi gratis dengan wedding planner kami.', 'button_label' => 'Konsultasi Gratis', 'button_url' => '/kontak']],
            ]],
            ['title' => 'Paket', 'slug' => 'paket', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Paket Pernikahan', 'subtitle' => 'Transparan dan bisa disesuaikan.']],
                $plans,
                ['type' => 'steps', 'data' => ['title' => 'Alur persiapan', 'items' => [
                    ['title' => 'Konsultasi', 'text' => 'Kenalan, konsep, dan anggaran.'],
                    ['title' => 'Pilih vendor', 'text' => 'Venue, katering, dekor, busana.'],
                    ['title' => 'Technical meeting', 'text' => 'Rundown dan gladi bersih.'],
                    ['title' => 'Hari H', 'text' => 'Anda menikmati, kami yang bekerja.'],
                ]]],
            ]],
            ['title' => 'Galeri', 'slug' => 'galeri', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Galeri', 'subtitle' => 'Kenangan dari pasangan yang mempercayakan harinya kepada kami.']],
                $gallery,
            ]],
            ['title' => 'Kontak', 'slug' => 'kontak', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Konsultasi Gratis', 'subtitle' => 'Ceritakan rencana pernikahan Anda.']],
                ['type' => 'contact', 'data' => ['title' => 'Mari berbincang', 'text' => 'Tulis perkiraan tanggal, jumlah tamu, dan kota acara.', 'show_form' => 'yes']],
            ]],
        ];
    }
}
