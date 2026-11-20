<?php

namespace App\Sections;

/**
 * Sample pages for the Toko Emas & Perhiasan template: today's gold price board (a price list the
 * owner updates by hand), jewellery catalogue, buyback, custom engraving and certificates.
 */
class GoldShopContent
{
    /**
     * @return list<array<string, mixed>>
     */
    public static function pages(string $company): array
    {
        $board = ['type' => 'pricelist', 'data' => ['title' => 'Harga emas hari ini', 'subtitle' => 'Jumat, 20 November 2026 · pukul 09.00 WIB', 'items' => [
            ['name' => 'Logam mulia 24K', 'description' => 'Emas batangan bersertifikat, kadar 99,99%', 'info' => 'Buyback Rp2.190.000', 'price' => 'Rp2.315.000/gr', 'image' => ''],
            ['name' => 'Perhiasan 22K', 'description' => 'Kadar 91,6%', 'info' => 'Buyback Rp1.905.000', 'price' => 'Rp2.085.000/gr', 'image' => ''],
            ['name' => 'Perhiasan 18K', 'description' => 'Kadar 75%', 'info' => 'Buyback Rp1.540.000', 'price' => 'Rp1.720.000/gr', 'image' => ''],
            ['name' => 'Perhiasan 17K', 'description' => 'Kadar 70%, paling banyak dicari', 'info' => 'Buyback Rp1.430.000', 'price' => 'Rp1.610.000/gr', 'image' => ''],
            ['name' => 'Emas muda 9K', 'description' => 'Kadar 37,5%', 'info' => 'Buyback Rp705.000', 'price' => 'Rp845.000/gr', 'image' => ''],
        ], 'note' => 'Harga diperbarui manual oleh toko setiap pagi dan bisa berubah sewaktu-waktu. Belum termasuk ongkos bikin perhiasan.', 'order_button' => 'yes']];

        $catalog = ['type' => 'catalog', 'data' => ['title' => 'Koleksi perhiasan', 'subtitle' => 'Semua perhiasan bersurat, kadar dan berat tertulis jelas.', 'items' => [
            ['image' => 'demo/emas-cincin.jpg', 'name' => 'Cincin Permata Mungil', 'category' => 'Cincin', 'badge' => 'Baru', 'specs' => "17K\n2,1 gram\nUkuran 10–16", 'price' => 'Rp3.580.000', 'unit' => '', 'url' => ''],
            ['image' => 'demo/emas-kawin.jpg', 'name' => 'Cincin Kawin Polos', 'category' => 'Cincin', 'badge' => 'Bisa grafir', 'specs' => "18K\n4,5 gram sepasang\nGrafir nama gratis", 'price' => 'Rp8.150.000', 'unit' => '/pasang', 'url' => ''],
            ['image' => 'demo/emas-kalung.jpg', 'name' => 'Kalung Liontin Bar', 'category' => 'Kalung', 'badge' => '', 'specs' => "17K\n3,2 gram\nPanjang 45 cm", 'price' => 'Rp5.450.000', 'unit' => '', 'url' => ''],
            ['image' => 'demo/emas-gelang.jpg', 'name' => 'Gelang Keroncong Ukir', 'category' => 'Gelang', 'badge' => 'Terlaris', 'specs' => "22K\n5 gram per buah\nMotif ukir Jawa", 'price' => 'Rp11.200.000', 'unit' => '', 'url' => ''],
            ['image' => 'demo/emas-anting.jpg', 'name' => 'Anting Tambang Pilin', 'category' => 'Anting', 'badge' => '', 'specs' => "17K\n1,8 gram sepasang\nKait aman", 'price' => 'Rp3.050.000', 'unit' => '/pasang', 'url' => ''],
            ['image' => 'demo/emas-lm.jpg', 'name' => 'Logam Mulia 5 gram', 'category' => 'Logam mulia', 'badge' => 'Investasi', 'specs' => "24K · 99,99%\nBersertifikat\nKemasan segel", 'price' => 'Rp11.575.000', 'unit' => '', 'url' => ''],
        ], 'button_label' => 'Tanya']];

        $services = ['type' => 'services', 'data' => ['title' => 'Layanan toko', 'items' => [
            ['title' => 'Jual & buyback', 'text' => "Terima jual kembali emas dari toko mana pun\nDitimbang dan diuji kadar di depan Anda\nUang langsung dibayar tunai atau transfer", 'image' => ''],
            ['title' => 'Pesan custom & grafir', 'text' => "Cincin kawin, liontin nama, dan inisial\nDesain dikirim dulu sebelum dibuat\nJadi 7–14 hari kerja", 'image' => ''],
            ['title' => 'Sertifikat & surat', 'text' => "Setiap perhiasan bersurat resmi toko\nKadar, berat, dan foto tercantum\nSimpan surat untuk harga jual kembali terbaik", 'image' => ''],
            ['title' => 'Servis perhiasan', 'text' => "Patri kalung putus dan kecilkan cincin\nSepuh dan cuci perhiasan kusam\nBisa ditunggu untuk servis ringan", 'image' => ''],
        ]]];

        return [
            ['title' => 'Beranda', 'slug' => 'beranda', 'is_home' => true, 'sections' => [
                ['type' => 'hero', 'data' => [
                    'eyebrow' => 'Toko emas sejak 1987',
                    'title' => 'Perhiasan emas *berkadar jujur*, bersurat resmi',
                    'subtitle' => "{$company} menjual perhiasan dan logam mulia dengan kadar dan berat tertulis jelas. Terima jual kembali, pesan custom, dan grafir nama.",
                    'button_label' => 'Lihat Koleksi', 'button_url' => '/katalog',
                    'button2_label' => 'Harga Hari Ini', 'button2_url' => '/harga',
                    'image' => 'demo/emas-hero.jpg',
                ]],
                $board,
                $catalog,
                $services,
                ['type' => 'image_text', 'data' => [
                    'title' => 'Kadar diuji, bukan sekadar dijanjikan',
                    'body' => "Setiap perhiasan kami uji dengan alat uji kadar (XRF) sebelum dipajang. Hasilnya tertulis di surat bersama berat dan foto barang.\n\n- Timbangan digital terkalibrasi, dilihat langsung oleh pembeli\n- Surat toko berlaku untuk buyback di semua cabang\n- Potongan buyback tertulis, tidak ditentukan sesuka hati",
                    'image' => 'demo/emas-model.jpg', 'image_position' => 'left',
                    'button_label' => 'Cara jual kembali', 'button_url' => '/layanan',
                ]],
                ['type' => 'testimonials', 'data' => ['title' => 'Kata pelanggan', 'items' => [
                    ['quote' => 'Beli cincin kawin di sini, grafir nama kami rapi sekali. Suratnya lengkap, jadi tenang.', 'name' => 'Andini & Fajar', 'role' => 'Cincin kawin custom'],
                    ['quote' => 'Jual gelang lama dari toko lain tetap diterima. Ditimbang di depan saya dan harganya sesuai papan.', 'name' => 'Ibu Hartati', 'role' => 'Buyback'],
                    ['quote' => 'Rutin nabung logam mulia 1 gram tiap bulan di sini. Pelayanannya ramah dan cepat.', 'name' => 'Pak Yusuf', 'role' => 'Tabungan logam mulia'],
                ]]],
                ['type' => 'cta', 'data' => ['title' => 'Mau tanya harga atau stok?', 'text' => 'Kirim foto atau nama perhiasan yang dicari, kami balas harga sesuai berat hari ini.', 'button_label' => 'Chat Toko', 'button_url' => '/kontak']],
            ]],
            ['title' => 'Harga Emas', 'slug' => 'harga', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Harga Emas Hari Ini', 'subtitle' => 'Harga jual dan buyback per gram, diperbarui setiap pagi.', 'image' => 'demo/emas-lm.jpg']],
                $board,
                ['type' => 'steps', 'data' => ['title' => 'Cara menghitung harga perhiasan', 'items' => [
                    ['title' => 'Berat × harga per gram', 'text' => 'Contoh: cincin 17K 2 gram × Rp1.610.000 = Rp3.220.000.'],
                    ['title' => 'Tambah ongkos bikin', 'text' => 'Rp50.000–Rp150.000 per gram, tergantung tingkat kerumitan.'],
                    ['title' => 'Harga final di nota', 'text' => 'Kadar, berat, dan harga dicetak di surat pembelian.'],
                ]]],
                ['type' => 'faq', 'data' => ['title' => 'Pertanyaan seputar harga', 'items' => [
                    ['question' => 'Kenapa harga di toko berbeda dengan berita?', 'answer' => 'Harga di berita biasanya harga emas murni 24K. Perhiasan memakai kadar lebih rendah dan ada ongkos pembuatan.'],
                    ['question' => 'Berapa potongan saat jual kembali?', 'answer' => 'Harga buyback tertulis di papan setiap hari. Perhiasan tanpa surat atau rusak berat dinilai ulang setelah diuji kadar.'],
                    ['question' => 'Bisa pesan harga lewat WhatsApp?', 'answer' => 'Bisa. Harga dikunci saat pembayaran diterima pada hari yang sama.'],
                ]]],
            ]],
            ['title' => 'Katalog', 'slug' => 'katalog', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Katalog Perhiasan', 'subtitle' => 'Cincin, kalung, gelang, anting, dan logam mulia. Harga mengikuti berat dan harga hari ini.', 'image' => 'demo/emas-gelang.jpg']],
                $catalog,
                ['type' => 'gallery', 'data' => ['title' => 'Etalase kami', 'items' => [
                    ['image' => 'demo/emas-hero.jpg', 'caption' => 'Set perhiasan pengantin'],
                    ['image' => 'demo/emas-kawin.jpg', 'caption' => 'Cincin kawin polos 18K'],
                    ['image' => 'demo/emas-model.jpg', 'caption' => 'Kalung dan cincin harian'],
                ]]],
            ]],
            ['title' => 'Layanan', 'slug' => 'layanan', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Jual Beli, Custom & Servis', 'subtitle' => 'Satu tempat untuk membeli, menjual kembali, memesan, dan merawat perhiasan.', 'image' => 'demo/emas-kalung.jpg']],
                $services,
                ['type' => 'steps', 'data' => ['title' => 'Cara jual kembali (buyback)', 'items' => [
                    ['title' => 'Bawa perhiasan & surat', 'text' => 'Surat tidak wajib, tetapi harga lebih baik bila ada.'],
                    ['title' => 'Timbang & uji kadar', 'text' => 'Dilakukan di meja depan, Anda melihat sendiri hasilnya.'],
                    ['title' => 'Terima harga', 'text' => 'Harga sesuai papan buyback hari itu, tanpa tawar-menawar.'],
                    ['title' => 'Dibayar langsung', 'text' => 'Tunai atau transfer ke rekening Anda saat itu juga.'],
                ]]],
                ['type' => 'pricelist', 'data' => ['title' => 'Biaya servis', 'items' => [
                    ['name' => 'Grafir nama', 'description' => 'Bagian dalam cincin, maksimal 12 huruf', 'info' => '1 hari', 'price' => 'Rp75.000', 'image' => ''],
                    ['name' => 'Patri kalung atau gelang', 'description' => 'Sambung rantai putus', 'info' => 'ditunggu', 'price' => 'mulai Rp40.000', 'image' => ''],
                    ['name' => 'Kecilkan / besarkan cincin', 'description' => 'Hingga 3 ukuran', 'info' => '1 hari', 'price' => 'mulai Rp60.000', 'image' => ''],
                    ['name' => 'Cuci & sepuh perhiasan', 'description' => 'Kembali mengilap seperti baru', 'info' => 'ditunggu', 'price' => 'Rp35.000', 'image' => ''],
                ], 'note' => '', 'order_button' => 'no']],
            ]],
            ['title' => 'Kontak', 'slug' => 'kontak', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Kunjungi Toko', 'subtitle' => 'Buka Senin–Sabtu 08.30–17.00, Minggu 09.00–14.00.', 'image' => 'demo/emas-hero.jpg']],
                ['type' => 'contact', 'data' => ['title' => 'Tanya harga & stok', 'text' => 'Tulis perhiasan yang dicari, kadar, dan kisaran berat. Untuk pesanan custom, lampirkan contoh desain.', 'show_form' => 'yes']],
            ]],
        ];
    }
}
