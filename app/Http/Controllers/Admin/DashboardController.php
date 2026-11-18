<?php

namespace App\Http\Controllers\Admin;

use App\Ai\AiClient;
use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Page;
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

        return Inertia::render('Dashboard', [
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
