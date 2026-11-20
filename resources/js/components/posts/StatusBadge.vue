<script lang="ts">
export type PostState = 'published' | 'scheduled' | 'draft';
</script>

<script setup lang="ts">
defineProps<{ state: PostState }>();

const labels: Record<PostState, string> = {
    published: 'Terbit',
    scheduled: 'Terjadwal',
    draft: 'Draf',
};

const styles: Record<PostState, string> = {
    published:
        'bg-emerald-50 text-emerald-700 ring-emerald-600/20 dark:bg-emerald-500/10 dark:text-emerald-400',
    scheduled:
        'bg-amber-50 text-amber-800 ring-amber-600/25 dark:bg-amber-500/10 dark:text-amber-400',
    draft: 'bg-muted text-muted-foreground ring-border',
};
</script>

<template>
    <span
        class="inline-flex items-center gap-1 rounded-full px-2 py-0.5 text-xs font-medium ring-1 ring-inset"
        :class="styles[state]"
    >
        <span class="size-1.5 rounded-full bg-current" aria-hidden="true" />
        {{ labels[state] }}
    </span>
</template>
