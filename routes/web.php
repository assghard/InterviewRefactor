<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('user/create', [UserController::class, 'create']);
Route::post('user/create', [UserController::class, 'save']);

Route::get('user/{id}', [UserController::class, 'edit']);
Route::post('user/{id}/update', [UserController::class, 'update']);

Route::get('user/{id}/delete', [UserController::class, 'delete']);
