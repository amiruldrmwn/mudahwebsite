<?php

namespace App\Sections;

/**
 * Sample pages for the Bio Link template: one card with a creator profile, stacked links,
 * featured products, reviews, latest content and a contact form.
 */
class BioLinkContent
{
    /**
     * @return list<array<string, mixed>>
     */
    public static function pages(string $company): array
    {
        $products = ['type' => 'pricelist', 'data' => ['title' => 'Produk unggulan', 'items' => [
            ['name' => 'Kelas Konten 30 Hari', 'description' => 'Video, worksheet, dan grup diskusi.', 'info' => 'Terlaris', 'price' => 'Rp299.000', 'image' => 'demo/bio-course.jpg'],
            ['name' => 'Template Canva 100+', 'description' => 'Feed, story, dan carousel siap edit.', 'info' => 'Baru', 'price' => 'Rp99.000', 'image' => 'demo/bio-template.jpg'],
            ['name' => 'E-book Jualan di IG', 'description' => '60 halaman strategi dan contoh.', 'info' => 'PDF', 'price' => 'Rp59.000', 'image' => 'demo/bio-ebook.jpg'],
            ['name' => 'Konsultasi 1-on-1', 'description' => 'Sesi 60 menit via Zoom.', 'info' => 'Terbatas', 'price' => 'Rp450.000', 'image' => 'demo/bio-live.jpg'],
        ], 'order_button' => 'yes']];

        return [
            ['title' => 'Beranda', 'slug' => 'beranda', 'is_home' => true, 'sections' => [
                ['type' => 'hero', 'data' => [
                    'eyebrow' => 'Kreator konten & mentor bisnis online',
                    'title' => $company,
                    'subtitle' => 'Saya membantu UMKM dan pemula membangun brand di media sosial lewat kelas, template, dan konsultasi yang praktis.',
                    'button_label' => 'Chat Saya', 'button_url' => '/kontak',
                    'button2_label' => 'Lihat Kelas', 'button2_url' => '/kelas',
                    'image' => 'demo/bio-avatar.jpg',
                ]],
                ['type' => 'stats', 'data' => ['items' => [
                    ['value' => '120rb+', 'label' => 'Pengikut'],
                    ['value' => '2.500+', 'label' => 'Murid kelas'],
                    ['value' => '8 th', 'label' => 'Pengalaman'],
                ]]],
                ['type' => 'links', 'data' => ['items' => [
                    ['title' => 'Kelas Konten 30 Hari', 'text' => 'Bangun konten konsisten dari nol.', 'url' => '/kelas', 'badge' => 'Terlaris', 'image' => 'demo/bio-course.jpg'],
                    ['title' => 'Template Canva 100+', 'text' => 'Desain feed rapi tanpa ribet.', 'url' => '/kelas', 'badge' => 'Baru', 'image' => 'demo/bio-template.jpg'],
                    ['title' => 'E-book gratis: 30 ide konten', 'text' => 'Unduh gratis, langsung pakai.', 'url' => '/kontak', 'badge' => 'Gratis', 'image' => 'demo/bio-ebook.jpg'],
                    ['title' => 'Kerja sama & endorse', 'text' => 'Rate card dan portofolio brand.', 'url' => '/kontak', 'badge' => '', 'image' => 'demo/bio-creator.jpg'],
                ]]],
                $products,
                ['type' => 'testimonials', 'data' => ['title' => 'Kata mereka', 'items' => [
                    ['quote' => 'Setelah ikut kelasnya, penjualan toko saya di Instagram naik dua kali lipat.', 'name' => 'Dewi', 'role' => 'Pemilik toko kue'],
                    ['quote' => 'Templatenya cantik dan gampang diedit. Feed jadi rapi banget.', 'name' => 'Arif', 'role' => 'Fotografer'],
                    ['quote' => 'Konsultasinya to the point, langsung tahu harus mulai dari mana.', 'name' => 'Maya', 'role' => 'Founder skincare lokal'],
                ]]],
                ['type' => 'posts', 'data' => ['title' => 'Konten terbaru', 'items' => [
                    ['image' => 'demo/bio-creator.jpg', 'category' => 'Video', 'date' => '15 Nov 2026', 'title' => 'Cara bikin konten seminggu dalam satu hari', 'text' => 'Batching konten ala kreator.'],
                    ['image' => 'demo/bio-live.jpg', 'category' => 'Live', 'date' => '8 Nov 2026', 'title' => 'Rekaman live: tanya jawab jualan online', 'text' => 'Menjawab 20 pertanyaan terpopuler.'],
                ]]],
                ['type' => 'cta', 'data' => ['title' => 'Yuk kerja sama!', 'text' => 'Terbuka untuk endorse, workshop, dan pembicara.', 'button_label' => 'Hubungi Saya', 'button_url' => '/kontak']],
            ]],
            ['title' => 'Kelas', 'slug' => 'kelas', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Kelas & Produk Digital', 'subtitle' => 'Belajar praktis, bisa diakses selamanya.']],
                $products,
                ['type' => 'faq', 'data' => ['title' => 'Pertanyaan umum', 'items' => [
                    ['question' => 'Bagaimana cara membeli?', 'answer' => 'Klik tombol Pesan, lalu ikuti instruksi pembayaran dari admin lewat WhatsApp.'],
                    ['question' => 'Apakah akses kelas selamanya?', 'answer' => 'Ya, termasuk update materi di masa mendatang.'],
                ]]],
            ]],
            ['title' => 'Kontak', 'slug' => 'kontak', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Hubungi Saya', 'subtitle' => 'Untuk kerja sama, pertanyaan kelas, atau sekadar menyapa.']],
                ['type' => 'contact', 'data' => ['title' => 'Kirim pesan', 'text' => 'Saya balas dalam 1x24 jam di hari kerja.', 'show_form' => 'yes']],
            ]],
        ];
    }
}
