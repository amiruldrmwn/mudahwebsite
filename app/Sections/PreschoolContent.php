<?php

namespace App\Sections;

/**
 * Sample pages for the Daycare & PAUD/TK template: programmes by age, daily activities, fees,
 * a gallery and enrolment.
 */
class PreschoolContent
{
    /**
     * @return list<array<string, mixed>>
     */
    public static function pages(string $company): array
    {
        $programs = ['type' => 'services', 'data' => ['title' => 'Program kami', 'subtitle' => 'Belajar sambil bermain, sesuai tahap tumbuh kembang anak.', 'items' => [
            ['title' => 'Daycare', 'text' => 'Usia 1–4 tahun. Penitipan harian 07.00–17.00 dengan makan dan tidur siang.', 'image' => 'demo/paud-main.jpg'],
            ['title' => 'Kelompok Bermain', 'text' => 'Usia 3–4 tahun. Mengenal warna, bentuk, dan bersosialisasi.', 'image' => 'demo/paud-balok.jpg'],
            ['title' => 'TK A & TK B', 'text' => 'Usia 4–6 tahun. Persiapan membaca, menulis, berhitung, dan masuk SD.', 'image' => 'demo/paud-warna.jpg'],
        ]]];

        $plans = ['type' => 'plans', 'data' => ['title' => 'Biaya pendidikan', 'subtitle' => 'Uang pangkal bisa dicicil 3 kali.', 'items' => [
            ['name' => 'Kelompok Bermain', 'badge' => '', 'price' => 'Rp450rb', 'old_price' => '', 'info' => 'per bulan', 'features' => "3 hari per minggu\n08.00–10.30\nSnack sehat\nLaporan perkembangan", 'highlight' => 'no'],
            ['name' => 'TK A / TK B', 'badge' => 'Paling dipilih', 'price' => 'Rp650rb', 'old_price' => '', 'info' => 'per bulan', 'features' => "Senin–Jumat\n07.30–11.00\nSnack & makan siang\nKelas mengaji & bahasa Inggris\nRapor semester", 'highlight' => 'yes'],
            ['name' => 'Daycare', 'badge' => '', 'price' => 'Rp1,8jt', 'old_price' => '', 'info' => 'per bulan', 'features' => "Senin–Jumat 07.00–17.00\nMakan 3x & susu\nTidur siang\nCCTV untuk orang tua", 'highlight' => 'no'],
        ]]];

        return [
            ['title' => 'Beranda', 'slug' => 'beranda', 'is_home' => true, 'sections' => [
                ['type' => 'hero', 'data' => [
                    'eyebrow' => 'Daycare · Kelompok Bermain · TK',
                    'title' => 'Tempat anak *tumbuh ceria*, belajar sambil bermain',
                    'subtitle' => "{$company} menyediakan lingkungan yang aman, bersih, dan penuh kasih, dengan guru berpengalaman dan kurikulum yang menyenangkan.",
                    'button_label' => 'Daftar Sekarang', 'button_url' => '/pendaftaran',
                    'button2_label' => 'Jadwalkan Kunjungan', 'button2_url' => '/pendaftaran',
                    'image' => 'demo/paud-hero.jpg',
                ]],
                ['type' => 'stats', 'data' => ['items' => [
                    ['value' => '1 : 6', 'label' => 'Rasio guru & anak'],
                    ['value' => '12 thn', 'label' => 'Berpengalaman'],
                    ['value' => 'CCTV', 'label' => 'Bisa dipantau orang tua'],
                    ['value' => 'Akreditasi B', 'label' => 'Izin Dinas Pendidikan'],
                ]]],
                $programs,
                ['type' => 'image_text', 'data' => ['title' => 'Kegiatan sehari-hari', 'body' => "- **07.30** Penyambutan & doa pagi\n- **08.00** Senam dan bermain di luar\n- **08.30** Kegiatan inti: seni, sains, bahasa\n- **09.30** Makan bekal bersama\n- **10.00** Bercerita & bernyanyi\n- **10.45** Pulang atau lanjut daycare", 'image' => 'demo/paud-kelas.jpg', 'image_position' => 'left']],
                ['type' => 'gallery', 'data' => ['title' => 'Galeri', 'items' => [
                    ['image' => 'demo/paud-hero.jpg', 'caption' => 'Mewarnai bersama guru'],
                    ['image' => 'demo/paud-main.jpg', 'caption' => 'Bermain peran'],
                    ['image' => 'demo/paud-balok.jpg', 'caption' => 'Mengenal huruf'],
                    ['image' => 'demo/paud-kelas.jpg', 'caption' => 'Ruang kelas yang lega'],
                    ['image' => 'demo/paud-rak.jpg', 'caption' => 'Alat main edukatif'],
                    ['image' => 'demo/paud-kamera.jpg', 'caption' => 'Pojok kreativitas'],
                ]]],
                ['type' => 'testimonials', 'data' => ['title' => 'Kata orang tua', 'items' => [
                    ['quote' => 'Anak saya yang pemalu jadi berani tampil. Gurunya sabar dan perhatian.', 'name' => 'Bunda Rara', 'role' => 'Orang tua murid TK A'],
                    ['quote' => 'Daycare-nya bersih, makanannya sehat, dan bisa pantau lewat CCTV dari kantor.', 'name' => 'Ayah Dimas', 'role' => 'Orang tua anak daycare'],
                    ['quote' => 'Lulus TK sudah lancar membaca, siap masuk SD.', 'name' => 'Bunda Lia', 'role' => 'Orang tua alumni'],
                ]]],
                ['type' => 'cta', 'data' => ['title' => 'Pendaftaran tahun ajaran baru dibuka', 'text' => 'Kuota terbatas setiap kelas. Datang dan lihat langsung suasana sekolah kami.', 'button_label' => 'Daftar Sekarang', 'button_url' => '/pendaftaran']],
            ]],
            ['title' => 'Program', 'slug' => 'program', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Program & Biaya', 'subtitle' => 'Pilih program sesuai usia dan kebutuhan keluarga.']],
                $programs,
                $plans,
                ['type' => 'faq', 'data' => ['title' => 'Pertanyaan orang tua', 'items' => [
                    ['question' => 'Usia berapa anak bisa mulai?', 'answer' => 'Daycare mulai usia 1 tahun, Kelompok Bermain 3 tahun, dan TK mulai 4 tahun.'],
                    ['question' => 'Apakah ada uji coba?', 'answer' => 'Ada, anak bisa ikut kelas percobaan 1 hari secara gratis.'],
                    ['question' => 'Bagaimana dengan makanan?', 'answer' => 'Menu disusun ahli gizi dan dimasak di dapur sekolah setiap hari.'],
                ]]],
            ]],
            ['title' => 'Galeri', 'slug' => 'galeri', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Galeri Kegiatan', 'subtitle' => 'Keceriaan anak-anak setiap hari.']],
                ['type' => 'gallery', 'data' => ['items' => [
                    ['image' => 'demo/paud-hero.jpg', 'caption' => 'Mewarnai bersama guru'],
                    ['image' => 'demo/paud-warna.jpg', 'caption' => 'Kelas seni'],
                    ['image' => 'demo/paud-main.jpg', 'caption' => 'Bermain peran'],
                    ['image' => 'demo/paud-balok.jpg', 'caption' => 'Mengenal huruf'],
                    ['image' => 'demo/paud-rak.jpg', 'caption' => 'Alat main edukatif'],
                    ['image' => 'demo/paud-kelas.jpg', 'caption' => 'Ruang kelas'],
                ]]],
            ]],
            ['title' => 'Pendaftaran', 'slug' => 'pendaftaran', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Pendaftaran Murid Baru', 'subtitle' => 'Isi formulir, kami hubungi untuk jadwal kunjungan.']],
                ['type' => 'contact', 'data' => ['title' => 'Formulir pendaftaran', 'text' => 'Tulis nama dan usia anak, program yang diminati, dan nomor WhatsApp orang tua.', 'show_form' => 'yes']],
            ]],
        ];
    }
}
