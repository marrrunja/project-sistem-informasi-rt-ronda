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

<section id="laporan-all" class="pt-2 pb-4">
    <div class="container">
        <div class="row gy-3">
            <div class="col-12 col-md-10">
                <div class="card py-2 px-3 border-0">
                    <div class="card-body">
                        <div class="row d-flex justify-content-between align-items-center">
                            <div class="col-12 col-md-12 col-xl-10">
                                <div class="d-flex flex-column">
                                    <h5 class="card-title" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <a href="#" rel="noopener noreferrer"
                                            class="text-decoration-none text-dark">Aktivitas Mencurigakan</a>
                                    </h5>
                                    <div class="mb-2">Terlihat ada orang tidak dikenal berkeliling komplek pada malam
                                        hari, sekitar pukul 01.30 WIB di dekat Blok C.</div>
                                    <small>Dilaporkan oleh Dina Putri </small>
                                </div>

                            </div>
                            <div class="col-5 col-md-8 col-xl-2">
                                <div class="d-flex flex-column">
                                    <small>4 November 2025</small>
                                    <span class="badge text-bg-primary w-sm-25 w-md-25 w-lg-25 mt-2">Diajukan</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-12 col-md-10">
                <div class="card py-2 px-3 border-0">
                    <div class="card-body">
                        <div class="row d-flex justify-content-between align-items-center">
                            <div class="col-12 col-md-12 col-xl-10">
                                <div class="d-flex flex-column">
                                    <h5 class="card-title">Aktivitas Mencurigakan</h5>
                                    <div class="mb-2">Terlihat ada orang tidak dikenal berkeliling komplek pada malam
                                        hari, sekitar pukul 01.30 WIB di dekat Blok C.</div>
                                    <small>Dilaporkan oleh Dina Putri </small>
                                </div>

                            </div>
                            <div class="col-5 col-md-8 col-xl-2">
                                <div class="d-flex flex-column">
                                    <small>4 November 2025</small>
                                    <span class="badge text-bg-primary w-sm-25 w-md-25 w-lg-25 mt-2">Diajukan</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-12 col-md-10">
                <div class="card py-2 px-3 border-0">
                    <div class="card-body">
                        <div class="row d-flex justify-content-between align-items-center">
                            <div class="col-12 col-md-12 col-xl-10">
                                <div class="d-flex flex-column">
                                    <h5 class="card-title">Aktivitas Mencurigakan</h5>
                                    <div class="mb-2">Terlihat ada orang tidak dikenal berkeliling komplek pada malam
                                        hari, sekitar pukul 01.30 WIB di dekat Blok C.</div>
                                    <small>Dilaporkan oleh Dina Putri </small>
                                </div>
                            </div>
                            <div class="col-5 col-md-8 col-xl-2">
                                <div class="d-flex flex-column">
                                    <small>4 November 2025</small>
                                    <span class="badge text-bg-warning w-sm-25 w-md-25 w-lg-25 mt-2">Ditinjau</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <div class="d-flex flex-column gy-3">
                    <h1 class="modal-title fs-5 mb-1" id="exampleModalLabel">Aktivitas Mencurigakan</h1>
                    <small>Dilaporkan Oleh Dina</small>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="d-flex flex-column">
                        <div class="mb-2">Deskripsi Kejadian</div>
                        <div class="text-body-secondary">
                            Terlihat ada orang tidak dikenal berkeliling komplek pada malam hari, sekitar pukul 01.30
                            WIB lebih tepatnya pada Blok C. Orang tersebut menggunakan jaket kulit hitam dan topi hitam,
                            berjalan kaki sambil melihat-lihat ke arah rumah warga. Cukup mencurigakan karena sudah
                            larut malam.
                        </div>
                        <div class="fw-semibold mb-2 mt-2">Bukti Foto</div>

                        <div class="card border-0 text-bg-dark" style="width:200px;" data-bs-toggle="modal"
                            data-bs-target="#modalFoto">
                            <img src="{{ asset('resources/images/placeholder.png') }}" class="card-img" alt="...">
                        </div>

                        <div class="fw-semibold mt-2 mb-2">
                            Status & Tindak Lanjut
                        </div>
                        <div class="mt-2">

                            <div class="mb-2">Riwayat Pengajuan</div>
                            <ul>
                                <li>
                                    <div class="text-dark">Laporan diajukan</div>
                                    <div class="text-body-secondary">
                                        Laporan telah berhasil dikirim dan menunggu verifikasi ketua RT
                                    </div>
                                </li>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-utama" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="modalFoto" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true"
    aria-labelledby="modalFoto" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn-close"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card border-0 text-bg-dark">
                    <img src="{{ asset('resources/images/placeholder.png') }}" class="card-img" alt="foto bukti">
                </div>
            </div>
        </div>
    </div>
</div>

@include('template.footer')
@endsection

@push('scripts')
<script src="{{ asset('resources/js/upload.js') }}">

</script>
@endpush
