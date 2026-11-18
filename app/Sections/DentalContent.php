<?php

namespace App\Sections;

/**
 * Sample pages for the Klinik Gigi template: treatments and prices, dentists, practice schedule,
 * FAQ and booking.
 */
class DentalContent
{
    /**
     * @return list<array<string, mixed>>
     */
    public static function pages(string $company): array
    {
        $treatments = [
            ['title' => 'Scaling & Pembersihan', 'text' => 'Bersihkan karang gigi agar gusi sehat dan napas segar.', 'image' => 'demo/dent-room.jpg'],
            ['title' => 'Bleaching / Pemutihan', 'text' => 'Gigi lebih putih dan cerah dalam satu kunjungan.', 'image' => 'demo/dent-smile.jpg'],
            ['title' => 'Behel / Ortodonti', 'text' => 'Rapikan susunan gigi dengan behel metal, keramik, atau clear aligner.', 'image' => 'demo/dent-braces.jpg'],
            ['title' => 'Gigi Anak', 'text' => 'Perawatan ramah anak dengan dokter yang sabar dan ruangan ceria.', 'image' => 'demo/dent-kids.jpg'],
        ];

        $schedule = [
            ['name' => 'drg. Anisa Rahma', 'description' => 'Dokter gigi umum', 'info' => 'Senin – Jumat', 'price' => '09.00 – 15.00'],
            ['name' => 'drg. Budi Hartanto, Sp.Ort', 'description' => 'Spesialis ortodonti (behel)', 'info' => 'Selasa, Kamis, Sabtu', 'price' => '15.00 – 20.00'],
            ['name' => 'drg. Citra Lestari, Sp.KGA', 'description' => 'Spesialis gigi anak', 'info' => 'Rabu & Sabtu', 'price' => '10.00 – 16.00'],
        ];

        $cta = ['title' => 'Saatnya periksa gigi rutin', 'text' => 'Periksa gigi setiap 6 bulan. Booking sekarang, tanpa antre panjang.', 'button_label' => 'Booking Jadwal', 'button_url' => '/kontak'];

        return [
            ['title' => 'Beranda', 'slug' => 'beranda', 'is_home' => true, 'sections' => [
                ['type' => 'hero', 'data' => [
                    'eyebrow' => 'Klinik gigi keluarga',
                    'title' => 'Senyum sehat, percaya diri setiap hari',
                    'subtitle' => "Dokter gigi berpengalaman di {$company} siap merawat gigi Anda dan keluarga dengan nyaman, steril, dan tanpa rasa takut.",
                    'button_label' => 'Booking Jadwal', 'button_url' => '/kontak',
                    'button2_label' => 'Lihat Layanan', 'button2_url' => '/layanan',
                    'image' => 'demo/dent-hero.jpg',
                ]],
                ['type' => 'services', 'data' => ['title' => 'Layanan kami', 'subtitle' => 'Perawatan lengkap untuk segala usia.', 'items' => $treatments]],
                ['type' => 'stats', 'data' => ['items' => [
                    ['value' => '12.000+', 'label' => 'Pasien tersenyum'],
                    ['value' => '6', 'label' => 'Dokter gigi'],
                    ['value' => '10 tahun', 'label' => 'Pengalaman'],
                    ['value' => '100%', 'label' => 'Alat steril'],
                ]]],
                ['type' => 'team', 'data' => ['title' => 'Dokter kami', 'items' => [
                    ['photo' => 'demo/dent-doctor-1.jpg', 'name' => 'drg. Anisa Rahma', 'role' => 'Dokter gigi umum'],
                    ['photo' => 'demo/dent-doctor-2.jpg', 'name' => 'drg. Budi Hartanto, Sp.Ort', 'role' => 'Spesialis ortodonti'],
                ]]],
                ['type' => 'testimonials', 'data' => ['title' => 'Kata pasien', 'items' => [
                    ['quote' => 'Dokternya sabar dan menjelaskan dengan jelas. Scaling sama sekali tidak sakit.', 'name' => 'Mira', 'role' => 'Pasien scaling'],
                    ['quote' => 'Anak saya yang tadinya takut ke dokter gigi sekarang malah minta kontrol.', 'name' => 'Ibu Dewi', 'role' => 'Orang tua pasien'],
                    ['quote' => 'Hasil behel rapi dan kontrolnya bisa booking lewat WhatsApp. Praktis!', 'name' => 'Fajar', 'role' => 'Pasien ortodonti'],
                ]]],
                ['type' => 'cta', 'data' => $cta],
            ]],
            ['title' => 'Layanan', 'slug' => 'layanan', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Layanan & Harga', 'subtitle' => 'Harga transparan, konsultasi sebelum tindakan.']],
                ['type' => 'services', 'data' => ['items' => $treatments]],
                ['type' => 'pricelist', 'data' => ['title' => 'Daftar harga', 'items' => [
                    ['name' => 'Konsultasi & pemeriksaan', 'info' => '15 menit', 'price' => 'Rp100.000'],
                    ['name' => 'Scaling (pembersihan karang)', 'info' => '30 menit', 'price' => 'Rp350.000'],
                    ['name' => 'Tambal gigi (komposit)', 'info' => 'Per gigi', 'price' => 'Rp300.000'],
                    ['name' => 'Cabut gigi', 'info' => 'Per gigi', 'price' => 'Rp250.000'],
                    ['name' => 'Bleaching', 'info' => '60 menit', 'price' => 'Rp2.500.000'],
                    ['name' => 'Behel metal', 'info' => 'Mulai', 'price' => 'Rp6.000.000'],
                ], 'note' => 'Harga dapat berbeda sesuai kondisi gigi. Kami jelaskan biaya sebelum tindakan.', 'order_button' => 'yes']],
            ]],
            ['title' => 'Jadwal Dokter', 'slug' => 'jadwal', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Jadwal Praktik Dokter', 'subtitle' => 'Booking dulu agar langsung dilayani tanpa antre.']],
                ['type' => 'pricelist', 'data' => ['title' => 'Jadwal praktik', 'items' => $schedule, 'note' => 'Jadwal dapat berubah. Konfirmasi via WhatsApp sebelum datang.', 'order_button' => 'yes']],
                ['type' => 'team', 'data' => ['title' => 'Kenali dokter kami', 'items' => [
                    ['photo' => 'demo/dent-doctor-1.jpg', 'name' => 'drg. Anisa Rahma', 'role' => 'Dokter gigi umum'],
                    ['photo' => 'demo/dent-doctor-2.jpg', 'name' => 'drg. Budi Hartanto, Sp.Ort', 'role' => 'Spesialis ortodonti'],
                ]]],
                ['type' => 'faq', 'data' => ['title' => 'Pertanyaan umum', 'items' => [
                    ['question' => 'Apakah menerima BPJS atau asuransi?', 'answer' => 'Kami menerima beberapa asuransi swasta. Hubungi kami untuk memastikan asuransi Anda.'],
                    ['question' => 'Apakah perawatan sakit?', 'answer' => 'Kami menggunakan anestesi lokal untuk tindakan tertentu agar Anda tetap nyaman.'],
                    ['question' => 'Berapa lama pemasangan behel?', 'answer' => 'Pemasangan sekitar 1–2 jam. Lama perawatan rata-rata 1,5–2 tahun dengan kontrol rutin.'],
                ]]],
            ]],
            ['title' => 'Kontak', 'slug' => 'kontak', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Booking Jadwal', 'subtitle' => 'Senin–Sabtu 09.00–20.00.']],
                ['type' => 'contact', 'data' => ['title' => 'Atur kunjungan Anda', 'text' => 'Sebutkan keluhan, dokter pilihan, dan jadwal yang diinginkan.', 'show_form' => 'yes']],
            ]],
        ];
    }
}
