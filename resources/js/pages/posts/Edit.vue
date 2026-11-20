<script setup lang="ts">
import { Head, Link, router, useForm } from '@inertiajs/vue3';
import {
    ArrowLeft,
    CalendarClock,
    Check,
    ExternalLink,
    Eye,
    Trash2,
} from '@lucide/vue';
import {
    computed,
    nextTick,
    onBeforeUnmount,
    onMounted,
    ref,
    watch,
} from 'vue';
import InputError from '@/components/InputError.vue';
import RichEditor from '@/components/posts/RichEditor.vue';
import StatusBadge from '@/components/posts/StatusBadge.vue';
import type { PostState } from '@/components/posts/StatusBadge.vue';
import ImageField from '@/components/sections/ImageField.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Spinner } from '@/components/ui/spinner';
import { Textarea } from '@/components/ui/textarea';
import { post as httpPost } from '@/lib/http';
import {
    autosave as autosaveRoute,
    destroy,
    index as postsIndex,
    update,
} from '@/routes/posts';

type PostForm = {
    title: string;
    slug: string;
    excerpt: string;
    body: string;
    cover: string;
    category: string;
    status: 'draft' | 'published';
    published_at: string;
    meta_title: string;
    meta_description: string;
};

const props = defineProps<{
    post: PostForm & {
        id: number;
        state: PostState;
        url: string;
        ever_published: boolean;
        updated_at: string | null;
    };
    categories: string[];
    storageUrl: string;
    blogUrl: string;
    siteName: string;
}>();

defineOptions({
    layout: {
        breadcrumbs: [{ title: 'Blog', href: postsIndex() }],
    },
});

/** ISO time from the server → the value of a datetime-local input, in the browser's time zone. */
function toLocalInput(iso: string): string {
    if (!iso) {
        return '';
    }

    const d = new Date(iso);
    const pad = (n: number) => String(n).padStart(2, '0');

    return `${d.getFullYear()}-${pad(d.getMonth() + 1)}-${pad(d.getDate())}T${pad(d.getHours())}:${pad(d.getMinutes())}`;
}

const form = useForm<PostForm>({
    title: props.post.title,
    slug: props.post.slug,
    excerpt: props.post.excerpt,
    body: props.post.body,
    cover: props.post.cover,
    category: props.post.category,
    status: props.post.status,
    published_at: toLocalInput(props.post.published_at),
    meta_title: props.post.meta_title,
    meta_description: props.post.meta_description,
});

const words = ref(0);
const isPublished = computed(() => props.post.state !== 'draft');
const scheduledFuture = computed(
    () =>
        !!form.published_at &&
        new Date(form.published_at).getTime() > Date.now(),
);

// The slug follows the title until the post is published or the owner sets their own.
function slugify(text: string): string {
    return text
        .normalize('NFKD')
        .replace(/[̀-ͯ]/g, '')
        .toLowerCase()
        .replace(/[^a-z0-9]+/g, '-')
        .replace(/^-+|-+$/g, '')
        .slice(0, 80)
        .replace(/-+$/, '');
}

const slugFollows = ref(
    !props.post.ever_published &&
        (/^tulisan-[a-z0-9]{6}(-\d+)?$/.test(props.post.slug) ||
            props.post.slug === slugify(props.post.title)),
);

watch(
    () => form.title,
    (title) => {
        if (slugFollows.value && slugify(title)) {
            form.slug = slugify(title);
        }
    },
);

// The big title grows with its text.
const titleEl = ref<HTMLTextAreaElement | null>(null);

function fitTitle(): void {
    const el = titleEl.value;

    if (el) {
        el.style.height = 'auto';
        el.style.height = `${el.scrollHeight}px`;
    }
}

watch(
    () => form.title,
    () => nextTick(fitTitle),
);

// Saving
let submitting = false;

function save(status: 'draft' | 'published'): void {
    form.status = status;
    submitting = true;
    form.transform((data) => ({
        ...data,
        slug_auto: slugFollows.value,
        published_at: data.published_at
            ? new Date(data.published_at).toISOString()
            : '',
    })).put(update.url(props.post.id), {
        preserveScroll: true,
        onSuccess: () => {
            form.slug = props.post.slug;
            form.defaults();
            autosaved.value = '';
        },
        onFinish: () => (submitting = false),
    });
}

const primaryLabel = computed(() => {
    if (isPublished.value) {
        return scheduledFuture.value ? 'Simpan jadwal' : 'Perbarui';
    }

    return scheduledFuture.value ? 'Jadwalkan' : 'Terbitkan';
});

function remove(): void {
    if (
        confirm(
            `Hapus tulisan "${form.title || 'tanpa judul'}"? Tindakan ini tidak bisa dibatalkan.`,
        )
    ) {
        submitting = true;
        router.delete(destroy.url(props.post.id));
    }
}

// Autosave: drafts save themselves a few seconds after the owner stops typing.
const autosaving = ref(false);
const autosaved = ref('');
const autosaveError = ref('');
let autosaveTimer: ReturnType<typeof setTimeout> | undefined;

async function autosave(): Promise<void> {
    if (isPublished.value || !form.isDirty || form.processing) {
        return;
    }

    autosaving.value = true;
    autosaveError.value = '';
    const sent = { ...form.data() };

    try {
        const response = await httpPost(autosaveRoute.url(props.post.id), {
            ...sent,
            slug_auto: slugFollows.value,
        });
        const json = (await response.json()) as { slug?: string };

        if (json.slug && json.slug !== form.slug) {
            sent.slug = json.slug;
            form.slug = json.slug;
        }

        // Only what was sent counts as saved; typing during the request stays unsaved.
        if (JSON.stringify(sent) === JSON.stringify(form.data())) {
            form.defaults();
        }

        autosaved.value = new Date().toLocaleTimeString('id-ID', {
            hour: '2-digit',
            minute: '2-digit',
        });
    } catch (e) {
        autosaveError.value = (e as Error).message;
    } finally {
        autosaving.value = false;
    }
}

watch(
    () => form.data(),
    () => {
        if (isPublished.value) {
            return;
        }

        clearTimeout(autosaveTimer);
        autosaveTimer = setTimeout(autosave, 4000);
    },
    { deep: true },
);

// Leaving with unsaved changes asks first.
function beforeUnload(event: BeforeUnloadEvent): void {
    if (form.isDirty) {
        event.preventDefault();
    }
}

let removeRouterGuard: (() => void) | undefined;

onMounted(() => {
    fitTitle();
    window.addEventListener('beforeunload', beforeUnload);
    removeRouterGuard = router.on('before', (event) => {
        if (
            !submitting &&
            form.isDirty &&
            event.detail.visit.method === 'get' &&
            !confirm(
                'Ada perubahan yang belum disimpan. Tinggalkan halaman ini?',
            )
        ) {
            event.preventDefault();
        }
    });
});

onBeforeUnmount(() => {
    clearTimeout(autosaveTimer);
    window.removeEventListener('beforeunload', beforeUnload);
    removeRouterGuard?.();
});

const saveState = computed(() => {
    if (form.processing || autosaving.value) {
        return 'Menyimpan…';
    }

    if (autosaveError.value) {
        return `Gagal simpan otomatis: ${autosaveError.value}`;
    }

    if (form.isDirty) {
        return 'Belum disimpan';
    }

    return autosaved.value ? `Tersimpan ${autosaved.value}` : 'Tersimpan';
});

// Google snippet preview
const plainBody = computed(() =>
    form.body
        .replace(/<[^>]+>/g, ' ')
        .replace(/&nbsp;/g, ' ')
        .replace(/\s+/g, ' ')
        .trim(),
);

function cut(text: string, max: number): string {
    return text.length > max ? `${text.slice(0, max - 1).trimEnd()}…` : text;
}

const snippetTitle = computed(() =>
    cut(
        form.meta_title ||
            `${form.title || 'Judul tulisan'} | ${props.siteName}`,
        60,
    ),
);
const snippetDescription = computed(() =>
    cut(
        form.meta_description ||
            form.excerpt ||
            plainBody.value ||
            'Deskripsi tulisan di hasil pencarian Google.',
        158,
    ),
);
const snippetUrl = computed(() => {
    const host = props.blogUrl.replace(/^https?:\/\//, '');

    return `${host.replace('/blog', '')} › blog › ${form.slug}`;
});
</script>

<template>
    <Head :title="form.title || 'Tulisan baru'" />

    <div class="mx-auto flex w-full max-w-6xl flex-col p-4 md:p-6">
        <!-- Action bar -->
        <div
            class="sticky top-0 z-30 -mx-4 mb-4 flex h-14 items-center gap-2 border-b bg-background/95 px-4 backdrop-blur sm:gap-3 md:-mx-6 md:px-6"
        >
            <Link
                :href="postsIndex()"
                class="inline-flex items-center gap-1.5 text-sm text-muted-foreground hover:text-foreground"
            >
                <ArrowLeft class="size-4" />
                <span class="hidden sm:inline">Semua tulisan</span>
            </Link>
            <StatusBadge :state="post.state" class="hidden sm:inline-flex" />
            <span
                class="min-w-0 truncate text-xs"
                :class="
                    autosaveError ? 'text-destructive' : 'text-muted-foreground'
                "
                :title="autosaveError"
                aria-live="polite"
            >
                {{ saveState }}
            </span>
            <div class="ml-auto flex shrink-0 items-center gap-1.5 sm:gap-2">
                <Button as-child variant="ghost" size="sm">
                    <a :href="post.url" target="_blank" rel="noopener">
                        <component
                            :is="isPublished ? ExternalLink : Eye"
                            class="size-4"
                        />
                        <span class="hidden sm:inline">{{
                            post.state === 'published' ? 'Lihat' : 'Pratinjau'
                        }}</span>
                    </a>
                </Button>
                <Button
                    v-if="!isPublished"
                    variant="outline"
                    size="sm"
                    :disabled="form.processing"
                    @click="save('draft')"
                >
                    Simpan draf
                </Button>
                <Button
                    size="sm"
                    :disabled="form.processing"
                    @click="save('published')"
                >
                    <Spinner v-if="form.processing" />
                    <CalendarClock v-else-if="scheduledFuture" class="size-4" />
                    <Check v-else class="size-4" />
                    {{ primaryLabel }}
                </Button>
            </div>
        </div>

        <div class="grid gap-6 lg:grid-cols-[minmax(0,1fr)_20rem]">
            <!-- Writing -->
            <div class="flex min-w-0 flex-col gap-4">
                <div>
                    <label for="post-title" class="sr-only">Judul</label>
                    <textarea
                        id="post-title"
                        ref="titleEl"
                        v-model="form.title"
                        rows="1"
                        maxlength="200"
                        placeholder="Tambahkan judul"
                        class="w-full resize-none overflow-hidden border-0 bg-transparent p-0 text-3xl leading-tight font-bold tracking-tight outline-none placeholder:text-muted-foreground/60 sm:text-4xl"
                        @keydown.enter.prevent
                    />
                    <InputError :message="form.errors.title" />
                </div>
                <RichEditor v-model="form.body" @words="(n) => (words = n)" />
                <div
                    class="flex flex-wrap justify-between gap-2 text-xs text-muted-foreground"
                >
                    <span
                        >{{ words.toLocaleString('id-ID') }} kata · ±{{
                            Math.max(1, Math.ceil(words / 200))
                        }}
                        menit baca</span
                    >
                    <InputError :message="form.errors.body" />
                </div>
            </div>

            <!-- Side panel -->
            <aside class="flex min-w-0 flex-col gap-4">
                <section class="rounded-xl border bg-card p-4">
                    <h2 class="mb-3 text-sm font-semibold">Terbit</h2>
                    <div class="grid gap-3 text-sm">
                        <div class="flex items-center justify-between gap-2">
                            <span class="text-muted-foreground">Status</span>
                            <StatusBadge :state="post.state" />
                        </div>
                        <div class="grid gap-1.5">
                            <Label for="published_at">Waktu terbit</Label>
                            <Input
                                id="published_at"
                                v-model="form.published_at"
                                type="datetime-local"
                            />
                            <p class="text-xs text-muted-foreground">
                                {{
                                    form.published_at
                                        ? scheduledFuture
                                            ? 'Tulisan tampil otomatis pada waktu ini.'
                                            : 'Tanggal yang ditampilkan di tulisan.'
                                        : 'Kosongkan untuk terbit sekarang. Isi tanggal nanti untuk menjadwalkan.'
                                }}
                            </p>
                            <InputError :message="form.errors.published_at" />
                        </div>
                        <div class="flex flex-wrap gap-2 pt-1">
                            <Button
                                v-if="isPublished"
                                variant="outline"
                                size="sm"
                                :disabled="form.processing"
                                @click="save('draft')"
                            >
                                Jadikan draf
                            </Button>
                            <Button
                                variant="ghost"
                                size="sm"
                                class="text-destructive hover:text-destructive"
                                @click="remove"
                            >
                                <Trash2 class="size-4" />
                                Hapus
                            </Button>
                        </div>
                    </div>
                </section>

                <section class="rounded-xl border bg-card p-4">
                    <h2 class="mb-3 text-sm font-semibold">Gambar sampul</h2>
                    <ImageField
                        v-model="form.cover"
                        :storage-url="storageUrl"
                    />
                    <img
                        v-if="form.cover"
                        :src="`${storageUrl}/${form.cover}`"
                        alt=""
                        class="mt-3 aspect-video w-full rounded-lg border object-cover"
                    />
                    <p class="mt-2 text-xs text-muted-foreground">
                        Tampil di atas tulisan, di daftar blog, dan saat link
                        dibagikan ke WhatsApp atau Facebook.
                    </p>
                    <InputError :message="form.errors.cover" />
                </section>

                <section
                    class="grid grid-cols-1 gap-4 rounded-xl border bg-card p-4"
                >
                    <div class="grid gap-1.5">
                        <Label for="slug">Alamat tulisan</Label>
                        <div class="flex items-center">
                            <span
                                class="flex h-9 items-center rounded-l-md border border-r-0 bg-muted px-2.5 text-sm text-muted-foreground"
                                >/blog/</span
                            >
                            <Input
                                id="slug"
                                v-model="form.slug"
                                class="rounded-l-none"
                                @input="slugFollows = false"
                            />
                        </div>
                        <InputError :message="form.errors.slug" />
                    </div>
                    <div class="grid gap-1.5">
                        <Label for="category">Kategori</Label>
                        <Input
                            id="category"
                            v-model="form.category"
                            list="post-categories"
                            maxlength="50"
                            placeholder="Contoh: Pengumuman, Kegiatan, Tips"
                        />
                        <datalist id="post-categories">
                            <option
                                v-for="name in categories"
                                :key="name"
                                :value="name"
                            />
                        </datalist>
                        <InputError :message="form.errors.category" />
                    </div>
                    <div class="grid gap-1.5">
                        <Label for="excerpt">Ringkasan</Label>
                        <Textarea
                            id="excerpt"
                            v-model="form.excerpt"
                            rows="3"
                            maxlength="300"
                            placeholder="Satu-dua kalimat tentang isi tulisan (opsional)."
                        />
                        <p class="text-xs text-muted-foreground">
                            Tampil di daftar blog dan di bawah judul.
                        </p>
                        <InputError :message="form.errors.excerpt" />
                    </div>
                </section>

                <section
                    class="grid grid-cols-1 gap-4 rounded-xl border bg-card p-4"
                >
                    <h2 class="text-sm font-semibold">SEO (Google)</h2>
                    <div
                        class="rounded-lg border bg-white p-3 font-[Arial,sans-serif] text-[#202124]"
                        aria-label="Pratinjau di Google"
                    >
                        <div class="truncate text-xs text-[#4d5156]">
                            {{ snippetUrl }}
                        </div>
                        <div
                            class="mt-1 line-clamp-2 text-lg leading-snug text-[#1a0dab]"
                        >
                            {{ snippetTitle }}
                        </div>
                        <div
                            class="mt-1 line-clamp-3 text-[13px] leading-normal text-[#4d5156]"
                        >
                            {{ snippetDescription }}
                        </div>
                    </div>
                    <div class="grid gap-1.5">
                        <div class="flex items-baseline justify-between">
                            <Label for="meta_title">Judul SEO</Label>
                            <span
                                class="text-xs"
                                :class="
                                    form.meta_title.length > 60
                                        ? 'text-amber-600'
                                        : 'text-muted-foreground'
                                "
                                >{{ form.meta_title.length }}/60</span
                            >
                        </div>
                        <Input
                            id="meta_title"
                            v-model="form.meta_title"
                            maxlength="150"
                            placeholder="Kosongkan untuk memakai judul tulisan"
                        />
                        <InputError :message="form.errors.meta_title" />
                    </div>
                    <div class="grid gap-1.5">
                        <div class="flex items-baseline justify-between">
                            <Label for="meta_description">Deskripsi SEO</Label>
                            <span
                                class="text-xs"
                                :class="
                                    form.meta_description.length > 158
                                        ? 'text-amber-600'
                                        : 'text-muted-foreground'
                                "
                                >{{ form.meta_description.length }}/158</span
                            >
                        </div>
                        <Textarea
                            id="meta_description"
                            v-model="form.meta_description"
                            rows="3"
                            maxlength="300"
                            placeholder="Kosongkan untuk memakai ringkasan"
                        />
                        <InputError :message="form.errors.meta_description" />
                    </div>
                </section>
            </aside>
        </div>
    </div>
</template>
