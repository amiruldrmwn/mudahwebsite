<script setup lang="ts">
import { Head, router } from '@inertiajs/vue3';
import { Check, ExternalLink, Eye, RotateCcw } from '@lucide/vue';
import { computed, ref } from 'vue';
import { Badge } from '@/components/ui/badge';
import { Button } from '@/components/ui/button';
import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogHeader,
    DialogTitle,
} from '@/components/ui/dialog';
import { index as themesIndex, update } from '@/routes/themes';

type Theme = {
    key: string;
    label: string;
    description: string;
    color: string;
    preset: string;
    sample_url: string;
    preview_url: string;
};

const props = defineProps<{
    themes: Theme[];
    current: string;
    current_preset: string;
    saved_presets: string[];
}>();

defineOptions({
    layout: {
        breadcrumbs: [{ title: 'Template', href: themesIndex() }],
    },
});

const choosing = ref<Theme | null>(null);
const dialogOpen = ref(false);
const busy = ref(false);

/** Templates sharing a page group, e.g. "Korporat, Modern, Minimalis". */
function groupLabel(preset: string): string {
    return props.themes
        .filter((t) => t.preset === preset)
        .map((t) => t.label)
        .join(', ');
}

const changesPages = computed(
    () =>
        choosing.value !== null &&
        choosing.value.preset !== props.current_preset,
);

const hasSavedPages = computed(
    () =>
        choosing.value !== null &&
        props.saved_presets.includes(choosing.value.preset),
);

function choose(theme: Theme): void {
    choosing.value = theme;
    dialogOpen.value = true;
}

function apply(reset: boolean): void {
    if (!choosing.value) {
        return;
    }

    if (
        reset &&
        !confirm(
            'Halaman untuk template ini akan dihapus dan diganti isi contoh. Lanjutkan?',
        )
    ) {
        return;
    }

    router.put(
        update.url(),
        { theme: choosing.value.key, reset },
        {
            preserveScroll: true,
            onStart: () => (busy.value = true),
            onFinish: () => {
                busy.value = false;
                dialogOpen.value = false;
            },
        },
    );
}
</script>

<template>
    <Head title="Template" />

    <div class="mx-auto flex w-full max-w-6xl flex-col gap-6 p-4">
        <div>
            <h1 class="text-xl font-semibold tracking-tight">Template</h1>
            <p class="text-sm text-muted-foreground">
                Pilih tampilan website. Halaman dan isinya ikut template: Spa
                dan Kue & Bakery punya halaman sendiri, sedangkan Korporat,
                Modern, dan Minimalis memakai halaman yang sama. Halaman Anda
                tidak hilang saat berganti template.
            </p>
        </div>

        <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
            <div
                v-for="theme in themes"
                :key="theme.key"
                class="flex flex-col overflow-hidden rounded-xl border bg-card"
                :class="{ 'ring-2 ring-primary': theme.key === current }"
            >
                <div class="relative h-56 overflow-hidden border-b bg-muted">
                    <iframe
                        :src="theme.sample_url"
                        :title="`Contoh ${theme.label}`"
                        class="pointer-events-none absolute top-0 left-0 h-[200%] w-[200%] origin-top-left scale-50"
                        loading="lazy"
                        tabindex="-1"
                    />
                </div>
                <div class="flex flex-1 flex-col gap-3 p-4">
                    <div class="flex items-center gap-2">
                        <span
                            class="size-3 rounded-full"
                            :style="{ background: theme.color }"
                        />
                        <h2 class="font-semibold">{{ theme.label }}</h2>
                        <Badge v-if="theme.key === current">Dipakai</Badge>
                    </div>
                    <p class="flex-1 text-sm text-muted-foreground">
                        {{ theme.description }}
                    </p>
                    <div class="flex flex-wrap gap-2">
                        <Button
                            v-if="theme.key !== current"
                            size="sm"
                            @click="choose(theme)"
                        >
                            <Check class="size-4" />
                            Pakai template ini
                        </Button>
                        <Button as-child size="sm" variant="outline">
                            <a
                                :href="theme.sample_url"
                                target="_blank"
                                rel="noopener"
                            >
                                <Eye class="size-4" />
                                Contoh
                            </a>
                        </Button>
                        <Button
                            v-if="theme.preset === current_preset"
                            as-child
                            size="sm"
                            variant="ghost"
                        >
                            <a
                                :href="theme.preview_url"
                                target="_blank"
                                rel="noopener"
                            >
                                <ExternalLink class="size-4" />
                                Dengan isi Anda
                            </a>
                        </Button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <Dialog v-model:open="dialogOpen">
        <DialogContent>
            <DialogHeader>
                <DialogTitle>Pakai template {{ choosing?.label }}?</DialogTitle>
                <DialogDescription v-if="!changesPages">
                    Halaman dan isi Anda tetap sama, hanya tampilannya yang
                    berubah.
                </DialogDescription>
                <DialogDescription v-else-if="hasSavedPages">
                    Halaman akan berganti ke halaman yang dulu Anda buat untuk
                    template {{ groupLabel(choosing!.preset) }}.
                </DialogDescription>
                <DialogDescription v-else>
                    Halaman akan berganti ke halaman contoh template ini (foto,
                    menu, harga) yang bisa langsung Anda ubah. Warna utama ikut
                    disesuaikan.
                </DialogDescription>
            </DialogHeader>
            <p
                v-if="changesPages"
                class="rounded-lg bg-muted p-3 text-sm text-muted-foreground"
            >
                Halaman Anda sekarang tetap tersimpan dan muncul lagi saat Anda
                kembali ke template {{ groupLabel(current_preset) }}.
            </p>
            <div
                class="flex flex-col-reverse gap-2 sm:flex-row sm:justify-between"
            >
                <Button
                    v-if="hasSavedPages || !changesPages"
                    variant="ghost"
                    size="sm"
                    class="text-muted-foreground"
                    :disabled="busy"
                    @click="apply(true)"
                >
                    <RotateCcw class="size-4" /> Mulai ulang dari isi contoh
                </Button>
                <span v-else />
                <Button :disabled="busy" @click="apply(false)">
                    <Check class="size-4" /> Pakai template
                </Button>
            </div>
        </DialogContent>
    </Dialog>
</template>
