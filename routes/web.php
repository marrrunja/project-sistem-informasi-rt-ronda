<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainUiController;
use App\Http\Controllers\AbsensiController;
use App\Http\Middleware\OnlyUserMiddleware;
use App\Http\Middleware\OnlyLoginMiddleware;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\user\AdminController;
use App\Http\Controllers\user\ReportController;
use App\Http\Middleware\OnlyNotLoginMiddleware;
use App\Http\Controllers\api\ApiReportController;
use App\Http\Controllers\user\DashboardController;


Route::controller(MainUiController::class)->group(function(){
    Route::get('/', 'index');
});

Route::controller(AuthController::class)->group(function(){
    Route::get('/login', 'login')->middleware(OnlyNotLoginMiddleware::class);
    Route::get('/register','register')->middleware(OnlyNotLoginMiddleware::class);
    Route::post('/register','doRegister')->middleware(OnlyNotLoginMiddleware::class)->name('auth.register');
    Route::post('/login', 'doLogin')->middleware(OnlyNotLoginMiddleware::class)->name('auth.login');
    Route::post('/logout', 'logout')->name('auth.logout');
});

Route::middleware([OnlyUserMiddleware::class, OnlyLoginMiddleware::class])->controller(DashboardController::class)->group(function(){
    Route::get('/user/dashboard', 'index');
    Route::get('/user/jadwal', 'jadwal');
    Route::get('/user/profile', 'profil');
    Route::get('/user/detail', 'getDetail');
    Route::post('/user/edit', 'editData');
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


Route::controller(AdminController::class)->group(function(){
    Route::get('/admin', 'index');
    Route::get('/admin/laporan', 'laporan');
    Route::get('/admin/detail/laporan/{id}', 'detailLaporan');
    Route::post('admin/ubah-laporan/{id}', 'ubahLaporan')->name('admin.ubah-laporan');
    Route::get('/admin/manage', 'manage');
    Route::post('/admin/blokir', 'doBlokir');
    Route::post('/admin/bukablokir', 'bukaBlokir');
    Route::get('/admin/jadwal', 'jadwal');
    Route::post('/admin/add/jadwal', 'makeJadwal');
    Route::get('/jadwal/detail/{id}', 'detailJadwal');
    Route::post('/jadwal/nonaktif/{id}', 'nonaktif')->name('jadwal.non_aktifkan');
    Route::post('/jadwal/aktifkan/{id}', 'aktifkan')->name('jadwal.aktifkan');
});


Route::controller(AbsensiController::class)->group(function(){
    Route::post('absensi/add/{id}', 'add')->name('absensi.add');
    Route::post('/absensi/hapus/{id}', 'hapus')->name('absensi.hapus');
    Route::post('/absensi/ubah', 'ubah');
});
