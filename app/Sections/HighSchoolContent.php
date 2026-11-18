<?php

namespace App\Sections;

/**
 * Sample pages for the SMP & SMA template: a senior high school with programmes, facilities,
 * teachers, news and new-student admission (PPDB).
 */
class HighSchoolContent
{
    /**
     * @return list<array<string, mixed>>
     */
    public static function pages(string $school): array
    {
        $programs = [
            ['title' => 'Akademik & Olimpiade', 'text' => 'Pembinaan intensif sains, matematika, dan ekonomi untuk kompetisi tingkat nasional.'],
            ['title' => 'Pendidikan Karakter', 'text' => 'Pembiasaan ibadah, latihan kepemimpinan OSIS, dan kegiatan sosial terjadwal.'],
            ['title' => 'Bahasa & Literasi', 'text' => 'Kelas bahasa Inggris dan Jepang, debat, serta program literasi harian.'],
            ['title' => 'Persiapan Kuliah', 'text' => 'Bimbingan karier, try out, dan pendampingan masuk perguruan tinggi negeri.'],
        ];

        $facilities = [
            ['title' => 'Perpustakaan', 'text' => 'Koleksi buku, jurnal, dan ruang baca yang tenang.', 'image' => 'demo/sma-library.jpg'],
            ['title' => 'Laboratorium Sains', 'text' => 'Lab fisika, kimia, dan biologi dengan peralatan lengkap.', 'image' => 'demo/sma-lab.jpg'],
            ['title' => 'Lab Komputer', 'text' => 'Untuk praktik informatika, desain, dan coding.', 'image' => 'demo/sma-computer.jpg'],
            ['title' => 'Lapangan Olahraga', 'text' => 'Lapangan basket, futsal, dan voli.', 'image' => 'demo/sma-court.jpg'],
            ['title' => 'Masjid Sekolah', 'text' => 'Tempat ibadah dan kajian rutin siswa.', 'image' => 'demo/sma-mosque.jpg'],
            ['title' => 'Aula Serbaguna', 'text' => 'Untuk seminar, pentas seni, dan wisuda.', 'image' => 'demo/sma-hall.jpg'],
        ];

        $teachers = [
            ['photo' => 'demo/sma-teacher-1.jpg', 'name' => 'Ratih Wulandari, S.Pd.', 'role' => 'Wakil Kepala Sekolah Kurikulum'],
            ['photo' => 'demo/sma-teacher-2.jpg', 'name' => 'Arief Setiawan, M.Pd.', 'role' => 'Guru Matematika'],
            ['photo' => 'demo/sma-teacher-3.jpg', 'name' => 'Nadia Puspita, S.Si.', 'role' => 'Guru Biologi'],
            ['photo' => 'demo/sma-teacher-4.jpg', 'name' => 'Fikri Maulana, S.Pd.', 'role' => 'Guru Bahasa Inggris'],
        ];

        $news = [
            ['image' => 'demo/sma-news-medal.jpg', 'category' => 'Prestasi', 'date' => '20 Okt 2026', 'title' => 'Siswa kami raih medali emas Olimpiade Sains Nasional', 'text' => 'Siswi kelas XI meraih emas bidang biologi setelah melalui seleksi tingkat kota dan provinsi.'],
            ['image' => 'demo/sma-news-literacy.jpg', 'category' => 'Kegiatan', 'date' => '12 Okt 2026', 'title' => 'Pekan Literasi: siswa terbitkan antologi cerpen', 'text' => 'Dua puluh cerpen karya siswa dibukukan dan diluncurkan di aula sekolah.'],
            ['image' => 'demo/sma-news-ppdb.jpg', 'category' => 'Pengumuman', 'date' => '1 Okt 2026', 'title' => 'Jadwal dan alur PPDB tahun ajaran baru resmi dirilis', 'text' => 'Pendaftaran kelas X dibuka mulai November secara online.'],
        ];

        $moreNews = [
            ['image' => 'demo/sma-court.jpg', 'category' => 'Prestasi', 'date' => '28 Sep 2026', 'title' => 'Tim basket putri juara turnamen antar-SMA', 'text' => 'Mengalahkan 16 sekolah dalam turnamen tingkat kota.'],
            ['image' => 'demo/sma-hall.jpg', 'category' => 'Kegiatan', 'date' => '15 Sep 2026', 'title' => 'Seminar karier bersama alumni', 'text' => 'Alumni dari berbagai kampus dan profesi berbagi pengalaman dengan siswa kelas XII.'],
            ['image' => 'demo/sma-lab.jpg', 'category' => 'Kegiatan', 'date' => '2 Sep 2026', 'title' => 'Pameran proyek P5 kelas X', 'text' => 'Siswa memamerkan proyek kewirausahaan dan lingkungan hidup.'],
        ];

        $ppdbCta = [
            'title' => 'Pendaftaran siswa baru telah dibuka',
            'text' => 'Kuota terbatas untuk calon siswa kelas X. Daftar online, tes, lalu pengumuman.',
            'button_label' => 'Daftar Sekarang',
            'button_url' => '/ppdb',
        ];

        $principal = "*\"Kami mendampingi setiap siswa menemukan potensi terbaiknya dan menyiapkannya untuk masa depan.\"*\n\nSelama lebih dari dua dekade, {$school} menghadirkan pendidikan yang seimbang antara prestasi akademik, pembentukan karakter, dan kepedulian sosial.\n\n**Dr. Hendra Gunadi, M.Pd.** — Kepala Sekolah";

        return [
            [
                'title' => 'Beranda',
                'slug' => 'beranda',
                'is_home' => true,
                'sections' => [
                    ['type' => 'hero', 'data' => [
                        'eyebrow' => 'Terakreditasi A · Sejak 1998',
                        'title' => 'Tumbuh berkarakter, *siap* menyongsong masa depan.',
                        'subtitle' => "{$school} memadukan kurikulum nasional, pembinaan karakter, dan pengembangan minat bakat siswa.",
                        'button_label' => 'Info Pendaftaran',
                        'button_url' => '/ppdb',
                        'button2_label' => 'Kenali Kami',
                        'button2_url' => '/profil',
                        'image' => 'demo/sma-hero.jpg',
                    ]],
                    ['type' => 'stats', 'data' => [
                        'items' => [
                            ['value' => '1.240', 'label' => 'Siswa aktif'],
                            ['value' => '86', 'label' => 'Guru & tenaga pendidik'],
                            ['value' => '32', 'label' => 'Ekstrakurikuler'],
                            ['value' => 'A', 'label' => 'Akreditasi BAN-S/M'],
                        ],
                    ]],
                    ['type' => 'image_text', 'data' => [
                        'title' => 'Sambutan Kepala Sekolah',
                        'body' => $principal,
                        'image' => 'demo/sma-principal.jpg',
                        'image_position' => 'left',
                        'button_label' => 'Selengkapnya tentang kami',
                        'button_url' => '/profil',
                    ]],
                    ['type' => 'services', 'data' => [
                        'title' => 'Belajar lebih dari sekadar di kelas',
                        'subtitle' => 'Program unggulan untuk prestasi, karakter, dan kesiapan kuliah.',
                        'items' => $programs,
                    ]],
                    ['type' => 'services', 'data' => [
                        'title' => 'Ruang yang mendukung belajar',
                        'items' => $facilities,
                    ]],
                    ['type' => 'posts', 'data' => [
                        'title' => 'Kabar terbaru sekolah',
                        'items' => $news,
                    ]],
                    ['type' => 'cta', 'data' => $ppdbCta],
                ],
            ],
            [
                'title' => 'Profil',
                'slug' => 'profil',
                'sections' => [
                    ['type' => 'page_header', 'data' => [
                        'title' => 'Profil Sekolah',
                        'subtitle' => "{$school} berdiri sejak 1998 dan terus berkembang sebagai sekolah yang menyeimbangkan prestasi akademik, karakter, dan kepedulian sosial.",
                        'image' => 'demo/sma-hero.jpg',
                    ]],
                    ['type' => 'image_text', 'data' => [
                        'title' => 'Sambutan Kepala Sekolah',
                        'body' => $principal,
                        'image' => 'demo/sma-principal.jpg',
                        'image_position' => 'left',
                    ]],
                    ['type' => 'text', 'data' => [
                        'title' => 'Visi & Misi',
                        'body' => "**Visi:** menjadi sekolah unggul yang berkarakter, berprestasi, dan berwawasan global.\n\n**Misi:**\n\n- Menyelenggarakan pembelajaran aktif yang menumbuhkan rasa ingin tahu\n- Membina akhlak, disiplin, dan kepemimpinan siswa\n- Mengembangkan minat dan bakat melalui ekstrakurikuler\n- Membangun kemitraan dengan orang tua, alumni, dan masyarakat",
                    ]],
                    ['type' => 'steps', 'data' => [
                        'title' => 'Perjalanan kami',
                        'items' => [
                            ['title' => '1998 · Pendirian', 'text' => 'Dibuka dengan dua rombongan belajar pertama.'],
                            ['title' => '2008 · Akreditasi A', 'text' => 'Meraih akreditasi A untuk pertama kali.'],
                            ['title' => '2016 · Gedung baru', 'text' => 'Peresmian gedung laboratorium dan perpustakaan.'],
                            ['title' => '2024 · Kurikulum Merdeka', 'text' => 'Seluruh kelas menerapkan Kurikulum Merdeka.'],
                        ],
                    ]],
                    ['type' => 'team', 'data' => [
                        'title' => 'Guru yang mendampingi',
                        'items' => $teachers,
                    ]],
                ],
            ],
            [
                'title' => 'Program',
                'slug' => 'program',
                'sections' => [
                    ['type' => 'page_header', 'data' => [
                        'title' => 'Program',
                        'subtitle' => 'Tahapan belajar dan program unggulan agar siswa berkembang di dalam dan di luar kelas.',
                    ]],
                    ['type' => 'steps', 'data' => [
                        'title' => 'Tiga tahun yang terarah',
                        'subtitle' => 'Setiap tingkat kelas punya fokus yang saling berkesinambungan.',
                        'items' => [
                            ['title' => 'Kelas X · Fase E', 'text' => 'Masa transisi dari SMP: membangun kebiasaan belajar, MPLS, dan projek P5.'],
                            ['title' => 'Kelas XI · Fase F', 'text' => 'Memilih mata pelajaran peminatan, klub riset, dan kompetisi.'],
                            ['title' => 'Kelas XII · Fase F', 'text' => 'Pemantapan materi, asesmen akhir, dan persiapan masuk perguruan tinggi.'],
                        ],
                    ]],
                    ['type' => 'services', 'data' => [
                        'title' => 'Program Unggulan',
                        'items' => $programs,
                    ]],
                    ['type' => 'pricelist', 'data' => [
                        'title' => 'Ekstrakurikuler',
                        'subtitle' => 'Pilih yang sesuai minat dan bakat.',
                        'items' => [
                            ['name' => 'Pramuka', 'price' => 'Wajib kelas X'],
                            ['name' => 'Paskibra', 'price' => 'Selasa'],
                            ['name' => 'PMR', 'price' => 'Rabu'],
                            ['name' => 'Basket', 'price' => 'Senin & Kamis'],
                            ['name' => 'Futsal', 'price' => 'Selasa & Jumat'],
                            ['name' => 'Robotik', 'price' => 'Rabu'],
                            ['name' => 'Jurnalistik', 'price' => 'Kamis'],
                            ['name' => 'English Club', 'price' => 'Jumat'],
                        ],
                        'order_button' => 'no',
                    ]],
                ],
            ],
            [
                'title' => 'Fasilitas',
                'slug' => 'fasilitas',
                'sections' => [
                    ['type' => 'page_header', 'data' => [
                        'title' => 'Fasilitas',
                        'subtitle' => 'Ruang belajar yang nyaman, aman, dan lengkap untuk kegiatan akademik maupun non-akademik.',
                    ]],
                    ['type' => 'services', 'data' => ['items' => $facilities]],
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
                'title' => 'PPDB',
                'slug' => 'ppdb',
                'sections' => [
                    ['type' => 'page_header', 'data' => [
                        'title' => 'Penerimaan Peserta Didik Baru',
                        'subtitle' => 'Pendaftaran calon siswa kelas X tahun ajaran baru.',
                        'image' => 'demo/sma-news-ppdb.jpg',
                    ]],
                    ['type' => 'steps', 'data' => [
                        'title' => 'Alur pendaftaran',
                        'items' => [
                            ['title' => 'Isi formulir online', 'text' => 'November – Januari'],
                            ['title' => 'Tes & wawancara', 'text' => 'Februari'],
                            ['title' => 'Pengumuman & daftar ulang', 'text' => 'Maret'],
                        ],
                    ]],
                    ['type' => 'text', 'data' => [
                        'title' => 'Persyaratan',
                        'body' => "- Lulusan SMP/MTs atau sederajat\n- Rapor semester 1–5 (fotokopi dilegalisir)\n- Akta kelahiran dan Kartu Keluarga\n- Pas foto berwarna 3×4, tiga lembar\n- Sertifikat prestasi untuk jalur prestasi, bila ada",
                    ]],
                    ['type' => 'faq', 'data' => [
                        'title' => 'Pertanyaan seputar PPDB',
                        'items' => [
                            ['question' => 'Jalur pendaftaran apa saja yang tersedia?', 'answer' => 'Jalur reguler, jalur prestasi akademik dan non-akademik, serta jalur afirmasi.'],
                            ['question' => 'Materi tes masuk apa saja?', 'answer' => 'Tes potensi akademik, matematika, bahasa Indonesia, dan bahasa Inggris, dilanjutkan wawancara siswa dan orang tua.'],
                            ['question' => 'Apakah ada beasiswa?', 'answer' => 'Ada beasiswa prestasi dan beasiswa bagi siswa dari keluarga kurang mampu. Hubungi panitia untuk detailnya.'],
                        ],
                    ]],
                    ['type' => 'contact', 'data' => [
                        'title' => 'Tanya panitia PPDB',
                        'text' => 'Kirim pertanyaan lewat form ini atau WhatsApp panitia pada jam kerja.',
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
                        'subtitle' => 'Senin–Jumat 07.00–15.30 · Sabtu 07.00–12.00',
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
