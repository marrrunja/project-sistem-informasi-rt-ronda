@extends('template.template')
@section('title', 'Register')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Protest+Guerrilla&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('resources/css/main.css') }}">
@endpush


@section('body')
<section id="register" class="d-flex justify-content-center align-items-center pt-5 pb-5">
    <div class="container">
        <form class="needs-validation" method="post" action="{{ route('auth.register') }}">
            @csrf
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-12 col-md-7">
                    <div class="card shadow-sm border-0 p-3 p-md-5">
                        <div class="card-body">
                            <h3 class="card-title font-utama color-utama text-center">SIRATA</h3>
                            <h4 class="mb-3 text-center mt-3">Buat akun</h4>
                            <p class="text-center">Gabung SIRATA untuk lingkungan lebih aman</p>
                            @if(Session::has('status') && Session::has('message'))
                                <div class="alert {{ Session::get('status') === 'berhasil' ? 'alert-success':'alert-danger' }}" role="alert">
                                    {{ Session::get('message') }}
                                </div>
                            @endif
                            <div class="mb-3">
                                <label for="nama" class="form-label fw-semibold">Nama lengkap</label>
                                <input type="text" value="{{ old('nama_lengkap') ?? '' }}" name="nama_lengkap"
                                    class="form-control @error('nama_lengkap') is-invalid @enderror" id="nama"
                                    placeholder="Masukkan nama lengkap anda">
                                @error('nama_lengkap')
                                <span class="error invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="username" class="form-label fw-semibold">Username</label>
                                <input type="text" value="{{ old('username') ?? '' }}"
                                    class="form-control @error('username') is-invalid @enderror" name="username"
                                    id="username" placeholder="Masukkan username">
                                @error('username')
                                <span class="error invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label fw-semibold">Password</label>
                                <input type="password" name="password"
                                    class="form-control @error('password') is-invalid @enderror" id="password"
                                    placeholder="Masukkan password">
                                @error('password')
                                <span class="error invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password2" class="form-label fw-semibold">Konfirmasi Password</label>
                                <input type="password" name="password2"
                                    class="form-control @error('password2') is-invalid @enderror" id="password2"
                                    placeholder="Masukkan kembali password anda">
                                @error('password2')
                                <span class="error invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-success form-control fw-semibold">Register</button>
                            </div>
                            <div class="text">
                                <p class="text-center">Sudah punya akun? <a href="/login"
                                        class="color-utama fw-semibold">Login</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection


@push('scripts')
<script type="module" src="{{ asset('resources/js/register.js') }}"></script>
@endpush
