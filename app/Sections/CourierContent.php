<?php

namespace App\Sections;

/**
 * Sample pages for the Ekspedisi & Logistik template: parcel and cargo shipping, house moving,
 * rates by destination, fleet and a pickup request.
 */
class CourierContent
{
    /**
     * @return list<array<string, mixed>>
     */
    public static function pages(string $company): array
    {
        $services = ['type' => 'services', 'data' => ['title' => 'Layanan pengiriman', 'subtitle' => 'Darat, laut, dan udara ke seluruh Indonesia.', 'items' => [
            ['title' => 'Kargo darat', 'text' => 'Kirim barang besar dan berat antarkota, hemat dan aman.', 'image' => 'demo/ekspedisi-hero.jpg'],
            ['title' => 'Jasa pindahan', 'text' => 'Pindah rumah atau kantor, termasuk packing dan bongkar muat.', 'image' => 'demo/ekspedisi-van.jpg'],
            ['title' => 'Paket UMKM', 'text' => 'Jemput paket online shop setiap hari, tarif khusus seller.', 'image' => 'demo/ekspedisi-paket.jpg'],
            ['title' => 'Pergudangan', 'text' => 'Sewa gudang harian atau bulanan, termasuk sortir dan packing.', 'image' => 'demo/ekspedisi-gudang.jpg'],
        ]]];

        $rates = ['type' => 'pricelist', 'data' => ['title' => 'Tarif kargo dari Jakarta', 'subtitle' => 'Minimal 10 kg. Estimasi waktu dihitung sejak barang dijemput.', 'items' => [
            ['name' => 'Bandung', 'description' => 'Darat · 1–2 hari', 'info' => 'per kg', 'price' => 'Rp2.500'],
            ['name' => 'Surabaya', 'description' => 'Darat · 2–3 hari', 'info' => 'per kg', 'price' => 'Rp4.500'],
            ['name' => 'Medan', 'description' => 'Darat & laut · 5–7 hari', 'info' => 'per kg', 'price' => 'Rp8.000'],
            ['name' => 'Makassar', 'description' => 'Laut · 6–8 hari', 'info' => 'per kg', 'price' => 'Rp7.500'],
            ['name' => 'Denpasar', 'description' => 'Darat · 3–4 hari', 'info' => 'per kg', 'price' => 'Rp6.000'],
            ['name' => 'Jayapura', 'description' => 'Laut · 14–18 hari', 'info' => 'per kg', 'price' => 'Rp18.000'],
        ], 'note' => 'Barang ringan tapi besar dihitung dengan berat volume (p×l×t ÷ 4.000).', 'order_button' => 'yes']];

        $fleet = ['type' => 'catalog', 'data' => ['title' => 'Armada pindahan & carter', 'subtitle' => 'Harga dalam kota, sudah termasuk sopir dan BBM.', 'button_label' => 'Sewa', 'items' => [
            ['image' => 'demo/ekspedisi-van.jpg', 'name' => 'Blind van', 'category' => 'Muatan 1 ton', 'specs' => "Pindahan kos & apartemen\nBarang tertutup aman\n1 helper", 'price' => 'Rp550.000', 'unit' => '/trip'],
            ['image' => 'demo/ekspedisi-paket.jpg', 'name' => 'Pikap / engkel box', 'category' => 'Muatan 2 ton', 'badge' => 'Terlaris', 'specs' => "Pindahan rumah tipe 36–45\nBox tertutup\n2 helper", 'price' => 'Rp950.000', 'unit' => '/trip'],
            ['image' => 'demo/ekspedisi-hero.jpg', 'name' => 'Truk fuso box', 'category' => 'Muatan 8 ton', 'specs' => "Pindahan kantor & gudang\nAntarkota tersedia\n4 helper", 'price' => 'Rp2.800.000', 'unit' => '/trip'],
        ]]];

        return [
            ['title' => 'Beranda', 'slug' => 'beranda', 'is_home' => true, 'sections' => [
                ['type' => 'hero', 'data' => [
                    'eyebrow' => 'Ekspedisi · Kargo · Pindahan',
                    'title' => 'Kirim barang ke seluruh Indonesia, *aman sampai tujuan*',
                    'subtitle' => "{$company} melayani kargo antarkota, jasa pindahan, dan pengiriman paket UMKM. Barang dijemput, diasuransikan, dan bisa dilacak.",
                    'button_label' => 'Cek Tarif', 'button_url' => '/tarif',
                    'button2_label' => 'Minta Jemput', 'button2_url' => '/kontak',
                    'image' => 'demo/ekspedisi-hero.jpg',
                ]],
                ['type' => 'stats', 'data' => ['items' => [
                    ['value' => '500+', 'label' => 'Kota tujuan'],
                    ['value' => '60', 'label' => 'Armada truk'],
                    ['value' => '99,2%', 'label' => 'Tiba tepat waktu'],
                    ['value' => '24 jam', 'label' => 'Layanan pelanggan'],
                ]]],
                $services,
                $rates,
                ['type' => 'image_text', 'data' => ['title' => 'Kenapa kirim lewat kami?', 'body' => "- Jemput gratis untuk kiriman di atas 50 kg\n- Asuransi barang sampai 100% nilai\n- Packing kayu untuk barang pecah belah\n- Nomor resi untuk melacak kiriman\n- Gudang transit di 12 kota besar", 'image' => 'demo/ekspedisi-forklift.jpg', 'image_position' => 'left', 'button_label' => 'Minta Penawaran', 'button_url' => '/kontak']],
                ['type' => 'clients', 'data' => ['title' => 'Dipercaya ratusan bisnis', 'items' => [
                    ['name' => 'Toko Elektronik Jaya'], ['name' => 'Mebel Kayu Jepara'], ['name' => 'Distributor Sembako Makmur'], ['name' => 'Online Shop Fashion'], ['name' => 'Pabrik Plastik Sentosa'], ['name' => 'Apotek Sehat Group'],
                ]]],
                ['type' => 'cta', 'data' => ['title' => 'Mau kirim barang hari ini?', 'text' => 'Kirim foto barang, kota asal, dan tujuan. Kami hitung tarifnya dalam 10 menit.', 'button_label' => 'Hitung Tarif via WhatsApp', 'button_url' => '/kontak']],
            ]],
            ['title' => 'Layanan', 'slug' => 'layanan', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Layanan', 'subtitle' => 'Satu mitra untuk semua kebutuhan kirim barang.', 'image' => 'demo/ekspedisi-rak.jpg']],
                $services,
                $fleet,
                ['type' => 'steps', 'data' => ['title' => 'Cara kirim', 'items' => [
                    ['title' => 'Hubungi kami', 'text' => 'Kirim detail barang, alamat asal, dan tujuan.'],
                    ['title' => 'Barang dijemput', 'text' => 'Kurir datang, menimbang, dan memberi nomor resi.'],
                    ['title' => 'Dalam perjalanan', 'text' => 'Lacak posisi kiriman lewat WhatsApp.'],
                    ['title' => 'Diterima', 'text' => 'Foto bukti terima dikirim kepada Anda.'],
                ]]],
            ]],
            ['title' => 'Tarif', 'slug' => 'tarif', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Tarif Pengiriman', 'subtitle' => 'Harga transparan, tanpa biaya tersembunyi.']],
                $rates,
                ['type' => 'faq', 'data' => ['title' => 'Pertanyaan umum', 'items' => [
                    ['question' => 'Bagaimana cara melacak kiriman?', 'answer' => 'Kirim nomor resi ke WhatsApp admin, kami balas posisi terakhir kiriman Anda.'],
                    ['question' => 'Apakah bisa kirim motor atau mobil?', 'answer' => 'Bisa, dengan peti kayu atau car carrier. Tanyakan tarifnya ke admin.'],
                    ['question' => 'Bagaimana jika barang rusak?', 'answer' => 'Kiriman yang diasuransikan diganti sesuai nilai barang setelah pengecekan.'],
                ]]],
            ]],
            ['title' => 'Kontak', 'slug' => 'kontak', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Minta Jemput', 'subtitle' => 'Admin siaga 24 jam, termasuk hari libur.']],
                ['type' => 'contact', 'data' => ['title' => 'Jadwalkan penjemputan', 'text' => 'Tulis jenis dan berat barang, alamat jemput, dan kota tujuan. Kami kirim tarif dan jadwal jemput.', 'show_form' => 'yes']],
            ]],
        ];
    }
}
