<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/public', function () {
    return Inertia::render('Public/Home');
});

Route::get('/public/info', function () {
    phpinfo();
});
