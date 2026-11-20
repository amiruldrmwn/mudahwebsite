<?php

namespace App\Sections;

/**
 * Sample pages for the Bidan & Klinik Bersalin template: pregnancy check-ups, normal delivery,
 * baby immunisation and family planning, birth packages, pregnancy classes, the midwives'
 * practice schedule and a 24-hour emergency line.
 */
class MidwifeContent
{
    /**
     * @return list<array<string, mixed>>
     */
    public static function pages(string $company): array
    {
        $services = ['type' => 'services', 'data' => ['title' => 'Layanan untuk ibu & buah hati', 'subtitle' => 'Dari awal kehamilan, persalinan, sampai si kecil tumbuh sehat.', 'items' => [
            ['title' => 'Periksa kehamilan (ANC)', 'text' => "Cek tekanan darah, berat badan, dan detak jantung janin\nBuku KIA diisi setiap kunjungan\nKonsultasi gizi dan keluhan hamil", 'image' => 'demo/bidan-hamil.jpg'],
            ['title' => 'Persalinan normal', 'text' => "Ruang bersalin bersih dan nyaman\nDidampingi bidan dari awal sampai pulang\nInisiasi menyusu dini (IMD)", 'image' => 'demo/bidan-persalinan.jpg'],
            ['title' => 'Imunisasi & tumbuh kembang', 'text' => "Imunisasi dasar lengkap sesuai jadwal IDAI\nTimbang dan ukur tinggi bayi\nKonsultasi MPASI", 'image' => 'demo/bidan-ibu.jpg'],
        ]]];

        $more = ['type' => 'services', 'data' => ['title' => 'Layanan lainnya', 'items' => [
            ['title' => 'KB', 'text' => 'Suntik 1 dan 3 bulan, pil, implan, dan IUD. Konsultasi dulu, pilih yang paling cocok.', 'image' => ''],
            ['title' => 'USG kehamilan', 'text' => 'USG 2D untuk melihat posisi dan perkembangan janin, hasil dicetak.', 'image' => ''],
            ['title' => 'Pijat bayi', 'text' => 'Pijat lembut untuk bayi 0–12 bulan, bikin tidur lebih nyenyak.', 'image' => ''],
            ['title' => 'Perawatan nifas', 'text' => 'Kunjungan nifas, cek jahitan, dan bantuan menyusui di rumah.', 'image' => ''],
        ]]];

        $schedule = ['type' => 'pricelist', 'data' => ['title' => 'Jadwal praktik', 'subtitle' => 'Persalinan dan keadaan darurat dilayani 24 jam, setiap hari.', 'items' => [
            ['name' => 'Senin – Jumat', 'description' => 'Periksa hamil, KB, imunisasi, dan konsultasi', 'info' => 'Bidan Sri & Bidan Nur', 'price' => '07.00–20.00', 'image' => ''],
            ['name' => 'Sabtu', 'description' => 'Periksa hamil, KB, dan pijat bayi', 'info' => 'Bidan Ayu', 'price' => '07.00–14.00', 'image' => ''],
            ['name' => 'Minggu & tanggal merah', 'description' => 'Hanya persalinan dan keadaan darurat', 'info' => 'Bidan jaga', 'price' => 'Siaga', 'image' => ''],
            ['name' => 'Posyandu keliling', 'description' => 'Imunisasi di balai RW, minggu kedua setiap bulan', 'info' => 'Rabu', 'price' => '08.00–11.00', 'image' => ''],
        ], 'note' => 'Imunisasi hari Selasa dan Kamis. Bawa buku KIA setiap kunjungan.', 'order_button' => 'no']];

        $packages = ['type' => 'plans', 'data' => ['title' => 'Paket persalinan', 'subtitle' => 'Harga jelas di awal, tanpa biaya tersembunyi. Pasien BPJS tetap kami layani.', 'items' => [
            ['name' => 'BPJS Kesehatan', 'badge' => '', 'price' => 'Ditanggung', 'old_price' => '', 'info' => 'peserta aktif, faskes sesuai', 'features' => "Persalinan normal ditanggung BPJS\nRawat inap 1 hari\nObat dan perawatan bayi baru lahir\nRujukan bila ada penyulit", 'highlight' => 'no'],
            ['name' => 'Paket Melati', 'badge' => 'Paling dipilih', 'price' => 'Rp2,8 jt', 'old_price' => '', 'info' => 'rawat inap 2 hari', 'features' => "Persalinan normal dengan 2 bidan\nKamar rawat berdua\nImunisasi HB-0 dan vitamin K\nAkta lahir dibantu urus\nKunjungan nifas 1 kali", 'highlight' => 'yes'],
            ['name' => 'Paket Mawar', 'badge' => '', 'price' => 'Rp3,9 jt', 'old_price' => '', 'info' => 'rawat inap 2 hari', 'features' => "Semua isi Paket Melati\nKamar sendiri ber-AC\nPendamping boleh menginap\nPijat bayi dan perawatan tali pusat di rumah\nFoto bayi baru lahir", 'highlight' => 'no'],
        ], 'note' => 'Bila perlu rujukan ke rumah sakit, biaya mengikuti rumah sakit tujuan. Kami antar dengan ambulans.']];

        $team = ['type' => 'team', 'data' => ['title' => 'Bidan kami', 'subtitle' => 'Bidan berpengalaman ber-STR aktif yang sabar mendengarkan.', 'items' => [
            ['photo' => '', 'name' => 'Sri Wahyuni, S.Tr.Keb', 'role' => 'Bidan penanggung jawab · 18 tahun'],
            ['photo' => '', 'name' => 'Nur Aisyah, A.Md.Keb', 'role' => 'Bidan persalinan & nifas · 9 tahun'],
            ['photo' => '', 'name' => 'Ayu Lestari, S.Tr.Keb', 'role' => 'Bidan kelas hamil & pijat bayi · 6 tahun'],
        ]]];

        return [
            ['title' => 'Beranda', 'slug' => 'beranda', 'is_home' => true, 'sections' => [
                ['type' => 'hero', 'data' => [
                    'eyebrow' => 'Praktik Mandiri Bidan · Melayani BPJS',
                    'title' => 'Menemani ibu *sejak hamil hingga si kecil lahir*',
                    'subtitle' => "{$company} melayani periksa kehamilan, persalinan normal, imunisasi, dan KB dengan bidan yang sabar dan ramah. Seperti diperiksa saudara sendiri.",
                    'button_label' => 'Daftar Periksa', 'button_url' => '/kontak',
                    'button2_label' => 'Lihat Paket Persalinan', 'button2_url' => '/paket',
                    'image' => 'demo/bidan-hero.jpg',
                ]],
                ['type' => 'stats', 'data' => ['items' => [
                    ['value' => '24 jam', 'label' => 'Siaga persalinan'],
                    ['value' => '2.400+', 'label' => 'Bayi lahir sehat'],
                    ['value' => 'BPJS', 'label' => 'Diterima di sini'],
                    ['value' => '18 th', 'label' => 'Melayani warga'],
                ]]],
                $services,
                ['type' => 'image_text', 'data' => [
                    'title' => 'Tenang seperti di rumah sendiri',
                    'body' => "Kami tahu hamil dan melahirkan bisa bikin cemas. Karena itu setiap ibu didampingi bidan yang sama sejak periksa pertama, jadi tidak perlu bercerita dari awal lagi.\n\n- Ruang bersalin bersih, ada ruang tunggu untuk keluarga\n- Ibu boleh didampingi suami saat melahirkan\n- Ambulans siap bila perlu rujukan ke rumah sakit",
                    'image' => 'demo/bidan-persalinan.jpg', 'image_position' => 'left',
                    'button_label' => 'Kenali bidan kami', 'button_url' => '/kontak',
                ]],
                $team,
                $schedule,
                ['type' => 'testimonials', 'data' => ['title' => 'Cerita para ibu', 'items' => [
                    ['quote' => 'Anak pertama saya lahir di sini. Bidan Sri sabar sekali menemani dari bukaan satu sampai lahir, saya jadi tidak panik.', 'name' => 'Ibu Rina', 'role' => 'Melahirkan anak pertama'],
                    ['quote' => 'Imunisasi selalu tepat jadwal karena diingatkan lewat WhatsApp. Anak saya juga tidak rewel waktu dipijat.', 'name' => 'Ibu Dewi', 'role' => 'Imunisasi & pijat bayi'],
                    ['quote' => 'Pakai BPJS tetap dilayani dengan baik, tidak dibedakan. Kamarnya bersih dan nyaman.', 'name' => 'Ibu Wulan', 'role' => 'Persalinan BPJS'],
                ]]],
                ['type' => 'cta', 'data' => ['title' => 'Mau melahirkan atau ada keadaan darurat?', 'text' => 'Bidan jaga siap 24 jam, termasuk hari Minggu dan tanggal merah. Langsung telepon, jangan ditunda.', 'button_label' => 'Hubungi Bidan Jaga', 'button_url' => '/kontak']],
            ]],
            ['title' => 'Layanan', 'slug' => 'layanan', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Layanan Kami', 'subtitle' => 'Periksa hamil, persalinan, imunisasi, KB, USG, dan pijat bayi dalam satu tempat.', 'image' => 'demo/bidan-kaki.jpg']],
                $services,
                $more,
                ['type' => 'pricelist', 'data' => ['title' => 'Tarif layanan', 'subtitle' => 'Untuk pasien umum. Peserta BPJS mengikuti ketentuan BPJS.', 'items' => [
                    ['name' => 'Periksa kehamilan', 'description' => 'Termasuk cek Hb dan konsultasi', 'info' => '', 'price' => 'Rp50.000', 'image' => ''],
                    ['name' => 'USG 2D', 'description' => 'Hasil dicetak', 'info' => '', 'price' => 'Rp150.000', 'image' => ''],
                    ['name' => 'Imunisasi dasar', 'description' => 'Vaksin program pemerintah', 'info' => '', 'price' => 'Rp35.000', 'image' => ''],
                    ['name' => 'KB suntik 3 bulan', 'description' => 'Termasuk kartu KB', 'info' => '', 'price' => 'Rp35.000', 'image' => ''],
                    ['name' => 'Pasang implan', 'description' => 'Berlaku 3 tahun', 'info' => '', 'price' => 'Rp450.000', 'image' => ''],
                    ['name' => 'Pijat bayi', 'description' => 'Di klinik, sekitar 30 menit', 'info' => '', 'price' => 'Rp60.000', 'image' => ''],
                ], 'note' => 'Kunjungan ke rumah tambah Rp30.000 untuk wilayah kecamatan.', 'order_button' => 'no']],
                ['type' => 'faq', 'data' => ['title' => 'Pertanyaan yang sering ditanyakan', 'items' => [
                    ['question' => 'Apakah bisa pakai BPJS?', 'answer' => 'Bisa. Kami faskes BPJS untuk periksa hamil, persalinan normal, dan KB. Bawa kartu BPJS/KIS dan KTP.'],
                    ['question' => 'Kapan sebaiknya mulai periksa hamil?', 'answer' => 'Segera setelah telat haid atau tes kehamilan positif. Minimal 6 kali selama hamil, sesuai anjuran Kemenkes.'],
                    ['question' => 'Bagaimana bila persalinan perlu dirujuk?', 'answer' => 'Bidan akan menjelaskan alasannya, menghubungi rumah sakit, dan mengantar dengan ambulans kami.'],
                ]]],
            ]],
            ['title' => 'Paket Persalinan', 'slug' => 'paket', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Paket Persalinan', 'subtitle' => 'Pilih paket yang sesuai. Semua paket ditangani bidan berpengalaman.', 'image' => 'demo/bidan-bayi.jpg']],
                $packages,
                ['type' => 'steps', 'data' => ['title' => 'Persiapan menjelang lahiran', 'items' => [
                    ['title' => 'Daftar paket', 'text' => 'Pilih paket saat usia kehamilan 7–8 bulan, bisa dicicil.'],
                    ['title' => 'Siapkan tas', 'text' => 'Baju ibu dan bayi, kain, popok, buku KIA, KTP, dan kartu BPJS.'],
                    ['title' => 'Tanda persalinan', 'text' => 'Mulas teratur, keluar lendir darah, atau air ketuban: langsung telepon bidan jaga.'],
                    ['title' => 'Pulang & nifas', 'text' => 'Kami jadwalkan kunjungan nifas dan imunisasi pertama si kecil.'],
                ]]],
                ['type' => 'gallery', 'data' => ['title' => 'Suasana klinik', 'items' => [
                    ['image' => 'demo/bidan-persalinan.jpg', 'caption' => 'Perawatan bayi baru lahir'],
                    ['image' => 'demo/bidan-bayi.jpg', 'caption' => 'Ruang bayi'],
                    ['image' => 'demo/bidan-genggam.jpg', 'caption' => 'Kontak kulit ibu dan bayi'],
                ]]],
            ]],
            ['title' => 'Kelas Hamil', 'slug' => 'kelas', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Kelas Ibu Hamil & Senam Hamil', 'subtitle' => 'Belajar bersama ibu-ibu lain supaya lebih siap dan percaya diri.', 'image' => 'demo/bidan-hero.jpg']],
                ['type' => 'image_text', 'data' => [
                    'title' => 'Setiap Sabtu pagi',
                    'body' => "Kelas diadakan setiap Sabtu pukul 08.00–10.00 di aula klinik. Cocok untuk usia kehamilan 20 minggu ke atas, suami dianjurkan ikut.\n\n- **Senam hamil** untuk melatih napas dan otot panggul\n- **Persiapan persalinan**: tanda bahaya dan posisi melahirkan\n- **Menyusui & merawat bayi**: praktik langsung dengan boneka\n\nBiaya Rp50.000 per pertemuan, gratis untuk pasien paket persalinan.",
                    'image' => 'demo/bidan-hamil.jpg', 'image_position' => 'right',
                    'button_label' => 'Daftar kelas', 'button_url' => '/kontak',
                ]],
                ['type' => 'services', 'data' => ['title' => 'Materi 4 pertemuan', 'items' => [
                    ['title' => 'Minggu 1 · Hamil sehat', 'text' => 'Gizi ibu hamil, tablet tambah darah, dan keluhan yang wajar.', 'image' => ''],
                    ['title' => 'Minggu 2 · Senam & napas', 'text' => 'Gerakan aman untuk ibu hamil dan teknik napas saat mulas.', 'image' => ''],
                    ['title' => 'Minggu 3 · Persalinan', 'text' => 'Tanda persalinan, kapan ke klinik, dan peran pendamping.', 'image' => ''],
                    ['title' => 'Minggu 4 · Bayi baru lahir', 'text' => 'Menyusui, memandikan bayi, dan merawat tali pusat.', 'image' => ''],
                ]]],
                ['type' => 'contact', 'data' => ['title' => 'Daftar kelas hamil', 'text' => 'Tulis nama, usia kehamilan, dan tanggal kelas yang diinginkan.', 'show_form' => 'yes']],
            ]],
            ['title' => 'Kontak', 'slug' => 'kontak', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Daftar Periksa & Kontak', 'subtitle' => 'Daftar lewat WhatsApp supaya tidak lama menunggu. Darurat? Langsung telepon.', 'image' => 'demo/bidan-genggam.jpg']],
                $schedule,
                ['type' => 'contact', 'data' => ['title' => 'Daftar periksa', 'text' => 'Tulis nama ibu, usia kehamilan atau usia bayi, dan layanan yang dibutuhkan. Kami balas dengan nomor antrean.', 'show_form' => 'yes']],
            ]],
        ];
    }
}
