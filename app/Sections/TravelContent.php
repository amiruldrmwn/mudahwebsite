<?php

namespace App\Sections;

/**
 * Sample pages for the Tour & Travel template: open trips and private tours to Indonesian
 * destinations, itineraries, a destination gallery and booking.
 */
class TravelContent
{
    /**
     * @return list<array<string, mixed>>
     */
    public static function pages(string $company): array
    {
        $trips = ['type' => 'catalog', 'data' => ['title' => 'Paket trip pilihan', 'subtitle' => 'Harga per orang, minimal 2 peserta. Jadwal open trip setiap minggu.', 'button_label' => 'Pesan', 'items' => [
            ['image' => 'demo/travel-hero.jpg', 'name' => 'Sailing Komodo 3H2M', 'category' => 'Labuan Bajo', 'badge' => 'Terlaris', 'specs' => "Kapal phinisi kabin AC\nPulau Padar & Pink Beach\nSnorkeling Manta Point\nMakan 3x sehari", 'price' => 'Rp3.950.000', 'unit' => '/pax'],
            ['image' => 'demo/travel-bromo.jpg', 'name' => 'Bromo Sunrise 2H1M', 'category' => 'Jawa Timur', 'specs' => "Jeep 4x4 & penginapan\nPenanjakan & lautan pasir\nBukit Teletubbies\nJemput Malang / Surabaya", 'price' => 'Rp850.000', 'unit' => '/pax'],
            ['image' => 'demo/travel-kapal.jpg', 'name' => 'Private Trip Komodo', 'category' => 'Labuan Bajo', 'badge' => 'Private', 'specs' => "Kapal khusus rombongan\nItinerary bebas\nDokumentasi drone\nCocok keluarga & kantor", 'price' => 'Rp18.500.000', 'unit' => '/kapal'],
            ['image' => 'demo/travel-jeep.jpg', 'name' => 'Bromo Midnight Tour', 'category' => 'Jawa Timur', 'specs' => "Berangkat tengah malam\nJeep sharing 6 orang\nTiket masuk & guide\nTanpa menginap", 'price' => 'Rp450.000', 'unit' => '/pax'],
            ['image' => 'demo/travel-pink.jpg', 'name' => 'Day Trip Pink Beach', 'category' => 'Labuan Bajo', 'specs' => "Speedboat sehari\nPink Beach & Pulau Kanawa\nAlat snorkeling\nMakan siang", 'price' => 'Rp1.250.000', 'unit' => '/pax'],
            ['image' => 'demo/travel-sunset.jpg', 'name' => 'Honeymoon Labuan Bajo 4H3M', 'category' => 'Paket pasangan', 'badge' => 'Romantis', 'specs' => "Hotel tepi laut\nDinner sunset di kapal\nTrip Padar & Komodo\nFoto pre-wedding", 'price' => 'Rp7.900.000', 'unit' => '/pasangan'],
        ]]];

        $gallery = ['type' => 'gallery', 'data' => ['title' => 'Destinasi favorit', 'items' => [
            ['image' => 'demo/travel-hero.jpg', 'caption' => 'Pulau Padar, Labuan Bajo'],
            ['image' => 'demo/travel-bromo.jpg', 'caption' => 'Gunung Bromo saat fajar'],
            ['image' => 'demo/travel-pink.jpg', 'caption' => 'Pink Beach'],
            ['image' => 'demo/travel-komodo.jpg', 'caption' => 'Komodo di Pulau Rinca'],
            ['image' => 'demo/travel-teluk.jpg', 'caption' => 'Teluk Gili Lawa'],
            ['image' => 'demo/travel-jeep.jpg', 'caption' => 'Jeep di lautan pasir Bromo'],
        ]]];

        return [
            ['title' => 'Beranda', 'slug' => 'beranda', 'is_home' => true, 'sections' => [
                ['type' => 'hero', 'data' => [
                    'eyebrow' => 'Open trip & private tour',
                    'title' => 'Jelajahi Indonesia, *tanpa ribet*',
                    'subtitle' => "{$company} mengurus transportasi, penginapan, tiket, dan pemandu. Anda tinggal berangkat dan menikmati perjalanan.",
                    'button_label' => 'Lihat Paket Trip', 'button_url' => '/paket',
                    'button2_label' => 'Tanya Jadwal', 'button2_url' => '/kontak',
                    'image' => 'demo/travel-hero.jpg',
                ]],
                ['type' => 'stats', 'data' => ['items' => [
                    ['value' => '12.000+', 'label' => 'Peserta trip'],
                    ['value' => '25', 'label' => 'Destinasi'],
                    ['value' => '4,9/5', 'label' => 'Ulasan Google'],
                    ['value' => 'Resmi', 'label' => 'Berizin & berasuransi'],
                ]]],
                $trips,
                ['type' => 'image_text', 'data' => ['title' => 'Semua sudah diurus', 'body' => "- Penjemputan dari bandara atau stasiun\n- Penginapan dan kapal yang sudah kami cek sendiri\n- Pemandu lokal berlisensi\n- Dokumentasi foto selama trip\n- Asuransi perjalanan untuk setiap peserta", 'image' => 'demo/travel-kapal.jpg', 'image_position' => 'left', 'button_label' => 'Konsultasi Gratis', 'button_url' => '/kontak']],
                $gallery,
                ['type' => 'testimonials', 'data' => ['title' => 'Cerita peserta', 'items' => [
                    ['quote' => 'Trip Komodo paling seru! Kapalnya bersih, kru ramah, dan fotonya keren semua.', 'name' => 'Nadia', 'role' => 'Open trip Labuan Bajo'],
                    ['quote' => 'Outing kantor 40 orang ke Bromo diurus lengkap. Tinggal duduk manis.', 'name' => 'Pak Bambang', 'role' => 'HRD perusahaan logistik'],
                    ['quote' => 'Honeymoon kami sempurna, dinner sunset di kapal tidak terlupakan.', 'name' => 'Rizky & Ayu', 'role' => 'Paket honeymoon'],
                ]]],
                ['type' => 'cta', 'data' => ['title' => 'Siap liburan?', 'text' => 'Kirim tanggal dan jumlah peserta, kami buatkan itinerary dan harga dalam 1 jam.', 'button_label' => 'Chat Admin Trip', 'button_url' => '/kontak']],
            ]],
            ['title' => 'Paket Trip', 'slug' => 'paket', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Paket Trip', 'subtitle' => 'Open trip berangkat setiap minggu. Private trip bisa pilih tanggal sendiri.', 'image' => 'demo/travel-sunset.jpg']],
                $trips,
                ['type' => 'steps', 'data' => ['title' => 'Contoh itinerary Sailing Komodo 3H2M', 'items' => [
                    ['title' => 'Hari 1', 'text' => 'Jemput di bandara Komodo, naik kapal ke Pulau Kelor dan Manjarite, sunset di Pulau Kalong.'],
                    ['title' => 'Hari 2', 'text' => 'Sunrise di Pulau Padar, Pink Beach, trekking Pulau Komodo, snorkeling Manta Point.'],
                    ['title' => 'Hari 3', 'text' => 'Pulau Kanawa, kembali ke Labuan Bajo, antar ke bandara.'],
                ]]],
                ['type' => 'faq', 'data' => ['title' => 'Pertanyaan seputar trip', 'items' => [
                    ['question' => 'Apa bedanya open trip dan private trip?', 'answer' => 'Open trip berangkat bersama peserta lain dengan jadwal tetap, harganya lebih hemat. Private trip khusus rombongan Anda dan jadwalnya bebas.'],
                    ['question' => 'Berapa uang muka yang harus dibayar?', 'answer' => 'DP 30% untuk mengunci jadwal, pelunasan paling lambat 7 hari sebelum berangkat.'],
                    ['question' => 'Bagaimana jika cuaca buruk?', 'answer' => 'Rute disesuaikan demi keselamatan. Jika trip batal dari pihak kami, uang kembali penuh atau jadwal dipindah.'],
                ]]],
            ]],
            ['title' => 'Destinasi', 'slug' => 'destinasi', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Destinasi', 'subtitle' => 'Tempat-tempat terbaik yang sudah kami jelajahi bersama ribuan peserta.']],
                $gallery,
                ['type' => 'services', 'data' => ['title' => 'Jenis perjalanan', 'items' => [
                    ['title' => 'Open trip', 'text' => 'Berangkat bersama teman baru, harga hemat, jadwal tetap setiap minggu.', 'image' => 'demo/travel-pink.jpg'],
                    ['title' => 'Private & keluarga', 'text' => 'Khusus rombongan Anda, itinerary dan tanggal bebas.', 'image' => 'demo/travel-kapal.jpg'],
                    ['title' => 'Outing kantor', 'text' => 'Gathering, team building, dan insentif karyawan.', 'image' => 'demo/travel-jeep.jpg'],
                ]]],
            ]],
            ['title' => 'Kontak', 'slug' => 'kontak', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Pesan Trip', 'subtitle' => 'Admin kami membalas setiap hari pukul 08.00–21.00.']],
                ['type' => 'contact', 'data' => ['title' => 'Tanya jadwal & harga', 'text' => 'Tulis destinasi, tanggal, dan jumlah peserta. Kami kirim itinerary lengkap lewat WhatsApp.', 'show_form' => 'yes']],
            ]],
        ];
    }
}
