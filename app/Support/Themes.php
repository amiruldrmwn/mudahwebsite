<?php

namespace App\Support;

/**
 * The website templates. Each has its own header, footer, hero and look (resources/views/site
 * and resources/css/site.css); every other section is shared and styled by the theme.
 */
class Themes
{
    public const DEFAULT = 'korporat';

    /**
     * preset: which sample content (DefaultContent) suits the template; color: its suggested
     * brand colour, applied together with that sample content.
     *
     * @return array<string, array{label: string, description: string, fonts: string, preset: string, color: string}>
     */
    public static function all(): array
    {
        return [
            'korporat' => [
                'label' => 'Korporat',
                'description' => 'Rapi dan meyakinkan: header dengan info kontak, hero berwarna penuh, kartu bergaris. Cocok untuk kontraktor, konsultan, dan industri.',
                'fonts' => 'inter:400,500,600,700',
                'preset' => 'korporat',
                'color' => '#2563eb',
            ],
            'modern' => [
                'label' => 'Modern',
                'description' => 'Segar dan berani: gradasi warna, sudut membulat, huruf tebal. Cocok untuk startup, agensi, dan teknologi.',
                'fonts' => 'plus-jakarta-sans:400,500,600,700,800',
                'preset' => 'korporat',
                'color' => '#7c3aed',
            ],
            'minimalis' => [
                'label' => 'Minimalis',
                'description' => 'Elegan dan lapang: huruf serif untuk judul, banyak ruang kosong, garis tipis. Cocok untuk arsitek, butik, dan firma hukum.',
                'fonts' => 'fraunces:400,600|inter:400,500',
                'preset' => 'korporat',
                'color' => '#1c1917',
            ],
            'spa' => [
                'label' => 'Spa',
                'description' => 'Mewah dan menenangkan: latar gelap, aksen emas, huruf serif klasik, daftar harga perawatan. Cocok untuk spa, salon, pijat, dan klinik kecantikan.',
                'fonts' => 'cormorant-garamond:400,500,600,400i|jost:300,400,500',
                'preset' => 'spa',
                'color' => '#c9a45c',
            ],
            'kue' => [
                'label' => 'Kue & Bakery',
                'description' => 'Hangat dan menggugah selera: warna krem dan cokelat, sudut membulat, kartu produk dengan harga dan tombol pesan. Cocok untuk toko kue, bakery, kafe, dan kuliner.',
                'fonts' => 'playfair-display:500,600,700,500i,600i|nunito:400,600,700,800',
                'preset' => 'kue',
                'color' => '#5b3423',
            ],
            'sekolah' => [
                'label' => 'Sekolah',
                'description' => 'Ceria dan tepercaya: putih bersih dengan aksen merah, judul serif, sambutan kepala sekolah, guru, berita, dan info pendaftaran siswa baru. Cocok untuk SD, SMP, SMA, TK, dan lembaga kursus.',
                'fonts' => 'dm-serif-display:400,400i|plus-jakarta-sans:400,500,600,700',
                'preset' => 'sekolah',
                'color' => '#b3261e',
            ],
            'umroh' => [
                'label' => 'Travel Umroh',
                'description' => 'Elegan dan menenangkan: biru navy dengan aksen emas, kartu paket lengkap (tanggal, maskapai, hotel, harga), program haji, jadwal keberangkatan, dan testimoni jamaah. Cocok untuk travel umroh, haji, dan wisata halal.',
                'fonts' => 'manrope:400,500,600,700,800',
                'preset' => 'umroh',
                'color' => '#1f2b4d',
            ],
            'ac' => [
                'label' => 'Jasa AC & Servis',
                'description' => 'Segar dan sigap: gradasi biru es, info darurat di atas, tabel harga jelas, alur pesan, dan area layanan. Cocok untuk jasa AC, servis elektronik, plumbing, dan teknisi panggilan.',
                'fonts' => 'sora:400,500,600,700',
                'preset' => 'ac',
                'color' => '#0369a1',
            ],
            'lawfirm' => [
                'label' => 'Law Firm',
                'description' => 'Berwibawa dan tenang: navy gelap dengan aksen emas, judul serif klasik, bidang praktik, profil advokat, dan jadwal konsultasi. Cocok untuk firma hukum, kantor advokat, notaris, dan konsultan hukum.',
                'fonts' => 'libre-baskerville:400,700,400i|inter:400,500,600',
                'preset' => 'lawfirm',
                'color' => '#1e3a5f',
            ],
            'pesantren' => [
                'label' => 'Pesantren',
                'description' => 'Teduh dan berwibawa: hijau zamrud dengan aksen emas, ornamen geometris islami, program tahfidz dan kitab, kehidupan santri, dan pendaftaran santri baru. Cocok untuk pondok pesantren, madrasah, TPQ, dan rumah tahfidz.',
                'fonts' => 'amiri:400,700|plus-jakarta-sans:400,500,600,700',
                'preset' => 'pesantren',
                'color' => '#047857',
            ],
            'cleaning' => [
                'label' => 'Cleaning Service',
                'description' => 'Segar dan rapi: hijau toska dengan putih bersih, sudut membulat, paket bersih rumah dengan harga, layanan tambahan, dan alur pesan. Cocok untuk jasa bersih rumah, cleaning service kantor, cuci sofa dan kasur, serta disinfeksi.',
                'fonts' => 'outfit:400,500,600,700',
                'preset' => 'cleaning',
                'color' => '#0d9488',
            ],
            'satpam' => [
                'label' => 'Jasa Keamanan',
                'description' => 'Tegas dan terpercaya: biru gelap dengan aksen kuning, huruf kapital tegas, layanan pengamanan, keunggulan, dan permintaan survei lokasi. Cocok untuk jasa satpam (BUJP), outsourcing keamanan, pengawalan, dan pemasangan CCTV.',
                'fonts' => 'oswald:500,600,700|inter:400,500,600',
                'preset' => 'satpam',
                'color' => '#1e3a8a',
            ],
            'masjid' => [
                'label' => 'Masjid & Yayasan',
                'description' => 'Teduh dan terbuka: hijau toska dengan krem dan emas, bingkai lengkung, laporan infaq, jadwal kajian, dan kanal donasi. Cocok untuk masjid, mushola, yayasan sosial, panti asuhan, dan lembaga zakat.',
                'fonts' => 'cormorant-garamond:600,700|nunito-sans:400,600,700',
                'preset' => 'masjid',
                'color' => '#115e59',
            ],
            'gym' => [
                'label' => 'Gym & Fitness',
                'description' => 'Enerjik dan berani: hitam dengan merah menyala, huruf kapital tebal, membership, jadwal kelas, dan trainer. Cocok untuk gym, fitness center, studio yoga, crossfit, dan personal trainer.',
                'fonts' => 'bebas-neue:400|barlow:400,500,600,700',
                'preset' => 'gym',
                'color' => '#dc2626',
            ],
            'klinik' => [
                'label' => 'Klinik Pratama',
                'description' => 'Bersih dan menenangkan: biru dengan putih, kartu jadwal dokter, layanan dan tarif, info BPJS, dan pendaftaran berobat. Cocok untuk klinik pratama, praktik dokter, bidan, dan laboratorium.',
                'fonts' => 'dm-sans:400,500,600,700',
                'preset' => 'klinik',
                'color' => '#0369a1',
            ],
            'bangunan' => [
                'label' => 'Toko Bangunan',
                'description' => 'Kokoh dan praktis: kuning amber dengan abu gelap, daftar harga material, kategori produk, dan layanan kontraktor. Cocok untuk toko bangunan, depo material, toko besi, dan distributor keramik.',
                'fonts' => 'archivo:400,500,600,700,800',
                'preset' => 'bangunan',
                'color' => '#f59e0b',
            ],
            'percetakan' => [
                'label' => 'Percetakan & Advertising',
                'description' => 'Berwarna dan kreatif: magenta dengan aksen CMYK, daftar harga cetak, alur order, dan portofolio. Cocok untuk percetakan, digital printing, advertising, sablon, dan merchandise.',
                'fonts' => 'poppins:400,500,600,700',
                'preset' => 'percetakan',
                'color' => '#db2777',
            ],
            'eo' => [
                'label' => 'Event Organizer',
                'description' => 'Megah dan dramatis: latar gelap dengan sorot lampu, huruf besar modern, paket acara, dan galeri portofolio. Cocok untuk event organizer, wedding planner, penyewaan sound system, dan agensi acara.',
                'fonts' => 'syne:600,700,800|inter:400,500,600',
                'preset' => 'eo',
                'color' => '#f43f5e',
            ],
            'desa' => [
                'label' => 'Website Desa',
                'description' => 'Resmi dan ramah warga: hijau dengan aksen merah putih, data desa, layanan administrasi, transparansi APBDes, perangkat desa, dan kabar desa. Cocok untuk pemerintah desa, kelurahan, dan BUMDes.',
                'fonts' => 'merriweather:700|source-sans-3:400,600,700',
                'preset' => 'desa',
                'color' => '#15803d',
            ],
            'cv' => [
                'label' => 'CV Online / Portofolio',
                'description' => 'Personal dan rapi: latar terang, judul serif elegan, foto profil, keahlian, pengalaman kerja, dan galeri karya. Cocok untuk freelancer, desainer, fotografer, pencari kerja, dan profesional.',
                'fonts' => 'instrument-serif:400,400i|inter:400,500,600',
                'preset' => 'cv',
                'color' => '#4f46e5',
            ],
            'travel' => [
                'label' => 'Tour & Travel',
                'description' => 'Segar dan bikin ingin liburan: foto destinasi penuh layar, biru laut dengan aksen oranye senja, paket trip, itinerary, dan galeri destinasi. Cocok untuk open trip, tour & travel, agen wisata, dan penyewaan kapal.',
                'fonts' => 'outfit:400,500,600,700|caveat:600,700',
                'preset' => 'travel',
                'color' => '#0891b2',
            ],
            'kontraktor' => [
                'label' => 'Kontraktor & Renovasi',
                'description' => 'Profesional dan meyakinkan: abu gelap dengan garis blueprint dan aksen oranye, estimasi biaya per m², portofolio sebelum-sesudah, dan alur kerja. Cocok untuk kontraktor, jasa renovasi, arsitek, dan interior.',
                'fonts' => 'space-grotesk:500,600,700|inter:400,500,600',
                'preset' => 'kontraktor',
                'color' => '#ea580c',
            ],
            'umkm' => [
                'label' => 'Toko Online UMKM',
                'description' => 'Hangat dan menggugah selera: krem dengan merah cabai, foto produk membulat, katalog dengan tombol pesan WhatsApp, cara pesan, dan program reseller. Cocok untuk frozen food, sambal, kue kering, oleh-oleh, dan sembako.',
                'fonts' => 'fredoka:500,600,700|nunito:400,600,700',
                'preset' => 'umkm',
                'color' => '#be123c',
            ],
            'lpk' => [
                'label' => 'LPK & Kursus Kerja',
                'description' => 'Bersih dan bersemangat: putih dengan matahari merah dan biru, program pelatihan, biaya, alur sampai berangkat, dan cerita alumni. Cocok untuk LPK Jepang/Korea, lembaga pelatihan kerja, kursus bahasa, dan BLK.',
                'fonts' => 'plus-jakarta-sans:400,500,600,700,800',
                'preset' => 'lpk',
                'color' => '#1d4ed8',
            ],
            'ekspedisi' => [
                'label' => 'Ekspedisi & Logistik',
                'description' => 'Cepat dan tepercaya: ungu dengan garis kuning, kartu lacak resi, tarif per kota, armada pindahan, dan cara kirim. Cocok untuk ekspedisi, kargo, jasa pindahan, kurir, dan pergudangan.',
                'fonts' => 'manrope:400,500,600,700,800',
                'preset' => 'ekspedisi',
                'color' => '#6d28d9',
            ],
            'desa2' => [
                'label' => 'Portal Desa',
                'description' => 'Portal desa lengkap: banner pemandangan penuh layar, menu Jelajahi Desa, sambutan kepala desa, SOTK, administrasi penduduk, APB Desa, berita, potensi, produk UMKM, dan galeri. Cocok untuk pemerintah desa, kelurahan, dan nagari.',
                'fonts' => 'lexend:400,500,600,700',
                'preset' => 'desa2',
                'color' => '#2f7d62',
            ],
            'servis' => [
                'label' => 'Servis HP & Laptop',
                'description' => 'Modern dan teknis: latar gelap dengan titik sirkuit dan hijau menyala, daftar harga servis, garansi, cek status servis, dan alur perbaikan. Cocok untuk servis HP, laptop, komputer, dan konter gadget.',
                'fonts' => 'sora:400,500,600,700',
                'preset' => 'servis',
                'color' => '#16a34a',
            ],
            'paud' => [
                'label' => 'Daycare & PAUD/TK',
                'description' => 'Ceria dan lembut: biru langit dengan bentuk warna-warni seperti krayon, program per usia, kegiatan harian, biaya, galeri, dan pendaftaran. Cocok untuk daycare, PAUD, kelompok bermain, dan TK.',
                'fonts' => 'baloo-2:500,600,700,800|nunito:400,600,700',
                'preset' => 'paud',
                'color' => '#0284c7',
            ],
            'gereja' => [
                'label' => 'Gereja',
                'description' => 'Khidmat dan hangat: biru tua dengan aksen emas, judul serif, jadwal ibadah, ayat minggu ini, pelayanan, warta jemaat, dan persembahan. Cocok untuk gereja, paroki, persekutuan, dan yayasan Kristen.',
                'fonts' => 'playfair-display:600,700|source-sans-3:400,600,700',
                'preset' => 'gereja',
                'color' => '#1e3a5f',
            ],
            'koperasi' => [
                'label' => 'Koperasi & BUMDes',
                'description' => 'Terbuka dan tepercaya: hijau toska dengan kuning, unit usaha, simpanan dan pinjaman, laporan RAT, pengurus, dan pendaftaran anggota. Cocok untuk koperasi, KSP, BUMDes, dan koperasi desa.',
                'fonts' => 'work-sans:400,500,600,700',
                'preset' => 'koperasi',
                'color' => '#0f766e',
            ],
            'caleg' => [
                'label' => 'Caleg & Profil Tokoh',
                'description' => 'Tegas seperti poster kampanye: biru tua dengan pita warna, nama besar, foto, nomor urut, visi dan program, agenda, relawan, dan aspirasi warga. Cocok untuk calon legislatif, kepala daerah, dan tokoh masyarakat.',
                'fonts' => 'anton:400|inter:400,500,600,700',
                'preset' => 'caleg',
                'color' => '#dc2626',
            ],
            'agency' => [
                'label' => 'Digital Agency & Software House',
                'description' => 'Berani dan teknis: biru elektrik dengan aksen hijau limau, judul besar, label kode, studi kasus dengan angka hasil, layanan, teknologi, paket harga, dan alur proyek. Cocok untuk agensi digital, software house, jasa pembuatan website, dan freelancer.',
                'fonts' => 'bricolage-grotesque:400,600,700,800|jetbrains-mono:400,500,700',
                'preset' => 'agency',
                'color' => '#3b3bf5',
            ],
            'pajak' => [
                'label' => 'Konsultan Pajak & Akuntan',
                'description' => 'Teliti dan tepercaya: merah marun di atas kertas buku besar, angka rapi, kalender pajak, paket bulanan UMKM dan PT/CV, layanan SPT dan Coretax, FAQ, dan booking konsultasi. Cocok untuk konsultan pajak, kantor akuntan, dan jasa pembukuan.',
                'fonts' => 'ibm-plex-serif:500,600|ibm-plex-sans:400,500,600,700|ibm-plex-mono:500,600',
                'preset' => 'pajak',
                'color' => '#8a1c2b',
            ],
            'tani' => [
                'label' => 'Pertanian & Peternakan',
                'description' => 'Alami dan segar: hijau daun, krem, dan kuning panen, hasil panen musiman dengan harga, kapasitas panen, pasokan restoran, kemitraan petani, dan edu-wisata. Cocok untuk kebun, peternakan, perikanan, dan pemasok hasil tani.',
                'fonts' => 'bree-serif:400|nunito-sans:400,600,700',
                'preset' => 'tani',
                'color' => '#3f6b1f',
            ],
            'instansi' => [
                'label' => 'Kecamatan & Instansi',
                'description' => 'Resmi dan mudah dibaca: biru pemerintahan dengan aksen kuning, akses cepat, layanan beserta persyaratan, jam pelayanan, pengumuman, pimpinan, data wilayah, dan pengaduan. Cocok untuk kecamatan, kelurahan, dinas, dan puskesmas.',
                'fonts' => 'public-sans:400,500,600,700,800',
                'preset' => 'instansi',
                'color' => '#0b4a8b',
            ],
            'legal' => [
                'label' => 'Jasa Legal & Perizinan',
                'description' => 'Tepercaya dan modern: biru royal dengan aksen oranye, ringkasan syarat dan dokumen, alur 3 langkah, paket harga bertingkat, dan tim konsultan. Cocok untuk jasa pendirian PT/CV, perizinan, notaris, konsultan pajak, dan agensi.',
                'fonts' => 'onest:400,500,600,700,800',
                'preset' => 'legal',
                'color' => '#3048e8',
            ],
            'kopi' => [
                'label' => 'Coffee Shop',
                'description' => 'Segar dan kekinian: krem dengan hijau hutan, judul besar membulat, tulisan berjalan, menu minuman bergambar, dan lokasi gerai. Cocok untuk coffee shop, kafe, kedai teh, dan minuman kekinian.',
                'fonts' => 'poppins:400,500,600,700,800',
                'preset' => 'kopi',
                'color' => '#1f5c3d',
            ],
            'barber' => [
                'label' => 'Barbershop',
                'description' => 'Maskulin dan tegas: latar gelap, huruf kondensed besar, garis tiang barber, daftar harga gaya "65K", dan tim barber. Cocok untuk barbershop, salon pria, dan studio tato.',
                'fonts' => 'bebas-neue:400|inter:400,500,600',
                'preset' => 'barber',
                'color' => '#d32f2f',
            ],
            'tambang' => [
                'label' => 'Pertambangan & Energi',
                'description' => 'Kokoh dan berwibawa: crimson dan arang, garis pengaman kuning-hitam, panel angka kinerja, lokasi tambang, keberlanjutan, dan direksi. Cocok untuk perusahaan tambang, energi, migas, kontraktor alat berat, dan industri.',
                'fonts' => 'archivo:400,500,600,700,800',
                'preset' => 'tambang',
                'color' => '#b91c1c',
            ],
            'rental' => [
                'label' => 'Rental Mobil',
                'description' => 'Sigap dan tepercaya: biru navy dengan aksen kuning, katalog armada lengkap dengan harga per hari, pilihan lepas kunci atau dengan sopir. Cocok untuk rental mobil, travel, dan sewa bus.',
                'fonts' => 'outfit:400,500,600,700,800',
                'preset' => 'rental',
                'color' => '#0f2a5f',
            ],
            'motor' => [
                'label' => 'Rental Motor',
                'description' => 'Santai dan tropis: nuansa krem dan jingga senja, foto besar, kotak booking langsung ke WhatsApp, katalog motor dengan harga per hari. Cocok untuk rental motor wisata, sewa skuter, dan sewa sepeda.',
                'fonts' => 'outfit:400,500,600,700,800',
                'preset' => 'motor',
                'color' => '#f05a28',
            ],
            'properti' => [
                'label' => 'Properti & Perumahan',
                'description' => 'Mewah dan meyakinkan: hijau toska dengan sentuhan emas, judul serif, tipe rumah dengan spesifikasi, fasilitas, dan kalkulator cicilan KPR. Cocok untuk developer perumahan, apartemen, dan agen properti.',
                'fonts' => 'prata:400|dm-sans:400,500,600,700',
                'preset' => 'properti',
                'color' => '#0f4c5c',
            ],
            'resto' => [
                'label' => 'Restoran & Rumah Makan',
                'description' => 'Hangat dan menggugah selera: terakota dan krem, foto lengkung, menu bergambar per kategori, reservasi, dan cabang. Cocok untuk restoran, rumah makan, warung, dan katering.',
                'fonts' => 'young-serif:400|karla:400,500,600,700',
                'preset' => 'resto',
                'color' => '#c2410c',
            ],
            'gigi' => [
                'label' => 'Klinik Gigi',
                'description' => 'Bersih dan menenangkan: hijau mint, sudut sangat membulat, layanan dan harga, profil dokter, jadwal praktik, dan booking. Cocok untuk klinik gigi, klinik umum, dan praktik dokter.',
                'fonts' => 'lexend:300,400,500,600,700',
                'preset' => 'gigi',
                'color' => '#0d9488',
            ],
            'kecantikan' => [
                'label' => 'Klinik Kecantikan',
                'description' => 'Anggun dan feminin: merah muda lembut, huruf serif klasik, foto lengkung, treatment dan harga, dokter, serta hasil perawatan. Cocok untuk klinik kecantikan, skincare, salon, dan nail art.',
                'fonts' => 'bodoni-moda:400,500,400i|raleway:400,500,600',
                'preset' => 'kecantikan',
                'color' => '#b4537a',
            ],
            'villa' => [
                'label' => 'Villa & Penginapan',
                'description' => 'Tenang dan eksklusif: nuansa pasir dan kayu, foto besar, tipe kamar dengan harga per malam, fasilitas, dan galeri. Cocok untuk villa, guest house, homestay, dan resort kecil.',
                'fonts' => 'gilda-display:400|mulish:400,500,600,700',
                'preset' => 'villa',
                'color' => '#8a6a46',
            ],
            'hijab' => [
                'label' => 'Hijab & Fashion Muslim',
                'description' => 'Lembut dan elegan: warna krem dan terakota, logo di tengah, huruf serif tipis, kategori bulat, kartu produk dengan diskon, dan lookbook. Cocok untuk toko hijab, busana muslim, dan butik.',
                'fonts' => 'italiana:400|work-sans:300,400,500',
                'preset' => 'hijab',
                'color' => '#a4532f',
            ],
            'kaos' => [
                'label' => 'Jualan Kaos & Konveksi',
                'description' => 'Tegas dan energik: huruf tebal kapital, ubin kategori, kartu produk dengan warna dan ukuran, harga cetak, serta cara order custom. Cocok untuk toko kaos, sablon, konveksi, dan merchandise.',
                'fonts' => 'archivo:500,700,800,900|dm-sans:400,500,700',
                'preset' => 'kaos',
                'color' => '#e4572e',
            ],
            'mobil' => [
                'label' => 'Sales Mobil & Dealer',
                'description' => 'Bersih dan modern ala showroom: latar terang, foto mobil lebar, filter tipe mobil, tombol tanya promo dan test drive, serta simulasi kredit. Cocok untuk dealer mobil, sales mobil, showroom, dan mobil bekas.',
                'fonts' => 'manrope:400,500,600,700,800',
                'preset' => 'mobil',
                'color' => '#1d4ed8',
            ],
            'biolink' => [
                'label' => 'Bio Link',
                'description' => 'Satu kartu ringkas ala link in bio: foto profil, angka pencapaian, tombol link bertumpuk, produk unggulan, dan ulasan. Cocok untuk kreator, influencer, freelancer, dan personal brand.',
                'fonts' => 'plus-jakarta-sans:400,500,600,700,800',
                'preset' => 'biolink',
                'color' => '#6d28d9',
            ],
            'sepatu' => [
                'label' => 'Cuci Sepatu',
                'description' => 'Sporty dan cerah: oranye dengan hitam, huruf tegas, ilustrasi sneaker, daftar treatment per pasang, dan alur antar jemput. Cocok untuk cuci sepatu, perawatan sneakers, reparasi sepatu, dan cuci tas.',
                'fonts' => 'space-grotesk:400,500,600,700',
                'preset' => 'sepatu',
                'color' => '#ea580c',
            ],
            'laundry' => [
                'label' => 'Laundry',
                'description' => 'Segar dan bersih: biru langit, sudut membulat, daftar harga per kilo, cara pesan antar jemput. Cocok untuk laundry kiloan, dry clean, dan cuci sepatu.',
                'fonts' => 'nunito:400,600,700,800',
                'preset' => 'laundry',
                'color' => '#0284c7',
            ],
            'catering' => [
                'label' => 'Catering',
                'description' => 'Hangat dan menggugah selera: foto makanan besar, judul serif, menu dengan harga, paket acara. Cocok untuk katering, nasi box, tumpeng, dan prasmanan.',
                'fonts' => 'fraunces:500,600,700|dm-sans:400,500,700',
                'preset' => 'catering',
                'color' => '#b45309',
            ],
            'bengkel' => [
                'label' => 'Bengkel Mobil & Motor',
                'description' => 'Tangguh dan meyakinkan: latar gelap, aksen kuning, huruf tegas kapital, layanan dan harga jasa. Cocok untuk bengkel mobil, bengkel motor, dan servis AC mobil.',
                'fonts' => 'oswald:500,600,700|inter:400,500,600',
                'preset' => 'bengkel',
                'color' => '#facc15',
            ],
            'foto' => [
                'label' => 'Fotografer',
                'description' => 'Elegan dan sinematik: foto penuh layar, huruf serif besar, portofolio bergaya masonry, paket foto. Cocok untuk fotografer, videografer, dan studio foto.',
                'fonts' => 'dm-serif-display:400,400i|inter:400,500,600',
                'preset' => 'foto',
                'color' => '#111111',
            ],
            'wedding' => [
                'label' => 'Wedding Organizer',
                'description' => 'Romantis dan anggun: warna blush dan emas, tulisan sambung, foto lengkung, paket pernikahan dan galeri. Cocok untuk wedding organizer, dekorasi, dan venue.',
                'fonts' => 'pinyon-script:400|lora:400,500,600,400i',
                'preset' => 'wedding',
                'color' => '#a47148',
            ],
            'bimbel' => [
                'label' => 'Kursus & Bimbel',
                'description' => 'Ceria dan bersemangat: warna cerah, bentuk bermain, program belajar, pengajar, dan testimoni. Cocok untuk bimbel, kursus bahasa, les privat, dan kursus musik.',
                'fonts' => 'baloo-2:500,600,700,800|nunito:400,600,700',
                'preset' => 'bimbel',
                'color' => '#4f46e5',
            ],
            'apotek' => [
                'label' => 'Apotek',
                'description' => 'Bersih dan terpercaya: hijau medis, kotak tanya obat via WhatsApp, produk dan layanan apoteker. Cocok untuk apotek, toko obat, dan toko alat kesehatan.',
                'fonts' => 'figtree:400,500,600,700',
                'preset' => 'apotek',
                'color' => '#059669',
            ],
            'petshop' => [
                'label' => 'Pet Shop & Dokter Hewan',
                'description' => 'Ramah dan menggemaskan: warna toska, bentuk membulat, grooming, dokter hewan, pet hotel, dan produk. Cocok untuk pet shop, grooming, klinik hewan, dan penitipan.',
                'fonts' => 'fredoka:400,500,600,700',
                'preset' => 'petshop',
                'color' => '#0d9488',
            ],
            'biolink2' => [
                'label' => 'Bio Link Ceria',
                'description' => 'Ceria dan berani: latar pink, huruf oranye tebal, tombol link kapsul bergaya retro, dan link dikelompokkan dalam kotak. Cocok untuk food blogger, kreator konten, dan UMKM kuliner.',
                'fonts' => 'rubik:600,700,800|space-mono:400,700',
                'preset' => 'biolink2',
                'color' => '#e8552a',
            ],
            'biolink3' => [
                'label' => 'Bio Link Gelap',
                'description' => 'Gelap dan menyala: latar hitam dengan cahaya ungu, foto profil bercincin gradasi, tautan berkartu dengan gambar sampul. Cocok untuk musisi, DJ, gamer, streamer, dan kreator konten.',
                'fonts' => 'sora:400,600,700',
                'preset' => 'biolink3',
                'color' => '#a855f7',
            ],
            'sma' => [
                'label' => 'SMP & SMA',
                'description' => 'Modern dan berwibawa: hitam-putih elegan, foto besar, judul serif, program unggulan berlatar gelap, guru, berita, dan info PPDB. Cocok untuk SMP, SMA, SMK, dan madrasah.',
                'fonts' => 'instrument-serif:400,400i|inter:400,500,600',
                'preset' => 'sma',
                'color' => '#18181b',
            ],
        ];
    }

    /**
     * Categories for the template gallery, in display order. A template missing from every
     * category is listed under "Lainnya".
     *
     * @return array<string, array{label: string, themes: list<string>}>
     */
    public static function categories(): array
    {
        return [
            'bisnis' => ['label' => 'Bisnis & Perusahaan', 'themes' => ['korporat', 'modern', 'minimalis', 'agency', 'legal', 'lawfirm', 'pajak', 'tambang', 'tani']],
            'kuliner' => ['label' => 'Kuliner', 'themes' => ['resto', 'kopi', 'kue', 'catering']],
            'toko' => ['label' => 'Toko & Fashion', 'themes' => ['umkm', 'hijab', 'kaos', 'apotek', 'petshop', 'bangunan']],
            'kesehatan' => ['label' => 'Kesehatan & Kecantikan', 'themes' => ['klinik', 'gigi', 'kecantikan', 'spa', 'barber', 'gym']],
            'otomotif' => ['label' => 'Otomotif & Transportasi', 'themes' => ['mobil', 'rental', 'motor', 'bengkel']],
            'jasa' => ['label' => 'Jasa & Layanan', 'themes' => ['ac', 'laundry', 'sepatu', 'cleaning', 'satpam', 'percetakan', 'eo', 'kontraktor', 'ekspedisi', 'servis', 'foto', 'wedding']],
            'pendidikan' => ['label' => 'Pendidikan', 'themes' => ['paud', 'sekolah', 'sma', 'pesantren', 'bimbel', 'lpk']],
            'properti' => ['label' => 'Properti, Wisata & Travel', 'themes' => ['properti', 'villa', 'umroh', 'travel']],
            'personal' => ['label' => 'Personal & Kreator', 'themes' => ['biolink', 'biolink2', 'biolink3', 'cv', 'caleg']],
            'komunitas' => ['label' => 'Organisasi & Desa', 'themes' => ['masjid', 'gereja', 'desa', 'desa2', 'instansi', 'koperasi']],
        ];
    }

    /**
     * The gallery category of a template.
     */
    public static function categoryOf(string $theme): string
    {
        foreach (self::categories() as $key => $category) {
            if (in_array($theme, $category['themes'], true)) {
                return $key;
            }
        }

        return 'lainnya';
    }

    public static function has(?string $theme): bool
    {
        return is_string($theme) && array_key_exists($theme, self::all());
    }

    public static function current(Site $site): string
    {
        $theme = $site->get('theme');

        return self::has($theme) ? $theme : self::DEFAULT;
    }

    /**
     * The page group of the template in use: its pages are the ones the site shows and edits.
     */
    public static function currentPreset(): string
    {
        return self::all()[self::current(app(Site::class))]['preset'];
    }

    /**
     * fonts.bunny.net stylesheet for a theme (privacy-friendly Google Fonts mirror).
     */
    public static function fontsUrl(string $theme): string
    {
        return 'https://fonts.bunny.net/css?family='.self::all()[$theme]['fonts'].'&display=swap';
    }
}
