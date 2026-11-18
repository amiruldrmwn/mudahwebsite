<?php

namespace App\Sections;

/**
 * Sample pages for the Website Desa template: village profile, administration services,
 * village government, budget transparency (APBDes), potential and news.
 */
class VillageContent
{
    /**
     * @return list<array<string, mixed>>
     */
    public static function pages(string $company): array
    {
        $services = ['type' => 'services', 'data' => ['title' => 'Layanan administrasi', 'subtitle' => 'Ajukan dari rumah, ambil di kantor desa.', 'items' => [
            ['title' => 'Surat keterangan', 'text' => 'Domisili, usaha, tidak mampu, dan pengantar SKCK.', 'image' => ''],
            ['title' => 'Kependudukan', 'text' => 'Pengantar KTP, KK, akta kelahiran, dan pindah datang.', 'image' => ''],
            ['title' => 'Pengaduan warga', 'text' => 'Sampaikan saran dan keluhan, ditindaklanjuti perangkat desa.', 'image' => ''],
        ]]];

        $news = [
            ['image' => 'demo/desa-budaya.jpg', 'category' => 'Budaya', 'date' => '9 Nov 2026', 'title' => 'Festival budaya desa menarik 3.000 pengunjung', 'text' => 'Kesenian tradisional dan bazar UMKM warga digelar selama dua hari.'],
            ['image' => 'demo/desa-jalan.jpg', 'category' => 'Pembangunan', 'date' => '28 Okt 2026', 'title' => 'Pengaspalan jalan dusun II selesai', 'text' => 'Jalan sepanjang 1,2 km dibangun dari Dana Desa 2026.'],
            ['image' => 'demo/desa-sawah.jpg', 'category' => 'Pertanian', 'date' => '12 Okt 2026', 'title' => 'Panen raya padi organik kelompok tani', 'text' => 'Hasil panen naik 18% dibanding musim lalu.'],
        ];

        return [
            ['title' => 'Beranda', 'slug' => 'beranda', 'is_home' => true, 'sections' => [
                ['type' => 'hero', 'data' => [
                    'eyebrow' => 'Website resmi pemerintah desa',
                    'title' => 'Desa yang *maju*, mandiri, dan terbuka',
                    'subtitle' => "Selamat datang di {$company}. Informasi pelayanan, pembangunan, dan potensi desa untuk warga dan masyarakat luas.",
                    'button_label' => 'Layanan Warga', 'button_url' => '/layanan',
                    'button2_label' => 'Profil Desa', 'button2_url' => '/profil',
                    'image' => 'demo/desa-hero.jpg',
                ]],
                ['type' => 'stats', 'data' => ['title' => 'Data desa', 'items' => [
                    ['value' => '6.482', 'label' => 'Jiwa'],
                    ['value' => '1.904', 'label' => 'Kepala keluarga'],
                    ['value' => '4', 'label' => 'Dusun'],
                    ['value' => '512 ha', 'label' => 'Luas wilayah'],
                ]]],
                $services,
                ['type' => 'image_text', 'data' => ['title' => 'Transparansi APBDes 2026', 'body' => "- **Pendapatan:** Rp2,46 miliar\n- **Belanja pembangunan:** Rp1,12 miliar\n- **Pemberdayaan masyarakat:** Rp380 juta\n- **Bantuan langsung tunai:** Rp216 juta\n\nRincian lengkap dipasang di baliho kantor desa.", 'image' => 'demo/desa-udara.jpg', 'image_position' => 'left', 'button_label' => 'Lihat Profil', 'button_url' => '/profil']],
                ['type' => 'posts', 'data' => ['title' => 'Kabar desa', 'items' => $news]],
            ]],
            ['title' => 'Profil', 'slug' => 'profil', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Profil Desa', 'subtitle' => 'Sejarah, visi misi, dan pemerintahan desa.', 'image' => 'demo/desa-udara.jpg']],
                ['type' => 'image_text', 'data' => ['title' => 'Sejarah & visi', 'body' => "Desa berdiri sejak tahun 1912 dan dikenal sebagai lumbung padi di kecamatan.\n\n**Visi:** Terwujudnya desa yang maju, mandiri, dan sejahtera berlandaskan gotong royong.", 'image' => 'demo/desa-gunung.jpg', 'image_position' => 'right']],
                ['type' => 'team', 'data' => ['title' => 'Perangkat desa', 'items' => [
                    ['photo' => '', 'name' => 'H. Sutrisno', 'role' => 'Kepala Desa'],
                    ['photo' => '', 'name' => 'Agus Salim', 'role' => 'Sekretaris Desa'],
                    ['photo' => '', 'name' => 'Siti Aminah', 'role' => 'Kaur Keuangan'],
                    ['photo' => '', 'name' => 'Joko Prasetyo', 'role' => 'Kasi Pelayanan'],
                ]]],
            ]],
            ['title' => 'Layanan', 'slug' => 'layanan', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Layanan Warga', 'subtitle' => 'Kantor desa buka Senin–Jumat, 08.00–15.00.']],
                $services,
                ['type' => 'steps', 'data' => ['title' => 'Alur pengajuan surat', 'items' => [
                    ['title' => 'Isi formulir', 'text' => 'Lewat website atau datang ke kantor desa.'],
                    ['title' => 'Verifikasi', 'text' => 'Petugas mengecek data dan berkas.'],
                    ['title' => 'Tanda tangan', 'text' => 'Surat ditandatangani kepala desa.'],
                    ['title' => 'Ambil surat', 'text' => 'Kami kabari lewat WhatsApp saat siap.'],
                ]]],
                ['type' => 'contact', 'data' => ['title' => 'Formulir pengajuan', 'text' => 'Tulis nama, NIK, jenis surat, dan keperluan.', 'show_form' => 'yes']],
            ]],
            ['title' => 'Potensi', 'slug' => 'potensi', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Potensi Desa', 'subtitle' => 'Pertanian, wisata, dan UMKM warga.']],
                ['type' => 'services', 'data' => ['items' => [
                    ['title' => 'Pertanian padi organik', 'text' => 'Kelompok tani mengelola 300 ha sawah organik.', 'image' => 'demo/desa-sawah.jpg'],
                    ['title' => 'Wisata terasering', 'text' => 'Pemandangan sawah berundak dan gunung.', 'image' => 'demo/desa-hero.jpg'],
                    ['title' => 'Seni & budaya', 'text' => 'Kesenian tradisional yang dilestarikan pemuda desa.', 'image' => 'demo/desa-budaya.jpg'],
                ]]],
                ['type' => 'posts', 'data' => ['title' => 'Kabar desa', 'items' => $news]],
            ]],
            ['title' => 'Kontak', 'slug' => 'kontak', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Kontak Kantor Desa', 'subtitle' => 'Sampaikan pertanyaan, saran, dan pengaduan.']],
                ['type' => 'contact', 'data' => ['title' => 'Kirim pesan', 'text' => 'Pesan diteruskan ke perangkat desa yang berwenang.', 'show_form' => 'yes']],
            ]],
        ];
    }
}
