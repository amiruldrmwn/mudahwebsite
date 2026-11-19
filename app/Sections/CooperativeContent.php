<?php

namespace App\Sections;

/**
 * Sample pages for the Koperasi & BUMDes template: business units, savings and loans,
 * membership, the annual members' meeting (RAT) report and management.
 */
class CooperativeContent
{
    /**
     * @return list<array<string, mixed>>
     */
    public static function pages(string $company): array
    {
        $units = ['type' => 'services', 'data' => ['title' => 'Unit usaha', 'subtitle' => 'Dikelola bersama untuk kesejahteraan anggota dan warga.', 'items' => [
            ['title' => 'Simpan pinjam', 'text' => 'Tabungan anggota dan pinjaman modal usaha dengan jasa ringan.', 'image' => 'demo/koperasi-meja.jpg'],
            ['title' => 'Toko & sembako', 'text' => 'Kebutuhan pokok harga anggota, bisa bayar akhir bulan.', 'image' => 'demo/koperasi-warung.jpg'],
            ['title' => 'Pemasaran hasil tani', 'text' => 'Menampung dan menjual hasil panen anggota ke pasar dan mitra.', 'image' => 'demo/koperasi-sayur.jpg'],
        ]]];

        $report = ['type' => 'stats', 'data' => ['title' => 'Laporan RAT tahun buku 2025', 'items' => [
            ['value' => '1.248', 'label' => 'Anggota aktif'],
            ['value' => 'Rp6,2 M', 'label' => 'Total aset'],
            ['value' => 'Rp3,8 M', 'label' => 'Pinjaman tersalur'],
            ['value' => 'Rp412 jt', 'label' => 'SHU dibagikan'],
        ]]];

        return [
            ['title' => 'Beranda', 'slug' => 'beranda', 'is_home' => true, 'sections' => [
                ['type' => 'hero', 'data' => [
                    'eyebrow' => 'Koperasi & BUMDes',
                    'title' => 'Dari anggota, oleh anggota, *untuk kesejahteraan bersama*',
                    'subtitle' => "{$company} melayani simpan pinjam, toko kebutuhan pokok, dan pemasaran hasil usaha warga secara terbuka dan amanah.",
                    'button_label' => 'Jadi Anggota', 'button_url' => '/keanggotaan',
                    'button2_label' => 'Laporan RAT', 'button2_url' => '/laporan',
                    'image' => 'demo/koperasi-hero.jpg',
                ]],
                $report,
                $units,
                ['type' => 'pricelist', 'data' => ['title' => 'Simpanan & pinjaman', 'subtitle' => 'Ketentuan lengkap sesuai AD/ART koperasi.', 'items' => [
                    ['name' => 'Simpanan pokok', 'description' => 'Dibayar sekali saat mendaftar', 'info' => 'sekali', 'price' => 'Rp100.000'],
                    ['name' => 'Simpanan wajib', 'description' => 'Dibayar setiap bulan', 'info' => 'per bulan', 'price' => 'Rp20.000'],
                    ['name' => 'Simpanan sukarela', 'description' => 'Bisa disetor dan diambil kapan saja', 'info' => 'bebas', 'price' => 'jasa 4%/thn'],
                    ['name' => 'Pinjaman modal usaha', 'description' => 'Tenor 6–36 bulan', 'info' => 'per bulan', 'price' => 'jasa 1%'],
                ], 'order_button' => 'no']],
                ['type' => 'image_text', 'data' => ['title' => 'Rapat Anggota Tahunan', 'body' => "Setiap tahun pengurus mempertanggungjawabkan kinerja dan keuangan koperasi di hadapan anggota. SHU dibagikan sesuai jasa simpanan dan jasa usaha.\n\nRAT tahun buku 2025 dilaksanakan pada 15 Maret 2026 dan dihadiri 870 anggota.", 'image' => 'demo/koperasi-rapat.jpg', 'image_position' => 'left', 'button_label' => 'Lihat Laporan', 'button_url' => '/laporan']],
                ['type' => 'cta', 'data' => ['title' => 'Bergabung jadi anggota', 'text' => 'Cukup KTP dan simpanan pokok. Nikmati harga anggota dan bagian SHU setiap tahun.', 'button_label' => 'Daftar Anggota', 'button_url' => '/keanggotaan']],
            ]],
            ['title' => 'Unit Usaha', 'slug' => 'usaha', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Unit Usaha', 'subtitle' => 'Usaha yang dikelola koperasi untuk anggota dan warga.', 'image' => 'demo/koperasi-pasar.jpg']],
                $units,
                ['type' => 'gallery', 'data' => ['title' => 'Kegiatan', 'items' => [
                    ['image' => 'demo/koperasi-pasar.jpg', 'caption' => 'Pemasaran hasil anggota di pasar'],
                    ['image' => 'demo/koperasi-warung.jpg', 'caption' => 'Toko koperasi'],
                    ['image' => 'demo/koperasi-sayur.jpg', 'caption' => 'Hasil tani anggota'],
                    ['image' => 'demo/koperasi-rapat.jpg', 'caption' => 'Pelatihan anggota'],
                ]]],
            ]],
            ['title' => 'Laporan', 'slug' => 'laporan', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Laporan & Transparansi', 'subtitle' => 'Ringkasan laporan keuangan yang disahkan RAT.']],
                $report,
                ['type' => 'team', 'data' => ['title' => 'Pengurus & pengawas', 'items' => [
                    ['photo' => '', 'name' => 'H. Darmaji', 'role' => 'Ketua'],
                    ['photo' => '', 'name' => 'Sri Wahyuni', 'role' => 'Sekretaris'],
                    ['photo' => '', 'name' => 'Bambang Irawan', 'role' => 'Bendahara'],
                    ['photo' => '', 'name' => 'Ir. Suharto', 'role' => 'Ketua pengawas'],
                ]]],
            ]],
            ['title' => 'Keanggotaan', 'slug' => 'keanggotaan', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Jadi Anggota', 'subtitle' => 'Syarat mudah, manfaat untuk seluruh keluarga.']],
                ['type' => 'steps', 'data' => ['title' => 'Cara mendaftar', 'items' => [
                    ['title' => 'Isi formulir', 'text' => 'Lewat website atau datang ke kantor.'],
                    ['title' => 'Bawa KTP & KK', 'text' => 'Untuk verifikasi data anggota.'],
                    ['title' => 'Setor simpanan pokok', 'text' => 'Rp100.000, sekali saja.'],
                    ['title' => 'Terima kartu anggota', 'text' => 'Langsung bisa memakai semua layanan.'],
                ]]],
                ['type' => 'contact', 'data' => ['title' => 'Formulir pendaftaran', 'text' => 'Tulis nama, alamat, dan nomor WhatsApp. Pengurus akan menghubungi Anda.', 'show_form' => 'yes']],
            ]],
        ];
    }
}
