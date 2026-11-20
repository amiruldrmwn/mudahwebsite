<?php

namespace App\Sections;

/**
 * Sample pages for the Interior & Furniture template: interior design, kitchen sets and custom
 * wardrobes, projects by room, cost estimates per metre, the work process, materials and
 * warranty.
 */
class InteriorContent
{
    /**
     * @return list<array<string, mixed>>
     */
    public static function pages(string $company): array
    {
        $services = ['type' => 'services', 'data' => ['title' => 'Yang kami kerjakan', 'subtitle' => 'Satu tim dari desain sampai pemasangan, diproduksi di workshop sendiri.', 'items' => [
            ['title' => 'Kitchen set', 'text' => 'Kabinet atas dan bawah, top table granit atau solid surface, ukur pas dengan dapur Anda.', 'image' => 'demo/interior-dapur.jpg'],
            ['title' => 'Lemari & wardrobe', 'text' => 'Lemari pakaian sampai plafon, walk-in closet, dan lemari sliding hemat ruang.', 'image' => 'demo/interior-lemari.jpg'],
            ['title' => 'Desain interior', 'text' => 'Konsep, gambar kerja, dan desain 3D untuk rumah, apartemen, kantor, dan kafe.', 'image' => 'demo/interior-ruangtamu.jpg'],
        ]]];

        $estimate = ['type' => 'pricelist', 'data' => ['title' => 'Estimasi biaya', 'subtitle' => 'Harga sudah termasuk material, produksi, pengiriman, dan pemasangan di dalam kota.', 'items' => [
            ['name' => 'Kitchen set bawah', 'description' => 'Multipleks 18 mm, finishing HPL, top table granit', 'info' => 'per meter lari', 'price' => 'Rp2.600.000'],
            ['name' => 'Kitchen set atas', 'description' => 'Multipleks 15 mm, finishing HPL, engsel soft close', 'info' => 'per meter lari', 'price' => 'Rp2.100.000'],
            ['name' => 'Lemari pakaian', 'description' => 'Tinggi sampai 2,4 m, pintu swing atau sliding', 'info' => 'per meter lari', 'price' => 'Rp3.200.000'],
            ['name' => 'Backdrop TV & rak', 'description' => 'Panel dinding, rak terbuka, dan lampu LED', 'info' => 'per meter persegi', 'price' => 'Rp1.750.000'],
            ['name' => 'Wall panel & partisi', 'description' => 'Kisi-kisi kayu atau panel fluted', 'info' => 'per meter persegi', 'price' => 'Rp1.250.000'],
            ['name' => 'Desain 3D', 'description' => 'Gratis jika lanjut produksi', 'info' => 'per ruangan', 'price' => 'Rp1.500.000'],
        ], 'note' => 'Finishing duco dan veneer kayu menambah 25–40%. Harga final setelah survei dan ukur.', 'order_button' => 'yes']];

        $steps = ['type' => 'steps', 'data' => ['title' => 'Proses kerja', 'subtitle' => 'Jelas di setiap tahap, dengan jadwal yang disepakati di awal.', 'items' => [
            ['title' => 'Survei & ukur', 'text' => 'Gratis untuk dalam kota. Kami ukur ruangan dan dengarkan kebutuhan Anda.'],
            ['title' => 'Desain 3D', 'text' => 'Gambar 3D, pilihan material, dan penawaran harga rinci. Revisi sampai cocok.'],
            ['title' => 'Produksi', 'text' => 'Dikerjakan di workshop sendiri, 3–5 minggu. Foto progres dikirim setiap minggu.'],
            ['title' => 'Pasang & serah terima', 'text' => 'Dipasang rapi dalam 1–3 hari, dibersihkan, lalu kartu garansi diserahkan.'],
        ]]];

        return [
            ['title' => 'Beranda', 'slug' => 'beranda', 'is_home' => true, 'sections' => [
                ['type' => 'hero', 'data' => [
                    'eyebrow' => 'Interior · Kitchen set · Furniture custom',
                    'title' => 'Ruang yang tertata, *dibuat pas untuk rumah Anda*',
                    'subtitle' => "{$company} merancang dan memproduksi kitchen set, lemari, dan furniture custom dari workshop sendiri. Survei gratis, desain 3D sebelum produksi, dan garansi sampai 5 tahun.",
                    'button_label' => 'Lihat Proyek', 'button_url' => '/proyek',
                    'button2_label' => 'Konsultasi Gratis', 'button2_url' => '/kontak',
                    'image' => 'demo/interior-hero.jpg',
                ]],
                $services,
                ['type' => 'gallery', 'data' => ['title' => 'Proyek terbaru', 'items' => [
                    ['image' => 'demo/interior-ruangtamu.jpg', 'caption' => 'Ruang keluarga · Rumah di BSD'],
                    ['image' => 'demo/interior-dapur.jpg', 'caption' => 'Kitchen set L · Bekasi'],
                    ['image' => 'demo/interior-kamar.jpg', 'caption' => 'Kamar utama · Apartemen'],
                    ['image' => 'demo/interior-lemari.jpg', 'caption' => 'Wardrobe & kamar tamu · Depok'],
                    ['image' => 'demo/interior-sofa.jpg', 'caption' => 'Ruang tamu · Bogor'],
                ]]],
                $steps,
                ['type' => 'stats', 'data' => ['items' => [
                    ['value' => '12 th', 'label' => 'Pengalaman'],
                    ['value' => '850+', 'label' => 'Proyek selesai'],
                    ['value' => '5 th', 'label' => 'Garansi kabinet'],
                    ['value' => '3D', 'label' => 'Desain sebelum produksi'],
                ]]],
                ['type' => 'testimonials', 'data' => ['title' => 'Cerita klien', 'items' => [
                    ['quote' => 'Dapur kami kecil, tapi desainnya pintar. Semua alat masak muat dan masih lega. Hasilnya persis seperti gambar 3D.', 'name' => 'Ibu Larasati', 'role' => 'Kitchen set, Bekasi'],
                    ['quote' => 'Timnya tepat waktu. Lemari sampai plafon dipasang dua hari, rapi dan bersih, tidak ada sisa serbuk.', 'name' => 'Bapak Arief', 'role' => 'Wardrobe kamar utama, Depok'],
                    ['quote' => 'Kami serahkan desain apartemen dari nol. Hasilnya hangat dan fungsional, banyak tamu yang bertanya.', 'name' => 'Sinta & Raka', 'role' => 'Interior apartemen, Jakarta Selatan'],
                ]]],
                ['type' => 'cta', 'data' => ['title' => 'Mulai dari survei gratis', 'text' => 'Kirim foto dan ukuran ruangan, kami beri gambaran desain dan estimasi biaya dalam 2 hari kerja.', 'button_label' => 'Jadwalkan Survei', 'button_url' => '/kontak']],
            ]],
            ['title' => 'Proyek', 'slug' => 'proyek', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Proyek Kami', 'subtitle' => 'Sebagian rumah, apartemen, dan kantor yang sudah kami kerjakan, dikelompokkan per ruangan.']],
                ['type' => 'gallery', 'data' => ['title' => 'Dapur & ruang makan', 'items' => [
                    ['image' => 'demo/interior-dapur2.jpg', 'caption' => 'Kitchen set dengan island · Tangerang'],
                    ['image' => 'demo/interior-dapur.jpg', 'caption' => 'Kitchen set L, HPL abu · Bekasi'],
                    ['image' => 'demo/interior-hero.jpg', 'caption' => 'Ruang makan terbuka · Rumah dua lantai'],
                ]]],
                ['type' => 'gallery', 'data' => ['title' => 'Kamar tidur & lemari', 'items' => [
                    ['image' => 'demo/interior-kamar.jpg', 'caption' => 'Wardrobe kaca & headboard · Apartemen'],
                    ['image' => 'demo/interior-lemari.jpg', 'caption' => 'Lemari terbuka & rak · Depok'],
                    ['image' => 'demo/interior-bengkel.jpg', 'caption' => 'Rangka lemari di workshop kami'],
                ]]],
                ['type' => 'gallery', 'data' => ['title' => 'Ruang keluarga & tamu', 'items' => [
                    ['image' => 'demo/interior-ruangtamu.jpg', 'caption' => 'Ruang keluarga · BSD'],
                    ['image' => 'demo/interior-sofa.jpg', 'caption' => 'Ruang tamu & rak dinding · Bogor'],
                    ['image' => 'demo/interior-hero.jpg', 'caption' => 'Living room void · Surabaya'],
                ]]],
                ['type' => 'cta', 'data' => ['title' => 'Punya ruangan yang ingin ditata?', 'text' => 'Kirim foto ruangan Anda, kami bantu buatkan konsepnya.', 'button_label' => 'Konsultasi Gratis', 'button_url' => '/kontak']],
            ]],
            ['title' => 'Layanan & Harga', 'slug' => 'layanan', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Layanan & Estimasi Biaya', 'subtitle' => 'Harga transparan per meter, supaya Anda bisa menghitung anggaran sejak awal.']],
                $services,
                $estimate,
                ['type' => 'services', 'data' => ['title' => 'Pilihan material', 'subtitle' => 'Kami bantu memilih sesuai anggaran, fungsi ruangan, dan selera.', 'items' => [
                    ['title' => 'Multipleks & HPL', 'text' => 'Kuat, tahan lembap, ratusan motif kayu dan warna. Pilihan paling populer untuk kitchen set.', 'image' => ''],
                    ['title' => 'Finishing duco', 'text' => 'Cat semprot halus dengan hasil doff atau glossy, cocok untuk gaya modern klasik.', 'image' => ''],
                    ['title' => 'Veneer kayu', 'text' => 'Lapisan kayu asli jati, walnut, atau oak untuk kesan hangat dan mewah.', 'image' => ''],
                    ['title' => 'Top table', 'text' => 'Granit, solid surface, atau sintered stone. Tahan panas dan mudah dibersihkan.', 'image' => ''],
                ]]],
            ]],
            ['title' => 'Proses', 'slug' => 'proses', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Proses & Garansi', 'subtitle' => 'Dari survei pertama sampai kunci lemari terakhir dipasang.']],
                $steps,
                ['type' => 'image_text', 'data' => ['title' => 'Diproduksi di workshop sendiri', 'body' => "Semua furniture dibuat oleh tukang kayu kami sendiri di workshop seluas 600 m², bukan disubkon. Mesin potong presisi membuat sambungan rapi dan ukuran pas.\n\n**Garansi tertulis:**\n\n- Kabinet dan rangka 5 tahun\n- Engsel dan rel laci 2 tahun\n- Servis setel ulang gratis 6 bulan pertama", 'image' => 'demo/interior-bengkel.jpg', 'image_position' => 'left']],
                ['type' => 'faq', 'data' => ['title' => 'Pertanyaan umum', 'items' => [
                    ['question' => 'Berapa uang muka yang perlu dibayar?', 'answer' => 'DP 50% setelah desain disetujui, 40% saat barang siap kirim, dan 10% setelah pemasangan selesai.'],
                    ['question' => 'Apakah melayani luar kota?', 'answer' => 'Ya, untuk Jabodetabek dan Bandung. Di luar itu ada biaya pengiriman dan akomodasi tim pasang.'],
                    ['question' => 'Bisa pakai desain sendiri?', 'answer' => 'Bisa. Kirim gambar atau referensi, kami sesuaikan dengan ukuran ruangan dan beri penawaran.'],
                    ['question' => 'Berapa lama dari survei sampai terpasang?', 'answer' => 'Rata-rata 5–7 minggu: 1 minggu desain, 3–5 minggu produksi, dan 1–3 hari pemasangan.'],
                ]]],
            ]],
            ['title' => 'Kontak', 'slug' => 'kontak', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Konsultasi & Survei', 'subtitle' => 'Showroom dan workshop buka Senin–Sabtu 09.00–17.00.']],
                ['type' => 'contact', 'data' => ['title' => 'Ceritakan ruangan Anda', 'text' => 'Tulis jenis ruangan, perkiraan ukuran, dan anggaran. Lampirkan foto lewat WhatsApp agar estimasi lebih tepat.', 'show_form' => 'yes']],
            ]],
        ];
    }
}
