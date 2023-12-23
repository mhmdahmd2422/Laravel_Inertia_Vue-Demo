<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

Route::get('login', [LoginController::class, 'create'])
    ->name('login');
Route::post('login', [LoginController::class, 'store']);
Route::post('/logout', [LoginController::class, 'destroy'])
    ->middleware('auth');

Route::middleware('auth')->group(function (){
    Route::inertia('/', 'Home');

    Route::get('/users', [UserController::class, 'index']);

    Route::get('/users/create', [UserController::class, 'create'])
        ->can('create', User::class);

    Route::post('/users', [UserController::class, 'store']);

    Route::inertia('/settings', 'Settings');

    Route::get('/users/{id}/edit', [UserController::class, 'edit']);

    Route::post('/users/update', [UserController::class, 'update']);
});
