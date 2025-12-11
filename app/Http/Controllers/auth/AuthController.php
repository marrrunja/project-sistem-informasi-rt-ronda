<?php

namespace App\Http\Controllers\auth;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Services\Auth\AuthService;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class AuthController extends Controller
{
    
    public function __construct(private AuthService $authService){}

    public function login()
    {
        return view('auth.login');
    }
    
    public function register()
    {
        return view('auth.register');
    }

    public function doRegister(Request $request):RedirectResponse{
        $data = [
            'username' => $request->username,
            'nama_lengkap' => $request->nama_lengkap,
            'password' => $request->password,
            'password2' => $request->password2
        ];
        $pesan_validasi = [
            'username.required' => 'Username harus diisi!',
            'username.min' => 'Username minimal 5 karakter!',
            'username.max' => 'Username maximal 10 karakter!',
            'username.alpha_dash' => 'Username tidak boleh memiliki spasi!!',
            'nama_lengkap.required' => 'Nama lengkap harus diisi!',
            'nama_lengkap.min' => 'Nama lengkap Minimal 5 karakter!',
            'nama_lengkap.max' => 'Nama lengkap maksimal 20 karakter!',
            'password.required' => 'Password harus diisi!',
            'password.min' => 'Password minimal 5 karakter!',
            'password2.required' => 'Konfirmasi password harus diisi!',
            'password2.same' => 'Harap samakan dengan password!'
        ];
        $request->validate(
            [
            'username' => ['required', 'min:5', 'max:10', 'alpha_dash'],
            'nama_lengkap' => ['required', 'min:5', 'max:20'],
            'password' => ['required', 'min:5'],
            'password2' => ['required', 'same:password']
            ]
        ,
        $pesan_validasi
        );
        $error = null;
        if($this->authService->register($data, $error)){
            return redirect()->back()->with([
                'status' => 'berhasil',
                'message' => 'Berhasil register'
            ]);
        }
        
       return redirect()->back()->with([
            'status' => 'gagal',
            'message' => 'Gagal register '. $error
        ]);

    }
    public function doLogin(Request $request){
        $data = [
            'username' => $request->username,
            'password' => $request->password
        ];
        $rules_validasi = [
            'username' => 'required',
            'password' => 'required'
        ];
        $pesan_validasi = [
            'username.required' => 'Username harus diisi',
            'password.required' => 'Password harus diisi'
        ];
        $request->validate($rules_validasi, $pesan_validasi);

        $error = null;
        $id = null;
        $is_admin = null;
        if($this->authService->login($data,$id, $is_admin, $error)){
            $request->session()->put('username', $data['username']);
            $request->session()->put('user_id', $id);
            $request->session()->put('is_login', true);
            if($is_admin == false){
                $request->session()->put('is_admin', $is_admin);
                return redirect('/user/dashboard');
            }
            else{
                $request->session()->put('is_admin', $is_admin);
                return redirect('/admin');
            }
        }
        else{
            return redirect()->back()->with('status', $error);
        }
    }

    public function logout(Request $request){
        $request->session()->forget('is_login');
        $request->session()->forget('is_admin');
        $request->session()->forget('username');
        return redirect('/');
    }
}
