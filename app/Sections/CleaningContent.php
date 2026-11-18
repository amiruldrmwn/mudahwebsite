<?php

namespace App\Sections;

/**
 * Sample pages for the Cleaning Service template: home and office cleaning by the hour or by
 * package, deep cleaning add-ons, booking steps and the team's guarantee.
 */
class CleaningContent
{
    /**
     * @return list<array<string, mixed>>
     */
    public static function pages(string $company): array
    {
        $packages = ['type' => 'plans', 'data' => ['title' => 'Paket bersih rumah', 'subtitle' => 'Petugas datang membawa alat dan cairan pembersih sendiri.', 'items' => [
            ['name' => 'Harian', 'badge' => '', 'price' => 'Rp150rb', 'old_price' => '', 'info' => '3 jam, 1 petugas', 'features' => "Sapu & pel semua ruangan\nLap debu perabot\nBersihkan dapur & kamar mandi\nBuang sampah", 'highlight' => 'no'],
            ['name' => 'Deep Clean', 'badge' => 'Terlaris', 'price' => 'Rp450rb', 'old_price' => '', 'info' => '6 jam, 2 petugas', 'features' => "Semua isi paket Harian\nKerak kamar mandi & dapur\nKaca dan jendela\nBawah kasur & lemari", 'highlight' => 'yes'],
            ['name' => 'Pindahan', 'badge' => '', 'price' => 'Rp850rb', 'old_price' => '', 'info' => 'rumah kosong, 3 petugas', 'features' => "Bersih total sebelum/sesudah pindah\nDinding, kusen, dan plafon\nDisinfeksi semua ruangan\nSiap huni", 'highlight' => 'no'],
        ], 'note' => 'Harga untuk rumah sampai 100 m². Rumah lebih luas atau kantor, minta penawaran.']];

        $extras = ['type' => 'pricelist', 'data' => ['title' => 'Layanan tambahan', 'subtitle' => 'Bisa dipesan terpisah atau ditambahkan ke paket.', 'items' => [
            ['name' => 'Cuci sofa', 'description' => 'Vakum, sampo, dan ekstraksi kotoran.', 'info' => 'per dudukan', 'price' => 'Rp60.000'],
            ['name' => 'Cuci kasur', 'description' => 'Hilangkan tungau, noda, dan bau.', 'info' => 'per kasur', 'price' => 'Rp150.000'],
            ['name' => 'Cuci karpet', 'description' => 'Dicuci di tempat, cepat kering.', 'info' => 'per m²', 'price' => 'Rp20.000'],
            ['name' => 'Disinfeksi', 'description' => 'Penyemprotan disinfektan seluruh ruangan.', 'info' => 'sampai 100 m²', 'price' => 'Rp250.000'],
            ['name' => 'Poles lantai', 'description' => 'Marmer dan granit kembali mengilap.', 'info' => 'per m²', 'price' => 'Rp35.000'],
        ], 'order_button' => 'yes']];

        $steps = ['type' => 'steps', 'data' => ['title' => 'Pesan dalam 4 langkah', 'items' => [
            ['title' => 'Pilih paket', 'text' => 'Pilih paket dan tanggal lewat WhatsApp atau formulir.'],
            ['title' => 'Konfirmasi', 'text' => 'Kami kirim nama petugas dan jam kedatangan.'],
            ['title' => 'Petugas datang', 'text' => 'Membawa alat lengkap, Anda cukup menunjukkan ruangan.'],
            ['title' => 'Cek & bayar', 'text' => 'Bayar setelah Anda cek hasilnya. Belum bersih? Kami ulang gratis.'],
        ]]];

        return [
            ['title' => 'Beranda', 'slug' => 'beranda', 'is_home' => true, 'sections' => [
                ['type' => 'hero', 'data' => [
                    'eyebrow' => 'Jasa bersih rumah & kantor',
                    'title' => 'Rumah *bersih dan wangi*, tanpa Anda capek',
                    'subtitle' => "Petugas {$company} terlatih, terverifikasi, dan datang membawa alat sendiri. Pesan hari ini, besok rumah sudah rapi.",
                    'button_label' => 'Lihat Paket', 'button_url' => '/layanan',
                    'button2_label' => 'Pesan via WhatsApp', 'button2_url' => '/kontak',
                    'image' => 'demo/cleaning-hero.jpg',
                ]],
                ['type' => 'stats', 'data' => ['items' => [
                    ['value' => '8.500+', 'label' => 'Rumah dibersihkan'],
                    ['value' => '120', 'label' => 'Petugas terlatih'],
                    ['value' => '4,9/5', 'label' => 'Rating pelanggan'],
                    ['value' => '100%', 'label' => 'Garansi bersih ulang'],
                ]]],
                ['type' => 'services', 'data' => ['title' => 'Layanan kami', 'subtitle' => 'Dari bersih harian sampai deep cleaning.', 'items' => [
                    ['title' => 'Bersih harian', 'text' => 'Sapu, pel, lap debu, dapur, dan kamar mandi.', 'image' => 'demo/cleaning-home.jpg'],
                    ['title' => 'Deep cleaning', 'text' => 'Kerak, noda membandel, dan sudut yang jarang tersentuh.', 'image' => 'demo/cleaning-floor.jpg'],
                    ['title' => 'Cuci sofa & kasur', 'text' => 'Bebas tungau, debu, dan bau tak sedap.', 'image' => 'demo/cleaning-sofa.jpg'],
                ]]],
                $packages,
                $steps,
                ['type' => 'testimonials', 'data' => ['title' => 'Kata pelanggan', 'items' => [
                    ['quote' => 'Petugasnya sopan dan teliti. Kamar mandi yang berkerak jadi kinclong.', 'name' => 'Bu Rina', 'role' => 'Pelanggan deep clean'],
                    ['quote' => 'Langganan tiap minggu untuk kantor kami. Selalu tepat waktu.', 'name' => 'Andi', 'role' => 'Office manager'],
                    ['quote' => 'Pesan pagi, sore sudah datang. Rumah siap untuk acara keluarga.', 'name' => 'Pak Hendra', 'role' => 'Pelanggan harian'],
                ]]],
                ['type' => 'cta', 'data' => ['title' => 'Akhir pekan ini mau santai saja?', 'text' => 'Serahkan bersih-bersihnya ke kami. Slot akhir pekan cepat penuh.', 'button_label' => 'Pesan Sekarang', 'button_url' => '/kontak']],
            ]],
            ['title' => 'Layanan', 'slug' => 'layanan', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Paket & Harga', 'subtitle' => 'Harga jelas di depan, tanpa biaya tersembunyi.', 'image' => 'demo/cleaning-room.jpg']],
                $packages,
                $extras,
                ['type' => 'services', 'data' => ['title' => 'Untuk bisnis', 'items' => [
                    ['title' => 'Kebersihan kantor', 'text' => 'Petugas harian atau terjadwal, dengan supervisor.', 'image' => 'demo/cleaning-office.jpg'],
                    ['title' => 'Disinfeksi', 'text' => 'Penyemprotan disinfektan untuk kantor, sekolah, dan toko.', 'image' => 'demo/cleaning-disinfect.jpg'],
                ]]],
                ['type' => 'faq', 'data' => ['title' => 'Pertanyaan umum', 'items' => [
                    ['question' => 'Apakah saya perlu menyiapkan alat?', 'answer' => 'Tidak. Petugas membawa alat dan cairan pembersih. Cukup sediakan air dan listrik.'],
                    ['question' => 'Apakah petugasnya aman?', 'answer' => 'Semua petugas sudah diverifikasi identitas dan dilatih. Barang Anda kami jamin.'],
                    ['question' => 'Bagaimana kalau hasilnya belum bersih?', 'answer' => 'Laporkan dalam 24 jam, kami bersihkan ulang tanpa biaya.'],
                ]]],
            ]],
            ['title' => 'Tentang', 'slug' => 'tentang', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Tentang Kami', 'subtitle' => 'Tim kebersihan yang bisa Anda percaya.']],
                ['type' => 'image_text', 'data' => ['title' => 'Bersih itu soal kepercayaan', 'body' => "{$company} berdiri karena sulitnya mencari jasa bersih yang tepat waktu dan bisa dipercaya masuk rumah.\n\n- Petugas terverifikasi dan berseragam\n- Alat dan cairan aman untuk anak dan hewan peliharaan\n- Garansi bersih ulang 24 jam", 'image' => 'demo/cleaning-wipe.jpg', 'image_position' => 'right']],
                $steps,
            ]],
            ['title' => 'Kontak', 'slug' => 'kontak', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Pesan Jadwal', 'subtitle' => 'Admin aktif setiap hari 07.00–21.00.']],
                ['type' => 'contact', 'data' => ['title' => 'Formulir pemesanan', 'text' => 'Tulis paket, tanggal, dan alamat. Kami konfirmasi jadwalnya lewat WhatsApp.', 'show_form' => 'yes']],
            ]],
        ];
    }
}
