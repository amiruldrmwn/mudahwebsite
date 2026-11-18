<?php

namespace App\Sections;

/**
 * Sample pages for the Sekolah template: an elementary school with programmes, facilities,
 * teachers, news and new-student registration (SPMB).
 */
class SchoolContent
{
    /**
     * @return list<array<string, mixed>>
     */
    public static function pages(string $school): array
    {
        $programs = [
            ['title' => 'Tahfidz & Pembiasaan Ibadah', 'text' => 'Hafalan surat pendek dan doa harian yang dibimbing guru setiap pagi sebelum pelajaran.'],
            ['title' => 'English Day', 'text' => 'Dua hari setiap pekan siswa berlatih bercakap dalam bahasa Inggris dengan cara yang menyenangkan.'],
            ['title' => 'Literasi & Pojok Baca', 'text' => 'Gerakan 15 menit membaca setiap hari, didukung pojok baca di setiap kelas.'],
            ['title' => 'Sekolah Adiwiyata', 'text' => 'Siswa merawat kebun sekolah, memilah sampah, dan belajar membuat kompos.'],
        ];

        $facilities = [
            ['title' => 'Ruang Kelas', 'text' => 'Kelas terang dan sejuk dengan proyektor dan pojok baca.', 'image' => 'demo/sd-classroom.jpg'],
            ['title' => 'Perpustakaan', 'text' => 'Ribuan buku cerita dan pengetahuan untuk segala usia.', 'image' => 'demo/sd-library.jpg'],
            ['title' => 'Laboratorium Komputer', 'text' => 'Belajar dasar teknologi dan coding sejak kelas 3.', 'image' => 'demo/sd-lab.jpg'],
            ['title' => 'Lapangan Olahraga', 'text' => 'Lapangan serbaguna untuk sepak bola, futsal, dan upacara.', 'image' => 'demo/sd-field.jpg'],
            ['title' => 'Musala', 'text' => 'Tempat salat berjamaah dan kegiatan keagamaan.', 'image' => 'demo/sd-musala.jpg'],
            ['title' => 'Kantin Sehat', 'text' => 'Menu bergizi dan higienis yang diawasi pihak sekolah.', 'image' => 'demo/sd-canteen.jpg'],
        ];

        $teachers = [
            ['photo' => 'demo/sd-teacher-1.jpg', 'name' => 'Ani Lestari, S.Pd.', 'role' => 'Wali Kelas 1A'],
            ['photo' => 'demo/sd-teacher-2.jpg', 'name' => 'Budi Santoso, S.Pd.', 'role' => 'Guru PJOK'],
            ['photo' => 'demo/sd-teacher-3.jpg', 'name' => 'Dewi Kartika, S.Pd.', 'role' => 'Guru Bahasa Inggris'],
            ['photo' => 'demo/sd-teacher-4.jpg', 'name' => 'Rudi Hartono, S.Kom.', 'role' => 'Guru TIK'],
        ];

        $news = [
            ['image' => 'demo/sd-news-olympiad.jpg', 'category' => 'Prestasi', 'date' => '18 Okt 2026', 'title' => 'Juara 1 Olimpiade Matematika tingkat kota', 'text' => 'Siswa kelas 5A meraih medali emas setelah bersaing dengan lebih dari seratus peserta.'],
            ['image' => 'demo/sd-news-batik.jpg', 'category' => 'Kegiatan', 'date' => '2 Okt 2026', 'title' => 'Hari Batik Nasional bersama orang tua siswa', 'text' => 'Lomba busana batik dan belajar membatik sederhana bersama keluarga.'],
            ['image' => 'demo/sd-news-exam.jpg', 'category' => 'Pengumuman', 'date' => '25 Sep 2026', 'title' => 'Jadwal Penilaian Tengah Semester ganjil', 'text' => 'PTS dilaksanakan 7–11 Oktober. Kisi-kisi dibagikan melalui wali kelas.'],
        ];

        $moreNews = [
            ['image' => 'demo/sd-field.jpg', 'category' => 'Prestasi', 'date' => '20 Sep 2026', 'title' => 'Tim Pramuka juara umum Jambore Ranting', 'text' => 'Regu Siaga putra dan putri membawa pulang lima piala.'],
            ['image' => 'demo/sd-classroom.jpg', 'category' => 'Kegiatan', 'date' => '17 Agu 2026', 'title' => 'Upacara dan lomba HUT Republik Indonesia', 'text' => 'Petugas upacara seluruhnya siswa kelas 6, dilanjutkan lomba tujuh belasan.'],
            ['image' => 'demo/sd-library.jpg', 'category' => 'Pengumuman', 'date' => '1 Jul 2026', 'title' => 'Kalender akademik tahun ajaran baru', 'text' => 'Jadwal libur, penilaian, dan kegiatan sekolah selama satu tahun.'],
        ];

        $spmbSteps = [
            ['title' => 'Pendaftaran online', 'text' => '1 November – 31 Januari'],
            ['title' => 'Observasi & wawancara orang tua', 'text' => 'Februari'],
            ['title' => 'Pengumuman & daftar ulang', 'text' => 'Maret'],
        ];

        $spmbCta = [
            'title' => 'Pendaftaran siswa baru kelas 1 telah dibuka',
            'text' => 'Kuota terbatas 96 siswa. Usia minimal 6 tahun per 1 Juli.',
            'button_label' => 'Daftar Sekarang',
            'button_url' => '/spmb',
        ];

        return [
            [
                'title' => 'Beranda',
                'slug' => 'beranda',
                'is_home' => true,
                'sections' => [
                    ['type' => 'hero', 'data' => [
                        'eyebrow' => 'Sekolah Dasar · Sejak 1987',
                        'title' => 'Belajar dengan *gembira*, tumbuh dengan karakter.',
                        'subtitle' => "{$school} menghadirkan pendidikan dasar kelas 1–6 yang menyenangkan, aman, dan berlandaskan nilai Pancasila.",
                        'button_label' => 'Info Pendaftaran',
                        'button_url' => '/spmb',
                        'button2_label' => 'Kenali Kami',
                        'button2_url' => '/tentang',
                        'image' => 'demo/sd-hero.jpg',
                    ]],
                    ['type' => 'stats', 'data' => [
                        'items' => [
                            ['value' => '480', 'label' => 'Siswa aktif'],
                            ['value' => '32', 'label' => 'Guru & tenaga kependidikan'],
                            ['value' => '24', 'label' => 'Rombongan belajar'],
                            ['value' => '60+', 'label' => 'Prestasi lomba tiap tahun'],
                        ],
                    ]],
                    ['type' => 'image_text', 'data' => [
                        'title' => 'Sambutan Kepala Sekolah',
                        'body' => "*\"Setiap anak unik dan punya cara belajarnya sendiri. Tugas kami mengenali, merawat, dan menumbuhkan potensinya.\"*\n\nKami menerapkan Kurikulum Merdeka dengan pembelajaran aktif, penguatan Profil Pelajar Pancasila, dan pembiasaan karakter sejak dini, bersama orang tua sebagai mitra utama.\n\n**Dra. Siti Rahmawati, M.Pd.** — Kepala Sekolah",
                        'image' => 'demo/sd-principal.jpg',
                        'image_position' => 'left',
                        'button_label' => 'Visi & Misi',
                        'button_url' => '/tentang',
                    ]],
                    ['type' => 'services', 'data' => [
                        'title' => 'Program Unggulan',
                        'subtitle' => 'Belajar lebih dari sekadar ruang kelas.',
                        'items' => $programs,
                    ]],
                    ['type' => 'services', 'data' => [
                        'title' => 'Fasilitas Sekolah',
                        'subtitle' => 'Lingkungan yang aman dan ramah anak, dilengkapi CCTV dan petugas keamanan.',
                        'items' => $facilities,
                    ]],
                    ['type' => 'team', 'data' => [
                        'title' => 'Guru Kami',
                        'subtitle' => 'Pendidik yang sabar, hangat, dan berpengalaman.',
                        'items' => $teachers,
                    ]],
                    ['type' => 'posts', 'data' => [
                        'title' => 'Berita & Prestasi',
                        'subtitle' => 'Kabar terbaru dari sekolah.',
                        'items' => $news,
                    ]],
                    ['type' => 'cta', 'data' => $spmbCta],
                ],
            ],
            [
                'title' => 'Tentang',
                'slug' => 'tentang',
                'sections' => [
                    ['type' => 'page_header', 'data' => [
                        'title' => 'Hampir empat dekade mendidik anak bangsa',
                        'subtitle' => "{$school} berdiri tahun 1987. Dari tiga ruang kelas dan 60 siswa, kini kami melayani 480 siswa dalam 24 rombongan belajar.",
                        'image' => 'demo/sd-classroom.jpg',
                    ]],
                    ['type' => 'image_text', 'data' => [
                        'title' => 'Visi & Misi',
                        'body' => "**Visi:** terwujudnya peserta didik yang beriman, cerdas, mandiri, dan cinta tanah air.\n\n**Misi:**\n\n- Pembelajaran aktif dan menyenangkan sesuai Kurikulum Merdeka\n- Pembinaan akhlak dan karakter melalui pembiasaan harian\n- Menumbuhkan budaya literasi, numerasi, dan cinta tanah air\n- Kemitraan erat dengan orang tua dan masyarakat",
                        'image' => 'demo/sd-principal.jpg',
                        'image_position' => 'right',
                    ]],
                    ['type' => 'steps', 'data' => [
                        'title' => 'Perjalanan Kami',
                        'items' => [
                            ['title' => '1987 · Sekolah berdiri', 'text' => 'Dimulai dengan tiga ruang kelas dan 60 siswa angkatan pertama.'],
                            ['title' => '1998 · Gedung baru', 'text' => 'Penambahan ruang kelas, perpustakaan, dan musala.'],
                            ['title' => '2009 · Akreditasi A', 'text' => 'Meraih akreditasi A dan dipertahankan hingga kini.'],
                            ['title' => '2022 · Kurikulum Merdeka', 'text' => 'Menerapkan Kurikulum Merdeka di seluruh jenjang kelas.'],
                        ],
                    ]],
                    ['type' => 'pricelist', 'data' => [
                        'title' => 'Identitas Sekolah',
                        'items' => [
                            ['name' => 'Nama sekolah', 'price' => $school],
                            ['name' => 'NPSN', 'price' => '20100000'],
                            ['name' => 'Status', 'price' => 'Swasta'],
                            ['name' => 'Akreditasi', 'price' => 'A'],
                            ['name' => 'Kurikulum', 'price' => 'Kurikulum Merdeka'],
                            ['name' => 'Waktu belajar', 'price' => 'Pagi, 5 hari'],
                        ],
                        'order_button' => 'no',
                    ]],
                ],
            ],
            [
                'title' => 'Program',
                'slug' => 'program',
                'sections' => [
                    ['type' => 'page_header', 'data' => [
                        'title' => 'Program Sekolah',
                        'subtitle' => 'Kegiatan belajar dan pembiasaan yang membentuk anak cerdas dan berkarakter.',
                    ]],
                    ['type' => 'services', 'data' => [
                        'title' => 'Program Unggulan',
                        'items' => $programs,
                    ]],
                    ['type' => 'services', 'data' => [
                        'title' => 'Ekstrakurikuler',
                        'subtitle' => 'Wadah siswa menyalurkan minat dan bakat.',
                        'items' => [
                            ['title' => 'Pramuka', 'text' => 'Wajib untuk kelas 3–6, melatih kemandirian dan kerja sama.'],
                            ['title' => 'Futsal', 'text' => 'Latihan rutin dan turnamen antarsekolah.'],
                            ['title' => 'Tari Tradisional', 'text' => 'Mengenal dan melestarikan tarian Nusantara.'],
                            ['title' => 'Robotik', 'text' => 'Merakit dan memprogram robot sederhana.'],
                            ['title' => 'Melukis', 'text' => 'Mengasah kreativitas lewat gambar dan warna.'],
                            ['title' => 'Paduan Suara', 'text' => 'Tampil di upacara dan acara sekolah.'],
                        ],
                    ]],
                    ['type' => 'cta', 'data' => $spmbCta],
                ],
            ],
            [
                'title' => 'Fasilitas',
                'slug' => 'fasilitas',
                'sections' => [
                    ['type' => 'page_header', 'data' => [
                        'title' => 'Fasilitas Sekolah',
                        'subtitle' => 'Seluruh area dilengkapi CCTV, petugas keamanan, dan jalur antar-jemput terpisah.',
                    ]],
                    ['type' => 'services', 'data' => ['items' => $facilities]],
                    ['type' => 'gallery', 'data' => [
                        'title' => 'Suasana Sekolah',
                        'items' => array_map(fn (array $f) => ['image' => $f['image'], 'caption' => $f['title']], $facilities),
                    ]],
                ],
            ],
            [
                'title' => 'Guru',
                'slug' => 'guru',
                'sections' => [
                    ['type' => 'page_header', 'data' => [
                        'title' => 'Guru & Tenaga Kependidikan',
                        'subtitle' => 'Pendidik bersertifikat yang sabar, hangat, dan terus belajar.',
                    ]],
                    ['type' => 'team', 'data' => [
                        'title' => 'Pimpinan Sekolah',
                        'items' => [
                            ['photo' => 'demo/sd-principal.jpg', 'name' => 'Dra. Siti Rahmawati, M.Pd.', 'role' => 'Kepala Sekolah'],
                        ],
                    ]],
                    ['type' => 'team', 'data' => [
                        'title' => 'Guru Kami',
                        'items' => $teachers,
                    ]],
                ],
            ],
            [
                'title' => 'Berita',
                'slug' => 'berita',
                'sections' => [
                    ['type' => 'page_header', 'data' => [
                        'title' => 'Berita & Prestasi',
                        'subtitle' => 'Kegiatan, pengumuman, dan prestasi terbaru dari sekolah.',
                    ]],
                    ['type' => 'posts', 'data' => ['items' => [...$news, ...$moreNews]]],
                ],
            ],
            [
                'title' => 'SPMB',
                'slug' => 'spmb',
                'sections' => [
                    ['type' => 'page_header', 'data' => [
                        'title' => 'Penerimaan Siswa Baru Kelas 1',
                        'subtitle' => 'Kuota 96 siswa dalam 4 rombongan belajar. Hubungi panitia untuk informasi lebih lanjut.',
                        'image' => 'demo/sd-hero.jpg',
                    ]],
                    ['type' => 'steps', 'data' => [
                        'title' => 'Alur Pendaftaran',
                        'subtitle' => 'Tiga langkah menuju kelas 1.',
                        'items' => $spmbSteps,
                    ]],
                    ['type' => 'text', 'data' => [
                        'title' => 'Persyaratan',
                        'body' => "- Usia minimal 6 tahun per 1 Juli; usia 7 tahun diutamakan\n- Akta kelahiran dan Kartu Keluarga (asli dan fotokopi)\n- Pas foto berwarna 3×4, dua lembar\n- Surat keterangan dari TK/PAUD, bila ada\n- Kartu KIP/PKH untuk jalur afirmasi\n\nBerkas dibawa saat verifikasi di sekolah.",
                    ]],
                    ['type' => 'faq', 'data' => [
                        'title' => 'Pertanyaan Seputar Pendaftaran',
                        'items' => [
                            ['question' => 'Apakah ada tes masuk?', 'answer' => 'Tidak ada tes membaca atau berhitung. Kami melakukan observasi kesiapan sekolah dan wawancara dengan orang tua.'],
                            ['question' => 'Berapa biaya pendaftaran?', 'answer' => 'Rincian biaya diberikan saat pendaftaran. Tersedia jalur afirmasi untuk keluarga penerima KIP/PKH.'],
                            ['question' => 'Apakah tersedia antar-jemput?', 'answer' => 'Ya, sekolah bekerja sama dengan layanan antar-jemput untuk beberapa wilayah sekitar.'],
                        ],
                    ]],
                    ['type' => 'contact', 'data' => [
                        'title' => 'Tanya panitia SPMB',
                        'text' => 'Kirim pertanyaan lewat form ini atau WhatsApp panitia, Senin–Jumat pukul 06.30–15.00.',
                        'show_form' => 'yes',
                    ]],
                ],
            ],
            [
                'title' => 'Kontak',
                'slug' => 'kontak',
                'sections' => [
                    ['type' => 'page_header', 'data' => [
                        'title' => 'Hubungi Kami',
                        'subtitle' => 'Senin–Jumat 06.30–15.00 · Sabtu 07.00–12.00',
                    ]],
                    ['type' => 'contact', 'data' => [
                        'title' => 'Kami siap membantu',
                        'text' => 'Ada pertanyaan tentang sekolah? Kirim pesan dan kami akan segera membalas.',
                        'show_form' => 'yes',
                    ]],
                ],
            ],
        ];
    }
}
