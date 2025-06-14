<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BookController;

Route::resource('/products', ProductController::class);

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/books', BookController::class);