<?php

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthService{
    
    public function register(array $data, ?string &$error = null)
    {
        $user = User::where('username', '=', $data['username'])->first();

        if($user){
            $error = "Username sudah ada";
            return false;
        }
        User::insert([
            'username'  => $data['username'],
            'password'  => Hash::make($data['password']),
            'nama_lengkap' => $data['nama_lengkap'],
            'created_at' => now(),
            'updated_at' => now()
        ]);
        return true;
    }

    public function login(array $data,?string &$id = null, ?string &$is_admin = null, ?string &$error = null)
    {
        $user = User::where('username', '=', $data['username'])->first();
        if ($user) {
            if (Hash::check($data['password'], $user->password)) {
                $id = $user->id;
                $is_admin = $user->is_admin == 1 ? true:false;
                return true;
            }
            $error = 'Username atau Password salah';
            return false;
        }
        $error = 'Username atau Password salah';
        return false;
    }

    public function logout()
    {

    }
}