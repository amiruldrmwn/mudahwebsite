<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Smaller copies for photos added outside an upload (template photos, older uploads).
Schedule::command('compro:image-sizes')->everyTenMinutes()->withoutOverlapping();
