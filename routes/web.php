<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;

Route::get('/', [AuthController::class,'login'])->name('login.index');

Route::post('/auth', [AuthController::class,'auth'])->name('login.auth');
Route::post('/logout',[AuthController::class,'logout'])->name('login.logout');

Route::get('/lobby', function(){
    return view('hello');
})->name('lobby');
