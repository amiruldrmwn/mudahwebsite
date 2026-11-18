<?php

namespace App\Sections;

/**
 * Sample pages for the Kursus / Bimbel template: programs, prices, tutors and registration.
 */
class TutoringContent
{
    /**
     * @return list<array<string, mixed>>
     */
    public static function pages(string $company): array
    {
        $plans = ['type' => 'plans', 'data' => ['title' => 'Program belajar', 'subtitle' => 'Kelas kecil maksimal 8 siswa, atau privat ke rumah.', 'items' => [
            ['name' => 'Reguler SD', 'price' => 'Rp350rb', 'info' => 'per bulan, 8 pertemuan', 'features' => "Matematika & IPA\nPR dibantu\nRapor bulanan", 'highlight' => 'no'],
            ['name' => 'Intensif SMP/SMA', 'badge' => 'Terfavorit', 'price' => 'Rp600rb', 'info' => 'per bulan, 12 pertemuan', 'features' => "Semua mapel UN/UTBK\nTryout bulanan\nKonsultasi jurusan\nGrup diskusi", 'highlight' => 'yes'],
            ['name' => 'Privat', 'price' => 'Rp120rb', 'info' => 'per pertemuan, 90 menit', 'features' => "Guru datang ke rumah\nJadwal fleksibel\nMateri sesuai kebutuhan", 'highlight' => 'no'],
        ], 'note' => 'Gratis 1x kelas percobaan untuk siswa baru.']];

        return [
            ['title' => 'Beranda', 'slug' => 'beranda', 'is_home' => true, 'sections' => [
                ['type' => 'hero', 'data' => [
                    'eyebrow' => 'Pendaftaran semester baru dibuka',
                    'title' => 'Belajar jadi *seru*, nilai ikut naik',
                    'subtitle' => "{$company} membantu siswa SD, SMP, dan SMA memahami pelajaran dengan cara yang menyenangkan, bersama pengajar yang sabar dan berpengalaman.",
                    'button_label' => 'Lihat Program', 'button_url' => '/program',
                    'button2_label' => 'Coba Kelas Gratis', 'button2_url' => '/daftar',
                    'image' => 'demo/bimbel-tutor.jpg',
                ]],
                ['type' => 'stats', 'data' => ['items' => [
                    ['value' => '2.500+', 'label' => 'Siswa'],
                    ['value' => '92%', 'label' => 'Lolos PTN favorit'],
                    ['value' => '35', 'label' => 'Pengajar'],
                    ['value' => '8', 'label' => 'Siswa per kelas'],
                ]]],
                ['type' => 'services', 'data' => ['title' => 'Kenapa belajar di sini?', 'items' => [
                    ['title' => 'Kelas kecil', 'text' => 'Setiap siswa diperhatikan dan berani bertanya.', 'image' => 'demo/bimbel-session.jpg'],
                    ['title' => 'Metode menyenangkan', 'text' => 'Konsep dulu, lalu latihan dengan permainan.', 'image' => 'demo/bimbel-kids.jpg'],
                    ['title' => 'Laporan ke orang tua', 'text' => 'Perkembangan nilai dipantau setiap bulan.', 'image' => 'demo/bimbel-class.jpg'],
                ]]],
                $plans,
                ['type' => 'team', 'data' => ['title' => 'Pengajar kami', 'items' => [
                    ['photo' => 'demo/bimbel-tutor.jpg', 'name' => 'Pak Arif', 'role' => 'Matematika'],
                    ['photo' => 'demo/bimbel-session.jpg', 'name' => 'Bu Nadia', 'role' => 'Bahasa Inggris'],
                    ['photo' => 'demo/bimbel-friends.jpg', 'name' => 'Kak Dimas', 'role' => 'Fisika & Kimia'],
                ]]],
                ['type' => 'testimonials', 'data' => ['title' => 'Kata siswa & orang tua', 'items' => [
                    ['quote' => 'Nilai matematika anak saya naik dari 65 ke 88 dalam satu semester.', 'name' => 'Ibu Ratna', 'role' => 'Orang tua siswa SMP'],
                    ['quote' => 'Tryout rutin bikin saya percaya diri waktu UTBK. Alhamdulillah lolos!', 'name' => 'Salsa', 'role' => 'Alumni, kini kuliah di PTN'],
                    ['quote' => 'Gurunya asik, belajar jadi tidak membosankan.', 'name' => 'Raffi', 'role' => 'Siswa kelas 5'],
                ]]],
                ['type' => 'cta', 'data' => ['title' => 'Coba kelas gratis minggu ini', 'text' => 'Rasakan langsung suasana belajarnya sebelum mendaftar.', 'button_label' => 'Daftar Kelas Gratis', 'button_url' => '/daftar']],
            ]],
            ['title' => 'Program', 'slug' => 'program', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Program & Biaya', 'subtitle' => 'Untuk SD, SMP, SMA, dan persiapan UTBK.']],
                $plans,
                ['type' => 'faq', 'data' => ['title' => 'Pertanyaan umum', 'items' => [
                    ['question' => 'Apakah ada kelas online?', 'answer' => 'Ada, kelas online lewat Zoom dengan materi dan tryout yang sama.'],
                    ['question' => 'Bagaimana jika siswa izin?', 'answer' => 'Pertemuan bisa diganti di jadwal kelas lain pada minggu yang sama.'],
                ]]],
            ]],
            ['title' => 'Galeri', 'slug' => 'galeri', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Suasana Belajar', 'subtitle' => 'Belajar serius, tetap gembira.']],
                ['type' => 'gallery', 'data' => ['items' => [
                    ['image' => 'demo/bimbel-class.jpg', 'caption' => 'Kelas SMA'],
                    ['image' => 'demo/bimbel-kids.jpg', 'caption' => 'Kelas SD'],
                    ['image' => 'demo/bimbel-group.jpg', 'caption' => 'Siswa berprestasi'],
                    ['image' => 'demo/bimbel-friends.jpg', 'caption' => 'Belajar kelompok'],
                    ['image' => 'demo/bimbel-session.jpg', 'caption' => 'Les privat'],
                    ['image' => 'demo/bimbel-tutor.jpg', 'caption' => 'Pendampingan'],
                ]]],
            ]],
            ['title' => 'Daftar', 'slug' => 'daftar', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Daftar Sekarang', 'subtitle' => 'Admin akan menghubungi untuk jadwal kelas percobaan.']],
                ['type' => 'contact', 'data' => ['title' => 'Formulir pendaftaran', 'text' => 'Tulis nama siswa, kelas, dan program yang diminati.', 'show_form' => 'yes']],
            ]],
        ];
    }
}
