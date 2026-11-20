<script setup lang="ts">
import { Check, ImageOff, Search, Upload } from '@lucide/vue';
import { computed, ref, useId, watch } from 'vue';
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
import { Spinner } from '@/components/ui/spinner';
import { cn } from '@/lib/utils';
import { fileSize, listMedia, uploadImage } from '@/lib/upload';
import type { MediaItem } from '@/lib/upload';

/**
 * Pick an image from the media library, or upload a new one into it, for a section field
 * or the blog editor. Emits its path, URL and description (alt text).
 */
const props = defineProps<{ current?: string }>();
const open = defineModel<boolean>('open', { required: true });
const emit = defineEmits<{
    select: [path: string, url: string, alt: string];
}>();

const items = ref<MediaItem[]>([]);
const loading = ref(false);
const uploading = ref(false);
const error = ref('');
const query = ref('');
const chosen = ref('');
const inputId = useId();

const shown = computed(() => {
    const q = query.value.trim().toLowerCase();

    return q
        ? items.value.filter((m) => m.name.toLowerCase().includes(q))
        : items.value;
});

async function load(): Promise<void> {
    loading.value = true;
    error.value = '';

    try {
        items.value = await listMedia();
    } catch (e) {
        error.value = (e as Error).message;
    } finally {
        loading.value = false;
    }
}

watch(open, (isOpen) => {
    if (isOpen) {
        chosen.value = props.current ?? '';
        query.value = '';
        load();
    }
});

async function upload(event: Event): Promise<void> {
    const input = event.target as HTMLInputElement;
    const files = [...(input.files ?? [])];

    if (!files.length) {
        return;
    }

    uploading.value = true;
    error.value = '';

    try {
        for (const file of files) {
            chosen.value = await uploadImage(file);
        }

        await load();
    } catch (e) {
        error.value = (e as Error).message;
    } finally {
        uploading.value = false;
        input.value = '';
    }
}

function confirm(): void {
    if (chosen.value) {
        const item = items.value.find((m) => m.path === chosen.value);
        emit('select', chosen.value, item?.url ?? '', item?.alt ?? '');
        open.value = false;
    }
}
</script>

<template>
    <Dialog v-model:open="open">
        <DialogContent class="flex max-h-[90vh] flex-col gap-4 sm:max-w-3xl">
            <DialogHeader>
                <DialogTitle>Galeri media</DialogTitle>
                <DialogDescription>
                    Pilih gambar yang sudah pernah diunggah, atau unggah yang
                    baru.
                </DialogDescription>
            </DialogHeader>

            <div class="flex flex-wrap items-center gap-2">
                <div class="relative min-w-0 flex-1">
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
                <input
                    :id="inputId"
                    type="file"
                    accept="image/png,image/jpeg,image/webp,image/gif,image/svg+xml,image/avif"
                    multiple
                    class="sr-only"
                    @change="upload"
                />
                <Button as-child variant="outline" :disabled="uploading">
                    <label :for="inputId" class="cursor-pointer">
                        <Spinner v-if="uploading" />
                        <Upload v-else class="size-4" />
                        {{ uploading ? 'Mengunggah…' : 'Unggah' }}
                    </label>
                </Button>
            </div>

            <p v-if="error" class="text-sm text-destructive" role="alert">
                {{ error }}
            </p>

            <div class="-mx-1 min-h-48 flex-1 overflow-y-auto px-1">
                <div
                    v-if="loading && !items.length"
                    class="grid grid-cols-3 gap-2 sm:grid-cols-4"
                >
                    <div
                        v-for="n in 8"
                        :key="n"
                        class="aspect-square animate-pulse rounded-lg bg-muted"
                    />
                </div>
                <div
                    v-else-if="!shown.length"
                    class="flex h-48 flex-col items-center justify-center gap-2 rounded-lg border border-dashed text-center text-sm text-muted-foreground"
                >
                    <ImageOff class="size-6" />
                    {{
                        query
                            ? 'Tidak ada gambar dengan nama itu.'
                            : 'Belum ada gambar. Klik Unggah untuk menambahkan.'
                    }}
                </div>
                <ul
                    v-else
                    class="grid grid-cols-3 gap-2 sm:grid-cols-4"
                    role="listbox"
                    aria-label="Gambar"
                >
                    <li
                        v-for="m in shown"
                        :key="m.path"
                        role="option"
                        :aria-selected="chosen === m.path"
                    >
                        <button
                            type="button"
                            :class="
                                cn(
                                    'group relative block aspect-square w-full overflow-hidden rounded-lg border bg-muted/40 bg-[conic-gradient(#0000000d_25%,transparent_0_50%,#0000000d_0_75%,transparent_0)] bg-[length:16px_16px] outline-none focus-visible:ring-2 focus-visible:ring-ring',
                                    chosen === m.path &&
                                        'ring-2 ring-primary ring-offset-2 ring-offset-background',
                                )
                            "
                            :title="m.name"
                            @click="chosen = m.path"
                            @dblclick="
                                chosen = m.path;
                                confirm();
                            "
                        >
                            <img
                                :src="m.url"
                                alt=""
                                loading="lazy"
                                class="size-full object-contain"
                            />
                            <span
                                v-if="chosen === m.path"
                                class="absolute top-1.5 right-1.5 flex size-6 items-center justify-center rounded-full bg-primary text-primary-foreground shadow"
                            >
                                <Check class="size-4" />
                            </span>
                            <span
                                class="absolute inset-x-0 bottom-0 truncate bg-gradient-to-t from-black/70 to-transparent px-2 pt-4 pb-1.5 text-left text-[11px] text-white"
                            >
                                {{ fileSize(m.size)
                                }}<template v-if="m.width">
                                    · {{ m.width }}×{{ m.height }}</template
                                >
                            </span>
                        </button>
                    </li>
                </ul>
            </div>

            <DialogFooter>
                <Button variant="ghost" @click="open = false">Batal</Button>
                <Button :disabled="!chosen" @click="confirm">
                    Pakai gambar ini
                </Button>
            </DialogFooter>
        </DialogContent>
    </Dialog>
</template>
