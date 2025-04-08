<?php

use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\IsLogin;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware(IsLogin::class)->group(function () {
   
});

// Route API buat fetch data
Route::prefix('api')->group(function () {
// API NOTIFICATION
    Route::get('/notification', [NotificationController::class, 'index'])->name('notification.index');
    Route::post('/notification', [NotificationController::class, 'store'])->name('notification.store');
    Route::get('/notification/{id}', [NotificationController::class, 'show'])->name('notification.show');
    Route::put('/notification/{id}', [NotificationController::class, 'update'])->name('notification.update');
    Route::patch('/notification/{id}', [NotificationController::class, 'update'])->name('notification.update.alternate');
    Route::delete('/notification/{id}', [NotificationController::class, 'destroy'])->name('notification.destroy');
// API PRODUCT
    Route::get('/product', [ProductController::class, 'index'])->name('product.index');
    Route::post('/product', [ProductController::class, 'store'])->name('product.store');
    Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');
    Route::put('/product/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::patch('/product/{id}', [ProductController::class, 'update'])->name('product.update.alternate');
    Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
});

// Route API yang perlu login
Route::prefix('api')->middleware(IsLogin::class)->group(function () {
   
});