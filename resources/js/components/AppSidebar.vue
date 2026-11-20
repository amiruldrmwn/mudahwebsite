<script setup lang="ts">
import { Link, usePage } from '@inertiajs/vue3';
import {
    ExternalLink,
    FileText,
    Globe,
    Images,
    Inbox,
    LayoutGrid,
    Palette,
    Settings2,
    UserCog,
} from '@lucide/vue';
import { computed } from 'vue';
import AppLogo from '@/components/AppLogo.vue';
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
import {
    Sidebar,
    SidebarContent,
    SidebarFooter,
    SidebarHeader,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
} from '@/components/ui/sidebar';
import { dashboard, home } from '@/routes';
import { index as mediaIndex } from '@/routes/media';
import { index as messagesIndex } from '@/routes/messages';
import { index as pagesIndex } from '@/routes/pages';
import { edit as editSite } from '@/routes/site';
import { edit as editProfile } from '@/routes/profile';
import { index as themesIndex } from '@/routes/themes';
import type { NavItem } from '@/types';

const page = usePage();

const websiteItems: NavItem[] = [
    { title: 'Dashboard', href: dashboard(), icon: LayoutGrid },
    { title: 'Halaman', href: pagesIndex(), icon: FileText },
    { title: 'Media', href: mediaIndex(), icon: Images },
    { title: 'Template', href: themesIndex(), icon: Palette },
];

const engageItems = computed<NavItem[]>(() => [
    {
        title: 'Pesan Masuk',
        href: messagesIndex(),
        icon: Inbox,
        badge: page.props.unreadMessages,
    },
]);

const siteHost = window.location.host;

const settingsItems: NavItem[] = [
    { title: 'Pengaturan Situs', href: editSite(), icon: Settings2 },
    { title: 'Akun & Keamanan', href: editProfile(), icon: UserCog },
];
</script>

<template>
    <Sidebar collapsible="icon" variant="inset">
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child>
                        <Link :href="dashboard()">
                            <AppLogo />
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>

        <SidebarContent>
            <NavMain :items="websiteItems" label="Website" />
            <NavMain :items="engageItems" label="Pengunjung" />
            <NavMain :items="settingsItems" label="Pengaturan" />
        </SidebarContent>

        <SidebarFooter>
            <!-- View the live site -->
            <a
                :href="home.url()"
                target="_blank"
                rel="noopener"
                class="group/site flex items-center gap-3 rounded-xl border border-[#2163f6]/15 bg-gradient-to-br from-[#2163f6]/10 to-transparent p-3 text-sm transition group-data-[collapsible=icon]:hidden hover:border-[#2163f6]/40"
            >
                <span
                    class="flex size-8 shrink-0 items-center justify-center rounded-lg bg-white text-primary shadow-sm dark:bg-background"
                    ><Globe class="size-4"
                /></span>
                <span class="min-w-0 flex-1">
                    <span class="block font-medium">Lihat website</span>
                    <span
                        class="block truncate text-xs text-muted-foreground"
                        >{{ siteHost }}</span
                    >
                </span>
                <ExternalLink
                    class="size-4 text-muted-foreground transition group-hover/site:text-primary"
                />
            </a>
            <NavUser />
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>
