<script setup lang="ts">
import { Head, Link, useForm } from '@inertiajs/vue3';
import {
    ArrowDown,
    ArrowUp,
    ChevronDown,
    Copy,
    ExternalLink,
    Eye,
    Plus,
    Sparkles,
    Trash2,
} from '@lucide/vue';
import { computed, ref } from 'vue';
import InputError from '@/components/InputError.vue';
import AssistantPanel from '@/components/sections/AssistantPanel.vue';
import FieldInput from '@/components/sections/FieldInput.vue';
import PreviewDialog from '@/components/sections/PreviewDialog.vue';
import { Button } from '@/components/ui/button';
import {
    Card,
    CardContent,
    CardDescription,
    CardHeader,
    CardTitle,
} from '@/components/ui/card';
import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogHeader,
    DialogTitle,
} from '@/components/ui/dialog';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Spinner } from '@/components/ui/spinner';
import { Textarea } from '@/components/ui/textarea';
import { index as pagesIndex, update } from '@/routes/pages';
import type {
    Section,
    SectionData,
    SectionTypeDef,
    SectionValue,
} from '@/types/sections';

type PageForm = {
    title: string;
    slug: string;
    in_menu: boolean;
    published: boolean;
    meta_title: string;
    meta_description: string;
    sections: Section[];
};

const props = defineProps<{
    page: PageForm & { id: number; url: string; is_home: boolean };
    sectionTypes: Record<string, SectionTypeDef>;
    sectionPresets: {
        key: string;
        type: string;
        label: string;
        page: string;
        image: string;
        data: SectionData;
    }[];
    storageUrl: string;
    aiEnabled: boolean;
}>();

defineOptions({
    layout: {
        breadcrumbs: [{ title: 'Halaman', href: pagesIndex() }],
    },
});

const form = useForm<PageForm>({
    title: props.page.title,
    slug: props.page.slug,
    in_menu: props.page.in_menu,
    published: props.page.published,
    meta_title: props.page.meta_title,
    meta_description: props.page.meta_description,
    sections: props.page.sections,
});

const open = ref<Set<string>>(new Set());
const picker = ref(false);
const pickerTab = ref<'presets' | 'blank'>(
    props.sectionPresets.length ? 'presets' : 'blank',
);
const showSettings = ref(false);
const assistantOpen = ref(false);
const previewOpen = ref(false);

function applyFromAi(sections: Section[]): void {
    const before = new Set(form.sections.map((s) => s.id));
    form.sections = sections;
    // Open the sections the AI added so the owner sees them.
    open.value = new Set([
        ...open.value,
        ...sections.filter((s) => !before.has(s.id)).map((s) => s.id),
    ]);
}

const sectionErrors = computed(() => {
    const errors: Record<number, string> = {};

    Object.entries(form.errors).forEach(([key, message]) => {
        const match = key.match(/^sections\.(\d+)/);

        if (match) {
            errors[Number(match[1])] = message as string;
        }
    });

    return errors;
});

function newId(): string {
    return Math.random().toString(36).slice(2, 12);
}

function blankData(type: string): SectionData {
    const fields = props.sectionTypes[type].fields;

    return Object.fromEntries(
        Object.entries(fields).map(([key, f]) => [
            key,
            f.type === 'items' ? [] : (f.default ?? ''),
        ]),
    );
}

function toggle(id: string): void {
    const next = new Set(open.value);

    if (next.has(id)) {
        next.delete(id);
    } else {
        next.add(id);
    }

    open.value = next;
}

function addPreset(preset: { type: string; data: SectionData }): void {
    const section = {
        id: newId(),
        type: preset.type,
        data: JSON.parse(JSON.stringify(preset.data)) as SectionData,
    };
    form.sections = [...form.sections, section];
    open.value = new Set([...open.value, section.id]);
    picker.value = false;
}

function addSection(type: string): void {
    const section = { id: newId(), type, data: blankData(type) };
    form.sections = [...form.sections, section];
    open.value = new Set([...open.value, section.id]);
    picker.value = false;
}

function move(index: number, by: number): void {
    const list = [...form.sections];
    const [item] = list.splice(index, 1);
    list.splice(index + by, 0, item);
    form.sections = list;
}

function duplicate(index: number): void {
    const copy = JSON.parse(JSON.stringify(form.sections[index])) as Section;
    copy.id = newId();
    const list = [...form.sections];
    list.splice(index + 1, 0, copy);
    form.sections = list;
}

function remove(index: number): void {
    if (confirm('Hapus section ini?')) {
        form.sections = form.sections.filter((_, i) => i !== index);
    }
}

function setField(
    index: number,
    key: string,
    value: SectionValue | undefined,
): void {
    form.sections[index].data = {
        ...form.sections[index].data,
        [key]: value ?? '',
    };
}

function summary(section: Section): string {
    const title = section.data.title;

    return typeof title === 'string' && title !== '' ? title : '';
}

function submit(): void {
    form.put(update.url(props.page.id), { preserveScroll: true });
}
</script>

<template>
    <Head :title="form.title" />

    <form
        class="mx-auto flex w-full max-w-3xl flex-col gap-6 p-4"
        @submit.prevent="submit"
    >
        <div class="flex flex-wrap items-start justify-between gap-4">
            <div class="min-w-0">
                <h1 class="truncate text-xl font-semibold tracking-tight">
                    {{ form.title || 'Halaman tanpa judul' }}
                </h1>
                <p class="text-sm text-muted-foreground">
                    {{ page.is_home ? 'Halaman beranda' : `/${form.slug}` }}
                    · {{ form.sections.length }} section
                </p>
            </div>
            <div class="flex flex-wrap gap-2">
                <Button
                    type="button"
                    variant="outline"
                    size="sm"
                    @click="previewOpen = true"
                >
                    <Eye class="size-4" />
                    Pratinjau
                </Button>
                <Button as-child variant="outline" size="sm">
                    <a :href="page.url" target="_blank" rel="noopener">
                        <ExternalLink class="size-4" />
                        Lihat halaman
                    </a>
                </Button>
                <Button type="button" size="sm" @click="assistantOpen = true">
                    <Sparkles class="size-4" />
                    Asisten AI
                </Button>
            </div>
        </div>

        <Card>
            <CardHeader
                class="cursor-pointer"
                @click="showSettings = !showSettings"
            >
                <div class="flex items-center justify-between">
                    <div>
                        <CardTitle>Pengaturan halaman</CardTitle>
                        <CardDescription>
                            Judul, alamat, menu, dan SEO.
                        </CardDescription>
                    </div>
                    <ChevronDown
                        class="size-5 transition"
                        :class="{ 'rotate-180': showSettings }"
                    />
                </div>
            </CardHeader>
            <CardContent v-show="showSettings" class="grid gap-5">
                <div class="grid gap-5 sm:grid-cols-2">
                    <div class="grid gap-2">
                        <Label for="title">Judul (tampil di menu)</Label>
                        <Input id="title" v-model="form.title" required />
                        <InputError :message="form.errors.title" />
                    </div>
                    <div class="grid gap-2">
                        <Label for="slug">Alamat halaman</Label>
                        <div class="flex items-center">
                            <span
                                class="flex h-9 items-center rounded-l-md border border-r-0 bg-muted px-3 text-sm text-muted-foreground"
                                >/</span
                            >
                            <Input
                                id="slug"
                                v-model="form.slug"
                                class="rounded-l-none"
                                required
                            />
                        </div>
                        <InputError :message="form.errors.slug" />
                    </div>
                </div>
                <div class="flex flex-wrap gap-6">
                    <label class="flex items-center gap-2 text-sm">
                        <input
                            v-model="form.in_menu"
                            type="checkbox"
                            class="size-4 accent-primary"
                        />
                        Tampilkan di menu
                    </label>
                    <label
                        class="flex items-center gap-2 text-sm"
                        :class="{ 'opacity-50': page.is_home }"
                    >
                        <input
                            v-model="form.published"
                            type="checkbox"
                            class="size-4 accent-primary"
                            :disabled="page.is_home"
                        />
                        Terbit (bisa dilihat pengunjung)
                    </label>
                </div>
                <div class="grid gap-2">
                    <Label for="meta_title">Judul SEO (opsional)</Label>
                    <Input
                        id="meta_title"
                        v-model="form.meta_title"
                        maxlength="150"
                        placeholder="Judul di hasil pencarian Google"
                    />
                </div>
                <div class="grid gap-2">
                    <Label for="meta_description"
                        >Deskripsi SEO (opsional)</Label
                    >
                    <Textarea
                        id="meta_description"
                        v-model="form.meta_description"
                        maxlength="300"
                        rows="2"
                    />
                    <InputError :message="form.errors.meta_description" />
                </div>
            </CardContent>
        </Card>

        <div class="grid gap-3">
            <div
                v-for="(section, index) in form.sections"
                :key="section.id"
                class="rounded-xl border bg-card"
                :class="{ 'border-destructive': sectionErrors[index] }"
            >
                <div class="flex items-center gap-2 p-3 pl-4">
                    <button
                        type="button"
                        class="flex min-w-0 flex-1 items-center gap-3 text-left"
                        @click="toggle(section.id)"
                    >
                        <span
                            class="flex size-7 shrink-0 items-center justify-center rounded-md bg-muted text-xs font-semibold"
                            >{{ index + 1 }}</span
                        >
                        <span class="min-w-0">
                            <span class="block text-sm font-medium">
                                {{
                                    sectionTypes[section.type]?.label ??
                                    section.type
                                }}
                            </span>
                            <span
                                v-if="summary(section)"
                                class="block truncate text-xs text-muted-foreground"
                                >{{ summary(section) }}</span
                            >
                        </span>
                    </button>
                    <div class="flex shrink-0 gap-1">
                        <Button
                            type="button"
                            variant="ghost"
                            size="icon"
                            class="size-8"
                            :disabled="index === 0"
                            aria-label="Naikkan"
                            @click="move(index, -1)"
                        >
                            <ArrowUp class="size-4" />
                        </Button>
                        <Button
                            type="button"
                            variant="ghost"
                            size="icon"
                            class="size-8"
                            :disabled="index === form.sections.length - 1"
                            aria-label="Turunkan"
                            @click="move(index, 1)"
                        >
                            <ArrowDown class="size-4" />
                        </Button>
                        <Button
                            type="button"
                            variant="ghost"
                            size="icon"
                            class="size-8"
                            aria-label="Duplikat"
                            @click="duplicate(index)"
                        >
                            <Copy class="size-4" />
                        </Button>
                        <Button
                            type="button"
                            variant="ghost"
                            size="icon"
                            class="size-8"
                            aria-label="Hapus"
                            @click="remove(index)"
                        >
                            <Trash2 class="size-4" />
                        </Button>
                        <Button
                            type="button"
                            variant="ghost"
                            size="icon"
                            class="size-8"
                            aria-label="Buka"
                            @click="toggle(section.id)"
                        >
                            <ChevronDown
                                class="size-4 transition"
                                :class="{
                                    'rotate-180': open.has(section.id),
                                }"
                            />
                        </Button>
                    </div>
                </div>
                <div
                    v-if="open.has(section.id) && sectionTypes[section.type]"
                    class="grid gap-4 border-t p-4"
                >
                    <FieldInput
                        v-for="(field, key) in sectionTypes[section.type]
                            .fields"
                        :key="key"
                        :field="field"
                        :name="`${section.id}-${key}`"
                        :storage-url="storageUrl"
                        :model-value="section.data[key]"
                        @update:model-value="
                            (v) => setField(index, String(key), v)
                        "
                    />
                    <InputError :message="sectionErrors[index]" />
                </div>
            </div>

            <Button
                type="button"
                variant="outline"
                class="border-dashed"
                @click="picker = true"
            >
                <Plus class="size-4" />
                Tambah section
            </Button>
        </div>

        <div
            class="sticky bottom-0 -mx-4 flex items-center justify-between gap-3 border-t bg-background/95 px-4 py-3 backdrop-blur"
        >
            <Link
                :href="pagesIndex()"
                class="text-sm text-muted-foreground hover:underline"
            >
                &larr; Semua halaman
            </Link>
            <div class="flex items-center gap-3">
                <span v-if="form.isDirty" class="text-xs text-muted-foreground"
                    >Ada perubahan belum disimpan</span
                >
                <Button type="submit" :disabled="form.processing">
                    <Spinner v-if="form.processing" />
                    Simpan halaman
                </Button>
            </div>
        </div>
    </form>

    <AssistantPanel
        v-model:open="assistantOpen"
        :page-id="page.id"
        :page-title="form.title"
        :sections="form.sections"
        :enabled="aiEnabled"
        @apply="applyFromAi"
    />

    <PreviewDialog
        v-model:open="previewOpen"
        :page-id="page.id"
        :sections="form.sections"
        title="Pratinjau (belum disimpan)"
    />

    <Dialog v-model:open="picker">
        <DialogContent class="max-h-[85vh] overflow-y-auto sm:max-w-2xl">
            <DialogHeader>
                <DialogTitle>Tambah section</DialogTitle>
                <DialogDescription>
                    Pakai contoh yang sudah terisi dari template Anda, atau
                    mulai dari blok kosong.
                </DialogDescription>
            </DialogHeader>
            <div
                v-if="sectionPresets.length"
                class="inline-flex w-fit rounded-full bg-muted p-1 text-sm"
                role="tablist"
            >
                <button
                    type="button"
                    role="tab"
                    :aria-selected="pickerTab === 'presets'"
                    class="rounded-full px-4 py-1.5 font-medium transition"
                    :class="
                        pickerTab === 'presets'
                            ? 'bg-background shadow-sm'
                            : 'text-muted-foreground'
                    "
                    @click="pickerTab = 'presets'"
                >
                    Contoh siap pakai
                </button>
                <button
                    type="button"
                    role="tab"
                    :aria-selected="pickerTab === 'blank'"
                    class="rounded-full px-4 py-1.5 font-medium transition"
                    :class="
                        pickerTab === 'blank'
                            ? 'bg-background shadow-sm'
                            : 'text-muted-foreground'
                    "
                    @click="pickerTab = 'blank'"
                >
                    Blok kosong
                </button>
            </div>
            <div
                v-if="pickerTab === 'presets' && sectionPresets.length"
                class="grid gap-3 sm:grid-cols-2"
            >
                <button
                    v-for="preset in sectionPresets"
                    :key="preset.key"
                    type="button"
                    class="flex gap-3 rounded-lg border p-3 text-left transition hover:border-primary hover:bg-muted/50"
                    @click="addPreset(preset)"
                >
                    <img
                        v-if="preset.image"
                        :src="`${storageUrl}/${preset.image}`"
                        alt=""
                        class="size-16 shrink-0 rounded-md object-cover"
                        loading="lazy"
                    />
                    <span
                        v-else
                        class="flex size-16 shrink-0 items-center justify-center rounded-md bg-primary/10 text-xs font-semibold text-primary"
                        >{{
                            sectionTypes[preset.type]?.label.split(' ')[0]
                        }}</span
                    >
                    <span class="min-w-0">
                        <span class="line-clamp-2 font-medium">{{
                            preset.label
                        }}</span>
                        <span class="mt-1 block text-xs text-muted-foreground"
                            >{{ sectionTypes[preset.type]?.label }} · dari
                            {{ preset.page }}</span
                        >
                    </span>
                </button>
            </div>
            <div v-else class="grid gap-3 sm:grid-cols-2">
                <button
                    v-for="(type, key) in sectionTypes"
                    :key="key"
                    type="button"
                    class="rounded-lg border p-4 text-left transition hover:border-primary hover:bg-muted/50"
                    @click="addSection(String(key))"
                >
                    <div class="font-medium">{{ type.label }}</div>
                    <div class="mt-1 text-sm text-muted-foreground">
                        {{ type.description }}
                    </div>
                </button>
            </div>
        </DialogContent>
    </Dialog>
</template>
