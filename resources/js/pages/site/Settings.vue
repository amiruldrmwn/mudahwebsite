<script setup lang="ts">
import AiCreditNotice from '@/components/AiCreditNotice.vue';
import { Head, useForm } from '@inertiajs/vue3';
import {
    Building2,
    ChartColumn,
    Check,
    MapPin,
    Palette,
    PanelBottom,
    Search,
    Share2,
    Sparkles,
} from '@lucide/vue';
import { computed, ref } from 'vue';
import ImageUpload from '@/components/ImageUpload.vue';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import {
    Card,
    CardContent,
    CardDescription,
    CardHeader,
    CardTitle,
} from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Spinner } from '@/components/ui/spinner';
import { Textarea } from '@/components/ui/textarea';
import { post } from '@/lib/http';
import { siteCopy } from '@/routes/ai';
import { edit, update } from '@/routes/site';

type Settings = {
    site_name: string;
    tagline: string;
    description: string;
    primary_color: string;
    logo_url: string | null;
    show_name: string;
    favicon_url: string | null;
    contact_email: string;
    contact_phone: string;
    whatsapp: string;
    address: string;
    maps_url: string;
    show_map: string;
    maps_embed: string;
    google_verification: string;
    ga_id: string;
    gtm_id: string;
    meta_pixel_id: string;
    tiktok_pixel_id: string;
    ai_model: string;
    ai_key_set: boolean;
    social_instagram: string;
    social_facebook: string;
    social_linkedin: string;
    social_youtube: string;
    social_tiktok: string;
    social_x: string;
    footer_text: string;
};

defineOptions({
    layout: {
        breadcrumbs: [{ title: 'Pengaturan Situs', href: edit() }],
    },
});

type AiTier = {
    key: string;
    label: string;
    description: string;
    model: string;
    input: number | null;
    output: number | null;
};

const props = defineProps<{
    settings: Settings;
    sitemapUrl: string;
    aiTiers: AiTier[];
    aiDefaultModel: string;
}>();

const s = props.settings;

type SettingsForm = Omit<
    Settings,
    'logo_url' | 'favicon_url' | 'ai_key_set'
> & {
    ai_api_key: string;
    remove_ai_key: boolean;
    logo: File | null;
    logo_path: string;
    remove_logo: boolean;
    favicon: File | null;
    remove_favicon: boolean;
};

const form = useForm<SettingsForm>({
    site_name: s.site_name ?? '',
    tagline: s.tagline ?? '',
    description: s.description ?? '',
    primary_color: s.primary_color ?? '#2563eb',
    logo: null,
    logo_path: '',
    remove_logo: false,
    show_name: s.show_name ?? 'yes',
    favicon: null,
    remove_favicon: false,
    contact_email: s.contact_email ?? '',
    contact_phone: s.contact_phone ?? '',
    whatsapp: s.whatsapp ?? '',
    address: s.address ?? '',
    maps_url: s.maps_url ?? '',
    show_map: s.show_map ?? 'yes',
    maps_embed: s.maps_embed ?? '',
    google_verification: s.google_verification ?? '',
    ga_id: s.ga_id ?? '',
    gtm_id: s.gtm_id ?? '',
    meta_pixel_id: s.meta_pixel_id ?? '',
    tiktok_pixel_id: s.tiktok_pixel_id ?? '',
    ai_api_key: '',
    remove_ai_key: false,
    ai_model: s.ai_model ?? '',
    social_instagram: s.social_instagram ?? '',
    social_facebook: s.social_facebook ?? '',
    social_linkedin: s.social_linkedin ?? '',
    social_youtube: s.social_youtube ?? '',
    social_tiktok: s.social_tiktok ?? '',
    social_x: s.social_x ?? '',
    footer_text: s.footer_text ?? '',
});

const socials = [
    {
        key: 'social_instagram',
        label: 'Instagram',
        example: 'https://instagram.com/perusahaan',
    },
    {
        key: 'social_facebook',
        label: 'Facebook',
        example: 'https://facebook.com/perusahaan',
    },
    {
        key: 'social_linkedin',
        label: 'LinkedIn',
        example: 'https://linkedin.com/company/perusahaan',
    },
    {
        key: 'social_youtube',
        label: 'YouTube',
        example: 'https://youtube.com/@perusahaan',
    },
    {
        key: 'social_tiktok',
        label: 'TikTok',
        example: 'https://tiktok.com/@perusahaan',
    },
    {
        key: 'social_x',
        label: 'X (Twitter)',
        example: 'https://x.com/perusahaan',
    },
] as const;

const colorPresets = [
    { name: 'Biru', value: '#2563eb' },
    { name: 'Biru Tua', value: '#1e3a8a' },
    { name: 'Toska', value: '#0d9488' },
    { name: 'Hijau', value: '#16a34a' },
    { name: 'Hijau Tua', value: '#166534' },
    { name: 'Kuning', value: '#ca8a04' },
    { name: 'Orange', value: '#ea580c' },
    { name: 'Merah', value: '#dc2626' },
    { name: 'Marun', value: '#9f1239' },
    { name: 'Pink', value: '#db2777' },
    { name: 'Ungu', value: '#7c3aed' },
    { name: 'Cokelat', value: '#92400e' },
    { name: 'Emas', value: '#b08d57' },
    { name: 'Abu-abu', value: '#475569' },
    { name: 'Hitam', value: '#111111' },
] as const;

const isPreset = computed(() =>
    colorPresets.some(
        (c) => c.value.toLowerCase() === form.primary_color.toLowerCase(),
    ),
);

const sections = [
    { id: 'identitas', label: 'Identitas', icon: Building2 },
    { id: 'warna', label: 'Warna', icon: Palette },
    { id: 'kontak', label: 'Kontak & Lokasi', icon: MapPin },
    { id: 'google', label: 'Google', icon: Search },
    { id: 'analitik', label: 'Analitik & Pixel', icon: ChartColumn },
    { id: 'ai', label: 'Asisten AI', icon: Sparkles },
    { id: 'sosial', label: 'Sosial Media', icon: Share2 },
    { id: 'footer', label: 'Footer', icon: PanelBottom },
] as const;

const trackers = [
    {
        key: 'ga_id',
        label: 'Google Analytics 4',
        placeholder: 'G-XXXXXXXXXX',
        hint: 'Admin → Aliran data → ID pengukuran.',
    },
    {
        key: 'gtm_id',
        label: 'Google Tag Manager',
        placeholder: 'GTM-XXXXXXX',
        hint: 'Opsional, untuk yang mengatur tag sendiri di GTM.',
    },
    {
        key: 'meta_pixel_id',
        label: 'Meta Pixel (Facebook & Instagram)',
        placeholder: '123456789012345',
        hint: 'Events Manager → Sumber data → ID Pixel.',
    },
    {
        key: 'tiktok_pixel_id',
        label: 'TikTok Pixel',
        placeholder: 'CXXXXXXXXXXXXXXXXXXX',
        hint: 'TikTok Ads Manager → Aset → Peristiwa → ID Pixel.',
    },
] as const;

// Kept in script: vue-tsc misreads "//" inside a static template attribute.
const mapsPlaceholder = 'https://maps.app.goo.gl/...';
const googlePlaceholder =
    '<meta name="google-site-verification" content="..." />';
const embedPlaceholder =
    '<iframe src="https://www.google.com/maps/embed?pb=..."></iframe>';
// "Tulis dengan AI": tagline, description and footer from a short story. Not saved until Simpan.
const copyOpen = ref(false);
const copyStory = ref('');
const copyBusy = ref(false);
const copyError = ref('');

async function writeCopy(): Promise<void> {
    if (copyBusy.value || copyStory.value.trim().length < 10) {
        return;
    }

    copyBusy.value = true;
    copyError.value = '';

    try {
        const response = await post(siteCopy.url(), { story: copyStory.value });
        const json = (await response.json()) as {
            tagline: string;
            description: string;
            footer_text: string;
        };
        form.tagline = json.tagline || form.tagline;
        form.description = json.description || form.description;
        form.footer_text = json.footer_text || form.footer_text;
        copyOpen.value = false;
    } catch (e) {
        copyError.value = (e as Error).message;
    } finally {
        copyBusy.value = false;
    }
}

// AI model: three simple choices; a model saved before there were choices stays shown.
const aiSelectedId = computed(() => form.ai_model || props.aiDefaultModel);
const aiCustom = computed(() =>
    props.aiTiers.some((t) => t.model === aiSelectedId.value)
        ? null
        : aiSelectedId.value,
);

function formatUsd(v: number | null): string {
    if (v === null) {
        return '-';
    }

    return v < 0.01 ? `$${+v.toPrecision(2)}` : `$${v.toFixed(2)}`;
}

/** A rough cost of one request to the assistant: about 8 thousand tokens in and 1 thousand out. */
function perRequest(t: AiTier): string | null {
    if (t.input === null || t.output === null) {
        return null;
    }

    const usd = (t.input * 8000 + t.output * 1000) / 1_000_000;

    return `$${usd < 0.01 ? usd.toFixed(3) : usd.toFixed(2)}`;
}

function submit(): void {
    form.post(update.url(), {
        forceFormData: true,
        preserveScroll: true,
        onSuccess: () =>
            form.reset(
                'logo',
                'logo_path',
                'favicon',
                'ai_api_key',
                'remove_ai_key',
            ),
    });
}
</script>

<template>
    <Head title="Pengaturan Situs" />

    <form
        class="mx-auto grid w-full max-w-6xl gap-6 p-4 md:p-6 lg:grid-cols-[13rem_1fr] lg:gap-10"
        @submit.prevent="submit"
    >
        <aside class="lg:sticky lg:top-6 lg:self-start">
            <h1 class="text-xl font-semibold tracking-tight">
                Pengaturan Situs
            </h1>
            <p class="mt-1 text-sm text-muted-foreground">
                Berlaku di semua halaman website.
            </p>
            <nav
                class="-mx-1 mt-5 flex gap-1 overflow-x-auto px-1 pb-1 lg:flex-col lg:overflow-visible"
                aria-label="Bagian pengaturan"
            >
                <a
                    v-for="sec in sections"
                    :key="sec.id"
                    :href="`#${sec.id}`"
                    class="flex shrink-0 items-center gap-2.5 rounded-lg px-3 py-2 text-sm font-medium text-muted-foreground transition hover:bg-muted hover:text-foreground"
                >
                    <component :is="sec.icon" class="size-4" />{{ sec.label }}
                </a>
            </nav>
        </aside>

        <div class="flex min-w-0 flex-col gap-6">
            <Card id="identitas" class="scroll-mt-6">
                <CardHeader>
                    <CardTitle>Identitas</CardTitle>
                    <CardDescription>
                        Nama usaha, logo, dan ikon tab browser.
                    </CardDescription>
                </CardHeader>
                <CardContent class="grid gap-5">
                    <div
                        v-if="s.ai_key_set"
                        class="rounded-xl border border-primary/25 bg-primary/5 p-4"
                    >
                        <div
                            class="flex flex-wrap items-center justify-between gap-3"
                        >
                            <p class="text-sm">
                                <Sparkles
                                    class="mr-1 inline size-4 text-primary"
                                />
                                Bingung menulis tagline dan deskripsi? Biar AI
                                yang menuliskan.
                            </p>
                            <Button
                                v-if="!copyOpen"
                                type="button"
                                size="sm"
                                variant="outline"
                                @click="copyOpen = true"
                                >Tulis dengan AI</Button
                            >
                        </div>
                        <div v-if="copyOpen" class="mt-3 grid gap-2">
                            <Textarea
                                v-model="copyStory"
                                rows="3"
                                :disabled="copyBusy"
                                placeholder="Ceritakan singkat usaha Anda: jenis usaha, kota, layanan unggulan, dan keunggulannya."
                                aria-label="Cerita usaha"
                            />
                            <p
                                v-if="copyError"
                                class="text-sm text-destructive"
                            >
                                {{ copyError }}
                            </p>
                            <div class="flex items-center gap-2">
                                <Button
                                    type="button"
                                    size="sm"
                                    :disabled="
                                        copyBusy || copyStory.trim().length < 10
                                    "
                                    @click="writeCopy"
                                >
                                    <Spinner v-if="copyBusy" />
                                    {{
                                        copyBusy
                                            ? 'Menulis…'
                                            : 'Isi tagline, deskripsi & footer'
                                    }}
                                </Button>
                                <Button
                                    type="button"
                                    size="sm"
                                    variant="ghost"
                                    @click="copyOpen = false"
                                    >Batal</Button
                                >
                            </div>
                            <p class="text-xs text-muted-foreground">
                                Hasilnya masuk ke kolom di bawah. Periksa, lalu
                                klik Simpan pengaturan.
                            </p>
                        </div>
                    </div>
                    <div class="grid gap-2">
                        <Label for="site_name">Nama perusahaan</Label>
                        <Input
                            id="site_name"
                            v-model="form.site_name"
                            required
                            placeholder="PT Maju Bersama"
                        />
                        <InputError :message="form.errors.site_name" />
                    </div>
                    <div class="grid gap-2">
                        <Label for="tagline">Tagline</Label>
                        <Input
                            id="tagline"
                            v-model="form.tagline"
                            placeholder="Solusi konstruksi terpercaya sejak 2005"
                        />
                        <InputError :message="form.errors.tagline" />
                    </div>
                    <div class="grid gap-2">
                        <Label for="description">Deskripsi singkat</Label>
                        <Textarea
                            id="description"
                            v-model="form.description"
                            rows="3"
                            placeholder="Dipakai untuk hasil pencarian Google dan saat link website dibagikan."
                        />
                        <InputError :message="form.errors.description" />
                    </div>
                    <div class="grid gap-5 sm:grid-cols-2">
                        <div class="grid gap-2">
                            <Label>Logo</Label>
                            <ImageUpload
                                v-model:file="form.logo"
                                v-model:removed="form.remove_logo"
                                v-model:picked="form.logo_path"
                                pickable
                                :current-url="s.logo_url"
                                accept="image/png,image/jpeg,image/webp,image/svg+xml"
                                hint="PNG, JPG, WEBP, atau SVG. Maks 10 MB, dikecilkan otomatis."
                            />
                            <InputError :message="form.errors.logo" />
                            <Label
                                class="mt-1 flex items-center gap-2 font-normal"
                            >
                                <input
                                    v-model="form.show_name"
                                    type="checkbox"
                                    true-value="yes"
                                    false-value="no"
                                    class="size-4 accent-[var(--primary)]"
                                />
                                Tampilkan nama website di samping logo
                            </Label>
                            <p class="text-xs text-muted-foreground">
                                Matikan jika logo Anda sudah memuat nama usaha.
                            </p>
                        </div>
                        <div class="grid gap-2">
                            <Label>Favicon</Label>
                            <ImageUpload
                                v-model:file="form.favicon"
                                v-model:removed="form.remove_favicon"
                                :current-url="s.favicon_url"
                                accept="image/png,image/x-icon,image/svg+xml"
                                hint="Ikon kecil di tab browser. PNG persegi, maks 512 KB."
                            />
                            <InputError :message="form.errors.favicon" />
                        </div>
                    </div>
                </CardContent>
            </Card>

            <Card id="warna" class="scroll-mt-6">
                <CardHeader>
                    <CardTitle>Warna utama</CardTitle>
                    <CardDescription>
                        Dipakai untuk tombol, tautan, dan aksen di seluruh
                        website.
                    </CardDescription>
                </CardHeader>
                <CardContent class="grid gap-5">
                    <div
                        class="grid grid-cols-3 gap-2 sm:grid-cols-5"
                        role="radiogroup"
                        aria-label="Pilihan warna"
                    >
                        <button
                            v-for="c in colorPresets"
                            :key="c.value"
                            type="button"
                            role="radio"
                            :aria-checked="
                                form.primary_color.toLowerCase() === c.value
                            "
                            class="group flex items-center gap-2 rounded-xl border p-2 text-left text-sm transition hover:border-primary/50"
                            :class="
                                form.primary_color.toLowerCase() === c.value
                                    ? 'border-primary ring-2 ring-primary/20'
                                    : ''
                            "
                            @click="form.primary_color = c.value"
                        >
                            <span
                                class="flex size-7 shrink-0 items-center justify-center rounded-full ring-1 ring-black/10"
                                :style="{ background: c.value }"
                            >
                                <Check
                                    v-if="
                                        form.primary_color.toLowerCase() ===
                                        c.value
                                    "
                                    class="size-4 text-white"
                                />
                            </span>
                            <span class="truncate">{{ c.name }}</span>
                        </button>
                    </div>
                    <div
                        class="flex flex-col gap-4 rounded-xl border bg-muted/30 p-4 sm:flex-row sm:items-center sm:justify-between"
                    >
                        <div class="grid gap-2">
                            <Label for="primary_color"
                                >Warna sendiri
                                <span
                                    v-if="!isPreset"
                                    class="ml-1 rounded-full bg-primary/10 px-2 py-0.5 text-[11px] text-primary"
                                    >Dipakai</span
                                ></Label
                            >
                            <div class="flex items-center gap-3">
                                <input
                                    id="primary_color"
                                    v-model="form.primary_color"
                                    type="color"
                                    class="h-9 w-14 cursor-pointer rounded-md border bg-transparent p-1"
                                />
                                <Input
                                    v-model="form.primary_color"
                                    class="w-32 font-mono"
                                    maxlength="7"
                                    aria-label="Kode warna"
                                />
                            </div>
                        </div>
                        <div class="flex items-center gap-3" aria-hidden="true">
                            <span class="text-xs text-muted-foreground"
                                >Contoh:</span
                            >
                            <span
                                class="rounded-full px-4 py-2 text-sm font-semibold text-white shadow-sm"
                                :style="{ background: form.primary_color }"
                                >Hubungi Kami</span
                            >
                            <span
                                class="text-sm font-semibold underline"
                                :style="{ color: form.primary_color }"
                                >Lihat detail</span
                            >
                        </div>
                    </div>
                    <InputError :message="form.errors.primary_color" />
                </CardContent>
            </Card>

            <Card id="kontak" class="scroll-mt-6">
                <CardHeader>
                    <CardTitle>Kontak & Lokasi</CardTitle>
                    <CardDescription>
                        Dipakai tombol WhatsApp, halaman Kontak, peta, dan
                        footer.
                    </CardDescription>
                </CardHeader>
                <CardContent class="grid gap-5 sm:grid-cols-2">
                    <div class="grid gap-2">
                        <Label for="contact_email">Email</Label>
                        <Input
                            id="contact_email"
                            v-model="form.contact_email"
                            type="email"
                            placeholder="info@perusahaan.com"
                        />
                        <InputError :message="form.errors.contact_email" />
                    </div>
                    <div class="grid gap-2">
                        <Label for="contact_phone">Telepon</Label>
                        <Input
                            id="contact_phone"
                            v-model="form.contact_phone"
                            placeholder="(021) 1234 5678"
                        />
                        <InputError :message="form.errors.contact_phone" />
                    </div>
                    <div class="grid gap-2">
                        <Label for="whatsapp">WhatsApp</Label>
                        <Input
                            id="whatsapp"
                            v-model="form.whatsapp"
                            placeholder="6281234567890"
                        />
                        <InputError :message="form.errors.whatsapp" />
                    </div>
                    <div class="grid gap-2">
                        <Label for="maps_url">Link Google Maps</Label>
                        <Input
                            id="maps_url"
                            v-model="form.maps_url"
                            :placeholder="mapsPlaceholder"
                        />
                        <InputError :message="form.errors.maps_url" />
                    </div>
                    <div class="grid gap-2 sm:col-span-2">
                        <Label for="address">Alamat</Label>
                        <Textarea
                            id="address"
                            v-model="form.address"
                            rows="2"
                            placeholder="Jl. Sudirman No. 1, Jakarta"
                        />
                        <InputError :message="form.errors.address" />
                    </div>
                    <div class="grid gap-2 sm:col-span-2">
                        <Label class="flex items-center gap-2">
                            <input
                                v-model="form.show_map"
                                type="checkbox"
                                true-value="yes"
                                false-value="no"
                                class="size-4 accent-[var(--primary)]"
                            />
                            Tampilkan peta di bagian Kontak
                        </Label>
                        <p class="text-xs text-muted-foreground">
                            Tanpa kode di bawah, peta dicari otomatis dari
                            alamat.
                        </p>
                    </div>
                    <div
                        v-if="form.show_map === 'yes'"
                        class="grid gap-2 sm:col-span-2"
                    >
                        <Label for="maps_embed"
                            >Kode sematan peta (opsional)</Label
                        >
                        <Textarea
                            id="maps_embed"
                            v-model="form.maps_embed"
                            rows="2"
                            :placeholder="embedPlaceholder"
                        />
                        <p class="text-xs text-muted-foreground">
                            Agar titik peta tepat: buka lokasi di Google Maps →
                            Bagikan → Sematkan peta → Salin HTML, lalu tempel di
                            sini.
                        </p>
                        <InputError :message="form.errors.maps_embed" />
                    </div>
                </CardContent>
            </Card>

            <Card id="google" class="scroll-mt-6">
                <CardHeader>
                    <CardTitle>Google</CardTitle>
                    <CardDescription>
                        Hubungkan website ke Google Search Console agar mudah
                        ditemukan di pencarian. Peta situs: {{ sitemapUrl }}
                    </CardDescription>
                </CardHeader>
                <CardContent class="grid gap-2">
                    <Label for="google_verification"
                        >Kode verifikasi Google Search Console</Label
                    >
                    <Input
                        id="google_verification"
                        v-model="form.google_verification"
                        :placeholder="googlePlaceholder"
                    />
                    <p class="text-xs text-muted-foreground">
                        Pilih metode "Tag HTML" di Search Console, salin
                        tag-nya, lalu tempel di sini.
                    </p>
                    <InputError :message="form.errors.google_verification" />
                </CardContent>
            </Card>

            <Card id="analitik" class="scroll-mt-6">
                <CardHeader>
                    <CardTitle>Analitik & Pixel</CardTitle>
                    <CardDescription>
                        Untuk mengukur pengunjung dan iklan. Cukup tempel
                        ID-nya, kode pelacaknya dipasang otomatis. Klik tombol
                        WhatsApp ikut tercatat sebagai konversi "Contact".
                    </CardDescription>
                </CardHeader>
                <CardContent class="grid gap-5 sm:grid-cols-2">
                    <div v-for="t in trackers" :key="t.key" class="grid gap-2">
                        <Label :for="t.key">{{ t.label }}</Label>
                        <Input
                            :id="t.key"
                            v-model="form[t.key]"
                            :placeholder="t.placeholder"
                            autocomplete="off"
                            spellcheck="false"
                        />
                        <p class="text-xs text-muted-foreground">
                            {{ t.hint }}
                        </p>
                        <InputError :message="form.errors[t.key]" />
                    </div>
                </CardContent>
            </Card>

            <Card id="ai" class="scroll-mt-6">
                <CardHeader>
                    <CardTitle class="flex items-center gap-2"
                        >Asisten AI
                        <span
                            class="rounded-full px-2 py-0.5 text-[11px] font-medium"
                            :class="
                                s.ai_key_set
                                    ? 'bg-emerald-500/10 text-emerald-700 dark:text-emerald-300'
                                    : 'bg-muted text-muted-foreground'
                            "
                            >{{ s.ai_key_set ? 'Aktif' : 'Belum aktif' }}</span
                        ></CardTitle
                    >
                    <CardDescription>
                        Asisten AI membantu menulis isi halaman memakai
                        MudahCloud AI. Biaya diambil dari kredit AI akun
                        MudahCloud Anda.
                    </CardDescription>
                </CardHeader>
                <CardContent class="grid gap-6">
                    <AiCreditNotice />
                    <div class="grid gap-2">
                        <Label for="ai_api_key">API key MudahCloud AI</Label>
                        <Input
                            id="ai_api_key"
                            v-model="form.ai_api_key"
                            type="password"
                            autocomplete="off"
                            :disabled="form.remove_ai_key"
                            :placeholder="
                                s.ai_key_set
                                    ? 'Tersimpan. Isi untuk mengganti'
                                    : 'Tempel API key dari dashboard MudahCloud'
                            "
                        />
                        <p class="text-xs text-muted-foreground">
                            Buat API key di dashboard MudahCloud, menu AI. Key
                            disimpan terenkripsi dan tidak pernah ditampilkan
                            lagi.
                        </p>
                        <Label
                            v-if="s.ai_key_set"
                            class="flex items-center gap-2 text-xs font-normal text-muted-foreground"
                        >
                            <input
                                v-model="form.remove_ai_key"
                                type="checkbox"
                                class="size-3.5"
                            />
                            Hapus API key yang tersimpan
                        </Label>
                        <InputError :message="form.errors.ai_api_key" />
                    </div>

                    <div class="grid gap-3">
                        <Label>Model AI</Label>
                        <div
                            class="grid gap-3 sm:grid-cols-3"
                            role="radiogroup"
                            aria-label="Model AI"
                        >
                            <button
                                v-for="t in aiTiers"
                                :key="t.key"
                                type="button"
                                role="radio"
                                :aria-checked="t.model === aiSelectedId"
                                class="flex min-w-0 flex-col gap-2 rounded-xl border p-4 text-left transition hover:border-primary/50"
                                :class="
                                    t.model === aiSelectedId
                                        ? 'border-primary bg-primary/5 ring-1 ring-primary'
                                        : ''
                                "
                                @click="form.ai_model = t.model"
                            >
                                <span
                                    class="flex items-center justify-between gap-2"
                                >
                                    <span class="font-semibold">{{
                                        t.label
                                    }}</span>
                                    <span
                                        class="flex size-4 shrink-0 items-center justify-center rounded-full border"
                                        :class="
                                            t.model === aiSelectedId
                                                ? 'border-primary bg-primary text-primary-foreground'
                                                : ''
                                        "
                                        ><Check
                                            v-if="t.model === aiSelectedId"
                                            class="size-3"
                                    /></span>
                                </span>
                                <span class="text-xs text-muted-foreground">{{
                                    t.description
                                }}</span>
                                <span class="mt-auto border-t pt-2 text-xs">
                                    <span v-if="perRequest(t)" class="block">
                                        ±
                                        <span class="font-semibold">{{
                                            perRequest(t)
                                        }}</span>
                                        per perintah
                                    </span>
                                    <span
                                        v-if="t.input !== null"
                                        class="block text-muted-foreground"
                                        >{{ formatUsd(t.input) }} masuk ·
                                        {{ formatUsd(t.output) }} keluar per 1
                                        juta token</span
                                    >
                                    <span
                                        class="mt-1 block font-mono text-[11px] break-all text-muted-foreground"
                                        >Model: {{ t.model }}</span
                                    >
                                </span>
                            </button>
                        </div>
                        <p
                            v-if="aiCustom"
                            class="rounded-xl border border-dashed p-3 text-xs text-muted-foreground"
                        >
                            Saat ini memakai model
                            <span class="font-mono">{{ aiCustom }}</span
                            >. Pilih salah satu di atas untuk menggantinya.
                        </p>
                        <p class="text-xs text-muted-foreground">
                            Biaya dipotong dari saldo AI MudahCloud. Standar
                            sudah cukup untuk kebanyakan website.
                        </p>
                        <InputError :message="form.errors.ai_model" />
                    </div>
                </CardContent>
            </Card>

            <Card id="sosial" class="scroll-mt-6">
                <CardHeader>
                    <CardTitle>Sosial Media</CardTitle>
                    <CardDescription>
                        Isi link lengkap. Yang dikosongkan tidak ditampilkan.
                    </CardDescription>
                </CardHeader>
                <CardContent class="grid gap-5 sm:grid-cols-2">
                    <div
                        v-for="social in socials"
                        :key="social.key"
                        class="grid gap-2"
                    >
                        <Label :for="social.key">{{ social.label }}</Label>
                        <Input
                            :id="social.key"
                            v-model="form[social.key]"
                            :placeholder="social.example"
                        />
                        <InputError :message="form.errors[social.key]" />
                    </div>
                </CardContent>
            </Card>

            <Card id="footer" class="scroll-mt-6">
                <CardHeader>
                    <CardTitle>Footer</CardTitle>
                    <CardDescription>
                        Teks singkat di bagian bawah setiap halaman.
                    </CardDescription>
                </CardHeader>
                <CardContent class="grid gap-2">
                    <Label for="footer_text">Teks footer</Label>
                    <Textarea
                        id="footer_text"
                        v-model="form.footer_text"
                        rows="3"
                        placeholder="Mitra terpercaya untuk pembangunan gedung dan infrastruktur di Indonesia."
                    />
                    <InputError :message="form.errors.footer_text" />
                </CardContent>
            </Card>

            <div
                class="sticky bottom-0 -mx-4 flex items-center justify-end gap-3 border-t bg-background/95 px-4 py-3 backdrop-blur md:-mx-6 md:px-6"
            >
                <span v-if="form.isDirty" class="text-xs text-muted-foreground"
                    >Ada perubahan belum disimpan</span
                >
                <Button type="submit" :disabled="form.processing">
                    <Spinner v-if="form.processing" />
                    Simpan pengaturan
                </Button>
            </div>
        </div>
    </form>
</template>
