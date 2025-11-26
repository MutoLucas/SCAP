<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LobbyController;
use App\Http\Controllers\ShiftController;

use App\Http\Middleware\VerifyAuth;
use App\Http\Middleware\VerifyAdmin;

Route::get('/login', [AuthController::class,'login'])->name('login.index');

Route::post('/auth', [AuthController::class,'auth'])->name('login.auth');
Route::post('/logout',[AuthController::class,'logout'])->name('login.logout');

Route::get('/', [LobbyController::class,'lobbyIndex'])->name('lobby');

Route::get('/copyline/{lineId}',[LobbyController::class,'viewCopyLine'])->name('copyLine.index')->middleware(VerifyAuth::class);
Route::get('/editline/{lineId}',[LobbyController::class,'viewEditLine'])->name('editLine.index');
Route::get('/newline',[LobbyController::class,'viewNewLine'])->name('newLine.index')->middleware(VerifyAuth::class);;

Route::prefix('/users')->middleware(VerifyAuth::class)->group(function (){
    Route::get('/lobby',[UserController::class,'showIndex'])->name('users.index');

    Route::get('/profile',[UserController::class,'showProfile'])->name('users.profile');
});

Route::prefix('shifts')->middleware([VerifyAuth::class])->group(function (){
    Route::get('/lobby',[ShiftController::class,'lobbyIndex'])->name('shift.index');
});
