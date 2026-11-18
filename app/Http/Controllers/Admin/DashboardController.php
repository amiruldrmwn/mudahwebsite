<?php

namespace App\Http\Controllers\Admin;

use App\Ai\AiClient;
use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Page;
use App\Models\SiteVisit;
use App\Sections\DefaultContent;
use App\Support\Site;
use App\Support\Themes;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function __invoke(Site $site, AiClient $ai): Response
    {
        $pages = Page::query()->get(['id', 'title', 'is_home', 'published', 'updated_at']);
        $home = $pages->firstWhere('is_home', true) ?? $pages->first();

        $days = SiteVisit::lastDays(30);
        $week = $days->slice(-7);
        $realLogo = filled($site->get('logo')) && ! DefaultContent::isSampleLogo($site->get('logo'));

        return Inertia::render('Dashboard', [
            'visits' => [
                'days' => $days->slice(-14)->values(),
                'views7' => $week->sum('views'),
                'clicks7' => $week->sum('clicks'),
                'views30' => $days->sum('views'),
                'clicks30' => $days->sum('clicks'),
            ],
            // Three first steps shown prominently until they are all done.
            'setup' => [
                ['key' => 'logo', 'title' => 'Upload logo', 'text' => 'Logo tampil di atas website dan sebagai ikon tab browser.', 'done' => $realLogo, 'href' => route('site.edit')],
                ['key' => 'contact', 'title' => 'Isi WhatsApp & alamat', 'text' => 'Semua tombol pesan dan peta lokasi memakai data ini.', 'done' => filled($site->get('whatsapp')) && filled($site->get('address')), 'href' => route('site.edit')],
                ['key' => 'theme', 'title' => 'Pilih template & warna', 'text' => 'Tentukan tampilan yang paling cocok untuk usaha Anda.', 'done' => (bool) $site->get('theme_chosen'), 'href' => route('themes.index')],
            ],
            'siteName' => $site->get('site_name'),
            'siteUrl' => url('/'),
            'stats' => [
                'pages' => $pages->count(),
                'published' => $pages->where('published', true)->count(),
                'unread' => Message::query()->whereNull('read_at')->count(),
                'messagesThisMonth' => Message::query()->where('created_at', '>=', now()->startOfMonth())->count(),
                'theme' => Themes::all()[Themes::current($site)]['label'],
                'themeColor' => $site->get('primary_color'),
                'ai' => $ai->enabled(),
            ],
            'homePageId' => $home?->id,
            'recentPages' => $pages->sortByDesc('updated_at')->take(4)->values()->map(fn (Page $p) => [
                'id' => $p->id,
                'title' => $p->title,
                'published' => $p->published,
                'is_home' => $p->is_home,
                'updated' => $p->updated_at?->diffForHumans(),
            ]),
            'recentMessages' => Message::query()->latest()->take(4)->get()->map(fn (Message $m) => [
                'id' => $m->id,
                'name' => $m->name,
                'excerpt' => Str::limit($m->body, 70),
                'read' => $m->read_at !== null,
                'time' => $m->created_at?->diffForHumans(),
            ]),
            'checklist' => [
                ['label' => 'Upload logo perusahaan', 'done' => filled($site->get('logo')) && ! DefaultContent::isSampleLogo($site->get('logo'))],
                ['label' => 'Isi tagline dan deskripsi', 'done' => filled($site->get('tagline')) && filled($site->get('description'))],
                ['label' => 'Lengkapi kontak (email, telepon, atau WhatsApp)', 'done' => filled($site->get('contact_email')) || filled($site->get('contact_phone')) || filled($site->get('whatsapp'))],
                ['label' => 'Isi alamat kantor', 'done' => filled($site->get('address'))],
                ['label' => 'Tambahkan sosial media', 'done' => $site->socials() !== []],
            ],
        ]);
    }
}
