<?php

namespace App\Sections;

/**
 * Sample pages for the Kecamatan & Instansi template: public services with their requirements,
 * service hours, announcements, leadership, statistics and the complaint channel.
 */
class AgencyOfficeContent
{
    /**
     * @return list<array<string, mixed>>
     */
    public static function pages(string $company): array
    {
        $services = ['type' => 'services', 'data' => ['title' => 'Layanan & persyaratan', 'subtitle' => 'Bawa berkas asli dan fotokopi. Semua layanan administrasi kependudukan gratis.', 'items' => [
            ['title' => 'KTP elektronik', 'text' => "Fotokopi Kartu Keluarga\nSurat pengantar RT/RW dan desa\nSudah berusia 17 tahun atau sudah menikah\nKTP lama (untuk penggantian)", 'image' => ''],
            ['title' => 'Kartu Keluarga', 'text' => "Formulir F-1.01 dari desa/kelurahan\nKK lama\nBuku nikah atau akta cerai\nSurat keterangan pindah (bila pendatang)", 'image' => ''],
            ['title' => 'Akta kelahiran', 'text' => "Surat keterangan lahir dari bidan/RS\nFotokopi KK dan KTP orang tua\nFotokopi buku nikah orang tua\nKTP dua orang saksi", 'image' => ''],
            ['title' => 'Surat pindah', 'text' => "KK dan KTP asli\nSurat pengantar desa/kelurahan\nAlamat tujuan lengkap\nFormulir F-1.03", 'image' => ''],
            ['title' => 'Rekomendasi SKTM', 'text' => "Surat pengantar desa/kelurahan\nFotokopi KK dan KTP\nSurat keterangan dari sekolah/rumah sakit\nFoto rumah tampak depan", 'image' => ''],
            ['title' => 'Surat keterangan ahli waris', 'text' => "Akta kematian pewaris\nKK dan KTP seluruh ahli waris\nSurat pernyataan ahli waris dari desa\nDua orang saksi", 'image' => ''],
        ]]];

        $quick = ['type' => 'links', 'data' => ['title' => 'Akses cepat', 'items' => [
            ['title' => 'Layanan', 'text' => 'Syarat dan alur', 'url' => '/layanan', 'badge' => '', 'image' => ''],
            ['title' => 'Pengaduan', 'text' => 'Sampaikan keluhan', 'url' => '/pengaduan', 'badge' => '', 'image' => ''],
            ['title' => 'Berita', 'text' => 'Pengumuman terbaru', 'url' => '/berita', 'badge' => '', 'image' => ''],
            ['title' => 'Profil', 'text' => 'Pimpinan & wilayah', 'url' => '/profil', 'badge' => '', 'image' => ''],
        ]]];

        $news = ['type' => 'posts', 'data' => ['title' => 'Pengumuman & berita', 'items' => [
            ['image' => 'demo/instansi-vaksin.jpg', 'category' => 'Kesehatan', 'date' => '18 Nov 2026', 'title' => 'Imunisasi anak sekolah di 14 desa mulai pekan depan', 'text' => 'Puskesmas kecamatan bersama sekolah dasar menggelar imunisasi bagi siswa kelas 1, 2, dan 5.', 'url' => ''],
            ['image' => 'demo/instansi-warga.jpg', 'category' => 'Kegiatan', 'date' => '12 Nov 2026', 'title' => 'Lomba kampung bersih tingkat kecamatan diikuti 32 RW', 'text' => 'Penilaian meliputi kebersihan, bank sampah, dan taman toga. Pemenang diumumkan saat apel bulan depan.', 'url' => ''],
            ['image' => 'demo/instansi-alun.jpg', 'category' => 'Pengumuman', 'date' => '5 Nov 2026', 'title' => 'Pelayanan KTP-el keliling hadir di balai desa setiap Sabtu', 'text' => 'Perekaman KTP-el bagi lansia, penyandang disabilitas, dan warga yang baru berusia 17 tahun.', 'url' => ''],
        ]]];

        $flow = ['type' => 'steps', 'data' => ['title' => 'Alur pelayanan', 'items' => [
            ['title' => 'Ambil nomor antrean', 'text' => 'Di mesin antrean lobi, atau daftar online lewat WhatsApp sehari sebelumnya.'],
            ['title' => 'Verifikasi berkas', 'text' => 'Petugas loket memeriksa kelengkapan persyaratan.'],
            ['title' => 'Proses', 'text' => 'Berkas diproses dan ditandatangani pejabat berwenang.'],
            ['title' => 'Selesai', 'text' => 'Dokumen diambil di loket atau dikirim lewat WhatsApp untuk dokumen elektronik.'],
        ]]];

        return [
            ['title' => 'Beranda', 'slug' => 'beranda', 'is_home' => true, 'sections' => [
                ['type' => 'hero', 'data' => [
                    'eyebrow' => 'Situs resmi pemerintah kecamatan',
                    'title' => 'Melayani warga *cepat, mudah, tanpa pungutan*',
                    'subtitle' => "Informasi layanan administrasi, pengumuman, dan pengaduan masyarakat {$company} dalam satu tempat.",
                    'button_label' => 'Cek Persyaratan Layanan', 'button_url' => '/layanan',
                    'button2_label' => 'Sampaikan Pengaduan', 'button2_url' => '/pengaduan',
                    'image' => 'demo/instansi-hero.jpg',
                ]],
                $quick,
                $services,
                ['type' => 'stats', 'data' => ['title' => 'Wilayah dalam angka', 'items' => [
                    ['value' => '48,6 km²', 'label' => 'Luas wilayah'],
                    ['value' => '11 + 3', 'label' => 'Desa dan kelurahan'],
                    ['value' => '86.412', 'label' => 'Jumlah penduduk'],
                    ['value' => '27.390', 'label' => 'Kepala keluarga'],
                ]]],
                $news,
                $flow,
                ['type' => 'cta', 'data' => ['title' => 'Ada keluhan atau masukan?', 'text' => 'Setiap pengaduan dicatat, diberi nomor tiket, dan ditanggapi paling lambat 3 hari kerja.', 'button_label' => 'Kirim Pengaduan', 'button_url' => '/pengaduan']],
            ]],
            ['title' => 'Layanan', 'slug' => 'layanan', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Layanan Publik', 'subtitle' => 'Persyaratan, alur, dan jam pelayanan.', 'image' => 'demo/instansi-hero.jpg']],
                $services,
                $flow,
                ['type' => 'pricelist', 'data' => ['title' => 'Jam pelayanan', 'subtitle' => 'Istirahat pukul 12.00–13.00 (Jumat 11.00–13.00).', 'items' => [
                    ['name' => 'Senin – Kamis', 'description' => 'Semua loket pelayanan.', 'info' => '', 'price' => '08.00–15.00', 'image' => ''],
                    ['name' => 'Jumat', 'description' => 'Semua loket pelayanan.', 'info' => '', 'price' => '08.00–14.00', 'image' => ''],
                    ['name' => 'Sabtu', 'description' => 'KTP-el keliling di balai desa sesuai jadwal.', 'info' => '', 'price' => '08.00–12.00', 'image' => ''],
                    ['name' => 'Minggu & libur nasional', 'description' => 'Pengaduan online tetap diterima.', 'info' => '', 'price' => 'Tutup', 'image' => ''],
                ], 'note' => 'Petugas tidak memungut biaya apa pun. Laporkan bila diminta imbalan.', 'order_button' => 'no']],
            ]],
            ['title' => 'Profil', 'slug' => 'profil', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Profil Kecamatan', 'subtitle' => 'Visi, pimpinan, dan gambaran wilayah.', 'image' => 'demo/instansi-bendera.jpg']],
                ['type' => 'image_text', 'data' => ['title' => 'Visi & misi', 'body' => "**Visi:** terwujudnya pelayanan publik yang prima menuju masyarakat sejahtera dan berdaya.\n\n- Memberikan pelayanan administrasi yang cepat, transparan, dan bebas pungutan\n- Membina pemerintahan desa dan kelurahan yang akuntabel\n- Menggerakkan pembangunan berbasis partisipasi warga\n- Menjaga ketenteraman dan ketertiban umum", 'image' => 'demo/instansi-alun.jpg', 'image_position' => 'right', 'button_label' => '', 'button_url' => '']],
                ['type' => 'team', 'data' => ['title' => 'Pimpinan', 'subtitle' => 'Struktur organisasi kecamatan.', 'items' => [
                    ['photo' => '', 'name' => 'Sutrisno, S.Sos., M.Si.', 'role' => 'Camat'],
                    ['photo' => '', 'name' => 'Rina Kartikasari, S.STP.', 'role' => 'Sekretaris Kecamatan'],
                    ['photo' => '', 'name' => 'Andi Firmansyah, S.H.', 'role' => 'Kasi Pemerintahan'],
                    ['photo' => '', 'name' => 'Siti Nurhaliza, S.AP.', 'role' => 'Kasi Pelayanan Umum'],
                ]]],
                ['type' => 'stats', 'data' => ['title' => 'Data wilayah', 'items' => [
                    ['value' => '48,6 km²', 'label' => 'Luas wilayah'],
                    ['value' => '14', 'label' => 'Desa dan kelurahan'],
                    ['value' => '112', 'label' => 'Rukun warga (RW)'],
                    ['value' => '86.412', 'label' => 'Jumlah penduduk'],
                    ['value' => '3', 'label' => 'Puskesmas & pustu'],
                    ['value' => '41', 'label' => 'Sekolah dasar & menengah'],
                ]]],
            ]],
            ['title' => 'Berita', 'slug' => 'berita', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Berita & Pengumuman', 'subtitle' => 'Kabar terbaru dari kecamatan, desa, dan puskesmas.', 'image' => 'demo/instansi-warga.jpg']],
                ['type' => 'posts', 'data' => ['title' => '', 'items' => array_merge($news['data']['items'], [
                    ['image' => 'demo/instansi-puskesmas.jpg', 'category' => 'Kesehatan', 'date' => '29 Okt 2026', 'title' => 'Posyandu lansia kini tersedia di semua desa', 'text' => 'Pemeriksaan tekanan darah, gula darah, dan konsultasi gizi gratis setiap bulan.', 'url' => ''],
                    ['image' => 'demo/instansi-hero.jpg', 'category' => 'Pemerintahan', 'date' => '20 Okt 2026', 'title' => 'Musrenbang kecamatan menetapkan 26 usulan prioritas', 'text' => 'Perbaikan jalan desa, saluran irigasi, dan posyandu menjadi usulan terbanyak.', 'url' => ''],
                    ['image' => 'demo/instansi-pengaduan.jpg', 'category' => 'Layanan', 'date' => '14 Okt 2026', 'title' => 'Pengaduan warga kini dapat dilacak dengan nomor tiket', 'text' => 'Warga menerima nomor tiket dan kabar perkembangan lewat WhatsApp.', 'url' => ''],
                ])]],
            ]],
            ['title' => 'Pengaduan', 'slug' => 'pengaduan', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Pengaduan Masyarakat', 'subtitle' => 'Keluhan, saran, dan laporan pelayanan. Identitas pelapor dirahasiakan.', 'image' => 'demo/instansi-pengaduan.jpg']],
                ['type' => 'steps', 'data' => ['title' => 'Bagaimana pengaduan ditangani', 'items' => [
                    ['title' => 'Kirim laporan', 'text' => 'Lewat formulir ini, WhatsApp, atau kotak pengaduan di lobi.'],
                    ['title' => 'Dapat nomor tiket', 'text' => 'Laporan dicatat dan diteruskan ke seksi terkait.'],
                    ['title' => 'Ditindaklanjuti', 'text' => 'Tanggapan awal paling lambat 3 hari kerja.'],
                    ['title' => 'Selesai', 'text' => 'Hasil tindak lanjut disampaikan kepada pelapor.'],
                ]]],
                ['type' => 'contact', 'data' => ['title' => 'Formulir pengaduan', 'text' => 'Jelaskan lokasi, waktu kejadian, dan pihak terkait. Lampirkan foto lewat WhatsApp bila ada.', 'show_form' => 'yes']],
                ['type' => 'faq', 'data' => ['title' => 'Pertanyaan umum', 'items' => [
                    ['question' => 'Apakah identitas saya akan diketahui pihak yang dilaporkan?', 'answer' => 'Tidak. Identitas pelapor hanya diketahui petugas pengelola pengaduan.'],
                    ['question' => 'Bisakah melapor pungutan liar?', 'answer' => 'Bisa. Laporan pungutan liar langsung diteruskan kepada camat dan inspektorat kabupaten.'],
                    ['question' => 'Bagaimana jika pengaduan menyangkut instansi lain?', 'answer' => 'Kami teruskan ke instansi berwenang, misalnya dinas atau puskesmas, dan memberi tahu Anda.'],
                ]]],
            ]],
        ];
    }
}
