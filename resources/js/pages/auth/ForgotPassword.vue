<script setup lang="ts">
import { Form, Head, Link } from '@inertiajs/vue3';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Spinner } from '@/components/ui/spinner';

defineOptions({
    layout: {
        title: 'Lupa kata sandi',
        description: 'Masukkan email admin; kami kirim link untuk membuat kata sandi baru.',
    },
});

defineProps<{ status?: string; action: string; loginUrl: string }>();
</script>

<template>
    <Head title="Lupa kata sandi" />

    <div v-if="status" class="mb-4 rounded-lg bg-green-50 p-3 text-center text-sm font-medium text-green-700">
        {{ status }}
    </div>

    <Form :action="action" method="post" v-slot="{ errors, processing }" class="flex flex-col gap-6">
        <div class="grid gap-2">
            <Label for="email">Email</Label>
            <Input id="email" type="email" name="email" required v-focus autocomplete="email" placeholder="nama@perusahaan.com" />
            <InputError :message="errors.email" />
        </div>

        <Button type="submit" class="w-full bg-[#2766f5] text-white hover:bg-[#1f55d6]" :disabled="processing" data-test="email-reset-link">
            <Spinner v-if="processing" />
            Kirim link reset
        </Button>

        <p class="text-center text-sm text-muted-foreground">
            Ingat kata sandinya? <Link :href="loginUrl" class="font-medium text-foreground underline underline-offset-4">Kembali masuk</Link>
        </p>
    </Form>
</template>
