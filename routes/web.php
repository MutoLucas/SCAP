<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LobbyController;

use App\Http\Middleware\VerifyAuth;

Route::get('/', [AuthController::class,'login'])->name('login.index');

Route::post('/auth', [AuthController::class,'auth'])->name('login.auth');
Route::post('/logout',[AuthController::class,'logout'])->name('login.logout');

Route::get('/lobby', [LobbyController::class,'lobbyIndex'])->name('lobby')->middleware(VerifyAuth::class);
