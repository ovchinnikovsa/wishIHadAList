<?php

use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\VkController;
use App\Http\Controllers\Auth\YandexController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');
Route::view('landing', 'landing');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('google.login');
Route::get('/auth/google/callback', [GoogleController::class, 'callback']);

Route::get('/auth/yandex', [YandexController::class, 'redirect'])->name('yandex.login');
Route::get('/auth/yandex/callback', [YandexController::class, 'callback']);

Route::get('/auth/vk', [VkController::class, 'redirect'])->name('vk.login');
Route::get('/auth/vk/callback', [VkController::class, 'callback']);

require __DIR__ . '/auth.php';

