@extends('template.template')
@section('title', 'Login')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Protest+Guerrilla&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('resources/css/main.css') }}">
@endpush


@section('body')
<section id="login" class="d-flex justify-content-center align-items-center pt-5 pb-5">
    <div class="container">
        <form action="">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-12 col-md-7">
                    <div class="card shadow-sm border-0 p-3 p-md-5">
                        <div class="card-body">
                            <h3 class="card-title font-utama color-utama text-center">SIRATA</h3>
                            <h4 class="mb-3 text-center mt-3">Buat akun</h4>
                            <p class="text-center">Gabung SIRATA untuk lingkungan lebih aman</p>
                            <div class="mb-3">
                                <label for="nama" class="form-label fw-semibold">Nama lengkap</label>
                                <input type="text" class="form-control" id="nama" placeholder="Masukkan nama lengkap anda">
                            </div>

                            <div class="mb-3">
                                <label for="username" class="form-label fw-semibold">Username</label>
                                <input type="text" class="form-control" id="username" placeholder="Masukkan username">
                            </div>
                            
                            <div class="mb-3">
                                <label for="password" class="form-label fw-semibold">Password</label>
                                <input type="password" class="form-control" id="password" placeholder="Masukkan password">
                            </div>

                            <div class="mb-3">
                                <label for="password2" class="form-label fw-semibold">Konfirmasi Password</label>
                                <input type="password" class="form-control" id="password2" placeholder="Masukkan kembali password anda">
                            </div>
                          

                            <div class="mb-3">
                                <button class="btn btn-success form-control fw-semibold">Register</button>
                            </div>
                            <div class="text">
                                <p class="text-center">Sudah punya akun? <a href="/login"class="color-utama fw-semibold">Login</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection
