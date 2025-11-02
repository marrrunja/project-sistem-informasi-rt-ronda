@extends('template.template')
@section('title', 'Login')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Protest+Guerrilla&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('resources/css/main.css') }}">
@endpush


@section('body')
<section id="login" class="d-flex justify-content-center align-items-center" style="height:100vh">
    <div class="container">
        <form action="">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-12 col-md-7">
                    <div class="card shadow-sm border-0 p-3 p-md-5">
                        <div class="card-body">
                            <h3 class="card-title font-utama color-utama text-center">SIRATA</h3>
                            <h4 class="mb-3 text-center mt-3">Login Akun</h4>
                            <div class="mb-3">
                                <label for="username" class="form-label fw-semibold">Username</label>
                                <input type="text" class="form-control" id="username" placeholder="Masukkan username">


                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label fw-semibold">Password</label>
                                <input type="passowrd" class="form-control" id="password" placeholder="Masukkan password">
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-success form-control fw-semibold">Login</button>
                            </div>
                            <div class="text">
                                <p class="text-center">Belum punya akun? <a href="/register"class="color-utama fw-semibold">Register</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection
