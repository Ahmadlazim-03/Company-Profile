<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ContentController;

Route::get('/', function () {
    return view('welcome');
});

// Rute untuk notifikasi
Route::get('/notifications', [NotificationController::class, 'index']);
Route::get('/notifications/{id}', [NotificationController::class, 'show']);
Route::get('/notifications-form', function () {
    return view('form.notifications');
});
Route::prefix('api')->group(function () {
    // Route::get('/notifications', [NotificationController::class, 'index']);
    Route::post('/notifications', [NotificationController::class, 'store']);
    Route::put('/notifications/{id}', [NotificationController::class, 'update']);
    Route::delete('/notifications/{id}', [NotificationController::class, 'destroy']);
});

// Rute untuk konten
Route::get('/contents', [ContentController::class, 'index']);
Route::get('/contents/{id}', [ContentController::class, 'show']);
Route::get('/contents-form', function () {
    return view('form.contents');
});
Route::prefix('api')->group(function () {
    Route::post('/contents', [ContentController::class, 'store']);
    Route::put('/contents/{id}', [ContentController::class, 'update']);
    Route::delete('/contents/{id}', [ContentController::class, 'destroy']);
});

// Rute untuk mahasiswa
Route::get('/mhs', [MahasiswaController::class, 'index']);
Route::get('/mhs/{id}', [MahasiswaController::class, 'show']);
Route::get('/mhs-form', function () {
    return view('form.mahasiswa');
});
Route::prefix('api')->group(function () {
    Route::post('/mhs', [MahasiswaController::class, 'store']);
    Route::put('/mhs/{id}', [MahasiswaController::class, 'update']);
    Route::delete('/mhs/{id}', [MahasiswaController::class, 'destroy']);
});

// Rute untuk pengguna biasa
Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{id}', [UserController::class, 'show']);
Route::get('/users-form', function () {
    return view('form.users');
});
Route::prefix('api')->group(function () {
    Route::post('/users', [MahasiswaController::class, 'store']);
    Route::put('/users/{id}', [MahasiswaController::class, 'update']);
    Route::delete('/users/{id}', [MahasiswaController::class, 'destroy']);
});