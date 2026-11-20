<script setup lang="ts">
import { Head, Link, router } from '@inertiajs/vue3';
import {
    Check,
    CheckSquare,
    Copy,
    Download,
    ExternalLink,
    FileText,
    RefreshCw,
    ImageOff,
    ImageUp,
    Search,
    Trash2,
    Upload,
    X,
} from '@lucide/vue';
import { computed, onBeforeUnmount, onMounted, ref, useId, watch } from 'vue';
import { toast } from 'vue-sonner';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Textarea } from '@/components/ui/textarea';
import {
    Sheet,
    SheetContent,
    SheetDescription,
    SheetHeader,
    SheetTitle,
} from '@/components/ui/sheet';
import { Spinner } from '@/components/ui/spinner';
import { post } from '@/lib/http';
import { cn } from '@/lib/utils';
import {
    deleteMedia,
    describeMedia,
    fileSize,
    replaceMedia,
} from '@/lib/upload';
import type { MediaItem } from '@/lib/upload';
import { index as mediaIndex, store } from '@/routes/media';

const props = defineProps<{ media: MediaItem[]; maxSide: number }>();

defineOptions({
    layout: {
        breadcrumbs: [{ title: 'Media', href: mediaIndex() }],
    },
});

const ACCEPT =
    'image/png,image/jpeg,image/webp,image/gif,image/svg+xml,image/avif';
const inputId = useId();

const format = (m: MediaItem) => m.name.split('.').pop()?.toUpperCase() ?? '';
const date = (seconds: number) =>
    new Date(seconds * 1000).toLocaleDateString('id-ID', {
        day: 'numeric',
        month: 'short',
        year: 'numeric',
    });
const absolute = (url: string) => new URL(url, location.href).href;

// Filter, search and sort
const filter = ref<'all' | 'used' | 'unused'>('all');
const query = ref('');
const sort = ref<'new' | 'size' | 'name'>('new');

const unused = computed(() => props.media.filter((m) => !m.used_in.length));
const totalSize = computed(() =>
    props.media.reduce((sum, m) => sum + m.size, 0),
);
const unusedSize = computed(() =>
    unused.value.reduce((sum, m) => sum + m.size, 0),
);
const filters = computed(() => [
    { key: 'all' as const, label: 'Semua', count: props.media.length },
    {
        key: 'used' as const,
        label: 'Dipakai',
        count: props.media.length - unused.value.length,
    },
    {
        key: 'unused' as const,
        label: 'Tidak dipakai',
        count: unused.value.length,
    },
]);
const shown = computed(() => {
    const q = query.value.trim().toLowerCase();
    const list = props.media.filter(
        (m) =>
            (filter.value === 'all' ||
                (filter.value === 'used') === m.used_in.length > 0) &&
            (!q || m.name.toLowerCase().includes(q)),
    );

    return [...list].sort((a, b) =>
        sort.value === 'size'
            ? b.size - a.size
            : sort.value === 'name'
              ? a.name.localeCompare(b.name)
              : b.modified - a.modified,
    );
});

// Uploads: one file at a time, each shown as a tile while it goes up.
type Pending = { id: number; name: string; preview: string; done: boolean };
const pending = ref<Pending[]>([]);
let nextId = 0;

async function upload(files: File[]): Promise<void> {
    const images = files.filter((f) => f.type.startsWith('image/'));

    if (files.length && !images.length) {
        toast.error('Pilih file gambar: JPG, PNG, WebP, GIF, atau SVG.');
    }

    if (!images.length) {
        return;
    }

    const tiles = images.map((f) => ({
        id: nextId++,
        name: f.name,
        preview: URL.createObjectURL(f),
        done: false,
    }));
    pending.value = [...tiles, ...pending.value];

    let before = 0;
    let after = 0;
    let ok = 0;

    for (const [i, file] of images.entries()) {
        try {
            const body = new FormData();
            body.append('file', file);
            const json = (await (await post(store.url(), body)).json()) as {
                size: number;
            };
            before += file.size;
            after += json.size;
            ok++;
        } catch (e) {
            toast.error(`${file.name}: ${(e as Error).message}`);
        }

        const tile = pending.value.find((p) => p.id === tiles[i].id);

        if (tile) {
            tile.done = true;
        }
    }

    router.reload({
        only: ['media'],
        onFinish: () => {
            tiles.forEach((t) => URL.revokeObjectURL(t.preview));
            const ids = tiles.map((t) => t.id);
            pending.value = pending.value.filter((p) => !ids.includes(p.id));
        },
    });

    if (ok) {
        const saved =
            before > after ? Math.round((1 - after / before) * 100) : 0;
        toast.success(
            `${ok} gambar diunggah` +
                (saved >= 5
                    ? `. Dikompres ${fileSize(before)} → ${fileSize(after)}, hemat ${saved}%.`
                    : '.'),
        );
    }
}

function picked(event: Event): void {
    const input = event.target as HTMLInputElement;
    upload([...(input.files ?? [])]);
    input.value = '';
}

// Dropping files anywhere on the page
const dragDepth = ref(0);
const hasFiles = (e: DragEvent) =>
    [...(e.dataTransfer?.types ?? [])].includes('Files');
const onEnter = (e: DragEvent) => hasFiles(e) && dragDepth.value++;
const onLeave = (e: DragEvent) =>
    hasFiles(e) && (dragDepth.value = Math.max(0, dragDepth.value - 1));
const onOver = (e: DragEvent) => hasFiles(e) && e.preventDefault();
const onDrop = (e: DragEvent) => {
    if (!hasFiles(e)) {
        return;
    }

    e.preventDefault();
    dragDepth.value = 0;
    upload([...(e.dataTransfer?.files ?? [])]);
};

onMounted(() => {
    window.addEventListener('dragenter', onEnter);
    window.addEventListener('dragleave', onLeave);
    window.addEventListener('dragover', onOver);
    window.addEventListener('drop', onDrop);
});
onBeforeUnmount(() => {
    window.removeEventListener('dragenter', onEnter);
    window.removeEventListener('dragleave', onLeave);
    window.removeEventListener('dragover', onOver);
    window.removeEventListener('drop', onDrop);
});

// Selecting several to delete
const selecting = ref(false);
const selected = ref<Set<string>>(new Set());
const selectedItems = computed(() =>
    props.media.filter((m) => selected.value.has(m.path)),
);

function toggleSelect(m: MediaItem): void {
    const next = new Set(selected.value);

    if (next.has(m.path)) {
        next.delete(m.path);
    } else {
        next.add(m.path);
    }

    selected.value = next;
}

function stopSelecting(): void {
    selecting.value = false;
    selected.value = new Set();
}

function selectUnused(): void {
    selecting.value = true;
    selected.value = new Set(unused.value.map((m) => m.path));
}

// Detail panel
const openPath = ref<string | null>(null);
const current = computed(
    () => props.media.find((m) => m.path === openPath.value) ?? null,
);
const detailOpen = computed({
    get: () => current.value !== null,
    set: (v) => !v && (openPath.value = null),
});

function activate(m: MediaItem): void {
    if (selecting.value) {
        toggleSelect(m);
    } else {
        openPath.value = m.path;
    }
}

watch(
    () => props.media,
    (list) => {
        const paths = new Set(list.map((m) => m.path));
        selected.value = new Set(
            [...selected.value].filter((p) => paths.has(p)),
        );
    },
);

// Description (alt text), saved when it changes
const alt = ref('');
const savingAlt = ref(false);

watch(current, (m, before) => {
    if (m?.path !== before?.path) {
        alt.value = m?.alt ?? '';
    }
});

async function saveAlt(m: MediaItem): Promise<void> {
    savingAlt.value = true;

    try {
        await describeMedia(m.path, alt.value);
        toast.success('Deskripsi gambar disimpan.');
        router.reload({ only: ['media'] });
    } catch (e) {
        toast.error((e as Error).message);
    } finally {
        savingAlt.value = false;
    }
}

// Replacing the file everywhere it is used
const replaceId = useId();
const replacing = ref(false);

async function replaceFile(event: Event, m: MediaItem): Promise<void> {
    const input = event.target as HTMLInputElement;
    const file = input.files?.[0];
    input.value = '';

    if (!file) {
        return;
    }

    replacing.value = true;

    try {
        const path = await replaceMedia(m.path, file);
        const places = m.used_in.length;
        toast.success(
            places
                ? `Gambar diganti di ${places} tempat.`
                : 'File gambar diganti.',
        );
        router.reload({
            only: ['media'],
            onSuccess: () => (openPath.value = path),
        });
    } catch (e) {
        toast.error((e as Error).message);
    } finally {
        replacing.value = false;
    }
}

const copied = ref(false);

async function copyLink(m: MediaItem): Promise<void> {
    await navigator.clipboard.writeText(absolute(m.url));
    copied.value = true;
    setTimeout(() => (copied.value = false), 1500);
}

// Deleting
const deleting = ref(false);

async function remove(items: MediaItem[]): Promise<void> {
    const deletable = items.filter((m) => !m.used_in.length);
    const kept = items.length - deletable.length;

    if (!deletable.length) {
        toast.error('Gambar yang dipilih masih dipakai di halaman.');

        return;
    }

    const what =
        deletable.length === 1
            ? deletable[0].name
            : `${deletable.length} gambar`;

    if (
        !confirm(
            `Hapus ${what}? Gambar yang dihapus tidak bisa dikembalikan.` +
                (kept
                    ? `\n\n${kept} gambar yang masih dipakai tidak ikut dihapus.`
                    : ''),
        )
    ) {
        return;
    }

    deleting.value = true;
    let done = 0;

    for (const m of deletable) {
        try {
            await deleteMedia(m.path);
            done++;
        } catch (e) {
            toast.error(`${m.name}: ${(e as Error).message}`);
        }
    }

    deleting.value = false;

    if (done) {
        toast.success(
            done === 1 ? 'Gambar dihapus.' : `${done} gambar dihapus.`,
        );
        openPath.value = null;
        stopSelecting();
        router.reload({ only: ['media'] });
    }
}
</script>

<template>
    <Head title="Media" />

    <input
        :id="inputId"
        type="file"
        :accept="ACCEPT"
        multiple
        class="sr-only"
        @change="picked"
    />

    <div class="mx-auto flex w-full max-w-6xl flex-col gap-5 p-4 pb-24">
        <!-- Header -->
        <div class="flex flex-wrap items-end justify-between gap-4">
            <div class="min-w-0">
                <h1 class="text-xl font-semibold tracking-tight">Media</h1>
                <p class="text-sm text-muted-foreground">
                    Gambar yang Anda unggah, siap dipakai lagi di halaman mana
                    pun.
                </p>
            </div>
            <Button as-child>
                <label :for="inputId" class="cursor-pointer">
                    <Upload class="size-4" />
                    Unggah gambar
                </label>
            </Button>
        </div>

        <!-- Empty library: the drop zone is the page -->
        <label
            v-if="!media.length && !pending.length"
            :for="inputId"
            class="flex cursor-pointer flex-col items-center justify-center gap-3 rounded-2xl border-2 border-dashed px-6 py-16 text-center transition-colors hover:border-primary/50 hover:bg-primary/5"
        >
            <span
                class="flex size-14 items-center justify-center rounded-2xl bg-primary/10 text-primary"
            >
                <ImageUp class="size-7" />
            </span>
            <span class="text-base font-medium"
                >Unggah gambar pertama Anda</span
            >
            <span class="max-w-md text-sm text-muted-foreground">
                Tarik foto ke sini atau klik untuk memilih. JPG, PNG, WebP, GIF,
                atau SVG sampai 15 MB. Foto otomatis dikecilkan ke
                {{ maxSide }} px dan dikompres agar website tetap cepat.
            </span>
        </label>

        <template v-else>
            <!-- Summary -->
            <div class="grid grid-cols-3 gap-3">
                <div class="rounded-xl border bg-card px-4 py-3">
                    <p class="text-xs text-muted-foreground">Gambar</p>
                    <p class="text-lg font-semibold tabular-nums">
                        {{ media.length }}
                    </p>
                </div>
                <div class="rounded-xl border bg-card px-4 py-3">
                    <p class="text-xs text-muted-foreground">Total ukuran</p>
                    <p class="text-lg font-semibold tabular-nums">
                        {{ fileSize(totalSize) }}
                    </p>
                </div>
                <button
                    type="button"
                    class="rounded-xl border bg-card px-4 py-3 text-left transition-colors hover:border-primary/40 disabled:pointer-events-none"
                    :disabled="!unused.length"
                    @click="filter = 'unused'"
                >
                    <p class="text-xs text-muted-foreground">Tidak dipakai</p>
                    <p class="text-lg font-semibold tabular-nums">
                        {{ unused.length }}
                        <span
                            v-if="unused.length"
                            class="text-xs font-normal text-muted-foreground"
                            >· {{ fileSize(unusedSize) }}</span
                        >
                    </p>
                </button>
            </div>

            <!-- Toolbar -->
            <div class="flex flex-wrap items-center gap-2">
                <div
                    class="flex gap-1 overflow-x-auto rounded-lg bg-muted p-1"
                    role="tablist"
                    aria-label="Saring gambar"
                >
                    <button
                        v-for="f in filters"
                        :key="f.key"
                        type="button"
                        role="tab"
                        :aria-selected="filter === f.key"
                        :class="
                            cn(
                                'rounded-md px-3 py-1.5 text-sm font-medium whitespace-nowrap transition-colors',
                                filter === f.key
                                    ? 'bg-background shadow-sm'
                                    : 'text-muted-foreground hover:text-foreground',
                            )
                        "
                        @click="filter = f.key"
                    >
                        {{ f.label }}
                        <span class="ml-0.5 text-xs text-muted-foreground">{{
                            f.count
                        }}</span>
                    </button>
                </div>
                <div class="relative min-w-40 flex-1 sm:max-w-xs">
                    <Search
                        class="pointer-events-none absolute top-1/2 left-3 size-4 -translate-y-1/2 text-muted-foreground"
                    />
                    <Input
                        v-model="query"
                        type="search"
                        placeholder="Cari nama file"
                        aria-label="Cari gambar"
                        class="pl-9"
                    />
                </div>
                <div class="ml-auto flex items-center gap-2">
                    <select
                        v-model="sort"
                        aria-label="Urutkan"
                        class="h-9 rounded-md border border-input bg-transparent px-2 text-sm shadow-xs dark:bg-input/30"
                    >
                        <option value="new">Terbaru</option>
                        <option value="size">Terbesar</option>
                        <option value="name">Nama A–Z</option>
                    </select>
                    <Button
                        :variant="selecting ? 'secondary' : 'outline'"
                        @click="
                            selecting ? stopSelecting() : (selecting = true)
                        "
                    >
                        <X v-if="selecting" class="size-4" />
                        <CheckSquare v-else class="size-4" />
                        {{ selecting ? 'Selesai' : 'Pilih' }}
                    </Button>
                </div>
            </div>

            <div
                v-if="!shown.length && !pending.length"
                class="flex flex-col items-center gap-2 rounded-xl border border-dashed p-12 text-center text-sm text-muted-foreground"
            >
                <ImageOff class="size-7" />
                <p>
                    {{
                        query
                            ? `Tidak ada gambar bernama "${query}".`
                            : filter === 'unused'
                              ? 'Semua gambar sedang dipakai.'
                              : 'Belum ada gambar yang dipakai di halaman.'
                    }}
                </p>
            </div>

            <!-- Grid -->
            <ul
                v-else
                class="grid grid-cols-2 gap-3 sm:grid-cols-3 md:gap-4 lg:grid-cols-4 xl:grid-cols-5"
                role="list"
            >
                <li
                    v-for="p in pending"
                    :key="`up-${p.id}`"
                    class="overflow-hidden rounded-xl border bg-card"
                >
                    <div class="relative aspect-square bg-muted">
                        <img
                            :src="p.preview"
                            alt=""
                            class="size-full object-cover opacity-40"
                        />
                        <span
                            class="absolute inset-0 flex flex-col items-center justify-center gap-2 text-xs font-medium"
                        >
                            <Check
                                v-if="p.done"
                                class="size-5 text-green-600"
                            />
                            <Spinner v-else />
                            {{ p.done ? 'Selesai' : 'Mengunggah…' }}
                        </span>
                    </div>
                    <p class="truncate px-3 py-2.5 text-sm">{{ p.name }}</p>
                </li>

                <li v-for="m in shown" :key="m.path" data-test="media-item">
                    <button
                        type="button"
                        :class="
                            cn(
                                'group block w-full overflow-hidden rounded-xl border bg-card text-left transition outline-none hover:shadow-md focus-visible:ring-2 focus-visible:ring-ring',
                                selected.has(m.path) &&
                                    'border-primary ring-2 ring-primary',
                            )
                        "
                        :aria-pressed="
                            selecting ? selected.has(m.path) : undefined
                        "
                        :aria-label="
                            selecting ? `Pilih ${m.name}` : `Detail ${m.name}`
                        "
                        @click="activate(m)"
                    >
                        <div
                            class="relative aspect-square overflow-hidden bg-muted/50 bg-[conic-gradient(#0000000a_25%,transparent_0_50%,#0000000a_0_75%,transparent_0)] bg-[length:16px_16px]"
                        >
                            <img
                                :src="m.url"
                                alt=""
                                loading="lazy"
                                :class="
                                    cn(
                                        'size-full transition duration-300 group-hover:scale-[1.03]',
                                        format(m) === 'SVG'
                                            ? 'object-contain p-6'
                                            : 'object-cover',
                                    )
                                "
                            />
                            <span
                                v-if="selecting || selected.has(m.path)"
                                :class="
                                    cn(
                                        'absolute top-2 left-2 flex size-6 items-center justify-center rounded-md border-2 shadow-sm',
                                        selected.has(m.path)
                                            ? 'border-primary bg-primary text-primary-foreground'
                                            : 'border-white bg-black/20',
                                    )
                                "
                                aria-hidden="true"
                            >
                                <Check
                                    v-if="selected.has(m.path)"
                                    class="size-4"
                                />
                            </span>
                            <span
                                class="absolute top-2 right-2 rounded-md bg-black/55 px-1.5 py-0.5 text-[10px] font-semibold tracking-wide text-white backdrop-blur-sm"
                                >{{ format(m) }} · {{ fileSize(m.size) }}</span
                            >
                        </div>
                        <div class="space-y-1 px-3 py-2.5">
                            <p class="truncate text-sm font-medium">
                                {{ m.name }}
                            </p>
                            <p
                                class="flex items-center gap-1.5 text-xs text-muted-foreground"
                            >
                                <span
                                    :class="
                                        cn(
                                            'size-1.5 shrink-0 rounded-full',
                                            m.used_in.length
                                                ? 'bg-green-500'
                                                : 'bg-muted-foreground/40',
                                        )
                                    "
                                    aria-hidden="true"
                                />
                                <span class="truncate">
                                    {{
                                        m.used_in.length
                                            ? `Dipakai di ${m.used_in.length} tempat`
                                            : 'Tidak dipakai'
                                    }}
                                </span>
                            </p>
                        </div>
                    </button>
                </li>
            </ul>
        </template>
    </div>

    <!-- Selection bar -->
    <Transition
        enter-from-class="translate-y-4 opacity-0"
        leave-to-class="translate-y-4 opacity-0"
        enter-active-class="transition"
        leave-active-class="transition"
    >
        <div
            v-if="selecting"
            class="fixed inset-x-4 bottom-4 z-40 mx-auto flex max-w-xl items-center gap-1 rounded-2xl border bg-background/95 p-2 pl-4 shadow-xl backdrop-blur sm:gap-2"
        >
            <p class="mr-auto text-sm whitespace-nowrap">
                <span class="font-medium">{{ selected.size }} dipilih</span>
                <span
                    v-if="selected.size"
                    class="hidden text-muted-foreground sm:inline"
                >
                    ·
                    {{
                        fileSize(selectedItems.reduce((s, m) => s + m.size, 0))
                    }}</span
                >
            </p>
            <Button
                v-if="unused.length"
                variant="ghost"
                size="sm"
                @click="selectUnused"
            >
                Pilih<span class="hidden sm:inline">&nbsp;semua yang</span
                >&nbsp;tidak dipakai
            </Button>
            <Button
                variant="destructive"
                size="sm"
                :disabled="!selected.size || deleting"
                @click="remove(selectedItems)"
            >
                <Spinner v-if="deleting" />
                <Trash2 v-else class="size-4" />
                Hapus
            </Button>
        </div>
    </Transition>

    <!-- Detail panel -->
    <Sheet v-model:open="detailOpen">
        <SheetContent
            class="flex w-full flex-col gap-0 overflow-y-auto p-0 sm:max-w-md"
        >
            <template v-if="current">
                <div
                    class="flex h-64 shrink-0 items-center justify-center border-b bg-muted/50 bg-[conic-gradient(#0000000a_25%,transparent_0_50%,#0000000a_0_75%,transparent_0)] bg-[length:16px_16px] p-4 sm:h-72"
                >
                    <img
                        :src="current.url"
                        alt=""
                        class="max-h-full max-w-full rounded object-contain shadow-sm"
                    />
                </div>
                <SheetHeader class="px-5 pt-4 pb-0">
                    <SheetTitle class="pr-6 break-all">{{
                        current.name
                    }}</SheetTitle>
                    <SheetDescription>
                        Diunggah {{ date(current.modified) }}
                    </SheetDescription>
                </SheetHeader>

                <div class="flex min-w-0 flex-col gap-5 p-5">
                    <dl class="grid grid-cols-3 gap-2 text-sm">
                        <div class="rounded-lg bg-muted/60 px-3 py-2">
                            <dt class="text-xs text-muted-foreground">
                                Format
                            </dt>
                            <dd class="font-medium">{{ format(current) }}</dd>
                        </div>
                        <div class="rounded-lg bg-muted/60 px-3 py-2">
                            <dt class="text-xs text-muted-foreground">
                                Ukuran
                            </dt>
                            <dd class="font-medium tabular-nums">
                                {{ fileSize(current.size) }}
                            </dd>
                        </div>
                        <div class="rounded-lg bg-muted/60 px-3 py-2">
                            <dt class="text-xs text-muted-foreground">
                                Resolusi
                            </dt>
                            <dd class="font-medium tabular-nums">
                                {{
                                    current.width
                                        ? `${current.width}×${current.height}`
                                        : 'Vektor'
                                }}
                            </dd>
                        </div>
                    </dl>

                    <div class="grid grid-cols-[minmax(0,1fr)] gap-1.5">
                        <label
                            for="media-alt"
                            class="text-xs font-medium text-muted-foreground"
                        >
                            Deskripsi gambar
                        </label>
                        <Textarea
                            id="media-alt"
                            v-model="alt"
                            rows="2"
                            maxlength="250"
                            placeholder="Contoh: Teknisi memperbaiki HP di meja servis"
                        />
                        <div class="flex items-start justify-between gap-3">
                            <p class="text-xs text-muted-foreground">
                                Dibaca Google dan pembaca layar. Dipakai di
                                semua halaman yang memakai gambar ini.
                            </p>
                            <Button
                                size="sm"
                                variant="secondary"
                                class="shrink-0"
                                :disabled="
                                    savingAlt || alt.trim() === current.alt
                                "
                                @click="saveAlt(current)"
                            >
                                <Spinner v-if="savingAlt" />
                                Simpan
                            </Button>
                        </div>
                    </div>

                    <div class="grid grid-cols-[minmax(0,1fr)] gap-1.5">
                        <p class="text-xs font-medium text-muted-foreground">
                            Link gambar
                        </p>
                        <div
                            class="flex h-10 items-center gap-1 rounded-lg border bg-background pr-1 pl-3"
                        >
                            <span
                                class="min-w-0 flex-1 truncate font-mono text-xs select-all"
                                >{{ absolute(current.url) }}</span
                            >
                            <Button
                                variant="ghost"
                                size="icon"
                                class="size-8 shrink-0"
                                :aria-label="copied ? 'Tersalin' : 'Salin link'"
                                @click="copyLink(current)"
                            >
                                <Check
                                    v-if="copied"
                                    class="size-4 text-green-600"
                                />
                                <Copy v-else class="size-4" />
                            </Button>
                        </div>
                    </div>

                    <div class="grid grid-cols-[minmax(0,1fr)] gap-1.5">
                        <p class="text-xs font-medium text-muted-foreground">
                            Dipakai di
                        </p>
                        <ul
                            v-if="current.used_in.length"
                            class="divide-y rounded-lg border"
                            role="list"
                        >
                            <li v-for="u in current.used_in" :key="u.label">
                                <Link
                                    :href="u.href"
                                    class="flex items-center gap-2 px-3 py-2.5 text-sm hover:bg-muted/60"
                                >
                                    <FileText
                                        class="size-4 shrink-0 text-muted-foreground"
                                    />
                                    <span class="min-w-0 flex-1 truncate">{{
                                        u.label
                                    }}</span>
                                    <span class="text-xs text-primary"
                                        >Buka</span
                                    >
                                </Link>
                            </li>
                        </ul>
                        <p
                            v-else
                            class="rounded-lg border border-dashed px-3 py-2.5 text-sm text-muted-foreground"
                        >
                            Belum dipakai di halaman mana pun.
                        </p>
                    </div>

                    <div class="flex flex-wrap gap-2">
                        <input
                            :id="replaceId"
                            type="file"
                            :accept="ACCEPT"
                            class="sr-only"
                            @change="replaceFile($event, current)"
                        />
                        <Button
                            as-child
                            variant="outline"
                            size="sm"
                            :disabled="replacing"
                        >
                            <label :for="replaceId" class="cursor-pointer">
                                <Spinner v-if="replacing" />
                                <RefreshCw v-else class="size-4" />
                                Ganti file
                            </label>
                        </Button>
                        <Button as-child variant="outline" size="sm">
                            <a
                                :href="current.url"
                                target="_blank"
                                rel="noopener"
                                ><ExternalLink class="size-4" />Buka</a
                            >
                        </Button>
                        <Button as-child variant="outline" size="sm">
                            <a :href="current.url" :download="current.name"
                                ><Download class="size-4" />Unduh</a
                            >
                        </Button>
                        <Button
                            variant="ghost"
                            size="sm"
                            class="ml-auto text-destructive hover:bg-destructive/10 hover:text-destructive"
                            :disabled="deleting || current.used_in.length > 0"
                            @click="remove([current])"
                        >
                            <Trash2 class="size-4" />
                            Hapus
                        </Button>
                    </div>
                    <p
                        v-if="current.used_in.length"
                        class="-mt-3 text-xs text-muted-foreground"
                    >
                        Untuk menghapus, ganti dulu gambar ini di halaman yang
                        memakainya.
                    </p>
                </div>
            </template>
        </SheetContent>
    </Sheet>

    <!-- Drop anywhere -->
    <div
        v-if="dragDepth > 0"
        class="pointer-events-none fixed inset-0 z-50 flex items-center justify-center bg-primary/10 p-6 backdrop-blur-[2px]"
    >
        <div
            class="flex flex-col items-center gap-3 rounded-2xl border-2 border-dashed border-primary bg-background px-10 py-8 text-center shadow-xl"
        >
            <ImageUp class="size-8 text-primary" />
            <p class="font-medium">Lepaskan untuk mengunggah</p>
            <p class="text-xs text-muted-foreground">
                Foto dikecilkan dan dikompres otomatis.
            </p>
        </div>
    </div>
</template>
