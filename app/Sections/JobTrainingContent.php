<?php

namespace App\Sections;

/**
 * Sample pages for the LPK & Kursus Kerja template: language and skills training for work in
 * Japan and Korea, programmes, cohort schedule, alumni and registration.
 */
class JobTrainingContent
{
    /**
     * @return list<array<string, mixed>>
     */
    public static function pages(string $company): array
    {
        $programs = ['type' => 'services', 'data' => ['title' => 'Program pelatihan', 'subtitle' => 'Belajar bahasa, budaya kerja, dan keterampilan sampai siap berangkat.', 'items' => [
            ['title' => 'Magang ke Jepang (TITP)', 'text' => 'Bahasa Jepang N4, fisik, dan disiplin kerja. Kontrak 3 tahun.', 'image' => 'demo/lpk-pabrik.jpg'],
            ['title' => 'Tokutei Ginou (SSW)', 'text' => 'Persiapan ujian keahlian dan JFT Basic untuk kerja di Jepang.', 'image' => 'demo/lpk-teknik.jpg'],
            ['title' => 'Kerja ke Korea (EPS-TOPIK)', 'text' => 'Kelas intensif bahasa Korea untuk ujian EPS-TOPIK.', 'image' => 'demo/lpk-kelas.jpg'],
            ['title' => 'Kursus keterampilan', 'text' => 'Pengelasan, perawat lansia (kaigo), dan pengolahan makanan.', 'image' => 'demo/lpk-las.jpg'],
        ]]];

        $plans = ['type' => 'plans', 'data' => ['title' => 'Biaya pelatihan', 'subtitle' => 'Bisa dicicil. Biaya keberangkatan dijelaskan saat seleksi.', 'items' => [
            ['name' => 'Kelas Bahasa', 'badge' => '', 'price' => 'Rp4,5jt', 'old_price' => '', 'info' => '3 bulan', 'features' => "Bahasa Jepang / Korea dasar\nModul & buku\nSertifikat kursus\nKelas pagi atau malam", 'highlight' => 'no'],
            ['name' => 'Program Magang', 'badge' => 'Paling diminati', 'price' => 'Rp12jt', 'old_price' => 'Rp15jt', 'info' => '6 bulan + asrama', 'features' => "Bahasa sampai N4\nLatihan fisik & disiplin\nAsrama & makan\nWawancara dengan user Jepang\nPengurusan dokumen", 'highlight' => 'yes'],
            ['name' => 'Persiapan SSW', 'badge' => '', 'price' => 'Rp8jt', 'old_price' => '', 'info' => '4 bulan', 'features' => "JFT Basic / JLPT N4\nUjian keahlian bidang\nSimulasi ujian\nInfo lowongan", 'highlight' => 'no'],
        ]]];

        return [
            ['title' => 'Beranda', 'slug' => 'beranda', 'is_home' => true, 'sections' => [
                ['type' => 'hero', 'data' => [
                    'eyebrow' => 'Lembaga Pelatihan Kerja resmi',
                    'title' => 'Siap kerja di *Jepang & Korea*',
                    'subtitle' => "{$company} melatih bahasa, budaya kerja, dan keterampilan sampai Anda lolos wawancara dan berangkat dengan aman dan legal.",
                    'button_label' => 'Daftar Angkatan Baru', 'button_url' => '/pendaftaran',
                    'button2_label' => 'Lihat Program', 'button2_url' => '/program',
                    'image' => 'demo/lpk-hero.jpg',
                ]],
                ['type' => 'stats', 'data' => ['items' => [
                    ['value' => '1.200+', 'label' => 'Alumni berangkat'],
                    ['value' => '92%', 'label' => 'Lolos wawancara'],
                    ['value' => '40+', 'label' => 'Perusahaan mitra'],
                    ['value' => 'Resmi', 'label' => 'Izin Disnaker'],
                ]]],
                $programs,
                ['type' => 'steps', 'data' => ['title' => 'Dari daftar sampai berangkat', 'items' => [
                    ['title' => 'Daftar & tes awal', 'text' => 'Tes kesehatan, fisik, dan matematika dasar.'],
                    ['title' => 'Pelatihan', 'text' => '4–6 bulan belajar bahasa dan budaya kerja di asrama.'],
                    ['title' => 'Wawancara', 'text' => 'Wawancara langsung dengan perusahaan di Jepang atau Korea.'],
                    ['title' => 'Berangkat', 'text' => 'Visa, tiket, dan pendampingan sampai tiba di tempat kerja.'],
                ]]],
                ['type' => 'image_text', 'data' => ['title' => 'Belajar dengan sensei berpengalaman', 'body' => "Pengajar kami alumni yang pernah bekerja di Jepang dan Korea. Kelas kecil, maksimal 20 siswa, dengan praktik bicara setiap hari.\n\n- Asrama putra & putri terpisah\n- Latihan fisik setiap pagi\n- Simulasi wawancara mingguan", 'image' => 'demo/lpk-kelas.jpg', 'image_position' => 'left']],
                ['type' => 'testimonials', 'data' => ['title' => 'Cerita alumni', 'items' => [
                    ['quote' => 'Dari lulusan SMK, sekarang kerja di pabrik otomotif di Aichi. Gaji bisa bantu orang tua.', 'name' => 'Rudi', 'role' => 'Alumni angkatan 14, Jepang'],
                    ['quote' => 'Sensei sabar banget. Saya lulus N4 dalam 5 bulan.', 'name' => 'Siti', 'role' => 'Kaigo di Osaka'],
                    ['quote' => 'Lolos EPS-TOPIK percobaan pertama berkat kelas intensif.', 'name' => 'Agus', 'role' => 'Manufaktur, Korea Selatan'],
                ]]],
                ['type' => 'cta', 'data' => ['title' => 'Angkatan baru mulai bulan depan', 'text' => 'Kuota terbatas 40 siswa. Daftar sekarang untuk ikut tes seleksi.', 'button_label' => 'Daftar Sekarang', 'button_url' => '/pendaftaran']],
            ]],
            ['title' => 'Program', 'slug' => 'program', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Program & Biaya', 'subtitle' => 'Pilih program sesuai tujuan Anda.', 'image' => 'demo/lpk-jalan.jpg']],
                $programs,
                $plans,
                ['type' => 'faq', 'data' => ['title' => 'Pertanyaan calon siswa', 'items' => [
                    ['question' => 'Apa syarat ikut program magang ke Jepang?', 'answer' => 'Usia 18–30 tahun, minimal lulus SMA/SMK, sehat jasmani, tidak bertato, dan tidak buta warna.'],
                    ['question' => 'Apakah biaya bisa dicicil?', 'answer' => 'Bisa, dibayar bertahap selama masa pelatihan.'],
                    ['question' => 'Apakah ada jaminan berangkat?', 'answer' => 'Kami tidak menjanjikan kelulusan tanpa usaha, tapi 92% siswa kami lolos wawancara. Siswa yang belum lolos ikut wawancara berikutnya tanpa biaya tambahan.'],
                ]]],
            ]],
            ['title' => 'Alumni', 'slug' => 'alumni', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Alumni & Kegiatan', 'subtitle' => 'Ribuan alumni kini bekerja di Jepang dan Korea.']],
                ['type' => 'gallery', 'data' => ['title' => 'Galeri', 'items' => [
                    ['image' => 'demo/lpk-kelas.jpg', 'caption' => 'Kelas percakapan'],
                    ['image' => 'demo/lpk-aula.jpg', 'caption' => 'Ujian JLPT bersama'],
                    ['image' => 'demo/lpk-las.jpg', 'caption' => 'Praktik pengelasan'],
                    ['image' => 'demo/lpk-pabrik.jpg', 'caption' => 'Alumni di tempat kerja'],
                    ['image' => 'demo/lpk-hero.jpg', 'caption' => 'Libur akhir pekan alumni di Fujiyoshida'],
                    ['image' => 'demo/lpk-jalan.jpg', 'caption' => 'Kehidupan sehari-hari di Tokyo'],
                ]]],
            ]],
            ['title' => 'Pendaftaran', 'slug' => 'pendaftaran', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Pendaftaran Siswa', 'subtitle' => 'Gratis konsultasi dan tes awal.']],
                ['type' => 'contact', 'data' => ['title' => 'Formulir pendaftaran', 'text' => 'Tulis nama, usia, pendidikan terakhir, dan program yang diminati. Kami jadwalkan tes awal lewat WhatsApp.', 'show_form' => 'yes']],
            ]],
        ];
    }
}
