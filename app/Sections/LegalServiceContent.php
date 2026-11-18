<?php

namespace App\Sections;

/**
 * Sample pages for the Jasa Legal & Perizinan template: company formation and business licences,
 * a service page with requirements, steps and tiered packages, the consultant team and contact.
 */
class LegalServiceContent
{
    /**
     * @return list<array<string, mixed>>
     */
    public static function pages(string $company): array
    {
        $services = [
            ['title' => 'Pendirian PT', 'text' => 'Badan hukum untuk usaha yang ingin berkembang, ikut tender, dan mencari investor. Mulai Rp2,9jt.'],
            ['title' => 'PT Perorangan', 'text' => 'Untuk 1 pendiri WNI, tanpa akta notaris, khusus usaha mikro dan kecil. Mulai Rp950rb.'],
            ['title' => 'Pendirian CV', 'text' => 'Lebih ringkas dan hemat: cukup 2 sekutu, cocok untuk UMKM. Mulai Rp1,9jt.'],
            ['title' => 'NIB & Izin Usaha', 'text' => 'Nomor Induk Berusaha dan izin sesuai tingkat risiko KBLI di OSS RBA.'],
            ['title' => 'Pendaftaran Merek', 'text' => 'Lindungi nama dan logo usaha Anda di DJKI agar tidak dipakai pihak lain.'],
            ['title' => 'Virtual Office', 'text' => 'Alamat usaha resmi di zona komersial, lengkap dengan surat domisili.'],
        ];

        $steps = [
            ['title' => 'Konsultasi gratis', 'text' => 'Ceritakan usaha Anda. Kami bantu pilih badan usaha, nama, dan kode KBLI yang tepat.'],
            ['title' => 'Kirim dokumen', 'text' => 'Cukup KTP dan NPWP para pendiri. Tim legal kami memverifikasi semuanya.'],
            ['title' => 'Dokumen terbit', 'text' => 'Akta, SK, NPWP, dan NIB terbit. Dokumen asli dikirim gratis ke alamat Anda.'],
        ];

        $plans = [
            ['name' => 'Reguler', 'price' => 'Rp1,95jt', 'old_price' => 'Rp2,95jt', 'info' => '±2 hari kerja', 'features' => "Akta pendirian dari notaris\nSurat Keterangan Terdaftar Kemenkum\nHingga 20 KBLI bidang usaha\nKonsultasi nama dan KBLI", 'highlight' => 'no'],
            ['name' => 'Lengkap', 'badge' => 'Paling Populer', 'price' => 'Rp3,95jt', 'old_price' => 'Rp4,7jt', 'info' => '±5–10 hari kerja', 'features' => "Semua di paket Reguler\nNPWP badan & SKT pajak\nNIB & akun OSS RBA\nSertifikat Standar\nGratis ongkir dokumen asli", 'highlight' => 'yes'],
            ['name' => 'Kilat', 'price' => 'Rp4,45jt', 'old_price' => 'Rp6,6jt', 'info' => '±1–4 hari kerja', 'features' => "Semua di paket Lengkap\nPrioritas antrean\nStempel dan kartu nama\nKonsultasi legal 1 tahun", 'highlight' => 'no'],
        ];

        $testimonials = [
            ['quote' => 'Prosesnya jelas dari awal, konsultannya sigap menjawab. PT kami selesai lebih cepat dari perkiraan.', 'name' => 'Sandi Pratama', 'role' => 'Pemilik usaha konstruksi'],
            ['quote' => 'Saya awam soal KBLI, tapi dibantu pilih yang tepat. Sekarang bisa ikut tender pemerintah.', 'name' => 'Rina Kusuma', 'role' => 'Direktur CV pengadaan'],
            ['quote' => 'Harga transparan, tidak ada biaya tambahan. Dokumen asli dikirim rapi ke rumah.', 'name' => 'Agus Salim', 'role' => 'Pendiri startup F&B'],
        ];

        $faq = [
            ['question' => 'Apa beda PT dan CV?', 'answer' => 'PT adalah badan hukum dengan harta perusahaan terpisah dari harta pribadi. CV bukan badan hukum, lebih ringkas dan hemat, cocok untuk usaha kecil dan menengah.'],
            ['question' => 'Berapa modal minimal mendirikan PT?', 'answer' => 'Modal dasar ditentukan para pendiri sesuai kesepakatan, kecuali untuk bidang usaha tertentu dan PT PMA yang punya ketentuan khusus.'],
            ['question' => 'Apakah harus datang ke kantor?', 'answer' => 'Tidak perlu. Semua proses bisa online. Penandatanganan akta dapat dilakukan di notaris rekanan terdekat atau secara elektronik.'],
            ['question' => 'Apakah ada garansi?', 'answer' => 'Ada. Jika dokumen tidak terbit karena kesalahan kami, biaya jasa dikembalikan sesuai syarat dan ketentuan.'],
        ];

        $cta = [
            'title' => 'Siap melegalkan usaha Anda?',
            'text' => 'Konsultasi gratis dengan tim legal kami. Tanpa komitmen, tanpa biaya tersembunyi.',
            'button_label' => 'Konsultasi Sekarang',
            'button_url' => '/kontak',
        ];

        return [
            [
                'title' => 'Beranda',
                'slug' => 'beranda',
                'is_home' => true,
                'sections' => [
                    ['type' => 'hero', 'data' => [
                        'eyebrow' => 'Legalitas usaha tanpa ribet',
                        'title' => 'Urus izin usaha *cepat*, pasti, dan transparan',
                        'subtitle' => "{$company} membantu pendirian PT, CV, dan perizinan usaha Anda dari konsultasi sampai dokumen terbit, dikawal konsultan legal berpengalaman.",
                        'button_label' => 'Konsultasi Gratis',
                        'button_url' => '/kontak',
                        'button2_label' => 'Lihat Layanan',
                        'button2_url' => '/layanan',
                        'image' => 'demo/legal-hero.jpg',
                    ]],
                    ['type' => 'stats', 'data' => [
                        'items' => [
                            ['value' => '4.500+', 'label' => 'Dokumen legalitas selesai'],
                            ['value' => '7 tahun', 'label' => 'Pengalaman'],
                            ['value' => '4,9/5', 'label' => 'Rating Google'],
                            ['value' => '±2 hari', 'label' => 'Rata-rata akta terbit'],
                        ],
                    ]],
                    ['type' => 'services', 'data' => [
                        'title' => 'Layanan legalitas lengkap',
                        'subtitle' => 'Dari mendirikan usaha, menjalankan, sampai mengembangkannya.',
                        'items' => $services,
                    ]],
                    ['type' => 'steps', 'data' => [
                        'title' => 'Semudah 1, 2, 3',
                        'subtitle' => 'Dikawal konsultan dari awal sampai akhir.',
                        'items' => $steps,
                    ]],
                    ['type' => 'plans', 'data' => [
                        'title' => 'Paket pendirian CV',
                        'subtitle' => 'Harga transparan, semua paket sudah termasuk pendampingan konsultan.',
                        'items' => $plans,
                        'note' => 'Rincian biaya lengkap dikirim dalam proposal sebelum Anda membayar.',
                    ]],
                    ['type' => 'testimonials', 'data' => [
                        'title' => 'Dipercaya ribuan pemilik usaha',
                        'items' => $testimonials,
                    ]],
                    ['type' => 'cta', 'data' => $cta],
                ],
            ],
            [
                'title' => 'Layanan',
                'slug' => 'layanan',
                'sections' => [
                    ['type' => 'page_header', 'data' => [
                        'title' => 'Layanan Kami',
                        'subtitle' => 'Satu tempat untuk semua kebutuhan legalitas usaha Anda.',
                    ]],
                    ['type' => 'services', 'data' => [
                        'title' => 'Mendirikan usaha',
                        'items' => array_slice($services, 0, 3),
                    ]],
                    ['type' => 'services', 'data' => [
                        'title' => 'Menjalankan usaha',
                        'items' => [
                            ...array_slice($services, 3),
                            ['title' => 'Perubahan Anggaran Dasar', 'text' => 'Ubah KBLI, pengurus, pemegang saham, alamat, atau modal PT dan CV.'],
                            ['title' => 'Pengukuhan PKP', 'text' => 'Status Pengusaha Kena Pajak agar bisa menerbitkan faktur pajak.'],
                            ['title' => 'Laporan Tahunan', 'text' => 'Penyusunan laporan tahunan perusahaan sesuai ketentuan.'],
                        ],
                    ]],
                    ['type' => 'pricelist', 'data' => [
                        'title' => 'Harga mulai',
                        'items' => [
                            ['name' => 'PT Perorangan', 'info' => '±1 hari', 'price' => 'Rp950rb'],
                            ['name' => 'Pendirian CV', 'info' => '±2 hari', 'price' => 'Rp1,95jt'],
                            ['name' => 'Pendirian PT', 'info' => '±3 hari', 'price' => 'Rp2,95jt'],
                            ['name' => 'Pendaftaran Merek', 'info' => 'Per kelas', 'price' => 'Rp1,8jt'],
                            ['name' => 'Virtual Office', 'info' => 'Per tahun', 'price' => 'Rp2,4jt'],
                        ],
                        'order_button' => 'yes',
                    ]],
                    ['type' => 'cta', 'data' => $cta],
                ],
            ],
            [
                'title' => 'Pendirian CV',
                'slug' => 'pendirian-cv',
                'sections' => [
                    ['type' => 'page_header', 'data' => [
                        'title' => 'Jasa Pendirian CV',
                        'subtitle' => 'Cukup 2 sekutu, tanpa modal minimum. Akta terbit ±2 hari kerja.',
                    ]],
                    ['type' => 'image_text', 'data' => [
                        'title' => 'CV, pilihan hemat untuk UMKM',
                        'body' => "CV (Persekutuan Komanditer) didirikan oleh sekutu aktif yang mengurus usaha dan sekutu pasif yang menyetor modal.\n\nBiayanya lebih ringan daripada PT, strukturnya sederhana, dan sudah cukup untuk NIB, rekening bank perusahaan, serta banyak tender.",
                        'image' => 'demo/legal-signing.jpg',
                        'image_position' => 'right',
                    ]],
                    ['type' => 'services', 'data' => [
                        'title' => 'Ringkasan',
                        'items' => [
                            ['title' => 'Syarat', 'text' => "KTP & NPWP minimal 2 sekutu\nPembagian sekutu aktif & pasif\nAlamat usaha atau virtual office\n2–3 opsi nama dan bidang usaha"],
                            ['title' => 'Dokumen yang didapat', 'text' => "Akta pendirian CV\nSKT dari Kemenkum\nNPWP badan\nNIB & akun OSS"],
                            ['title' => 'Lama proses', 'text' => "Akta ±2 hari kerja\nIzin usaha ±5–10 hari kerja\nPaket Kilat lebih cepat"],
                            ['title' => 'Keuntungan CV', 'text' => "Biaya lebih ringan dari PT\nTanpa modal minimum\nStruktur sederhana\nBisa ikut banyak tender"],
                        ],
                    ]],
                    ['type' => 'steps', 'data' => [
                        'title' => 'Cara kerja',
                        'items' => $steps,
                    ]],
                    ['type' => 'plans', 'data' => [
                        'title' => 'Biaya jasa pendirian CV',
                        'items' => $plans,
                        'note' => 'Harga dapat berubah sesuai lokasi notaris dan kebutuhan izin.',
                    ]],
                    ['type' => 'faq', 'data' => [
                        'title' => 'Pertanyaan seputar CV',
                        'items' => $faq,
                    ]],
                ],
            ],
            [
                'title' => 'Tentang',
                'slug' => 'tentang',
                'sections' => [
                    ['type' => 'page_header', 'data' => [
                        'title' => 'Tentang Kami',
                        'subtitle' => "Mengenal {$company} dan tim legal di balik layanan kami.",
                    ]],
                    ['type' => 'image_text', 'data' => [
                        'title' => 'Legalitas yang dikawal orang sungguhan',
                        'body' => "Sejak 2019 kami membantu ribuan pemilik usaha di seluruh Indonesia melegalkan usahanya.\n\nSetiap berkas diperiksa konsultan legal sebelum ke notaris, supaya tidak ada revisi di tengah jalan.",
                        'image' => 'demo/legal-team.jpg',
                        'image_position' => 'left',
                    ]],
                    ['type' => 'team', 'data' => [
                        'title' => 'Tim konsultan',
                        'subtitle' => 'Fast response, siap membantu dari pilih badan usaha sampai izin terbit.',
                        'items' => [
                            ['photo' => 'demo/legal-consultant-1.jpg', 'name' => 'Nadia Pramesti, S.H.', 'role' => 'Manager Legal'],
                            ['photo' => 'demo/legal-consultant-2.jpg', 'name' => 'Rizal Hakim, S.H.', 'role' => 'Konsultan Perizinan'],
                        ],
                    ]],
                    ['type' => 'gallery', 'data' => [
                        'items' => [
                            ['image' => 'demo/legal-handover.jpg', 'caption' => 'Serah terima dokumen klien'],
                            ['image' => 'demo/legal-docs.jpg', 'caption' => 'Dokumen legalitas lengkap'],
                            ['image' => 'demo/legal-signing.jpg', 'caption' => 'Penandatanganan akta'],
                        ],
                    ]],
                ],
            ],
            [
                'title' => 'Kontak',
                'slug' => 'kontak',
                'sections' => [
                    ['type' => 'page_header', 'data' => [
                        'title' => 'Konsultasi Gratis',
                        'subtitle' => 'Senin–Sabtu, 08.00–20.00. Respons tercepat lewat WhatsApp.',
                    ]],
                    ['type' => 'contact', 'data' => [
                        'title' => 'Ceritakan kebutuhan Anda',
                        'text' => 'Sebutkan jenis usaha dan layanan yang dibutuhkan. Konsultan kami akan menghubungi Anda.',
                        'show_form' => 'yes',
                    ]],
                ],
            ],
        ];
    }
}
