<?php

namespace App\Sections;

/**
 * Sample pages for the Law Firm template: practice areas, the partners and associates, how a
 * case is handled, trust figures and a first consultation.
 */
class LawFirmContent
{
    /**
     * @return list<array<string, mixed>>
     */
    public static function pages(string $company): array
    {
        $areas = ['type' => 'services', 'data' => ['title' => 'Bidang praktik', 'subtitle' => 'Pendampingan hukum untuk perusahaan dan perorangan, di dalam maupun di luar pengadilan.', 'items' => [
            ['title' => 'Hukum Korporasi', 'text' => 'Pendirian badan usaha, perjanjian pemegang saham, merger, dan uji tuntas hukum.'],
            ['title' => 'Litigasi & Arbitrase', 'text' => 'Mewakili klien dalam perkara perdata, niaga, dan arbitrase nasional maupun internasional.'],
            ['title' => 'Hukum Ketenagakerjaan', 'text' => 'Peraturan perusahaan, PHK, dan penyelesaian perselisihan hubungan industrial.'],
            ['title' => 'Properti & Pertanahan', 'text' => 'Due diligence tanah, jual beli properti, dan sengketa pertanahan.'],
            ['title' => 'Hukum Keluarga', 'text' => 'Perceraian, hak asuh anak, harta bersama, dan waris.'],
            ['title' => 'Hak Kekayaan Intelektual', 'text' => 'Pendaftaran dan perlindungan merek, hak cipta, dan paten.'],
        ]]];

        $team = ['type' => 'team', 'data' => ['title' => 'Tim advokat', 'subtitle' => 'Advokat berlisensi PERADI dengan pengalaman di berbagai bidang hukum.', 'items' => [
            ['photo' => 'demo/team-1.jpg', 'name' => 'Dr. Andi Pratama, S.H., M.H.', 'role' => 'Managing Partner'],
            ['photo' => 'demo/team-4.jpg', 'name' => 'Ratna Wulandari, S.H., LL.M.', 'role' => 'Senior Partner, Korporasi'],
            ['photo' => 'demo/team-3.jpg', 'name' => 'Budi Santoso, S.H.', 'role' => 'Partner, Litigasi'],
            ['photo' => 'demo/team-2.jpg', 'name' => 'Maya Kartika, S.H., M.Kn.', 'role' => 'Associate, Properti'],
        ]]];

        $steps = ['type' => 'steps', 'data' => ['title' => 'Cara kami menangani perkara', 'subtitle' => 'Transparan sejak konsultasi pertama.', 'items' => [
            ['title' => 'Konsultasi awal', 'text' => 'Ceritakan masalah Anda. Kami pelajari dokumen dan posisi hukumnya.'],
            ['title' => 'Strategi & biaya', 'text' => 'Kami jelaskan pilihan langkah, risikonya, dan estimasi biaya secara tertulis.'],
            ['title' => 'Pendampingan', 'text' => 'Advokat kami mewakili Anda dalam negosiasi, mediasi, atau persidangan.'],
            ['title' => 'Laporan berkala', 'text' => 'Anda selalu tahu perkembangan perkara di setiap tahap.'],
        ]]];

        return [
            ['title' => 'Beranda', 'slug' => 'beranda', 'is_home' => true, 'sections' => [
                ['type' => 'hero', 'data' => [
                    'eyebrow' => 'Advokat & Konsultan Hukum',
                    'title' => 'Kepastian hukum untuk *bisnis* dan keluarga Anda',
                    'subtitle' => "{$company} mendampingi perusahaan dan perorangan dengan nasihat hukum yang jelas, strategi yang terukur, dan integritas di setiap perkara.",
                    'button_label' => 'Jadwalkan Konsultasi', 'button_url' => '/kontak',
                    'button2_label' => 'Bidang Praktik', 'button2_url' => '/bidang-praktik',
                    'image' => 'demo/legal-signing.jpg',
                ]],
                ['type' => 'stats', 'data' => ['items' => [
                    ['value' => '18+', 'label' => 'Tahun berpengalaman'],
                    ['value' => '650+', 'label' => 'Perkara ditangani'],
                    ['value' => '120+', 'label' => 'Klien korporasi'],
                    ['value' => '12', 'label' => 'Advokat berlisensi'],
                ]]],
                $areas,
                ['type' => 'image_text', 'data' => ['title' => 'Nasihat hukum yang bisa Anda pahami', 'body' => "Kami percaya klien berhak memahami setiap langkah hukum yang diambil atas namanya. Karena itu kami menjelaskan pilihan, risiko, dan biaya dengan bahasa yang lugas.\n\n- Advokat berlisensi PERADI\n- Biaya disepakati tertulis di awal\n- Kerahasiaan klien terjaga", 'image' => 'demo/legal-hero.jpg', 'image_position' => 'left', 'button_label' => 'Tentang Kami', 'button_url' => '/tentang']],
                $team,
                ['type' => 'testimonials', 'data' => ['title' => 'Kata klien', 'items' => [
                    ['quote' => 'Sengketa kontrak kami selesai lewat mediasi tanpa harus ke pengadilan. Prosesnya dijelaskan dengan sangat jelas.', 'name' => 'Hendra W.', 'role' => 'Direktur, perusahaan distribusi'],
                    ['quote' => 'Pendampingan due diligence saat akuisisi sangat teliti dan tepat waktu.', 'name' => 'Lestari P.', 'role' => 'CFO, perusahaan teknologi'],
                    ['quote' => 'Urusan waris keluarga kami yang rumit akhirnya tuntas dengan baik.', 'name' => 'Bapak Surya', 'role' => 'Klien perorangan'],
                ]]],
                ['type' => 'cta', 'data' => ['title' => 'Butuh nasihat hukum?', 'text' => 'Jadwalkan konsultasi awal dengan advokat kami. Kerahasiaan Anda terjaga.', 'button_label' => 'Jadwalkan Konsultasi', 'button_url' => '/kontak']],
            ]],
            ['title' => 'Bidang Praktik', 'slug' => 'bidang-praktik', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Bidang Praktik', 'subtitle' => 'Layanan hukum menyeluruh untuk kebutuhan bisnis dan pribadi.', 'image' => 'demo/office.jpg']],
                $areas,
                $steps,
                ['type' => 'faq', 'data' => ['title' => 'Pertanyaan umum', 'items' => [
                    ['question' => 'Berapa biaya konsultasi awal?', 'answer' => 'Konsultasi awal 30 menit tidak dikenakan biaya. Biaya penanganan perkara kami sampaikan tertulis setelah memahami kasus Anda.'],
                    ['question' => 'Apakah konsultasi bisa dilakukan online?', 'answer' => 'Bisa, lewat panggilan video atau di kantor kami, sesuai pilihan Anda.'],
                    ['question' => 'Apakah informasi saya dirahasiakan?', 'answer' => 'Ya. Semua informasi klien dilindungi kewajiban kerahasiaan advokat.'],
                ]]],
            ]],
            ['title' => 'Tim Advokat', 'slug' => 'tim', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Tim Advokat', 'subtitle' => 'Berpengalaman, berlisensi, dan berdedikasi pada kepentingan klien.']],
                $team,
                ['type' => 'clients', 'data' => ['title' => 'Dipercaya oleh', 'items' => [
                    ['name' => 'Bumi Karya', 'logo' => 'demo/client-bumi-karya.svg'],
                    ['name' => 'Cahaya Logistik', 'logo' => 'demo/client-cahaya-logistik.svg'],
                    ['name' => 'Mitra Sejahtera', 'logo' => 'demo/client-mitra-sejahtera.svg'],
                    ['name' => 'Nusantara Jaya', 'logo' => 'demo/client-nusantara-jaya.svg'],
                    ['name' => 'Sinar Abadi', 'logo' => 'demo/client-sinar-abadi.svg'],
                    ['name' => 'Wijaya Group', 'logo' => 'demo/client-wijaya-group.svg'],
                ]]],
            ]],
            ['title' => 'Tentang', 'slug' => 'tentang', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Tentang Kami', 'subtitle' => 'Firma hukum dengan prinsip integritas, ketelitian, dan keterbukaan.']],
                ['type' => 'image_text', 'data' => ['title' => 'Berdiri untuk kepentingan klien', 'body' => "{$company} didirikan oleh para advokat yang berpengalaman di firma hukum nasional. Kami melayani perusahaan dari berbagai industri dan klien perorangan.\n\nSetiap perkara ditangani oleh partner bersama tim yang memahami bidangnya, agar Anda mendapat nasihat yang tepat dan tuntas.", 'image' => 'demo/lobby.jpg', 'image_position' => 'right']],
                $steps,
            ]],
            ['title' => 'Kontak', 'slug' => 'kontak', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Hubungi Kami', 'subtitle' => 'Senin–Jumat 08.30–17.30. Konsultasi di luar jam kerja dengan perjanjian.']],
                ['type' => 'contact', 'data' => ['title' => 'Jadwalkan konsultasi', 'text' => 'Ceritakan singkat masalah hukum Anda. Kami menghubungi Anda dalam 1 hari kerja.', 'show_form' => 'yes']],
            ]],
        ];
    }
}
