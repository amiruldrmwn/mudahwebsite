<script setup lang="ts">
import { usePage } from '@inertiajs/vue3';
import { ExternalLink, Wallet } from '@lucide/vue';
import { computed } from 'vue';

/**
 * Asisten AI runs on the owner's MudahCloud AI credit: without credit it cannot answer. Shown
 * wherever the AI is set up or used, with the way to top up.
 */
withDefaults(defineProps<{ compact?: boolean }>(), { compact: false });

const page = usePage();
const topup = computed(() =>
    String(page.props.mudahcloudAiUrl ?? 'https://mudahcloud.com/ai'),
);
</script>

<template>
    <div
        class="flex items-start gap-3 rounded-xl border border-amber-500/30 bg-amber-50 text-amber-900 dark:bg-amber-950/40 dark:text-amber-100"
        :class="compact ? 'p-3 text-xs' : 'p-4 text-sm'"
        role="note"
        data-test="ai-credit-notice"
    >
        <Wallet class="mt-0.5 size-4 shrink-0" />
        <div class="min-w-0 flex-1">
            <p class="font-medium">Asisten AI memakai saldo AI MudahCloud</p>
            <p class="mt-0.5 opacity-90">
                Setiap tulisan dari AI memotong saldo AI di akun MudahCloud
                Anda. Kalau saldonya habis, AI berhenti menjawab sampai diisi
                lagi.
            </p>
            <a
                :href="topup"
                target="_blank"
                rel="noopener"
                class="mt-2 inline-flex items-center gap-1 font-semibold underline underline-offset-4"
                >Isi saldo AI di MudahCloud<ExternalLink class="size-3.5"
            /></a>
        </div>
    </div>
</template>
