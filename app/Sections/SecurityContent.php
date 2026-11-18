<?php

namespace App\Sections;

/**
 * Sample pages for the Jasa Keamanan template: a licensed security services company (BUJP)
 * with guarding, events, patrol and CCTV, client sectors and a request-for-quote flow.
 */
class SecurityContent
{
    /**
     * @return list<array<string, mixed>>
     */
    public static function pages(string $company): array
    {
        $services = ['type' => 'services', 'data' => ['title' => 'Layanan pengamanan', 'subtitle' => 'Personel bersertifikat Gada Pratama, Madya, dan Utama.', 'items' => [
            ['title' => 'Satpam gedung & kantor', 'text' => 'Penjagaan 24 jam dengan sistem shift dan supervisor.', 'image' => 'demo/satpam-hero.jpg'],
            ['title' => 'Pengamanan ritel', 'text' => 'Pencegahan kehilangan untuk toko, mal, dan minimarket.', 'image' => 'demo/satpam-store.jpg'],
            ['title' => 'Patroli kawasan', 'text' => 'Patroli terjadwal untuk perumahan dan kawasan industri.', 'image' => 'demo/satpam-patrol.jpg'],
            ['title' => 'Pengamanan event', 'text' => 'Konser, pameran, dan acara perusahaan, berapa pun jumlah tamunya.', 'image' => 'demo/satpam-event.jpg'],
            ['title' => 'Pengawalan VIP', 'text' => 'Pengawalan pribadi untuk eksekutif dan tamu penting.', 'image' => 'demo/satpam-vip.jpg'],
            ['title' => 'CCTV & monitoring', 'text' => 'Pemasangan CCTV dan pemantauan dari control room.', 'image' => 'demo/satpam-cctv.jpg'],
        ]]];

        $steps = ['type' => 'steps', 'data' => ['title' => 'Cara bekerja sama', 'items' => [
            ['title' => 'Survei lokasi', 'text' => 'Tim kami datang menilai risiko dan kebutuhan personel. Gratis.'],
            ['title' => 'Penawaran', 'text' => 'Proposal jumlah personel, shift, dan biaya per bulan.'],
            ['title' => 'Penempatan', 'text' => 'Personel ditempatkan dengan SOP sesuai lokasi Anda.'],
            ['title' => 'Laporan rutin', 'text' => 'Laporan harian dan evaluasi bulanan bersama supervisor.'],
        ]]];

        return [
            ['title' => 'Beranda', 'slug' => 'beranda', 'is_home' => true, 'sections' => [
                ['type' => 'hero', 'data' => [
                    'eyebrow' => 'Badan Usaha Jasa Pengamanan berizin Polri',
                    'title' => 'Aset Anda *aman*, bisnis Anda tenang',
                    'subtitle' => "{$company} menyediakan satpam terlatih untuk gedung, pabrik, perumahan, ritel, dan event. Siaga 24 jam, dengan laporan yang bisa Anda pantau.",
                    'button_label' => 'Minta Penawaran', 'button_url' => '/kontak',
                    'button2_label' => 'Layanan Kami', 'button2_url' => '/layanan',
                    'image' => 'demo/satpam-hero.jpg',
                ]],
                ['type' => 'stats', 'data' => ['items' => [
                    ['value' => '1.500+', 'label' => 'Personel aktif'],
                    ['value' => '230', 'label' => 'Lokasi klien'],
                    ['value' => '24/7', 'label' => 'Control room'],
                    ['value' => '15 thn', 'label' => 'Pengalaman'],
                ]]],
                $services,
                ['type' => 'image_text', 'data' => ['title' => 'Kenapa memilih kami', 'body' => "- **Berizin resmi** sebagai BUJP dari Mabes Polri\n- **Personel bersertifikat** Gada Pratama hingga Utama\n- **Supervisor & patroli** mengecek pos secara berkala\n- **Asuransi** untuk personel dan tanggung jawab kepada klien\n- **Pengganti cepat** bila personel berhalangan", 'image' => 'demo/satpam-gate.jpg', 'image_position' => 'left', 'button_label' => 'Profil Perusahaan', 'button_url' => '/tentang']],
                $steps,
                ['type' => 'testimonials', 'data' => ['title' => 'Dipercaya klien', 'items' => [
                    ['quote' => 'Sejak memakai jasa mereka, kehilangan di gudang kami turun drastis.', 'name' => 'Budi Santoso', 'role' => 'Manajer Operasional, pabrik garmen'],
                    ['quote' => 'Satpam perumahan ramah ke warga tapi tegas ke tamu. Laporan rutin dikirim.', 'name' => 'Ibu Wulan', 'role' => 'Ketua RW, perumahan'],
                    ['quote' => 'Event 5.000 tamu berjalan lancar dan tertib.', 'name' => 'Rizky', 'role' => 'Event organizer'],
                ]]],
                ['type' => 'cta', 'data' => ['title' => 'Butuh personel pengamanan?', 'text' => 'Jadwalkan survei lokasi gratis, penawaran dikirim dalam 2 hari kerja.', 'button_label' => 'Minta Penawaran', 'button_url' => '/kontak']],
            ]],
            ['title' => 'Layanan', 'slug' => 'layanan', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Layanan Pengamanan', 'subtitle' => 'Solusi keamanan sesuai jenis lokasi dan tingkat risiko.', 'image' => 'demo/satpam-cameras.jpg']],
                $services,
                ['type' => 'plans', 'data' => ['title' => 'Kontrak personel', 'subtitle' => 'Kisaran biaya per personel per bulan, sudah termasuk gaji sesuai UMK, BPJS, seragam, dan pelatihan.', 'items' => [
                    ['name' => 'Gada Pratama', 'badge' => '', 'price' => 'Rp6,5jt', 'old_price' => '', 'info' => 'per personel / bulan', 'features' => "Penjagaan pos\n12 jam per shift\nSeragam & perlengkapan\nLaporan harian", 'highlight' => 'no'],
                    ['name' => 'Gada Madya', 'badge' => 'Untuk supervisor', 'price' => 'Rp8jt', 'old_price' => '', 'info' => 'per personel / bulan', 'features' => "Komandan regu\nMengatur shift & pos\nPelatihan anggota\nEvaluasi bulanan", 'highlight' => 'yes'],
                ], 'note' => 'Biaya akhir mengikuti UMK lokasi, jumlah shift, dan perlengkapan. Survei lokasi gratis.']],
                ['type' => 'faq', 'data' => ['title' => 'Pertanyaan umum', 'items' => [
                    ['question' => 'Berapa minimal personel?', 'answer' => 'Mulai 1 pos (2 personel untuk 24 jam). Untuk event, mulai 4 personel per hari.'],
                    ['question' => 'Bagaimana kalau personel berhalangan?', 'answer' => 'Kami menyiapkan personel cadangan, pengganti datang di hari yang sama.'],
                    ['question' => 'Apakah perusahaan berizin?', 'answer' => 'Ya, kami terdaftar sebagai BUJP dan semua personel memiliki KTA dan sertifikat Gada.'],
                ]]],
            ]],
            ['title' => 'Tentang', 'slug' => 'tentang', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Profil Perusahaan', 'subtitle' => 'Mitra keamanan untuk bisnis dan hunian sejak 2011.']],
                ['type' => 'image_text', 'data' => ['title' => 'Disiplin, sigap, dan bertanggung jawab', 'body' => "{$company} berdiri tahun 2011 dan kini menjaga lebih dari 200 lokasi di Jawa dan Sumatera.\n\nSetiap personel melewati seleksi, pelatihan Gada, dan pembinaan rutin dari supervisor kami.", 'image' => 'demo/satpam-patrol.jpg', 'image_position' => 'right']],
                ['type' => 'clients', 'data' => ['title' => 'Sektor yang kami layani', 'items' => [
                    ['name' => 'Perkantoran', 'logo' => ''], ['name' => 'Pabrik & gudang', 'logo' => ''], ['name' => 'Perumahan', 'logo' => ''],
                    ['name' => 'Ritel & mal', 'logo' => ''], ['name' => 'Rumah sakit', 'logo' => ''], ['name' => 'Sekolah & kampus', 'logo' => ''],
                ]]],
                $steps,
            ]],
            ['title' => 'Kontak', 'slug' => 'kontak', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Minta Penawaran', 'subtitle' => 'Control room siaga 24 jam. Kantor buka Senin–Jumat, 08.00–17.00.']],
                ['type' => 'contact', 'data' => ['title' => 'Formulir survei lokasi', 'text' => 'Tulis jenis lokasi, alamat, dan perkiraan jumlah personel yang dibutuhkan.', 'show_form' => 'yes']],
            ]],
        ];
    }
}
