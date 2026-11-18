<?php

namespace App\Sections;

/**
 * Sample pages for the Klinik Pratama template: general and specialist services, doctor
 * schedule, BPJS info and registration.
 */
class ClinicContent
{
    /**
     * @return list<array<string, mixed>>
     */
    public static function pages(string $company): array
    {
        $services = ['type' => 'services', 'data' => ['title' => 'Layanan kesehatan', 'subtitle' => 'Melayani pasien umum dan BPJS Kesehatan.', 'items' => [
            ['title' => 'Poli umum', 'text' => 'Pemeriksaan, pengobatan, dan surat keterangan sehat.', 'image' => 'demo/klinik-hero.jpg'],
            ['title' => 'Poli anak & KIA', 'text' => 'Imunisasi, tumbuh kembang, dan pemeriksaan kehamilan.', 'image' => 'demo/klinik-child.jpg'],
            ['title' => 'Cek kesehatan', 'text' => 'Tensi, gula darah, kolesterol, dan medical check-up karyawan.', 'image' => 'demo/klinik-bp.jpg'],
        ]]];

        $doctors = ['type' => 'team', 'data' => ['title' => 'Dokter kami', 'subtitle' => 'Jadwal praktik dapat berubah, cek sebelum datang.', 'items' => [
            ['photo' => 'demo/dokter-1.jpg', 'name' => 'dr. Anisa Putri', 'role' => 'Dokter umum · Sen–Jum 08.00–14.00'],
            ['photo' => 'demo/dokter-2.jpg', 'name' => 'dr. Fajar Ramadhan', 'role' => 'Dokter umum · Sen–Sab 16.00–21.00'],
            ['photo' => 'demo/dokter-3.jpg', 'name' => 'dr. Hendra Wijaya, Sp.A', 'role' => 'Dokter anak · Sel & Kam 17.00–20.00'],
            ['photo' => 'demo/dokter-4.jpg', 'name' => 'drg. Reza Pratama', 'role' => 'Dokter gigi · Rab & Sab 09.00–15.00'],
        ]]];

        return [
            ['title' => 'Beranda', 'slug' => 'beranda', 'is_home' => true, 'sections' => [
                ['type' => 'hero', 'data' => [
                    'eyebrow' => 'Klinik Pratama · Melayani BPJS',
                    'title' => 'Sehat lebih *dekat* dengan keluarga Anda',
                    'subtitle' => "{$company} melayani pemeriksaan umum, anak, gigi, dan cek kesehatan. Daftar online, datang tanpa antre lama.",
                    'button_label' => 'Daftar Berobat', 'button_url' => '/pendaftaran',
                    'button2_label' => 'Jadwal Dokter', 'button2_url' => '/dokter',
                    'image' => 'demo/klinik-hero.jpg',
                ]],
                ['type' => 'stats', 'data' => ['items' => [
                    ['value' => '7 hari', 'label' => 'Buka setiap hari'],
                    ['value' => '8', 'label' => 'Dokter & bidan'],
                    ['value' => 'BPJS', 'label' => 'Faskes tingkat 1'],
                    ['value' => '4,8/5', 'label' => 'Ulasan pasien'],
                ]]],
                $services,
                $doctors,
                ['type' => 'steps', 'data' => ['title' => 'Cara berobat', 'items' => [
                    ['title' => 'Daftar online', 'text' => 'Isi formulir atau WhatsApp, pilih dokter dan jam.'],
                    ['title' => 'Datang sesuai jadwal', 'text' => 'Bawa KTP dan kartu BPJS (jika ada).'],
                    ['title' => 'Periksa', 'text' => 'Dokter memeriksa dan memberi resep.'],
                    ['title' => 'Ambil obat', 'text' => 'Obat langsung tersedia di apotek klinik.'],
                ]]],
                ['type' => 'cta', 'data' => ['title' => 'Butuh periksa hari ini?', 'text' => 'Daftar sekarang dan dapatkan nomor antrean lewat WhatsApp.', 'button_label' => 'Daftar Berobat', 'button_url' => '/pendaftaran']],
            ]],
            ['title' => 'Layanan', 'slug' => 'layanan', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Layanan & Tarif', 'subtitle' => 'Pasien BPJS tidak dikenakan biaya untuk layanan yang ditanggung.']],
                $services,
                ['type' => 'pricelist', 'data' => ['title' => 'Tarif pasien umum', 'items' => [
                    ['name' => 'Konsultasi dokter umum', 'description' => 'Belum termasuk obat', 'info' => '', 'price' => 'Rp75.000'],
                    ['name' => 'Konsultasi dokter anak', 'description' => 'Belum termasuk obat', 'info' => '', 'price' => 'Rp150.000'],
                    ['name' => 'Cek gula darah', 'description' => 'Hasil 5 menit', 'info' => '', 'price' => 'Rp25.000'],
                    ['name' => 'Surat keterangan sehat', 'description' => 'Termasuk pemeriksaan fisik', 'info' => '', 'price' => 'Rp50.000'],
                    ['name' => 'Imunisasi dasar', 'description' => 'Sesuai jadwal IDAI', 'info' => '', 'price' => 'mulai Rp100.000'],
                ], 'order_button' => 'no']],
                ['type' => 'faq', 'data' => ['title' => 'Pertanyaan pasien', 'items' => [
                    ['question' => 'Apakah menerima BPJS?', 'answer' => 'Ya, kami faskes tingkat 1. Pindah faskes bisa lewat aplikasi Mobile JKN.'],
                    ['question' => 'Apakah ada layanan malam?', 'answer' => 'Poli umum buka sampai pukul 21.00 setiap hari.'],
                ]]],
            ]],
            ['title' => 'Dokter', 'slug' => 'dokter', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Jadwal Dokter', 'subtitle' => 'Dokter dan tenaga kesehatan berpengalaman.']],
                $doctors,
            ]],
            ['title' => 'Pendaftaran', 'slug' => 'pendaftaran', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Daftar Berobat', 'subtitle' => 'Kami konfirmasi nomor antrean lewat WhatsApp.']],
                ['type' => 'contact', 'data' => ['title' => 'Formulir pendaftaran', 'text' => 'Tulis nama pasien, keluhan, dokter, dan jam yang diinginkan. Untuk keadaan darurat, segera ke IGD rumah sakit terdekat.', 'show_form' => 'yes']],
            ]],
        ];
    }
}
