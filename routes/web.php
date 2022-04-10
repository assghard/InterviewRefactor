<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('homepage');
})->name('homepage');

Route::resource('users', UserController::class)->except(['show']);
