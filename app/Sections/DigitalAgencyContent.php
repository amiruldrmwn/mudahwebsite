<?php

namespace App\Sections;

/**
 * Sample pages for the Digital Agency & Software House template: case studies with results,
 * services, tech stack, price packages and the project process.
 */
class DigitalAgencyContent
{
    /**
     * @return list<array<string, mixed>>
     */
    public static function pages(string $company): array
    {
        $services = ['type' => 'services', 'data' => ['title' => 'Yang kami kerjakan', 'subtitle' => 'Satu tim untuk strategi, desain, kode, dan pemasaran. Anda cukup bicara dengan satu project manager.', 'items' => [
            ['title' => 'Website & landing page', 'text' => 'Company profile, toko online, dan landing page iklan yang cepat dibuka dan mudah ditemukan di Google.', 'image' => ''],
            ['title' => 'Aplikasi web & mobile', 'text' => 'Sistem kasir, aplikasi pemesanan, dashboard internal, sampai aplikasi Android & iOS.', 'image' => ''],
            ['title' => 'UI/UX design', 'text' => 'Riset pengguna, wireframe, dan prototipe Figma yang sudah diuji sebelum masuk tahap coding.', 'image' => ''],
            ['title' => 'Digital marketing', 'text' => 'Iklan Meta & Google, SEO, dan kelola media sosial dengan laporan angka setiap bulan.', 'image' => ''],
        ]]];

        $cases = ['type' => 'posts', 'data' => ['title' => 'Hasil kerja kami', 'subtitle' => 'Bukan sekadar tampilan bagus: setiap proyek diukur dari angka bisnisnya.', 'items' => [
            ['image' => 'demo/agency-app.jpg', 'category' => 'Aplikasi mobile', 'date' => '+240% pesanan', 'title' => 'Aplikasi pesan-antar untuk jaringan 12 outlet ayam geprek', 'text' => 'Pesanan lewat aplikasi sendiri naik 2,4 kali dalam 4 bulan, tanpa potongan komisi ojek online.', 'url' => ''],
            ['image' => 'demo/agency-web.jpg', 'category' => 'Website & SEO', 'date' => '3x trafik organik', 'title' => 'Website dan SEO untuk distributor bahan bangunan di Surabaya', 'text' => 'Halaman 1 Google untuk 40 kata kunci produk. Permintaan penawaran lewat website kini 90 per bulan.', 'url' => ''],
            ['image' => 'demo/agency-uiux.jpg', 'category' => 'UI/UX & dashboard', 'date' => '-60% waktu input', 'title' => 'Dashboard stok dan penjualan untuk koperasi susu', 'text' => 'Admin gudang yang dulu rekap di Excel kini cukup scan barcode. Laporan harian keluar otomatis.', 'url' => ''],
            ['image' => 'demo/agency-wireframe.jpg', 'category' => 'Landing page & iklan', 'date' => 'CPL turun 45%', 'title' => 'Landing page promo perumahan untuk developer di Bekasi', 'text' => 'Biaya per prospek dari iklan Meta turun hampir separuh setelah halaman dan formulir dirombak.', 'url' => ''],
        ]]];

        $plans = ['type' => 'plans', 'data' => ['title' => 'Paket harga', 'subtitle' => 'Harga tetap di awal, tanpa biaya tersembunyi. Pembayaran bertahap mengikuti progres.', 'items' => [
            ['name' => 'Landing Page', 'badge' => '', 'price' => 'Rp2,5jt', 'old_price' => '', 'info' => '±7 hari kerja', 'features' => "1 halaman panjang untuk iklan\nDesain khusus, bukan template\nFormulir & tombol WhatsApp\nPasang Meta Pixel & Google Analytics\nRevisi 2 kali", 'highlight' => 'no'],
            ['name' => 'Company Profile', 'badge' => 'Paling dipilih', 'price' => 'Rp6,5jt', 'old_price' => 'Rp8jt', 'info' => '±3 minggu', 'features' => "Hingga 8 halaman\nDomain .com/.co.id & hosting 1 tahun\nEmail bisnis 5 akun\nSEO dasar & Google Business\nPanel admin untuk ubah isi\nPelatihan 1 sesi", 'highlight' => 'yes'],
            ['name' => 'Aplikasi Custom', 'badge' => '', 'price' => 'Rp35jt', 'old_price' => '', 'info' => 'mulai 2 bulan', 'features' => "Analisis kebutuhan & UI/UX\nAplikasi web atau Android/iOS\nDashboard admin & laporan\nServer & deployment\nGaransi bug 3 bulan", 'highlight' => 'no'],
            ['name' => 'Kelola Sosmed', 'badge' => '', 'price' => 'Rp3,5jt', 'old_price' => '', 'info' => 'per bulan', 'features' => "16 konten feed & 20 story\nCopywriting & desain\nSatu sesi foto produk\nIklan dikelola (saldo terpisah)\nLaporan bulanan", 'highlight' => 'no'],
        ], 'note' => 'Semua harga belum termasuk PPN 11%. Butuh fitur di luar paket? Kami buatkan penawaran khusus.']];

        $process = ['type' => 'steps', 'data' => ['title' => 'Cara kami bekerja', 'subtitle' => 'Lima tahap yang jelas, dengan jadwal dan laporan progres setiap minggu.', 'items' => [
            ['title' => 'Discovery', 'text' => 'Kami pelajari bisnis, target pelanggan, dan pesaing Anda. Hasilnya ruang lingkup dan jadwal tertulis.'],
            ['title' => 'Design', 'text' => 'Wireframe lalu desain tampilan di Figma. Anda bisa klik prototipenya sebelum disetujui.'],
            ['title' => 'Development', 'text' => 'Coding per sprint dua mingguan. Setiap akhir sprint ada demo dan link uji coba.'],
            ['title' => 'Launch', 'text' => 'Uji keamanan dan kecepatan, pindah ke server produksi, lalu pelatihan untuk tim Anda.'],
            ['title' => 'Maintenance', 'text' => 'Pemantauan server, backup, perbaikan bug, dan pengembangan fitur lanjutan.'],
        ]]];

        $clients = ['type' => 'clients', 'data' => ['title' => 'Dipercaya 120+ bisnis di Indonesia', 'items' => [
            ['name' => 'Geprek Nusantara', 'logo' => ''],
            ['name' => 'Bangun Jaya', 'logo' => ''],
            ['name' => 'KopSu Makmur', 'logo' => ''],
            ['name' => 'Griya Asri', 'logo' => ''],
            ['name' => 'Klinik Sehati', 'logo' => ''],
            ['name' => 'Rumah Batik', 'logo' => ''],
        ]]];

        $stack = ['type' => 'services', 'data' => ['title' => 'Teknologi yang kami pakai', 'subtitle' => 'Teknologi teruji yang mudah dirawat dan dikembangkan tim lain kelak.', 'items' => [
            ['title' => 'Frontend', 'text' => "Vue & Nuxt\nReact & Next.js\nTailwind CSS", 'image' => ''],
            ['title' => 'Backend', 'text' => "Laravel (PHP)\nNode.js\nPostgreSQL & MySQL", 'image' => ''],
            ['title' => 'Mobile', 'text' => "Flutter\nKotlin (Android)\nSwift (iOS)", 'image' => ''],
            ['title' => 'Cloud & DevOps', 'text' => "Docker\nVPS & AWS\nCI/CD otomatis", 'image' => ''],
        ]]];

        return [
            ['title' => 'Beranda', 'slug' => 'beranda', 'is_home' => true, 'sections' => [
                ['type' => 'hero', 'data' => [
                    'eyebrow' => 'Digital agency & software house',
                    'title' => 'Website dan aplikasi yang *menghasilkan*, bukan cuma tampil',
                    'subtitle' => "{$company} membangun website, aplikasi, dan kampanye digital untuk bisnis yang ingin tumbuh. Desain rapi, kode bersih, hasil terukur.",
                    'button_label' => 'Mulai Proyek', 'button_url' => '/kontak',
                    'button2_label' => 'Lihat Portofolio', 'button2_url' => '/portofolio',
                    'image' => 'demo/agency-hero.jpg',
                ]],
                $clients,
                $services,
                $cases,
                ['type' => 'stats', 'data' => ['items' => [
                    ['value' => '180+', 'label' => 'Proyek selesai'],
                    ['value' => '8 thn', 'label' => 'Berpengalaman'],
                    ['value' => '96%', 'label' => 'Klien order ulang'],
                    ['value' => '24 jam', 'label' => 'Respon tiket support'],
                ]]],
                $process,
                ['type' => 'testimonials', 'data' => ['title' => 'Kata klien', 'items' => [
                    ['quote' => 'Timnya paham bisnis, bukan cuma coding. Aplikasi pesanan kami jalan mulus sejak hari pertama.', 'name' => 'Rizky Pratama', 'role' => 'Owner, Geprek Nusantara'],
                    ['quote' => 'Progres dilaporkan tiap minggu, jadwal tepat. Website baru kami langsung mendatangkan penawaran.', 'name' => 'Ibu Lestari', 'role' => 'Direktur, CV Bangun Jaya'],
                    ['quote' => 'Desain dashboard-nya gampang dipakai admin gudang yang awalnya gaptek.', 'name' => 'Pak Hendra', 'role' => 'Ketua, KopSu Makmur'],
                ]]],
                ['type' => 'cta', 'data' => ['title' => 'Punya ide proyek?', 'text' => 'Ceritakan kebutuhan Anda. Kami kirim estimasi biaya dan jadwal dalam 1×24 jam, gratis.', 'button_label' => 'Konsultasi Gratis', 'button_url' => '/kontak']],
            ]],
            ['title' => 'Layanan', 'slug' => 'layanan', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Layanan Kami', 'subtitle' => 'Dari ide di kertas sampai produk yang dipakai ribuan orang.']],
                $services,
                ['type' => 'image_text', 'data' => ['title' => 'Desain yang diuji sebelum dibangun', 'body' => "Setiap proyek dimulai dari riset singkat dan wireframe. Prototipe Figma kami uji ke calon pengguna, jadi revisi besar terjadi di desain, bukan setelah coding.\n\n- Riset pengguna & pesaing\n- Wireframe dan prototipe interaktif\n- Design system agar tampilan konsisten", 'image' => 'demo/agency-uiux.jpg', 'image_position' => 'right', 'button_label' => 'Lihat Paket', 'button_url' => '/harga']],
                $stack,
                $process,
            ]],
            ['title' => 'Portofolio', 'slug' => 'portofolio', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Studi Kasus', 'subtitle' => 'Masalah klien, solusi kami, dan angka sesudahnya.']],
                $cases,
                $clients,
                ['type' => 'gallery', 'data' => ['title' => 'Di balik layar', 'items' => [
                    ['image' => 'demo/agency-tim.jpg', 'caption' => 'Sprint planning bersama klien'],
                    ['image' => 'demo/agency-code.jpg', 'caption' => 'Tim developer'],
                    ['image' => 'demo/agency-wireframe.jpg', 'caption' => 'Sketsa wireframe'],
                ]]],
            ]],
            ['title' => 'Harga', 'slug' => 'harga', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Paket & Harga', 'subtitle' => 'Pilih paket yang pas, atau minta penawaran khusus.']],
                $plans,
                ['type' => 'faq', 'data' => ['title' => 'Pertanyaan umum', 'items' => [
                    ['question' => 'Berapa lama pembuatan website?', 'answer' => 'Landing page sekitar 7 hari kerja, company profile 2–4 minggu, tergantung kesiapan materi dari Anda.'],
                    ['question' => 'Bagaimana sistem pembayarannya?', 'answer' => 'DP 50% di awal, 30% setelah desain disetujui, dan 20% saat serah terima. Untuk aplikasi custom, dibayar per sprint.'],
                    ['question' => 'Apakah source code jadi milik saya?', 'answer' => 'Ya. Setelah pelunasan, source code, akun domain, dan akses server diserahkan sepenuhnya kepada Anda.'],
                    ['question' => 'Ada biaya perpanjangan tahunan?', 'answer' => 'Hanya domain dan hosting mulai tahun kedua, sekitar Rp900.000 per tahun untuk company profile.'],
                ]]],
            ]],
            ['title' => 'Kontak', 'slug' => 'kontak', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Mulai Proyek', 'subtitle' => 'Ceritakan ide Anda. Estimasi gratis dalam 1×24 jam.']],
                ['type' => 'contact', 'data' => ['title' => 'Ceritakan proyek Anda', 'text' => 'Tulis jenis proyek, fitur utama, dan target waktu. Kami jadwalkan video call 30 menit tanpa biaya.', 'show_form' => 'yes']],
            ]],
        ];
    }
}
