@extends('template.template')

@section('title', 'Dashboard')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Protest+Guerrilla&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('resources/css/main.css') }}">
<link rel="stylesheet" href="{{ asset('resources/css/upload.css') }}">

@endpush


@section('body')
@include('template.user-navbar')

<section id="welcome" class="pt-4 pb-3">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Laporan kejadian</h1>
            </div>
            <div class="col-12 mt-2">
                <p class="color-utama">Semua laporan kejadian yang ada di lingkungan Anda</p>
            </div>
        </div>
    </div>
</section>

<section id="profile" class="pb-5">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-10 col-xl-10">
                <div class="card px-4 py-4 border-0 shadow-sm">
                    <div class="card-header bg-white">
                        <div class="d-flex justify-content-between flex-column flex-md-row">
                            <h4>Informasi Pribadi</h4>
                             <p class="fs-5 mt-2 mt-md-0"><i class="bi bi-pencil me-2"></i>Ubah</p>
                        </div>
                    </div>
                    <div class="card-body">
                       <div class="mb-4">
                            <div class="fw-medium">Nama Lengkap</div>
                            <div class="fw-light">Muammmar Irfan</div>
                       </div>
                       <div class="mb-4">
                            <div class="fw-medium">Nomor Telfon</div>
                            <div class="fw-light">082255301884</div>
                       </div>
                       <div class="mb-4">
                            <div class="fw-medium">Alamat lengkap</div>
                            <div class="fw-light">Muammmar Irfan</div>
                       </div>
                       <div class="mb-4">
                            <div class="fw-medium">Status keanggotaan</div>
                            <div class="fw-light">Muammmar Irfan</div>
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('template.footer')
@endsection

@push('scripts')

@endpush
