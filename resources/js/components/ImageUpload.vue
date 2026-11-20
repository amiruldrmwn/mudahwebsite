<script setup lang="ts">
import { ImagePlus, Images, Trash2 } from '@lucide/vue';
import { computed, onBeforeUnmount, ref, useId } from 'vue';
import MediaPicker from '@/components/sections/MediaPicker.vue';
import { Button } from '@/components/ui/button';

const props = defineProps<{
    currentUrl: string | null;
    accept: string;
    hint: string;
    // Offer the media library as well as a new file.
    pickable?: boolean;
}>();

const file = defineModel<File | null>('file', { required: true });
const removed = defineModel<boolean>('removed', { required: true });
// The library image picked instead of a file ('' for none).
const picked = defineModel<string>('picked', { default: '' });
const pickedUrl = ref<string | null>(null);
const picking = ref(false);

const id = useId();
const input = ref<HTMLInputElement | null>(null);
const preview = ref<string | null>(null);

const shown = computed(
    () =>
        preview.value ??
        pickedUrl.value ??
        (removed.value ? null : props.currentUrl),
);

function pick(event: Event): void {
    const chosen = (event.target as HTMLInputElement).files?.[0] ?? null;

    if (preview.value) {
        URL.revokeObjectURL(preview.value);
    }

    file.value = chosen;
    preview.value = chosen ? URL.createObjectURL(chosen) : null;
    removed.value = false;
    picked.value = '';
    pickedUrl.value = null;
}

function fromLibrary(path: string, url: string): void {
    clear();
    removed.value = false;
    picked.value = path;
    pickedUrl.value = url;
}

function clear(): void {
    if (preview.value) {
        URL.revokeObjectURL(preview.value);
    }

    preview.value = null;
    file.value = null;
    removed.value = true;
    picked.value = '';
    pickedUrl.value = null;

    if (input.value) {
        input.value.value = '';
    }
}

onBeforeUnmount(() => {
    if (preview.value) {
        URL.revokeObjectURL(preview.value);
    }
});
</script>

<template>
    <div class="flex items-center gap-4">
        <label
            :for="id"
            class="flex size-20 shrink-0 cursor-pointer items-center justify-center overflow-hidden rounded-lg border border-dashed bg-muted/40 hover:bg-muted"
        >
            <img
                v-if="shown"
                :src="shown"
                alt=""
                class="max-h-full max-w-full object-contain p-1"
            />
            <ImagePlus v-else class="size-6 text-muted-foreground" />
        </label>
        <div class="space-y-2">
            <input
                :id="id"
                ref="input"
                type="file"
                :accept="accept"
                class="sr-only"
                @change="pick"
            />
            <div class="flex gap-2">
                <Button type="button" variant="outline" size="sm" as-child>
                    <label :for="id" class="cursor-pointer">Pilih gambar</label>
                </Button>
                <Button
                    v-if="pickable"
                    type="button"
                    variant="outline"
                    size="sm"
                    @click="picking = true"
                >
                    <Images class="size-4" />
                    Galeri
                </Button>
                <Button
                    v-if="shown"
                    type="button"
                    variant="ghost"
                    size="sm"
                    @click="clear"
                >
                    <Trash2 class="size-4" />
                    Hapus
                </Button>
            </div>
            <p class="text-xs text-muted-foreground">{{ hint }}</p>
        </div>
        <MediaPicker
            v-if="pickable"
            v-model:open="picking"
            :current="picked"
            @select="fromLibrary"
        />
    </div>
</template>
