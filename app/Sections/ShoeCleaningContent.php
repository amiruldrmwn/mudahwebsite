<?php

namespace App\Sections;

/**
 * Sample pages for the Shoe Cleaning template: treatments and prices per pair, pickup and
 * drop-off and contact. Photos from Unsplash (resources/demo/CREDITS.md).
 */
class ShoeCleaningContent
{
    /**
     * @return list<array<string, mixed>>
     */
    public static function pages(string $company): array
    {
        $prices = ['type' => 'pricelist', 'data' => ['title' => 'Treatment & harga', 'subtitle' => 'Harga per pasang. Semua treatment sudah termasuk cuci tali dan pewangi.', 'items' => [
            ['name' => 'Fast Clean', 'description' => 'Bersihkan bagian luar dan midsole. Cocok untuk perawatan rutin.', 'info' => '1 hari', 'price' => 'Rp35.000'],
            ['name' => 'Deep Clean', 'description' => 'Luar, dalam, insole, dan tali dicuci menyeluruh.', 'info' => '2–3 hari', 'price' => 'Rp55.000'],
            ['name' => 'Unyellowing', 'description' => 'Mengembalikan sol yang menguning jadi putih lagi.', 'info' => '3–4 hari', 'price' => 'Rp75.000'],
            ['name' => 'Repaint', 'description' => 'Cat ulang bagian yang pudar dengan warna yang mirip aslinya.', 'info' => '4–7 hari', 'price' => 'Rp150.000'],
            ['name' => 'Reglue', 'description' => 'Lem ulang sol yang mulai lepas.', 'info' => '2–3 hari', 'price' => 'Rp60.000'],
            ['name' => 'Protector', 'description' => 'Lapisan anti air dan noda setelah dicuci.', 'info' => '1 hari', 'price' => 'Rp30.000'],
            ['name' => 'Cuci Tas / Topi', 'description' => 'Tas kanvas, ransel, dan topi dicuci dengan sabun khusus.', 'info' => '2–3 hari', 'price' => 'Rp45.000'],
        ], 'note' => 'Sepatu kulit, suede, dan bahan khusus dicek dulu sebelum dicuci. Gratis antar jemput minimal 3 pasang.', 'order_button' => 'yes']];

        $steps = ['type' => 'steps', 'data' => ['title' => 'Cara pesan', 'subtitle' => 'Sepatu kinclong tanpa repot.', 'items' => [
            ['title' => 'Chat WhatsApp', 'text' => 'Kirim foto sepatu dan pilih treatment.'],
            ['title' => 'Antar atau kami jemput', 'text' => 'Bawa ke workshop, atau kurir kami yang datang.'],
            ['title' => 'Dicuci & dirawat', 'text' => 'Dikerjakan tangan, dengan cairan sesuai bahan sepatu.'],
            ['title' => 'Siap dipakai lagi', 'text' => 'Kami kabari lewat WhatsApp begitu selesai.'],
        ]]];

        return [
            ['title' => 'Beranda', 'slug' => 'beranda', 'is_home' => true, 'sections' => [
                ['type' => 'hero', 'data' => [
                    'eyebrow' => 'Cuci sepatu profesional',
                    'title' => 'Sepatu *kinclong* lagi, seperti baru beli',
                    'subtitle' => "{$company} merawat sneakers, sepatu kulit, suede, dan kanvas dengan tangan. Antar ke workshop atau kami jemput di rumah Anda.",
                    'button_label' => 'Lihat Harga', 'button_url' => '/layanan',
                    'button2_label' => 'Cara Pesan', 'button2_url' => '/layanan',
                    'image' => 'demo/sepatu-hero.jpg',
                ]],
                ['type' => 'stats', 'data' => ['items' => [
                    ['value' => '12rb+', 'label' => 'Pasang sepatu dirawat'],
                    ['value' => '1 hari', 'label' => 'Layanan kilat'],
                    ['value' => '4,9/5', 'label' => 'Rating pelanggan'],
                    ['value' => '100%', 'label' => 'Garansi cuci ulang'],
                ]]],
                ['type' => 'services', 'data' => ['title' => 'Treatment favorit', 'subtitle' => 'Dikerjakan tangan, sesuai bahan sepatu Anda.', 'items' => [
                    ['title' => 'Deep Clean', 'text' => 'Bagian luar, dalam, insole, dan tali dicuci sampai bersih dan wangi.', 'image' => 'demo/sepatu-deep.jpg'],
                    ['title' => 'Repaint', 'text' => 'Warna yang pudar dicat ulang serapi aslinya.', 'image' => 'demo/sepatu-repaint.jpg'],
                    ['title' => 'Perawatan Kulit', 'text' => 'Sepatu kulit dibersihkan, diberi nutrisi, dan disemir sampai mengilap.', 'image' => 'demo/sepatu-leather.jpg'],
                ]]],
                $steps,
                ['type' => 'testimonials', 'data' => ['title' => 'Kata pelanggan', 'items' => [
                    ['quote' => 'Sneakers putih saya yang sudah kusam jadi bersih total. Solnya putih lagi!', 'name' => 'Dimas', 'role' => 'Pelanggan unyellowing'],
                    ['quote' => 'Dijemput siang, dua hari kemudian diantar lagi wangi. Praktis banget.', 'name' => 'Nadia', 'role' => 'Karyawan swasta'],
                    ['quote' => 'Sepatu kulit kerja suami dirawat rapi, tidak ada yang rusak.', 'name' => 'Bu Sari', 'role' => 'Pelanggan langganan'],
                ]]],
                ['type' => 'cta', 'data' => ['title' => 'Sepatu kesayangan sudah kusam?', 'text' => 'Kirim fotonya sekarang, kami bantu pilih treatment yang pas.', 'button_label' => 'Chat Sekarang', 'button_url' => '/kontak']],
            ]],
            ['title' => 'Layanan', 'slug' => 'layanan', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Treatment & Harga', 'subtitle' => 'Pilih perawatan sesuai kondisi sepatu Anda.']],
                $prices,
                ['type' => 'services', 'data' => ['title' => 'Perawatan lain', 'items' => [
                    ['title' => 'Protector', 'text' => 'Lapisan pelindung anti air dan noda, agar sepatu bersih lebih lama.', 'image' => 'demo/sepatu-protect.jpg'],
                    ['title' => 'Perawatan Kulit', 'text' => 'Kulit dibersihkan, diberi nutrisi, dan disemir agar tidak retak.', 'image' => 'demo/sepatu-leather.jpg'],
                ]]],
                $steps,
                ['type' => 'faq', 'data' => ['title' => 'Pertanyaan umum', 'items' => [
                    ['question' => 'Bahan apa saja yang bisa dicuci?', 'answer' => 'Kanvas, mesh, kulit, suede, nubuck, dan knit. Bahan khusus kami cek dulu agar tidak rusak.'],
                    ['question' => 'Apakah noda pasti hilang?', 'answer' => 'Sebagian besar noda hilang. Noda lama atau cat kami kabari dulu kemungkinannya sebelum dikerjakan.'],
                    ['question' => 'Berapa lama pengerjaannya?', 'answer' => 'Fast Clean 1 hari, Deep Clean 2–3 hari. Treatment lain tergantung kondisi sepatu.'],
                ]]],
            ]],
            ['title' => 'Tentang', 'slug' => 'tentang', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Tentang Kami', 'subtitle' => 'Workshop perawatan sepatu yang dikerjakan dengan tangan.']],
                ['type' => 'image_text', 'data' => ['title' => 'Kami merawat sepatu seperti milik sendiri', 'body' => "{$company} berawal dari hobi merawat sneakers. Sekarang kami membantu ribuan pelanggan menjaga sepatu kesayangan tetap awet.\n\n- Dikerjakan tangan, bukan mesin cuci\n- Cairan pembersih sesuai bahan\n- Garansi cuci ulang kalau belum bersih", 'image' => 'demo/sepatu-tools.jpg', 'image_position' => 'right']],
            ]],
            ['title' => 'Kontak', 'slug' => 'kontak', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Hubungi Kami', 'subtitle' => 'Workshop buka setiap hari 09.00–20.00.']],
                ['type' => 'contact', 'data' => ['title' => 'Pesan cuci sepatu', 'text' => 'Tulis jumlah sepatu, treatment, dan alamat jemput kalau perlu.', 'show_form' => 'yes']],
            ]],
        ];
    }
}
