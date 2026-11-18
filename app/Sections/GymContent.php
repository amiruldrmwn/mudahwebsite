<?php

namespace App\Sections;

/**
 * Sample pages for the Gym & Fitness template: memberships, classes, personal trainers and a
 * free trial pass.
 */
class GymContent
{
    /**
     * @return list<array<string, mixed>>
     */
    public static function pages(string $company): array
    {
        $plans = ['type' => 'plans', 'data' => ['title' => 'Membership', 'subtitle' => 'Tanpa biaya pendaftaran bulan ini. Bisa cuti kapan saja.', 'items' => [
            ['name' => 'Harian', 'badge' => '', 'price' => 'Rp50rb', 'old_price' => '', 'info' => 'per kunjungan', 'features' => "Akses gym seharian\nLoker & shower\nWiFi gratis", 'highlight' => 'no'],
            ['name' => 'Bulanan', 'badge' => 'Terlaris', 'price' => 'Rp350rb', 'old_price' => 'Rp450rb', 'info' => 'per bulan', 'features' => "Akses gym tanpa batas\nSemua kelas grup\n1 sesi body check\nLoker & shower", 'highlight' => 'yes'],
            ['name' => 'Tahunan', 'badge' => 'Hemat 30%', 'price' => 'Rp2,9jt', 'old_price' => '', 'info' => 'per tahun', 'features' => "Semua isi Bulanan\n4 sesi personal trainer\nHanduk & air mineral\nBawa teman gratis 2x/bln", 'highlight' => 'no'],
        ]]];

        $classes = ['type' => 'services', 'data' => ['title' => 'Kelas & program', 'subtitle' => 'Lebih dari 40 kelas grup setiap minggu.', 'items' => [
            ['title' => 'Strength training', 'text' => 'Area free weight dan mesin lengkap untuk membentuk otot.', 'image' => 'demo/gym-lift.jpg'],
            ['title' => 'HIIT & functional', 'text' => 'Bakar kalori dengan battle rope, box jump, dan kettlebell.', 'image' => 'demo/gym-ropes.jpg'],
            ['title' => 'Personal training', 'text' => 'Program pribadi bersama trainer bersertifikat, target lebih cepat.', 'image' => 'demo/gym-coach.jpg'],
        ]]];

        return [
            ['title' => 'Beranda', 'slug' => 'beranda', 'is_home' => true, 'sections' => [
                ['type' => 'hero', 'data' => [
                    'eyebrow' => 'Buka 24 jam',
                    'title' => 'Lebih *kuat* setiap hari',
                    'subtitle' => "{$company}: alat lengkap, kelas seru, dan trainer yang membantu Anda mencapai target. Coba gratis satu hari.",
                    'button_label' => 'Coba Gratis', 'button_url' => '/kontak',
                    'button2_label' => 'Lihat Membership', 'button2_url' => '/membership',
                    'image' => 'demo/gym-hero.jpg',
                ]],
                ['type' => 'stats', 'data' => ['items' => [
                    ['value' => '2.000+', 'label' => 'Member aktif'],
                    ['value' => '40+', 'label' => 'Kelas per minggu'],
                    ['value' => '12', 'label' => 'Trainer bersertifikat'],
                    ['value' => '24/7', 'label' => 'Jam buka'],
                ]]],
                $classes,
                $plans,
                ['type' => 'testimonials', 'data' => ['title' => 'Cerita member', 'items' => [
                    ['quote' => 'Turun 12 kg dalam 4 bulan dengan program personal trainer. Coach-nya sabar banget.', 'name' => 'Rina', 'role' => 'Member 1 tahun'],
                    ['quote' => 'Buka 24 jam, cocok untuk saya yang kerja shift.', 'name' => 'Dedi', 'role' => 'Perawat'],
                    ['quote' => 'Kelas HIIT-nya bikin ketagihan, suasananya semangat.', 'name' => 'Sinta', 'role' => 'Mahasiswa'],
                ]]],
                ['type' => 'cta', 'data' => ['title' => 'Mulai hari ini, bukan Senin depan', 'text' => 'Datang dan coba gratis satu hari, termasuk body check.', 'button_label' => 'Klaim Free Pass', 'button_url' => '/kontak']],
            ]],
            ['title' => 'Kelas', 'slug' => 'kelas', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Kelas & Jadwal', 'subtitle' => 'Gratis untuk semua member bulanan dan tahunan.', 'image' => 'demo/gym-dark.jpg']],
                $classes,
                ['type' => 'pricelist', 'data' => ['title' => 'Jadwal kelas grup', 'items' => [
                    ['name' => 'Body Pump', 'description' => 'Senin, Rabu, Jumat', 'info' => '06.00 & 18.30', 'price' => '60 menit'],
                    ['name' => 'HIIT', 'description' => 'Selasa, Kamis', 'info' => '19.00', 'price' => '45 menit'],
                    ['name' => 'Yoga', 'description' => 'Sabtu, Minggu', 'info' => '07.00', 'price' => '75 menit'],
                    ['name' => 'Zumba', 'description' => 'Rabu, Sabtu', 'info' => '16.00', 'price' => '60 menit'],
                ], 'order_button' => 'no']],
                ['type' => 'team', 'data' => ['title' => 'Trainer kami', 'items' => [
                    ['photo' => 'demo/gym-coach.jpg', 'name' => 'Coach Rafi', 'role' => 'Strength & conditioning'],
                    ['photo' => 'demo/gym-lift.jpg', 'name' => 'Coach Maya', 'role' => 'Weight loss & HIIT'],
                    ['photo' => 'demo/gym-barbell.jpg', 'name' => 'Coach Bima', 'role' => 'Powerlifting'],
                ]]],
            ]],
            ['title' => 'Membership', 'slug' => 'membership', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Membership', 'subtitle' => 'Pilih yang paling cocok dengan rutinitas Anda.']],
                $plans,
                ['type' => 'faq', 'data' => ['title' => 'Pertanyaan umum', 'items' => [
                    ['question' => 'Apakah bisa cuti membership?', 'answer' => 'Bisa, sampai 2 bulan per tahun dengan surat keterangan.'],
                    ['question' => 'Pemula boleh ikut?', 'answer' => 'Tentu. Setiap member baru mendapat orientasi alat dan body check gratis.'],
                    ['question' => 'Ada parkir?', 'answer' => 'Ada parkir motor dan mobil gratis untuk member.'],
                ]]],
            ]],
            ['title' => 'Kontak', 'slug' => 'kontak', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Klaim Free Pass', 'subtitle' => 'Isi formulir, kami kirim free pass lewat WhatsApp.']],
                ['type' => 'contact', 'data' => ['title' => 'Daftar coba gratis', 'text' => 'Tulis nama, nomor WhatsApp, dan hari kedatangan.', 'show_form' => 'yes']],
            ]],
        ];
    }
}
