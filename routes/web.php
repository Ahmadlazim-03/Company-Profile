<?php

use App\Http\Middleware\IsLogin;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware(IsLogin::class)->group(function () {
   
});
