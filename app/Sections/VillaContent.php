<?php

namespace App\Sections;

/**
 * Sample pages for the Villa & Penginapan template: room types with nightly rates, amenities,
 * gallery and booking.
 */
class VillaContent
{
    /**
     * @return list<array<string, mixed>>
     */
    public static function pages(string $company): array
    {
        $rooms = [
            ['image' => 'demo/villa-bedroom.jpg', 'name' => 'Garden Suite', 'category' => '1 kamar tidur', 'specs' => "2 tamu\nKing bed\nTeras taman\nSarapan", 'price' => 'Rp1.450.000', 'unit' => '/malam'],
            ['image' => 'demo/villa-hero.jpg', 'name' => 'Pool Villa', 'category' => '1 kamar tidur', 'badge' => 'Favorit', 'specs' => "2 tamu\nKolam renang pribadi\nBathtub outdoor\nSarapan", 'price' => 'Rp2.800.000', 'unit' => '/malam'],
            ['image' => 'demo/villa-living.jpg', 'name' => 'Family Villa', 'category' => '3 kamar tidur', 'specs' => "6 tamu\nKolam pribadi\nDapur lengkap\nRuang keluarga", 'price' => 'Rp5.500.000', 'unit' => '/malam'],
        ];

        $amenities = [
            ['title' => 'Kolam renang pribadi', 'text' => 'Berenang kapan saja dengan pemandangan sawah dan taman.'],
            ['title' => 'Sarapan mengapung', 'text' => 'Floating breakfast di kolam, sekali untuk setiap tamu.'],
            ['title' => 'Antar jemput bandara', 'text' => 'Gratis untuk menginap minimal 3 malam.'],
            ['title' => 'Spa di kamar', 'text' => 'Pijat tradisional Bali langsung di villa Anda.'],
        ];

        $cta = ['title' => 'Rencanakan liburan Anda', 'text' => 'Pesan langsung lebih hemat dibanding aplikasi. Tanya ketersediaan sekarang.', 'button_label' => 'Cek Ketersediaan', 'button_url' => '/kontak'];

        return [
            ['title' => 'Beranda', 'slug' => 'beranda', 'is_home' => true, 'sections' => [
                ['type' => 'hero', 'data' => [
                    'eyebrow' => 'Private pool villa',
                    'title' => 'Tempat istirahat yang sesungguhnya',
                    'subtitle' => "Villa pribadi di tengah sawah dan pepohonan. {$company} menghadirkan ketenangan, privasi, dan pelayanan sepenuh hati.",
                    'button_label' => 'Lihat Kamar', 'button_url' => '/kamar',
                    'button2_label' => 'Cek Ketersediaan', 'button2_url' => '/kontak',
                    'image' => 'demo/villa-hero.jpg',
                ]],
                ['type' => 'image_text', 'data' => ['title' => 'Selamat datang di rumah kedua Anda', 'body' => "Bangun dengan suara alam, berenang di kolam pribadi, dan nikmati sarapan di tepi sawah.\n\nSetiap villa dirancang dengan material alami dan sentuhan budaya lokal.", 'image' => 'demo/villa-living.jpg', 'image_position' => 'right']],
                ['type' => 'catalog', 'data' => ['title' => 'Pilihan villa', 'subtitle' => 'Harga per malam, sudah termasuk sarapan untuk 2 orang.', 'items' => $rooms, 'button_label' => 'Pesan']],
                ['type' => 'services', 'data' => ['title' => 'Fasilitas', 'items' => $amenities]],
                ['type' => 'gallery', 'data' => ['title' => 'Galeri', 'items' => [
                    ['image' => 'demo/villa-hero.jpg', 'caption' => 'Kolam infinity'],
                    ['image' => 'demo/villa-breakfast.jpg', 'caption' => 'Floating breakfast'],
                    ['image' => 'demo/villa-night.jpg', 'caption' => 'Suasana malam'],
                ]]],
                ['type' => 'testimonials', 'data' => ['title' => 'Kata tamu', 'items' => [
                    ['quote' => 'Villa-nya indah sekali dan sangat privat. Staf sangat ramah dan sigap.', 'name' => 'Anita & Bayu', 'role' => 'Bulan madu'],
                    ['quote' => 'Floating breakfast-nya jadi momen terbaik liburan kami. Pasti kembali lagi.', 'name' => 'Keluarga Santoso', 'role' => 'Liburan keluarga'],
                    ['quote' => 'Bersih, tenang, dan pemandangannya menenangkan. Cocok untuk kerja sambil liburan.', 'name' => 'Michael', 'role' => 'Workcation'],
                ]]],
                ['type' => 'cta', 'data' => $cta],
            ]],
            ['title' => 'Kamar', 'slug' => 'kamar', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Villa & Kamar', 'subtitle' => 'Pilih villa sesuai jumlah tamu dan suasana liburan Anda.', 'image' => 'demo/villa-bedroom.jpg']],
                ['type' => 'catalog', 'data' => ['items' => $rooms, 'button_label' => 'Pesan']],
                ['type' => 'pricelist', 'data' => ['title' => 'Info menginap', 'items' => [
                    ['name' => 'Check-in', 'price' => '14.00'],
                    ['name' => 'Check-out', 'price' => '12.00'],
                    ['name' => 'Tamu tambahan', 'info' => 'Termasuk sarapan', 'price' => 'Rp350.000/malam'],
                    ['name' => 'Early check-in / late check-out', 'info' => 'Sesuai ketersediaan', 'price' => 'Rp400.000'],
                ], 'order_button' => 'yes']],
            ]],
            ['title' => 'Fasilitas', 'slug' => 'fasilitas', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Fasilitas & Pengalaman', 'subtitle' => 'Lebih dari sekadar menginap.', 'image' => 'demo/villa-breakfast.jpg']],
                ['type' => 'services', 'data' => ['items' => [
                    ['title' => 'Floating breakfast', 'text' => 'Sarapan mengapung di kolam pribadi Anda.', 'image' => 'demo/villa-breakfast.jpg'],
                    ['title' => 'Kamar mandi alam', 'text' => 'Bathtub batu dan pancuran di tengah taman.', 'image' => 'demo/villa-bath.jpg'],
                    ['title' => 'Malam romantis', 'text' => 'Makan malam lilin di tepi kolam.', 'image' => 'demo/villa-night.jpg'],
                ]]],
                ['type' => 'services', 'data' => ['title' => 'Termasuk dalam menginap', 'items' => $amenities]],
            ]],
            ['title' => 'Kontak', 'slug' => 'kontak', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Reservasi', 'subtitle' => 'Kami membalas dalam hitungan menit.', 'image' => 'demo/villa-night.jpg']],
                ['type' => 'contact', 'data' => ['title' => 'Cek ketersediaan', 'text' => 'Sebutkan tanggal check-in, check-out, jumlah tamu, dan pilihan villa.', 'show_form' => 'yes']],
            ]],
        ];
    }
}
