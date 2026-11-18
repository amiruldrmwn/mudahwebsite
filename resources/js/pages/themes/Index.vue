<script setup lang="ts">
import { Head, router } from '@inertiajs/vue3';
import {
    Check,
    ExternalLink,
    Eye,
    LayoutTemplate,
    RotateCcw,
    Search,
} from '@lucide/vue';
import { computed, ref } from 'vue';
import DesktopPreview from '@/components/themes/DesktopPreview.vue';
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
    category: string;
    sample_url: string;
    preview_url: string;
};

type Category = { key: string; label: string; themes: string[] };

const props = defineProps<{
    themes: Theme[];
    categories: Category[];
    current: string;
    current_preset: string;
    saved_presets: string[];
}>();

defineOptions({
    layout: {
        breadcrumbs: [{ title: 'Template', href: themesIndex() }],
    },
});

const byKey = computed(() =>
    Object.fromEntries(props.themes.map((t) => [t.key, t])),
);
const currentTheme = computed(() => byKey.value[props.current]);

const activeCategory = ref<string>('all');
const query = ref('');

/** Categories with their templates in display order; templates without one go last. */
const groups = computed(() => {
    const listed = new Set(props.categories.flatMap((c) => c.themes));
    const all = [
        ...props.categories.map((c) => ({
            key: c.key,
            label: c.label,
            themes: c.themes.map((k) => byKey.value[k]).filter(Boolean),
        })),
        {
            key: 'lainnya',
            label: 'Lainnya',
            themes: props.themes.filter((t) => !listed.has(t.key)),
        },
    ];

    return all.filter((g) => g.themes.length > 0);
});

const visibleGroups = computed(() => {
    const q = query.value.trim().toLowerCase();

    return groups.value
        .filter(
            (g) =>
                activeCategory.value === 'all' ||
                g.key === activeCategory.value,
        )
        .map((g) => ({
            ...g,
            themes: q
                ? g.themes.filter((t) =>
                      `${t.label} ${t.description}`.toLowerCase().includes(q),
                  )
                : g.themes,
        }))
        .filter((g) => g.themes.length > 0);
});

const resultCount = computed(() =>
    visibleGroups.value.reduce((n, g) => n + g.themes.length, 0),
);

// Large desktop preview.
const previewing = ref<Theme | null>(null);
const previewOpen = ref(false);

function preview(theme: Theme): void {
    previewing.value = theme;
    previewOpen.value = true;
}

// Switching template.
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
    previewOpen.value = false;
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

    <div class="mx-auto flex w-full max-w-7xl flex-col gap-8 p-4 md:p-6">
        <!-- Current template -->
        <section
            v-if="currentTheme"
            class="grid overflow-hidden rounded-2xl border bg-card md:grid-cols-[1.4fr_1fr]"
        >
            <div class="aspect-[16/10] border-b md:border-r md:border-b-0">
                <DesktopPreview
                    :src="currentTheme.preview_url"
                    :title="`Website Anda dengan template ${currentTheme.label}`"
                />
            </div>
            <div class="flex flex-col justify-center gap-4 p-6 md:p-8">
                <span
                    class="inline-flex w-fit items-center gap-1.5 rounded-full bg-emerald-500/10 px-3 py-1 text-xs font-medium text-emerald-700 dark:text-emerald-300"
                    ><Check class="size-3.5" />Template yang dipakai</span
                >
                <div class="flex items-center gap-2.5">
                    <span
                        class="size-4 rounded-full ring-2 ring-background"
                        :style="{ background: currentTheme.color }"
                    />
                    <h1 class="text-2xl font-semibold tracking-tight">
                        {{ currentTheme.label }}
                    </h1>
                </div>
                <p class="text-sm leading-relaxed text-muted-foreground">
                    {{ currentTheme.description }}
                </p>
                <div class="flex flex-wrap gap-2">
                    <Button as-child>
                        <a
                            :href="currentTheme.preview_url"
                            target="_blank"
                            rel="noopener"
                            ><ExternalLink class="size-4" />Lihat website</a
                        >
                    </Button>
                </div>
                <p class="text-xs text-muted-foreground">
                    Ganti template kapan saja. Halaman Anda tetap tersimpan dan
                    muncul lagi saat kembali ke template ini.
                </p>
            </div>
        </section>

        <!-- Filters -->
        <div
            class="sticky top-0 z-20 -mx-4 flex flex-col gap-3 border-b bg-background/95 px-4 py-3 backdrop-blur md:-mx-6 md:px-6"
        >
            <div
                class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between"
            >
                <div>
                    <h2 class="flex items-center gap-2 text-lg font-semibold">
                        <LayoutTemplate class="size-5 text-primary" />Pilih
                        template
                    </h2>
                    <p class="text-sm text-muted-foreground">
                        {{ themes.length }} template untuk berbagai jenis usaha.
                    </p>
                </div>
                <label class="relative w-full md:w-72">
                    <Search
                        class="pointer-events-none absolute top-1/2 left-3 size-4 -translate-y-1/2 text-muted-foreground"
                    />
                    <input
                        v-model="query"
                        type="search"
                        placeholder="Cari: kopi, klinik, rental…"
                        class="h-10 w-full rounded-full border bg-card pr-4 pl-9 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20"
                        aria-label="Cari template"
                    />
                </label>
            </div>
            <div
                class="-mx-1 flex gap-2 overflow-x-auto px-1 pb-1"
                role="tablist"
                aria-label="Kategori template"
            >
                <button
                    type="button"
                    role="tab"
                    :aria-selected="activeCategory === 'all'"
                    class="shrink-0 rounded-full border px-4 py-1.5 text-sm font-medium transition"
                    :class="
                        activeCategory === 'all'
                            ? 'border-primary bg-primary text-primary-foreground'
                            : 'bg-card hover:border-primary/40'
                    "
                    @click="activeCategory = 'all'"
                >
                    Semua
                </button>
                <button
                    v-for="g in groups"
                    :key="g.key"
                    type="button"
                    role="tab"
                    :aria-selected="activeCategory === g.key"
                    class="shrink-0 rounded-full border px-4 py-1.5 text-sm font-medium transition"
                    :class="
                        activeCategory === g.key
                            ? 'border-primary bg-primary text-primary-foreground'
                            : 'bg-card hover:border-primary/40'
                    "
                    @click="activeCategory = g.key"
                >
                    {{ g.label }}
                    <span class="ml-1 opacity-70">{{ g.themes.length }}</span>
                </button>
            </div>
        </div>

        <p
            v-if="resultCount === 0"
            class="rounded-2xl border border-dashed p-10 text-center text-sm text-muted-foreground"
        >
            Tidak ada template yang cocok dengan "{{ query }}".
        </p>

        <!-- Categories -->
        <section
            v-for="group in visibleGroups"
            :key="group.key"
            class="flex flex-col gap-4"
        >
            <h3 class="text-base font-semibold">
                {{ group.label }}
                <span class="ml-1 text-sm font-normal text-muted-foreground"
                    >{{ group.themes.length }} template</span
                >
            </h3>
            <div class="grid gap-5 sm:grid-cols-2 xl:grid-cols-3">
                <article
                    v-for="theme in group.themes"
                    :key="theme.key"
                    class="group flex flex-col overflow-hidden rounded-2xl border bg-card transition hover:-translate-y-0.5 hover:shadow-xl hover:shadow-black/5"
                    :class="{ 'ring-2 ring-primary': theme.key === current }"
                >
                    <button
                        type="button"
                        class="relative block border-b text-left"
                        :aria-label="`Lihat contoh ${theme.label}`"
                        @click="preview(theme)"
                    >
                        <span
                            class="flex items-center gap-1.5 border-b bg-muted/60 px-3 py-2"
                            aria-hidden="true"
                        >
                            <span class="size-2 rounded-full bg-red-400" />
                            <span class="size-2 rounded-full bg-amber-400" />
                            <span class="size-2 rounded-full bg-emerald-400" />
                        </span>
                        <span class="block aspect-[16/10]">
                            <DesktopPreview
                                :src="theme.sample_url"
                                :title="`Contoh ${theme.label}`"
                            />
                        </span>
                        <span
                            class="absolute inset-0 top-8 flex items-center justify-center bg-black/0 opacity-0 transition group-hover:bg-black/35 group-hover:opacity-100"
                        >
                            <span
                                class="inline-flex items-center gap-2 rounded-full bg-white px-4 py-2 text-sm font-medium text-black shadow-lg"
                                ><Eye class="size-4" />Lihat contoh</span
                            >
                        </span>
                    </button>
                    <div class="flex flex-1 flex-col gap-2 p-4">
                        <div class="flex items-center gap-2">
                            <span
                                class="size-3 shrink-0 rounded-full"
                                :style="{ background: theme.color }"
                            />
                            <h4 class="font-semibold">{{ theme.label }}</h4>
                            <span
                                v-if="theme.key === current"
                                class="ml-auto rounded-full bg-primary/10 px-2 py-0.5 text-[11px] font-medium text-primary"
                                >Dipakai</span
                            >
                        </div>
                        <p
                            class="line-clamp-2 flex-1 text-sm text-muted-foreground"
                        >
                            {{ theme.description }}
                        </p>
                        <div class="mt-2 flex gap-2">
                            <Button
                                v-if="theme.key !== current"
                                size="sm"
                                class="flex-1"
                                @click="choose(theme)"
                            >
                                <Check class="size-4" />Pakai
                            </Button>
                            <Button
                                size="sm"
                                variant="outline"
                                class="flex-1"
                                @click="preview(theme)"
                            >
                                <Eye class="size-4" />Contoh
                            </Button>
                        </div>
                    </div>
                </article>
            </div>
        </section>
    </div>

    <!-- Desktop preview -->
    <Dialog v-model:open="previewOpen">
        <DialogContent
            class="flex h-[90vh] max-w-[min(1200px,95vw)] flex-col gap-3 p-3 sm:max-w-[min(1200px,95vw)] sm:p-4"
        >
            <DialogHeader
                class="flex-row items-center justify-between gap-3 pr-8"
            >
                <div class="min-w-0">
                    <DialogTitle>{{ previewing?.label }}</DialogTitle>
                    <DialogDescription class="truncate"
                        >Contoh tampilan desktop dengan isi contoh. Klik menu
                        untuk melihat halaman lain.</DialogDescription
                    >
                </div>
                <div v-if="previewing" class="flex shrink-0 gap-2">
                    <Button as-child size="sm" variant="outline">
                        <a
                            :href="previewing.sample_url"
                            target="_blank"
                            rel="noopener"
                            ><ExternalLink class="size-4" />Tab baru</a
                        >
                    </Button>
                    <Button
                        v-if="previewing.key !== current"
                        size="sm"
                        @click="choose(previewing)"
                        ><Check class="size-4" />Pakai template ini</Button
                    >
                </div>
            </DialogHeader>
            <div class="min-h-0 flex-1 overflow-hidden rounded-lg border">
                <DesktopPreview
                    v-if="previewing && previewOpen"
                    :src="previewing.sample_url"
                    :title="`Contoh ${previewing.label}`"
                    interactive
                />
            </div>
        </DialogContent>
    </Dialog>

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
