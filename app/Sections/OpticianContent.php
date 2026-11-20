<?php

namespace App\Sections;

/**
 * Sample pages for the Optik template: frame styles, free computerised eye test, lens types with
 * prices, frame + lens packages, contact lenses and home service for offices and schools.
 */
class OpticianContent
{
    /**
     * @return list<array<string, mixed>>
     */
    public static function pages(string $company): array
    {
        $frames = ['type' => 'catalog', 'data' => ['title' => 'Pilihan frame', 'subtitle' => 'Lebih dari 800 model di toko. Coba langsung, kami bantu pilih yang pas dengan bentuk wajah.', 'items' => [
            ['image' => 'demo/optik-tortoise.jpg', 'name' => 'Bulat Retro', 'category' => 'Acetate', 'badge' => 'Terlaris', 'specs' => "Motif tortoise\nRingan\nUnisex", 'price' => 'Rp285.000', 'unit' => '', 'url' => ''],
            ['image' => 'demo/optik-klasik.jpg', 'name' => 'Browline Klasik', 'category' => 'Kombinasi', 'badge' => '', 'specs' => "Atas acetate\nBawah metal\nWajah bulat & oval", 'price' => 'Rp325.000', 'unit' => '', 'url' => ''],
            ['image' => 'demo/optik-titanium.jpg', 'name' => 'Kotak Titanium', 'category' => 'Titanium', 'badge' => 'Anti karat', 'specs' => "Super ringan\nEngsel per\nCocok untuk kerja", 'price' => 'Rp550.000', 'unit' => '', 'url' => ''],
            ['image' => 'demo/optik-hijab.jpg', 'name' => 'Cat Eye Tipis', 'category' => 'Metal', 'badge' => '', 'specs' => "Gagang tipis\nNyaman dengan hijab\nRose gold", 'price' => 'Rp310.000', 'unit' => '', 'url' => ''],
            ['image' => 'demo/optik-baki.jpg', 'name' => 'Frame Anak Flexi', 'category' => 'Anak', 'badge' => 'Lentur', 'specs' => "Bahan TR90\nTidak mudah patah\nUsia 4–12 tahun", 'price' => 'Rp235.000', 'unit' => '', 'url' => ''],
            ['image' => 'demo/optik-rak.jpg', 'name' => 'Rimless Minimalis', 'category' => 'Tanpa bingkai', 'badge' => '', 'specs' => "Lensa dibor\nNyaris tak terlihat\nFormal", 'price' => 'Rp450.000', 'unit' => '', 'url' => ''],
        ], 'button_label' => 'Tanya stok']];

        $lenses = ['type' => 'pricelist', 'data' => ['title' => 'Jenis lensa & harga', 'subtitle' => 'Harga sepasang lensa. Ukuran minus, plus, dan silinder sampai 4,00 tanpa biaya tambahan.', 'items' => [
            ['name' => 'Lensa standar (CR-39)', 'description' => 'Jernih dan ringan untuk pemakaian sehari-hari', 'info' => '1 jam jadi', 'price' => 'Rp150.000', 'image' => ''],
            ['name' => 'Anti radiasi (blue light)', 'description' => 'Mengurangi silau layar HP dan laptop, mata tidak cepat lelah', 'info' => '1 jam jadi', 'price' => 'Rp250.000', 'image' => ''],
            ['name' => 'Photochromic', 'description' => 'Bening di dalam ruangan, gelap otomatis di bawah matahari', 'info' => '1–2 hari', 'price' => 'Rp450.000', 'image' => ''],
            ['name' => 'Photochromic + anti radiasi', 'description' => 'Dua manfaat dalam satu lensa, cocok untuk pengendara', 'info' => '1–2 hari', 'price' => 'Rp550.000', 'image' => ''],
            ['name' => 'Lensa tipis 1.67', 'description' => 'Untuk minus tinggi, lensa tidak tebal dan tidak berat', 'info' => '3 hari', 'price' => 'Rp750.000', 'image' => ''],
            ['name' => 'Progresif', 'description' => 'Jauh, menengah, dan dekat dalam satu lensa tanpa garis', 'info' => '5 hari', 'price' => 'Rp1.250.000', 'image' => ''],
        ], 'note' => 'Garansi lensa 6 bulan dan frame 1 tahun. Bisa bayar pakai klaim kacamata kantor.', 'order_button' => 'yes']];

        $packages = ['type' => 'plans', 'data' => ['title' => 'Paket frame + lensa', 'subtitle' => 'Sudah termasuk periksa mata komputer, kotak, dan lap kacamata.', 'items' => [
            ['name' => 'Paket Hemat', 'badge' => '', 'price' => 'Rp350rb', 'old_price' => 'Rp435rb', 'info' => 'jadi 1 jam', 'features' => "Frame pilihan seri hemat\nLensa standar\nCocok untuk pelajar", 'highlight' => 'no'],
            ['name' => 'Paket Kerja', 'badge' => 'Paling laris', 'price' => 'Rp650rb', 'old_price' => 'Rp810rb', 'info' => 'jadi 1 jam', 'features' => "Frame acetate atau metal\nLensa anti radiasi\nCocok untuk kerja di depan layar\nGaransi 1 tahun", 'highlight' => 'yes'],
            ['name' => 'Paket Progresif', 'badge' => '', 'price' => 'Rp1,45jt', 'old_price' => 'Rp1,8jt', 'info' => 'jadi 5 hari', 'features' => "Frame titanium\nLensa progresif + anti radiasi\nUntuk usia 40 tahun ke atas\nPenyesuaian ulang gratis", 'highlight' => 'no'],
        ], 'note' => 'Paket bisa ditukar frame lain dengan menambah selisih harga.']];

        return [
            ['title' => 'Beranda', 'slug' => 'beranda', 'is_home' => true, 'sections' => [
                ['type' => 'hero', 'data' => [
                    'eyebrow' => 'Periksa mata gratis · Jadi 1 jam',
                    'title' => 'Lihat dunia *lebih jelas*, tampil lebih percaya diri',
                    'subtitle' => "{$company} memeriksa mata dengan refraksi komputer gratis, lalu membantu memilih frame dan lensa yang pas. Kacamata standar bisa ditunggu.",
                    'button_label' => 'Periksa Mata Gratis', 'button_url' => '/periksa-mata',
                    'button2_label' => 'Lihat Frame', 'button2_url' => '/frame',
                    'image' => 'demo/optik-hero.jpg',
                ]],
                ['type' => 'services', 'data' => ['title' => 'Kenapa beli kacamata di sini', 'items' => [
                    ['title' => 'Periksa mata gratis', 'text' => 'Refraksi komputer dan pemeriksaan ulang oleh refraksionis optisien, tanpa syarat beli.', 'image' => 'demo/optik-periksa.jpg'],
                    ['title' => '800+ model frame', 'text' => 'Acetate, titanium, rimless, sampai frame anak yang lentur. Bebas coba sepuasnya.', 'image' => 'demo/optik-rak.jpg'],
                    ['title' => 'Home service', 'text' => 'Kami datang ke kantor, sekolah, atau rumah untuk periksa mata bersama.', 'image' => 'demo/optik-baki.jpg'],
                ]]],
                $packages,
                $frames,
                ['type' => 'steps', 'data' => ['title' => 'Dari periksa sampai kacamata jadi', 'items' => [
                    ['title' => 'Refraksi komputer', 'text' => 'Mesin membaca ukuran minus, plus, dan silinder dalam 2 menit.'],
                    ['title' => 'Uji coba lensa', 'text' => 'Optisien mencocokkan ukuran sampai Anda nyaman membaca.'],
                    ['title' => 'Pilih frame & lensa', 'text' => 'Kami sarankan sesuai bentuk wajah, kegiatan, dan anggaran.'],
                    ['title' => 'Jadi & disetel', 'text' => 'Kacamata standar jadi 1 jam, disetel supaya pas di hidung dan telinga.'],
                ]]],
                ['type' => 'testimonials', 'data' => ['title' => 'Kata pelanggan', 'items' => [
                    ['quote' => 'Periksanya teliti, tidak buru-buru. Kacamata anti radiasi saya jadi dalam satu jam, mata tidak pegal lagi di depan laptop.', 'name' => 'Rizky', 'role' => 'Paket Kerja'],
                    ['quote' => 'Anak saya minus 2 dan susah diajak pakai kacamata. Di sini dibantu pilih frame yang dia suka, sekarang mau dipakai terus.', 'name' => 'Ibu Hana', 'role' => 'Frame anak'],
                    ['quote' => 'Tim datang ke kantor kami untuk periksa 60 karyawan. Rapi dan klaim asuransinya dibantu.', 'name' => 'Pak Bambang', 'role' => 'HRD, home service'],
                ]]],
                ['type' => 'cta', 'data' => ['title' => 'Mata cepat lelah atau pandangan kabur?', 'text' => 'Datang saja untuk periksa mata gratis, tidak harus beli. Buka setiap hari 09.00–21.00.', 'button_label' => 'Atur Jadwal Periksa', 'button_url' => '/periksa-mata']],
            ]],
            ['title' => 'Frame', 'slug' => 'frame', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Koleksi Frame', 'subtitle' => 'Gaya klasik sampai modern, untuk dewasa dan anak.', 'image' => 'demo/optik-rak.jpg']],
                $frames,
                ['type' => 'pricelist', 'data' => ['title' => 'Lensa kontak', 'subtitle' => 'Tersedia bening dan berwarna, minus sampai -10,00.', 'items' => [
                    ['name' => 'Lensa kontak bulanan bening', 'description' => 'Isi 2 keping, ganti tiap 1 bulan', 'info' => 'per kotak', 'price' => 'Rp95.000', 'image' => ''],
                    ['name' => 'Lensa kontak harian', 'description' => 'Isi 30 keping, sekali pakai buang', 'info' => 'per kotak', 'price' => 'Rp275.000', 'image' => ''],
                    ['name' => 'Lensa kontak warna', 'description' => 'Abu, cokelat, dan hazel, ada minusnya', 'info' => 'per pasang', 'price' => 'Rp120.000', 'image' => ''],
                    ['name' => 'Cairan pembersih 360 ml', 'description' => 'Untuk merendam dan membersihkan', 'info' => '', 'price' => 'Rp65.000', 'image' => ''],
                ], 'note' => 'Pemakai baru kami ajari cara pasang dan lepas lensa kontak sampai bisa.', 'order_button' => 'yes']],
                ['type' => 'faq', 'data' => ['title' => 'Memilih frame', 'items' => [
                    ['question' => 'Frame apa yang cocok untuk wajah bulat?', 'answer' => 'Bentuk kotak atau browline membuat wajah bulat tampak lebih tegas. Wajah kotak cocok dengan frame bulat atau oval.'],
                    ['question' => 'Bisa pakai frame lama?', 'answer' => 'Bisa. Bawa frame Anda, kami cek kondisinya lalu ganti lensanya saja.'],
                    ['question' => 'Apakah ada frame yang aman untuk anak aktif?', 'answer' => 'Ada, frame TR90 lentur yang bisa ditekuk tanpa patah, plus tali pengaman.'],
                ]]],
            ]],
            ['title' => 'Lensa & Paket', 'slug' => 'lensa', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Lensa & Paket Kacamata', 'subtitle' => 'Pilih lensa sesuai kebutuhan: kerja di depan layar, berkendara, atau membaca.', 'image' => 'demo/optik-klasik.jpg']],
                $lenses,
                $packages,
            ]],
            ['title' => 'Periksa Mata', 'slug' => 'periksa-mata', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Periksa Mata Gratis', 'subtitle' => 'Refraksi komputer dan uji lensa oleh refraksionis optisien bersertifikat.', 'image' => 'demo/optik-periksa.jpg']],
                ['type' => 'image_text', 'data' => [
                    'title' => 'Tanpa syarat, tanpa antre lama',
                    'body' => "Pemeriksaan sekitar 15 menit. Hasilnya kami tuliskan di kartu resep, boleh dibawa pulang walau belum membeli.\n\n- Ukur minus, plus, silinder, dan jarak pupil\n- Cek ulang kacamata lama: masih sesuai atau tidak\n- Saran lensa sesuai kegiatan sehari-hari\n\nUntuk keluhan sakit mata, mata merah, atau penglihatan mendadak turun, kami sarankan ke dokter spesialis mata.",
                    'image' => 'demo/optik-periksa.jpg', 'image_position' => 'left',
                    'button_label' => 'Atur jadwal', 'button_url' => '/kontak',
                ]],
                ['type' => 'services', 'data' => ['title' => 'Home service untuk kantor & sekolah', 'subtitle' => 'Minimal 20 orang, gratis biaya kedatangan di dalam kota.', 'items' => [
                    ['title' => 'Kantor & pabrik', 'text' => "Periksa mata karyawan di lokasi\nBisa klaim asuransi atau BPJS Kesehatan\nKacamata diantar dalam 3 hari", 'image' => ''],
                    ['title' => 'Sekolah', 'text' => "Skrining mata siswa SD sampai SMA\nLaporan hasil untuk sekolah dan orang tua\nHarga khusus frame anak", 'image' => ''],
                    ['title' => 'Rumah & panti', 'text' => "Untuk lansia yang sulit keluar rumah\nPeriksa dan coba frame di rumah\nCukup janjian lewat WhatsApp", 'image' => ''],
                ]]],
                ['type' => 'contact', 'data' => ['title' => 'Pesan home service', 'text' => 'Tulis nama instansi, alamat, perkiraan jumlah orang, dan tanggal yang diinginkan.', 'show_form' => 'yes']],
            ]],
            ['title' => 'Kontak', 'slug' => 'kontak', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Kunjungi Toko Kami', 'subtitle' => 'Buka setiap hari 09.00–21.00, termasuk hari Minggu.', 'image' => 'demo/optik-baki.jpg']],
                ['type' => 'contact', 'data' => ['title' => 'Tanya atau atur jadwal periksa', 'text' => 'Tanyakan stok frame, harga lensa sesuai resep Anda, atau jadwal periksa mata.', 'show_form' => 'yes']],
            ]],
        ];
    }
}
