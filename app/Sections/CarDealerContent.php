<?php

namespace App\Sections;

/**
 * Sample pages for the Sales Mobil template: a car dealer with a price list, credit
 * simulation, service and body repair, promos and a quote request.
 */
class CarDealerContent
{
    /**
     * @return list<array<string, mixed>>
     */
    public static function pages(string $company): array
    {
        $cars = ['type' => 'catalog', 'data' => ['title' => 'Pilihan mobil terbaru', 'subtitle' => 'Diskon terbaik, extra cashback, dan persetujuan kredit mudah.', 'button_label' => 'Tanya Promo', 'items' => [
            ['image' => 'demo/mobil-hatch.jpg', 'name' => 'City Hatchback', 'category' => 'Hatchback', 'badge' => 'Terlaris', 'specs' => "1.2L i-VTEC\nCVT / Manual\n5 penumpang", 'price' => 'Rp184.500.000', 'unit' => 'OTR'],
            ['image' => 'demo/mobil-compact.jpg', 'name' => 'Compact Crossover', 'category' => 'Crossover', 'badge' => 'Baru', 'specs' => "1.5L Turbo\nCVT\n5 penumpang", 'price' => 'Rp290.100.000', 'unit' => 'OTR'],
            ['image' => 'demo/mobil-hero.jpg', 'name' => 'SUV 7-Seater', 'category' => 'SUV', 'badge' => '', 'specs' => "1.5L Hybrid\nCVT\n7 penumpang", 'price' => 'Rp389.700.000', 'unit' => 'OTR'],
            ['image' => 'demo/mobil-mpv.jpg', 'name' => 'MPV Keluarga', 'category' => 'MPV', 'badge' => 'Promo', 'specs' => "2.0L\nCVT\n7 penumpang, pintu geser", 'price' => 'Rp637.800.000', 'unit' => 'OTR'],
            ['image' => 'demo/mobil-sedan.jpg', 'name' => 'Sedan RS', 'category' => 'Sedan', 'badge' => '', 'specs' => "1.5L Turbo\nCVT\n6 airbag, kamera 360", 'price' => 'Rp749.000.000', 'unit' => 'OTR'],
            ['image' => 'demo/mobil-pickup.jpg', 'name' => 'Pickup Niaga', 'category' => 'Niaga', 'badge' => '', 'specs' => "1.5L\nManual\nBak 1 ton", 'price' => 'Rp198.000.000', 'unit' => 'OTR'],
        ]]];

        $services = ['type' => 'services', 'data' => ['title' => 'Satu dealer, layanan lengkap', 'items' => [
            ['title' => 'Sales', 'text' => 'Temukan mobil impian dengan promo menarik dan cicilan ringan.', 'image' => 'demo/mobil-showroom.jpg'],
            ['title' => 'Service', 'text' => 'Perawatan berkala oleh teknisi bersertifikat dan suku cadang asli.', 'image' => 'demo/mobil-service.jpg'],
            ['title' => 'Body & Paint', 'text' => 'Perbaikan bodi dan cat profesional untuk semua merek.', 'image' => 'demo/mobil-paint.jpg'],
        ]]];

        $credit = ['type' => 'mortgage', 'data' => ['title' => 'Simulasi kredit mobil', 'subtitle' => 'Hitung perkiraan cicilan bulanan sebelum mengajukan kredit.', 'price' => '290100000', 'down_payment' => '20', 'rate' => '5.5', 'years' => '4', 'note' => 'Hasil simulasi bersifat perkiraan. Bunga, asuransi, dan syarat mengikuti ketentuan leasing.']];

        $perks = ['type' => 'image_text', 'data' => ['title' => 'Untung lebih banyak pesan lewat website', 'body' => "- Pembelian cash dan kredit\n- DP rendah, angsuran ringan\n- Test drive ke rumah Anda\n- Dibantu approval tanpa biaya tambahan\n- Bonus coating, kaca film, karpet, dan APAR", 'image' => 'demo/mobil-handover.jpg', 'image_position' => 'right', 'button_label' => 'Minta Penawaran', 'button_url' => '/kontak']];

        return [
            ['title' => 'Beranda', 'slug' => 'beranda', 'is_home' => true, 'sections' => [
                ['type' => 'hero', 'data' => [
                    'eyebrow' => 'Promo akhir tahun',
                    'title' => 'Mobil impian, cicilan ringan',
                    'subtitle' => "{$company}, dealer resmi dengan layanan penjualan, service, suku cadang asli, dan body repair dalam satu tempat.",
                    'button_label' => 'Lihat Pricelist', 'button_url' => '/pricelist',
                    'button2_label' => 'Simulasi Kredit', 'button2_url' => '/kredit',
                    'image' => 'demo/mobil-suv.jpg',
                ]],
                $cars,
                $services,
                $perks,
                ['type' => 'steps', 'data' => ['title' => 'Kenapa memilih kami?', 'items' => [
                    ['title' => 'Dealer resmi', 'text' => 'Salah satu dealer terbesar di kota, garansi pabrik terjamin.'],
                    ['title' => 'Kualitas asli', 'text' => 'Suku cadang dan perawatan sesuai standar pabrikan.'],
                    ['title' => 'Pelayanan terbaik', 'text' => 'Sales dan teknisi siap membantu dari pembelian hingga perawatan.'],
                ]]],
                ['type' => 'posts', 'data' => ['title' => 'Artikel & berita', 'items' => [
                    ['image' => 'demo/mobil-hatch.jpg', 'category' => 'Review', 'date' => '14 Nov 2026', 'title' => 'Keunggulan city hatchback terbaru untuk mobil pertama', 'text' => 'Irit, lincah, dan fiturnya makin lengkap.'],
                    ['image' => 'demo/mobil-paint.jpg', 'category' => 'Tips', 'date' => '6 Nov 2026', 'title' => 'Kenapa body repair resmi lebih terjamin', 'text' => 'Warna presisi dan garansi pengerjaan.'],
                    ['image' => 'demo/mobil-service.jpg', 'category' => 'Perawatan', 'date' => '28 Okt 2026', 'title' => 'Performa menurun? Saatnya tune up', 'text' => 'Tanda-tanda mobil perlu servis berkala.'],
                ]]],
                ['type' => 'cta', 'data' => ['title' => 'Dapatkan penawaran terbaik hari ini', 'text' => 'Isi data Anda, sales kami akan menghubungi dengan harga dan promo terbaru.', 'button_label' => 'Minta Penawaran', 'button_url' => '/kontak']],
            ]],
            ['title' => 'Pricelist', 'slug' => 'pricelist', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Daftar Harga Mobil', 'subtitle' => 'Harga OTR untuk kepemilikan pertama. Tanyakan promo bulan ini.']],
                $cars,
                ['type' => 'faq', 'data' => ['title' => 'Keterangan', 'items' => [
                    ['question' => 'Apakah harga sudah OTR?', 'answer' => 'Ya, harga adalah rekomendasi OTR untuk kepemilikan pertama dan dapat berubah sewaktu-waktu.'],
                    ['question' => 'Bisa tukar tambah?', 'answer' => 'Bisa. Bawa mobil lama Anda untuk ditaksir gratis oleh tim kami.'],
                    ['question' => 'Berapa lama inden?', 'answer' => 'Tergantung tipe dan warna. Banyak unit ready stock, tanyakan ke sales kami.'],
                ]]],
            ]],
            ['title' => 'Kredit', 'slug' => 'kredit', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Simulasi Kredit', 'subtitle' => 'DP rendah, tenor hingga 6 tahun, dibantu sampai disetujui.']],
                $credit,
                ['type' => 'steps', 'data' => ['title' => 'Alur pengajuan kredit', 'items' => [
                    ['title' => 'Simulasi', 'text' => 'Tentukan tipe, DP, dan tenor.'],
                    ['title' => 'Dokumen', 'text' => 'KTP, KK, NPWP, dan slip gaji atau rekening koran.'],
                    ['title' => 'Survei', 'text' => 'Leasing melakukan survei, biasanya 1–2 hari.'],
                    ['title' => 'Serah terima', 'text' => 'Mobil diantar ke rumah Anda.'],
                ]]],
            ]],
            ['title' => 'Service', 'slug' => 'service', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Service & Body Repair', 'subtitle' => 'Bengkel resmi dengan teknisi bersertifikat.']],
                $services,
                ['type' => 'pricelist', 'data' => ['title' => 'Paket servis berkala', 'items' => [
                    ['name' => 'Servis 10.000 km', 'description' => 'Ganti oli, filter oli, dan pemeriksaan umum.', 'info' => '±1 jam', 'price' => 'Rp650.000'],
                    ['name' => 'Servis 20.000 km', 'description' => 'Plus filter udara dan pembersihan rem.', 'info' => '±2 jam', 'price' => 'Rp1.150.000'],
                    ['name' => 'Spooring & balancing', 'description' => 'Kendaraan stabil, ban awet.', 'info' => '±45 menit', 'price' => 'Rp350.000'],
                    ['name' => 'Body repair per panel', 'description' => 'Ketok, dempul, dan cat oven.', 'info' => '2–3 hari', 'price' => 'Rp1.200.000'],
                ], 'note' => 'Harga dapat berbeda per tipe kendaraan.', 'order_button' => 'yes']],
            ]],
            ['title' => 'Kontak', 'slug' => 'kontak', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Minta Penawaran', 'subtitle' => 'Showroom buka Senin–Minggu 08.00–17.00.']],
                ['type' => 'contact', 'data' => ['title' => 'Dapatkan penawaran terbaik', 'text' => 'Tuliskan tipe mobil dan transmisi yang Anda minati. Sales kami segera menghubungi.', 'show_form' => 'yes']],
            ]],
        ];
    }
}
