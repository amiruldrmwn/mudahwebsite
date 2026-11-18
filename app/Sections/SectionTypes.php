<?php

namespace App\Sections;

use Illuminate\Support\Str;

/**
 * The blocks a page is built from. Each type lists its fields; the admin editor builds its form
 * from them, the AI assistant fills them, and every template renders them in its own style.
 *
 * Field types: text, textarea, markdown, image, url, select (with options), items (a repeater
 * with its own fields).
 */
class SectionTypes
{
    /**
     * @return array<string, array{label: string, description: string, fields: array<string, array<string, mixed>>}>
     */
    public static function all(): array
    {
        return [
            'hero' => [
                'label' => 'Hero (pembuka)',
                'description' => 'Judul besar di bagian atas halaman dengan tombol ajakan.',
                'fields' => [
                    'eyebrow' => ['type' => 'text', 'label' => 'Teks kecil di atas judul', 'max' => 80],
                    'title' => ['type' => 'text', 'label' => 'Judul', 'max' => 150, 'required' => true],
                    'subtitle' => ['type' => 'textarea', 'label' => 'Subjudul', 'max' => 400],
                    'button_label' => ['type' => 'text', 'label' => 'Teks tombol', 'max' => 40],
                    'button_url' => ['type' => 'url', 'label' => 'Link tombol', 'max' => 255],
                    'button2_label' => ['type' => 'text', 'label' => 'Teks tombol kedua', 'max' => 40],
                    'button2_url' => ['type' => 'url', 'label' => 'Link tombol kedua', 'max' => 255],
                    'image' => ['type' => 'image', 'label' => 'Gambar'],
                ],
            ],
            'page_header' => [
                'label' => 'Header Halaman',
                'description' => 'Banner judul di atas halaman dalam, dengan foto latar.',
                'fields' => [
                    'title' => ['type' => 'text', 'label' => 'Judul', 'max' => 150, 'required' => true],
                    'subtitle' => ['type' => 'textarea', 'label' => 'Subjudul', 'max' => 300],
                    'image' => ['type' => 'image', 'label' => 'Foto latar'],
                ],
            ],
            'text' => [
                'label' => 'Teks',
                'description' => 'Judul dan paragraf bebas.',
                'fields' => [
                    'title' => ['type' => 'text', 'label' => 'Judul', 'max' => 150],
                    'body' => ['type' => 'markdown', 'label' => 'Isi', 'max' => 10000],
                ],
            ],
            'image_text' => [
                'label' => 'Gambar + Teks',
                'description' => 'Gambar di samping teks, cocok untuk profil perusahaan.',
                'fields' => [
                    'title' => ['type' => 'text', 'label' => 'Judul', 'max' => 150],
                    'body' => ['type' => 'markdown', 'label' => 'Isi', 'max' => 5000],
                    'image' => ['type' => 'image', 'label' => 'Gambar'],
                    'image_position' => ['type' => 'select', 'label' => 'Posisi gambar', 'options' => ['left' => 'Kiri', 'right' => 'Kanan'], 'default' => 'right'],
                    'button_label' => ['type' => 'text', 'label' => 'Teks tombol', 'max' => 40],
                    'button_url' => ['type' => 'url', 'label' => 'Link tombol', 'max' => 255],
                ],
            ],
            'services' => [
                'label' => 'Layanan / Keunggulan',
                'description' => 'Daftar layanan atau keunggulan dalam bentuk kartu.',
                'fields' => [
                    'title' => ['type' => 'text', 'label' => 'Judul', 'max' => 150],
                    'subtitle' => ['type' => 'textarea', 'label' => 'Subjudul', 'max' => 400],
                    'items' => ['type' => 'items', 'label' => 'Layanan', 'max_items' => 12, 'fields' => [
                        'title' => ['type' => 'text', 'label' => 'Nama', 'max' => 100, 'required' => true],
                        'text' => ['type' => 'textarea', 'label' => 'Keterangan', 'max' => 400],
                        'image' => ['type' => 'image', 'label' => 'Gambar (opsional)'],
                    ]],
                ],
            ],
            'links' => [
                'label' => 'Daftar Link (Bio Link)',
                'description' => 'Tombol link bertumpuk ala link in bio: toko, kelas, katalog, sosial media, atau formulir.',
                'fields' => [
                    'title' => ['type' => 'text', 'label' => 'Judul', 'max' => 150],
                    'items' => ['type' => 'items', 'label' => 'Link', 'max_items' => 20, 'fields' => [
                        'title' => ['type' => 'text', 'label' => 'Judul link', 'max' => 80, 'required' => true],
                        'text' => ['type' => 'text', 'label' => 'Keterangan singkat', 'max' => 140],
                        'url' => ['type' => 'url', 'label' => 'Alamat link (https://..., /halaman, mailto:, tel:)', 'max' => 255],
                        'badge' => ['type' => 'text', 'label' => 'Label (mis. Baru, Gratis)', 'max' => 20],
                        'image' => ['type' => 'image', 'label' => 'Ikon / gambar kecil (opsional)'],
                    ]],
                ],
            ],
            'pricelist' => [
                'label' => 'Daftar Harga / Menu',
                'description' => 'Produk, menu, atau perawatan beserta harganya. Dengan foto tampil sebagai kartu produk, tanpa foto sebagai daftar harga.',
                'fields' => [
                    'title' => ['type' => 'text', 'label' => 'Judul', 'max' => 150],
                    'subtitle' => ['type' => 'textarea', 'label' => 'Subjudul', 'max' => 400],
                    'items' => ['type' => 'items', 'label' => 'Produk / layanan', 'max_items' => 24, 'fields' => [
                        'name' => ['type' => 'text', 'label' => 'Nama', 'max' => 100, 'required' => true],
                        'description' => ['type' => 'textarea', 'label' => 'Keterangan', 'max' => 300],
                        'info' => ['type' => 'text', 'label' => 'Info singkat (mis. 60 menit, ukuran 20 cm)', 'max' => 40],
                        'price' => ['type' => 'text', 'label' => 'Harga (mis. Rp250.000)', 'max' => 40],
                        'image' => ['type' => 'image', 'label' => 'Foto (opsional)'],
                    ]],
                    'note' => ['type' => 'text', 'label' => 'Catatan kecil di bawah', 'max' => 200],
                    'order_button' => ['type' => 'select', 'label' => 'Tombol pesan via WhatsApp', 'options' => ['yes' => 'Tampilkan', 'no' => 'Sembunyikan'], 'default' => 'yes'],
                ],
            ],
            'packages' => [
                'label' => 'Paket Perjalanan',
                'description' => 'Kartu paket umroh, haji, atau tur: tanggal berangkat, durasi, maskapai, hotel, dan harga, dengan tombol tanya via WhatsApp.',
                'fields' => [
                    'title' => ['type' => 'text', 'label' => 'Judul', 'max' => 150],
                    'subtitle' => ['type' => 'textarea', 'label' => 'Subjudul', 'max' => 400],
                    'items' => ['type' => 'items', 'label' => 'Paket', 'max_items' => 24, 'fields' => [
                        'image' => ['type' => 'image', 'label' => 'Foto / brosur'],
                        'name' => ['type' => 'text', 'label' => 'Nama paket', 'max' => 100, 'required' => true],
                        'date' => ['type' => 'text', 'label' => 'Tanggal berangkat (mis. 19 Nov)', 'max' => 30],
                        'duration' => ['type' => 'text', 'label' => 'Durasi (mis. 9 Hari)', 'max' => 30],
                        'airline' => ['type' => 'text', 'label' => 'Maskapai', 'max' => 60],
                        'rating' => ['type' => 'text', 'label' => 'Kelas hotel (mis. Bintang 5)', 'max' => 30],
                        'hotels' => ['type' => 'textarea', 'label' => 'Hotel (satu per baris)', 'max' => 300],
                        'price' => ['type' => 'text', 'label' => 'Harga mulai (mis. Rp39.250.000)', 'max' => 40],
                        'url' => ['type' => 'url', 'label' => 'Link detail (opsional, kosongkan untuk WhatsApp)', 'max' => 255],
                    ]],
                    'button_label' => ['type' => 'text', 'label' => 'Tombol di bawah (mis. Lihat Semua Paket)', 'max' => 40],
                    'button_url' => ['type' => 'url', 'label' => 'Link tombol di bawah', 'max' => 255],
                ],
            ],
            'plans' => [
                'label' => 'Paket Harga',
                'description' => 'Pilihan paket bertingkat: harga, harga coret, label (mis. Paling Populer), dan daftar yang didapat, dengan tombol pilih via WhatsApp.',
                'fields' => [
                    'title' => ['type' => 'text', 'label' => 'Judul', 'max' => 150],
                    'subtitle' => ['type' => 'textarea', 'label' => 'Subjudul', 'max' => 400],
                    'items' => ['type' => 'items', 'label' => 'Paket', 'max_items' => 4, 'fields' => [
                        'name' => ['type' => 'text', 'label' => 'Nama paket', 'max' => 60, 'required' => true],
                        'badge' => ['type' => 'text', 'label' => 'Label (mis. Paling Populer)', 'max' => 30],
                        'price' => ['type' => 'text', 'label' => 'Harga (mis. Rp1,95jt)', 'max' => 40],
                        'old_price' => ['type' => 'text', 'label' => 'Harga coret (opsional)', 'max' => 40],
                        'info' => ['type' => 'text', 'label' => 'Info singkat (mis. ±2 hari kerja)', 'max' => 60],
                        'features' => ['type' => 'textarea', 'label' => 'Yang didapat (satu per baris)', 'max' => 1500],
                        'highlight' => ['type' => 'select', 'label' => 'Tonjolkan paket ini', 'options' => ['no' => 'Tidak', 'yes' => 'Ya'], 'default' => 'no'],
                    ]],
                    'note' => ['type' => 'text', 'label' => 'Catatan kecil di bawah', 'max' => 200],
                ],
            ],
            'catalog' => [
                'label' => 'Katalog (Unit / Kamar / Tipe)',
                'description' => 'Kartu unit yang disewakan atau dijual: mobil, motor, tipe rumah, atau kamar villa, dengan spesifikasi, harga, dan tombol tanya via WhatsApp.',
                'fields' => [
                    'title' => ['type' => 'text', 'label' => 'Judul', 'max' => 150],
                    'subtitle' => ['type' => 'textarea', 'label' => 'Subjudul', 'max' => 400],
                    'items' => ['type' => 'items', 'label' => 'Unit', 'max_items' => 24, 'fields' => [
                        'image' => ['type' => 'image', 'label' => 'Foto'],
                        'name' => ['type' => 'text', 'label' => 'Nama (mis. Toyota Avanza, Tipe 45)', 'max' => 100, 'required' => true],
                        'category' => ['type' => 'text', 'label' => 'Kategori (mis. MPV, Matic, Cluster A)', 'max' => 40],
                        'badge' => ['type' => 'text', 'label' => 'Label (mis. Terlaris, Sisa 3 unit)', 'max' => 30],
                        'specs' => ['type' => 'textarea', 'label' => 'Spesifikasi (satu per baris)', 'max' => 400],
                        'price' => ['type' => 'text', 'label' => 'Harga (mis. Rp350.000)', 'max' => 40],
                        'unit' => ['type' => 'text', 'label' => 'Satuan harga (mis. /hari, /malam)', 'max' => 20],
                        'url' => ['type' => 'url', 'label' => 'Link detail (opsional, kosongkan untuk WhatsApp)', 'max' => 255],
                    ]],
                    'button_label' => ['type' => 'text', 'label' => 'Teks tombol di kartu', 'max' => 30, 'default' => ''],
                ],
            ],
            'mortgage' => [
                'label' => 'Kalkulator Cicilan (KPR)',
                'description' => 'Simulasi cicilan bulanan: pengunjung mengisi harga, uang muka, bunga, dan tenor.',
                'fields' => [
                    'title' => ['type' => 'text', 'label' => 'Judul', 'max' => 150],
                    'subtitle' => ['type' => 'textarea', 'label' => 'Subjudul', 'max' => 400],
                    'price' => ['type' => 'text', 'label' => 'Harga awal (angka, mis. 850000000)', 'max' => 15],
                    'down_payment' => ['type' => 'text', 'label' => 'Uang muka awal (%)', 'max' => 3],
                    'rate' => ['type' => 'text', 'label' => 'Bunga per tahun (%)', 'max' => 5],
                    'years' => ['type' => 'text', 'label' => 'Tenor awal (tahun)', 'max' => 2],
                    'note' => ['type' => 'text', 'label' => 'Catatan', 'max' => 200],
                ],
            ],
            'posts' => [
                'label' => 'Berita / Kabar Terbaru',
                'description' => 'Kartu berita, kegiatan, pengumuman, atau prestasi dengan foto, kategori, dan tanggal.',
                'fields' => [
                    'title' => ['type' => 'text', 'label' => 'Judul', 'max' => 150],
                    'subtitle' => ['type' => 'textarea', 'label' => 'Subjudul', 'max' => 400],
                    'items' => ['type' => 'items', 'label' => 'Berita', 'max_items' => 24, 'fields' => [
                        'image' => ['type' => 'image', 'label' => 'Foto'],
                        'category' => ['type' => 'text', 'label' => 'Kategori (mis. Prestasi)', 'max' => 30],
                        'date' => ['type' => 'text', 'label' => 'Tanggal (mis. 18 Okt 2026)', 'max' => 30],
                        'title' => ['type' => 'text', 'label' => 'Judul berita', 'max' => 150, 'required' => true],
                        'text' => ['type' => 'textarea', 'label' => 'Ringkasan', 'max' => 400],
                        'url' => ['type' => 'url', 'label' => 'Link baca selengkapnya (opsional)', 'max' => 255],
                    ]],
                ],
            ],
            'stats' => [
                'label' => 'Angka Pencapaian',
                'description' => 'Angka penting, misalnya jumlah klien atau tahun berdiri.',
                'fields' => [
                    'title' => ['type' => 'text', 'label' => 'Judul', 'max' => 150],
                    'items' => ['type' => 'items', 'label' => 'Angka', 'max_items' => 6, 'fields' => [
                        'value' => ['type' => 'text', 'label' => 'Angka', 'max' => 20, 'required' => true],
                        'label' => ['type' => 'text', 'label' => 'Keterangan', 'max' => 60, 'required' => true],
                    ]],
                ],
            ],
            'steps' => [
                'label' => 'Alur Kerja',
                'description' => 'Langkah-langkah bekerja sama, ditampilkan bernomor.',
                'fields' => [
                    'title' => ['type' => 'text', 'label' => 'Judul', 'max' => 150],
                    'subtitle' => ['type' => 'textarea', 'label' => 'Subjudul', 'max' => 400],
                    'items' => ['type' => 'items', 'label' => 'Langkah', 'max_items' => 6, 'fields' => [
                        'title' => ['type' => 'text', 'label' => 'Nama langkah', 'max' => 80, 'required' => true],
                        'text' => ['type' => 'textarea', 'label' => 'Keterangan', 'max' => 300],
                    ]],
                ],
            ],
            'team' => [
                'label' => 'Tim',
                'description' => 'Foto, nama, dan jabatan orang-orang penting di perusahaan.',
                'fields' => [
                    'title' => ['type' => 'text', 'label' => 'Judul', 'max' => 150],
                    'subtitle' => ['type' => 'textarea', 'label' => 'Subjudul', 'max' => 400],
                    'items' => ['type' => 'items', 'label' => 'Anggota', 'max_items' => 12, 'fields' => [
                        'photo' => ['type' => 'image', 'label' => 'Foto'],
                        'name' => ['type' => 'text', 'label' => 'Nama', 'max' => 80, 'required' => true],
                        'role' => ['type' => 'text', 'label' => 'Jabatan', 'max' => 80],
                    ]],
                ],
            ],
            'clients' => [
                'label' => 'Klien / Mitra',
                'description' => 'Deretan logo atau nama klien dan mitra perusahaan.',
                'fields' => [
                    'title' => ['type' => 'text', 'label' => 'Judul', 'max' => 150],
                    'items' => ['type' => 'items', 'label' => 'Klien', 'max_items' => 18, 'fields' => [
                        'name' => ['type' => 'text', 'label' => 'Nama', 'max' => 60, 'required' => true],
                        'logo' => ['type' => 'image', 'label' => 'Logo (opsional)'],
                    ]],
                ],
            ],
            'gallery' => [
                'label' => 'Galeri',
                'description' => 'Kumpulan foto proyek, kantor, atau produk.',
                'fields' => [
                    'title' => ['type' => 'text', 'label' => 'Judul', 'max' => 150],
                    'items' => ['type' => 'items', 'label' => 'Foto', 'max_items' => 24, 'fields' => [
                        'image' => ['type' => 'image', 'label' => 'Foto', 'required' => true],
                        'caption' => ['type' => 'text', 'label' => 'Keterangan', 'max' => 120],
                    ]],
                ],
            ],
            'testimonials' => [
                'label' => 'Testimoni',
                'description' => 'Kata klien tentang perusahaan Anda.',
                'fields' => [
                    'title' => ['type' => 'text', 'label' => 'Judul', 'max' => 150],
                    'items' => ['type' => 'items', 'label' => 'Testimoni', 'max_items' => 12, 'fields' => [
                        'quote' => ['type' => 'textarea', 'label' => 'Kutipan', 'max' => 600, 'required' => true],
                        'name' => ['type' => 'text', 'label' => 'Nama', 'max' => 80, 'required' => true],
                        'role' => ['type' => 'text', 'label' => 'Jabatan / perusahaan', 'max' => 100],
                    ]],
                ],
            ],
            'faq' => [
                'label' => 'Tanya Jawab (FAQ)',
                'description' => 'Pertanyaan yang sering diajukan beserta jawabannya.',
                'fields' => [
                    'title' => ['type' => 'text', 'label' => 'Judul', 'max' => 150],
                    'items' => ['type' => 'items', 'label' => 'Pertanyaan', 'max_items' => 20, 'fields' => [
                        'question' => ['type' => 'text', 'label' => 'Pertanyaan', 'max' => 200, 'required' => true],
                        'answer' => ['type' => 'textarea', 'label' => 'Jawaban', 'max' => 1500, 'required' => true],
                    ]],
                ],
            ],
            'cta' => [
                'label' => 'Ajakan (CTA)',
                'description' => 'Kotak ajakan untuk menghubungi atau memakai layanan Anda.',
                'fields' => [
                    'title' => ['type' => 'text', 'label' => 'Judul', 'max' => 150, 'required' => true],
                    'text' => ['type' => 'textarea', 'label' => 'Teks', 'max' => 400],
                    'button_label' => ['type' => 'text', 'label' => 'Teks tombol', 'max' => 40],
                    'button_url' => ['type' => 'url', 'label' => 'Link tombol', 'max' => 255],
                ],
            ],
            'contact' => [
                'label' => 'Kontak',
                'description' => 'Info kontak dari Pengaturan Situs, form pesan, dan peta.',
                'fields' => [
                    'title' => ['type' => 'text', 'label' => 'Judul', 'max' => 150],
                    'text' => ['type' => 'textarea', 'label' => 'Teks', 'max' => 400],
                    'show_form' => ['type' => 'select', 'label' => 'Form pesan', 'options' => ['yes' => 'Tampilkan', 'no' => 'Sembunyikan'], 'default' => 'yes'],
                ],
            ],
        ];
    }

    public static function has(string $type): bool
    {
        return array_key_exists($type, self::all());
    }

    /**
     * A section's data cleaned to its type's fields: unknown keys dropped, values trimmed and cut
     * to their length, select values kept to their options, items to their count. Returns null
     * for an unknown type.
     *
     * @param  array<string, mixed>  $section  {type, data}
     * @return array{id: string, type: string, data: array<string, mixed>}|null
     */
    public static function clean(array $section): ?array
    {
        $type = (string) ($section['type'] ?? '');

        if (! self::has($type)) {
            return null;
        }

        return [
            'id' => is_string($section['id'] ?? null) && $section['id'] !== '' ? Str::limit($section['id'], 40, '') : Str::random(10),
            'type' => $type,
            'data' => self::cleanFields(self::all()[$type]['fields'], is_array($section['data'] ?? null) ? $section['data'] : []),
        ];
    }

    /**
     * @param  array<string, array<string, mixed>>  $fields
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    private static function cleanFields(array $fields, array $data): array
    {
        $out = [];

        foreach ($fields as $key => $field) {
            $value = $data[$key] ?? null;

            $out[$key] = match ($field['type']) {
                'items' => collect(is_array($value) ? array_values($value) : [])
                    ->filter(fn ($item) => is_array($item))
                    ->take((int) ($field['max_items'] ?? 20))
                    ->map(fn (array $item) => self::cleanFields($field['fields'], $item))
                    ->values()
                    ->all(),
                'select' => is_string($value) && array_key_exists($value, $field['options']) ? $value : ($field['default'] ?? array_key_first($field['options'])),
                'url' => self::cleanUrl($value, (int) ($field['max'] ?? 255)),
                'image' => is_string($value) && preg_match('#^[A-Za-z0-9/_.-]+$#', $value) && ! str_contains($value, '..') ? $value : '',
                default => Str::limit(trim(is_scalar($value) ? (string) $value : ''), (int) ($field['max'] ?? 1000), ''),
            };
        }

        return $out;
    }

    /**
     * Links may be full http(s) addresses, site paths (/kontak), anchors (#layanan), mailto: or
     * tel:. Anything else (javascript: and the like) is dropped.
     */
    private static function cleanUrl(mixed $value, int $max): string
    {
        $url = trim(is_string($value) ? $value : '');

        if ($url === '' || strlen($url) > $max) {
            return '';
        }

        return preg_match('#^(https?://|/|\#|mailto:|tel:)#i', $url) ? $url : '';
    }

    /**
     * An empty section of a type, with select defaults filled in.
     *
     * @return array{id: string, type: string, data: array<string, mixed>}
     */
    public static function blank(string $type): array
    {
        return self::clean(['type' => $type, 'data' => []]) ?? throw new \InvalidArgumentException("Unknown section type {$type}");
    }
}
