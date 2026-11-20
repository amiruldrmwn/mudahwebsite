<script setup lang="ts">
import { Head, router } from '@inertiajs/vue3';
import {
    Check,
    Copy,
    ExternalLink,
    ImageOff,
    Search,
    Trash2,
    Upload,
} from '@lucide/vue';
import { computed, ref, useId } from 'vue';
import { toast } from 'vue-sonner';
import { Badge } from '@/components/ui/badge';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Spinner } from '@/components/ui/spinner';
import { post } from '@/lib/http';
import { cn } from '@/lib/utils';
import { deleteMedia, fileSize } from '@/lib/upload';
import type { MediaItem } from '@/lib/upload';
import { index as mediaIndex, store } from '@/routes/media';

const props = defineProps<{ media: MediaItem[]; maxSide: number }>();

defineOptions({
    layout: {
        breadcrumbs: [{ title: 'Media', href: mediaIndex() }],
    },
});

const filter = ref<'all' | 'used' | 'unused'>('all');
const query = ref('');
const inputId = useId();

const counts = computed(() => ({
    all: props.media.length,
    used: props.media.filter((m) => m.used_in.length).length,
    unused: props.media.filter((m) => !m.used_in.length).length,
}));
const totalSize = computed(() =>
    props.media.reduce((sum, m) => sum + m.size, 0),
);
const shown = computed(() => {
    const q = query.value.trim().toLowerCase();

    return props.media.filter(
        (m) =>
            (filter.value === 'all' ||
                (filter.value === 'used') === m.used_in.length > 0) &&
            (!q || m.name.toLowerCase().includes(q)),
    );
});
const filters = computed(() => [
    { key: 'all' as const, label: 'Semua', count: counts.value.all },
    { key: 'used' as const, label: 'Dipakai', count: counts.value.used },
    { key: 'unused' as const, label: 'Tidak dipakai', count: counts.value.unused },
]);

// Uploading: one file at a time, so a phone on a slow line shows steady progress.
const queue = ref<{ name: string; done: number; total: number } | null>(null);
const dragging = ref(false);

async function upload(files: File[]): Promise<void> {
    const images = files.filter((f) => f.type.startsWith('image/'));

    if (!images.length || queue.value) {
        return;
    }

    let before = 0;
    let after = 0;
    let failed = 0;

    for (const [i, file] of images.entries()) {
        queue.value = { name: file.name, done: i, total: images.length };

        try {
            const body = new FormData();
            body.append('file', file);
            const json = (await (await post(store.url(), body)).json()) as {
                size: number;
            };
            before += file.size;
            after += json.size;
        } catch (e) {
            failed++;
            toast.error(`${file.name}: ${(e as Error).message}`);
        }
    }

    queue.value = null;
    router.reload({ only: ['media'] });

    const ok = images.length - failed;

    if (ok) {
        const saved = before > after ? Math.round((1 - after / before) * 100) : 0;
        toast.success(
            `${ok} gambar diunggah` +
                (saved >= 5
                    ? `, dikompres ${fileSize(before)} → ${fileSize(after)} (hemat ${saved}%).`
                    : '.'),
        );
    }
}

function picked(event: Event): void {
    const input = event.target as HTMLInputElement;
    upload([...(input.files ?? [])]);
    input.value = '';
}

function dropped(event: DragEvent): void {
    dragging.value = false;
    upload([...(event.dataTransfer?.files ?? [])]);
}

const copied = ref('');

async function copy(m: MediaItem): Promise<void> {
    await navigator.clipboard.writeText(new URL(m.url, location.href).href);
    copied.value = m.path;
    setTimeout(() => (copied.value = ''), 1500);
}

const deleting = ref('');

async function remove(m: MediaItem): Promise<void> {
    if (!confirm(`Hapus ${m.name}? Gambar ini tidak bisa dikembalikan.`)) {
        return;
    }

    deleting.value = m.path;

    try {
        await deleteMedia(m.path);
        toast.success('Gambar dihapus.');
        router.reload({ only: ['media'] });
    } catch (e) {
        toast.error((e as Error).message);
    } finally {
        deleting.value = '';
    }
}

const date = (seconds: number) =>
    new Date(seconds * 1000).toLocaleDateString('id-ID', {
        day: 'numeric',
        month: 'short',
        year: 'numeric',
    });
</script>

<template>
    <Head title="Media" />

    <div
        class="mx-auto flex w-full max-w-6xl flex-col gap-6 p-4"
        @dragover.prevent="dragging = true"
        @dragleave.self="dragging = false"
        @drop.prevent="dropped"
    >
        <div class="flex flex-wrap items-end justify-between gap-4">
            <div>
                <h1 class="text-xl font-semibold tracking-tight">Media</h1>
                <p class="text-sm text-muted-foreground">
                    Semua gambar yang Anda unggah, siap dipakai lagi di halaman
                    mana pun.
                    <span v-if="media.length" class="whitespace-nowrap"
                        >{{ media.length }} gambar ·
                        {{ fileSize(totalSize) }}</span
                    >
                </p>
            </div>
            <input
                :id="inputId"
                type="file"
                accept="image/png,image/jpeg,image/webp,image/gif,image/svg+xml,image/avif"
                multiple
                class="sr-only"
                @change="picked"
            />
            <Button as-child :disabled="!!queue">
                <label :for="inputId" class="cursor-pointer">
                    <Upload class="size-4" />
                    Unggah gambar
                </label>
            </Button>
        </div>

        <!-- Drop zone and upload progress -->
        <label
            :for="inputId"
            :class="
                cn(
                    'flex cursor-pointer flex-col items-center justify-center gap-1 rounded-xl border-2 border-dashed px-4 py-6 text-center text-sm transition-colors',
                    dragging
                        ? 'border-primary bg-primary/5'
                        : 'border-border hover:border-primary/40 hover:bg-muted/40',
                )
            "
        >
            <template v-if="queue">
                <span class="flex items-center gap-2 font-medium">
                    <Spinner />
                    Mengunggah {{ queue.done + 1 }} dari {{ queue.total }}…
                </span>
                <span class="max-w-full truncate text-muted-foreground">{{
                    queue.name
                }}</span>
                <span
                    class="mt-2 h-1.5 w-full max-w-xs overflow-hidden rounded-full bg-muted"
                    role="progressbar"
                    :aria-valuenow="queue.done"
                    :aria-valuemax="queue.total"
                >
                    <span
                        class="block h-full rounded-full bg-primary transition-all"
                        :style="{ width: `${(queue.done / queue.total) * 100}%` }"
                    />
                </span>
            </template>
            <template v-else>
                <Upload class="mb-1 size-5 text-muted-foreground" />
                <span class="font-medium"
                    >Tarik gambar ke sini, atau klik untuk memilih</span
                >
                <span class="text-xs text-muted-foreground">
                    JPG, PNG, WebP, GIF, atau SVG, maks 15 MB. Foto otomatis
                    dikecilkan ke {{ maxSide }} px dan dikompres agar website
                    tetap cepat.
                </span>
            </template>
        </label>

        <div v-if="media.length" class="flex flex-wrap items-center gap-3">
            <div class="flex gap-1 rounded-lg bg-muted p-1" role="tablist">
                <button
                    v-for="f in filters"
                    :key="f.key"
                    type="button"
                    role="tab"
                    :aria-selected="filter === f.key"
                    :class="
                        cn(
                            'rounded-md px-3 py-1.5 text-sm font-medium transition-colors',
                            filter === f.key
                                ? 'bg-background shadow-sm'
                                : 'text-muted-foreground hover:text-foreground',
                        )
                    "
                    @click="filter = f.key"
                >
                    {{ f.label }}
                    <span class="ml-1 text-xs text-muted-foreground">{{
                        f.count
                    }}</span>
                </button>
            </div>
            <div class="relative min-w-48 flex-1 sm:max-w-xs">
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
        </div>

        <div
            v-if="!shown.length"
            class="flex flex-col items-center gap-2 rounded-xl border border-dashed p-12 text-center text-muted-foreground"
        >
            <ImageOff class="size-8" />
            <p v-if="!media.length">
                Belum ada gambar. Gambar yang diunggah dari editor halaman juga
                akan muncul di sini.
            </p>
            <p v-else>Tidak ada gambar yang cocok.</p>
        </div>

        <ul
            v-else
            class="grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-4"
            role="list"
        >
            <li
                v-for="m in shown"
                :key="m.path"
                class="flex flex-col overflow-hidden rounded-xl border bg-card"
                data-test="media-item"
            >
                <a
                    :href="m.url"
                    target="_blank"
                    rel="noopener"
                    class="block aspect-[4/3] border-b bg-muted/40 bg-[conic-gradient(#0000000d_25%,transparent_0_50%,#0000000d_0_75%,transparent_0)] bg-[length:16px_16px]"
                    :aria-label="`Buka ${m.name}`"
                >
                    <img
                        :src="m.url"
                        alt=""
                        loading="lazy"
                        class="size-full object-contain"
                    />
                </a>
                <div class="flex flex-1 flex-col gap-2 p-3">
                    <div class="min-w-0">
                        <p class="truncate text-sm font-medium" :title="m.name">
                            {{ m.name }}
                        </p>
                        <p class="text-xs text-muted-foreground">
                            {{ fileSize(m.size)
                            }}<template v-if="m.width">
                                · {{ m.width }}×{{ m.height }}</template
                            >
                            · {{ date(m.modified) }}
                        </p>
                    </div>
                    <Badge
                        v-if="m.used_in.length"
                        variant="secondary"
                        class="max-w-full justify-start truncate"
                        :title="`Dipakai di ${m.used_in.join(', ')}`"
                    >
                        Dipakai di {{ m.used_in.join(', ') }}
                    </Badge>
                    <Badge v-else variant="outline" class="text-muted-foreground">
                        Tidak dipakai
                    </Badge>
                    <div class="mt-auto flex gap-1 pt-1">
                        <Button
                            variant="ghost"
                            size="icon"
                            class="size-8"
                            :aria-label="`Salin link ${m.name}`"
                            :title="copied === m.path ? 'Tersalin' : 'Salin link'"
                            @click="copy(m)"
                        >
                            <Check
                                v-if="copied === m.path"
                                class="size-4 text-green-600"
                            />
                            <Copy v-else class="size-4" />
                        </Button>
                        <Button
                            as-child
                            variant="ghost"
                            size="icon"
                            class="size-8"
                        >
                            <a
                                :href="m.url"
                                target="_blank"
                                rel="noopener"
                                :aria-label="`Buka ${m.name}`"
                                title="Buka"
                                ><ExternalLink class="size-4"
                            /></a>
                        </Button>
                        <Button
                            variant="ghost"
                            size="icon"
                            class="ml-auto size-8 text-muted-foreground hover:text-destructive"
                            :disabled="deleting === m.path || m.used_in.length > 0"
                            :aria-label="`Hapus ${m.name}`"
                            :title="
                                m.used_in.length
                                    ? 'Masih dipakai. Ganti dulu gambarnya di halaman.'
                                    : 'Hapus'
                            "
                            @click="remove(m)"
                        >
                            <Spinner v-if="deleting === m.path" />
                            <Trash2 v-else class="size-4" />
                        </Button>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</template>
