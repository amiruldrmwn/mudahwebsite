<script setup lang="ts">
import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import { home } from '@/routes';

defineProps<{
    title?: string;
    description?: string;
}>();

const siteName = computed(() => String(usePage().props.name ?? ''));
</script>

<template>
    <div
        class="relative flex min-h-svh flex-col items-center justify-center overflow-hidden bg-[#f4f7ff] p-6 md:p-10 dark:bg-background"
    >
        <!-- Soft brand glow -->
        <div
            class="pointer-events-none absolute -top-40 left-1/2 size-[36rem] -translate-x-1/2 rounded-full bg-[#2766f5]/15 blur-3xl"
        />

        <div class="relative w-full max-w-sm">
            <div class="mb-8 flex justify-center">
                <img
                    src="/brand/mudahcloud.png"
                    alt="MudahCloud"
                    class="h-9 w-auto"
                />
            </div>

            <div
                class="rounded-2xl border bg-card p-7 shadow-xl shadow-[#2766f5]/5 sm:p-8"
            >
                <div class="mb-7 space-y-1.5 text-center">
                    <p
                        v-if="siteName"
                        class="text-xs font-semibold tracking-wide text-[#2766f5] uppercase"
                    >
                        {{ siteName }}
                    </p>
                    <h1 class="text-xl font-semibold">{{ title }}</h1>
                    <p class="text-sm text-muted-foreground">
                        {{ description }}
                    </p>
                </div>
                <slot />
            </div>

            <div
                class="mt-6 flex flex-col items-center gap-2 text-xs text-muted-foreground"
            >
                <a :href="home().url" class="hover:text-foreground"
                    >&larr; Kembali ke website</a
                >
                <span>Mudah Web &middot; dikelola oleh MudahCloud</span>
            </div>
        </div>
    </div>
</template>
