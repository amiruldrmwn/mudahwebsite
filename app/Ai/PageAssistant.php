<?php

namespace App\Ai;

use App\Http\Controllers\Admin\PageController;
use App\Models\Page;
use App\Sections\SectionTypes;
use App\Support\Site;

/**
 * Edits a page's sections from the owner's request. The AI gets the section types, the site's
 * details and the page as it is in the editor, and answers with the whole new list of sections,
 * which is cleaned like anything typed by hand. Nothing is saved here: the editor shows the
 * proposal and the owner applies it.
 */
class PageAssistant
{
    public function __construct(private AiClient $ai, private Site $site) {}

    /**
     * @param  array<mixed>  $sections  The page's sections as they are in the editor
     * @param  list<array{role: string, content: string}>  $history  Earlier turns in this chat
     * @return array{message: string, sections: list<array{id: string, type: string, data: array<string, mixed>}>}
     */
    public function edit(string $title, array $sections, string $request, array $history = []): array
    {
        $current = PageController::cleanSections($sections);

        $reply = $this->ai->chat([
            ['role' => 'system', 'content' => $this->instructions()],
            ['role' => 'user', 'content' => "Halaman: {$title}\n\nSection saat ini (JSON):\n".json_encode($current, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)],
            ...array_slice($history, -6),
            ['role' => 'user', 'content' => $request],
        ]);

        $json = $this->decode($reply);
        $proposed = PageController::cleanSections(is_array($json['sections'] ?? null) ? $json['sections'] : []);

        if ($proposed === []) {
            throw new AiException('AI belum memberi usulan yang bisa dipakai. Coba jelaskan permintaan Anda dengan cara lain.');
        }

        return [
            'message' => is_string($json['message'] ?? null) && $json['message'] !== '' ? $json['message'] : 'Berikut usulan perubahannya.',
            'sections' => $this->keepImages($current, $proposed),
        ];
    }

    /**
     * A new page written from the owner's request. Photos can only be ones already used on the
     * site's pages.
     *
     * @param  list<string>  $photos  Image paths already on the site
     * @return array{title: string, sections: list<array{id: string, type: string, data: array<string, mixed>}>}
     */
    public function newPage(string $request, array $photos): array
    {
        $reply = $this->ai->chat([
            ['role' => 'system', 'content' => $this->instructions()."\n\n".<<<PROMPT
            Sekarang Anda membuat HALAMAN BARU. Jawab dengan JSON: {"title": "...", "message": "...", "sections": [...]}.
            - "title": judul halaman singkat (maks 40 karakter), untuk menu website.
            - Mulai dengan section "page_header", lalu 3-6 section yang paling cocok, dan akhiri dengan "cta" bila sesuai.
            - Field "image" dan foto item boleh diisi HANYA dengan salah satu foto berikut, atau "": {$this->json($photos)}
            PROMPT],
            ['role' => 'user', 'content' => $request],
        ]);

        $json = $this->decode($reply);
        $sections = $this->onlyPhotos(PageController::cleanSections(is_array($json['sections'] ?? null) ? $json['sections'] : []), $photos);
        $title = is_string($json['title'] ?? null) ? trim(mb_substr($json['title'], 0, 100)) : '';

        if ($sections === [] || $title === '') {
            throw new AiException('AI belum bisa membuat halamannya. Coba jelaskan isi halaman yang Anda inginkan dengan lebih rinci.');
        }

        return ['title' => $title, 'sections' => $sections];
    }

    /**
     * Tagline, search description and footer text written from a short story about the business.
     *
     * @return array{tagline: string, description: string, footer_text: string}
     */
    public function siteCopy(string $story): array
    {
        $json = $this->decode($this->ai->chat([
            ['role' => 'system', 'content' => $this->copyInstructions()],
            ['role' => 'user', 'content' => $story],
        ], 800));

        return $this->copyFrom($json);
    }

    /**
     * The template that suits the business best, with tagline, description and footer text.
     *
     * @param  array<string, string>  $templates  key => label and description
     * @return array{theme: string, tagline: string, description: string, footer_text: string}
     */
    public function setup(string $story, array $templates): array
    {
        $json = $this->decode($this->ai->chat([
            ['role' => 'system', 'content' => $this->copyInstructions()."\n\n".<<<PROMPT
            Pilih juga SATU template yang paling cocok untuk usaha ini dari daftar berikut (kunci => keterangan):
            {$this->json($templates)}
            Tambahkan "theme": kunci template yang dipilih, ke objek JSON jawaban Anda.
            PROMPT],
            ['role' => 'user', 'content' => $story],
        ], 800));

        $theme = is_string($json['theme'] ?? null) && array_key_exists($json['theme'], $templates) ? $json['theme'] : 'korporat';

        return ['theme' => $theme, ...$this->copyFrom($json)];
    }

    private function copyInstructions(): string
    {
        return <<<'PROMPT'
        Anda adalah penulis website untuk usaha kecil dan menengah di Indonesia.
        Dari cerita pemilik tentang usahanya, tulis teks identitas website dalam bahasa Indonesia yang jelas dan meyakinkan.
        Jawab HANYA dengan satu objek JSON:
        {"tagline": "maks 80 karakter, singkat dan mudah diingat",
         "description": "maks 160 karakter, untuk hasil pencarian Google, sebut jenis usaha dan kotanya bila ada",
         "footer_text": "maks 200 karakter, 1-2 kalimat tentang usaha"}
        Jangan mengarang angka, penghargaan, atau nama klien yang tidak disebutkan pemilik.
        PROMPT;
    }

    /**
     * @param  array<string, mixed>  $json
     * @return array{tagline: string, description: string, footer_text: string}
     */
    private function copyFrom(array $json): array
    {
        $text = fn (string $key, int $max) => is_string($json[$key] ?? null) ? trim(mb_substr(strip_tags($json[$key]), 0, $max)) : '';

        $copy = ['tagline' => $text('tagline', 150), 'description' => $text('description', 300), 'footer_text' => $text('footer_text', 500)];

        if (implode('', $copy) === '') {
            throw new AiException('AI belum memberi teks yang bisa dipakai. Ceritakan usaha Anda sedikit lebih lengkap.');
        }

        return $copy;
    }

    /**
     * Drops any image that isn't one of the given photos.
     *
     * @param  list<array{id: string, type: string, data: array<string, mixed>}>  $sections
     * @param  list<string>  $photos
     * @return list<array{id: string, type: string, data: array<string, mixed>}>
     */
    private function onlyPhotos(array $sections, array $photos): array
    {
        return array_map(function (array $section) use ($photos) {
            foreach (SectionTypes::all()[$section['type']]['fields'] as $key => $field) {
                if ($field['type'] === 'image' && ! in_array($section['data'][$key] ?? '', $photos, true)) {
                    $section['data'][$key] = '';
                }

                if ($field['type'] === 'items') {
                    foreach ($section['data'][$key] as $i => $item) {
                        foreach ($field['fields'] as $subKey => $sub) {
                            if ($sub['type'] === 'image' && ! in_array($item[$subKey] ?? '', $photos, true)) {
                                $section['data'][$key][$i][$subKey] = '';
                            }
                        }
                    }
                }
            }

            return $section;
        }, $sections);
    }

    /**
     * Every image path used on the site's current pages.
     *
     * @param  iterable<Page>  $pages
     * @return list<string>
     */
    public function photosOn(iterable $pages): array
    {
        $photos = [];

        foreach ($pages as $page) {
            foreach ($page->sections as $section) {
                $photos = [...$photos, ...$this->images($section['data'])];
            }
        }

        return array_values(array_unique($photos));
    }

    private function instructions(): string
    {
        $types = collect(SectionTypes::all())->map(fn (array $t, string $key) => [
            'type' => $key,
            'purpose' => $t['description'],
            'fields' => collect($t['fields'])->map(fn (array $f) => array_filter([
                'type' => $f['type'],
                'label' => $f['label'],
                'max' => $f['max'] ?? null,
                'options' => isset($f['options']) ? array_keys($f['options']) : null,
                'max_items' => $f['max_items'] ?? null,
                'fields' => is_array($f['fields'] ?? null) ? array_map(fn (array $s) => array_filter(['type' => $s['type'], 'max' => $s['max'] ?? null]), $f['fields']) : null,
            ]))->all(),
        ])->values();

        $site = collect([
            'nama_perusahaan' => $this->site->get('site_name'),
            'tagline' => $this->site->get('tagline'),
            'deskripsi' => $this->site->get('description'),
            'alamat' => $this->site->get('address'),
            'telepon' => $this->site->get('contact_phone'),
            'email' => $this->site->get('contact_email'),
        ])->filter()->all();

        return <<<PROMPT
        Anda adalah asisten penulis website company profile untuk pemilik usaha di Indonesia.
        Tugas Anda: mengubah section halaman sesuai permintaan pemilik website.

        Data perusahaan: {$this->json($site)}

        Jenis section yang tersedia beserta field-nya: {$this->json($types)}

        Aturan:
        - Jawab HANYA dengan satu objek JSON: {"message": "...", "sections": [...]}.
        - "message": 1-3 kalimat bahasa Indonesia untuk pemilik, jelaskan apa yang Anda ubah.
        - "sections": daftar LENGKAP section halaman setelah diubah, masing-masing {"id": "...", "type": "...", "data": {...}}.
          Pertahankan "id" section yang sudah ada; untuk section baru buat id acak 10 huruf.
        - Ubah hanya yang diminta. Section dan field lain biarkan persis seperti semula.
        - Pakai hanya jenis section dan field yang tersedia; patuhi batas "max" karakter dan "max_items".
        - Field "image": jangan mengarang. Pertahankan nilai yang ada, atau isi "" untuk section baru.
        - Field "url": pakai link halaman situs seperti "/kontak", atau link lengkap https://.
        - Field "markdown": paragraf dipisah baris kosong; boleh **tebal** dan daftar "- ". Tanpa HTML.
        - Tulis dalam bahasa Indonesia yang profesional, jelas, dan meyakinkan, kecuali diminta bahasa lain.
        - Jangan mengarang angka, sertifikat, atau nama klien yang spesifik kecuali diberikan pemilik;
          jika perlu contoh, buat yang wajar dan sebutkan di "message" agar pemilik memeriksanya.
        PROMPT;
    }

    private function json(mixed $value): string
    {
        return (string) json_encode($value, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    /**
     * The JSON object in the reply, also when the model wraps it in a code block or prose.
     *
     * @return array<string, mixed>
     */
    private function decode(string $reply): array
    {
        $json = json_decode($reply, true);

        if (! is_array($json)) {
            $start = strpos($reply, '{');
            $end = strrpos($reply, '}');
            $json = $start !== false && $end > $start ? json_decode(substr($reply, $start, $end - $start + 1), true) : null;
        }

        if (! is_array($json)) {
            throw new AiException('Jawaban AI tidak bisa dibaca. Coba ulangi permintaan Anda.');
        }

        return $json;
    }

    /**
     * Images are only ever ones the owner uploaded: a section the AI kept gets its images back
     * where the AI changed or dropped them.
     *
     * @param  list<array{id: string, type: string, data: array<string, mixed>}>  $current
     * @param  list<array{id: string, type: string, data: array<string, mixed>}>  $proposed
     * @return list<array{id: string, type: string, data: array<string, mixed>}>
     */
    private function keepImages(array $current, array $proposed): array
    {
        $before = collect($current)->keyBy('id');
        $uploaded = collect($current)->flatMap(fn (array $s) => $this->images($s['data']))->unique()->all();

        return array_map(function (array $section) use ($before, $uploaded) {
            $old = $before->get($section['id']);
            $fields = SectionTypes::all()[$section['type']]['fields'];

            foreach ($fields as $key => $field) {
                if ($field['type'] === 'image') {
                    $value = $section['data'][$key] ?? '';
                    $section['data'][$key] = in_array($value, $uploaded, true) ? $value : (($old['type'] ?? null) === $section['type'] ? ($old['data'][$key] ?? '') : '');
                }

                if ($field['type'] === 'items') {
                    foreach ($section['data'][$key] as $i => $item) {
                        foreach ($field['fields'] as $subKey => $sub) {
                            if ($sub['type'] === 'image') {
                                $value = $item[$subKey] ?? '';
                                $section['data'][$key][$i][$subKey] = in_array($value, $uploaded, true) ? $value : '';
                            }
                        }
                    }
                }
            }

            return $section;
        }, $proposed);
    }

    /**
     * Every image path in a section's data.
     *
     * @param  array<string, mixed>  $data
     * @return list<string>
     */
    private function images(array $data): array
    {
        $paths = [];

        array_walk_recursive($data, function ($value) use (&$paths) {
            if (is_string($value) && preg_match('#^(media|site|demo)/[A-Za-z0-9._-]+$#', $value)) {
                $paths[] = $value;
            }
        });

        return $paths;
    }
}
