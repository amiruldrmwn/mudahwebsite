<?php

namespace App\Sections;

/**
 * Sample pages for the Pesantren template: the pondok's programmes (tahfidz, kitab kuning, formal
 * school), daily life, the caretakers, news and new santri admission (PSB).
 */
class PesantrenContent
{
    /**
     * @return list<array<string, mixed>>
     */
    public static function pages(string $company): array
    {
        $programs = ['type' => 'services', 'data' => ['title' => 'Program unggulan', 'subtitle' => 'Memadukan pendidikan agama, akademik, dan pembentukan akhlak.', 'items' => [
            ['title' => 'Tahfidzul Qur\'an', 'text' => 'Target hafalan bertahap dengan setoran harian kepada ustadz pembimbing.', 'image' => 'demo/pesantren-quran.jpg'],
            ['title' => 'Kajian Kitab Kuning', 'text' => 'Fiqih, aqidah, akhlak, dan nahwu-sharaf dengan metode bandongan dan sorogan.', 'image' => 'demo/pesantren-mushaf.jpg'],
            ['title' => 'Madrasah Formal', 'text' => 'Jenjang MTs dan MA berkurikulum nasional, terakreditasi.', 'image' => 'demo/pesantren-santriwati.jpg'],
        ]]];

        $news = [
            ['image' => 'demo/pesantren-ngaji.jpg', 'category' => 'Kegiatan', 'date' => '12 Nov 2026', 'title' => 'Khataman Al-Qur\'an dan wisuda tahfidz angkatan ke-9', 'text' => '42 santri menyelesaikan hafalan 30 juz dan diwisuda di hadapan wali santri.'],
            ['image' => 'demo/pesantren-santri.jpg', 'category' => 'Prestasi', 'date' => '28 Okt 2026', 'title' => 'Juara 1 MTQ cabang tilawah tingkat kabupaten', 'text' => 'Santri kelas IX meraih juara pertama dan melaju ke tingkat provinsi.'],
            ['image' => 'demo/pesantren-putri.jpg', 'category' => 'Kegiatan', 'date' => '15 Okt 2026', 'title' => 'Pekan bahasa Arab dan Inggris santriwati', 'text' => 'Lomba pidato, drama, dan debat dua bahasa selama satu pekan.'],
        ];

        $psb = ['type' => 'cta', 'data' => ['title' => 'Penerimaan Santri Baru telah dibuka', 'text' => 'Kuota terbatas untuk santri putra dan putri. Daftar sekarang dan jadwalkan kunjungan ke pondok.', 'button_label' => 'Daftar Sekarang', 'button_url' => '/pendaftaran']];

        return [
            ['title' => 'Beranda', 'slug' => 'beranda', 'is_home' => true, 'sections' => [
                ['type' => 'hero', 'data' => [
                    'eyebrow' => 'Pondok Pesantren Putra & Putri',
                    'title' => 'Mencetak generasi *Qur\'ani* yang berilmu dan berakhlak',
                    'subtitle' => "{$company} membina santri dengan pendidikan Al-Qur'an, kitab kuning, dan madrasah formal dalam lingkungan yang aman dan penuh keteladanan.",
                    'button_label' => 'Pendaftaran Santri', 'button_url' => '/pendaftaran',
                    'button2_label' => 'Profil Pondok', 'button2_url' => '/profil',
                    'image' => 'demo/pesantren-hero.jpg',
                ]],
                ['type' => 'stats', 'data' => ['items' => [
                    ['value' => '1.200+', 'label' => 'Santri aktif'],
                    ['value' => '85', 'label' => 'Ustadz & ustadzah'],
                    ['value' => '350+', 'label' => 'Hafidz 30 juz'],
                    ['value' => '1985', 'label' => 'Tahun berdiri'],
                ]]],
                $programs,
                ['type' => 'image_text', 'data' => ['title' => 'Sambutan Pengasuh', 'body' => "Assalamu'alaikum warahmatullahi wabarakatuh.\n\nPondok kami hadir untuk mendampingi putra-putri Anda menuntut ilmu agama dan ilmu umum dengan seimbang. Kami percaya adab adalah pondasi ilmu, karena itu keteladanan menjadi bagian dari keseharian santri.\n\n**KH. Ahmad Fauzi, Lc.** – Pengasuh Pondok", 'image' => 'demo/pesantren-masjid.jpg', 'image_position' => 'left', 'button_label' => 'Profil Pondok', 'button_url' => '/profil']],
                ['type' => 'posts', 'data' => ['title' => 'Kabar Pondok', 'subtitle' => 'Kegiatan dan prestasi santri terbaru.', 'items' => $news]],
                $psb,
            ]],
            ['title' => 'Profil', 'slug' => 'profil', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Profil Pondok', 'subtitle' => 'Sejarah, visi, dan misi pondok pesantren.', 'image' => 'demo/pesantren-hero.jpg']],
                ['type' => 'image_text', 'data' => ['title' => 'Sejarah singkat', 'body' => "{$company} berdiri sejak 1985 dari sebuah majelis taklim kecil di desa. Kini pondok membina lebih dari seribu santri dari berbagai daerah di Indonesia.\n\n**Visi:** Menjadi pesantren yang melahirkan generasi berilmu, berakhlak mulia, dan bermanfaat bagi umat.\n\n**Misi:**\n- Menyelenggarakan pendidikan Al-Qur'an dan kitab salaf\n- Mengintegrasikan pendidikan agama dan umum\n- Membiasakan ibadah dan adab dalam keseharian", 'image' => 'demo/pesantren-masjid.jpg', 'image_position' => 'right']],
                ['type' => 'gallery', 'data' => ['title' => 'Kehidupan santri', 'items' => [
                    ['image' => 'demo/pesantren-ngaji.jpg', 'caption' => 'Mengaji bersama di masjid'],
                    ['image' => 'demo/pesantren-quran.jpg', 'caption' => 'Setoran hafalan'],
                    ['image' => 'demo/pesantren-santriwati.jpg', 'caption' => 'Belajar kelompok santriwati'],
                    ['image' => 'demo/pesantren-santri.jpg', 'caption' => 'Kebersamaan santri putra'],
                    ['image' => 'demo/pesantren-putri.jpg', 'caption' => 'Santriwati di asrama'],
                    ['image' => 'demo/pesantren-mushaf.jpg', 'caption' => 'Kajian kitab'],
                ]]],
            ]],
            ['title' => 'Program', 'slug' => 'program', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Program Pendidikan', 'subtitle' => 'Kurikulum pesantren dan madrasah formal dalam satu lingkungan.']],
                $programs,
                ['type' => 'steps', 'data' => ['title' => 'Kegiatan harian santri', 'items' => [
                    ['title' => '03.30 – Qiyamul lail & Subuh', 'text' => 'Shalat malam, Subuh berjamaah, dan setoran hafalan.'],
                    ['title' => '07.00 – Madrasah formal', 'text' => 'Kegiatan belajar sesuai kurikulum MTs dan MA.'],
                    ['title' => '15.30 – Kajian kitab', 'text' => 'Kajian kitab kuning setelah Ashar.'],
                    ['title' => '19.30 – Belajar malam', 'text' => 'Muraja\'ah hafalan dan belajar bersama musyrif.'],
                ]]],
                ['type' => 'posts', 'data' => ['title' => 'Kabar Pondok', 'items' => $news]],
            ]],
            ['title' => 'Pendaftaran', 'slug' => 'pendaftaran', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Penerimaan Santri Baru', 'subtitle' => 'Tahun ajaran 2027/2028 untuk jenjang MTs dan MA, putra dan putri.']],
                ['type' => 'plans', 'data' => ['title' => 'Biaya pendidikan', 'subtitle' => 'Sudah termasuk asrama, makan 3x sehari, dan seragam.', 'items' => [
                    ['name' => 'Reguler', 'badge' => '', 'price' => 'Rp1,5jt', 'old_price' => '', 'info' => 'per bulan', 'features' => "Asrama & makan\nMadrasah formal\nKajian kitab\nEkstrakurikuler", 'highlight' => 'no'],
                    ['name' => 'Tahfidz', 'badge' => 'Favorit', 'price' => 'Rp1,8jt', 'old_price' => '', 'info' => 'per bulan', 'features' => "Semua program reguler\nKelas tahfidz intensif\nMusyrif hafalan pribadi\nTarget 30 juz", 'highlight' => 'yes'],
                ], 'note' => 'Biaya pendaftaran dan uang pangkal disampaikan saat pendaftaran.']],
                ['type' => 'steps', 'data' => ['title' => 'Alur pendaftaran', 'items' => [
                    ['title' => 'Isi formulir', 'text' => 'Daftar lewat formulir di halaman ini atau WhatsApp panitia.'],
                    ['title' => 'Tes masuk', 'text' => 'Tes baca Al-Qur\'an, wawancara santri dan wali.'],
                    ['title' => 'Pengumuman', 'text' => 'Hasil diumumkan paling lambat satu minggu setelah tes.'],
                    ['title' => 'Daftar ulang', 'text' => 'Melengkapi berkas dan biaya, santri siap masuk pondok.'],
                ]]],
                ['type' => 'faq', 'data' => ['title' => 'Pertanyaan wali santri', 'items' => [
                    ['question' => 'Kapan santri boleh dijenguk?', 'answer' => 'Kunjungan wali setiap hari Ahad pekan kedua dan keempat, pukul 08.00–15.00.'],
                    ['question' => 'Apakah santri boleh membawa HP?', 'answer' => 'Tidak. Santri bisa menelepon keluarga melalui wartel pondok pada jadwal yang ditentukan.'],
                    ['question' => 'Apakah ada beasiswa?', 'answer' => 'Ada beasiswa untuk santri yatim, dhuafa, dan berprestasi. Hubungi panitia untuk syaratnya.'],
                ]]],
                ['type' => 'contact', 'data' => ['title' => 'Formulir minat pendaftaran', 'text' => 'Tinggalkan nama dan nomor WhatsApp, panitia akan menghubungi Anda.', 'show_form' => 'yes']],
            ]],
            ['title' => 'Kontak', 'slug' => 'kontak', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Hubungi Kami', 'subtitle' => 'Kantor sekretariat buka Sabtu–Kamis, 08.00–15.00.']],
                ['type' => 'contact', 'data' => ['title' => 'Kirim pesan', 'text' => 'Pertanyaan seputar pendaftaran, kunjungan, atau kerja sama.', 'show_form' => 'yes']],
            ]],
        ];
    }
}
