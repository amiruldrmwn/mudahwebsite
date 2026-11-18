<?php

namespace App\Sections;

/**
 * Sample pages for the Jualan Kaos template: plain and custom t-shirts, polos, hoodies,
 * printing services, order steps and contact.
 */
class TshirtStoreContent
{
    /**
     * @return list<array<string, mixed>>
     */
    public static function pages(string $company): array
    {
        $categories = ['type' => 'gallery', 'data' => ['title' => 'Kaos polos per kategori', 'items' => [
            ['image' => 'demo/kaos-white.jpg', 'caption' => 'T-Shirt'],
            ['image' => 'demo/kaos-hoodie.jpg', 'caption' => 'Hoodie & Jaket'],
            ['image' => 'demo/kaos-polo.jpg', 'caption' => 'Polo Shirt'],
            ['image' => 'demo/kaos-rack.jpg', 'caption' => 'Kaos Olahraga'],
            ['image' => 'demo/kaos-cap.jpg', 'caption' => 'Topi'],
        ]]];

        $products = [
            ['name' => 'Kaos Premium Cotton 24s', 'description' => 'Katun combed lembut, jahitan rantai di bahu.', 'info' => '34 warna · S–5XL', 'price' => 'Rp42.000', 'image' => 'demo/kaos-black.jpg'],
            ['name' => 'Kaos Softstyle 30s', 'description' => 'Lebih tipis dan ringan, adem untuk harian.', 'info' => '28 warna · S–3XL', 'price' => 'Rp37.000', 'image' => 'demo/kaos-pink.jpg'],
            ['name' => 'Kaos Oversize Heavy 16s', 'description' => 'Bahan tebal 240 gsm, potongan boxy.', 'info' => '12 warna · M–XXL', 'price' => 'Rp65.000', 'image' => 'demo/kaos-orange.jpg'],
            ['name' => 'Polo Shirt Lacoste CVC', 'description' => 'Kerah rapi, cocok untuk seragam kantor.', 'info' => '18 warna · S–3XL', 'price' => 'Rp58.000', 'image' => 'demo/kaos-polo.jpg'],
            ['name' => 'Hoodie Fleece 280 gsm', 'description' => 'Hangat dan lembut, saku kanguru.', 'info' => '15 warna · S–2XL', 'price' => 'Rp140.000', 'image' => 'demo/kaos-hoodie.jpg'],
            ['name' => 'Topi Baseball Twill', 'description' => 'Strap belakang, bisa bordir logo.', 'info' => '10 warna', 'price' => 'Rp45.000', 'image' => 'demo/kaos-cap.jpg'],
        ];

        $steps = ['type' => 'steps', 'data' => ['title' => 'Cara order kaos custom', 'subtitle' => 'Satu pcs pun kami layani.', 'items' => [
            ['title' => 'Pilih kaos', 'text' => 'Tentukan bahan, warna, dan ukuran.'],
            ['title' => 'Kirim desain', 'text' => 'Kirim file desain atau minta dibantu tim kami.'],
            ['title' => 'Cetak & QC', 'text' => 'Dicetak DTF, sablon, atau bordir, lalu dicek satu per satu.'],
            ['title' => 'Kirim', 'text' => 'Ambil di toko atau kirim ke seluruh Indonesia.'],
        ]]];

        $testimonials = ['type' => 'testimonials', 'data' => ['title' => 'Dipercaya ribuan kreator & pelaku usaha', 'items' => [
            ['quote' => 'Order 1 pcs buat kado, hasil sablonnya tajam dan bahannya adem.', 'name' => 'Dimas', 'role' => 'Via Tokopedia'],
            ['quote' => 'Bikin 120 kaos event kantor, selesai 3 hari dan ukurannya pas semua.', 'name' => 'Rina', 'role' => 'HR, perusahaan logistik'],
            ['quote' => 'Sudah repeat order 7 kali untuk brand clothing saya. Konsisten!', 'name' => 'Gilang', 'role' => 'Via Instagram'],
        ]]];

        return [
            ['title' => 'Beranda', 'slug' => 'beranda', 'is_home' => true, 'sections' => [
                ['type' => 'hero', 'data' => [
                    'eyebrow' => 'Satuan & partai besar',
                    'title' => 'Kaos polos & *custom* tanpa minimum',
                    'subtitle' => "Desain hari ini, jadi hari ini. {$company} menyediakan kaos polos premium dan jasa cetak custom untuk pribadi, komunitas, maupun brand.",
                    'button_label' => 'Lihat Produk', 'button_url' => '/produk',
                    'button2_label' => 'Order Custom', 'button2_url' => '/custom',
                    'image' => 'demo/kaos-hero.jpg',
                ]],
                ['type' => 'stats', 'data' => ['items' => [
                    ['value' => '1 pcs', 'label' => 'Minimum order'],
                    ['value' => '1 hari', 'label' => 'Waktu produksi'],
                    ['value' => '34', 'label' => 'Pilihan warna'],
                    ['value' => '25rb+', 'label' => 'Pelanggan puas'],
                ]]],
                $categories,
                ['type' => 'pricelist', 'data' => ['title' => 'Paling populer', 'subtitle' => 'Harga satuan kaos polos, sebelum cetak.', 'items' => $products, 'order_button' => 'yes']],
                ['type' => 'image_text', 'data' => ['title' => 'Cetak custom satuan, hasil setara pabrik', 'body' => "Mesin DTF dan sablon manual kami siap mengerjakan desain apa pun, dari logo kecil sampai full print.\n\n- Cetak DTF, sablon plastisol, dan bordir\n- Gratis bantuan desain sederhana\n- Diskon bertingkat mulai 12 pcs", 'image' => 'demo/kaos-print.jpg', 'image_position' => 'left', 'button_label' => 'Mulai Custom', 'button_url' => '/custom']],
                $testimonials,
                ['type' => 'cta', 'data' => ['title' => 'Butuh kaos untuk event atau seragam?', 'text' => 'Kirim jumlah dan desainmu, kami hitungkan penawaran dalam 15 menit.', 'button_label' => 'Minta Penawaran', 'button_url' => '/kontak']],
            ]],
            ['title' => 'Produk', 'slug' => 'produk', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Kaos Polos Premium', 'subtitle' => 'Bahan pilihan, warna lengkap, ukuran S sampai 5XL.']],
                $categories,
                ['type' => 'pricelist', 'data' => ['title' => 'Semua produk', 'items' => $products, 'note' => 'Harga grosir berlaku mulai 12 pcs. Tanyakan katalog warna lengkap ke admin.', 'order_button' => 'yes']],
                ['type' => 'image_text', 'data' => ['title' => 'Belanja berdasarkan warna', 'body' => 'Dari hitam, putih, butter, lilac, sampai maroon. Semua warna tersedia di toko untuk dilihat dan diraba langsung.', 'image' => 'demo/kaos-colors.jpg', 'image_position' => 'right']],
            ]],
            ['title' => 'Custom', 'slug' => 'custom', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Kaos Custom', 'subtitle' => 'Cetak desainmu sendiri, mulai satu pcs.']],
                $steps,
                ['type' => 'pricelist', 'data' => ['title' => 'Harga cetak', 'items' => [
                    ['name' => 'DTF ukuran A6', 'description' => 'Logo dada atau lengan.', 'info' => '10×15 cm', 'price' => 'Rp10.000'],
                    ['name' => 'DTF ukuran A4', 'description' => 'Desain depan atau belakang.', 'info' => '21×30 cm', 'price' => 'Rp25.000'],
                    ['name' => 'DTF ukuran A3', 'description' => 'Full print besar.', 'info' => '30×42 cm', 'price' => 'Rp40.000'],
                    ['name' => 'Sablon plastisol', 'description' => 'Untuk 24 pcs ke atas, per warna.', 'info' => 'min. 24 pcs', 'price' => 'Rp8.000'],
                    ['name' => 'Bordir logo', 'description' => 'Rapi dan awet untuk seragam.', 'info' => 's.d. 8 cm', 'price' => 'Rp15.000'],
                ], 'note' => 'Harga per sisi, belum termasuk kaos.', 'order_button' => 'yes']],
                ['type' => 'faq', 'data' => ['title' => 'Pertanyaan umum', 'items' => [
                    ['question' => 'Benar bisa order 1 pcs?', 'answer' => 'Benar. Dengan teknik DTF, kami bisa mencetak satuan dengan hasil tajam dan warna penuh.'],
                    ['question' => 'Berapa lama pengerjaannya?', 'answer' => 'Order satuan bisa jadi di hari yang sama. Partai besar 2–5 hari kerja tergantung jumlah.'],
                    ['question' => 'File desain seperti apa?', 'answer' => 'PNG transparan minimal 300 dpi, atau file AI/PDF. Kalau belum punya, tim kami bisa bantu.'],
                ]]],
            ]],
            ['title' => 'Tentang', 'slug' => 'tentang', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Tentang Kami', 'subtitle' => 'Konveksi dan toko kaos yang mudah dijangkau.']],
                ['type' => 'image_text', 'data' => ['title' => 'Dari workshop kecil ke ribuan pelanggan', 'body' => "{$company} lahir dari workshop sablon kecil. Kini kami melayani pelanggan pribadi, komunitas, sekolah, hingga brand clothing di seluruh Indonesia.", 'image' => 'demo/kaos-store.jpg', 'image_position' => 'right']],
                ['type' => 'gallery', 'data' => ['title' => 'Toko & workshop', 'items' => [
                    ['image' => 'demo/kaos-store.jpg', 'caption' => 'Toko'],
                    ['image' => 'demo/kaos-print.jpg', 'caption' => 'Produksi'],
                    ['image' => 'demo/kaos-folded.jpg', 'caption' => 'Packing'],
                    ['image' => 'demo/kaos-rack.jpg', 'caption' => 'Stok warna'],
                    ['image' => 'demo/kaos-model.jpg', 'caption' => 'Fitting'],
                ]]],
                $testimonials,
            ]],
            ['title' => 'Kontak', 'slug' => 'kontak', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Hubungi Kami', 'subtitle' => 'Buka setiap hari 09.00–21.00.']],
                ['type' => 'contact', 'data' => ['title' => 'Minta penawaran', 'text' => 'Ceritakan jenis kaos, jumlah, dan desain yang kamu mau. Kami balas cepat.', 'show_form' => 'yes']],
            ]],
        ];
    }
}
