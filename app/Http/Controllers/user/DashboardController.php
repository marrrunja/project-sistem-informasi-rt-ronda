<?php

namespace App\Http\Controllers\user;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = User::where('username', $request->session()->get('username'))->first();
        $data= [
            'data' => $user
        ];
        return view('user.main', $data);
    }

    public function jadwal()
    {
        return view('user.jadwal');
    }



    public function profil(){
        return view('user.profile');
    }
}
