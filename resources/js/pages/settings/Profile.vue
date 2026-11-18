<script setup lang="ts">
import { Form, Head, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import ProfileController from '@/actions/App/Http/Controllers/Settings/ProfileController';
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
import { edit } from '@/routes/profile';

defineOptions({
    layout: {
        breadcrumbs: [{ title: 'Profil', href: edit() }],
    },
});

const page = usePage();
const user = computed(() => page.props.auth.user);

const initials = computed(() =>
    String(user.value.name ?? '')
        .split(/\s+/)
        .filter(Boolean)
        .slice(0, 2)
        .map((w) => w[0]?.toUpperCase())
        .join(''),
);
</script>

<template>
    <Head title="Profil" />

    <section
        class="flex items-center gap-4 rounded-2xl border bg-gradient-to-br from-primary/10 to-transparent p-5"
    >
        <span
            class="flex size-14 shrink-0 items-center justify-center rounded-full bg-primary text-lg font-semibold text-primary-foreground"
            >{{ initials || 'A' }}</span
        >
        <div class="min-w-0">
            <h2 class="truncate text-lg font-semibold">{{ user.name }}</h2>
            <p class="truncate text-sm text-muted-foreground">
                {{ user.email }}
            </p>
        </div>
        <span
            class="ml-auto hidden rounded-full bg-primary/10 px-3 py-1 text-xs font-medium text-primary sm:inline"
            >Admin website</span
        >
    </section>

    <Card>
        <CardHeader>
            <CardTitle>Data profil</CardTitle>
            <CardDescription>
                Email ini dipakai untuk login dan menerima pemberitahuan pesan
                dari website.
            </CardDescription>
        </CardHeader>
        <CardContent>
            <Form
                v-bind="ProfileController.update.form()"
                class="grid gap-5"
                v-slot="{ errors, processing, recentlySuccessful }"
            >
                <div class="grid gap-2">
                    <Label for="name">Nama</Label>
                    <Input
                        id="name"
                        name="name"
                        :default-value="user.name"
                        required
                        autocomplete="name"
                        placeholder="Nama lengkap"
                    />
                    <InputError :message="errors.name" />
                </div>

                <div class="grid gap-2">
                    <Label for="email">Email</Label>
                    <Input
                        id="email"
                        type="email"
                        name="email"
                        :default-value="user.email"
                        required
                        autocomplete="username"
                        placeholder="nama@perusahaan.com"
                    />
                    <InputError :message="errors.email" />
                </div>

                <div class="flex items-center gap-3">
                    <Button
                        :disabled="processing"
                        data-test="update-profile-button"
                    >
                        <Spinner v-if="processing" />Simpan
                    </Button>
                    <span
                        v-if="recentlySuccessful"
                        class="text-sm text-emerald-600"
                        >Tersimpan.</span
                    >
                </div>
            </Form>
        </CardContent>
    </Card>
</template>
