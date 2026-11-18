<?php

namespace App\Sections;

/**
 * Sample pages for the Pet Shop & Dokter Hewan template: grooming, vet care, pet supplies,
 * pet hotel and booking.
 */
class PetShopContent
{
    /**
     * @return list<array<string, mixed>>
     */
    public static function pages(string $company): array
    {
        $services = ['type' => 'services', 'data' => ['title' => 'Layanan kami', 'items' => [
            ['title' => 'Grooming', 'text' => 'Mandi, potong kuku, bersih telinga, dan styling bulu.', 'image' => 'demo/pet-groom.jpg'],
            ['title' => 'Dokter hewan', 'text' => 'Pemeriksaan, vaksin, dan sterilisasi oleh dokter hewan.', 'image' => 'demo/pet-vet.jpg'],
            ['title' => 'Pet hotel', 'text' => 'Penitipan nyaman dengan update foto setiap hari.', 'image' => 'demo/pet-towel.jpg'],
        ]]];

        $prices = ['type' => 'pricelist', 'data' => ['title' => 'Harga layanan', 'items' => [
            ['name' => 'Grooming kucing', 'description' => 'Mandi, kuku, telinga, parfum.', 'info' => 'mulai', 'price' => 'Rp75.000'],
            ['name' => 'Grooming anjing kecil', 'description' => 'Hingga 10 kg.', 'info' => 'mulai', 'price' => 'Rp100.000'],
            ['name' => 'Vaksin kucing / anjing', 'description' => 'Termasuk pemeriksaan dokter.', 'info' => 'per dosis', 'price' => 'Rp180.000'],
            ['name' => 'Konsultasi dokter hewan', 'description' => 'Pemeriksaan umum.', 'info' => 'per sesi', 'price' => 'Rp100.000'],
            ['name' => 'Pet hotel', 'description' => 'Makan 2x, kandang bersih, update foto.', 'info' => 'per malam', 'price' => 'Rp60.000'],
        ], 'order_button' => 'yes']];

        return [
            ['title' => 'Beranda', 'slug' => 'beranda', 'is_home' => true, 'sections' => [
                ['type' => 'hero', 'data' => [
                    'eyebrow' => 'Pet shop & klinik hewan',
                    'title' => 'Anabul sehat, *bahagia*, wangi',
                    'subtitle' => "{$company} merawat kucing dan anjing kesayangan Anda: grooming, dokter hewan, pet hotel, dan perlengkapan lengkap dalam satu tempat.",
                    'button_label' => 'Booking Grooming', 'button_url' => '/booking',
                    'button2_label' => 'Lihat Layanan', 'button2_url' => '/layanan',
                    'image' => 'demo/pet-poodle.jpg',
                ]],
                $services,
                ['type' => 'pricelist', 'data' => ['title' => 'Perlengkapan anabul', 'items' => [
                    ['name' => 'Makanan kucing premium', 'description' => 'Untuk kucing dewasa, 1,5 kg.', 'info' => 'Terlaris', 'price' => 'Rp125.000', 'image' => 'demo/pet-store.jpg'],
                    ['name' => 'Shampo anti kutu', 'description' => 'Lembut di kulit, wangi tahan lama.', 'info' => '250 ml', 'price' => 'Rp45.000', 'image' => 'demo/pet-cat.jpg'],
                    ['name' => 'Handuk microfiber', 'description' => 'Cepat menyerap, cepat kering.', 'info' => 'Baru', 'price' => 'Rp35.000', 'image' => 'demo/pet-towel.jpg'],
                ], 'order_button' => 'yes']],
                ['type' => 'image_text', 'data' => ['title' => 'Ditangani dengan penuh kasih', 'body' => "Groomer dan dokter hewan kami terbiasa menenangkan anabul yang takut atau galak.\n\n- Produk aman untuk hewan\n- Ruang terpisah kucing & anjing\n- Antar jemput anabul", 'image' => 'demo/pet-vet.jpg', 'image_position' => 'left']],
                ['type' => 'testimonials', 'data' => ['title' => 'Kata pemilik anabul', 'items' => [
                    ['quote' => 'Kucing saya biasanya galak, tapi pulang grooming jadi wangi dan tenang.', 'name' => 'Tasya', 'role' => 'Pemilik Mochi'],
                    ['quote' => 'Dokternya teliti dan menjelaskan dengan jelas. Bruno sudah sehat lagi!', 'name' => 'Pak Andre', 'role' => 'Pemilik Bruno'],
                    ['quote' => 'Dititip seminggu, dikirimi foto tiap hari. Tenang ditinggal mudik.', 'name' => 'Lala', 'role' => 'Pemilik Kiko'],
                ]]],
                ['type' => 'cta', 'data' => ['title' => 'Waktunya anabul dimanja', 'text' => 'Booking jadwal grooming atau periksa dokter hari ini.', 'button_label' => 'Booking Sekarang', 'button_url' => '/booking']],
            ]],
            ['title' => 'Layanan', 'slug' => 'layanan', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Layanan & Harga', 'subtitle' => 'Grooming, dokter hewan, dan pet hotel.']],
                $services,
                $prices,
            ]],
            ['title' => 'Galeri', 'slug' => 'galeri', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Galeri Anabul', 'subtitle' => 'Para pelanggan kecil kami yang menggemaskan.']],
                ['type' => 'gallery', 'data' => ['items' => [
                    ['image' => 'demo/pet-poodle.jpg', 'caption' => 'Habis grooming'],
                    ['image' => 'demo/pet-cat.jpg', 'caption' => 'Potong bulu kucing'],
                    ['image' => 'demo/pet-towel.jpg', 'caption' => 'Selesai mandi'],
                    ['image' => 'demo/pet-groom.jpg', 'caption' => 'Blow dry'],
                    ['image' => 'demo/pet-vet.jpg', 'caption' => 'Cek kesehatan'],
                    ['image' => 'demo/pet-store.jpg', 'caption' => 'Pet shop'],
                ]]],
            ]],
            ['title' => 'Booking', 'slug' => 'booking', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Booking', 'subtitle' => 'Buka setiap hari 09.00–20.00.']],
                ['type' => 'contact', 'data' => ['title' => 'Jadwalkan kunjungan', 'text' => 'Tulis jenis hewan, layanan, dan jam yang Anda mau.', 'show_form' => 'yes']],
            ]],
        ];
    }
}
