<?php

use App\Http\Middleware\IsLogin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\NotificationController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(IsLogin::class)->group(function () {
    // LIST ROUTE BUAT HALAMAN YANG PERLU LOGIN TERLEBIH DAHULU
    // TARUH DI SINI YAAA
});

// LIST API 
// KALO MAU AMBIL DATA TINGGAL FETCH LEWAT ROUTE INI 
Route::get('/api/notification', [NotificationController::class, 'index'])->name('notification.index');
Route::get('/api/product', [ProductController::class, 'index'])->name('product.index');




