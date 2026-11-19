<?php

namespace App\Sections;

/**
 * Sample pages for the Toko Online UMKM template: a home kitchen selling frozen food, sambal and
 * cookies, with WhatsApp ordering, shipping info and a reseller programme.
 */
class SmallShopContent
{
    /**
     * @return list<array<string, mixed>>
     */
    public static function pages(string $company): array
    {
        $products = ['type' => 'pricelist', 'data' => ['title' => 'Produk kami', 'subtitle' => 'Dibuat setiap hari tanpa pengawet. Klik pesan, langsung terhubung ke WhatsApp.', 'items' => [
            ['name' => 'Sambal bawang botol', 'description' => 'Pedas gurih, tahan 3 bulan', 'info' => '200 gr', 'price' => 'Rp35.000', 'image' => 'demo/umkm-sambal.jpg'],
            ['name' => 'Sate ayam frozen', 'description' => 'Isi 20 tusuk + bumbu kacang', 'info' => 'beku', 'price' => 'Rp65.000', 'image' => 'demo/umkm-sate.jpg'],
            ['name' => 'Tahu bakso frozen', 'description' => 'Isi 10, tinggal goreng', 'info' => 'beku', 'price' => 'Rp40.000', 'image' => 'demo/umkm-hero.jpg'],
            ['name' => 'Kue kering nastar', 'description' => 'Selai nanas asli, mentega premium', 'info' => '500 gr', 'price' => 'Rp95.000', 'image' => 'demo/umkm-kue.jpg'],
            ['name' => 'Cookies cokelat', 'description' => 'Renyah di luar, lembut di dalam', 'info' => 'toples', 'price' => 'Rp75.000', 'image' => 'demo/umkm-toples.jpg'],
            ['name' => 'Paket nasi bakar', 'description' => 'Isi 5, cocok untuk arisan', 'info' => 'beku', 'price' => 'Rp85.000', 'image' => 'demo/umkm-nasi.jpg'],
        ], 'note' => 'Produk beku dikirim dengan kotak styrofoam dan ice gel.', 'order_button' => 'yes']];

        $order = ['type' => 'steps', 'data' => ['title' => 'Cara pesan', 'items' => [
            ['title' => 'Pilih produk', 'text' => 'Klik tombol pesan pada produk yang Anda mau.'],
            ['title' => 'Chat WhatsApp', 'text' => 'Kirim alamat lengkap, kami hitung ongkirnya.'],
            ['title' => 'Transfer', 'text' => 'Bayar lewat transfer bank, QRIS, atau e-wallet.'],
            ['title' => 'Paket dikirim', 'text' => 'Dikirim hari yang sama untuk pesanan sebelum pukul 14.00.'],
        ]]];

        return [
            ['title' => 'Beranda', 'slug' => 'beranda', 'is_home' => true, 'sections' => [
                ['type' => 'hero', 'data' => [
                    'eyebrow' => 'Masakan rumahan · Kirim ke seluruh Indonesia',
                    'title' => 'Enaknya masakan rumah, *sampai di depan pintu*',
                    'subtitle' => "{$company} membuat frozen food, sambal, dan kue kering dari dapur sendiri. Tanpa pengawet, halal, dan dikirim hari ini.",
                    'button_label' => 'Belanja Sekarang', 'button_url' => '/produk',
                    'button2_label' => 'Jadi Reseller', 'button2_url' => '/reseller',
                    'image' => 'demo/umkm-hero.jpg',
                ]],
                ['type' => 'stats', 'data' => ['items' => [
                    ['value' => 'Halal', 'label' => 'Bersertifikat MUI'],
                    ['value' => '5.000+', 'label' => 'Pesanan terkirim'],
                    ['value' => '4,9★', 'label' => 'Rating marketplace'],
                    ['value' => '1 hari', 'label' => 'Kirim Jabodetabek'],
                ]]],
                $products,
                ['type' => 'image_text', 'data' => ['title' => 'Dari dapur kami, bukan pabrik', 'body' => "Semua produk dimasak dalam jumlah kecil setiap hari dengan bahan segar dari pasar. Resepnya warisan keluarga sejak 1998.\n\n- Tanpa MSG berlebih dan tanpa pengawet\n- Dikemas vakum agar awet\n- Izin PIRT dan sertifikat halal", 'image' => 'demo/umkm-rempah.jpg', 'image_position' => 'left']],
                $order,
                ['type' => 'testimonials', 'data' => ['title' => 'Kata pelanggan', 'items' => [
                    ['quote' => 'Sambalnya nagih! Sudah repeat order 5 kali.', 'name' => 'Dewi', 'role' => 'Jakarta'],
                    ['quote' => 'Sate frozen sampai Medan masih beku. Rasanya seperti beli di warung.', 'name' => 'Hendra', 'role' => 'Medan'],
                    ['quote' => 'Nastar untuk Lebaran selalu pesan di sini, keluarga suka semua.', 'name' => 'Bu Tini', 'role' => 'Bandung'],
                ]]],
                ['type' => 'cta', 'data' => ['title' => 'Lapar? Pesan sekarang', 'text' => 'Gratis ongkir untuk pembelian di atas Rp200.000 area Jabodetabek.', 'button_label' => 'Pesan via WhatsApp', 'button_url' => '/kontak']],
            ]],
            ['title' => 'Produk', 'slug' => 'produk', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Semua Produk', 'subtitle' => 'Stok terbatas setiap hari, pesan lebih awal.']],
                $products,
                $order,
                ['type' => 'faq', 'data' => ['title' => 'Pengiriman', 'items' => [
                    ['question' => 'Apakah frozen food bisa dikirim ke luar kota?', 'answer' => 'Bisa, dengan ekspedisi kilat 1–2 hari dan kemasan styrofoam berisi ice gel.'],
                    ['question' => 'Berapa lama produk tahan?', 'answer' => 'Frozen food tahan 3 bulan di freezer. Sambal botol tahan 3 bulan, kue kering 2 bulan.'],
                    ['question' => 'Apakah ada di marketplace?', 'answer' => 'Ada, tapi harga di website dan WhatsApp lebih hemat.'],
                ]]],
            ]],
            ['title' => 'Reseller', 'slug' => 'reseller', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Program Reseller', 'subtitle' => 'Mulai jualan tanpa modal besar dan tanpa produksi sendiri.', 'image' => 'demo/umkm-stoples.jpg']],
                ['type' => 'plans', 'data' => ['title' => 'Pilih level', 'subtitle' => 'Diskon dihitung dari harga jual di website.', 'items' => [
                    ['name' => 'Reseller', 'badge' => '', 'price' => '15%', 'old_price' => '', 'info' => 'minimal belanja Rp500rb', 'features' => "Diskon 15%\nFoto produk & caption\nGrup WhatsApp reseller", 'highlight' => 'no'],
                    ['name' => 'Agen', 'badge' => 'Paling untung', 'price' => '25%', 'old_price' => '', 'info' => 'minimal belanja Rp2jt', 'features' => "Diskon 25%\nPrioritas stok\nFreezer box pinjaman\nNama Anda di daftar agen", 'highlight' => 'yes'],
                    ['name' => 'Distributor', 'badge' => '', 'price' => '35%', 'old_price' => '', 'info' => 'minimal belanja Rp10jt', 'features' => "Diskon 35%\nWilayah eksklusif\nDukungan promosi\nTempo pembayaran", 'highlight' => 'no'],
                ]]],
                ['type' => 'cta', 'data' => ['title' => 'Daftar jadi reseller', 'text' => 'Isi nama dan kota Anda, admin kami kirim katalog dan daftar harga khusus.', 'button_label' => 'Daftar Sekarang', 'button_url' => '/kontak']],
            ]],
            ['title' => 'Kontak', 'slug' => 'kontak', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Hubungi Kami', 'subtitle' => 'Pesan, tanya stok, atau daftar reseller.']],
                ['type' => 'contact', 'data' => ['title' => 'Kirim pesanan', 'text' => 'Tulis produk, jumlah, dan alamat lengkap. Kami balas dengan total harga dan ongkir.', 'show_form' => 'yes']],
            ]],
        ];
    }
}
