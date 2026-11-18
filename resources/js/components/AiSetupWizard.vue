<script setup lang="ts">
import { router } from '@inertiajs/vue3';
import {
    CircleAlert,
    CircleCheck,
    ExternalLink,
    LoaderCircle,
    Sparkles,
} from '@lucide/vue';
import { computed, ref } from 'vue';
import { Button } from '@/components/ui/button';
import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogHeader,
    DialogTitle,
} from '@/components/ui/dialog';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Textarea } from '@/components/ui/textarea';
import { post } from '@/lib/http';
import { setup } from '@/routes/ai';
import { edit as editSite } from '@/routes/site';

/**
 * "Ceritakan usaha Anda": AI picks a template, writes the site's texts, then rewrites every
 * page one request at a time so the owner sees progress.
 */
const props = defineProps<{
    enabled: boolean;
    siteName: string;
    siteUrl: string;
}>();

const open = defineModel<boolean>('open', { required: true });

type Step = {
    id: number;
    title: string;
    url: string;
    status: 'wait' | 'busy' | 'done' | 'error';
};

const name = ref(props.siteName);
const story = ref('');
const stage = ref<'form' | 'working' | 'done'>('form');
const theme = ref('');
const steps = ref<Step[]>([]);
const error = ref('');
const choosing = ref(false);

const doneCount = computed(
    () =>
        steps.value.filter((s) => s.status === 'done' || s.status === 'error')
            .length,
);

async function start(): Promise<void> {
    if (story.value.trim().length < 20 || !name.value.trim()) {
        return;
    }

    stage.value = 'working';
    choosing.value = true;
    error.value = '';

    try {
        const response = await post(setup.url(), {
            site_name: name.value,
            story: story.value,
        });
        const json = (await response.json()) as {
            theme: string;
            pages: { id: number; title: string; url: string }[];
        };
        theme.value = json.theme;
        steps.value = json.pages.map((p) => ({ ...p, status: 'wait' }));
    } catch (e) {
        error.value = (e as Error).message;
        stage.value = 'form';

        return;
    } finally {
        choosing.value = false;
    }

    for (const step of steps.value) {
        step.status = 'busy';

        try {
            await post(step.url, { story: `${name.value}. ${story.value}` });
            step.status = 'done';
        } catch {
            step.status = 'error';
        }
    }

    stage.value = 'done';
}

function finish(): void {
    open.value = false;
    stage.value = 'form';
    router.reload();
}
</script>

<template>
    <Dialog
        :open="open"
        @update:open="(v) => (stage === 'working' ? null : (open = v))"
    >
        <DialogContent class="sm:max-w-xl">
            <DialogHeader>
                <DialogTitle class="flex items-center gap-2"
                    ><Sparkles class="size-5 text-primary" />Buat website dengan
                    AI</DialogTitle
                >
                <DialogDescription>
                    Ceritakan usaha Anda. AI memilih template yang cocok, lalu
                    menulis isi semua halamannya.
                </DialogDescription>
            </DialogHeader>

            <div
                v-if="!enabled"
                class="rounded-xl border border-dashed p-4 text-sm text-muted-foreground"
            >
                Asisten AI belum aktif. Isi API key MudahCloud AI di
                <a
                    :href="`${editSite.url()}#ai`"
                    class="font-medium text-primary underline"
                    >Pengaturan Situs</a
                >
                terlebih dahulu.
            </div>

            <form
                v-else-if="stage === 'form'"
                class="grid gap-4"
                @submit.prevent="start"
            >
                <div class="grid gap-2">
                    <Label for="wiz-name">Nama usaha</Label>
                    <Input id="wiz-name" v-model="name" required />
                </div>
                <div class="grid gap-2">
                    <Label for="wiz-story">Ceritakan usaha Anda</Label>
                    <Textarea
                        id="wiz-story"
                        v-model="story"
                        rows="6"
                        placeholder="Contoh: Kami laundry kiloan di Bandung sejak 2019. Layanan cuci setrika, dry clean, dan cuci sepatu. Gratis antar jemput untuk 5 kg ke atas. Pelanggan kami kebanyakan mahasiswa dan keluarga."
                    />
                    <p class="text-xs text-muted-foreground">
                        Semakin lengkap (jenis usaha, kota, layanan, harga,
                        keunggulan), semakin pas hasilnya.
                    </p>
                </div>
                <p
                    class="rounded-lg bg-amber-500/10 p-3 text-sm text-amber-800 dark:text-amber-200"
                >
                    Halaman untuk template yang dipilih AI akan ditulis ulang.
                    Halaman template lain tetap tersimpan.
                </p>
                <p v-if="error" class="text-sm text-destructive">{{ error }}</p>
                <div class="flex justify-end">
                    <Button
                        type="submit"
                        :disabled="story.trim().length < 20 || !name.trim()"
                    >
                        <Sparkles class="size-4" />Buat sekarang
                    </Button>
                </div>
            </form>

            <div v-else class="grid gap-4">
                <div class="flex items-center gap-3 rounded-xl border p-3">
                    <LoaderCircle
                        v-if="choosing"
                        class="size-5 animate-spin text-primary"
                    />
                    <CircleCheck v-else class="size-5 text-emerald-500" />
                    <div class="text-sm">
                        <div class="font-medium">
                            {{
                                choosing
                                    ? 'Memilih template & menulis identitas…'
                                    : `Template dipilih: ${theme}`
                            }}
                        </div>
                        <div class="text-muted-foreground">
                            Tagline, deskripsi, dan footer juga diisi.
                        </div>
                    </div>
                </div>

                <div v-if="steps.length" class="grid gap-2">
                    <div class="flex items-center justify-between text-sm">
                        <span class="font-medium">Menulis halaman</span>
                        <span class="text-muted-foreground"
                            >{{ doneCount }} / {{ steps.length }}</span
                        >
                    </div>
                    <div class="h-2 overflow-hidden rounded-full bg-muted">
                        <div
                            class="h-full rounded-full bg-primary transition-all"
                            :style="{
                                width: `${(doneCount / steps.length) * 100}%`,
                            }"
                        />
                    </div>
                    <ul class="grid gap-1.5">
                        <li
                            v-for="step in steps"
                            :key="step.id"
                            class="flex items-center gap-2 text-sm"
                        >
                            <LoaderCircle
                                v-if="step.status === 'busy'"
                                class="size-4 animate-spin text-primary"
                            />
                            <CircleCheck
                                v-else-if="step.status === 'done'"
                                class="size-4 text-emerald-500"
                            />
                            <CircleAlert
                                v-else-if="step.status === 'error'"
                                class="size-4 text-amber-500"
                            />
                            <span v-else class="size-4 rounded-full border" />
                            <span
                                :class="
                                    step.status === 'wait'
                                        ? 'text-muted-foreground'
                                        : ''
                                "
                                >{{ step.title }}</span
                            >
                            <span
                                v-if="step.status === 'error'"
                                class="text-xs text-muted-foreground"
                                >(tetap memakai isi contoh)</span
                            >
                        </li>
                    </ul>
                </div>

                <p
                    v-if="stage === 'working'"
                    class="text-xs text-muted-foreground"
                >
                    Mohon tunggu dan jangan tutup halaman ini. Biasanya 1–3
                    menit.
                </p>

                <div
                    v-if="stage === 'done'"
                    class="flex flex-col gap-3 rounded-xl bg-emerald-500/10 p-4 sm:flex-row sm:items-center sm:justify-between"
                >
                    <p class="text-sm font-medium">
                        Website Anda sudah jadi! Periksa isinya, lalu ganti foto
                        dengan foto usaha Anda.
                    </p>
                    <div class="flex shrink-0 gap-2">
                        <Button as-child variant="outline" size="sm">
                            <a :href="siteUrl" target="_blank" rel="noopener"
                                ><ExternalLink class="size-4" />Lihat</a
                            >
                        </Button>
                        <Button size="sm" @click="finish">Selesai</Button>
                    </div>
                </div>
            </div>
        </DialogContent>
    </Dialog>
</template>
