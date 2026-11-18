<?php

namespace App\Sections;

/**
 * Sample pages for the Properti & Perumahan template: house types, facilities, location, a KPR
 * calculator and a site visit.
 */
class PropertyContent
{
    /**
     * @return list<array<string, mixed>>
     */
    public static function pages(string $company): array
    {
        $types = [
            ['image' => 'demo/prop-type36.jpg', 'name' => 'Tipe Anggrek 36/72', 'category' => 'Cluster Anggrek', 'badge' => 'Sisa 5 unit', 'specs' => "LT 72 m²\nLB 36 m²\n2 kamar tidur\n1 kamar mandi\nCarport 1 mobil", 'price' => 'Rp485 juta'],
            ['image' => 'demo/prop-hero.jpg', 'name' => 'Tipe Melati 45/90', 'category' => 'Cluster Melati', 'badge' => 'Terlaris', 'specs' => "LT 90 m²\nLB 45 m²\n2 kamar tidur\n1 kamar mandi\nTaman depan", 'price' => 'Rp675 juta'],
            ['image' => 'demo/prop-type70.jpg', 'name' => 'Tipe Kenanga 70/120', 'category' => 'Cluster Kenanga', 'specs' => "LT 120 m²\nLB 70 m²\n3 kamar tidur\n2 kamar mandi\n2 lantai", 'price' => 'Rp1,15 miliar'],
        ];

        $facilities = [
            ['title' => 'One gate system', 'text' => 'Keamanan 24 jam dengan CCTV dan satpam.'],
            ['title' => 'Taman & jogging track', 'text' => 'Ruang hijau untuk olahraga dan bermain anak.'],
            ['title' => 'Masjid & clubhouse', 'text' => 'Fasilitas ibadah dan kolam renang di dalam kawasan.'],
            ['title' => 'Dekat akses tol', 'text' => '5 menit ke gerbang tol, dekat sekolah dan rumah sakit.'],
        ];

        $cta = ['title' => 'Kunjungi rumah contoh kami', 'text' => 'Jadwalkan survei lokasi gratis dan dapatkan promo khusus bulan ini.', 'button_label' => 'Jadwalkan Survei', 'button_url' => '/kontak'];

        return [
            ['title' => 'Beranda', 'slug' => 'beranda', 'is_home' => true, 'sections' => [
                ['type' => 'hero', 'data' => [
                    'eyebrow' => 'Hunian modern di lokasi strategis',
                    'title' => 'Rumah impian untuk keluarga yang bertumbuh',
                    'subtitle' => "{$company} menghadirkan perumahan cluster yang aman, asri, dan dekat dengan akses tol, sekolah, serta pusat belanja.",
                    'button_label' => 'Lihat Tipe Rumah', 'button_url' => '/tipe-rumah',
                    'button2_label' => 'Simulasi KPR', 'button2_url' => '/tipe-rumah',
                    'image' => 'demo/prop-hero.jpg',
                ]],
                ['type' => 'stats', 'data' => ['items' => [
                    ['value' => '25 Ha', 'label' => 'Luas kawasan'],
                    ['value' => '850+', 'label' => 'Keluarga bahagia'],
                    ['value' => '5 menit', 'label' => 'Ke gerbang tol'],
                    ['value' => 'SHM', 'label' => 'Sertifikat Hak Milik'],
                ]]],
                ['type' => 'catalog', 'data' => ['title' => 'Pilihan tipe rumah', 'subtitle' => 'Harga mulai, bisa KPR dengan DP ringan.', 'items' => $types, 'button_label' => 'Info']],
                ['type' => 'image_text', 'data' => ['title' => 'Tinggal nyaman, tumbuh bersama', 'body' => "Setiap rumah dirancang dengan sirkulasi udara dan cahaya alami yang baik, material berkualitas, dan tata ruang yang efisien untuk keluarga muda.\n\n- Sertifikat SHM dan IMB/PBG lengkap\n- Bebas banjir\n- Bisa KPR dari berbagai bank", 'image' => 'demo/prop-interior.jpg', 'image_position' => 'left']],
                ['type' => 'services', 'data' => ['title' => 'Fasilitas kawasan', 'items' => $facilities]],
                ['type' => 'testimonials', 'data' => ['title' => 'Kata penghuni', 'items' => [
                    ['quote' => 'Lingkungannya aman dan asri, anak-anak bebas bermain di taman. Proses KPR juga dibantu sampai akad.', 'name' => 'Keluarga Pratama', 'role' => 'Penghuni Cluster Melati'],
                    ['quote' => 'Lokasi dekat tol jadi berangkat kerja lebih cepat. Kualitas bangunannya rapi.', 'name' => 'Bapak Yusuf', 'role' => 'Penghuni Cluster Kenanga'],
                    ['quote' => 'Serah terima tepat waktu, sesuai yang dijanjikan di brosur.', 'name' => 'Ibu Laras', 'role' => 'Penghuni Cluster Anggrek'],
                ]]],
                ['type' => 'cta', 'data' => $cta],
            ]],
            ['title' => 'Tipe Rumah', 'slug' => 'tipe-rumah', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Tipe Rumah', 'subtitle' => 'Pilih tipe yang sesuai kebutuhan dan anggaran keluarga Anda.', 'image' => 'demo/prop-type70.jpg']],
                ['type' => 'catalog', 'data' => ['items' => $types, 'button_label' => 'Info']],
                ['type' => 'mortgage', 'data' => ['title' => 'Simulasi cicilan KPR', 'subtitle' => 'Hitung perkiraan cicilan bulanan Anda.', 'price' => '675000000', 'down_payment' => '10', 'rate' => '7.5', 'years' => '15', 'note' => 'Hasil simulasi bersifat perkiraan. Bunga dan syarat mengikuti ketentuan bank.']],
                ['type' => 'image_text', 'data' => ['title' => 'Spesifikasi bangunan', 'body' => "- Pondasi: batu kali & beton bertulang\n- Dinding: bata ringan, plester aci, cat\n- Lantai: granit 60×60\n- Kusen: aluminium\n- Atap: rangka baja ringan, genteng beton\n- Listrik: 1.300 watt · Air: PDAM", 'image' => 'demo/prop-interior.jpg', 'image_position' => 'right']],
            ]],
            ['title' => 'Fasilitas', 'slug' => 'fasilitas', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Fasilitas & Lokasi', 'subtitle' => 'Semua kebutuhan keluarga ada di dekat rumah.', 'image' => 'demo/prop-park.jpg']],
                ['type' => 'services', 'data' => ['items' => $facilities]],
                ['type' => 'gallery', 'data' => ['title' => 'Galeri kawasan', 'items' => [
                    ['image' => 'demo/prop-hero.jpg', 'caption' => 'Jalan utama cluster'],
                    ['image' => 'demo/prop-park.jpg', 'caption' => 'Taman & area bermain'],
                    ['image' => 'demo/prop-interior.jpg', 'caption' => 'Interior rumah contoh'],
                    ['image' => 'demo/prop-type36.jpg', 'caption' => 'Tipe Anggrek'],
                    ['image' => 'demo/prop-type70.jpg', 'caption' => 'Tipe Kenanga'],
                    ['image' => 'demo/prop-family.jpg', 'caption' => 'Serah terima kunci'],
                ]]],
                ['type' => 'pricelist', 'data' => ['title' => 'Jarak ke fasilitas umum', 'items' => [
                    ['name' => 'Gerbang tol', 'price' => '5 menit'],
                    ['name' => 'Sekolah & kampus', 'price' => '7 menit'],
                    ['name' => 'Rumah sakit', 'price' => '10 menit'],
                    ['name' => 'Mal & pusat belanja', 'price' => '12 menit'],
                    ['name' => 'Stasiun KRL', 'price' => '15 menit'],
                ], 'order_button' => 'no']],
            ]],
            ['title' => 'Kontak', 'slug' => 'kontak', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Jadwalkan Survei', 'subtitle' => 'Marketing gallery buka setiap hari 09.00–17.00.', 'image' => 'demo/prop-family.jpg']],
                ['type' => 'contact', 'data' => ['title' => 'Hubungi tim marketing', 'text' => 'Tinggalkan pesan untuk info harga, promo, dan jadwal kunjungan rumah contoh.', 'show_form' => 'yes']],
            ]],
        ];
    }
}
