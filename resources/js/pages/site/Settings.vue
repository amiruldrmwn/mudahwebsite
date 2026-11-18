<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';
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

const props = defineProps<{ settings: Settings; sitemapUrl: string }>();

const s = props.settings;

type SettingsForm = Omit<Settings, 'logo_url' | 'favicon_url'> & {
    logo: File | null;
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

// Kept in script: vue-tsc misreads "//" inside a static template attribute.
const mapsPlaceholder = 'https://maps.app.goo.gl/...';

function submit(): void {
    form.post(update.url(), {
        forceFormData: true,
        preserveScroll: true,
        onSuccess: () => form.reset('logo', 'favicon'),
    });
}
</script>

<template>
    <Head title="Pengaturan Situs" />

    <form
        class="mx-auto flex w-full max-w-3xl flex-col gap-6 p-4"
        @submit.prevent="submit"
    >
        <div>
            <h1 class="text-xl font-semibold tracking-tight">
                Pengaturan Situs
            </h1>
            <p class="text-sm text-muted-foreground">
                Identitas perusahaan, kontak, dan footer yang tampil di semua
                halaman website.
            </p>
        </div>

        <Card>
            <CardHeader>
                <CardTitle>Identitas</CardTitle>
                <CardDescription>
                    Nama, logo, dan warna utama website.
                </CardDescription>
            </CardHeader>
            <CardContent class="grid gap-5">
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
                            :current-url="s.logo_url"
                            accept="image/png,image/jpeg,image/webp,image/svg+xml"
                            hint="PNG, JPG, WEBP, atau SVG. Maks 2 MB."
                        />
                        <InputError :message="form.errors.logo" />
                        <Label class="mt-1 flex items-center gap-2 font-normal">
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
                <div class="grid gap-2">
                    <Label for="primary_color">Warna utama</Label>
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
                        />
                    </div>
                    <InputError :message="form.errors.primary_color" />
                </div>
            </CardContent>
        </Card>

        <Card>
            <CardHeader>
                <CardTitle>Kontak</CardTitle>
                <CardDescription>
                    Tampil di halaman Kontak dan footer.
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
                        Tanpa kode di bawah, peta dicari otomatis dari alamat.
                    </p>
                </div>
                <div
                    v-if="form.show_map === 'yes'"
                    class="grid gap-2 sm:col-span-2"
                >
                    <Label for="maps_embed">Kode sematan peta (opsional)</Label>
                    <Textarea
                        id="maps_embed"
                        v-model="form.maps_embed"
                        rows="2"
                        placeholder='<iframe src="https://www.google.com/maps/embed?pb=..."></iframe>'
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

        <Card>
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
                    placeholder='<meta name="google-site-verification" content="..." />'
                />
                <p class="text-xs text-muted-foreground">
                    Pilih metode "Tag HTML" di Search Console, salin tag-nya,
                    lalu tempel di sini.
                </p>
                <InputError :message="form.errors.google_verification" />
            </CardContent>
        </Card>

        <Card>
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

        <Card>
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
            class="sticky bottom-0 -mx-4 flex justify-end border-t bg-background/95 px-4 py-3 backdrop-blur"
        >
            <Button type="submit" :disabled="form.processing">
                <Spinner v-if="form.processing" />
                Simpan pengaturan
            </Button>
        </div>
    </form>
</template>
