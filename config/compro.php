<?php

/*
 * Mudah Website settings that come from the container's environment. On MudahCloud
 * these are set by the app template on Easypanel when a customer buys the app.
 */
return [

    // The first admin account, created on boot when the site has no users yet.
    'admin' => [
        'name' => env('ADMIN_NAME', 'Admin'),
        'email' => env('ADMIN_EMAIL'),
        'password' => env('ADMIN_PASSWORD'),
    ],

    // The template a new site starts with (korporat, modern, minimalis, spa, kue, sekolah, sma,
    // umroh, ac), with that template's sample pages. Only used on the first boot; afterwards the
    // owner picks templates in the admin.
    'theme' => env('SITE_THEME'),

    // A demo site (MudahCloud's demoweb.mudah.cloud): visitors browse every template's sample
    // pages with ?tema=<template>, without signing in. Nothing is saved.
    'demo' => (bool) env('DEMO_MODE', false),

    // The key MudahCloud's client area uses to act for the owner (MudahCloudController). Empty: off.
    'mudahcloud_key' => env('MUDAHCLOUD_KEY'),

    // Where the owner tops up their MudahCloud AI credit (the AI assistant runs on it).
    'ai_topup_url' => env('MUDAHCLOUD_AI_URL', 'https://mudahcloud.com/ai'),

    // The owner's time zone: blog post dates are shown and scheduled in it.
    'timezone' => env('SITE_TIMEZONE', 'Asia/Jakarta'),

];
