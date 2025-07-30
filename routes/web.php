<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// routes/web.php


Route::get('/test-log', function () {
    Log::info('Log dicatat dari /test-log');
    return 'Berhasil!';
});


Route::get('/', function () {
    return view('welcome');
});
