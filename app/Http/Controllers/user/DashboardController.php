<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('user.main');
    }

    public function jadwal()
    {
        return view('user.jadwal');
    }

    public function laporan()
    {
        return view('user.laporan');
    }
    
    public function laporanAll()
    {
        return view('user.laporan-all');
    }

    public function profil(){
        return view('user.profile');
    }
}
