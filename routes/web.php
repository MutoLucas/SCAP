<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LobbyController;

use App\Http\Middleware\VerifyAuth;

Route::get('/login', [AuthController::class,'login'])->name('login.index');

Route::post('/auth', [AuthController::class,'auth'])->name('login.auth');
Route::post('/logout',[AuthController::class,'logout'])->name('login.logout');

Route::get('/', [LobbyController::class,'lobbyIndex'])->name('lobby');

Route::get('/copyline/{lineId}',[LobbyController::class,'viewCopyLine'])->name('copyLine.index')->middleware(VerifyAuth::class);
Route::get('editline/{lineId}',[LobbyController::class,'viewEditLine'])->name('editLine.index');
