<?php

namespace App\Sections;

/**
 * Sample pages for the Kontraktor & Renovasi template: build and renovation services, price
 * per m², before-and-after projects and a survey request.
 */
class ContractorContent
{
    /**
     * @return list<array<string, mixed>>
     */
    public static function pages(string $company): array
    {
        $services = ['type' => 'services', 'data' => ['title' => 'Layanan kami', 'subtitle' => 'Dari gambar desain sampai serah terima kunci.', 'items' => [
            ['title' => 'Bangun rumah baru', 'text' => 'Rumah tinggal 1–3 lantai, lengkap dengan gambar kerja dan RAB.', 'image' => 'demo/kontraktor-hero.jpg'],
            ['title' => 'Renovasi & tambah lantai', 'text' => 'Perbaikan atap, dak, tambah kamar, dan peningkatan struktur.', 'image' => 'demo/kontraktor-before.jpg'],
            ['title' => 'Interior & kitchen set', 'text' => 'Dapur, lemari built-in, plafon, dan finishing interior.', 'image' => 'demo/kontraktor-dapur.jpg'],
            ['title' => 'Desain & RAB', 'text' => 'Gambar arsitektur, 3D, dan rencana anggaran biaya yang rinci.', 'image' => 'demo/kontraktor-plan.jpg'],
        ]]];

        $prices = ['type' => 'pricelist', 'data' => ['title' => 'Estimasi biaya per m²', 'subtitle' => 'Harga borongan jasa dan material. Angka pasti kami hitung setelah survei.', 'items' => [
            ['name' => 'Bangun rumah standar', 'description' => 'Struktur beton, bata ringan, keramik 60×60', 'info' => 'per m²', 'price' => 'Rp3.800.000'],
            ['name' => 'Bangun rumah premium', 'description' => 'Granit, kusen aluminium, plafon gypsum drop ceiling', 'info' => 'per m²', 'price' => 'Rp5.500.000'],
            ['name' => 'Renovasi ringan', 'description' => 'Cat ulang, ganti keramik, perbaikan plafon', 'info' => 'per m²', 'price' => 'mulai Rp850.000'],
            ['name' => 'Tambah lantai 2', 'description' => 'Termasuk perkuatan struktur dan tangga', 'info' => 'per m²', 'price' => 'Rp4.200.000'],
            ['name' => 'Kitchen set', 'description' => 'Multipleks HPL, top table granit', 'info' => 'per meter lari', 'price' => 'Rp2.900.000'],
            ['name' => 'Desain & RAB', 'description' => 'Gratis jika lanjut bangun bersama kami', 'info' => 'per m²', 'price' => 'Rp35.000'],
        ], 'order_button' => 'no']];

        $projects = ['type' => 'gallery', 'data' => ['title' => 'Proyek terbaru', 'items' => [
            ['image' => 'demo/kontraktor-before.jpg', 'caption' => 'Sebelum: renovasi total rumah lama, Bekasi'],
            ['image' => 'demo/kontraktor-after.jpg', 'caption' => 'Sesudah: dapur terbuka dengan island'],
            ['image' => 'demo/kontraktor-hero.jpg', 'caption' => 'Rumah 2 lantai dengan kolam renang, Bogor'],
            ['image' => 'demo/kontraktor-interior.jpg', 'caption' => 'Ruang keluarga, Tangerang Selatan'],
            ['image' => 'demo/kontraktor-dapur.jpg', 'caption' => 'Kitchen set klasik modern'],
            ['image' => 'demo/kontraktor-plester.jpg', 'caption' => 'Pekerjaan plester & aci dinding'],
        ]]];

        return [
            ['title' => 'Beranda', 'slug' => 'beranda', 'is_home' => true, 'sections' => [
                ['type' => 'hero', 'data' => [
                    'eyebrow' => 'Kontraktor & renovasi rumah',
                    'title' => 'Bangun dan renovasi rumah, *tepat waktu dan tepat anggaran*',
                    'subtitle' => "{$company} mengerjakan rumah baru, renovasi, dan interior dengan RAB transparan, garansi struktur, dan laporan progres mingguan.",
                    'button_label' => 'Survei Gratis', 'button_url' => '/kontak',
                    'button2_label' => 'Lihat Proyek', 'button2_url' => '/proyek',
                    'image' => 'demo/kontraktor-hero.jpg',
                ]],
                ['type' => 'stats', 'data' => ['items' => [
                    ['value' => '180+', 'label' => 'Proyek selesai'],
                    ['value' => '12 thn', 'label' => 'Pengalaman'],
                    ['value' => '10 thn', 'label' => 'Garansi struktur'],
                    ['value' => '0', 'label' => 'Biaya tersembunyi'],
                ]]],
                $services,
                ['type' => 'image_text', 'data' => ['title' => 'RAB jelas sebelum mulai', 'body' => "Setiap item pekerjaan kami tulis dengan volume dan harga satuannya. Tidak ada tambahan biaya tanpa persetujuan Anda.\n\n- Kontrak kerja tertulis\n- Pembayaran bertahap sesuai progres\n- Foto dan video progres setiap minggu\n- Pengawas lapangan di setiap proyek", 'image' => 'demo/kontraktor-plan.jpg', 'image_position' => 'right', 'button_label' => 'Minta RAB', 'button_url' => '/kontak']],
                $projects,
                ['type' => 'steps', 'data' => ['title' => 'Alur kerja', 'items' => [
                    ['title' => 'Survei lokasi', 'text' => 'Gratis untuk wilayah Jabodetabek. Kami ukur dan diskusikan kebutuhan Anda.'],
                    ['title' => 'Desain & RAB', 'text' => 'Gambar kerja, tampilan 3D, dan rincian biaya.'],
                    ['title' => 'Kontrak & mulai', 'text' => 'Tanda tangan kontrak, DP, dan tim mulai bekerja.'],
                    ['title' => 'Serah terima', 'text' => 'Cek bersama, perbaikan jika ada, lalu garansi berjalan.'],
                ]]],
                ['type' => 'cta', 'data' => ['title' => 'Punya rencana membangun?', 'text' => 'Kirim foto lokasi dan ukuran lahan, kami beri estimasi awal hari ini juga.', 'button_label' => 'Jadwalkan Survei', 'button_url' => '/kontak']],
            ]],
            ['title' => 'Layanan', 'slug' => 'layanan', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Layanan & Harga', 'subtitle' => 'Borongan penuh atau jasa saja, sesuai kebutuhan Anda.', 'image' => 'demo/kontraktor-tukang.jpg']],
                $services,
                $prices,
                ['type' => 'faq', 'data' => ['title' => 'Pertanyaan umum', 'items' => [
                    ['question' => 'Apakah bisa bayar bertahap?', 'answer' => 'Bisa. Umumnya DP 20%, lalu termin sesuai progres pekerjaan, dan 5% retensi setelah serah terima.'],
                    ['question' => 'Apakah membantu urus PBG/IMB?', 'answer' => 'Ya, kami bantu siapkan gambar dan dokumen yang dibutuhkan untuk pengajuan PBG.'],
                    ['question' => 'Berapa lama membangun rumah 2 lantai?', 'answer' => 'Rata-rata 5–7 bulan untuk rumah 120 m², tergantung desain dan cuaca.'],
                ]]],
            ]],
            ['title' => 'Proyek', 'slug' => 'proyek', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Portofolio Proyek', 'subtitle' => 'Sebagian pekerjaan kami untuk keluarga dan bisnis.']],
                $projects,
                ['type' => 'testimonials', 'data' => ['title' => 'Kata klien', 'items' => [
                    ['quote' => 'Renovasi selesai 2 minggu lebih cepat dari jadwal, dan RAB-nya tidak membengkak.', 'name' => 'Ibu Ratna', 'role' => 'Renovasi rumah, Bekasi'],
                    ['quote' => 'Laporan progres tiap minggu bikin tenang, walau saya kerja di luar kota.', 'name' => 'Pak Yudi', 'role' => 'Bangun rumah baru, Depok'],
                    ['quote' => 'Kitchen set rapi dan kuat, tukangnya sopan dan bersih.', 'name' => 'Mbak Sari', 'role' => 'Interior dapur, Jakarta'],
                ]]],
            ]],
            ['title' => 'Kontak', 'slug' => 'kontak', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Jadwalkan Survei', 'subtitle' => 'Survei dan konsultasi gratis, tanpa kewajiban.']],
                ['type' => 'contact', 'data' => ['title' => 'Ceritakan rencana Anda', 'text' => 'Tulis lokasi, luas lahan atau bangunan, dan pekerjaan yang diinginkan. Kami hubungi dalam 1×24 jam.', 'show_form' => 'yes']],
            ]],
        ];
    }
}
