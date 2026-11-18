<script setup lang="ts">
import { Form, Head } from '@inertiajs/vue3';
import InputError from '@/components/InputError.vue';
import PasswordInput from '@/components/PasswordInput.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Spinner } from '@/components/ui/spinner';

defineOptions({
    layout: {
        title: 'Buat kata sandi baru',
        description: 'Kata sandi baru dipakai untuk masuk ke admin website.',
    },
});

defineProps<{ token: string; email: string; action: string }>();
</script>

<template>
    <Head title="Buat kata sandi baru" />

    <Form
        :action="action"
        method="post"
        :reset-on-success="['password', 'password_confirmation']"
        v-slot="{ errors, processing }"
        class="flex flex-col gap-6"
    >
        <input type="hidden" name="token" :value="token" />
        <div class="grid gap-2">
            <Label for="email">Email</Label>
            <Input
                id="email"
                type="email"
                name="email"
                :default-value="email"
                required
                readonly
                autocomplete="email"
            />
            <InputError :message="errors.email" />
        </div>
        <div class="grid gap-2">
            <Label for="password">Kata sandi baru</Label>
            <PasswordInput
                id="password"
                name="password"
                required
                autocomplete="new-password"
                placeholder="Minimal 8 karakter"
            />
            <InputError :message="errors.password" />
        </div>
        <div class="grid gap-2">
            <Label for="password_confirmation">Ulangi kata sandi</Label>
            <PasswordInput
                id="password_confirmation"
                name="password_confirmation"
                required
                autocomplete="new-password"
            />
        </div>

        <Button
            type="submit"
            class="w-full bg-[#2766f5] text-white hover:bg-[#1f55d6]"
            :disabled="processing"
            data-test="reset-password-button"
        >
            <Spinner v-if="processing" />
            Simpan kata sandi
        </Button>
    </Form>
</template>
