<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainUiController;


Route::controller(MainUiController::class)->group(function(){
    Route::get('/', 'index');
});
