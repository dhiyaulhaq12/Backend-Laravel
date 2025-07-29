<?php

// use App\Http\Controllers\Controller;
use App\Http\Controllers\itemController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Resource API route untuk Item, tapi menggunakan PostController
Route::apiResource('items', itemController::class);
Route::apiResource('users', UserController::class);