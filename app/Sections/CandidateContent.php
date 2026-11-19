<?php

namespace App\Sections;

/**
 * Sample pages for the Caleg & Profil Tokoh template: a candidate or public figure's profile,
 * vision and programmes, agenda, volunteer sign-up and aspirations. The sample person is
 * fictional and names no party.
 */
class CandidateContent
{
    /**
     * @return list<array<string, mixed>>
     */
    public static function pages(string $company): array
    {
        $programs = ['type' => 'services', 'data' => ['title' => 'Program kerja', 'subtitle' => 'Lima janji yang akan diperjuangkan untuk warga.', 'items' => [
            ['title' => 'Jalan & air bersih', 'text' => 'Memperjuangkan perbaikan jalan desa dan sambungan air bersih di setiap dusun.', 'image' => ''],
            ['title' => 'Modal UMKM', 'text' => 'Pelatihan dan akses pinjaman lunak untuk pelaku usaha kecil.', 'image' => ''],
            ['title' => 'Beasiswa pelajar', 'text' => 'Beasiswa untuk pelajar berprestasi dari keluarga kurang mampu.', 'image' => ''],
            ['title' => 'Layanan kesehatan', 'text' => 'Posyandu aktif dan ambulans desa siaga 24 jam.', 'image' => ''],
        ]]];

        return [
            ['title' => 'Beranda', 'slug' => 'beranda', 'is_home' => true, 'sections' => [
                ['type' => 'hero', 'data' => [
                    'eyebrow' => 'Calon anggota DPRD · Dapil 3 · Nomor urut 5',
                    'title' => 'Bersama warga, *bekerja nyata*',
                    'subtitle' => 'Mendengar langsung, memperjuangkan sungguh-sungguh. Ini visi, program, dan agenda kami untuk lima tahun ke depan.',
                    'button_label' => 'Lihat Program', 'button_url' => '/program',
                    'button2_label' => 'Jadi Relawan', 'button2_url' => '/relawan',
                    'image' => 'demo/caleg-hero.jpg',
                ]],
                ['type' => 'image_text', 'data' => ['title' => 'Tentang saya', 'body' => "Lahir dan besar di kampung ini. Lulusan teknik sipil, 10 tahun mendampingi kelompok tani dan UMKM, dan aktif di karang taruna sejak muda.\n\n**Visi:** Daerah yang maju, adil, dan sejahtera, dengan pembangunan yang dirasakan semua warga.", 'image' => 'demo/caleg-resmi.jpg', 'image_position' => 'left', 'button_label' => 'Profil Lengkap', 'button_url' => '/profil']],
                $programs,
                ['type' => 'posts', 'data' => ['title' => 'Agenda & kegiatan', 'items' => [
                    ['image' => 'demo/caleg-dialog.jpg', 'category' => 'Dialog warga', 'date' => '15 Nov 2026', 'title' => 'Serap aspirasi petani di Dusun Sukamaju', 'text' => 'Membahas harga pupuk dan irigasi bersama kelompok tani.'],
                    ['image' => 'demo/caleg-bakti.jpg', 'category' => 'Bakti sosial', 'date' => '8 Nov 2026', 'title' => 'Paket sembako untuk lansia', 'text' => 'Bersama relawan membagikan 300 paket ke rumah-rumah.'],
                    ['image' => 'demo/caleg-relawan.jpg', 'category' => 'Relawan', 'date' => '1 Nov 2026', 'title' => 'Konsolidasi relawan kecamatan', 'text' => 'Lebih dari 200 relawan siap bergerak di setiap desa.'],
                ]]],
                ['type' => 'cta', 'data' => ['title' => 'Sampaikan aspirasi Anda', 'text' => 'Setiap masukan kami catat dan bawa ke forum yang tepat.', 'button_label' => 'Kirim Aspirasi', 'button_url' => '/aspirasi']],
            ]],
            ['title' => 'Profil', 'slug' => 'profil', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Profil', 'subtitle' => 'Perjalanan, pengalaman, dan nilai yang dipegang.']],
                ['type' => 'steps', 'data' => ['title' => 'Perjalanan', 'items' => [
                    ['title' => '2008', 'text' => 'Lulus Teknik Sipil, kembali membangun kampung halaman.'],
                    ['title' => '2012', 'text' => 'Mendirikan kelompok usaha tani dan koperasi pemuda.'],
                    ['title' => '2019', 'text' => 'Ketua karang taruna kabupaten.'],
                    ['title' => '2026', 'text' => 'Maju sebagai calon anggota DPRD untuk Dapil 3.'],
                ]]],
            ]],
            ['title' => 'Program', 'slug' => 'program', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Visi & Program', 'subtitle' => 'Program yang disusun dari hasil dialog dengan warga.']],
                $programs,
            ]],
            ['title' => 'Relawan', 'slug' => 'relawan', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Jadi Relawan', 'subtitle' => 'Bergabung dan ikut bergerak di desa Anda.', 'image' => 'demo/caleg-relawan.jpg']],
                ['type' => 'contact', 'data' => ['title' => 'Daftar relawan', 'text' => 'Tulis nama, desa/kelurahan, dan nomor WhatsApp. Koordinator wilayah akan menghubungi Anda.', 'show_form' => 'yes']],
            ]],
            ['title' => 'Aspirasi', 'slug' => 'aspirasi', 'sections' => [
                ['type' => 'page_header', 'data' => ['title' => 'Aspirasi Warga', 'subtitle' => 'Suara Anda menentukan arah perjuangan kami.']],
                ['type' => 'contact', 'data' => ['title' => 'Kirim aspirasi', 'text' => 'Ceritakan masalah atau usulan di lingkungan Anda.', 'show_form' => 'yes']],
            ]],
        ];
    }
}
