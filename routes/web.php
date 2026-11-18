<?php

use App\Http\Controllers\Admin\AiWriterController;
use App\Http\Controllers\Admin\AssistantController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\SiteSettingsController;
use App\Http\Controllers\Admin\ThemeController;
use App\Http\Controllers\MudahCloudController;
use App\Http\Controllers\SiteController;
use App\Http\Middleware\MudahCloudKey;
use Illuminate\Foundation\Http\Middleware\ValidateCsrfToken;
use Illuminate\Support\Facades\Route;

// Admin panel (login lives at /admin/login, from Fortify).
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/', DashboardController::class)->name('dashboard');

    Route::get('site', [SiteSettingsController::class, 'edit'])->name('site.edit');
    Route::post('site', [SiteSettingsController::class, 'update'])->name('site.update');

    Route::get('pages', [PageController::class, 'index'])->name('pages.index');
    Route::post('pages', [PageController::class, 'store'])->name('pages.store');
    Route::post('pages/reorder', [PageController::class, 'reorder'])->name('pages.reorder');
    Route::get('pages/{page}', [PageController::class, 'edit'])->name('pages.edit');
    Route::put('pages/{page}', [PageController::class, 'update'])->name('pages.update');
    Route::delete('pages/{page}', [PageController::class, 'destroy'])->name('pages.destroy');
    Route::post('pages/{page}/home', [PageController::class, 'makeHome'])->name('pages.home');
    Route::post('pages/{page}/assistant', [AssistantController::class, 'page'])->middleware('throttle:20,1')->name('pages.assistant');
    Route::post('pages/{page}/preview', [AssistantController::class, 'preview'])->name('pages.preview');

    Route::post('media', [MediaController::class, 'store'])->name('media.store');

    Route::middleware('throttle:20,1')->group(function () {
        Route::post('ai/page', [AiWriterController::class, 'page'])->name('ai.page');
        Route::post('ai/site-copy', [AiWriterController::class, 'siteCopy'])->name('ai.site-copy');
        Route::post('ai/setup', [AiWriterController::class, 'setup'])->name('ai.setup');
        Route::post('ai/setup/pages/{page}', [AiWriterController::class, 'rewritePage'])->name('pages.rewrite');
    });

    Route::get('themes', [ThemeController::class, 'index'])->name('themes.index');
    Route::put('themes', [ThemeController::class, 'update'])->name('themes.update');

    Route::get('messages', [MessageController::class, 'index'])->name('messages.index');
    Route::post('messages/{message}/read', [MessageController::class, 'read'])->name('messages.read');
    Route::delete('messages/{message}', [MessageController::class, 'destroy'])->name('messages.destroy');
});

require __DIR__.'/settings.php';

// MudahCloud's client area acting for the owner, with the site's key; the sign-in link is signed instead.
Route::prefix('_mudahcloud')->group(function () {
    Route::middleware([MudahCloudKey::class, 'throttle:60,1'])->group(function () {
        Route::get('status', [MudahCloudController::class, 'status']);
        Route::post('theme', [MudahCloudController::class, 'theme']);
        Route::post('password', [MudahCloudController::class, 'password']);
        Route::post('ai-key', [MudahCloudController::class, 'aiKey']);
        Route::post('login', [MudahCloudController::class, 'login']);
    });
    Route::get('enter', [MudahCloudController::class, 'enter'])->middleware('signed')->name('mudahcloud.enter');
});

// Public website.
Route::get('sitemap.xml', [SiteController::class, 'sitemap'])->name('sitemap');
Route::get('robots.txt', [SiteController::class, 'robots']);
Route::post('kirim-pesan', [SiteController::class, 'contact'])->middleware('throttle:5,10')->name('contact.send');
Route::post('klik-wa', [SiteController::class, 'whatsappClick'])->middleware('throttle:30,1')->withoutMiddleware(ValidateCsrfToken::class)->name('stats.whatsapp');
Route::get('/', [SiteController::class, 'show'])->name('home');
Route::get('{slug}', [SiteController::class, 'show'])->where('slug', '[a-z0-9-]+')->name('page');
