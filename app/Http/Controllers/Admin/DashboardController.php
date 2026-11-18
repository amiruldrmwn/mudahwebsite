<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Sections\DefaultContent;
use App\Support\Site;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function __invoke(Site $site): Response
    {
        return Inertia::render('Dashboard', [
            'siteName' => $site->get('site_name'),
            'siteUrl' => url('/'),
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
