<script setup lang="ts">
import AiCreditNotice from '@/components/AiCreditNotice.vue';
import { Check, Eye, SendHorizontal, Sparkles, X } from '@lucide/vue';
import { nextTick, ref } from 'vue';
import PreviewDialog from '@/components/sections/PreviewDialog.vue';
import { Button } from '@/components/ui/button';
import {
    Sheet,
    SheetContent,
    SheetDescription,
    SheetHeader,
    SheetTitle,
} from '@/components/ui/sheet';
import { Spinner } from '@/components/ui/spinner';
import { Textarea } from '@/components/ui/textarea';
import { post } from '@/lib/http';
import { assistant } from '@/routes/pages';
import { edit as editSite } from '@/routes/site';
import type { Section } from '@/types/sections';

type Turn = {
    role: 'user' | 'assistant';
    content: string;
    sections?: Section[];
    status?: 'applied' | 'dismissed';
    error?: boolean;
};

const props = defineProps<{
    pageId: number;
    pageTitle: string;
    sections: Section[];
    enabled: boolean;
}>();

const emit = defineEmits<{ apply: [sections: Section[]] }>();
const siteSettingsUrl = `${editSite.url()}#ai`;
const open = defineModel<boolean>('open', { required: true });

const turns = ref<Turn[]>([]);
const input = ref('');
const busy = ref(false);
const list = ref<HTMLElement | null>(null);
const previewOpen = ref(false);
const previewSections = ref<Section[] | null>(null);

const suggestions = [
    'Tuliskan ulang semua teks agar lebih profesional dan meyakinkan.',
    'Perusahaan kami bergerak di bidang konstruksi gedung. Sesuaikan isi halaman ini.',
    'Tambahkan section FAQ dengan 4 pertanyaan yang sering ditanyakan calon klien.',
    'Buat judul hero lebih singkat dan menarik.',
];

async function scrollDown(): Promise<void> {
    await nextTick();
    list.value?.scrollTo({ top: list.value.scrollHeight, behavior: 'smooth' });
}

async function send(text?: string): Promise<void> {
    const request = (text ?? input.value).trim();

    if (!request || busy.value) {
        return;
    }

    const history = turns.value
        .filter((t) => !t.error)
        .map((t) => ({ role: t.role, content: t.content }));

    turns.value.push({ role: 'user', content: request });
    input.value = '';
    busy.value = true;
    void scrollDown();

    try {
        const response = await post(assistant.url(props.pageId), {
            request,
            sections: props.sections,
            history,
        });
        const json = (await response.json()) as {
            message: string;
            sections: Section[];
        };
        turns.value.push({
            role: 'assistant',
            content: json.message,
            sections: json.sections,
        });
    } catch (e) {
        turns.value.push({
            role: 'assistant',
            content: (e as Error).message,
            error: true,
        });
    } finally {
        busy.value = false;
        void scrollDown();
    }
}

function showPreview(turn: Turn): void {
    previewSections.value = turn.sections ?? null;
    previewOpen.value = true;
}

function apply(turn: Turn): void {
    if (turn.sections) {
        emit('apply', turn.sections);
        turn.status = 'applied';
    }
}

function onKeydown(event: KeyboardEvent): void {
    if (event.key === 'Enter' && !event.shiftKey) {
        event.preventDefault();
        void send();
    }
}
</script>

<template>
    <Sheet v-model:open="open">
        <SheetContent class="flex w-full flex-col gap-0 p-0 sm:max-w-md">
            <SheetHeader class="border-b p-4">
                <SheetTitle class="flex items-center gap-2">
                    <Sparkles class="size-4" />
                    Asisten AI
                </SheetTitle>
                <SheetDescription>
                    Minta AI menulis atau mengubah isi halaman "{{
                        pageTitle
                    }}". Perubahan baru tersimpan setelah Anda klik Terapkan
                    lalu Simpan halaman.
                </SheetDescription>
            </SheetHeader>

            <div
                v-if="!enabled"
                class="m-4 rounded-lg border border-dashed p-4 text-sm text-muted-foreground"
            >
                Asisten AI belum aktif. Isi API key MudahCloud AI di
                <a
                    :href="siteSettingsUrl"
                    class="font-medium text-primary underline"
                    >Pengaturan Situs → Asisten AI</a
                >.
            </div>

            <template v-else>
                <AiCreditNotice compact class="mx-4 mt-4" />
                <div ref="list" class="flex-1 space-y-4 overflow-y-auto p-4">
                    <div v-if="turns.length === 0" class="space-y-2">
                        <p class="text-sm text-muted-foreground">
                            Contoh permintaan:
                        </p>
                        <button
                            v-for="s in suggestions"
                            :key="s"
                            type="button"
                            class="block w-full rounded-lg border p-3 text-left text-sm transition hover:bg-muted/60"
                            @click="send(s)"
                        >
                            {{ s }}
                        </button>
                    </div>

                    <div
                        v-for="(turn, i) in turns"
                        :key="i"
                        :class="turn.role === 'user' ? 'flex justify-end' : ''"
                    >
                        <div
                            class="max-w-[90%] rounded-2xl px-4 py-2.5 text-sm whitespace-pre-line"
                            :class="
                                turn.role === 'user'
                                    ? 'bg-primary text-primary-foreground'
                                    : turn.error
                                      ? 'bg-destructive/10 text-destructive'
                                      : 'bg-muted'
                            "
                        >
                            {{ turn.content }}
                            <div
                                v-if="turn.sections"
                                class="mt-3 flex flex-wrap gap-2"
                            >
                                <template v-if="!turn.status">
                                    <Button
                                        size="sm"
                                        variant="outline"
                                        class="bg-background"
                                        @click="showPreview(turn)"
                                    >
                                        <Eye class="size-4" /> Pratinjau
                                    </Button>
                                    <Button size="sm" @click="apply(turn)">
                                        <Check class="size-4" /> Terapkan
                                    </Button>
                                    <Button
                                        size="sm"
                                        variant="ghost"
                                        @click="turn.status = 'dismissed'"
                                    >
                                        <X class="size-4" /> Abaikan
                                    </Button>
                                </template>
                                <span
                                    v-else
                                    class="text-xs text-muted-foreground"
                                    >{{
                                        turn.status === 'applied'
                                            ? 'Diterapkan ke editor. Jangan lupa Simpan halaman.'
                                            : 'Diabaikan.'
                                    }}</span
                                >
                            </div>
                        </div>
                    </div>

                    <div
                        v-if="busy"
                        class="flex items-center gap-2 text-sm text-muted-foreground"
                    >
                        <Spinner /> AI sedang menulis...
                    </div>
                </div>

                <form class="border-t p-4" @submit.prevent="send()">
                    <div class="flex items-end gap-2">
                        <Textarea
                            v-model="input"
                            rows="2"
                            maxlength="2000"
                            placeholder="Tulis permintaan Anda..."
                            class="max-h-40 resize-none"
                            :disabled="busy"
                            @keydown="onKeydown"
                        />
                        <Button
                            type="submit"
                            size="icon"
                            :disabled="busy || !input.trim()"
                            aria-label="Kirim"
                        >
                            <SendHorizontal class="size-4" />
                        </Button>
                    </div>
                    <p class="mt-2 text-xs text-muted-foreground">
                        Biaya AI dipotong dari kredit AI Anda di MudahCloud.
                    </p>
                </form>
            </template>
        </SheetContent>
    </Sheet>

    <PreviewDialog
        v-model:open="previewOpen"
        :page-id="pageId"
        :sections="previewSections"
        title="Pratinjau usulan AI"
    />
</template>
