<?php

namespace App\Sections;

/**
 * Sample pages for the Percetakan & Advertising template: print products with prices, outdoor
 * advertising, the order flow and a portfolio.
 */
class PrintingContent
{
    /**
     * @return list<array<string, mixed>>
     */
    public static function pages(string $company): array
    {
        $prices = ['type' => 'pricelist', 'data' => ['title' => 'Daftar harga', 'subtitle' => 'Gratis desain sederhana untuk order di atas Rp200.000.', 'items' => [
            ['name' => 'Kartu nama', 'description' => 'Art carton 260 gr, 2 sisi', 'info' => 'per box', 'price' => 'Rp35.000'],
            ['name' => 'Brosur A5', 'description' => 'Art paper 120 gr, full color', 'info' => 'per 1.000 lbr', 'price' => 'Rp450.000'],
            ['name' => 'Spanduk / banner', 'description' => 'Flexi 280 gr, finishing mata ayam', 'info' => 'per m²', 'price' => 'Rp25.000'],
            ['name' => 'X-banner', 'description' => '60×160 cm termasuk stand', 'info' => 'per pcs', 'price' => 'Rp95.000'],
            ['name' => 'Stiker vinyl', 'description' => 'Cutting atau print, tahan air', 'info' => 'per m²', 'price' => 'Rp85.000'],
            ['name' => 'Sablon kaos', 'description' => 'Plastisol 1 warna, min. 12 pcs', 'info' => 'per pcs', 'price' => 'Rp65.000'],
        ], 'note' => 'Harga belum termasuk desain kompleks. Pesanan banyak dapat harga khusus.', 'order_button' => 'yes']];

        $services = ['type' => 'services', 'data' => ['title' => 'Layanan kami', 'subtitle' => 'Dari kartu nama sampai billboard.', 'items' => [
            ['title' => 'Digital printing', 'text' => 'Brosur, poster, kalender, dan undangan, bisa ditunggu.', 'image' => 'demo/cetak-press.jpg'],
            ['title' => 'Outdoor & advertising', 'text' => 'Spanduk, baliho, neon box, dan papan nama toko.', 'image' => 'demo/cetak-hero.jpg'],
            ['title' => 'Sablon & merchandise', 'text' => 'Kaos, totebag, mug, dan souvenir perusahaan.', 'image' => 'demo/cetak-sablon.jpg'],
        ]]];

        return [
            ['title' => 'Beranda', 'slug' => 'beranda', 'is_home' => true, 'sections' => [
                ['type' => 'hero', 'data' => [
                    'eyebrow' => 'Percetakan & advertising',
                    'title' => 'Cetak *cepat*, warna tajam, harga bersahabat',
                    'subtitle' => "{$company} mengerjakan digital printing, spanduk, sablon, dan media promosi untuk UMKM sampai perusahaan. Kirim file, besok jadi.",
                    'button_label' => 'Lihat Harga', 'button_url' => '/layanan',
                    'button2_label' => 'Kirim File', 'button2_url' => '/kontak',
                    'image' => 'demo/cetak-hero.jpg',
                ]],
                ['type' => 'stats', 'data' => ['items' => [
                    ['value' => '1 hari', 'label' => 'Cetak kilat'],
                    ['value' => '15rb+', 'label' => 'Order selesai'],
                    ['value' => 'Gratis', 'label' => 'Desain sederhana'],
                    ['value' => 'Antar', 'label' => 'Ke seluruh kota'],
                ]]],
                $services,
                $prices,
                ['type' => 'steps', 'data' => ['title' => 'Cara order', 'items' => [
                    ['title' => 'Kirim file / ide', 'text' => 'PDF, AI, CDR, atau cukup ceritakan idenya.'],
                    ['title' => 'Cek proof', 'text' => 'Kami kirim contoh desain untuk disetujui.'],
                    ['title' => 'Produksi', 'text' => 'Dicetak dengan mesin berkualitas.'],
                    ['title' => 'Ambil / diantar', 'text' => 'Ambil di toko atau kami antar.'],
                ]]],
                ['type' => 'cta', 'data' => ['title' => 'Punya acara atau promo minggu ini?', 'text' => 'Kirim file sekarang, pesanan sebelum jam 12 siang bisa selesai besok.', 'button_label' => 'Order via WhatsApp', 'button_url' => '/kontak']],
            ]],
            ['title' => 'Layanan', 'slug' => 'layanan', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Layanan & Harga', 'subtitle' => 'Bahan berkualitas, hasil rapi, harga jelas.', 'image' => 'demo/cetak-swatch.jpg']],
                $prices,
                $services,
            ]],
            ['title' => 'Portofolio', 'slug' => 'portofolio', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Portofolio', 'subtitle' => 'Sebagian hasil cetak untuk pelanggan kami.']],
                ['type' => 'gallery', 'data' => ['title' => 'Hasil kerja', 'items' => [
                    ['image' => 'demo/cetak-hero.jpg', 'caption' => 'Banner promosi'],
                    ['image' => 'demo/cetak-press.jpg', 'caption' => 'Brosur & majalah'],
                    ['image' => 'demo/cetak-sablon.jpg', 'caption' => 'Sablon kaos'],
                    ['image' => 'demo/cetak-potong.jpg', 'caption' => 'Cutting stiker'],
                    ['image' => 'demo/cetak-cmyk.jpg', 'caption' => 'Kontrol warna'],
                    ['image' => 'demo/cetak-swatch.jpg', 'caption' => 'Pilihan warna'],
                ]]],
                ['type' => 'clients', 'data' => ['title' => 'Dipercaya oleh', 'items' => [
                    ['name' => 'Kopi Senja', 'logo' => ''], ['name' => 'Bimbel Cerdas', 'logo' => ''], ['name' => 'Toko Maju', 'logo' => ''], ['name' => 'Klinik Sehat', 'logo' => ''],
                ]]],
            ]],
            ['title' => 'Kontak', 'slug' => 'kontak', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Order & Konsultasi', 'subtitle' => 'Buka Senin–Sabtu 08.00–21.00.']],
                ['type' => 'contact', 'data' => ['title' => 'Kirim pesanan', 'text' => 'Tulis jenis cetakan, ukuran, jumlah, dan tenggat. File bisa dikirim lewat WhatsApp.', 'show_form' => 'yes']],
            ]],
        ];
    }
}
