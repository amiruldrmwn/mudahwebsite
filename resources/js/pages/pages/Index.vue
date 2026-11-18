<script setup lang="ts">
import { Head, Link, router, useForm } from '@inertiajs/vue3';
import {
    ArrowDown,
    ArrowUp,
    ExternalLink,
    FileText,
    House,
    Info,
    Pencil,
    Plus,
    Trash2,
} from '@lucide/vue';
import { computed, ref } from 'vue';
import DesktopPreview from '@/components/themes/DesktopPreview.vue';
import InputError from '@/components/InputError.vue';
import { Badge } from '@/components/ui/badge';
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
import {
    destroy,
    edit,
    home,
    index as pagesIndex,
    reorder,
    store,
} from '@/routes/pages';

type PageRow = {
    id: number;
    title: string;
    slug: string;
    url: string;
    is_home: boolean;
    in_menu: boolean;
    published: boolean;
    sections: number;
    updated_at: string | null;
};

const props = defineProps<{ pages: PageRow[]; themeLabel: string }>();

const publishedCount = computed(
    () => props.pages.filter((p) => p.published).length,
);

defineOptions({
    layout: {
        breadcrumbs: [{ title: 'Halaman', href: pagesIndex() }],
    },
});

const creating = ref(false);
const form = useForm({ title: '' });

function create(): void {
    form.post(store.url(), { onSuccess: () => (creating.value = false) });
}

function move(index: number, by: number): void {
    const ids = props.pages.map((p) => p.id);
    const [id] = ids.splice(index, 1);
    ids.splice(index + by, 0, id);
    router.post(reorder.url(), { ids }, { preserveScroll: true });
}

function makeHome(page: PageRow): void {
    router.post(home.url(page.id), {}, { preserveScroll: true });
}

function remove(page: PageRow): void {
    if (
        confirm(
            `Hapus halaman "${page.title}"? Tindakan ini tidak bisa dibatalkan.`,
        )
    ) {
        router.delete(destroy.url(page.id), { preserveScroll: true });
    }
}
</script>

<template>
    <Head title="Halaman" />

    <div class="mx-auto flex w-full max-w-5xl flex-col gap-6 p-4 md:p-6">
        <div class="flex flex-wrap items-end justify-between gap-4">
            <div>
                <h1 class="text-xl font-semibold tracking-tight">Halaman</h1>
                <p class="text-sm text-muted-foreground">
                    {{ pages.length }} halaman · {{ publishedCount }} tayang ·
                    template {{ themeLabel }}
                </p>
            </div>
            <Button @click="creating = true">
                <Plus class="size-4" />
                Halaman baru
            </Button>
        </div>

        <p
            class="flex items-start gap-2 rounded-xl border bg-muted/40 px-4 py-3 text-sm text-muted-foreground"
        >
            <Info class="mt-0.5 size-4 shrink-0 text-primary" />
            Urutan di sini sama dengan urutan menu di website. Gunakan panah
            untuk memindahkan halaman.
        </p>

        <ol class="flex flex-col gap-3">
            <li
                v-for="(page, index) in pages"
                :key="page.id"
                class="group flex flex-col gap-4 rounded-2xl border bg-card p-3 transition hover:border-primary/30 hover:shadow-md sm:flex-row sm:items-center"
            >
                <div class="flex items-center gap-3">
                    <div class="flex flex-col">
                        <Button
                            variant="ghost"
                            size="icon"
                            class="size-7"
                            :disabled="index === 0"
                            aria-label="Naikkan"
                            @click="move(index, -1)"
                        >
                            <ArrowUp class="size-4" />
                        </Button>
                        <Button
                            variant="ghost"
                            size="icon"
                            class="size-7"
                            :disabled="index === pages.length - 1"
                            aria-label="Turunkan"
                            @click="move(index, 1)"
                        >
                            <ArrowDown class="size-4" />
                        </Button>
                    </div>
                    <Link
                        :href="edit(page.id)"
                        class="relative block aspect-[16/10] w-full shrink-0 overflow-hidden rounded-xl border sm:w-44"
                        :aria-label="`Edit ${page.title}`"
                    >
                        <DesktopPreview
                            :src="page.url"
                            :title="`Pratinjau ${page.title}`"
                        />
                    </Link>
                </div>
                <div class="min-w-0 flex-1">
                    <div class="flex flex-wrap items-center gap-2">
                        <Link
                            :href="edit(page.id)"
                            class="text-base font-semibold hover:underline"
                            >{{ page.title }}</Link
                        >
                        <Badge v-if="page.is_home"
                            ><House class="size-3" />Beranda</Badge
                        >
                        <Badge v-if="!page.published" variant="outline"
                            >Draf</Badge
                        >
                        <Badge v-if="!page.in_menu" variant="outline"
                            >Tidak di menu</Badge
                        >
                    </div>
                    <div
                        class="mt-1 flex flex-wrap items-center gap-x-3 gap-y-1 text-xs text-muted-foreground"
                    >
                        <span class="font-mono">{{
                            page.is_home ? '/' : `/${page.slug}`
                        }}</span>
                        <span class="inline-flex items-center gap-1"
                            ><FileText class="size-3" />{{
                                page.sections
                            }}
                            section</span
                        >
                        <span v-if="page.updated_at"
                            >Diubah {{ page.updated_at }}</span
                        >
                    </div>
                </div>
                <div class="flex flex-wrap items-center gap-1.5">
                    <Button as-child size="sm">
                        <Link :href="edit(page.id)"
                            ><Pencil class="size-4" />Edit</Link
                        >
                    </Button>
                    <Button
                        as-child
                        variant="outline"
                        size="icon"
                        class="size-9"
                        title="Lihat halaman"
                    >
                        <a
                            :href="page.url"
                            target="_blank"
                            rel="noopener"
                            aria-label="Lihat halaman"
                            ><ExternalLink class="size-4"
                        /></a>
                    </Button>
                    <Button
                        v-if="!page.is_home"
                        variant="outline"
                        size="icon"
                        class="size-9"
                        aria-label="Jadikan beranda"
                        title="Jadikan beranda"
                        @click="makeHome(page)"
                    >
                        <House class="size-4" />
                    </Button>
                    <Button
                        v-if="!page.is_home"
                        variant="outline"
                        size="icon"
                        class="size-9 text-muted-foreground hover:text-destructive"
                        aria-label="Hapus"
                        title="Hapus halaman"
                        @click="remove(page)"
                    >
                        <Trash2 class="size-4" />
                    </Button>
                </div>
            </li>
        </ol>
    </div>

    <Dialog v-model:open="creating">
        <DialogContent>
            <form class="grid gap-4" @submit.prevent="create">
                <DialogHeader>
                    <DialogTitle>Halaman baru</DialogTitle>
                    <DialogDescription>
                        Beri judul, lalu isi section-nya di halaman berikutnya.
                    </DialogDescription>
                </DialogHeader>
                <div class="grid gap-2">
                    <Label for="new-title">Judul halaman</Label>
                    <Input
                        id="new-title"
                        v-model="form.title"
                        required
                        placeholder="Contoh: Layanan, Proyek, Karier"
                    />
                    <InputError :message="form.errors.title" />
                </div>
                <DialogFooter>
                    <Button type="submit" :disabled="form.processing"
                        >Buat halaman</Button
                    >
                </DialogFooter>
            </form>
        </DialogContent>
    </Dialog>
</template>
