<?php

use App\Http\Controllers\Admin\AssistantController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\SiteSettingsController;
use App\Http\Controllers\Admin\ThemeController;
use App\Http\Controllers\SiteController;
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

    Route::get('themes', [ThemeController::class, 'index'])->name('themes.index');
    Route::put('themes', [ThemeController::class, 'update'])->name('themes.update');

    Route::get('messages', [MessageController::class, 'index'])->name('messages.index');
    Route::post('messages/{message}/read', [MessageController::class, 'read'])->name('messages.read');
    Route::delete('messages/{message}', [MessageController::class, 'destroy'])->name('messages.destroy');
});

require __DIR__.'/settings.php';

// Public website.
Route::get('sitemap.xml', [SiteController::class, 'sitemap'])->name('sitemap');
Route::get('robots.txt', [SiteController::class, 'robots']);
Route::post('kirim-pesan', [SiteController::class, 'contact'])->middleware('throttle:5,10')->name('contact.send');
Route::post('klik-wa', [SiteController::class, 'whatsappClick'])->middleware('throttle:30,1')->withoutMiddleware(ValidateCsrfToken::class)->name('stats.whatsapp');
Route::get('/', [SiteController::class, 'show'])->name('home');
Route::get('{slug}', [SiteController::class, 'show'])->where('slug', '[a-z0-9-]+')->name('page');
