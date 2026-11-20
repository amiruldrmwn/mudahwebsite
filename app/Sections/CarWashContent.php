<?php

namespace App\Sections;

/**
 * Sample pages for the Cuci Mobil & Detailing template: wash packages priced by car size,
 * detailing and nano ceramic coating, home service, and a membership card.
 */
class CarWashContent
{
    /**
     * @return list<array<string, mixed>>
     */
    public static function pages(string $company): array
    {
        $packages = ['type' => 'plans', 'data' => ['title' => 'Paket cuci', 'subtitle' => 'Harga mulai dari city car. Sedan dan SUV/MPV lihat di daftar paket.', 'items' => [
            ['name' => 'Cuci Reguler', 'price' => 'Rp45rb', 'info' => '±30 menit', 'features' => "Cuci salju body & kolong\nVakum kabin dan bagasi\nSemir ban\nSedan Rp50rb · SUV/MPV Rp60rb"],
            ['name' => 'Cuci + Wax', 'badge' => 'Paling dipilih', 'price' => 'Rp85rb', 'old_price' => 'Rp100rb', 'info' => '±60 menit', 'features' => "Semua isi Cuci Reguler\nWax carnauba, kilap tahan 1 bulan\nPembersih jamur kaca ringan\nDashboard & doortrim dirawat\nSedan Rp95rb · SUV/MPV Rp110rb", 'highlight' => 'yes'],
            ['name' => 'Detailing Interior', 'price' => 'Rp450rb', 'info' => '±4 jam', 'features' => "Cuci jok kain atau kulit\nPlafon, karpet, dan sabuk\nFogging anti bau & bakteri\nSedan Rp550rb · SUV/MPV Rp650rb"],
        ], 'note' => 'Harga sudah termasuk sabun pH netral dan microfiber bersih untuk setiap mobil.']];

        $services = ['type' => 'services', 'data' => ['title' => 'Layanan kami', 'subtitle' => 'Dari cuci cepat sepulang kerja sampai coating untuk mobil baru.', 'items' => [
            ['title' => 'Cuci salju', 'text' => 'Busa tebal mengangkat debu tanpa menggores cat, dilanjut bilas air bertekanan.', 'image' => 'demo/cucimobil-busa.jpg'],
            ['title' => 'Detailing interior', 'text' => 'Kabin dibersihkan sampai sela-sela AC, jok, dan plafon. Wangi dan bebas bakteri.', 'image' => 'demo/cucimobil-interior.jpg'],
            ['title' => 'Poles & nano ceramic', 'text' => 'Hilangkan baret halus dan kusam, lalu lapisi ceramic agar cat kilap dan mudah dicuci.', 'image' => 'demo/cucimobil-poles.jpg'],
            ['title' => 'Velg & ban', 'text' => 'Kerak rem di velg dibersihkan, ban dirawat supaya hitam alami, tidak licin.', 'image' => 'demo/cucimobil-velg.jpg'],
        ]]];

        $member = ['type' => 'cta', 'data' => ['title' => 'Kartu member: cuci 9 kali, ke-10 gratis', 'text' => 'Daftar gratis di kasir atau lewat WhatsApp. Stempel tercatat otomatis, berlaku untuk semua ukuran mobil.', 'button_label' => 'Daftar Member', 'button_url' => '/member']];

        return [
            ['title' => 'Beranda', 'slug' => 'beranda', 'is_home' => true, 'sections' => [
                ['type' => 'hero', 'data' => [
                    'eyebrow' => 'Cuci mobil · Salon · Coating',
                    'title' => 'Mobil kinclong *seperti baru keluar dealer*',
                    'subtitle' => "{$company} mencuci dan merawat mobil Anda dengan sabun pH netral dan microfiber bersih. Bisa ditunggu sambil ngopi, atau kami jemput ke rumah.",
                    'button_label' => 'Lihat Paket & Harga', 'button_url' => '/layanan',
                    'button2_label' => 'Booking Antar-Jemput', 'button2_url' => '/kontak',
                    'image' => 'demo/cucimobil-hero.jpg',
                ]],
                ['type' => 'stats', 'data' => ['items' => [
                    ['value' => '30 mnt', 'label' => 'Cuci reguler selesai'],
                    ['value' => '25.000+', 'label' => 'Mobil sudah dicuci'],
                    ['value' => '4,9★', 'label' => 'Rating Google'],
                    ['value' => 'Gratis', 'label' => 'Jemput radius 5 km'],
                ]]],
                $services,
                $packages,
                ['type' => 'steps', 'data' => ['title' => 'Home service & antar-jemput', 'subtitle' => 'Tidak sempat ke tempat cuci? Kami yang datang.', 'items' => [
                    ['title' => 'Chat WhatsApp', 'text' => 'Kirim lokasi, jenis mobil, dan paket yang diinginkan.'],
                    ['title' => 'Kami jemput', 'text' => 'Driver berseragam menjemput mobil, atau tim datang membawa alat ke rumah.'],
                    ['title' => 'Dicuci & dirawat', 'text' => 'Foto sebelum dan sesudah dikirim ke WhatsApp Anda.'],
                    ['title' => 'Diantar kembali', 'text' => 'Mobil kembali bersih dan wangi. Bayar transfer atau QRIS.'],
                ]]],
                ['type' => 'testimonials', 'data' => ['title' => 'Kata pelanggan', 'items' => [
                    ['quote' => 'Jok mobil bekas anak-anak tumpah susu, bau asam. Setelah detailing interior bau hilang total dan jok seperti baru.', 'name' => 'Bu Ratna', 'role' => 'Detailing interior, Xpander'],
                    ['quote' => 'Pakai antar-jemput dari kantor. Mobil diambil jam 10, jam 2 sudah kembali bersih. Praktis sekali.', 'name' => 'Pak Hendra', 'role' => 'Cuci + Wax, Innova'],
                    ['quote' => 'Coating 9H di sini, sudah 8 bulan air hujan masih langsung meluncur. Cuci jadi cepat.', 'name' => 'Kevin', 'role' => 'Nano ceramic, Civic'],
                ]]],
                $member,
            ]],
            ['title' => 'Layanan', 'slug' => 'layanan', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Layanan & Harga', 'subtitle' => 'Harga dibedakan sesuai ukuran mobil: city car, sedan, dan SUV/MPV.']],
                $packages,
                ['type' => 'pricelist', 'data' => ['title' => 'Daftar harga per ukuran mobil', 'subtitle' => 'City car / Sedan / SUV & MPV.', 'items' => [
                    ['name' => 'Cuci reguler', 'description' => 'Body, kolong, vakum, semir ban', 'info' => '30 menit', 'price' => '45rb / 50rb / 60rb'],
                    ['name' => 'Cuci + wax', 'description' => 'Plus wax carnauba dan perawatan dashboard', 'info' => '60 menit', 'price' => '85rb / 95rb / 110rb'],
                    ['name' => 'Cuci mesin', 'description' => 'Ruang mesin dibersihkan aman dengan steam', 'info' => '45 menit', 'price' => '75rb / 85rb / 100rb'],
                    ['name' => 'Jamur kaca', 'description' => 'Semua kaca, termasuk kaca film', 'info' => '2 jam', 'price' => '250rb / 300rb / 350rb'],
                    ['name' => 'Poles body', 'description' => 'Hilangkan baret halus dan oksidasi', 'info' => '5 jam', 'price' => '600rb / 750rb / 900rb'],
                    ['name' => 'Detailing interior', 'description' => 'Jok, plafon, karpet, fogging', 'info' => '4 jam', 'price' => '450rb / 550rb / 650rb'],
                ], 'note' => 'Home service tambah Rp25.000 di luar radius 5 km.', 'order_button' => 'yes']],
                $services,
            ]],
            ['title' => 'Coating', 'slug' => 'coating', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Nano Ceramic Coating', 'subtitle' => 'Lapisan pelindung cat yang membuat mobil kilap lebih lama, tahan sinar UV, dan mudah dibersihkan.']],
                ['type' => 'catalog', 'data' => ['title' => 'Pilihan paket coating', 'subtitle' => 'Termasuk cuci, dekontaminasi, dan poles sebelum dilapisi. Harga untuk sedan.', 'items' => [
                    ['image' => 'demo/cucimobil-poles.jpg', 'name' => 'Coating 9H · 1 Layer', 'category' => 'Garansi 1 tahun', 'specs' => "Poles 1 tahap\nKilap tahan 12 bulan\nGratis maintenance 1×", 'price' => 'Rp2,5jt', 'unit' => '/mobil'],
                    ['image' => 'demo/cucimobil-hero.jpg', 'name' => 'Coating 9H · 2 Layer', 'category' => 'Garansi 2 tahun', 'badge' => 'Terlaris', 'specs' => "Poles 2 tahap\nCoating velg & kaca\nGratis maintenance 3×", 'price' => 'Rp3,9jt', 'unit' => '/mobil'],
                    ['image' => 'demo/cucimobil-spons.jpg', 'name' => 'Graphene Coating', 'category' => 'Garansi 3 tahun', 'specs' => "Poles 3 tahap\nAnti water spot\nGratis maintenance 6×", 'price' => 'Rp5,8jt', 'unit' => '/mobil'],
                ], 'button_label' => 'Konsultasi']],
                ['type' => 'image_text', 'data' => ['title' => 'Kenapa coating?', 'body' => "Cat mobil di iklim tropis cepat kusam karena panas, hujan asam, dan getah pohon. Coating membentuk lapisan keras yang melindungi cat.\n\n- Air dan kotoran tidak mudah menempel\n- Warna lebih dalam dan berkilau\n- Cuci cukup dengan air dan sabun\n- Kartu garansi dan jadwal maintenance tercatat", 'image' => 'demo/cucimobil-busa.jpg', 'image_position' => 'right', 'button_label' => 'Tanya Harga Mobil Saya', 'button_url' => '/kontak']],
                ['type' => 'faq', 'data' => ['title' => 'Seputar coating', 'items' => [
                    ['question' => 'Berapa lama pengerjaannya?', 'answer' => 'Satu sampai dua hari, tergantung kondisi cat dan paket. Mobil perlu menginap supaya lapisan mengering sempurna.'],
                    ['question' => 'Apakah mobil bekas bisa di-coating?', 'answer' => 'Bisa. Kami poles dulu untuk menghilangkan baret halus, baru dilapisi coating.'],
                    ['question' => 'Setelah coating boleh langsung dicuci?', 'answer' => 'Tunggu 7 hari sebelum dicuci dengan sabun. Selama itu cukup dibilas air bersih jika terkena hujan.'],
                ]]],
            ]],
            ['title' => 'Member', 'slug' => 'member', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Kartu Member', 'subtitle' => 'Makin sering cuci, makin hemat. Pendaftaran gratis.']],
                $member,
                ['type' => 'plans', 'data' => ['title' => 'Langganan bulanan', 'subtitle' => 'Untuk mobil yang dipakai setiap hari.', 'items' => [
                    ['name' => 'Langganan 4×', 'price' => 'Rp160rb', 'old_price' => 'Rp180rb', 'info' => 'sebulan, 1 mobil', 'features' => "4× cuci reguler\nBebas antre di jalur member\nCity car (sedan Rp180rb)"],
                    ['name' => 'Langganan 8×', 'badge' => 'Untuk mobil kerja', 'price' => 'Rp300rb', 'old_price' => 'Rp360rb', 'info' => 'sebulan, 1 mobil', 'features' => "8× cuci reguler\n1× wax gratis\nBebas antre di jalur member\nCity car (sedan Rp340rb)", 'highlight' => 'yes'],
                    ['name' => 'Armada & Kantor', 'price' => 'Nego', 'info' => 'mulai 5 mobil', 'features' => "Cuci di lokasi kantor\nTagihan bulanan\nLaporan foto setiap mobil"],
                ]]],
            ]],
            ['title' => 'Kontak', 'slug' => 'kontak', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Booking & Antar-Jemput', 'subtitle' => 'Buka setiap hari 08.00–20.00. Jemput gratis dalam radius 5 km.']],
                ['type' => 'contact', 'data' => ['title' => 'Pesan jadwal cuci', 'text' => 'Tulis jenis mobil, paket, alamat jemput, dan jam yang Anda inginkan.', 'show_form' => 'yes']],
            ]],
        ];
    }
}
