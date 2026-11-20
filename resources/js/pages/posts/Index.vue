<script setup lang="ts">
import { Head, Link, router, useForm } from '@inertiajs/vue3';
import {
    ExternalLink,
    ImageOff,
    Newspaper,
    Pencil,
    Plus,
    Search,
    Settings2,
    Trash2,
} from '@lucide/vue';
import { ref, watch } from 'vue';
import InputError from '@/components/InputError.vue';
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
import StatusBadge from '@/components/posts/StatusBadge.vue';
import type { PostState } from '@/components/posts/StatusBadge.vue';
import {
    destroy,
    edit,
    index as postsIndex,
    settings as settingsRoute,
    store,
} from '@/routes/posts';

type PostRow = {
    id: number;
    title: string;
    slug: string;
    url: string;
    state: PostState;
    category: string | null;
    cover_url: string | null;
    date: string;
};

const props = defineProps<{
    posts: {
        data: PostRow[];
        links: { url: string | null; label: string; active: boolean }[];
        last_page: number;
        total: number;
    };
    filters: { q: string; status: string };
    counts: Record<'all' | PostState, number>;
    settings: { blog_menu: boolean; blog_title: string };
    blogUrl: string;
}>();

defineOptions({
    layout: {
        breadcrumbs: [{ title: 'Blog', href: postsIndex() }],
    },
});

const tabs: { key: '' | PostState; label: string }[] = [
    { key: '', label: 'Semua' },
    { key: 'published', label: 'Terbit' },
    { key: 'scheduled', label: 'Terjadwal' },
    { key: 'draft', label: 'Draf' },
];

const search = ref(props.filters.q);
let searchTimer: ReturnType<typeof setTimeout> | undefined;

function filter(status: string, q: string = search.value): void {
    router.get(
        postsIndex.url(),
        { ...(q ? { q } : {}), ...(status ? { status } : {}) },
        { preserveState: true, preserveScroll: true, replace: true },
    );
}

watch(search, (q) => {
    clearTimeout(searchTimer);
    searchTimer = setTimeout(() => filter(props.filters.status, q), 350);
});

const creating = ref(false);

function create(): void {
    creating.value = true;
    router.post(store.url(), {}, { onFinish: () => (creating.value = false) });
}

function remove(post: PostRow): void {
    if (
        confirm(
            `Hapus tulisan "${post.title}"? Tindakan ini tidak bisa dibatalkan.`,
        )
    ) {
        router.delete(destroy.url(post.id), { preserveScroll: true });
    }
}

function pageLabel(label: string): string {
    return label
        .replace('&laquo; Previous', '‹')
        .replace('Next &raquo;', '›')
        .replace(/&[a-z]+;/g, '');
}

const settingsOpen = ref(false);
const settingsForm = useForm({ ...props.settings });

function saveSettings(): void {
    settingsForm.put(settingsRoute.url(), {
        preserveScroll: true,
        onSuccess: () => (settingsOpen.value = false),
    });
}
</script>

<template>
    <Head title="Blog" />

    <div class="mx-auto flex w-full max-w-5xl flex-col gap-6 p-4 md:p-6">
        <div class="flex flex-wrap items-end justify-between gap-4">
            <div>
                <h1 class="text-xl font-semibold tracking-tight">Blog</h1>
                <p class="text-sm text-muted-foreground">
                    Berita, kegiatan, dan artikel di
                    <a
                        :href="blogUrl"
                        target="_blank"
                        rel="noopener"
                        class="font-medium underline-offset-2 hover:underline"
                        >{{ blogUrl.replace(/^https?:\/\//, '') }}</a
                    >
                </p>
            </div>
            <div class="flex flex-wrap gap-2">
                <Button variant="outline" @click="settingsOpen = true">
                    <Settings2 class="size-4" />
                    Pengaturan
                </Button>
                <Button :disabled="creating" @click="create">
                    <Plus class="size-4" />
                    Tulis baru
                </Button>
            </div>
        </div>

        <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
            <div
                class="inline-flex w-full overflow-x-auto rounded-full bg-muted p-1 text-sm sm:w-auto"
                role="tablist"
                aria-label="Saring status"
            >
                <button
                    v-for="tab in tabs"
                    :key="tab.key"
                    type="button"
                    role="tab"
                    :aria-selected="filters.status === tab.key"
                    class="shrink-0 rounded-full px-3.5 py-1.5 font-medium whitespace-nowrap transition"
                    :class="
                        filters.status === tab.key
                            ? 'bg-background shadow-sm'
                            : 'text-muted-foreground hover:text-foreground'
                    "
                    @click="filter(tab.key)"
                >
                    {{ tab.label }}
                    <span class="ml-0.5 text-xs text-muted-foreground">{{
                        counts[tab.key || 'all']
                    }}</span>
                </button>
            </div>
            <div class="relative sm:ml-auto sm:w-64">
                <Search
                    class="pointer-events-none absolute top-1/2 left-3 size-4 -translate-y-1/2 text-muted-foreground"
                />
                <Input
                    v-model="search"
                    type="search"
                    placeholder="Cari judul atau kategori"
                    aria-label="Cari tulisan"
                    class="pl-9"
                />
            </div>
        </div>

        <div
            v-if="!posts.data.length"
            class="flex flex-col items-center gap-3 rounded-2xl border border-dashed px-6 py-14 text-center"
        >
            <span
                class="flex size-12 items-center justify-center rounded-full bg-primary/10 text-primary"
                ><Newspaper class="size-6"
            /></span>
            <template v-if="counts.all === 0">
                <p class="font-medium">Belum ada tulisan</p>
                <p class="max-w-sm text-sm text-muted-foreground">
                    Bagikan kabar, kegiatan, atau tips untuk pelanggan Anda.
                    Tulisan yang terbit tampil di halaman Blog website.
                </p>
                <Button class="mt-2" :disabled="creating" @click="create">
                    <Plus class="size-4" />
                    Tulis tulisan pertama
                </Button>
            </template>
            <p v-else class="text-sm text-muted-foreground">
                Tidak ada tulisan yang cocok.
            </p>
        </div>

        <ul v-else class="flex flex-col gap-3">
            <li
                v-for="post in posts.data"
                :key="post.id"
                class="flex items-center gap-3 rounded-2xl border bg-card p-3 transition hover:border-primary/30 hover:shadow-sm sm:gap-4"
            >
                <Link
                    :href="edit(post.id)"
                    class="flex aspect-[4/3] w-20 shrink-0 items-center justify-center overflow-hidden rounded-lg border bg-muted/50 sm:w-28"
                    :aria-label="`Edit ${post.title}`"
                >
                    <img
                        v-if="post.cover_url"
                        :src="post.cover_url"
                        alt=""
                        loading="lazy"
                        class="size-full object-cover"
                    />
                    <ImageOff v-else class="size-5 text-muted-foreground" />
                </Link>
                <div class="min-w-0 flex-1">
                    <Link
                        :href="edit(post.id)"
                        class="line-clamp-2 font-semibold hover:underline"
                        >{{ post.title }}</Link
                    >
                    <div
                        class="mt-1.5 flex flex-wrap items-center gap-x-2.5 gap-y-1 text-xs text-muted-foreground"
                    >
                        <StatusBadge :state="post.state" />
                        <span>{{ post.date }}</span>
                        <span v-if="post.category">· {{ post.category }}</span>
                    </div>
                </div>
                <div class="flex shrink-0 flex-col gap-1.5 sm:flex-row">
                    <Button as-child size="sm" class="hidden sm:inline-flex">
                        <Link :href="edit(post.id)"
                            ><Pencil class="size-4" />Edit</Link
                        >
                    </Button>
                    <Button
                        as-child
                        variant="outline"
                        size="icon"
                        class="size-9"
                        :title="
                            post.state === 'published'
                                ? 'Lihat tulisan'
                                : 'Pratinjau tulisan'
                        "
                    >
                        <a
                            :href="post.url"
                            target="_blank"
                            rel="noopener"
                            :aria-label="
                                post.state === 'published'
                                    ? 'Lihat tulisan'
                                    : 'Pratinjau tulisan'
                            "
                            ><ExternalLink class="size-4"
                        /></a>
                    </Button>
                    <Button
                        variant="outline"
                        size="icon"
                        class="size-9 text-muted-foreground hover:text-destructive"
                        aria-label="Hapus"
                        title="Hapus tulisan"
                        @click="remove(post)"
                    >
                        <Trash2 class="size-4" />
                    </Button>
                </div>
            </li>
        </ul>

        <div v-if="posts.last_page > 1" class="flex flex-wrap gap-1">
            <template v-for="link in posts.links" :key="link.label">
                <Button
                    v-if="link.url"
                    as-child
                    size="sm"
                    :variant="link.active ? 'default' : 'outline'"
                >
                    <Link :href="link.url" preserve-scroll>{{
                        pageLabel(link.label)
                    }}</Link>
                </Button>
            </template>
        </div>
    </div>

    <Dialog v-model:open="settingsOpen">
        <DialogContent class="sm:max-w-md">
            <DialogHeader>
                <DialogTitle>Pengaturan blog</DialogTitle>
                <DialogDescription>
                    Nama halaman blog dan tautannya di menu website.
                </DialogDescription>
            </DialogHeader>
            <form class="grid gap-5" @submit.prevent="saveSettings">
                <div class="grid gap-2">
                    <Label for="blog-title">Nama blog</Label>
                    <Input
                        id="blog-title"
                        v-model="settingsForm.blog_title"
                        maxlength="40"
                        required
                        placeholder="Contoh: Blog, Berita, Artikel, Kabar Desa"
                    />
                    <p class="text-xs text-muted-foreground">
                        Tampil sebagai judul halaman /blog dan nama menunya.
                    </p>
                    <InputError :message="settingsForm.errors.blog_title" />
                </div>
                <label class="flex items-start gap-2.5 text-sm">
                    <input
                        v-model="settingsForm.blog_menu"
                        type="checkbox"
                        class="mt-0.5 size-4 accent-primary"
                    />
                    <span>
                        Tampilkan di menu website
                        <span class="block text-xs text-muted-foreground"
                            >Muncul otomatis sebelum menu Kontak setelah ada
                            tulisan yang terbit.</span
                        >
                    </span>
                </label>
                <DialogFooter>
                    <Button type="submit" :disabled="settingsForm.processing"
                        >Simpan</Button
                    >
                </DialogFooter>
            </form>
        </DialogContent>
    </Dialog>
</template>
