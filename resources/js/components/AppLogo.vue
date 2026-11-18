<script setup lang="ts">
import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const page = usePage();
const name = computed(() => page.props.name);
</script>

<template>
    <!-- Cloud mark in MudahCloud blue, with the site's name. -->
    <div
        class="flex aspect-square size-8 items-center justify-center rounded-lg bg-gradient-to-br from-[#2163f6] to-[#1747c9] text-white shadow-sm shadow-[#2163f6]/30"
    >
        <svg viewBox="0 0 24 24" class="size-5" fill="none" aria-hidden="true">
            <path
                d="M7.5 18.5h9.25a4.25 4.25 0 0 0 .6-8.46A5.5 5.5 0 0 0 6.7 9.2 4.65 4.65 0 0 0 7.5 18.5Z"
                stroke="currentColor"
                stroke-width="1.9"
                stroke-linejoin="round"
            />
            <path
                d="M9.6 13.6c.7.8 1.5 1.15 2.4 1.15s1.7-.35 2.4-1.15"
                stroke="currentColor"
                stroke-width="1.9"
                stroke-linecap="round"
            />
        </svg>
    </div>
    <div class="ml-1 grid flex-1 text-left text-sm leading-tight">
        <span class="truncate font-semibold">{{ name }}</span>
        <span class="truncate text-xs text-muted-foreground"
            >Mudah Website</span
        >
    </div>
</template>
