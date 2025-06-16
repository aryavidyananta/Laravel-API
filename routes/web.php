<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BookController;

Route::resource('/products', ProductController::class);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login-page', function () {
    return view('auth.login');
});
Route::get('/register-page', function () {
    return view('auth.register');
});

Route::get('/auth', function () {
    return view('auth.auth');
});

Route::resource('/books', BookController::class);