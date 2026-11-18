<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { KeyRound, MonitorSmartphone, UserRound } from '@lucide/vue';
import { useCurrentUrl } from '@/composables/useCurrentUrl';
import { toUrl } from '@/lib/utils';
import { edit as editAppearance } from '@/routes/appearance';
import { edit as editProfile } from '@/routes/profile';
import { edit as editSecurity } from '@/routes/security';

const items = [
    {
        title: 'Profil',
        hint: 'Nama dan email login',
        href: editProfile(),
        icon: UserRound,
    },
    {
        title: 'Keamanan',
        hint: 'Password dan verifikasi 2 langkah',
        href: editSecurity(),
        icon: KeyRound,
    },
    {
        title: 'Tampilan',
        hint: 'Mode terang atau gelap',
        href: editAppearance(),
        icon: MonitorSmartphone,
    },
];

const { isCurrentOrParentUrl } = useCurrentUrl();
</script>

<template>
    <div
        class="mx-auto grid w-full max-w-5xl gap-6 p-4 md:p-6 lg:grid-cols-[15rem_1fr] lg:gap-10"
    >
        <aside class="lg:sticky lg:top-6 lg:self-start">
            <h1 class="text-xl font-semibold tracking-tight">
                Akun & Keamanan
            </h1>
            <p class="mt-1 text-sm text-muted-foreground">
                Atur data login admin website.
            </p>
            <nav
                class="-mx-1 mt-5 flex gap-1 overflow-x-auto px-1 pb-1 lg:flex-col lg:overflow-visible"
                aria-label="Pengaturan akun"
            >
                <Link
                    v-for="item in items"
                    :key="toUrl(item.href)"
                    :href="item.href"
                    class="flex shrink-0 items-center gap-3 rounded-xl px-3 py-2.5 transition hover:bg-muted"
                    :class="
                        isCurrentOrParentUrl(item.href)
                            ? 'bg-muted font-medium text-foreground'
                            : 'text-muted-foreground'
                    "
                >
                    <span
                        class="flex size-8 shrink-0 items-center justify-center rounded-lg"
                        :class="
                            isCurrentOrParentUrl(item.href)
                                ? 'bg-primary text-primary-foreground'
                                : 'bg-muted-foreground/10'
                        "
                        ><component :is="item.icon" class="size-4"
                    /></span>
                    <span class="min-w-0">
                        <span class="block text-sm">{{ item.title }}</span>
                        <span
                            class="hidden truncate text-xs text-muted-foreground lg:block"
                            >{{ item.hint }}</span
                        >
                    </span>
                </Link>
            </nav>
        </aside>

        <div class="flex min-w-0 flex-col gap-6">
            <slot />
        </div>
    </div>
</template>
