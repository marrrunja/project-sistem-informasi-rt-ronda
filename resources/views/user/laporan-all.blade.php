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
                                    <h5 class="card-title">Aktivitas Mencurigakan</h5>
                                    <div class="mb-2">Terlihat ada orang tidak dikenal berkeliling komplek pada malam hari, sekitar pukul 01.30 WIB di dekat Blok C.</div>
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
                                    <div class="mb-2">Terlihat ada orang tidak dikenal berkeliling komplek pada malam hari, sekitar pukul 01.30 WIB di dekat Blok C.</div>
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
                                    <div class="mb-2">Terlihat ada orang tidak dikenal berkeliling komplek pada malam hari, sekitar pukul 01.30 WIB di dekat Blok C.</div>
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
@include('template.footer')
@endsection

@push('scripts')
<script src="{{ asset('resources/js/upload.js') }}">

</script>
@endpush

