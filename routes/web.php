<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});


require_once __DIR__ . '/jetstream.php';
