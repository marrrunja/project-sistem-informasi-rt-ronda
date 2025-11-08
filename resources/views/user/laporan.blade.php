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
                <h1>Laporkan kejadian</h1>
            </div>
            <div class="col-12 mt-2">
                <p class="color-utama">Gunakan formulir ini untuk melaporkan kejadian di lingkungan anda</p>
            </div>
        </div>
    </div>
</section>

<section id="laporan" class="pt-1 pb-3">
    <div class="container">
        <form action="">
            @csrf
            <div class="row">
                <div class="col-12 col-md-10">
                    <div class="card border-0 shadow-sm py-3 px-4">
                        <div class="mb-3">
                            <h3>Formulir Laporan</h3>
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Jenis Laporan</label>
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Pilih jenis laporan</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi Kejadian</label>
                            <textarea name="" rows="5" id="deskripsi" placeholder="Jelaskan kejadian secara rinci.."
                                class="form-control"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Unggah Satu Foto Bukti <span
                                    class="text-muted">(Optional)</span></label>
                            <div class="upload-box" id="uploadArea">
                                <input type="file" id="fileInput" accept=".png, .jpg, .jpeg">
                                <i class="bi bi-cloud-arrow-up mb-2"></i>
                                <div class="upload-label">Unggah file</div>
                                <p>PNG dan JPG hingga 10MB</p>
                            </div>
                        </div>
                        <div class="mb-3 text-end">
                            <button class="btn btn-utama w-sm-50 w-md-25" style="font-size:1.1rem;"><i
                                    class="bi bi-send-fill me-2"></i>Kirim</button>
                        </div>
                    </div>
                </div>
        </form>
    </div>
</section>

<section id="laporan-terbaru" class="pt-3 pb-3">
    <div class="container">
        <div class="row d-flex justify-content-between mb-3">
            <div class="col-sm-7 col-md-6">
                <h2>Laporan kejadian terbaru</h2>
            </div>
            <div class="col-4 ms-md-5">
                <a href="/user/laporan/all">Semua</a>
            </div>
        </div>
        <div class="row gy-3">
            <div class="col-12 col-md-10">
                <div class="card py-2 px-3 border-0">
                    <div class="card-body">
                        <div class="row d-flex justify-content-between align-items-center">
                            <div class="col-12 col-md-12 col-xl-10">
                                <div class="d-flex flex-column">
                                    <h5 class="card-title">Aktivitas Mencurigakan</h5>
                                    <div class="mb-2">Terlihat ada orang tidak dikenal berkeliling komplek pada malam hari, sekitar pukul 01.30 WIB di dekat Blok C.</div>
                                    <small>Dilaporkan oleh Dina Putri </small>
                                </div>

                            </div>
                            <div class="col-5 col-md-5 col-xl-2">
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
                                    <div class="mb-2">Terlihat ada orang tidak dikenal berkeliling komplek pada malam hari, sekitar pukul 01.30 WIB di dekat Blok C.</div>
                                    <small>Dilaporkan oleh Dina Putri </small>
                                </div>
                            </div>
                            <div class="col-5 col-md-5 col-xl-2">
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
@include('template.footer')
@endsection

@push('scripts')
<script src="{{ asset('resources/js/upload.js') }}">

</script>
@endpush
