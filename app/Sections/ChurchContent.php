<?php

namespace App\Sections;

/**
 * Sample pages for the Gereja template: service schedule, weekly bulletin, ministries, offerings
 * and the church's leaders.
 */
class ChurchContent
{
    /**
     * @return list<array<string, mixed>>
     */
    public static function pages(string $company): array
    {
        $schedule = ['type' => 'pricelist', 'data' => ['title' => 'Jadwal ibadah', 'subtitle' => 'Semua jemaat dan tamu disambut dengan hangat.', 'items' => [
            ['name' => 'Ibadah Minggu I', 'description' => 'Liturgi umum', 'info' => 'Minggu', 'price' => '07.00'],
            ['name' => 'Ibadah Minggu II', 'description' => 'Ibadah keluarga & Sekolah Minggu', 'info' => 'Minggu', 'price' => '09.30'],
            ['name' => 'Ibadah Pemuda', 'description' => 'Pujian kontemporer', 'info' => 'Minggu', 'price' => '17.00'],
            ['name' => 'Persekutuan Doa', 'description' => 'Doa bersama dan pendalaman Alkitab', 'info' => 'Rabu', 'price' => '19.00'],
        ], 'order_button' => 'no']];

        $ministries = ['type' => 'services', 'data' => ['title' => 'Pelayanan & komisi', 'items' => [
            ['title' => 'Sekolah Minggu', 'text' => 'Mengajar anak-anak mengenal kasih Tuhan lewat cerita dan lagu.', 'image' => 'demo/gereja-altar.jpg'],
            ['title' => 'Pemuda & Remaja', 'text' => 'Ibadah, retret, dan kegiatan sosial untuk generasi muda.', 'image' => 'demo/gereja-pujian.jpg'],
            ['title' => 'Diakonia', 'text' => 'Kunjungan jemaat sakit, bantuan sosial, dan pelayanan kasih.', 'image' => 'demo/gereja-doa.jpg'],
        ]]];

        return [
            ['title' => 'Beranda', 'slug' => 'beranda', 'is_home' => true, 'sections' => [
                ['type' => 'hero', 'data' => [
                    'eyebrow' => 'Selamat datang',
                    'title' => 'Bertumbuh bersama dalam *iman, pengharapan, dan kasih*',
                    'subtitle' => "{$company} adalah keluarga jemaat yang terbuka bagi siapa saja. Mari beribadah dan melayani bersama.",
                    'button_label' => 'Jadwal Ibadah', 'button_url' => '/ibadah',
                    'button2_label' => 'Persembahan', 'button2_url' => '/persembahan',
                    'image' => 'demo/gereja-hero.jpg',
                ]],
                $schedule,
                ['type' => 'image_text', 'data' => ['title' => 'Ayat minggu ini', 'body' => "> \"Kasih itu sabar; kasih itu murah hati; ia tidak cemburu. Ia tidak memegahkan diri dan tidak sombong.\"\n>\n> **1 Korintus 13:4**\n\nTema khotbah Minggu ini: *Hidup dalam kasih yang nyata*.", 'image' => 'demo/gereja-kaca.jpg', 'image_position' => 'right']],
                $ministries,
                ['type' => 'posts', 'data' => ['title' => 'Warta jemaat', 'items' => [
                    ['image' => 'demo/gereja-interior.jpg', 'category' => 'Pengumuman', 'date' => '16 Nov 2026', 'title' => 'Persiapan Natal: pendaftaran paduan suara dibuka', 'text' => 'Latihan setiap Sabtu pukul 16.00 di gedung serbaguna.'],
                    ['image' => 'demo/gereja-doa.jpg', 'category' => 'Diakonia', 'date' => '10 Nov 2026', 'title' => 'Bakti sosial dan pengobatan gratis', 'text' => 'Melayani 250 warga sekitar gereja bersama tim medis jemaat.'],
                    ['image' => 'demo/gereja-pujian.jpg', 'category' => 'Pemuda', 'date' => '2 Nov 2026', 'title' => 'Retret pemuda 2026', 'text' => 'Tiga hari bersekutu dan bertumbuh di Puncak.'],
                ]]],
                ['type' => 'cta', 'data' => ['title' => 'Baru pertama kali datang?', 'text' => 'Kami senang menyambut Anda. Hubungi kami untuk informasi ibadah dan komunitas.', 'button_label' => 'Hubungi Kami', 'button_url' => '/kontak']],
            ]],
            ['title' => 'Ibadah', 'slug' => 'ibadah', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Ibadah & Pelayanan', 'subtitle' => 'Jadwal ibadah dan komisi pelayanan.', 'image' => 'demo/gereja-interior.jpg']],
                $schedule,
                $ministries,
            ]],
            ['title' => 'Tentang', 'slug' => 'tentang', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Tentang Gereja', 'subtitle' => 'Sejarah, visi, dan para pelayan.']],
                ['type' => 'text', 'data' => ['title' => 'Sejarah singkat', 'body' => "Gereja ini berawal dari persekutuan doa beberapa keluarga pada tahun 1978. Kini jemaat berkembang menjadi lebih dari 600 kepala keluarga.\n\n**Visi:** Menjadi gereja yang bertumbuh, bersaksi, dan menjadi berkat bagi sesama."]],
                ['type' => 'team', 'data' => ['title' => 'Majelis & pelayan', 'items' => [
                    ['photo' => '', 'name' => 'Pdt. Yohanes Simanjuntak', 'role' => 'Gembala jemaat'],
                    ['photo' => '', 'name' => 'Pnt. Maria Lumban Tobing', 'role' => 'Ketua majelis'],
                    ['photo' => '', 'name' => 'Dkn. Samuel Wenas', 'role' => 'Bendahara'],
                    ['photo' => '', 'name' => 'Ev. Grace Tanuwijaya', 'role' => 'Pembina pemuda'],
                ]]],
            ]],
            ['title' => 'Persembahan', 'slug' => 'persembahan', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Persembahan', 'subtitle' => 'Persembahan dapat diberikan saat ibadah atau melalui transfer.']],
                ['type' => 'text', 'data' => ['title' => 'Rekening gereja', 'body' => "- **Persembahan umum:** BCA 123-456-7890 a.n. Gereja\n- **Pembangunan:** Mandiri 987-654-3210 a.n. Panitia Pembangunan\n- **Diakonia:** BRI 1122-33-445566-7 a.n. Komisi Diakonia\n\nKonfirmasi persembahan lewat WhatsApp sekretariat agar tercatat di warta jemaat."]],
            ]],
            ['title' => 'Kontak', 'slug' => 'kontak', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Sekretariat', 'subtitle' => 'Senin–Jumat 09.00–16.00.']],
                ['type' => 'contact', 'data' => ['title' => 'Kirim pesan', 'text' => 'Untuk permohonan doa, kunjungan, baptisan, atau pemberkatan nikah.', 'show_form' => 'yes']],
            ]],
        ];
    }
}
