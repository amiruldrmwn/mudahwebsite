<?php

namespace App\Sections;

/**
 * Sample pages for the Masjid & Yayasan template: prayer and study schedule, the mosque's
 * programmes, an open infaq report, donation channels and news.
 */
class MosqueContent
{
    /**
     * @return list<array<string, mixed>>
     */
    public static function pages(string $company): array
    {
        $programs = ['type' => 'services', 'data' => ['title' => 'Program masjid', 'subtitle' => 'Memakmurkan masjid dan melayani jamaah.', 'items' => [
            ['title' => 'Kajian rutin', 'text' => 'Kajian tafsir, fiqih, dan sirah setiap pekan, terbuka untuk umum.', 'image' => 'demo/masjid-interior.jpg'],
            ['title' => 'TPQ & tahsin', 'text' => 'Belajar mengaji untuk anak dan kelas tahsin untuk dewasa.', 'image' => 'demo/pesantren-quran.jpg'],
            ['title' => 'Sosial & santunan', 'text' => 'Santunan yatim dan dhuafa, ambulans gratis, dan bantuan bencana.', 'image' => 'demo/masjid-library.jpg'],
        ]]];

        $schedule = ['type' => 'steps', 'data' => ['title' => 'Jadwal kajian pekan ini', 'subtitle' => 'Ba\'da Maghrib di ruang utama masjid.', 'items' => [
            ['title' => 'Senin – Tafsir Al-Qur\'an', 'text' => 'Ust. Abdullah Hakim, Lc.'],
            ['title' => 'Rabu – Fiqih ibadah', 'text' => 'Ust. Muhammad Ridwan'],
            ['title' => 'Jumat – Sirah Nabawiyah', 'text' => 'Ust. Hasan Basri, M.A.'],
            ['title' => 'Ahad pagi – Kajian keluarga', 'text' => 'Ba\'da Subuh, Ustadzah Aisyah'],
        ]]];

        $donate = ['type' => 'plans', 'data' => ['title' => 'Salurkan donasi Anda', 'subtitle' => 'Setiap rupiah dicatat dan dilaporkan kepada jamaah setiap bulan.', 'items' => [
            ['name' => 'Infaq operasional', 'badge' => '', 'price' => 'Seikhlasnya', 'old_price' => '', 'info' => 'listrik, kebersihan, imam', 'features' => "BSI 711 222 3334\na.n. {$company}", 'highlight' => 'no'],
            ['name' => 'Wakaf pembangunan', 'badge' => 'Mendesak', 'price' => 'Rp100rb', 'old_price' => '', 'info' => 'per meter persegi', 'features' => "Perluasan lantai 2\nTerkumpul 64% dari target\nBSI 711 222 3335", 'highlight' => 'yes'],
            ['name' => 'Zakat & santunan', 'badge' => '', 'price' => 'Sesuai nisab', 'old_price' => '', 'info' => 'disalurkan tiap bulan', 'features' => "Yatim & dhuafa sekitar masjid\nKonfirmasi via WhatsApp\nBSI 711 222 3336", 'highlight' => 'no'],
        ], 'note' => 'Konfirmasi donasi lewat WhatsApp agar tercatat dalam laporan bulanan.']];

        $news = [
            ['image' => 'demo/masjid-light.jpg', 'category' => 'Kegiatan', 'date' => '10 Nov 2026', 'title' => 'Santunan 120 anak yatim dan dhuafa', 'text' => 'Bersama jamaah dan donatur, santunan disalurkan dalam acara Tabligh Akbar.'],
            ['image' => 'demo/masjid-hall.jpg', 'category' => 'Laporan', 'date' => '1 Nov 2026', 'title' => 'Laporan keuangan masjid bulan Oktober', 'text' => 'Pemasukan Rp86,4 juta, pengeluaran Rp51,2 juta. Rincian lengkap di papan informasi.'],
            ['image' => 'demo/pesantren-ngaji.jpg', 'category' => 'TPQ', 'date' => '20 Okt 2026', 'title' => 'Wisuda santri TPQ angkatan ke-12', 'text' => '38 santri menyelesaikan jilid Iqra\' dan mulai membaca Al-Qur\'an.'],
        ];

        return [
            ['title' => 'Beranda', 'slug' => 'beranda', 'is_home' => true, 'sections' => [
                ['type' => 'hero', 'data' => [
                    'eyebrow' => 'Masjid & Yayasan',
                    'title' => 'Rumah Allah yang *makmur* bersama jamaah',
                    'subtitle' => "{$company} membuka pintu untuk shalat, kajian, pendidikan Al-Qur'an, dan kepedulian sosial bagi warga sekitar.",
                    'button_label' => 'Donasi Sekarang', 'button_url' => '/donasi',
                    'button2_label' => 'Jadwal Kajian', 'button2_url' => '/kegiatan',
                    'image' => 'demo/masjid-hero.jpg',
                ]],
                ['type' => 'stats', 'data' => ['title' => 'Laporan infaq bulan ini', 'items' => [
                    ['value' => 'Rp86,4jt', 'label' => 'Pemasukan'],
                    ['value' => 'Rp51,2jt', 'label' => 'Pengeluaran'],
                    ['value' => '1.500', 'label' => 'Jamaah Jumat'],
                    ['value' => '64%', 'label' => 'Wakaf lantai 2'],
                ]]],
                $programs,
                $schedule,
                $donate,
                ['type' => 'posts', 'data' => ['title' => 'Kabar masjid', 'items' => $news]],
            ]],
            ['title' => 'Profil', 'slug' => 'profil', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Profil Masjid', 'subtitle' => 'Sejarah, pengurus, dan fasilitas.', 'image' => 'demo/masjid-dome.jpg']],
                ['type' => 'image_text', 'data' => ['title' => 'Sejarah singkat', 'body' => "Masjid berdiri tahun 1992 di atas tanah wakaf warga. Kini dikelola {$company} dan menampung lebih dari 1.500 jamaah.\n\n**Fasilitas:** ruang shalat ber-AC, tempat wudhu terpisah, perpustakaan, ruang TPQ, parkir luas, dan ambulans.", 'image' => 'demo/masjid-library.jpg', 'image_position' => 'right']],
                ['type' => 'team', 'data' => ['title' => 'Pengurus (DKM)', 'items' => [
                    ['photo' => '', 'name' => 'H. Ahmad Syarif', 'role' => 'Ketua DKM'],
                    ['photo' => '', 'name' => 'Ust. Abdullah Hakim, Lc.', 'role' => 'Imam besar'],
                    ['photo' => '', 'name' => 'Ir. Bambang Setiawan', 'role' => 'Bendahara'],
                    ['photo' => '', 'name' => 'Rizal Fahmi', 'role' => 'Sekretaris'],
                ]]],
            ]],
            ['title' => 'Kegiatan', 'slug' => 'kegiatan', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Kegiatan & Kajian', 'subtitle' => 'Semua kegiatan terbuka untuk umum dan gratis.']],
                $schedule,
                $programs,
                ['type' => 'gallery', 'data' => ['title' => 'Dokumentasi', 'items' => [
                    ['image' => 'demo/masjid-interior.jpg', 'caption' => 'Shalat berjamaah'],
                    ['image' => 'demo/masjid-light.jpg', 'caption' => 'Ruang utama'],
                    ['image' => 'demo/pesantren-ngaji.jpg', 'caption' => 'TPQ anak'],
                    ['image' => 'demo/masjid-hall.jpg', 'caption' => 'Kajian malam'],
                ]]],
            ]],
            ['title' => 'Donasi', 'slug' => 'donasi', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Donasi & Wakaf', 'subtitle' => 'Amanah, transparan, dan dilaporkan setiap bulan.']],
                $donate,
                ['type' => 'faq', 'data' => ['title' => 'Pertanyaan donatur', 'items' => [
                    ['question' => 'Bagaimana saya tahu donasi sudah diterima?', 'answer' => 'Kirim bukti transfer lewat WhatsApp, kami balas dengan konfirmasi dan doa.'],
                    ['question' => 'Apakah ada laporan keuangan?', 'answer' => 'Ada, setiap awal bulan di halaman Kabar dan papan informasi masjid.'],
                    ['question' => 'Bisa titip zakat fitrah?', 'answer' => 'Bisa, panitia zakat buka mulai 15 Ramadhan di serambi masjid.'],
                ]]],
            ]],
            ['title' => 'Kontak', 'slug' => 'kontak', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Hubungi Pengurus', 'subtitle' => 'Sekretariat buka setiap hari ba\'da Ashar.']],
                ['type' => 'contact', 'data' => ['title' => 'Kirim pesan', 'text' => 'Untuk peminjaman masjid, akad nikah, konfirmasi donasi, atau ambulans.', 'show_form' => 'yes']],
            ]],
        ];
    }
}
