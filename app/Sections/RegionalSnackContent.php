<?php

namespace App\Sections;

/**
 * Sample pages for the Oleh-oleh & Frozen Food template: product catalogue with prices, reseller
 * and agent tiers, out-of-town frozen shipping (styrofoam + ice gel), pre-order schedule and the
 * halal/PIRT note.
 */
class RegionalSnackContent
{
    /**
     * @return list<array<string, mixed>>
     */
    public static function pages(string $company): array
    {
        $products = ['type' => 'pricelist', 'data' => ['title' => 'Produk andalan', 'subtitle' => 'Dibuat di dapur sendiri setiap hari, tanpa pengawet dan pewarna buatan.', 'items' => [
            ['name' => 'Dimsum Ayam Udang', 'description' => 'Frozen, tinggal kukus 15 menit', 'info' => 'isi 20', 'price' => 'Rp55.000', 'image' => 'demo/oleholeh-dimsum.jpg'],
            ['name' => 'Pastel Abon Frozen', 'description' => 'Kulit renyah, isi abon sapi pedas manis', 'info' => 'isi 10', 'price' => 'Rp45.000', 'image' => 'demo/oleholeh-pastel.jpg'],
            ['name' => 'Pangsit Isi Ayam', 'description' => 'Frozen, enak digoreng atau direbus kuah', 'info' => 'isi 25', 'price' => 'Rp40.000', 'image' => 'demo/oleholeh-frozen.jpg'],
            ['name' => 'Keripik Singkong Balado', 'description' => 'Pedas manis khas kampung kami', 'info' => '250 gr', 'price' => 'Rp25.000', 'image' => 'demo/oleholeh-keripik.jpg'],
            ['name' => 'Kerupuk Bawang Warna', 'description' => 'Mentah, goreng sendiri di rumah', 'info' => '500 gr', 'price' => 'Rp32.000', 'image' => 'demo/oleholeh-kerupuk.jpg'],
            ['name' => 'Toples Kue Kering Campur', 'description' => 'Rempeyek, kerupuk, dan kue bawang', 'info' => '1 toples', 'price' => 'Rp65.000', 'image' => 'demo/oleholeh-toples.jpg'],
        ], 'note' => 'Halal MUI dan PIRT No. 2063374010123-29. Harga belum termasuk ongkir.', 'order_button' => 'yes']];

        $po = ['type' => 'pricelist', 'data' => ['title' => 'Jadwal PO frozen', 'subtitle' => 'Frozen food dibuat sesuai pesanan supaya selalu segar saat dikirim.', 'items' => [
            ['name' => 'Batch Senin', 'description' => 'Masak Minggu, kirim Senin pagi', 'info' => 'tutup Sabtu 20.00', 'price' => 'Kirim Senin', 'image' => ''],
            ['name' => 'Batch Kamis', 'description' => 'Masak Rabu, kirim Kamis pagi', 'info' => 'tutup Selasa 20.00', 'price' => 'Kirim Kamis', 'image' => ''],
            ['name' => 'Keripik & kerupuk', 'description' => 'Selalu ready stock, tanpa PO', 'info' => 'setiap hari', 'price' => 'Ready', 'image' => ''],
            ['name' => 'Hampers Lebaran & Natal', 'description' => 'Pesan paling lambat 2 minggu sebelumnya', 'info' => 'kuota terbatas', 'price' => 'PO khusus', 'image' => ''],
        ], 'note' => 'Pengiriman frozen tidak dilakukan hari Jumat–Sabtu supaya paket tidak menginap di gudang ekspedisi.', 'order_button' => 'no']];

        $tiers = ['type' => 'plans', 'data' => ['title' => 'Harga reseller & agen', 'subtitle' => 'Jual lagi dengan merek kami atau tanpa label. Untung mulai 20%.', 'items' => [
            ['name' => 'Reseller', 'badge' => '', 'price' => 'diskon 15%', 'old_price' => '', 'info' => 'min. belanja Rp300rb', 'features' => "Boleh campur produk\nFoto produk dan caption siap pakai\nTanpa biaya pendaftaran", 'highlight' => 'no'],
            ['name' => 'Agen', 'badge' => 'Paling untung', 'price' => 'diskon 25%', 'old_price' => '', 'info' => 'min. belanja Rp1,5jt', 'features' => "Semua keuntungan reseller\nWilayah dijaga, tidak bentrok\nPrioritas kuota PO\nFreezer pinjaman untuk agen aktif", 'highlight' => 'yes'],
            ['name' => 'Distributor', 'badge' => '', 'price' => 'diskon 35%', 'old_price' => '', 'info' => 'min. belanja Rp5jt', 'features' => "Harga khusus per kota\nBisa tanpa label (polos)\nOngkir kargo dibantu\nPendampingan promosi", 'highlight' => 'no'],
        ], 'note' => 'Diskon dari harga ecer. Belanja pertama boleh dicicil 2 kali untuk agen.']];

        return [
            ['title' => 'Beranda', 'slug' => 'beranda', 'is_home' => true, 'sections' => [
                ['type' => 'hero', 'data' => [
                    'eyebrow' => 'Oleh-oleh khas & frozen food rumahan',
                    'title' => 'Rasa kampung halaman, *dikirim beku sampai rumah*',
                    'subtitle' => "{$company} membuat jajanan, keripik, dan frozen food dari resep keluarga. Dikemas styrofoam dan ice gel, aman dikirim ke luar kota.",
                    'button_label' => 'Lihat Produk', 'button_url' => '/produk',
                    'button2_label' => 'Gabung Reseller', 'button2_url' => '/reseller',
                    'image' => 'demo/oleholeh-hero.jpg',
                ]],
                ['type' => 'services', 'data' => ['title' => 'Mau cari apa hari ini?', 'items' => [
                    ['title' => 'Frozen food', 'text' => 'Dimsum, pastel, pangsit, dan risol. Tinggal kukus atau goreng.', 'image' => 'demo/oleholeh-frozen.jpg'],
                    ['title' => 'Keripik & kerupuk', 'text' => 'Camilan kering tahan lama, pas untuk oleh-oleh dan stok rumah.', 'image' => 'demo/oleholeh-keripik.jpg'],
                    ['title' => 'Hampers & toples', 'text' => 'Paket kue kering dan camilan untuk Lebaran, Natal, dan acara kantor.', 'image' => 'demo/oleholeh-toples.jpg'],
                ]]],
                $products,
                ['type' => 'image_text', 'data' => [
                    'title' => 'Dikirim beku, sampai tetap beku',
                    'body' => "Frozen food kami kemas di kotak styrofoam tebal dengan ice gel, lalu dilapis kardus. Aman sampai 2 hari perjalanan.\n\n- Ekspedisi khusus frozen untuk Jawa dan Bali\n- Luar pulau lewat kargo udara, sampai 1–2 hari\n- Paket rusak atau mencair? Kirim video unboxing, kami ganti",
                    'image' => 'demo/oleholeh-kemasan.jpg', 'image_position' => 'right',
                    'button_label' => 'Info pengiriman', 'button_url' => '/pengiriman',
                ]],
                $po,
                ['type' => 'testimonials', 'data' => ['title' => 'Kata pembeli', 'items' => [
                    ['quote' => 'Pesan dimsum dari Jakarta, sampai Balikpapan masih beku. Rasanya persis seperti beli langsung di sana.', 'name' => 'Mbak Laras', 'role' => 'Frozen food, kirim luar pulau'],
                    ['quote' => 'Jadi agen sejak tahun lalu. Produknya cepat habis di warung, admin juga sigap kalau ditanya.', 'name' => 'Bu Endah', 'role' => 'Agen Sidoarjo'],
                    ['quote' => 'Keripik baladonya bikin nagih. Selalu jadi oleh-oleh wajib kalau pulang kampung.', 'name' => 'Dimas', 'role' => 'Pelanggan setia'],
                ]]],
                ['type' => 'cta', 'data' => ['title' => 'PO batch Senin tutup Sabtu jam 8 malam', 'text' => 'Kirim daftar pesanan dan kota tujuan, kami hitungkan ongkirnya.', 'button_label' => 'Pesan via WhatsApp', 'button_url' => '/kontak']],
            ]],
            ['title' => 'Produk', 'slug' => 'produk', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Semua Produk', 'subtitle' => 'Frozen food, keripik, kerupuk, dan hampers. Halal dan ber-PIRT.', 'image' => 'demo/oleholeh-toples.jpg']],
                $products,
                ['type' => 'pricelist', 'data' => ['title' => 'Paket hemat', 'items' => [
                    ['name' => 'Paket Sarapan Frozen', 'description' => 'Dimsum 20 + pastel 10 + pangsit 25', 'info' => 'hemat Rp15rb', 'price' => 'Rp125.000', 'image' => ''],
                    ['name' => 'Paket Oleh-oleh', 'description' => '3 keripik + 2 kerupuk + 1 toples kue', 'info' => 'hemat Rp20rb', 'price' => 'Rp185.000', 'image' => ''],
                    ['name' => 'Hampers Kantor', 'description' => 'Box kayu, 6 jenis camilan, kartu ucapan', 'info' => 'min. 10 box', 'price' => 'Rp175.000/box', 'image' => ''],
                ], 'note' => '', 'order_button' => 'yes']],
            ]],
            ['title' => 'Reseller', 'slug' => 'reseller', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Jadi Reseller & Agen', 'subtitle' => 'Modal kecil, produk sudah dikenal, dan dibantu promosi.', 'image' => 'demo/oleholeh-frozen.jpg']],
                $tiers,
                ['type' => 'steps', 'data' => ['title' => 'Cara bergabung', 'items' => [
                    ['title' => 'Chat admin', 'text' => 'Kirim nama, kota, dan pilihan reseller atau agen.'],
                    ['title' => 'Dapat katalog', 'text' => 'Kami kirim daftar harga, foto, dan caption jualan.'],
                    ['title' => 'Belanja pertama', 'text' => 'Penuhi minimal belanja sesuai level yang dipilih.'],
                    ['title' => 'Mulai jualan', 'text' => 'Masuk grup reseller untuk info PO dan promo terbaru.'],
                ]]],
                ['type' => 'faq', 'data' => ['title' => 'Pertanyaan reseller', 'items' => [
                    ['question' => 'Apakah harus punya freezer?', 'answer' => 'Untuk frozen food, ya. Reseller tanpa freezer bisa mulai dari keripik dan kerupuk yang tahan lama.'],
                    ['question' => 'Bisa dropship?', 'answer' => 'Bisa untuk keripik dan kerupuk. Kami kirim atas nama toko Anda tanpa nota harga.'],
                    ['question' => 'Boleh jual di marketplace?', 'answer' => 'Boleh, asal tidak di bawah harga ecer yang kami tetapkan supaya sesama reseller tidak saling banting harga.'],
                ]]],
            ]],
            ['title' => 'Pengiriman', 'slug' => 'pengiriman', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Pengiriman & Jadwal PO', 'subtitle' => 'Kirim ke seluruh Indonesia. Frozen food dikemas khusus supaya tetap beku.', 'image' => 'demo/oleholeh-kemasan.jpg']],
                $po,
                ['type' => 'services', 'data' => ['title' => 'Kemasan frozen kami', 'items' => [
                    ['title' => 'Styrofoam tebal', 'text' => 'Kotak 2 cm menahan suhu dingin lebih lama, ukuran sesuai pesanan.', 'image' => ''],
                    ['title' => 'Ice gel', 'text' => 'Lebih tahan lama dari es batu dan tidak membuat paket basah.', 'image' => ''],
                    ['title' => 'Kardus & label', 'text' => 'Dilapis kardus dan diberi label FROZEN supaya ditangani hati-hati.', 'image' => ''],
                ]]],
                ['type' => 'pricelist', 'data' => ['title' => 'Perkiraan ongkir frozen', 'subtitle' => 'Untuk paket 3 kg dari kota kami. Ongkir pasti dihitung admin.', 'items' => [
                    ['name' => 'Dalam kota', 'description' => 'Kurir instan, sampai di hari yang sama', 'info' => '2–4 jam', 'price' => 'mulai Rp15.000', 'image' => ''],
                    ['name' => 'Jawa & Bali', 'description' => 'Ekspedisi frozen, termasuk styrofoam dan ice gel', 'info' => '1–2 hari', 'price' => 'mulai Rp45.000', 'image' => ''],
                    ['name' => 'Sumatra, Kalimantan, Sulawesi', 'description' => 'Kargo udara', 'info' => '1–2 hari', 'price' => 'mulai Rp95.000', 'image' => ''],
                    ['name' => 'Keripik & kerupuk', 'description' => 'Ekspedisi reguler, ke seluruh Indonesia', 'info' => '2–5 hari', 'price' => 'sesuai berat', 'image' => ''],
                ], 'note' => 'Biaya kemasan styrofoam + ice gel Rp15.000 per paket.', 'order_button' => 'no']],
            ]],
            ['title' => 'Kontak', 'slug' => 'kontak', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Pesan & Ambil di Toko', 'subtitle' => 'Toko buka setiap hari 08.00–20.00. Pesan dulu lewat WhatsApp supaya siap saat diambil.', 'image' => 'demo/oleholeh-hero.jpg']],
                ['type' => 'contact', 'data' => ['title' => 'Kirim pesanan', 'text' => 'Tulis produk dan jumlahnya, alamat lengkap, dan batch PO yang dipilih. Admin balas dengan total dan ongkir.', 'show_form' => 'yes']],
            ]],
        ];
    }
}
