<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainUiController;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\user\DashboardController;


Route::controller(MainUiController::class)->group(function(){
    Route::get('/', 'index');
});

Route::controller(AuthController::class)->group(function(){
    Route::get('/login', 'login');
    Route::get('/register','register');
});

Route::controller(DashboardController::class)->group(function(){
    Route::get('/user/dashboard', 'index');
    Route::get('/user/jadwal', 'jadwal');
    Route::get('/user/laporan', 'laporan');
    Route::get('user/laporan/all', 'laporanAll');
    Route::get('user/profile', 'profil');
});