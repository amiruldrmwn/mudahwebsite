<?php

namespace App\Sections;

/**
 * Sample pages for the Konsultan Pajak & Akuntan template: monthly packages, tax services,
 * the tax calendar, FAQ and consultation booking.
 */
class TaxConsultantContent
{
    /**
     * @return list<array<string, mixed>>
     */
    public static function pages(string $company): array
    {
        $services = ['type' => 'services', 'data' => ['title' => 'Layanan pajak & akuntansi', 'subtitle' => 'Dikerjakan konsultan bersertifikat (Brevet A/B/C), dilaporkan tepat waktu lewat Coretax.', 'items' => [
            ['title' => 'SPT Tahunan pribadi & badan', 'text' => 'Hitung, isi, dan lapor SPT 1770 S/SS dan SPT Badan 1771, termasuk lampiran laporan keuangan.', 'image' => ''],
            ['title' => 'Pembukuan & laporan keuangan', 'text' => 'Jurnal bulanan, neraca, laba rugi, dan arus kas sesuai SAK EMKM atau SAK ETAP.', 'image' => ''],
            ['title' => 'PPN & e-Faktur', 'text' => 'Pengukuhan PKP, pembuatan faktur pajak, rekonsiliasi pajak masukan, dan SPT Masa PPN.', 'image' => ''],
            ['title' => 'PPh 21 & payroll', 'text' => 'Hitung gaji, BPJS, dan PPh 21 tarif efektif (TER), bukti potong, sampai slip gaji karyawan.', 'image' => ''],
            ['title' => 'Coretax & administrasi', 'text' => 'Aktivasi akun Coretax, NPWP 16 digit, sertifikat elektronik, dan pemutakhiran data wajib pajak.', 'image' => ''],
            ['title' => 'Pemeriksaan & keberatan', 'text' => 'Pendampingan saat pemeriksaan, tanggapan SP2DK, serta pengajuan keberatan dan restitusi.', 'image' => ''],
        ]]];

        $plans = ['type' => 'plans', 'data' => ['title' => 'Paket bulanan', 'subtitle' => 'Biaya tetap per bulan. Pajak Anda beres, Anda fokus jualan.', 'items' => [
            ['name' => 'UMKM Pribadi', 'badge' => '', 'price' => 'Rp450rb', 'old_price' => '', 'info' => 'per bulan', 'features' => "PPh Final 0,5% (PP 55/2022)\nRekap omzet bulanan\nSetor & lapor tepat waktu\nSPT Tahunan pribadi\nKonsultasi via WhatsApp", 'highlight' => 'no'],
            ['name' => 'CV / PT Kecil', 'badge' => 'Paling dipilih', 'price' => 'Rp1,5jt', 'old_price' => '', 'info' => 'per bulan, hingga 10 karyawan', 'features' => "Pembukuan & laporan keuangan bulanan\nPPh 21, 23, 4(2) & e-Bupot\nSPT Masa PPh\nSPT Tahunan Badan\nPengingat jatuh tempo\nKonsultasi tanpa batas", 'highlight' => 'yes'],
            ['name' => 'PT PKP', 'badge' => '', 'price' => 'Rp3,5jt', 'old_price' => '', 'info' => 'per bulan', 'features' => "Semua isi CV / PT Kecil\nPPN & e-Faktur\nRekonsiliasi pajak masukan\nPayroll hingga 30 karyawan\nRapat bulanan dengan konsultan", 'highlight' => 'no'],
        ], 'note' => 'Jasa SPT Tahunan saja: pribadi mulai Rp250.000, badan mulai Rp2.500.000.']];

        $calendar = ['type' => 'pricelist', 'data' => ['title' => 'Kalender pajak', 'subtitle' => 'Batas waktu yang paling sering terlewat. Klien kami diingatkan lewat WhatsApp H-3.', 'items' => [
            ['name' => 'Setor PPh & PPN masa', 'description' => 'PPh 21, 23, 25, 4(2), dan PPN atas transaksi bulan sebelumnya.', 'info' => 'setiap bulan', 'price' => 'Tgl 15', 'image' => ''],
            ['name' => 'Lapor SPT Masa PPh', 'description' => 'Termasuk bukti potong lewat e-Bupot di Coretax.', 'info' => 'setiap bulan', 'price' => 'Tgl 20', 'image' => ''],
            ['name' => 'Lapor SPT Masa PPN', 'description' => 'Bagi pengusaha kena pajak (PKP).', 'info' => 'setiap bulan', 'price' => 'Akhir bulan', 'image' => ''],
            ['name' => 'SPT Tahunan orang pribadi', 'description' => 'Karyawan, pengusaha, dan pekerja bebas.', 'info' => 'setiap tahun', 'price' => '31 Maret', 'image' => ''],
            ['name' => 'SPT Tahunan badan', 'description' => 'PT, CV, firma, koperasi, dan yayasan.', 'info' => 'setiap tahun', 'price' => '30 April', 'image' => ''],
        ], 'note' => 'Jika jatuh pada hari libur, batas waktu bergeser ke hari kerja berikutnya.', 'order_button' => 'no']];

        $faq = ['type' => 'faq', 'data' => ['title' => 'Pertanyaan yang sering diajukan', 'items' => [
            ['question' => 'Saya baru buka usaha, apa saja kewajiban pajaknya?', 'answer' => 'Umumnya PPh Final 0,5% dari omzet bila omzet di bawah Rp4,8 miliar per tahun, dan omzet sampai Rp500 juta per tahun bebas pajak untuk orang pribadi. Kami bantu cek mana yang berlaku untuk usaha Anda.'],
            ['question' => 'Dokumen apa yang perlu disiapkan?', 'answer' => 'NPWP/NIK, akun Coretax, rekening koran, nota penjualan dan pembelian, serta daftar gaji bila punya karyawan. Cukup kirim foto atau file lewat WhatsApp atau Google Drive.'],
            ['question' => 'Bagaimana jika SPT tahun lalu belum dilaporkan?', 'answer' => 'Masih bisa dilaporkan terlambat dengan denda Rp100.000 untuk pribadi atau Rp1.000.000 untuk badan. Kami bantu hitung dan laporkan, termasuk pembetulan bila ada.'],
            ['question' => 'Apakah data keuangan saya aman?', 'answer' => 'Setiap klien menandatangani perjanjian kerahasiaan. Dokumen disimpan terenkripsi dan hanya diakses konsultan yang menangani Anda.'],
            ['question' => 'Bisa dibantu saat dapat surat dari kantor pajak?', 'answer' => 'Bisa. Kami dampingi tanggapan SP2DK, pemeriksaan, sampai keberatan, dengan biaya sesuai kompleksitas kasus.'],
        ]]];

        return [
            ['title' => 'Beranda', 'slug' => 'beranda', 'is_home' => true, 'sections' => [
                ['type' => 'hero', 'data' => [
                    'eyebrow' => 'Konsultan pajak & akuntan',
                    'title' => 'Pajak beres, *laporan rapi*, tidur tenang',
                    'subtitle' => "{$company} mengurus pembukuan, SPT, PPN, dan PPh 21 untuk UMKM dan perusahaan. Tepat waktu, transparan, tanpa denda.",
                    'button_label' => 'Jadwalkan Konsultasi', 'button_url' => '/konsultasi',
                    'button2_label' => 'Lihat Paket', 'button2_url' => '/paket',
                    'image' => 'demo/pajak-hero.jpg',
                ]],
                ['type' => 'stats', 'data' => ['items' => [
                    ['value' => '350+', 'label' => 'Klien UMKM & perusahaan'],
                    ['value' => '4.200', 'label' => 'SPT dilaporkan'],
                    ['value' => 'Rp0', 'label' => 'Denda keterlambatan klien'],
                    ['value' => '12 thn', 'label' => 'Pengalaman'],
                ]]],
                $services,
                $calendar,
                $plans,
                ['type' => 'testimonials', 'data' => ['title' => 'Kata klien', 'items' => [
                    ['quote' => 'Dulu tiap akhir bulan pusing rekap nota. Sekarang laporan keuangan datang sendiri tanggal 10.', 'name' => 'Dewi Anggraini', 'role' => 'Pemilik toko kosmetik online'],
                    ['quote' => 'Waktu dapat SP2DK kami didampingi sampai selesai. Ternyata cukup klarifikasi, tidak ada tambahan pajak.', 'name' => 'Budi Santoso', 'role' => 'Direktur, PT Sinar Logam'],
                    ['quote' => 'Pindah ke Coretax lancar karena semua dibantu dari aktivasi akun sampai lapor pertama.', 'name' => 'Agus Wijaya', 'role' => 'CV Mitra Teknik'],
                ]]],
                ['type' => 'cta', 'data' => ['title' => 'Konsultasi pertama gratis 30 menit', 'text' => 'Ceritakan kondisi usaha Anda, kami jelaskan kewajiban pajak dan perkiraan biayanya.', 'button_label' => 'Booking Jadwal', 'button_url' => '/konsultasi']],
            ]],
            ['title' => 'Layanan', 'slug' => 'layanan', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Layanan Pajak & Akuntansi', 'subtitle' => 'Satu tim untuk pembukuan, perpajakan, dan payroll.', 'image' => 'demo/pajak-kalkulator.jpg']],
                $services,
                ['type' => 'image_text', 'data' => ['title' => 'Laporan yang bisa Anda baca', 'body' => "Setiap bulan Anda menerima ringkasan satu halaman: omzet, laba, pajak yang dibayar, dan catatan yang perlu diperhatikan.\n\n- Laporan keuangan dalam PDF dan Excel\n- Bukti setor dan bukti lapor tersimpan rapi\n- Siap dipakai untuk pengajuan kredit bank", 'image' => 'demo/pajak-laporan.jpg', 'image_position' => 'left', 'button_label' => 'Lihat Paket', 'button_url' => '/paket']],
                ['type' => 'steps', 'data' => ['title' => 'Cara kerja', 'items' => [
                    ['title' => 'Konsultasi awal', 'text' => 'Kami petakan kewajiban pajak dan kondisi pembukuan Anda.'],
                    ['title' => 'Kirim dokumen', 'text' => 'Upload nota dan rekening koran setiap awal bulan.'],
                    ['title' => 'Kami kerjakan', 'text' => 'Pembukuan, hitung pajak, dan kode billing dikirim ke Anda.'],
                    ['title' => 'Lapor & arsip', 'text' => 'SPT dilaporkan, bukti lapor dikirim, semua diarsip.'],
                ]]],
            ]],
            ['title' => 'Paket', 'slug' => 'paket', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Paket & Biaya', 'subtitle' => 'Harga jelas di depan, bisa berhenti kapan saja.', 'image' => 'demo/pajak-hitung.jpg']],
                $plans,
                ['type' => 'pricelist', 'data' => ['title' => 'Layanan satuan', 'subtitle' => 'Untuk kebutuhan sekali waktu.', 'items' => [
                    ['name' => 'SPT Tahunan pribadi karyawan', 'description' => 'Formulir 1770 S/SS.', 'info' => '1 hari', 'price' => 'Rp250.000', 'image' => ''],
                    ['name' => 'SPT Tahunan pribadi pengusaha', 'description' => 'Formulir 1770 dengan pembukuan atau norma.', 'info' => '3 hari', 'price' => 'Rp750.000', 'image' => ''],
                    ['name' => 'SPT Tahunan badan', 'description' => 'Termasuk laporan keuangan dan rekonsiliasi fiskal.', 'info' => '7 hari', 'price' => 'mulai Rp2.500.000', 'image' => ''],
                    ['name' => 'Pengukuhan PKP', 'description' => 'Pendaftaran PKP dan aktivasi e-Faktur.', 'info' => '5 hari', 'price' => 'Rp1.500.000', 'image' => ''],
                    ['name' => 'Aktivasi Coretax & NPWP', 'description' => 'Untuk pribadi atau badan.', 'info' => '1 hari', 'price' => 'Rp150.000', 'image' => ''],
                ], 'note' => '', 'order_button' => 'yes']],
            ]],
            ['title' => 'Kalender Pajak', 'slug' => 'kalender-pajak', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Kalender Pajak 2026', 'subtitle' => 'Catat tanggalnya, atau biarkan kami yang mengingatkan.', 'image' => 'demo/pajak-ttd.jpg']],
                $calendar,
                ['type' => 'text', 'data' => ['title' => 'Denda yang bisa dihindari', 'body' => "Terlambat lapor SPT Masa PPh dikenai denda **Rp100.000**, SPT Masa PPN **Rp500.000**, SPT Tahunan pribadi **Rp100.000**, dan SPT Tahunan badan **Rp1.000.000**. Terlambat setor dikenai bunga per bulan sesuai tarif yang ditetapkan Menteri Keuangan.\n\nKlien bulanan kami menerima kode billing paling lambat tanggal 10, sehingga ada cukup waktu untuk membayar."]],
            ]],
            ['title' => 'Konsultasi', 'slug' => 'konsultasi', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Booking Konsultasi', 'subtitle' => 'Tatap muka di kantor atau lewat video call. Sesi pertama gratis.', 'image' => 'demo/pajak-konsultasi.jpg']],
                ['type' => 'contact', 'data' => ['title' => 'Pilih jadwal Anda', 'text' => 'Tulis jenis usaha, kebutuhan (misalnya SPT badan atau pembukuan), dan pilihan hari. Kami konfirmasi jadwal lewat WhatsApp. Senin–Jumat 08.30–17.00, Sabtu 09.00–13.00.', 'show_form' => 'yes']],
                $faq,
            ]],
        ];
    }
}
