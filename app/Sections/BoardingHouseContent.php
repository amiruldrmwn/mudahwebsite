<?php

namespace App\Sections;

/**
 * Sample pages for the Kos-kosan & Kontrakan template: room types with monthly (and daily)
 * prices, rooms left, facilities, house rules, nearby places and survey by WhatsApp.
 */
class BoardingHouseContent
{
    /**
     * @return list<array<string, mixed>>
     */
    public static function pages(string $company): array
    {
        $rooms = ['type' => 'catalog', 'data' => ['title' => 'Pilihan kamar', 'subtitle' => 'Harga per bulan, sudah termasuk listrik token awal, air, WiFi, dan kebersihan area bersama.', 'items' => [
            ['image' => 'demo/kos-standar.jpg', 'name' => 'Kamar Standar', 'category' => 'Kos putri · 3×3 m', 'badge' => 'Sisa 2 kamar', 'specs' => "Kipas angin\nKasur & lemari\nKamar mandi luar\nWiFi 50 Mbps", 'price' => 'Rp850rb', 'unit' => '/bulan'],
            ['image' => 'demo/kos-single.jpg', 'name' => 'Kamar AC', 'category' => 'Kos putri · 3×4 m', 'badge' => 'Sisa 1 kamar', 'specs' => "AC 1/2 PK\nKamar mandi dalam\nMeja belajar\nWiFi 50 Mbps", 'price' => 'Rp1,35jt', 'unit' => '/bulan'],
            ['image' => 'demo/kos-eksklusif.jpg', 'name' => 'Kamar Eksklusif', 'category' => 'Kos putri · 4×4 m', 'badge' => 'Penuh, inden', 'specs' => "AC & water heater\nSpring bed 160\nKulkas mini\nListrik termasuk", 'price' => 'Rp1,9jt', 'unit' => '/bulan'],
        ], 'button_label' => 'Tanya Kamar']];

        $facilities = ['type' => 'services', 'data' => ['title' => 'Fasilitas kos', 'subtitle' => 'Semua yang dibutuhkan untuk kuliah dan kerja, tanpa repot.', 'items' => [
            ['title' => 'WiFi 50 Mbps', 'text' => 'Fiber optik, kuat sampai lantai 3. Cocok untuk kuliah daring dan rapat online.', 'image' => ''],
            ['title' => 'Dapur bersama', 'text' => 'Kompor, kulkas, dispenser, dan rak bumbu per kamar.', 'image' => ''],
            ['title' => 'Parkir motor beratap', 'text' => 'Muat 30 motor, gerbang dikunci pukul 23.00.', 'image' => ''],
            ['title' => 'CCTV 24 jam', 'text' => 'Kamera di gerbang, parkir, dan lorong. Akses gerbang dengan kunci pribadi.', 'image' => ''],
            ['title' => 'Laundry & jemuran', 'text' => 'Mesin cuci koin dan jemuran atap. Bisa titip laundry kiloan.', 'image' => ''],
            ['title' => 'Kebersihan rutin', 'text' => 'Lorong, dapur, dan kamar mandi bersama dibersihkan setiap hari.', 'image' => ''],
        ]]];

        $faq = ['type' => 'faq', 'data' => ['title' => 'Pertanyaan calon penghuni', 'items' => [
            ['question' => 'Apakah bisa survei dulu sebelum bayar?', 'answer' => 'Bisa, dan kami sarankan. Survei setiap hari pukul 08.00–20.00. Kabari lewat WhatsApp supaya pengelola menunggu di lokasi.'],
            ['question' => 'Bagaimana cara booking kamar?', 'answer' => 'Bayar tanda jadi Rp200.000 (dipotong dari sewa bulan pertama). Kamar kami tahan sampai tanggal masuk yang disepakati, maksimal 2 minggu.'],
            ['question' => 'Listriknya bagaimana?', 'answer' => 'Kamar Standar dan AC memakai token listrik per kamar. Kamar Eksklusif sudah termasuk listrik sampai 100 kWh per bulan.'],
            ['question' => 'Apakah ada deposit?', 'answer' => 'Ada deposit Rp500.000, dikembalikan utuh saat keluar selama kamar dan perabot dalam kondisi baik.'],
            ['question' => 'Boleh bawa motor dan kulkas sendiri?', 'answer' => 'Motor boleh, parkir gratis. Kulkas, rice cooker, dan setrika boleh dengan tambahan Rp50.000 per bulan untuk kamar tanpa listrik termasuk.'],
        ]]];

        return [
            ['title' => 'Beranda', 'slug' => 'beranda', 'is_home' => true, 'sections' => [
                ['type' => 'hero', 'data' => [
                    'eyebrow' => 'Kos putri · 5 menit ke kampus',
                    'title' => 'Kos bersih dan aman, *rasa rumah sendiri*',
                    'subtitle' => "{$company} menyediakan kamar kos putri yang nyaman untuk mahasiswi dan karyawati. WiFi kencang, kamar mandi dalam, CCTV 24 jam, dan ibu kos yang tinggal di lokasi.",
                    'button_label' => 'Lihat Kamar & Harga', 'button_url' => '/kamar',
                    'button2_label' => 'Jadwalkan Survei', 'button2_url' => '/lokasi',
                    'image' => 'demo/kos-hero.jpg',
                ]],
                ['type' => 'stats', 'data' => ['items' => [
                    ['value' => '24', 'label' => 'Kamar di 3 lantai'],
                    ['value' => '3', 'label' => 'Kamar kosong bulan ini'],
                    ['value' => '650 m', 'label' => 'Ke gerbang kampus'],
                    ['value' => '24 jam', 'label' => 'CCTV & penjaga'],
                ]]],
                $rooms,
                $facilities,
                ['type' => 'image_text', 'data' => ['title' => 'Lingkungan tenang, dekat ke mana-mana', 'body' => "Gedung tiga lantai di gang yang tenang dan bebas banjir. Jalan kaki ke kampus, minimarket, dan warung makan, dan hanya 10 menit ke stasiun.\n\n- Ibu kos tinggal di lantai dasar\n- Gerbang dikunci pukul 23.00, penghuni punya kunci sendiri\n- Penghuni rata-rata tinggal 2–4 tahun", 'image' => 'demo/kos-gedung.jpg', 'image_position' => 'left', 'button_label' => 'Lihat Lokasi', 'button_url' => '/lokasi']],
                ['type' => 'testimonials', 'data' => ['title' => 'Kata penghuni', 'items' => [
                    ['quote' => 'Sudah tiga tahun di sini sejak semester satu. Bersih, WiFi lancar buat kuliah online, dan ibu kosnya perhatian.', 'name' => 'Nadia', 'role' => 'Mahasiswi, penghuni sejak 2023'],
                    ['quote' => 'Orang tua saya tenang karena ada CCTV dan jam malam yang jelas. Kamar mandinya juga selalu bersih.', 'name' => 'Salsabila', 'role' => 'Mahasiswi farmasi'],
                    ['quote' => 'Dekat kantor, tinggal jalan kaki. Harganya masuk akal untuk kamar AC dan kamar mandi dalam.', 'name' => 'Rina', 'role' => 'Karyawati bank'],
                ]]],
                ['type' => 'cta', 'data' => ['title' => 'Mau lihat kamarnya langsung?', 'text' => 'Kirim pesan, ibu kos akan membalas dan menunggu Anda di lokasi. Survei gratis, tanpa kewajiban.', 'button_label' => 'Jadwalkan Survei', 'button_url' => '/lokasi']],
            ]],
            ['title' => 'Kamar', 'slug' => 'kamar', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Kamar & Harga Sewa', 'subtitle' => 'Bayar bulanan, per 6 bulan, atau tahunan. Ada kamar transit harian untuk orang tua yang berkunjung.']],
                $rooms,
                ['type' => 'plans', 'data' => ['title' => 'Makin lama, makin hemat', 'subtitle' => 'Contoh untuk Kamar AC. Diskon berlaku untuk semua tipe kamar.', 'items' => [
                    ['name' => 'Bulanan', 'price' => 'Rp1,35jt', 'info' => 'bayar tiap tanggal masuk', 'features' => "Deposit Rp500.000\nBebas keluar dengan pemberitahuan 2 minggu\nWiFi & air termasuk"],
                    ['name' => '6 Bulan', 'badge' => 'Favorit mahasiswa', 'price' => 'Rp7,5jt', 'old_price' => 'Rp8,1jt', 'info' => 'hemat Rp600.000', 'features' => "Setara Rp1,25jt per bulan\nGratis cuci kasur 1 kali\nPrioritas pindah kamar", 'highlight' => 'yes'],
                    ['name' => 'Tahunan', 'price' => 'Rp14,4jt', 'old_price' => 'Rp16,2jt', 'info' => 'hemat Rp1,8jt', 'features' => "Setara Rp1,2jt per bulan\nHarga terkunci 12 bulan\nBebas deposit"],
                ], 'note' => 'Kamar transit harian Rp150.000/malam dan mingguan Rp750.000, khusus keluarga penghuni.']],
                ['type' => 'pricelist', 'data' => ['title' => 'Biaya tambahan', 'subtitle' => 'Tidak ada biaya tersembunyi. Ini daftar lengkapnya.', 'items' => [
                    ['name' => 'Tanda jadi booking', 'description' => 'Dipotong dari sewa bulan pertama', 'info' => 'sekali', 'price' => 'Rp200.000'],
                    ['name' => 'Deposit kamar', 'description' => 'Kembali utuh saat keluar', 'info' => 'sekali', 'price' => 'Rp500.000'],
                    ['name' => 'Alat elektronik tambahan', 'description' => 'Kulkas, rice cooker, atau setrika di kamar token', 'info' => 'per bulan', 'price' => 'Rp50.000'],
                    ['name' => 'Laundry kiloan', 'description' => 'Cuci, kering, lipat, selesai 2 hari', 'info' => 'per kg', 'price' => 'Rp7.000'],
                ], 'order_button' => 'yes']],
            ]],
            ['title' => 'Fasilitas', 'slug' => 'fasilitas', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Fasilitas & Peraturan', 'subtitle' => 'Supaya semua penghuni nyaman, aman, dan betah.']],
                $facilities,
                ['type' => 'gallery', 'data' => ['title' => 'Intip suasananya', 'items' => [
                    ['image' => 'demo/kos-hero.jpg', 'caption' => 'Kamar AC dengan meja belajar'],
                    ['image' => 'demo/kos-kamarmandi.jpg', 'caption' => 'Kamar mandi dalam'],
                    ['image' => 'demo/kos-pantry.jpg', 'caption' => 'Pojok makan di dapur bersama'],
                    ['image' => 'demo/kos-putri.jpg', 'caption' => 'Kamar penghuni lantai 2'],
                    ['image' => 'demo/kos-gedung.jpg', 'caption' => 'Lorong dan balkon jemuran'],
                    ['image' => 'demo/kos-eksklusif.jpg', 'caption' => 'Kamar Eksklusif'],
                ]]],
                ['type' => 'text', 'data' => ['title' => 'Peraturan kos', 'body' => "1. **Jam malam pukul 23.00.** Pulang lebih malam? Kabari ibu kos lebih dulu.\n2. **Tamu lawan jenis** hanya sampai ruang tamu lantai dasar, pukul 08.00–21.00.\n3. **Tamu menginap** (keluarga) wajib lapor dan memakai kamar transit.\n4. **Jaga kebersihan** dapur dan kamar mandi bersama setelah dipakai.\n5. **Dilarang** merokok di dalam kamar, membawa hewan peliharaan, dan barang terlarang.\n6. **Sewa dibayar** paling lambat tanggal 5 setiap bulan lewat transfer."]],
                $faq,
            ]],
            ['title' => 'Lokasi', 'slug' => 'lokasi', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Lokasi & Survei', 'subtitle' => 'Di gang tenang, dekat kampus, kantor, dan tempat makan.']],
                ['type' => 'pricelist', 'data' => ['title' => 'Dekat ke mana saja', 'items' => [
                    ['name' => 'Gerbang utama kampus', 'description' => 'Fakultas teknik, ekonomi, dan farmasi', 'info' => '8 menit jalan kaki', 'price' => '650 m'],
                    ['name' => 'Minimarket 24 jam', 'description' => 'Plus ATM dan warung makan di sebelahnya', 'info' => '2 menit jalan kaki', 'price' => '150 m'],
                    ['name' => 'Kawasan perkantoran', 'description' => 'Bank, kantor pajak, dan gedung perkantoran', 'info' => '5 menit motor', 'price' => '1,8 km'],
                    ['name' => 'Stasiun & halte bus', 'description' => 'Akses kereta dan bus kota', 'info' => '10 menit motor', 'price' => '3 km'],
                    ['name' => 'Rumah sakit & apotek', 'description' => 'IGD 24 jam', 'info' => '7 menit motor', 'price' => '2,2 km'],
                ], 'order_button' => 'no']],
                ['type' => 'steps', 'data' => ['title' => 'Cara survei & booking', 'items' => [
                    ['title' => 'Chat WhatsApp', 'text' => 'Sebutkan tipe kamar dan rencana tanggal masuk.'],
                    ['title' => 'Survei lokasi', 'text' => 'Datang setiap hari 08.00–20.00, atau minta video call keliling kamar.'],
                    ['title' => 'Bayar tanda jadi', 'text' => 'Rp200.000 untuk menahan kamar sampai tanggal masuk.'],
                    ['title' => 'Pindahan', 'text' => 'Terima kunci kamar dan gerbang, kamar sudah dibersihkan.'],
                ]]],
                ['type' => 'contact', 'data' => ['title' => 'Tanya kamar kosong', 'text' => 'Tulis nama, tipe kamar, dan rencana tanggal masuk. Kami balas di hari yang sama.', 'show_form' => 'yes']],
            ]],
        ];
    }
}
