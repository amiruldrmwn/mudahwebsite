<?php

namespace App\Sections;

/**
 * Sample pages for the Bengkel template: car and motorbike servicing, price list, booking
 * steps and contact.
 */
class WorkshopContent
{
    /**
     * @return list<array<string, mixed>>
     */
    public static function pages(string $company): array
    {
        $services = ['type' => 'services', 'data' => ['title' => 'Layanan bengkel', 'items' => [
            ['title' => 'Servis berkala mobil', 'text' => 'Ganti oli, filter, dan pengecekan 40 titik.', 'image' => 'demo/bengkel-engine.jpg'],
            ['title' => 'Servis motor', 'text' => 'Tune up, CVT, karburator dan injeksi.', 'image' => 'demo/bengkel-motor.jpg'],
            ['title' => 'Kaki-kaki & rem', 'text' => 'Spooring, balancing, shockbreaker, kampas rem.', 'image' => 'demo/bengkel-lift.jpg'],
        ]]];

        $prices = ['type' => 'pricelist', 'data' => ['title' => 'Harga jasa', 'subtitle' => 'Belum termasuk suku cadang. Estimasi biaya selalu disampaikan sebelum dikerjakan.', 'items' => [
            ['name' => 'Servis ringan motor', 'info' => '±45 menit', 'price' => 'Rp65.000'],
            ['name' => 'Servis CVT matic', 'info' => '±1 jam', 'price' => 'Rp85.000'],
            ['name' => 'Servis berkala mobil', 'info' => '±2 jam', 'price' => 'Rp250.000'],
            ['name' => 'Spooring & balancing', 'info' => '±1 jam', 'price' => 'Rp200.000'],
            ['name' => 'Scanner & diagnosa', 'info' => '±30 menit', 'price' => 'Rp150.000'],
            ['name' => 'Servis AC mobil', 'info' => '±2 jam', 'price' => 'Rp300.000'],
        ], 'order_button' => 'yes']];

        return [
            ['title' => 'Beranda', 'slug' => 'beranda', 'is_home' => true, 'sections' => [
                ['type' => 'hero', 'data' => [
                    'eyebrow' => 'Bengkel mobil & motor',
                    'title' => 'Servis *jujur*, kendaraan prima',
                    'subtitle' => "Mekanik berpengalaman {$company} menangani mobil dan motor semua merek. Estimasi biaya jelas sebelum dikerjakan, garansi servis 30 hari.",
                    'button_label' => 'Booking Servis', 'button_url' => '/booking',
                    'button2_label' => 'Lihat Harga', 'button2_url' => '/layanan',
                    'image' => 'demo/bengkel-motorlift.jpg',
                ]],
                ['type' => 'stats', 'data' => ['items' => [
                    ['value' => '12 th', 'label' => 'Pengalaman'],
                    ['value' => '8', 'label' => 'Mekanik bersertifikat'],
                    ['value' => '30 hari', 'label' => 'Garansi servis'],
                    ['value' => '20rb+', 'label' => 'Kendaraan ditangani'],
                ]]],
                $services,
                ['type' => 'image_text', 'data' => ['title' => 'Transparan dari awal sampai akhir', 'body' => "Kami jelaskan kerusakan dan biaya sebelum memulai. Suku cadang lama ditunjukkan kepada Anda.\n\n- Suku cadang asli dan aftermarket berkualitas\n- Ruang tunggu nyaman, Wi-Fi gratis\n- Servis panggilan untuk area kota", 'image' => 'demo/bengkel-carb.jpg', 'image_position' => 'right']],
                ['type' => 'steps', 'data' => ['title' => 'Cara booking', 'items' => [
                    ['title' => 'Chat jadwal', 'text' => 'Pilih hari, jam, dan jenis servis.'],
                    ['title' => 'Datang tanpa antre', 'text' => 'Kendaraan langsung ditangani.'],
                    ['title' => 'Cek & estimasi', 'text' => 'Mekanik menjelaskan biaya terlebih dahulu.'],
                    ['title' => 'Selesai & garansi', 'text' => 'Bayar setelah kendaraan siap.'],
                ]]],
                ['type' => 'testimonials', 'data' => ['title' => 'Kata pelanggan', 'items' => [
                    ['quote' => 'Mekaniknya jujur, cuma ganti yang perlu. Mobil enak lagi.', 'name' => 'Pak Dedi', 'role' => 'Pemilik MPV'],
                    ['quote' => 'Booking dulu lewat WA, datang langsung dikerjakan. Mantap!', 'name' => 'Rizky', 'role' => 'Pengguna motor matic'],
                    ['quote' => 'Harga jelas di depan, tidak ada biaya kejutan.', 'name' => 'Bu Wati', 'role' => 'Pelanggan setia'],
                ]]],
                ['type' => 'cta', 'data' => ['title' => 'Kendaraan bermasalah?', 'text' => 'Konsultasi gratis via WhatsApp, kirim foto atau suara mesinnya.', 'button_label' => 'Booking Sekarang', 'button_url' => '/booking']],
            ]],
            ['title' => 'Layanan', 'slug' => 'layanan', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Layanan & Harga', 'subtitle' => 'Mobil dan motor semua merek.']],
                $services,
                $prices,
            ]],
            ['title' => 'Galeri', 'slug' => 'galeri', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Bengkel Kami', 'subtitle' => 'Peralatan lengkap, tempat bersih.']],
                ['type' => 'gallery', 'data' => ['items' => [
                    ['image' => 'demo/bengkel-shop.jpg', 'caption' => 'Area servis'],
                    ['image' => 'demo/bengkel-lift.jpg', 'caption' => 'Lift hidrolik'],
                    ['image' => 'demo/bengkel-motorlift.jpg', 'caption' => 'Servis motor'],
                    ['image' => 'demo/bengkel-engine.jpg', 'caption' => 'Pengecekan mesin'],
                    ['image' => 'demo/bengkel-carb.jpg', 'caption' => 'Karburator & injeksi'],
                    ['image' => 'demo/bengkel-motor.jpg', 'caption' => 'Overhaul mesin'],
                ]]],
            ]],
            ['title' => 'Booking', 'slug' => 'booking', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Booking Servis', 'subtitle' => 'Senin–Sabtu 08.00–17.00, Minggu 08.00–12.00.']],
                ['type' => 'contact', 'data' => ['title' => 'Jadwalkan servis', 'text' => 'Tulis jenis kendaraan, keluhan, dan jadwal yang Anda mau.', 'show_form' => 'yes']],
            ]],
        ];
    }
}
