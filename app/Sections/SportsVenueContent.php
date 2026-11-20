<?php

namespace App\Sections;

/**
 * Sample pages for the Lapangan Olahraga template: futsal, badminton, mini soccer and padel
 * courts with hourly prices (day, night, weekend), member and tournament packages, and booking
 * by WhatsApp.
 */
class SportsVenueContent
{
    /**
     * @return list<array<string, mixed>>
     */
    public static function pages(string $company): array
    {
        $courts = ['type' => 'catalog', 'data' => ['title' => 'Pilih lapangan', 'subtitle' => 'Harga per jam. Malam mulai pukul 17.00, akhir pekan termasuk tanggal merah.', 'items' => [
            ['image' => 'demo/lapangan-futsal.jpg', 'name' => 'Futsal A · Interlock', 'category' => 'Futsal indoor', 'badge' => 'Paling ramai', 'specs' => "Siang Rp120rb\nMalam Rp160rb\n25×15 m\nRumput interlock", 'price' => 'Rp120rb', 'unit' => '/jam'],
            ['image' => 'demo/lapangan-bola.jpg', 'name' => 'Futsal B · Vinyl', 'category' => 'Futsal indoor', 'specs' => "Siang Rp110rb\nMalam Rp150rb\n25×15 m\nLantai vinyl", 'price' => 'Rp110rb', 'unit' => '/jam'],
            ['image' => 'demo/lapangan-minisoccer.jpg', 'name' => 'Mini Soccer', 'category' => 'Outdoor 7 vs 7', 'badge' => 'Baru', 'specs' => "Siang Rp450rb\nMalam Rp650rb\n50×30 m\nRumput sintetis", 'price' => 'Rp450rb', 'unit' => '/jam'],
            ['image' => 'demo/lapangan-badminton.jpg', 'name' => 'Badminton 1–4', 'category' => 'Indoor', 'specs' => "Siang Rp40rb\nMalam Rp55rb\nKarpet standar BWF\nLampu anti silau", 'price' => 'Rp40rb', 'unit' => '/jam'],
            ['image' => 'demo/lapangan-padel.jpg', 'name' => 'Padel Court', 'category' => 'Semi outdoor', 'badge' => 'Baru', 'specs' => "Siang Rp250rb\nMalam Rp350rb\nKaca tempered\nSewa raket Rp30rb", 'price' => 'Rp250rb', 'unit' => '/jam'],
            ['image' => 'demo/lapangan-raket.jpg', 'name' => 'Sewa Alat', 'category' => 'Tambahan', 'specs' => "Raket badminton\nSepatu futsal\nRompi & bola\nShuttlecock", 'price' => 'Rp15rb', 'unit' => '/item'],
        ], 'button_label' => 'Booking']];

        $prices = ['type' => 'pricelist', 'data' => ['title' => 'Tabel harga per jam', 'subtitle' => 'Siang 07.00–17.00, malam 17.00–24.00. Akhir pekan dan tanggal merah tambah Rp20.000 per jam.', 'items' => [
            ['name' => 'Futsal A · siang', 'description' => 'Senin–Jumat', 'info' => '07.00–17.00', 'price' => 'Rp120.000'],
            ['name' => 'Futsal A · malam', 'description' => 'Senin–Jumat', 'info' => '17.00–24.00', 'price' => 'Rp160.000'],
            ['name' => 'Futsal B · siang', 'description' => 'Senin–Jumat', 'info' => '07.00–17.00', 'price' => 'Rp110.000'],
            ['name' => 'Futsal B · malam', 'description' => 'Senin–Jumat', 'info' => '17.00–24.00', 'price' => 'Rp150.000'],
            ['name' => 'Mini soccer · siang', 'description' => 'Sudah termasuk wasit', 'info' => '07.00–17.00', 'price' => 'Rp450.000'],
            ['name' => 'Mini soccer · malam', 'description' => 'Sudah termasuk wasit', 'info' => '17.00–24.00', 'price' => 'Rp650.000'],
            ['name' => 'Badminton · siang / malam', 'description' => 'Per lapangan', 'info' => 'per jam', 'price' => 'Rp40.000 / Rp55.000'],
            ['name' => 'Padel · siang / malam', 'description' => 'Maksimal 4 pemain', 'info' => 'per jam', 'price' => 'Rp250.000 / Rp350.000'],
        ], 'note' => 'DP 50% untuk mengunci jadwal. Pelunasan di kasir sebelum main.', 'order_button' => 'yes']];

        $facilities = ['type' => 'services', 'data' => ['title' => 'Fasilitas lengkap', 'subtitle' => 'Datang, main, mandi, makan. Semua ada di satu tempat.', 'items' => [
            ['title' => 'Ruang ganti & shower', 'text' => 'Terpisah putra dan putri, air panas, dan loker berkunci.', 'image' => ''],
            ['title' => 'Kantin & minuman', 'text' => 'Nasi goreng, mi rebus, es teh jumbo, dan minuman isotonik dingin.', 'image' => ''],
            ['title' => 'Musholla', 'text' => 'Bersih, ada mukena dan sarung. Jadwal main bisa jeda saat azan.', 'image' => ''],
            ['title' => 'Parkir luas', 'text' => 'Muat 80 motor dan 25 mobil, dijaga sampai tutup.', 'image' => ''],
            ['title' => 'Tribun penonton', 'text' => 'Kursi untuk 60 orang di sisi lapangan futsal dan mini soccer.', 'image' => ''],
            ['title' => 'Sewa alat', 'text' => 'Sepatu, rompi, bola, raket, dan shuttlecock tersedia di kasir.', 'image' => ''],
        ]]];

        $steps = ['type' => 'steps', 'data' => ['title' => 'Cara booking', 'subtitle' => 'Jadwal bisa dipesan sampai 7 hari ke depan.', 'items' => [
            ['title' => 'Cek jadwal kosong', 'text' => 'Chat WhatsApp, sebutkan lapangan, tanggal, dan jam main.'],
            ['title' => 'Bayar DP 50%', 'text' => 'Transfer atau QRIS. Jadwal langsung dikunci atas nama tim Anda.'],
            ['title' => 'Datang & main', 'text' => 'Datang 10 menit lebih awal, lunasi di kasir, dan lapangan siap.'],
        ]]];

        return [
            ['title' => 'Beranda', 'slug' => 'beranda', 'is_home' => true, 'sections' => [
                ['type' => 'hero', 'data' => [
                    'eyebrow' => 'Futsal · Mini soccer · Badminton · Padel',
                    'title' => 'Ajak tim, *booking lapangan*, langsung main',
                    'subtitle' => "{$company} punya 2 lapangan futsal, 1 mini soccer, 4 badminton, dan padel court. Buka setiap hari 07.00–24.00, booking cukup lewat WhatsApp.",
                    'button_label' => 'Booking Sekarang', 'button_url' => '/booking',
                    'button2_label' => 'Lihat Harga', 'button2_url' => '/harga',
                    'image' => 'demo/lapangan-hero.jpg',
                ]],
                ['type' => 'stats', 'data' => ['items' => [
                    ['value' => '8', 'label' => 'Lapangan'],
                    ['value' => '07–24', 'label' => 'Buka setiap hari'],
                    ['value' => '1.200+', 'label' => 'Jam main per bulan'],
                    ['value' => '40', 'label' => 'Tim member aktif'],
                ]]],
                $courts,
                $steps,
                $facilities,
                ['type' => 'testimonials', 'data' => ['title' => 'Kata para pemain', 'items' => [
                    ['quote' => 'Rumput interlock-nya enak, tidak licin, dan lampunya terang. Tiap Kamis malam tim kantor kami main di sini.', 'name' => 'Dimas', 'role' => 'Kapten tim futsal kantor'],
                    ['quote' => 'Booking lewat WA cepat dibalas, jadwal jelas, tidak pernah bentrok. Kantinnya juga murah.', 'name' => 'Yusuf', 'role' => 'Member badminton'],
                    ['quote' => 'Mini soccer-nya luas, cocok buat reuni SMA. Sudah termasuk wasit jadi tinggal main.', 'name' => 'Andre', 'role' => 'Main mini soccer'],
                ]]],
                ['type' => 'cta', 'data' => ['title' => 'Jam favorit cepat penuh', 'text' => 'Slot 19.00–22.00 biasanya habis 3 hari sebelumnya. Kunci jadwal tim Anda sekarang.', 'button_label' => 'Cek Jadwal Kosong', 'button_url' => '/booking']],
            ]],
            ['title' => 'Lapangan', 'slug' => 'lapangan', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Lapangan Kami', 'subtitle' => 'Delapan lapangan dengan lampu terang, lantai standar pertandingan, dan perawatan rutin.']],
                $courts,
                $facilities,
                ['type' => 'gallery', 'data' => ['title' => 'Suasana di lapangan', 'items' => [
                    ['image' => 'demo/lapangan-hero.jpg', 'caption' => 'Mini soccer malam hari'],
                    ['image' => 'demo/lapangan-main.jpg', 'caption' => 'Sparing antartim'],
                    ['image' => 'demo/lapangan-badminton.jpg', 'caption' => 'Hall badminton'],
                    ['image' => 'demo/lapangan-futsal.jpg', 'caption' => 'Futsal A'],
                    ['image' => 'demo/lapangan-padel.jpg', 'caption' => 'Padel court'],
                    ['image' => 'demo/lapangan-minisoccer.jpg', 'caption' => 'Gawang mini soccer'],
                ]]],
            ]],
            ['title' => 'Harga & Member', 'slug' => 'harga', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Harga, Member & Turnamen', 'subtitle' => 'Main rutin lebih hemat dengan paket member. Mau bikin turnamen? Kami siapkan semuanya.']],
                $prices,
                ['type' => 'plans', 'data' => ['title' => 'Paket member & turnamen', 'subtitle' => 'Untuk tim yang main rutin setiap minggu dan panitia acara.', 'items' => [
                    ['name' => 'Member Futsal', 'price' => 'Rp520rb', 'old_price' => 'Rp640rb', 'info' => '4× main, jam tetap', 'features' => "1 jam per minggu selama sebulan\nJadwal tetap, tidak perlu rebutan\nGratis air mineral 1 dus\nBebas ganti jadwal 1 kali"],
                    ['name' => 'Member Badminton', 'badge' => 'Paling hemat', 'price' => 'Rp180rb', 'old_price' => 'Rp220rb', 'info' => '4× main malam', 'features' => "2 jam per minggu selama sebulan\nJadwal tetap malam hari\nDiskon shuttlecock 10%\nBisa dipakai bergantian", 'highlight' => 'yes'],
                    ['name' => 'Paket Turnamen', 'price' => 'Rp3,5jt', 'info' => 'per hari, 8–16 tim', 'features' => "Sewa lapangan 10 jam\nWasit dan pencatat skor\nSound system & MC\nSpanduk dan area sponsor"],
                ], 'note' => 'Harga member untuk jam siang. Jam malam dan akhir pekan menyesuaikan.']],
                ['type' => 'faq', 'data' => ['title' => 'Pertanyaan umum', 'items' => [
                    ['question' => 'Kalau hujan atau batal main bagaimana?', 'answer' => 'Pembatalan paling lambat 24 jam sebelumnya, DP bisa dipindah ke jadwal lain. Lapangan indoor tetap bisa dipakai saat hujan.'],
                    ['question' => 'Boleh pakai sepatu bebas?', 'answer' => 'Futsal dan badminton wajib sepatu sol karet non-marking. Mini soccer boleh sepatu pul karet, tidak boleh pul besi.'],
                    ['question' => 'Apakah ada lapangan untuk sekolah atau komunitas?', 'answer' => 'Ada harga khusus untuk sekolah dan komunitas di jam siang hari kerja. Hubungi kami untuk penawarannya.'],
                ]]],
            ]],
            ['title' => 'Booking', 'slug' => 'booking', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Booking Lapangan', 'subtitle' => 'Kirim tanggal dan jam main, kami balas ketersediaannya dalam 5 menit.']],
                $steps,
                ['type' => 'contact', 'data' => ['title' => 'Pesan jadwal main', 'text' => 'Tulis lapangan, tanggal, jam mulai, lama main, dan nama tim. Buka setiap hari 07.00–24.00.', 'show_form' => 'yes']],
            ]],
        ];
    }
}
