<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainUiController;
use App\Http\Middleware\OnlyUserMiddleware;
use App\Http\Middleware\OnlyLoginMiddleware;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\user\ReportController;
use App\Http\Controllers\api\ApiReportController;
use App\Http\Controllers\user\DashboardController;


Route::controller(MainUiController::class)->group(function(){
    Route::get('/', 'index');
});

Route::controller(AuthController::class)->group(function(){
    Route::get('/login', 'login');
    Route::get('/register','register');
    Route::post('/register','doRegister')->name('auth.register');
    Route::post('/login', 'doLogin')->name('auth.login');
    Route::post('/logout', 'logout')->name('auth.logout');
});

Route::middleware([OnlyUserMiddleware::class, OnlyLoginMiddleware::class])->controller(DashboardController::class)->group(function(){
    Route::get('/user/dashboard', 'index');
    Route::get('/user/jadwal', 'jadwal');
    Route::get('user/profile', 'profil');
});

Route::middleware([OnlyUserMiddleware::class, OnlyLoginMiddleware::class])->controller(ReportController::class)->group(function(){
    Route::get('/user/laporan', 'laporan');
    Route::get('user/laporan/all', 'laporanAll');
    Route::post('/user/laporan/add', 'tambahLaporan')->name('reports.add');
});
Route::middleware([OnlyUserMiddleware::class, OnlyLoginMiddleware::class])->controller(ApiReportController::class)->group(function(){
    Route::get('/report/get', 'getData');
    Route::get('/report/total', 'getTotalData');
    Route::get("/report/detail", 'getDetailData');
    Route::get("/report/foto", 'getFoto');
});