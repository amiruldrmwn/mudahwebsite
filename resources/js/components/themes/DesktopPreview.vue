<script setup lang="ts">
import { onBeforeUnmount, onMounted, ref } from 'vue';

/**
 * A website shown as on a desktop screen: the page renders at 1280px wide and is scaled
 * down to fit its box, so templates always show their desktop layout.
 */
const props = withDefaults(
    defineProps<{ src: string; title: string; interactive?: boolean }>(),
    { interactive: false },
);

const WIDTH = 1280;
const box = ref<HTMLElement | null>(null);
const scale = ref(0.3);
let observer: ResizeObserver | null = null;

onMounted(() => {
    observer = new ResizeObserver(([entry]) => {
        scale.value = entry.contentRect.width / WIDTH;
    });

    if (box.value) {
        observer.observe(box.value);
    }
});

onBeforeUnmount(() => observer?.disconnect());
</script>

<template>
    <div ref="box" class="relative h-full w-full overflow-hidden bg-muted">
        <iframe
            :src="props.src"
            :title="props.title"
            class="absolute top-0 left-0 origin-top-left border-0 bg-white"
            :class="interactive ? '' : 'pointer-events-none'"
            :style="{
                width: `${WIDTH}px`,
                height: `${100 / scale}%`,
                transform: `scale(${scale})`,
            }"
            loading="lazy"
            :tabindex="interactive ? 0 : -1"
        />
    </div>
</template>
