<?php

namespace App\Sections;

use App\Models\Page;
use App\Support\Site;
use Illuminate\Support\Facades\Storage;

/**
 * The pages a site starts with, filled with sample copy and photos (resources/demo) the owner
 * replaces by hand or with the AI assistant. Each preset suits a group of templates (see
 * Themes::all()): korporat (Beranda, Tentang Kami, Layanan, Proyek, Kontak), spa and kue.
 */
class DefaultContent
{
    /** Sample photos and logos, copied to the public disk under demo/ when the pages are made. */
    private const PHOTOS_DIR = 'resources/demo';

    /** The sample logo a site shows until the owner uploads theirs. */
    public const LOGO = 'demo/logo.svg';

    public const PRESETS = ['korporat', 'spa', 'kue', 'sekolah', 'sma', 'umroh', 'ac', 'legal', 'kopi', 'barber'];

    /** Template groups whose sample logo is an emblem image instead of the drawn mark (LOGO). */
    private const SAMPLE_LOGOS = ['sekolah' => 'demo/logo-sd.png', 'sma' => 'demo/logo-osis.png'];

    public static function sampleLogo(string $preset): string
    {
        return self::SAMPLE_LOGOS[$preset] ?? self::LOGO;
    }

    /**
     * Whether a logo is one of the sample logos (not uploaded by the owner).
     */
    public static function isSampleLogo(mixed $logo): bool
    {
        return $logo === self::LOGO || in_array($logo, self::SAMPLE_LOGOS, true);
    }

    public static function install(string $company, bool $replace = false, string $preset = 'korporat'): bool
    {
        if (Page::allPresets()->where('preset', $preset)->exists()) {
            if (! $replace) {
                return false;
            }

            Page::allPresets()->where('preset', $preset)->delete();
        }

        self::copyPhotos();

        $site = app(Site::class);

        if (blank($site->get('logo')) || self::isSampleLogo($site->get('logo'))) {
            $site->put(['logo' => self::sampleLogo($preset)]);
        }

        foreach (self::pagesFor($preset, $company) as $position => $page) {
            Page::query()->create([
                ...$page,
                'preset' => $preset,
                'position' => $position,
                'sections' => array_map(fn (array $s) => SectionTypes::clean($s), $page['sections']),
            ]);
        }

        return true;
    }

    private static function copyPhotos(): void
    {
        $disk = Storage::disk('public');

        $dir = base_path(self::PHOTOS_DIR);

        foreach ([...(glob("{$dir}/*.jpg") ?: []), ...(glob("{$dir}/*.svg") ?: []), ...(glob("{$dir}/*.png") ?: [])] as $file) {
            $path = 'demo/'.basename($file);

            if (! $disk->exists($path)) {
                $disk->put($path, (string) file_get_contents($file));
            }
        }
    }

    /**
     * The sample pages of a preset, not saved: used by install() and the template previews.
     *
     * @return list<array<string, mixed>>
     */
    public static function pagesFor(string $preset, string $company): array
    {
        return match ($preset) {
            'spa' => SpaContent::pages($company),
            'kue' => CakeContent::pages($company),
            'sekolah' => SchoolContent::pages($company),
            'sma' => HighSchoolContent::pages($company),
            'umroh' => UmrohContent::pages($company),
            'ac' => AcServiceContent::pages($company),
            'legal' => LegalServiceContent::pages($company),
            'kopi' => CoffeeShopContent::pages($company),
            'barber' => BarbershopContent::pages($company),
            default => self::pages($company),
        };
    }

    /**
     * Makes sure the sample photos exist on the public disk (for previews before install).
     */
    public static function ensurePhotos(): void
    {
        self::copyPhotos();
    }

    /**
     * @return list<array<string, mixed>>
     */
    private static function pages(string $company): array
    {
        $services = [
            ['title' => 'Konsultasi & Perencanaan', 'text' => 'Kami pelajari kebutuhan dan tujuan bisnis Anda, lalu menyusun rencana kerja yang jelas, terukur, dan sesuai anggaran.', 'image' => 'demo/consulting.jpg'],
            ['title' => 'Pelaksanaan Proyek', 'text' => 'Tim lapangan berpengalaman menjalankan proyek dengan standar mutu dan keselamatan kerja yang ketat, tepat waktu.', 'image' => 'demo/engineers.jpg'],
            ['title' => 'Layanan Purna Jual', 'text' => 'Dukungan dan pemeliharaan berkelanjutan agar hasil kerja tetap optimal, dengan tim yang siap membantu kapan saja.', 'image' => 'demo/support.jpg'],
        ];

        $steps = [
            ['title' => 'Konsultasi', 'text' => 'Ceritakan kebutuhan Anda. Konsultasi awal gratis, tanpa komitmen.'],
            ['title' => 'Penawaran', 'text' => 'Kami kirim rencana kerja, jadwal, dan penawaran harga yang transparan.'],
            ['title' => 'Pelaksanaan', 'text' => 'Proyek berjalan dengan laporan progres rutin yang bisa Anda pantau.'],
            ['title' => 'Serah Terima', 'text' => 'Hasil diperiksa bersama, lalu kami lanjutkan dengan dukungan purna jual.'],
        ];

        $testimonials = [
            ['quote' => 'Pekerjaannya rapi, komunikasinya jelas, dan selesai lebih cepat dari jadwal. Kami pasti bekerja sama lagi.', 'name' => 'Budi Santoso', 'role' => 'Direktur Operasional, PT Sinar Abadi'],
            ['quote' => 'Tim yang profesional dan mudah diajak berdiskusi. Setiap pertanyaan kami dijawab dengan cepat.', 'name' => 'Siti Rahmawati', 'role' => 'Manajer Proyek, CV Mitra Sejahtera'],
            ['quote' => 'Harga transparan sejak awal dan tidak ada biaya tersembunyi. Sangat direkomendasikan.', 'name' => 'Andreas Wijaya', 'role' => 'Pemilik, Wijaya Group'],
        ];

        $cta = [
            'title' => 'Siap memulai proyek Anda?',
            'text' => 'Konsultasikan kebutuhan Anda secara gratis. Tim kami akan menghubungi Anda dalam 1x24 jam.',
            'button_label' => 'Konsultasi Gratis',
            'button_url' => '/kontak',
        ];

        return [
            [
                'title' => 'Beranda',
                'slug' => 'beranda',
                'is_home' => true,
                'sections' => [
                    ['type' => 'hero', 'data' => [
                        'eyebrow' => 'Mitra bisnis terpercaya sejak 2010',
                        'title' => 'Solusi profesional untuk pertumbuhan bisnis Anda',
                        'subtitle' => "{$company} membantu perusahaan di seluruh Indonesia bekerja lebih efisien dengan layanan yang tepat waktu, transparan, dan berorientasi pada hasil.",
                        'button_label' => 'Konsultasi Gratis',
                        'button_url' => '/kontak',
                        'button2_label' => 'Lihat Layanan',
                        'button2_url' => '/layanan',
                        'image' => 'demo/hero-tower.jpg',
                    ]],
                    ['type' => 'clients', 'data' => [
                        'title' => 'Dipercaya oleh perusahaan terkemuka',
                        'items' => [
                            ['name' => 'Sinar Abadi', 'logo' => 'demo/client-sinar-abadi.svg'],
                            ['name' => 'Mitra Sejahtera', 'logo' => 'demo/client-mitra-sejahtera.svg'],
                            ['name' => 'Wijaya Group', 'logo' => 'demo/client-wijaya-group.svg'],
                            ['name' => 'Nusantara Jaya', 'logo' => 'demo/client-nusantara-jaya.svg'],
                            ['name' => 'Bumi Karya', 'logo' => 'demo/client-bumi-karya.svg'],
                            ['name' => 'Cahaya Logistik', 'logo' => 'demo/client-cahaya-logistik.svg'],
                        ],
                    ]],
                    ['type' => 'image_text', 'data' => [
                        'title' => 'Lebih dari satu dekade melayani dengan sepenuh hati',
                        'body' => "Berawal dari tim kecil, {$company} kini dipercaya ratusan klien dari berbagai bidang usaha.\n\n- Tim berpengalaman dan bersertifikat\n- Proses kerja jelas dengan laporan rutin\n- Harga transparan tanpa biaya tersembunyi",
                        'image' => 'demo/team-meeting.jpg',
                        'image_position' => 'left',
                        'button_label' => 'Tentang Kami',
                        'button_url' => '/tentang',
                    ]],
                    ['type' => 'services', 'data' => [
                        'title' => 'Layanan Kami',
                        'subtitle' => 'Solusi lengkap dari perencanaan hingga purna jual, disesuaikan dengan kebutuhan Anda.',
                        'items' => $services,
                    ]],
                    ['type' => 'stats', 'data' => [
                        'items' => [
                            ['value' => '15+', 'label' => 'Tahun pengalaman'],
                            ['value' => '350+', 'label' => 'Klien puas'],
                            ['value' => '1.200+', 'label' => 'Proyek selesai'],
                            ['value' => '24/7', 'label' => 'Dukungan pelanggan'],
                        ],
                    ]],
                    ['type' => 'steps', 'data' => [
                        'title' => 'Cara Kerja Kami',
                        'subtitle' => 'Empat langkah sederhana dari konsultasi sampai proyek selesai.',
                        'items' => $steps,
                    ]],
                    ['type' => 'testimonials', 'data' => [
                        'title' => 'Apa Kata Klien Kami',
                        'items' => $testimonials,
                    ]],
                    ['type' => 'cta', 'data' => $cta],
                ],
            ],
            [
                'title' => 'Tentang Kami',
                'slug' => 'tentang',
                'sections' => [
                    ['type' => 'page_header', 'data' => [
                        'title' => 'Tentang Kami',
                        'subtitle' => "Mengenal lebih dekat {$company}, tim, dan nilai-nilai yang kami pegang.",
                        'image' => 'demo/city.jpg',
                    ]],
                    ['type' => 'image_text', 'data' => [
                        'title' => 'Perjalanan Kami',
                        'body' => "{$company} didirikan pada tahun 2010 dengan satu tujuan: memberikan layanan terbaik bagi setiap klien.\n\nBerbekal tim yang berpengalaman dan proses kerja yang jelas, kami terus tumbuh dan kini melayani klien di berbagai kota di Indonesia.",
                        'image' => 'demo/lobby.jpg',
                        'image_position' => 'right',
                    ]],
                    ['type' => 'image_text', 'data' => [
                        'title' => 'Visi & Misi',
                        'body' => "**Visi:** menjadi mitra bisnis paling terpercaya di Indonesia.\n\n**Misi:**\n\n- Memberikan layanan berkualitas tinggi dengan harga yang adil\n- Mengutamakan kepuasan dan keselamatan klien\n- Terus berinovasi mengikuti perkembangan teknologi\n- Membangun tim yang kompeten dan berintegritas",
                        'image' => 'demo/presentation.jpg',
                        'image_position' => 'left',
                    ]],
                    ['type' => 'services', 'data' => [
                        'title' => 'Nilai-Nilai Kami',
                        'items' => [
                            ['title' => 'Integritas', 'text' => 'Jujur dan transparan dalam setiap pekerjaan dan kesepakatan.'],
                            ['title' => 'Kualitas', 'text' => 'Standar tinggi pada setiap detail, tanpa kompromi.'],
                            ['title' => 'Kolaborasi', 'text' => 'Bekerja bersama klien sebagai satu tim untuk hasil terbaik.'],
                        ],
                    ]],
                    ['type' => 'team', 'data' => [
                        'title' => 'Tim Manajemen',
                        'subtitle' => 'Orang-orang berpengalaman yang memimpin perusahaan.',
                        'items' => [
                            ['photo' => 'demo/team-1.jpg', 'name' => 'Hendra Gunawan', 'role' => 'Direktur Utama'],
                            ['photo' => 'demo/team-2.jpg', 'name' => 'Nur Aisyah', 'role' => 'Direktur Keuangan'],
                            ['photo' => 'demo/team-3.jpg', 'name' => 'Rizky Pratama', 'role' => 'Direktur Operasional'],
                            ['photo' => 'demo/team-4.jpg', 'name' => 'Dewi Lestari', 'role' => 'Kepala Pemasaran'],
                        ],
                    ]],
                    ['type' => 'stats', 'data' => [
                        'items' => [
                            ['value' => '2010', 'label' => 'Tahun berdiri'],
                            ['value' => '120+', 'label' => 'Karyawan'],
                            ['value' => '12', 'label' => 'Kota terlayani'],
                        ],
                    ]],
                ],
            ],
            [
                'title' => 'Layanan',
                'slug' => 'layanan',
                'sections' => [
                    ['type' => 'page_header', 'data' => [
                        'title' => 'Layanan Kami',
                        'subtitle' => 'Solusi menyeluruh yang dirancang untuk kebutuhan bisnis Anda.',
                        'image' => 'demo/office.jpg',
                    ]],
                    ['type' => 'services', 'data' => [
                        'title' => 'Apa yang Kami Kerjakan',
                        'subtitle' => 'Setiap layanan ditangani tim khusus yang berpengalaman di bidangnya.',
                        'items' => [
                            ...$services,
                            ['title' => 'Riset & Inovasi', 'text' => 'Mengembangkan ide dan solusi baru agar bisnis Anda selalu selangkah di depan.', 'image' => 'demo/brainstorm.jpg'],
                            ['title' => 'Pelatihan Tim', 'text' => 'Program pelatihan agar tim Anda menguasai sistem dan proses kerja yang baru.', 'image' => 'demo/presentation.jpg'],
                            ['title' => 'Kemitraan Jangka Panjang', 'text' => 'Kontrak layanan tahunan dengan harga khusus dan prioritas penanganan.', 'image' => 'demo/handshake.jpg'],
                        ],
                    ]],
                    ['type' => 'steps', 'data' => [
                        'title' => 'Alur Kerja Sama',
                        'items' => $steps,
                    ]],
                    ['type' => 'faq', 'data' => [
                        'title' => 'Pertanyaan Seputar Layanan',
                        'items' => [
                            ['question' => 'Berapa lama proses pengerjaan?', 'answer' => 'Tergantung skala pekerjaan. Jadwal pasti kami sampaikan di penawaran setelah konsultasi.'],
                            ['question' => 'Apakah ada garansi?', 'answer' => 'Ya. Setiap pekerjaan bergaransi sesuai yang tertulis di kontrak, plus dukungan purna jual.'],
                            ['question' => 'Apakah melayani di luar kota?', 'answer' => 'Kami melayani klien di berbagai kota di Indonesia. Hubungi kami untuk memastikan jangkauan layanan.'],
                            ['question' => 'Bagaimana sistem pembayarannya?', 'answer' => 'Pembayaran bertahap sesuai progres pekerjaan, dengan termin yang disepakati di awal.'],
                        ],
                    ]],
                    ['type' => 'cta', 'data' => $cta],
                ],
            ],
            [
                'title' => 'Proyek',
                'slug' => 'proyek',
                'sections' => [
                    ['type' => 'page_header', 'data' => [
                        'title' => 'Proyek Kami',
                        'subtitle' => 'Sebagian hasil kerja yang kami banggakan bersama para klien.',
                        'image' => 'demo/building.jpg',
                    ]],
                    ['type' => 'gallery', 'data' => [
                        'title' => 'Galeri Proyek',
                        'items' => [
                            ['image' => 'demo/building.jpg', 'caption' => 'Gedung perkantoran, Jakarta Selatan'],
                            ['image' => 'demo/lobby.jpg', 'caption' => 'Desain interior lobi, Surabaya'],
                            ['image' => 'demo/engineers.jpg', 'caption' => 'Pengawasan proyek, Bekasi'],
                            ['image' => 'demo/office.jpg', 'caption' => 'Penataan kantor, Bandung'],
                            ['image' => 'demo/brainstorm.jpg', 'caption' => 'Workshop perencanaan klien'],
                            ['image' => 'demo/handshake.jpg', 'caption' => 'Penandatanganan kontrak kerja sama'],
                        ],
                    ]],
                    ['type' => 'testimonials', 'data' => [
                        'title' => 'Kata Mereka',
                        'items' => $testimonials,
                    ]],
                    ['type' => 'cta', 'data' => $cta],
                ],
            ],
            [
                'title' => 'Kontak',
                'slug' => 'kontak',
                'sections' => [
                    ['type' => 'page_header', 'data' => [
                        'title' => 'Hubungi Kami',
                        'subtitle' => 'Kami siap membantu. Kirim pesan dan tim kami akan segera membalas.',
                        'image' => 'demo/support.jpg',
                    ]],
                    ['type' => 'contact', 'data' => [
                        'title' => 'Mari berdiskusi',
                        'text' => 'Ada pertanyaan atau ingin meminta penawaran? Isi form di samping atau hubungi kami langsung.',
                        'show_form' => 'yes',
                    ]],
                ],
            ],
        ];
    }
}
