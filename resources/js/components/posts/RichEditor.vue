<script setup lang="ts">
import {
    AlignCenter,
    AlignLeft,
    AlignRight,
    Bold,
    ImagePlus,
    Italic,
    Link2,
    List,
    ListOrdered,
    Minus,
    Quote,
    Redo2,
    Strikethrough,
    Table as TableIcon,
    Underline,
    Undo2,
    SquarePlay as YoutubeIcon,
} from '@lucide/vue';
import Image from '@tiptap/extension-image';
import { TableKit } from '@tiptap/extension-table';
import TextAlign from '@tiptap/extension-text-align';
import Youtube from '@tiptap/extension-youtube';
import { CharacterCount, Placeholder } from '@tiptap/extensions';
import StarterKit from '@tiptap/starter-kit';
import { NodeSelection } from '@tiptap/pm/state';
import { EditorContent, useEditor } from '@tiptap/vue-3';
import { computed, onBeforeUnmount, ref, watch } from 'vue';
import MediaPicker from '@/components/sections/MediaPicker.vue';
import { Button } from '@/components/ui/button';
import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
} from '@/components/ui/dialog';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';

/**
 * The blog's rich text editor (Tiptap). Images come from the media library; the server cleans
 * the HTML again on save, so this only offers what the site keeps.
 */
const html = defineModel<string>({ required: true });
const emit = defineEmits<{ words: [count: number] }>();

const editor = useEditor({
    content: html.value,
    extensions: [
        StarterKit.configure({
            heading: { levels: [2, 3, 4] },
            link: {
                openOnClick: false,
                autolink: true,
                defaultProtocol: 'https',
                protocols: ['mailto', 'tel'],
                HTMLAttributes: { rel: 'noopener', target: null },
            },
        }),
        Image.configure({ inline: false }),
        TextAlign.configure({ types: ['heading', 'paragraph'] }),
        TableKit.configure({ table: { resizable: false } }),
        Youtube.configure({ nocookie: true, modestBranding: true, rel: 0 }),
        Placeholder.configure({
            placeholder: 'Mulai menulis di sini…',
        }),
        CharacterCount,
    ],
    editorProps: {
        attributes: {
            class: 'rich-content',
            'aria-label': 'Isi tulisan',
        },
    },
    onUpdate: ({ editor: e }) => {
        html.value = e.isEmpty ? '' : e.getHTML();
        emit('words', e.storage.characterCount.words());
    },
    onCreate: ({ editor: e }) => {
        emit('words', e.storage.characterCount.words());
    },
});

watch(html, (value) => {
    const e = editor.value;

    if (e && value !== (e.isEmpty ? '' : e.getHTML())) {
        e.commands.setContent(value, { emitUpdate: false });
    }
});

onBeforeUnmount(() => editor.value?.destroy());

const block = computed({
    get(): string {
        const e = editor.value;

        for (const level of [2, 3, 4]) {
            if (e?.isActive('heading', { level })) {
                return `h${level}`;
            }
        }

        return 'p';
    },
    set(value: string) {
        const chain = editor.value?.chain().focus();

        if (value === 'p') {
            chain?.setParagraph().run();
        } else {
            chain
                ?.setHeading({ level: Number(value.slice(1)) as 2 | 3 | 4 })
                .run();
        }
    },
});

const inTable = computed(() => editor.value?.isActive('table') ?? false);

type Tool = {
    label: string;
    icon: typeof Bold;
    run: () => void;
    active?: () => boolean;
    disabled?: () => boolean;
};

const chain = () => editor.value!.chain().focus();

const groups = computed<Tool[][]>(() => [
    [
        {
            label: 'Tebal (Ctrl+B)',
            icon: Bold,
            run: () => chain().toggleBold().run(),
            active: () => !!editor.value?.isActive('bold'),
        },
        {
            label: 'Miring (Ctrl+I)',
            icon: Italic,
            run: () => chain().toggleItalic().run(),
            active: () => !!editor.value?.isActive('italic'),
        },
        {
            label: 'Garis bawah (Ctrl+U)',
            icon: Underline,
            run: () => chain().toggleUnderline().run(),
            active: () => !!editor.value?.isActive('underline'),
        },
        {
            label: 'Coret',
            icon: Strikethrough,
            run: () => chain().toggleStrike().run(),
            active: () => !!editor.value?.isActive('strike'),
        },
        {
            label: 'Link (Ctrl+K)',
            icon: Link2,
            run: openLink,
            active: () => !!editor.value?.isActive('link'),
        },
    ],
    [
        {
            label: 'Daftar berpoin',
            icon: List,
            run: () => chain().toggleBulletList().run(),
            active: () => !!editor.value?.isActive('bulletList'),
        },
        {
            label: 'Daftar bernomor',
            icon: ListOrdered,
            run: () => chain().toggleOrderedList().run(),
            active: () => !!editor.value?.isActive('orderedList'),
        },
        {
            label: 'Kutipan',
            icon: Quote,
            run: () => chain().toggleBlockquote().run(),
            active: () => !!editor.value?.isActive('blockquote'),
        },
    ],
    [
        {
            label: 'Rata kiri',
            icon: AlignLeft,
            run: () => chain().setTextAlign('left').run(),
            active: () => !!editor.value?.isActive({ textAlign: 'left' }),
        },
        {
            label: 'Rata tengah',
            icon: AlignCenter,
            run: () => chain().setTextAlign('center').run(),
            active: () => !!editor.value?.isActive({ textAlign: 'center' }),
        },
        {
            label: 'Rata kanan',
            icon: AlignRight,
            run: () => chain().setTextAlign('right').run(),
            active: () => !!editor.value?.isActive({ textAlign: 'right' }),
        },
    ],
    [
        {
            label: 'Gambar dari galeri',
            icon: ImagePlus,
            run: () => (picking.value = true),
        },
        {
            label: 'Video YouTube',
            icon: YoutubeIcon,
            run: openYoutube,
        },
        {
            label: 'Tabel',
            icon: TableIcon,
            run: () =>
                chain()
                    .insertTable({ rows: 3, cols: 3, withHeaderRow: true })
                    .run(),
            disabled: () => inTable.value,
        },
        {
            label: 'Garis pemisah',
            icon: Minus,
            run: () => chain().setHorizontalRule().run(),
        },
    ],
    [
        {
            label: 'Urungkan (Ctrl+Z)',
            icon: Undo2,
            run: () => chain().undo().run(),
            disabled: () => !editor.value?.can().undo(),
        },
        {
            label: 'Ulangi (Ctrl+Shift+Z)',
            icon: Redo2,
            run: () => chain().redo().run(),
            disabled: () => !editor.value?.can().redo(),
        },
    ],
]);

const tableTools = computed(() => [
    { label: '+ Baris', run: () => chain().addRowAfter().run() },
    { label: '+ Kolom', run: () => chain().addColumnAfter().run() },
    { label: 'Hapus baris', run: () => chain().deleteRow().run() },
    { label: 'Hapus kolom', run: () => chain().deleteColumn().run() },
    {
        label: 'Baris judul',
        run: () => chain().toggleHeaderRow().run(),
    },
    {
        label: 'Hapus tabel',
        run: () => chain().deleteTable().run(),
        danger: true,
    },
]);

// Images from the media library, with the description written there as alt text.
const picking = ref(false);

function insertImage(path: string, _url: string, alt: string): void {
    chain()
        .setImage({ src: `/storage/${path}`, alt })
        .run();
    continueAfterBlock();
}

/**
 * After inserting an image or video the block itself is selected, so the next key typed would
 * replace it: move on to a paragraph below it instead.
 */
function continueAfterBlock(): void {
    const e = editor.value;

    if (e && e.state.selection instanceof NodeSelection) {
        e.chain().focus().createParagraphNear().run();
    }
}

// Links
const linkOpen = ref(false);
const linkUrl = ref('');
const linkNewTab = ref(false);

function openLink(): void {
    const attrs = editor.value?.getAttributes('link') ?? {};
    linkUrl.value = (attrs.href as string | undefined) ?? '';
    linkNewTab.value = attrs.target === '_blank';
    linkOpen.value = true;
}

function normalizeUrl(url: string): string {
    const value = url.trim();

    if (/^(https?:\/\/|mailto:|tel:|\/|#)/i.test(value)) {
        return value;
    }

    if (/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) {
        return `mailto:${value}`;
    }

    return `https://${value}`;
}

function saveLink(): void {
    if (!linkUrl.value.trim()) {
        removeLink();

        return;
    }

    const href = normalizeUrl(linkUrl.value);
    const attrs = {
        href,
        target: linkNewTab.value ? '_blank' : null,
        rel: linkNewTab.value ? 'noopener' : null,
    };
    const e = editor.value!;

    if (e.state.selection.empty && !e.isActive('link')) {
        chain()
            .insertContent({
                type: 'text',
                text: linkUrl.value.trim(),
                marks: [{ type: 'link', attrs }],
            })
            .run();
    } else {
        chain().extendMarkRange('link').setLink(attrs).run();
    }

    linkOpen.value = false;
}

function removeLink(): void {
    chain().extendMarkRange('link').unsetLink().run();
    linkOpen.value = false;
}

// YouTube
const youtubeOpen = ref(false);
const youtubeUrl = ref('');
const youtubeError = ref('');

function openYoutube(): void {
    youtubeUrl.value = '';
    youtubeError.value = '';
    youtubeOpen.value = true;
}

function saveYoutube(): void {
    const src = youtubeUrl.value.trim();

    if (!editor.value?.can().setYoutubeVideo({ src })) {
        youtubeError.value =
            'Link YouTube tidak dikenali. Salin dari tombol Bagikan di YouTube.';

        return;
    }

    chain().setYoutubeVideo({ src }).run();
    continueAfterBlock();
    youtubeOpen.value = false;
}

function onKeydown(event: KeyboardEvent): void {
    if ((event.ctrlKey || event.metaKey) && event.key.toLowerCase() === 'k') {
        event.preventDefault();
        openLink();
    }
}
</script>

<template>
    <div class="rich-editor rounded-xl border bg-card" @keydown="onKeydown">
        <div
            class="sticky top-14 z-20 rounded-t-xl border-b bg-card/95 backdrop-blur"
        >
            <div
                class="flex [scrollbar-width:none] items-center gap-1 overflow-x-auto p-1.5 sm:flex-wrap"
                role="toolbar"
                aria-label="Format teks"
            >
                <select
                    v-model="block"
                    class="h-8 shrink-0 rounded-md border border-input bg-transparent px-2 text-sm"
                    aria-label="Jenis teks"
                >
                    <option value="p">Paragraf</option>
                    <option value="h2">Judul 2</option>
                    <option value="h3">Judul 3</option>
                    <option value="h4">Judul 4</option>
                </select>
                <template v-for="(group, g) in groups" :key="g">
                    <span
                        class="mx-0.5 h-5 w-px shrink-0 bg-border"
                        aria-hidden="true"
                    />
                    <button
                        v-for="tool in group"
                        :key="tool.label"
                        type="button"
                        class="inline-flex size-8 shrink-0 items-center justify-center rounded-md text-foreground/80 transition hover:bg-muted hover:text-foreground disabled:pointer-events-none disabled:opacity-35"
                        :class="{
                            'bg-primary/10 text-primary hover:bg-primary/15 hover:text-primary':
                                tool.active?.(),
                        }"
                        :title="tool.label"
                        :aria-label="tool.label"
                        :aria-pressed="tool.active ? tool.active() : undefined"
                        :disabled="tool.disabled?.()"
                        @mousedown.prevent
                        @click="tool.run"
                    >
                        <component :is="tool.icon" class="size-4" />
                    </button>
                </template>
            </div>
            <div v-if="inTable" class="flex flex-wrap gap-1 border-t p-1.5">
                <span class="self-center px-1 text-xs text-muted-foreground"
                    >Tabel:</span
                >
                <button
                    v-for="tool in tableTools"
                    :key="tool.label"
                    type="button"
                    class="rounded-md px-2 py-1 text-xs font-medium transition hover:bg-muted"
                    :class="{ 'text-destructive': tool.danger }"
                    @mousedown.prevent
                    @click="tool.run"
                >
                    {{ tool.label }}
                </button>
            </div>
        </div>
        <EditorContent :editor="editor" class="px-4 py-5 sm:px-8 sm:py-7" />
    </div>

    <MediaPicker v-model:open="picking" @select="insertImage" />

    <Dialog v-model:open="linkOpen">
        <DialogContent class="sm:max-w-md">
            <DialogHeader>
                <DialogTitle>Sisipkan link</DialogTitle>
                <DialogDescription>
                    Alamat web, halaman di website ini (mis. /kontak), email,
                    atau nomor telepon.
                </DialogDescription>
            </DialogHeader>
            <form class="grid gap-4" @submit.prevent="saveLink">
                <div class="grid gap-2">
                    <Label for="link-url">Alamat link</Label>
                    <Input
                        id="link-url"
                        v-model="linkUrl"
                        placeholder="https://… atau /kontak"
                        autocomplete="off"
                    />
                </div>
                <label class="flex items-center gap-2 text-sm">
                    <input
                        v-model="linkNewTab"
                        type="checkbox"
                        class="size-4 accent-primary"
                    />
                    Buka di tab baru
                </label>
                <DialogFooter class="gap-2">
                    <Button
                        v-if="editor?.isActive('link')"
                        type="button"
                        variant="ghost"
                        class="text-destructive"
                        @click="removeLink"
                        >Hapus link</Button
                    >
                    <Button type="submit">Simpan link</Button>
                </DialogFooter>
            </form>
        </DialogContent>
    </Dialog>

    <Dialog v-model:open="youtubeOpen">
        <DialogContent class="sm:max-w-md">
            <DialogHeader>
                <DialogTitle>Sisipkan video YouTube</DialogTitle>
                <DialogDescription>
                    Tempel link video dari YouTube. Video tampil memakai mode
                    privasi YouTube (youtube-nocookie).
                </DialogDescription>
            </DialogHeader>
            <form class="grid gap-4" @submit.prevent="saveYoutube">
                <div class="grid gap-2">
                    <Label for="youtube-url">Link video</Label>
                    <Input
                        id="youtube-url"
                        v-model="youtubeUrl"
                        placeholder="https://www.youtube.com/watch?v=…"
                        autocomplete="off"
                    />
                    <p v-if="youtubeError" class="text-sm text-destructive">
                        {{ youtubeError }}
                    </p>
                </div>
                <DialogFooter>
                    <Button type="submit" :disabled="!youtubeUrl.trim()"
                        >Sisipkan video</Button
                    >
                </DialogFooter>
            </form>
        </DialogContent>
    </Dialog>
</template>

<style>
.rich-editor .tiptap {
    min-height: 24rem;
    outline: none;
    font-size: 1.0625rem;
    line-height: 1.75;
    overflow-wrap: break-word;
}

.rich-editor .tiptap > * + * {
    margin-top: 1em;
}

.rich-editor .tiptap h2,
.rich-editor .tiptap h3,
.rich-editor .tiptap h4 {
    font-weight: 700;
    line-height: 1.3;
}

.rich-editor .tiptap h2 {
    margin-top: 1.6em;
    font-size: 1.55em;
}

.rich-editor .tiptap h3 {
    margin-top: 1.4em;
    font-size: 1.25em;
}

.rich-editor .tiptap h4 {
    margin-top: 1.2em;
    font-size: 1.08em;
}

.rich-editor .tiptap a {
    color: var(--primary);
    text-decoration: underline;
    text-underline-offset: 0.18em;
}

.rich-editor .tiptap ul {
    list-style: disc;
    padding-left: 1.5em;
}

.rich-editor .tiptap ol {
    list-style: decimal;
    padding-left: 1.5em;
}

.rich-editor .tiptap li > p {
    margin: 0;
}

.rich-editor .tiptap blockquote {
    border-left: 4px solid var(--primary);
    padding-left: 1em;
    color: var(--muted-foreground);
    font-style: italic;
}

.rich-editor .tiptap code {
    border-radius: 0.3em;
    background: var(--muted);
    padding: 0.1em 0.35em;
    font-size: 0.9em;
}

.rich-editor .tiptap pre {
    overflow-x: auto;
    border-radius: 0.5rem;
    background: #0f172a;
    padding: 0.85em 1em;
    color: #e2e8f0;
    font-size: 0.875em;
}

.rich-editor .tiptap pre code {
    background: none;
    padding: 0;
}

.rich-editor .tiptap hr {
    margin: 2em auto;
    border: 0;
    border-top: 2px solid var(--border);
}

.rich-editor .tiptap hr.ProseMirror-selectednode {
    border-top-color: var(--primary);
}

.rich-editor .tiptap img {
    display: block;
    max-width: 100%;
    height: auto;
    margin-inline: auto;
    border-radius: 0.5rem;
}

.rich-editor .tiptap img.ProseMirror-selectednode,
.rich-editor .tiptap div[data-youtube-video].ProseMirror-selectednode {
    outline: 3px solid var(--primary);
    outline-offset: 2px;
}

.rich-editor .tiptap div[data-youtube-video] iframe {
    display: block;
    width: 100%;
    height: auto;
    aspect-ratio: 16 / 9;
    border-radius: 0.5rem;
    pointer-events: none;
}

.rich-editor .tiptap .tableWrapper {
    overflow-x: auto;
}

.rich-editor .tiptap table {
    width: 100%;
    border-collapse: collapse;
    table-layout: fixed;
    font-size: 0.95em;
}

.rich-editor .tiptap th,
.rich-editor .tiptap td {
    position: relative;
    min-width: 5rem;
    border: 1px solid var(--border);
    padding: 0.4em 0.6em;
    vertical-align: top;
    text-align: left;
}

.rich-editor .tiptap th {
    background: var(--muted);
    font-weight: 600;
}

.rich-editor .tiptap .selectedCell::after {
    position: absolute;
    inset: 0;
    background: color-mix(in oklab, var(--primary) 12%, transparent);
    content: '';
    pointer-events: none;
}

.rich-editor .tiptap p.is-editor-empty:first-child::before {
    float: left;
    height: 0;
    color: var(--muted-foreground);
    content: attr(data-placeholder);
    pointer-events: none;
}
</style>
