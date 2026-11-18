<?php

namespace App\Sections;

/**
 * Sample pages for the Laundry template: per-kilo and per-item prices, pickup and delivery,
 * order steps and contact.
 */
class LaundryContent
{
    /**
     * @return list<array<string, mixed>>
     */
    public static function pages(string $company): array
    {
        $prices = ['type' => 'pricelist', 'data' => ['title' => 'Daftar harga', 'subtitle' => 'Harga per kilo sudah termasuk cuci, kering, setrika, dan pewangi.', 'items' => [
            ['name' => 'Cuci Setrika Reguler', 'description' => 'Selesai dalam 2 hari.', 'info' => '/kg', 'price' => 'Rp8.000'],
            ['name' => 'Cuci Setrika Kilat', 'description' => 'Selesai dalam 6 jam.', 'info' => '/kg', 'price' => 'Rp15.000'],
            ['name' => 'Cuci Kering Lipat', 'description' => 'Tanpa setrika, lebih hemat.', 'info' => '/kg', 'price' => 'Rp6.000'],
            ['name' => 'Bed Cover / Selimut', 'description' => 'Ukuran single sampai king.', 'info' => '/pcs', 'price' => 'Rp25.000'],
            ['name' => 'Jas / Kebaya', 'description' => 'Dry clean, aman untuk bahan halus.', 'info' => '/pcs', 'price' => 'Rp35.000'],
            ['name' => 'Sepatu', 'description' => 'Deep clean dan pengering khusus.', 'info' => '/pasang', 'price' => 'Rp40.000'],
        ], 'note' => 'Minimal 3 kg untuk layanan kiloan. Gratis antar jemput untuk 5 kg ke atas.', 'order_button' => 'yes']];

        $steps = ['type' => 'steps', 'data' => ['title' => 'Cara pesan', 'subtitle' => 'Cucian beres tanpa keluar rumah.', 'items' => [
            ['title' => 'Chat WhatsApp', 'text' => 'Kirim alamat dan jam jemput.'],
            ['title' => 'Kami jemput', 'text' => 'Kurir datang dan menimbang cucian.'],
            ['title' => 'Dicuci bersih', 'text' => 'Dipisah per pelanggan, deterjen lembut.'],
            ['title' => 'Diantar rapi', 'text' => 'Cucian wangi dan terlipat sampai rumah.'],
        ]]];

        return [
            ['title' => 'Beranda', 'slug' => 'beranda', 'is_home' => true, 'sections' => [
                ['type' => 'hero', 'data' => [
                    'eyebrow' => 'Gratis antar jemput',
                    'title' => 'Cucian *bersih wangi*, waktu Anda lebih lega',
                    'subtitle' => "{$company} melayani laundry kiloan, satuan, dan dry clean. Dijemput dan diantar langsung ke rumah atau kos Anda.",
                    'button_label' => 'Lihat Harga', 'button_url' => '/harga',
                    'button2_label' => 'Cara Pesan', 'button2_url' => '/harga',
                    'image' => 'demo/laundry-hero.jpg',
                ]],
                ['type' => 'stats', 'data' => ['items' => [
                    ['value' => 'Rp8rb', 'label' => 'Mulai per kg'],
                    ['value' => '6 jam', 'label' => 'Layanan kilat'],
                    ['value' => '15rb+', 'label' => 'Pelanggan'],
                    ['value' => '100%', 'label' => 'Garansi cuci ulang'],
                ]]],
                ['type' => 'services', 'data' => ['title' => 'Layanan kami', 'items' => [
                    ['title' => 'Laundry kiloan', 'text' => 'Pakaian harian dicuci, dikeringkan, dan disetrika rapi.', 'image' => 'demo/laundry-iron.jpg'],
                    ['title' => 'Laundry satuan', 'text' => 'Bed cover, gorden, jas, dan kebaya dengan perawatan khusus.', 'image' => 'demo/laundry-fold.jpg'],
                    ['title' => 'Mesin modern', 'text' => 'Mesin cuci dan pengering kapasitas besar, air bersih tersaring.', 'image' => 'demo/laundry-wash.jpg'],
                ]]],
                $steps,
                ['type' => 'testimonials', 'data' => ['title' => 'Kata pelanggan', 'items' => [
                    ['quote' => 'Dijemput pagi, sore sudah wangi dan rapi. Penyelamat anak kos!', 'name' => 'Rani', 'role' => 'Mahasiswi'],
                    ['quote' => 'Bed cover jadi seperti baru. Harganya juga bersahabat.', 'name' => 'Pak Hendra', 'role' => 'Pelanggan rumah tangga'],
                    ['quote' => 'Langganan untuk seragam karyawan kafe kami, selalu tepat waktu.', 'name' => 'Lia', 'role' => 'Pemilik kafe'],
                ]]],
                ['type' => 'cta', 'data' => ['title' => 'Tumpukan cucian? Biar kami yang urus', 'text' => 'Chat sekarang, kurir kami siap menjemput hari ini.', 'button_label' => 'Jemput Cucian', 'button_url' => '/kontak']],
            ]],
            ['title' => 'Harga', 'slug' => 'harga', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Harga & Cara Pesan', 'subtitle' => 'Transparan, tanpa biaya tersembunyi.']],
                $prices,
                $steps,
                ['type' => 'faq', 'data' => ['title' => 'Pertanyaan umum', 'items' => [
                    ['question' => 'Apakah cucian dicampur dengan pelanggan lain?', 'answer' => 'Tidak. Setiap pelanggan dicuci terpisah dalam satu mesin.'],
                    ['question' => 'Bagaimana kalau ada pakaian rusak atau hilang?', 'answer' => 'Kami ganti sesuai ketentuan. Setiap cucian dicatat jumlahnya saat penjemputan.'],
                ]]],
            ]],
            ['title' => 'Tentang', 'slug' => 'tentang', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Tentang Kami', 'subtitle' => 'Laundry rumahan dengan standar profesional.']],
                ['type' => 'image_text', 'data' => ['title' => 'Cucian Anda kami perlakukan seperti milik sendiri', 'body' => "{$company} berdiri untuk membantu keluarga, mahasiswa, dan pekerja sibuk punya waktu lebih banyak.\n\n- Deterjen ramah kulit\n- Air bersih tersaring\n- Setrika uap untuk hasil rapi", 'image' => 'demo/laundry-shop.jpg', 'image_position' => 'right']],
            ]],
            ['title' => 'Kontak', 'slug' => 'kontak', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Hubungi Kami', 'subtitle' => 'Buka setiap hari 07.00–21.00.']],
                ['type' => 'contact', 'data' => ['title' => 'Pesan antar jemput', 'text' => 'Tulis alamat dan jam jemput yang Anda mau.', 'show_form' => 'yes']],
            ]],
        ];
    }
}
