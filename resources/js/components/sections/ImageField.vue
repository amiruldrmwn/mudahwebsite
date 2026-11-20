<script setup lang="ts">
import { ImagePlus, Images, Trash2 } from '@lucide/vue';
import { ref, useId } from 'vue';
import MediaPicker from '@/components/sections/MediaPicker.vue';
import { Button } from '@/components/ui/button';
import { Spinner } from '@/components/ui/spinner';
import { uploadImage } from '@/lib/upload';

const props = defineProps<{ storageUrl: string }>();
const path = defineModel<string>({ default: '' });

const id = useId();
const uploading = ref(false);
const error = ref('');
const picking = ref(false);

function src(p: string): string {
    return `${props.storageUrl}/${p}`;
}

async function pick(event: Event): Promise<void> {
    const input = event.target as HTMLInputElement;
    const file = input.files?.[0];

    if (!file) {
        return;
    }

    uploading.value = true;
    error.value = '';

    try {
        path.value = await uploadImage(file);
    } catch (e) {
        error.value = (e as Error).message;
    } finally {
        uploading.value = false;
        input.value = '';
    }
}
</script>

<template>
    <div class="flex items-center gap-3">
        <label
            :for="id"
            class="flex size-16 shrink-0 cursor-pointer items-center justify-center overflow-hidden rounded-md border border-dashed bg-muted/40 hover:bg-muted"
        >
            <Spinner v-if="uploading" />
            <img
                v-else-if="path"
                :src="src(path)"
                alt=""
                class="size-full object-contain"
            />
            <ImagePlus v-else class="size-5 text-muted-foreground" />
        </label>
        <input
            :id="id"
            type="file"
            accept="image/png,image/jpeg,image/webp,image/gif,image/svg+xml,image/avif"
            class="sr-only"
            @change="pick"
        />
        <div class="flex flex-col gap-1">
            <div class="flex gap-2">
                <Button type="button" variant="outline" size="sm" as-child>
                    <label :for="id" class="cursor-pointer">
                        {{ path ? 'Ganti' : 'Unggah' }}
                    </label>
                </Button>
                <Button
                    type="button"
                    variant="outline"
                    size="sm"
                    @click="picking = true"
                >
                    <Images class="size-4" />
                    Galeri
                </Button>
                <Button
                    v-if="path"
                    type="button"
                    variant="ghost"
                    size="sm"
                    aria-label="Hapus gambar"
                    @click="path = ''"
                >
                    <Trash2 class="size-4" />
                </Button>
            </div>
            <p v-if="error" class="text-xs text-destructive">{{ error }}</p>
        </div>
        <MediaPicker
            v-model:open="picking"
            :current="path"
            @select="(p) => (path = p)"
        />
    </div>
</template>
