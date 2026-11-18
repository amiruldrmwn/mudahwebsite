<script setup lang="ts">
import AiCreditNotice from '@/components/AiCreditNotice.vue';
import { Head, Link } from '@inertiajs/vue3';
import {
    ArrowRight,
    BarChart3,
    Check,
    MessageCircle,
    X,
    Circle,
    CircleCheck,
    ExternalLink,
    FileText,
    Inbox,
    Palette,
    PencilLine,
    Plus,
    Sparkles,
} from '@lucide/vue';
import { computed, ref } from 'vue';
import AiSetupWizard from '@/components/AiSetupWizard.vue';
import { dashboard } from '@/routes';
import { index as messagesIndex } from '@/routes/messages';
import { edit as editPage, index as pagesIndex } from '@/routes/pages';
import { edit as editSite } from '@/routes/site';
import { index as themesIndex } from '@/routes/themes';

defineOptions({
    layout: {
        breadcrumbs: [{ title: 'Dashboard', href: dashboard() }],
    },
});

const props = defineProps<{
    siteName: string;
    siteUrl: string;
    stats: {
        pages: number;
        published: number;
        unread: number;
        messagesThisMonth: number;
        theme: string;
        themeColor: string;
        ai: boolean;
    };
    homePageId: number | null;
    recentPages: {
        id: number;
        title: string;
        published: boolean;
        is_home: boolean;
        updated: string | null;
    }[];
    recentMessages: {
        id: number;
        name: string;
        excerpt: string;
        read: boolean;
        time: string | null;
    }[];
    checklist: { label: string; done: boolean }[];
    visits: {
        days: { date: string; label: string; views: number; clicks: number }[];
        views7: number;
        clicks7: number;
        views30: number;
        clicks30: number;
    };
    setup: {
        key: string;
        title: string;
        text: string;
        done: boolean;
        href: string;
    }[];
}>();

// Getting-started steps: shown until all three are done, or until the owner hides them.
const setupDone = computed(() => props.setup.filter((s) => s.done).length);
const setupHidden = ref(false);

try {
    setupHidden.value = localStorage.getItem('mw.setup-hidden') === '1';
} catch {
    // Storage may be blocked; the steps simply stay visible.
}

function hideSetup() {
    setupHidden.value = true;

    try {
        localStorage.setItem('mw.setup-hidden', '1');
    } catch {
        // Ignore: hidden for this visit only.
    }
}

const showSetup = computed(
    () => !setupHidden.value && setupDone.value < props.setup.length,
);

const wizardOpen = ref(false);

const maxViews = computed(() =>
    Math.max(1, ...props.visits.days.map((d) => d.views)),
);

const greeting = computed(() => {
    const hour = new Date().getHours();

    if (hour < 11) {
        return 'Selamat pagi';
    }

    if (hour < 15) {
        return 'Selamat siang';
    }

    if (hour < 18) {
        return 'Selamat sore';
    }

    return 'Selamat malam';
});

const siteHost = computed(() =>
    props.siteUrl.replace(/^https?:\/\//, '').replace(/\/$/, ''),
);

const doneCount = computed(
    () => props.checklist.filter((item) => item.done).length,
);
const progress = computed(() =>
    Math.round((doneCount.value / props.checklist.length) * 100),
);

const homeEdit = computed(() =>
    props.homePageId ? editPage(props.homePageId) : pagesIndex(),
);

const tiles = computed(() => [
    {
        label: 'Halaman',
        value: String(props.stats.pages),
        hint: `${props.stats.published} tayang di website`,
        icon: FileText,
        tile: 'bg-blue-500/12 text-blue-600 dark:text-blue-300',
        href: pagesIndex(),
    },
    {
        label: 'Pesan baru',
        value: String(props.stats.unread),
        hint: `${props.stats.messagesThisMonth} pesan bulan ini`,
        icon: Inbox,
        tile: 'bg-emerald-500/12 text-emerald-600 dark:text-emerald-300',
        href: messagesIndex(),
    },
    {
        label: 'Template',
        value: props.stats.theme,
        hint: 'Ganti tampilan kapan saja',
        icon: Palette,
        tile: 'bg-violet-500/12 text-violet-600 dark:text-violet-300',
        href: themesIndex(),
    },
    {
        label: 'Asisten AI',
        value: props.stats.ai ? 'Aktif' : 'Belum aktif',
        hint: props.stats.ai
            ? 'Minta AI menulis isi halaman'
            : 'Atur di Pengaturan Situs',
        icon: Sparkles,
        tile: 'bg-amber-500/15 text-amber-600 dark:text-amber-300',
        href: props.stats.ai ? homeEdit.value : `${editSite.url()}#ai`,
    },
]);
</script>

<template>
    <Head title="Dashboard" />

    <div class="flex w-full flex-1 flex-col gap-6 p-4 md:p-6">
        <!-- Greeting -->
        <section
            class="relative isolate overflow-hidden rounded-2xl bg-gradient-to-br from-[#2163f6] to-[#1747c9] p-6 text-white md:p-8"
        >
            <div
                class="pointer-events-none absolute inset-0 -z-10"
                aria-hidden="true"
            >
                <div
                    class="absolute -top-24 -right-16 size-72 rounded-full bg-white/15 blur-3xl"
                />
                <div
                    class="absolute -bottom-32 left-1/3 size-80 rounded-full bg-sky-300/20 blur-3xl"
                />
            </div>
            <div
                class="flex flex-col gap-5 md:flex-row md:items-end md:justify-between"
            >
                <div class="min-w-0">
                    <p class="text-sm text-white/85">{{ greeting }} 👋</p>
                    <h1
                        class="mt-1 text-3xl font-semibold tracking-[-0.03em] md:text-4xl"
                    >
                        {{ siteName }}
                    </h1>
                    <a
                        :href="siteUrl"
                        target="_blank"
                        rel="noopener"
                        class="mt-3 inline-flex items-center gap-2 rounded-full bg-white/15 px-3 py-1 text-sm text-white/90 ring-1 ring-white/25 transition hover:bg-white/25"
                    >
                        <span
                            class="size-2 rounded-full bg-emerald-300 shadow-[0_0_0_3px_rgb(110_231_183/0.3)]"
                        />
                        {{ siteHost }}
                    </a>
                </div>
                <div class="flex shrink-0 flex-wrap gap-2">
                    <button
                        type="button"
                        class="inline-flex h-10 items-center gap-2 rounded-full bg-amber-300 px-5 text-sm font-semibold text-[#1b2a5c] shadow-lg shadow-black/10 transition-colors hover:bg-amber-200"
                        @click="wizardOpen = true"
                    >
                        <Sparkles class="size-4" />Buat dengan AI
                    </button>
                    <Link
                        :href="homeEdit"
                        class="inline-flex h-10 items-center gap-2 rounded-full bg-white px-5 text-sm font-medium text-[#2163f6] shadow-lg shadow-black/10 transition-colors hover:bg-white/90"
                    >
                        <PencilLine class="size-4" />Edit Beranda
                    </Link>
                    <a
                        :href="siteUrl"
                        target="_blank"
                        rel="noopener"
                        class="inline-flex h-10 items-center gap-2 rounded-full border border-white/40 px-5 text-sm font-medium text-white transition-colors hover:bg-white/10"
                    >
                        <ExternalLink class="size-4" />Lihat Website
                    </a>
                </div>
            </div>
        </section>

        <AiCreditNotice v-if="stats.ai" />

        <AiSetupWizard
            v-model:open="wizardOpen"
            :enabled="stats.ai"
            :site-name="siteName"
            :site-url="siteUrl"
        />

        <!-- Getting started -->
        <section
            v-if="showSetup"
            class="rounded-2xl border border-primary/25 bg-primary/5 p-5 md:p-6"
        >
            <div class="flex items-start justify-between gap-4">
                <div>
                    <h2 class="text-lg font-semibold">
                        Mulai di sini: 3 langkah agar website siap tayang
                    </h2>
                    <p class="text-sm text-muted-foreground">
                        {{ setupDone }} dari {{ setup.length }} selesai
                    </p>
                </div>
                <button
                    type="button"
                    class="rounded-full p-1.5 text-muted-foreground hover:bg-muted"
                    aria-label="Sembunyikan panduan"
                    @click="hideSetup"
                >
                    <X class="size-4" />
                </button>
            </div>
            <ol class="mt-4 grid gap-3 md:grid-cols-3">
                <li v-for="(step, i) in setup" :key="step.key">
                    <Link
                        :href="step.href"
                        class="flex h-full gap-3 rounded-xl border bg-card p-4 transition hover:border-primary/40 hover:shadow-md"
                        :class="step.done ? 'opacity-70' : ''"
                    >
                        <span
                            class="flex size-8 shrink-0 items-center justify-center rounded-full text-sm font-semibold"
                            :class="
                                step.done
                                    ? 'bg-emerald-500 text-white'
                                    : 'bg-primary text-primary-foreground'
                            "
                        >
                            <Check v-if="step.done" class="size-4" />
                            <template v-else>{{ i + 1 }}</template>
                        </span>
                        <span class="min-w-0">
                            <span
                                class="block font-medium"
                                :class="step.done ? 'line-through' : ''"
                                >{{ step.title }}</span
                            >
                            <span
                                class="mt-0.5 block text-sm text-muted-foreground"
                                >{{ step.text }}</span
                            >
                        </span>
                    </Link>
                </li>
            </ol>
        </section>

        <!-- Stats -->
        <div
            class="grid grid-cols-[repeat(2,minmax(0,1fr))] gap-3 lg:grid-cols-4"
        >
            <Link
                v-for="t in tiles"
                :key="t.label"
                :href="t.href"
                class="group rounded-2xl border bg-card p-4 transition duration-200 hover:-translate-y-0.5 hover:border-primary/40 hover:shadow-lg hover:shadow-primary/5 md:p-5"
            >
                <span class="flex items-center justify-between gap-2">
                    <span
                        class="flex size-10 items-center justify-center rounded-xl"
                        :class="t.tile"
                        ><component :is="t.icon" class="size-5"
                    /></span>
                    <ArrowRight
                        class="size-4 text-muted-foreground transition-transform group-hover:translate-x-0.5 group-hover:text-primary"
                    />
                </span>
                <span class="mt-4 block text-sm text-muted-foreground">{{
                    t.label
                }}</span>
                <span
                    class="mt-0.5 block truncate font-semibold tracking-tight"
                    :class="
                        t.value.length > 9 ? 'text-lg leading-8' : 'text-2xl'
                    "
                    >{{ t.value }}</span
                >
                <span
                    class="mt-1 block truncate text-xs text-muted-foreground"
                    >{{ t.hint }}</span
                >
            </Link>
        </div>

        <div class="grid gap-6 lg:grid-cols-3">
            <!-- Live preview and recent pages -->
            <div class="flex flex-col gap-6 lg:col-span-2">
                <section class="overflow-hidden rounded-2xl border bg-card">
                    <div
                        class="flex items-center justify-between gap-3 border-b px-5 py-3"
                    >
                        <div class="flex items-center gap-2">
                            <span class="flex gap-1.5" aria-hidden="true">
                                <span
                                    class="size-2.5 rounded-full bg-red-400"
                                />
                                <span
                                    class="size-2.5 rounded-full bg-amber-400"
                                />
                                <span
                                    class="size-2.5 rounded-full bg-emerald-400"
                                />
                            </span>
                            <span
                                class="truncate text-sm text-muted-foreground"
                                >{{ siteHost }}</span
                            >
                        </div>
                        <a
                            :href="siteUrl"
                            target="_blank"
                            rel="noopener"
                            class="inline-flex items-center gap-1 text-sm font-medium text-primary hover:underline"
                            >Buka <ExternalLink class="size-3.5"
                        /></a>
                    </div>
                    <div class="relative h-72 overflow-hidden bg-muted">
                        <iframe
                            :src="siteUrl"
                            title="Pratinjau website"
                            class="pointer-events-none absolute top-0 left-0 h-[250%] w-[250%] origin-top-left scale-40"
                            loading="lazy"
                            tabindex="-1"
                        />
                    </div>
                </section>

                <section class="rounded-2xl border bg-card p-5">
                    <div
                        class="mb-4 flex flex-wrap items-center justify-between gap-3"
                    >
                        <h2 class="flex items-center gap-2 font-semibold">
                            <BarChart3 class="size-4 text-primary" />Pengunjung
                            14 hari terakhir
                        </h2>
                        <div class="flex gap-4 text-sm">
                            <span
                                ><span class="font-semibold">{{
                                    visits.views7
                                }}</span>
                                <span class="text-muted-foreground">
                                    kunjungan / 7 hari</span
                                ></span
                            >
                            <span class="inline-flex items-center gap-1"
                                ><MessageCircle
                                    class="size-4 text-emerald-500"
                                /><span class="font-semibold">{{
                                    visits.clicks7
                                }}</span>
                                <span class="text-muted-foreground">
                                    klik WhatsApp</span
                                ></span
                            >
                        </div>
                    </div>
                    <div
                        class="flex h-40 items-end gap-1.5"
                        role="img"
                        :aria-label="`Grafik kunjungan: ${visits.views30} kunjungan dalam 30 hari`"
                    >
                        <div
                            v-for="d in visits.days"
                            :key="d.date"
                            class="group relative flex h-full flex-1 flex-col justify-end"
                        >
                            <div
                                class="w-full rounded-t-md bg-primary/80 transition group-hover:bg-primary"
                                :style="{
                                    height: `${Math.max(2, (d.views / maxViews) * 100)}%`,
                                }"
                            />
                            <span
                                class="pointer-events-none absolute -top-8 left-1/2 z-10 hidden -translate-x-1/2 rounded-md bg-foreground px-2 py-1 text-[11px] whitespace-nowrap text-background group-hover:block"
                                >{{ d.label }}: {{ d.views }} kunjungan,
                                {{ d.clicks }} klik WA</span
                            >
                        </div>
                    </div>
                    <div
                        class="mt-2 flex justify-between text-[11px] text-muted-foreground"
                    >
                        <span>{{ visits.days[0]?.label }}</span>
                        <span>Hari ini</span>
                    </div>
                    <p class="mt-3 text-xs text-muted-foreground">
                        30 hari: {{ visits.views30 }} kunjungan,
                        {{ visits.clicks30 }} klik WhatsApp. Kunjungan admin
                        tidak dihitung.
                    </p>
                </section>

                <section class="rounded-2xl border bg-card p-5">
                    <div class="mb-4 flex items-center justify-between gap-3">
                        <h2 class="font-semibold">Halaman terakhir diubah</h2>
                        <Link
                            :href="pagesIndex()"
                            class="inline-flex items-center gap-1 text-sm font-medium text-primary hover:underline"
                            ><Plus class="size-4" />Kelola halaman</Link
                        >
                    </div>
                    <ul class="divide-y">
                        <li v-for="p in recentPages" :key="p.id">
                            <Link
                                :href="editPage(p.id)"
                                class="group flex items-center gap-3 py-3"
                            >
                                <span
                                    class="flex size-9 shrink-0 items-center justify-center rounded-xl bg-muted text-muted-foreground group-hover:bg-primary/10 group-hover:text-primary"
                                    ><FileText class="size-4"
                                /></span>
                                <span class="min-w-0 flex-1">
                                    <span class="flex items-center gap-2">
                                        <span class="truncate font-medium">{{
                                            p.title
                                        }}</span>
                                        <span
                                            v-if="p.is_home"
                                            class="rounded-full bg-primary/10 px-2 py-0.5 text-[11px] font-medium text-primary"
                                            >Beranda</span
                                        >
                                        <span
                                            v-if="!p.published"
                                            class="rounded-full bg-muted px-2 py-0.5 text-[11px] text-muted-foreground"
                                            >Draf</span
                                        >
                                    </span>
                                    <span
                                        class="block text-xs text-muted-foreground"
                                        >Diubah {{ p.updated }}</span
                                    >
                                </span>
                                <PencilLine
                                    class="size-4 text-muted-foreground group-hover:text-primary"
                                />
                            </Link>
                        </li>
                    </ul>
                </section>
            </div>

            <!-- Setup checklist and messages -->
            <div class="flex flex-col gap-6">
                <section class="rounded-2xl border bg-card p-5">
                    <div class="flex items-center gap-4">
                        <div
                            class="relative size-16 shrink-0 rounded-full"
                            :style="{
                                background: `conic-gradient(var(--primary) ${progress}%, var(--muted) 0)`,
                            }"
                        >
                            <span
                                class="absolute inset-1.5 flex items-center justify-center rounded-full bg-card text-sm font-semibold"
                                >{{ progress }}%</span
                            >
                        </div>
                        <div>
                            <h2 class="font-semibold">Lengkapi website</h2>
                            <p class="text-sm text-muted-foreground">
                                {{ doneCount }} dari
                                {{ checklist.length }} langkah selesai
                            </p>
                        </div>
                    </div>
                    <ul class="mt-4 grid gap-1">
                        <li v-for="item in checklist" :key="item.label">
                            <Link
                                :href="editSite()"
                                class="flex items-center gap-2.5 rounded-lg px-2 py-1.5 text-sm transition hover:bg-muted"
                                :class="
                                    item.done ? 'text-muted-foreground' : ''
                                "
                            >
                                <CircleCheck
                                    v-if="item.done"
                                    class="size-4 shrink-0 text-emerald-500"
                                />
                                <Circle
                                    v-else
                                    class="size-4 shrink-0 text-muted-foreground/60"
                                />
                                <span
                                    :class="item.done ? 'line-through' : ''"
                                    >{{ item.label }}</span
                                >
                            </Link>
                        </li>
                    </ul>
                </section>

                <section class="rounded-2xl border bg-card p-5">
                    <div class="mb-3 flex items-center justify-between gap-3">
                        <h2 class="font-semibold">Pesan terbaru</h2>
                        <Link
                            :href="messagesIndex()"
                            class="text-sm font-medium text-primary hover:underline"
                            >Semua</Link
                        >
                    </div>
                    <div
                        v-if="recentMessages.length === 0"
                        class="flex flex-col items-center gap-2 rounded-xl border border-dashed py-8 text-center text-sm text-muted-foreground"
                    >
                        <Inbox class="size-6" />
                        Belum ada pesan dari pengunjung.
                    </div>
                    <ul v-else class="grid gap-1">
                        <li v-for="m in recentMessages" :key="m.id">
                            <Link
                                :href="messagesIndex()"
                                class="flex gap-3 rounded-lg px-2 py-2 transition hover:bg-muted"
                            >
                                <span
                                    class="flex size-9 shrink-0 items-center justify-center rounded-full bg-primary/10 text-sm font-semibold text-primary"
                                    >{{ m.name.charAt(0).toUpperCase() }}</span
                                >
                                <span class="min-w-0 flex-1">
                                    <span class="flex items-center gap-2">
                                        <span
                                            class="truncate text-sm"
                                            :class="
                                                m.read ? '' : 'font-semibold'
                                            "
                                            >{{ m.name }}</span
                                        >
                                        <span
                                            v-if="!m.read"
                                            class="size-2 shrink-0 rounded-full bg-primary"
                                        />
                                        <span
                                            class="ml-auto shrink-0 text-xs text-muted-foreground"
                                            >{{ m.time }}</span
                                        >
                                    </span>
                                    <span
                                        class="block truncate text-xs text-muted-foreground"
                                        >{{ m.excerpt }}</span
                                    >
                                </span>
                            </Link>
                        </li>
                    </ul>
                </section>
            </div>
        </div>
    </div>
</template>
