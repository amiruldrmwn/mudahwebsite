<?php

namespace App\Sections;

use App\Models\Post;
use App\Support\Themes;
use Illuminate\Support\Collection;

/**
 * Three sample blog posts per template group, for the template demos (?tema=): never saved,
 * written for the kind of business the template is for, with its photos.
 */
class SamplePosts
{
    /**
     * @return Collection<int, Post>
     */
    public static function for(string $theme): Collection
    {
        $posts = self::POSTS[Themes::categoryOf($theme)] ?? self::POSTS['bisnis'];

        return collect($posts)->values()->map(fn (array $p, int $i) => (new Post)->forceFill([
            'id' => $i + 1,
            'title' => $p['title'],
            'slug' => $p['slug'],
            'excerpt' => $p['excerpt'],
            'category' => $p['category'],
            'cover' => "demo/{$p['cover']}.jpg",
            'body' => self::body($p),
            'status' => 'published',
            'published_at' => now()->subDays([2, 6, 13][$i] ?? 20)->setTime(9, 0),
            'updated_at' => now()->subDays([2, 6, 13][$i] ?? 20)->setTime(9, 0),
        ]));
    }

    /**
     * @param  array{intro: string, heading: string, points: list<string>, image: string, caption: string, closing: string}  $p
     */
    private static function body(array $p): string
    {
        $points = implode('', array_map(fn (string $point) => '<li>'.e($point).'</li>', $p['points']));

        return '<p>'.e($p['intro']).'</p>'
            .'<h2>'.e($p['heading']).'</h2>'
            .'<ul>'.$points.'</ul>'
            .'<p><img src="/storage/demo/'.$p['image'].'.jpg" alt="'.e($p['caption']).'"></p>'
            .'<p>'.e($p['closing']).'</p>';
    }

    private const POSTS = [
        'bisnis' => [
            ['slug' => 'lima-cara-memilih-vendor', 'title' => '5 Cara Memilih Vendor yang Bisa Dipercaya', 'category' => 'Tips', 'cover' => 'handshake', 'image' => 'team-meeting', 'caption' => 'Rapat bersama calon vendor',
                'excerpt' => 'Harga murah belum tentu hemat. Ini lima hal yang kami periksa sebelum menandatangani kontrak kerja sama.',
                'intro' => 'Salah pilih vendor bisa membuat proyek molor dan anggaran membengkak. Dari pengalaman menangani puluhan proyek, ada beberapa hal sederhana yang selalu kami periksa lebih dulu.',
                'heading' => 'Yang perlu dicek sebelum tanda tangan',
                'points' => ['Legalitas perusahaan: NIB, NPWP, dan izin usaha yang masih berlaku', 'Portofolio proyek sejenis, lengkap dengan kontak klien sebelumnya', 'Rincian penawaran yang jelas, bukan hanya angka total', 'Jadwal kerja dan siapa penanggung jawab di lapangan', 'Garansi dan layanan setelah pekerjaan selesai'],
                'closing' => 'Butuh teman diskusi sebelum memilih vendor? Tim kami siap membantu menyusun kebutuhan dan membandingkan penawaran, tanpa biaya untuk konsultasi awal.'],
            ['slug' => 'proyek-gudang-cikarang-rampung', 'title' => 'Proyek Gudang Cikarang Rampung Dua Minggu Lebih Cepat', 'category' => 'Kabar', 'cover' => 'engineers', 'image' => 'building', 'caption' => 'Bangunan gudang yang telah selesai',
                'excerpt' => 'Gudang seluas 4.000 m² untuk klien logistik kami serahterimakan lebih cepat dari jadwal, tanpa satu pun kecelakaan kerja.',
                'intro' => 'Pekan lalu kami menyerahterimakan gudang seluas 4.000 m² di Cikarang kepada klien logistik kami. Proyek ini selesai dua minggu lebih cepat dari jadwal awal.',
                'heading' => 'Kunci proyek ini berjalan lancar',
                'points' => ['Perencanaan detail sejak awal bersama klien', 'Laporan progres mingguan yang bisa dipantau langsung', 'Tim lapangan bersertifikat K3 dengan nol kecelakaan kerja'],
                'closing' => 'Terima kasih kepada klien dan seluruh tim yang terlibat. Kami siap membantu proyek Anda berikutnya dengan standar yang sama.'],
            ['slug' => 'kami-buka-kantor-cabang-surabaya', 'title' => 'Kami Kini Hadir di Surabaya', 'category' => 'Pengumuman', 'cover' => 'office', 'image' => 'lobby', 'caption' => 'Lobi kantor cabang baru',
                'excerpt' => 'Untuk melayani klien di Jawa Timur lebih cepat, kantor cabang kami di Surabaya resmi beroperasi mulai bulan ini.',
                'intro' => 'Kabar gembira untuk klien di Jawa Timur: kantor cabang kami di Surabaya resmi beroperasi mulai bulan ini.',
                'heading' => 'Layanan yang tersedia di Surabaya',
                'points' => ['Konsultasi dan survei lokasi', 'Tim teknis untuk wilayah Jawa Timur dan Bali', 'Ruang pertemuan yang bisa dipakai klien'],
                'closing' => 'Silakan mampir atau hubungi kami lewat WhatsApp untuk membuat janji temu.'],
        ],
        'kuliner' => [
            ['slug' => 'menu-baru-bulan-ini', 'title' => 'Menu Baru Bulan Ini: Wajib Dicoba!', 'category' => 'Menu Baru', 'cover' => 'resto-nasgor', 'image' => 'resto-chef', 'caption' => 'Koki kami sedang menyiapkan menu baru',
                'excerpt' => 'Tiga menu baru hadir mulai minggu ini, dibuat dari resep keluarga dan bahan segar dari pasar setiap pagi.',
                'intro' => 'Setelah berbulan-bulan uji resep di dapur, akhirnya tiga menu baru kami resmi hadir mulai minggu ini.',
                'heading' => 'Yang baru di daftar menu',
                'points' => ['Nasi goreng kampung dengan sambal terasi ulek', 'Soto ayam bening dengan koya gurih', 'Es kopi gula aren dengan susu segar'],
                'closing' => 'Datang langsung atau pesan lewat WhatsApp. Selama minggu pertama, setiap menu baru ada potongan 15%.'],
            ['slug' => 'tips-pesan-katering-acara', 'title' => 'Tips Memesan Katering untuk Acara Keluarga', 'category' => 'Tips', 'cover' => 'catering-buffet', 'image' => 'catering-box', 'caption' => 'Nasi kotak siap antar',
                'excerpt' => 'Berapa porsi yang harus dipesan? Kapan sebaiknya pesan? Ini panduan singkat supaya acara Anda lancar.',
                'intro' => 'Memesan makanan untuk acara keluarga sering bikin bingung: berapa porsi, menu apa, dan kapan harus pesan. Berikut panduan singkat dari kami.',
                'heading' => 'Panduan singkat memesan',
                'points' => ['Pesan paling lambat 3 hari sebelum acara', 'Lebihkan 10% dari jumlah tamu yang diundang', 'Pilih menu yang disukai semua umur', 'Pastikan jam antar dan alamat lengkap'],
                'closing' => 'Masih ragu? Kirim detail acara Anda lewat WhatsApp, kami bantu hitungkan porsi dan menunya.'],
            ['slug' => 'jam-buka-libur-nasional', 'title' => 'Jam Buka Selama Libur Nasional', 'category' => 'Pengumuman', 'cover' => 'resto-interior', 'image' => 'kopi-barista', 'caption' => 'Tim kami tetap melayani saat libur',
                'excerpt' => 'Kami tetap buka selama libur nasional dengan jam yang sedikit berbeda. Catat jadwalnya di sini.',
                'intro' => 'Selama libur nasional, kami tetap buka untuk menemani waktu santai Anda bersama keluarga, dengan jam yang sedikit berbeda.',
                'heading' => 'Jadwal buka',
                'points' => ['Hari libur: 10.00 sampai 22.00', 'Pesan antar tetap tersedia', 'Reservasi meja untuk rombongan lewat WhatsApp'],
                'closing' => 'Sampai jumpa di tempat kami!'],
        ],
        'toko' => [
            ['slug' => 'koleksi-terbaru-sudah-datang', 'title' => 'Koleksi Terbaru Sudah Datang', 'category' => 'Produk Baru', 'cover' => 'hijab-editorial', 'image' => 'kaos-rack', 'caption' => 'Koleksi terbaru di toko kami',
                'excerpt' => 'Pilihan warna dan model baru sudah tersedia di toko dan bisa dipesan lewat WhatsApp. Stok terbatas!',
                'intro' => 'Koleksi terbaru kami sudah tiba dan siap dipajang. Kali ini kami menghadirkan pilihan warna yang lebih lembut dan bahan yang lebih nyaman dipakai seharian.',
                'heading' => 'Yang baru minggu ini',
                'points' => ['Pilihan warna baru yang cocok untuk acara apa pun', 'Bahan adem dan tidak mudah kusut', 'Ukuran lengkap dari S sampai XXL'],
                'closing' => 'Stok tiap model terbatas. Pesan lewat WhatsApp, kami kirim foto detail sebelum Anda membayar.'],
            ['slug' => 'cara-memilih-ukuran-yang-pas', 'title' => 'Cara Memilih Ukuran yang Pas Saat Belanja Online', 'category' => 'Tips', 'cover' => 'kaos-folded', 'image' => 'kaos-model', 'caption' => 'Mencoba ukuran yang pas',
                'excerpt' => 'Takut ukurannya tidak pas? Ikuti tiga langkah ini sebelum memesan.',
                'intro' => 'Salah ukuran adalah alasan paling sering barang dikembalikan. Kabar baiknya, ini mudah dihindari.',
                'heading' => 'Tiga langkah sebelum memesan',
                'points' => ['Ukur baju yang paling nyaman Anda pakai, lalu bandingkan dengan tabel ukuran kami', 'Perhatikan jenis bahan: bahan katun tidak melar', 'Tanyakan ke admin kalau ragu, kami bantu pilihkan'],
                'closing' => 'Kalau tetap kurang pas, barang bisa ditukar dalam 7 hari selama label masih terpasang.'],
            ['slug' => 'promo-akhir-bulan', 'title' => 'Promo Akhir Bulan: Diskon Hingga 30%', 'category' => 'Promo', 'cover' => 'kaos-store', 'image' => 'umkm-stoples', 'caption' => 'Produk pilihan dengan harga promo',
                'excerpt' => 'Produk pilihan diskon hingga 30% sampai akhir bulan. Gratis ongkir untuk wilayah kota.',
                'intro' => 'Sebagai ucapan terima kasih untuk pelanggan setia, kami adakan promo akhir bulan untuk produk-produk pilihan.',
                'heading' => 'Ketentuan promo',
                'points' => ['Diskon hingga 30% untuk produk bertanda promo', 'Gratis ongkir untuk wilayah kota, minimal belanja Rp150.000', 'Berlaku sampai akhir bulan atau selama stok ada'],
                'closing' => 'Jangan sampai kehabisan, pesan sekarang lewat WhatsApp!'],
        ],
        'kesehatan' => [
            ['slug' => 'kapan-harus-periksa-rutin', 'title' => 'Kapan Sebaiknya Periksa Kesehatan Rutin?', 'category' => 'Edukasi', 'cover' => 'klinik-steth', 'image' => 'klinik-bp', 'caption' => 'Pemeriksaan tekanan darah',
                'excerpt' => 'Pemeriksaan rutin membantu menemukan masalah sejak dini, sebelum terasa gejalanya. Ini jadwal yang kami sarankan.',
                'intro' => 'Banyak penyakit tidak menunjukkan gejala di awal. Karena itu, pemeriksaan rutin adalah cara paling mudah untuk menjaga kesehatan Anda dan keluarga.',
                'heading' => 'Jadwal yang kami sarankan',
                'points' => ['Tekanan darah: setiap 6 bulan, terutama di atas usia 30', 'Gula darah dan kolesterol: setahun sekali', 'Pemeriksaan gigi: setiap 6 bulan', 'Segera periksa bila ada keluhan yang tidak kunjung membaik'],
                'closing' => 'Buat janji lewat WhatsApp supaya Anda tidak perlu menunggu lama di tempat.'],
            ['slug' => 'tips-menjaga-kesehatan-musim-hujan', 'title' => 'Tips Tetap Sehat di Musim Hujan', 'category' => 'Tips', 'cover' => 'dokter-2', 'image' => 'apotek-vitamin', 'caption' => 'Vitamin untuk daya tahan tubuh',
                'excerpt' => 'Cuaca berubah-ubah membuat tubuh mudah lelah. Lakukan lima kebiasaan sederhana ini.',
                'intro' => 'Musim hujan sering diikuti batuk, pilek, dan demam. Lima kebiasaan sederhana ini membantu menjaga daya tahan tubuh.',
                'heading' => 'Lima kebiasaan sederhana',
                'points' => ['Cukup tidur, 7 sampai 8 jam setiap malam', 'Minum air putih minimal 8 gelas sehari', 'Makan sayur dan buah setiap hari', 'Cuci tangan sebelum makan', 'Segera ganti pakaian basah'],
                'closing' => 'Kalau keluhan berlangsung lebih dari tiga hari, segera periksakan diri ke dokter.'],
            ['slug' => 'layanan-baru-kini-tersedia', 'title' => 'Layanan Baru Kini Tersedia Setiap Hari', 'category' => 'Pengumuman', 'cover' => 'beauty-lounge', 'image' => 'dent-room', 'caption' => 'Ruang layanan yang nyaman',
                'excerpt' => 'Kini Anda bisa datang setiap hari, termasuk akhir pekan. Jadwal dokter terbaru ada di sini.',
                'intro' => 'Untuk memudahkan pasien yang bekerja di hari kerja, kini kami melayani setiap hari, termasuk Sabtu dan Minggu.',
                'heading' => 'Jadwal layanan',
                'points' => ['Senin sampai Jumat: 08.00 sampai 20.00', 'Sabtu dan Minggu: 09.00 sampai 15.00', 'Pendaftaran online lewat WhatsApp'],
                'closing' => 'Kami tunggu kedatangan Anda.'],
        ],
        'otomotif' => [
            ['slug' => 'tanda-kendaraan-perlu-servis', 'title' => '5 Tanda Kendaraan Anda Perlu Servis', 'category' => 'Tips', 'cover' => 'bengkel-engine', 'image' => 'mobil-service', 'caption' => 'Pemeriksaan mesin di bengkel',
                'excerpt' => 'Jangan tunggu mogok di jalan. Kenali tanda-tanda kendaraan Anda butuh perawatan.',
                'intro' => 'Kendaraan yang dirawat rutin lebih irit, lebih aman, dan nilai jualnya terjaga. Kenali lima tanda ini sebelum masalah kecil menjadi besar.',
                'heading' => 'Tandanya',
                'points' => ['Mesin terasa kasar atau sulit dinyalakan', 'Bunyi berdecit saat mengerem', 'Lampu indikator menyala di dasbor', 'Konsumsi bahan bakar tiba-tiba boros', 'Sudah lewat 5.000 km sejak servis terakhir'],
                'closing' => 'Booking jadwal servis lewat WhatsApp, tidak perlu antre lama.'],
            ['slug' => 'tips-mudik-aman', 'title' => 'Persiapan Kendaraan Sebelum Perjalanan Jauh', 'category' => 'Tips', 'cover' => 'car-suv', 'image' => 'cucimobil-ban', 'caption' => 'Memeriksa kondisi ban',
                'excerpt' => 'Mau perjalanan jauh? Periksa enam hal ini supaya perjalanan aman dan nyaman.',
                'intro' => 'Perjalanan jauh butuh persiapan, terutama untuk kendaraan Anda. Periksa hal-hal berikut paling lambat seminggu sebelum berangkat.',
                'heading' => 'Daftar periksa',
                'points' => ['Tekanan dan kondisi ban, termasuk ban cadangan', 'Oli mesin dan air radiator', 'Rem dan lampu-lampu', 'Aki dan kelistrikan', 'Dokumen kendaraan dan kotak P3K'],
                'closing' => 'Kami sediakan paket cek lengkap sebelum perjalanan dengan harga khusus.'],
            ['slug' => 'promo-akhir-tahun', 'title' => 'Promo Akhir Tahun Sudah Dimulai', 'category' => 'Promo', 'cover' => 'mobil-showroom', 'image' => 'mobil-handover', 'caption' => 'Serah terima kendaraan kepada pelanggan',
                'excerpt' => 'Potongan harga dan bonus menarik sampai akhir tahun. Hubungi kami untuk detailnya.',
                'intro' => 'Menutup tahun, kami siapkan promo spesial untuk pelanggan baru maupun pelanggan setia.',
                'heading' => 'Isi promonya',
                'points' => ['Potongan harga khusus selama periode promo', 'Bonus aksesori untuk setiap transaksi', 'Proses cepat, bisa dibantu lewat WhatsApp'],
                'closing' => 'Promo berlaku sampai akhir tahun. Hubungi kami untuk detail dan ketentuannya.'],
        ],
        'jasa' => [
            ['slug' => 'kenapa-perawatan-rutin-penting', 'title' => 'Kenapa Perawatan Rutin Lebih Hemat?', 'category' => 'Tips', 'cover' => 'ac-repair', 'image' => 'ac-cleaning', 'caption' => 'Teknisi kami sedang bekerja',
                'excerpt' => 'Biaya perawatan kecil hari ini bisa mencegah biaya perbaikan besar nanti. Ini alasannya.',
                'intro' => 'Banyak pelanggan baru menghubungi kami setelah kerusakan terjadi. Padahal, perawatan rutin jauh lebih hemat dibanding perbaikan besar.',
                'heading' => 'Keuntungan perawatan rutin',
                'points' => ['Masalah kecil ketahuan sebelum menjadi besar', 'Hasil kerja lebih awet dan rapi', 'Biaya lebih terencana', 'Jadwal bisa disesuaikan dengan waktu Anda'],
                'closing' => 'Tanyakan paket perawatan berkala kami lewat WhatsApp.'],
            ['slug' => 'proyek-pilihan-bulan-ini', 'title' => 'Proyek Pilihan Bulan Ini', 'category' => 'Portofolio', 'cover' => 'kontraktor-after', 'image' => 'interior-ruangtamu', 'caption' => 'Hasil pekerjaan tim kami',
                'excerpt' => 'Intip hasil kerja tim kami bulan ini, dari permintaan awal sampai serah terima.',
                'intro' => 'Setiap bulan kami memilih satu proyek untuk dibagikan. Bulan ini, kami menata ulang rumah keluarga di Bekasi agar lebih lega dan terang.',
                'heading' => 'Yang kami kerjakan',
                'points' => ['Survei dan diskusi kebutuhan bersama pemilik rumah', 'Desain dan rincian biaya sebelum mulai', 'Pengerjaan selama tiga minggu dengan laporan rutin'],
                'closing' => 'Ingin hasil serupa? Konsultasi awal dan survei lokasi gratis.'],
            ['slug' => 'cara-pesan-jadwal', 'title' => 'Cara Memesan Jadwal Layanan', 'category' => 'Panduan', 'cover' => 'cleaning-home', 'image' => 'laundry-fold', 'caption' => 'Layanan yang rapi dan tepat waktu',
                'excerpt' => 'Memesan layanan kami cukup lewat WhatsApp. Begini langkah-langkahnya.',
                'intro' => 'Kami ingin memesan layanan semudah mengirim pesan. Berikut langkahnya.',
                'heading' => 'Langkah memesan',
                'points' => ['Kirim pesan WhatsApp berisi kebutuhan dan alamat', 'Kami kirim perkiraan biaya dan pilihan jadwal', 'Tim datang tepat waktu, bayar setelah selesai'],
                'closing' => 'Tanya-tanya dulu juga boleh. Admin kami membalas setiap hari pukul 08.00 sampai 20.00.'],
        ],
        'pendidikan' => [
            ['slug' => 'pendaftaran-siswa-baru-dibuka', 'title' => 'Pendaftaran Siswa Baru Telah Dibuka', 'category' => 'Pengumuman', 'cover' => 'sd-classroom', 'image' => 'sd-field', 'caption' => 'Kegiatan siswa di sekolah',
                'excerpt' => 'Pendaftaran tahun ajaran baru dibuka mulai hari ini. Kuota terbatas, daftar lebih awal.',
                'intro' => 'Pendaftaran peserta didik baru untuk tahun ajaran mendatang resmi dibuka mulai hari ini.',
                'heading' => 'Syarat pendaftaran',
                'points' => ['Mengisi formulir pendaftaran', 'Fotokopi akta kelahiran dan kartu keluarga', 'Pas foto berwarna ukuran 3x4', 'Mengikuti tes dan wawancara sesuai jadwal'],
                'closing' => 'Informasi lebih lanjut dan jadwal kunjungan sekolah bisa ditanyakan lewat WhatsApp.'],
            ['slug' => 'juara-lomba-tingkat-kota', 'title' => 'Siswa Kami Raih Juara Lomba Tingkat Kota', 'category' => 'Prestasi', 'cover' => 'sma-news-medal', 'image' => 'bimbel-group', 'caption' => 'Siswa berprestasi bersama pembimbing',
                'excerpt' => 'Selamat untuk siswa-siswa kami yang berhasil membawa pulang tiga medali dalam lomba tingkat kota.',
                'intro' => 'Kabar membanggakan datang dari lomba tingkat kota pekan lalu: siswa-siswa kami berhasil membawa pulang tiga medali.',
                'heading' => 'Daftar prestasi',
                'points' => ['Juara 1 lomba cerdas cermat', 'Juara 2 lomba pidato bahasa Inggris', 'Juara harapan lomba sains'],
                'closing' => 'Terima kasih kepada para pembimbing dan orang tua atas dukungannya.'],
            ['slug' => 'tips-belajar-di-rumah', 'title' => 'Tips Mendampingi Anak Belajar di Rumah', 'category' => 'Tips', 'cover' => 'bimbel-kids', 'image' => 'paud-main', 'caption' => 'Belajar sambil bermain',
                'excerpt' => 'Peran orang tua sangat besar. Lima cara sederhana agar anak semangat belajar di rumah.',
                'intro' => 'Belajar tidak berhenti di sekolah. Dukungan orang tua di rumah membuat anak lebih percaya diri dan semangat.',
                'heading' => 'Lima cara sederhana',
                'points' => ['Buat jadwal belajar yang tetap dan singkat', 'Sediakan tempat belajar yang tenang', 'Puji usahanya, bukan hanya nilainya', 'Batasi waktu layar sebelum tidur', 'Ajak bercerita tentang hari di sekolah'],
                'closing' => 'Ada pertanyaan seputar perkembangan belajar anak? Wali kelas siap berdiskusi.'],
        ],
        'properti' => [
            ['slug' => 'tips-memilih-hunian', 'title' => 'Tips Memilih Hunian yang Tepat', 'category' => 'Tips', 'cover' => 'prop-interior', 'image' => 'prop-park', 'caption' => 'Lingkungan yang asri dan nyaman',
                'excerpt' => 'Lokasi, akses, dan lingkungan sama pentingnya dengan harga. Ini yang perlu diperhatikan.',
                'intro' => 'Memilih tempat tinggal adalah keputusan besar. Selain harga, ada beberapa hal yang sering terlupa namun sangat berpengaruh.',
                'heading' => 'Yang perlu diperhatikan',
                'points' => ['Jarak ke tempat kerja, sekolah, dan fasilitas umum', 'Akses transportasi dan kondisi jalan', 'Keamanan lingkungan', 'Biaya bulanan di luar harga sewa atau cicilan'],
                'closing' => 'Jadwalkan kunjungan lewat WhatsApp, kami antar Anda melihat langsung.'],
            ['slug' => 'unit-baru-tersedia', 'title' => 'Unit Baru Tersedia Bulan Ini', 'category' => 'Info Unit', 'cover' => 'kos-eksklusif', 'image' => 'villa-bedroom', 'caption' => 'Kamar yang bersih dan nyaman',
                'excerpt' => 'Beberapa unit baru siap ditempati. Lihat fasilitas dan harganya.',
                'intro' => 'Kabar baik untuk Anda yang sedang mencari tempat: beberapa unit baru siap ditempati mulai bulan ini.',
                'heading' => 'Fasilitas unit',
                'points' => ['Kamar mandi dalam dan air panas', 'Wi-Fi kencang dan listrik token', 'Area parkir dan CCTV 24 jam'],
                'closing' => 'Unit terbatas. Hubungi kami untuk melihat langsung atau minta video unitnya.'],
            ['slug' => 'destinasi-favorit-musim-ini', 'title' => 'Destinasi Favorit Musim Ini', 'category' => 'Inspirasi', 'cover' => 'travel-bromo', 'image' => 'travel-teluk', 'caption' => 'Pemandangan destinasi favorit',
                'excerpt' => 'Tiga tujuan yang paling banyak dipesan pelanggan kami bulan ini, beserta tips persiapannya.',
                'intro' => 'Bulan ini, tiga tujuan paling banyak dipesan pelanggan kami. Berikut sedikit gambaran dan tips persiapannya.',
                'heading' => 'Tips persiapan',
                'points' => ['Pesan lebih awal untuk tanggal libur panjang', 'Bawa jaket untuk tujuan dataran tinggi', 'Siapkan uang tunai untuk tempat yang jauh dari ATM'],
                'closing' => 'Tanyakan paket dan jadwal keberangkatan terdekat lewat WhatsApp.'],
        ],
        'personal' => [
            ['slug' => 'cerita-di-balik-karya-terbaru', 'title' => 'Cerita di Balik Karya Terbaru', 'category' => 'Cerita', 'cover' => 'bio-creator', 'image' => 'cv-desk', 'caption' => 'Meja kerja tempat semua dimulai',
                'excerpt' => 'Butuh tiga bulan dari ide sampai selesai. Ini cerita prosesnya, termasuk bagian yang tidak berjalan mulus.',
                'intro' => 'Banyak yang bertanya bagaimana karya terbaru saya dibuat. Jawabannya: pelan-pelan, dengan banyak percobaan yang gagal.',
                'heading' => 'Yang saya pelajari',
                'points' => ['Mulai dari versi sederhana dulu', 'Minta masukan sejak awal, bukan di akhir', 'Konsisten sedikit setiap hari lebih baik daripada banyak sesekali'],
                'closing' => 'Terima kasih sudah mengikuti perjalanan ini. Sampai jumpa di karya berikutnya!'],
            ['slug' => 'alat-yang-saya-pakai', 'title' => 'Alat yang Saya Pakai Sehari-hari', 'category' => 'Tips', 'cover' => 'cv-laptop', 'image' => 'bio3-studio', 'caption' => 'Peralatan kerja sehari-hari',
                'excerpt' => 'Daftar alat dan aplikasi yang membantu saya bekerja lebih rapi dan cepat.',
                'intro' => 'Pertanyaan yang paling sering masuk ke DM: pakai alat apa? Ini daftar lengkapnya.',
                'heading' => 'Daftar alat',
                'points' => ['Laptop dengan layar yang nyaman untuk kerja lama', 'Aplikasi catatan untuk menyimpan ide', 'Kalender untuk jadwal konten dan pekerjaan', 'Mikrofon sederhana untuk rekaman'],
                'closing' => 'Alat penting, tapi kebiasaan jauh lebih penting.'],
            ['slug' => 'jadwal-acara-bulan-ini', 'title' => 'Jadwal Kegiatan Bulan Ini', 'category' => 'Agenda', 'cover' => 'bio3-stage', 'image' => 'caleg-dialog', 'caption' => 'Bertemu langsung dengan teman-teman',
                'excerpt' => 'Mari bertemu langsung! Ini daftar kegiatan dan tempatnya bulan ini.',
                'intro' => 'Bulan ini ada beberapa kesempatan untuk bertemu langsung. Catat tanggalnya, ya.',
                'heading' => 'Agenda',
                'points' => ['Sesi berbagi di kampus, minggu pertama', 'Live streaming tanya jawab, setiap Jumat malam', 'Temu kangen bersama komunitas, akhir bulan'],
                'closing' => 'Info detail dan pendaftaran ada di tautan bio.'],
        ],
        'komunitas' => [
            ['slug' => 'jadwal-pelayanan-terbaru', 'title' => 'Jadwal Pelayanan Terbaru', 'category' => 'Pengumuman', 'cover' => 'instansi-warga', 'image' => 'instansi-pengaduan', 'caption' => 'Pelayanan kepada warga',
                'excerpt' => 'Mulai bulan ini, jam pelayanan diperpanjang agar warga yang bekerja tetap bisa dilayani.',
                'intro' => 'Untuk memudahkan warga yang bekerja di siang hari, jam pelayanan kami perpanjang mulai bulan ini.',
                'heading' => 'Jam pelayanan baru',
                'points' => ['Senin sampai Kamis: 08.00 sampai 16.00', 'Jumat: 08.00 sampai 11.00 dan 13.00 sampai 16.00', 'Sabtu: 08.00 sampai 12.00 untuk layanan tertentu'],
                'closing' => 'Siapkan dokumen yang diperlukan sebelum datang agar pelayanan lebih cepat.'],
            ['slug' => 'kerja-bakti-bersama', 'title' => 'Kerja Bakti Bersama Warga', 'category' => 'Kegiatan', 'cover' => 'desa-jalan', 'image' => 'koperasi-rapat', 'caption' => 'Warga bergotong royong',
                'excerpt' => 'Ratusan warga ikut membersihkan lingkungan dan saluran air menjelang musim hujan.',
                'intro' => 'Minggu pagi lalu, ratusan warga bergotong royong membersihkan lingkungan dan saluran air menjelang musim hujan.',
                'heading' => 'Yang dikerjakan',
                'points' => ['Membersihkan saluran air di sepanjang jalan utama', 'Memangkas pohon yang rawan tumbang', 'Mengecat ulang pos ronda dan balai warga'],
                'closing' => 'Terima kasih kepada seluruh warga yang hadir. Semangat gotong royong terus kita jaga.'],
            ['slug' => 'laporan-kegiatan-bulanan', 'title' => 'Laporan Kegiatan Bulan Ini', 'category' => 'Laporan', 'cover' => 'masjid-hall', 'image' => 'koperasi-pasar', 'caption' => 'Kegiatan bersama masyarakat',
                'excerpt' => 'Ringkasan kegiatan dan program yang berjalan selama sebulan terakhir, terbuka untuk semua.',
                'intro' => 'Sebagai bentuk keterbukaan, berikut ringkasan kegiatan dan program yang berjalan selama sebulan terakhir.',
                'heading' => 'Ringkasan kegiatan',
                'points' => ['Pengajian dan pertemuan rutin setiap pekan', 'Santunan untuk 45 keluarga yang membutuhkan', 'Pelatihan usaha untuk warga dan anggota'],
                'closing' => 'Laporan lengkap bisa diminta langsung kepada pengurus.'],
        ],
    ];
}
