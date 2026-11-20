<?php

namespace App\Sections;

/**
 * Sample pages for the Pertanian & Peternakan template: seasonal produce with prices, harvest
 * capacity, supply to restaurants and markets, farmer partnership and farm visits.
 */
class FarmContent
{
    /**
     * @return list<array<string, mixed>>
     */
    public static function pages(string $company): array
    {
        $products = ['type' => 'pricelist', 'data' => ['title' => 'Hasil panen minggu ini', 'subtitle' => 'Dipetik dan dikemas pagi hari, sampai di dapur Anda siang harinya.', 'items' => [
            ['name' => 'Selada & pakcoy hidroponik', 'description' => 'Bebas pestisida, akar masih utuh agar tahan lama.', 'info' => 'panen tiap hari', 'price' => 'Rp28.000/kg', 'image' => 'demo/tani-hidroponik.jpg'],
            ['name' => 'Telur ayam kampung', 'description' => 'Dari ayam umbaran pakan jagung. Isi 30 butir per peti.', 'info' => '600 butir/hari', 'price' => 'Rp75.000/peti', 'image' => 'demo/tani-telur.jpg'],
            ['name' => 'Sayur campur untuk resto', 'description' => 'Tomat, cabai, buncis, terong, dan daun bawang sesuai pesanan.', 'info' => 'min. 10 kg', 'price' => 'mulai Rp18.000/kg', 'image' => 'demo/tani-sayur.jpg'],
            ['name' => 'Bibit ikan nila merah', 'description' => 'Ukuran 5–7 cm, sehat dan sudah adaptasi kolam terpal.', 'info' => 'stok 20.000 ekor', 'price' => 'Rp350/ekor', 'image' => 'demo/tani-ikan.jpg'],
            ['name' => 'Kambing qurban', 'description' => 'Kambing Jawa & etawa, sehat bersertifikat dokter hewan, bobot 25–40 kg.', 'info' => 'pesan dari sekarang', 'price' => 'mulai Rp3.200.000', 'image' => 'demo/tani-kambing.jpg'],
            ['name' => 'Sapi qurban', 'description' => 'Sapi bali & PO, bobot 250–400 kg. Gratis antar dan perawatan sampai hari H.', 'info' => 'bisa patungan 7 orang', 'price' => 'mulai Rp21.500.000', 'image' => 'demo/tani-sapi.jpg'],
        ], 'note' => 'Harga bisa berubah mengikuti musim. Harga khusus untuk langganan mingguan.', 'order_button' => 'yes']];

        $partnership = ['type' => 'plans', 'data' => ['title' => 'Program kemitraan petani', 'subtitle' => 'Kami sediakan bibit, pendampingan, dan membeli hasil panen dengan harga yang disepakati di awal.', 'items' => [
            ['name' => 'Mitra Hidroponik', 'badge' => '', 'price' => 'Rp12jt', 'old_price' => '', 'info' => 'instalasi 500 lubang tanam', 'features' => "Instalasi NFT & greenhouse mini\nBibit dan nutrisi 2 bulan pertama\nPelatihan 3 hari di kebun kami\nHasil panen dibeli Rp18.000/kg", 'highlight' => 'no'],
            ['name' => 'Mitra Ayam Kampung', 'badge' => 'Paling diminati', 'price' => 'Rp8,5jt', 'old_price' => '', 'info' => '100 ekor ayam siap telur', 'features' => "Ayam umur 5 bulan & kandang\nPakan bulan pertama\nVaksin & cek rutin mantri hewan\nTelur dibeli Rp2.200/butir\nKontrak minimal 1 tahun", 'highlight' => 'yes'],
            ['name' => 'Mitra Kolam Nila', 'badge' => '', 'price' => 'Rp6jt', 'old_price' => '', 'info' => '2 kolam terpal Ø 3 m', 'features' => "Kolam, aerator & 4.000 bibit\nJadwal pakan dan cek air\nPanen dibeli harga pasar\nPendampingan sampai panen pertama", 'highlight' => 'no'],
        ], 'note' => 'Bisa dicicil lewat koperasi mitra. Survei lokasi gratis untuk wilayah Kabupaten Malang dan sekitarnya.']];

        $visit = ['type' => 'pricelist', 'data' => ['title' => 'Paket edu-wisata', 'subtitle' => 'Belajar bertani langsung di kebun. Cocok untuk TK, SD, komunitas, dan keluarga.', 'items' => [
            ['name' => 'Petik sayur & tanam bibit', 'description' => 'Keliling greenhouse, menanam bibit di pot, dan membawa pulang sayur yang dipetik sendiri.', 'info' => '2 jam', 'price' => 'Rp45.000/anak', 'image' => ''],
            ['name' => 'Beri makan ternak', 'description' => 'Memberi makan kambing dan ayam, mengambil telur, dan memerah susu kambing etawa.', 'info' => '2 jam', 'price' => 'Rp50.000/anak', 'image' => ''],
            ['name' => 'Paket satu hari lengkap', 'description' => 'Semua kegiatan, tangkap ikan di kolam, makan siang nasi liwet, dan sertifikat petani cilik.', 'info' => '08.00–14.00', 'price' => 'Rp95.000/anak', 'image' => ''],
            ['name' => 'Kunjungan keluarga', 'description' => 'Datang hari Minggu tanpa reservasi, termasuk satu ikat sayur.', 'info' => 'Minggu 08.00–12.00', 'price' => 'Rp25.000/orang', 'image' => ''],
        ], 'note' => 'Minimal 20 peserta untuk rombongan sekolah. Pendamping gratis.', 'order_button' => 'yes']];

        return [
            ['title' => 'Beranda', 'slug' => 'beranda', 'is_home' => true, 'sections' => [
                ['type' => 'hero', 'data' => [
                    'eyebrow' => 'Kebun & peternakan keluarga sejak 2009',
                    'title' => 'Dari kebun kami, *segar sampai dapur Anda*',
                    'subtitle' => "{$company} menanam sayur hidroponik, beternak ayam, kambing, dan sapi, serta membudidayakan ikan. Kami memasok restoran, katering, dan pasar setiap hari.",
                    'button_label' => 'Lihat Hasil Panen', 'button_url' => '/produk',
                    'button2_label' => 'Program Kemitraan', 'button2_url' => '/kemitraan',
                    'image' => 'demo/tani-hero.jpg',
                ]],
                ['type' => 'stats', 'data' => ['title' => 'Kapasitas panen kami', 'items' => [
                    ['value' => '1,2 ton', 'label' => 'Sayur per minggu'],
                    ['value' => '600', 'label' => 'Butir telur per hari'],
                    ['value' => '350', 'label' => 'Ekor ternak qurban'],
                    ['value' => '85', 'label' => 'Petani mitra'],
                ]]],
                $products,
                ['type' => 'image_text', 'data' => ['title' => 'Pasokan rutin untuk restoran & pasar', 'body' => "Kami mengantar setiap Selasa, Kamis, dan Sabtu pagi dengan mobil berpendingin. Pesanan tetap mingguan dikunci harganya selama satu bulan.\n\n- Pengiriman Malang, Batu, dan Surabaya\n- Nota dan faktur untuk restoran & hotel\n- Bayar tempo 14 hari untuk langganan", 'image' => 'demo/tani-sayur.jpg', 'image_position' => 'left', 'button_label' => 'Minta Daftar Harga', 'button_url' => '/kontak']],
                ['type' => 'services', 'data' => ['title' => 'Yang kami kelola', 'items' => [
                    ['title' => 'Sayur hidroponik', 'text' => '4 greenhouse, 12.000 lubang tanam selada, pakcoy, kangkung, dan bayam.', 'image' => 'demo/tani-hidroponik.jpg'],
                    ['title' => 'Peternakan', 'text' => 'Ayam kampung petelur, kambing etawa, dan penggemukan sapi untuk qurban.', 'image' => 'demo/tani-kambing.jpg'],
                    ['title' => 'Kolam ikan', 'text' => 'Pembenihan nila merah dan lele untuk pembudidaya dan pemancingan.', 'image' => 'demo/tani-ikan.jpg'],
                ]]],
                ['type' => 'testimonials', 'data' => ['title' => 'Kata pelanggan & mitra', 'items' => [
                    ['quote' => 'Sayurnya selalu segar dan datang tepat jam 6 pagi. Dapur kami tidak pernah kehabisan bahan.', 'name' => 'Chef Yudi', 'role' => 'Resto Sambal Bakar, Batu'],
                    ['quote' => 'Ikut kemitraan ayam kampung, sekarang ada penghasilan tetap dari telur setiap minggu.', 'name' => 'Pak Slamet', 'role' => 'Petani mitra, Poncokusumo'],
                    ['quote' => 'Anak-anak TK senang sekali bisa memetik sayur dan memberi makan kambing.', 'name' => 'Bu Wahyuni', 'role' => 'Kepala TK Pelita'],
                ]]],
                ['type' => 'cta', 'data' => ['title' => 'Pesan qurban & langganan sayur', 'text' => 'Kambing dan sapi qurban bisa dipesan dan dititip rawat sampai Iduladha. Survei kandang kapan saja.', 'button_label' => 'Chat via WhatsApp', 'button_url' => '/kontak']],
            ]],
            ['title' => 'Produk', 'slug' => 'produk', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Hasil Tani & Ternak', 'subtitle' => 'Harga musim ini. Stok diperbarui setiap Senin.', 'image' => 'demo/tani-sawah.jpg']],
                $products,
                ['type' => 'steps', 'data' => ['title' => 'Cara pesan', 'items' => [
                    ['title' => 'Chat daftar pesanan', 'text' => 'Kirim jenis, jumlah, dan alamat lewat WhatsApp.'],
                    ['title' => 'Konfirmasi stok', 'text' => 'Kami cek hasil panen dan kirim total harga.'],
                    ['title' => 'Panen & kemas', 'text' => 'Dipetik pagi hari, ditimbang, dan dikemas.'],
                    ['title' => 'Diantar', 'text' => 'Bayar saat barang tiba atau tempo untuk langganan.'],
                ]]],
            ]],
            ['title' => 'Kemitraan', 'slug' => 'kemitraan', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Kemitraan Petani & Peternak', 'subtitle' => 'Tumbuh bersama: modal awal ringan, pendampingan, dan hasil panen pasti terjual.', 'image' => 'demo/tani-hero.jpg']],
                $partnership,
                ['type' => 'faq', 'data' => ['title' => 'Pertanyaan calon mitra', 'items' => [
                    ['question' => 'Apakah harus punya lahan sendiri?', 'answer' => 'Ya, minimal 100 m² untuk hidroponik atau kandang ayam, dan 20 m² untuk dua kolam terpal. Lahan sewa juga boleh.'],
                    ['question' => 'Bagaimana jika panen gagal?', 'answer' => 'Pendamping kami datang memeriksa. Kerugian karena bibit atau pakan dari kami diganti sesuai kontrak.'],
                    ['question' => 'Kapan hasil panen dibayar?', 'answer' => 'Setiap Sabtu untuk hasil panen yang diterima minggu itu, ditransfer ke rekening mitra.'],
                ]]],
            ]],
            ['title' => 'Edu-Wisata', 'slug' => 'edu-wisata', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Edu-Wisata Kebun', 'subtitle' => 'Belajar dari mana makanan berasal, langsung di kebun dan kandang.', 'image' => 'demo/tani-hidroponik.jpg']],
                $visit,
                ['type' => 'gallery', 'data' => ['title' => 'Suasana kebun', 'items' => [
                    ['image' => 'demo/tani-sawah.jpg', 'caption' => 'Sawah di belakang kebun'],
                    ['image' => 'demo/tani-hidroponik.jpg', 'caption' => 'Greenhouse hidroponik'],
                    ['image' => 'demo/tani-kambing.jpg', 'caption' => 'Kandang kambing etawa'],
                ]]],
            ]],
            ['title' => 'Kontak', 'slug' => 'kontak', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Hubungi Kami', 'subtitle' => 'Kebun buka Senin–Sabtu 06.00–16.00, Minggu untuk kunjungan keluarga.', 'image' => 'demo/tani-sayur.jpg']],
                ['type' => 'contact', 'data' => ['title' => 'Pesan, tanya harga, atau jadwalkan kunjungan', 'text' => 'Tulis kebutuhan Anda: jenis produk dan jumlah, rencana kemitraan, atau tanggal kunjungan rombongan.', 'show_form' => 'yes']],
            ]],
        ];
    }
}
