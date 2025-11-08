@extends('template.template')

@section('title', 'Dashboard')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Protest+Guerrilla&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('resources/css/main.css') }}">
@endpush


@section('body')
@include('template.user-navbar')

<section id="welcome" class="pt-4 pb-3">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10">
                <h1>Jadwal Ronda Minggu ini</h1>
            </div>
            <div class="col-12 col-md-10 mt-2">
                <p class="color-utama">Jadwal diperbarui admin setiap minggu</p>
            </div>
        </div>
    </div>
</section>

<section id="id" class="pt-3 pb-4">
    <div class="container">
        <div class="row justify-content-center gap-3">
            <div class="col-12 col-md-10">
                <div class="card border-0 shadow-sm px-4 py-3">
                    <div class="card-header bg-transparent py-3">
                        <div class="row">
                            <div class="col-4 col-md-4 col-xl-2">
                                <div class="">
                                    <div class="card py-2 bg-active">
                                        <div class="d-flex flex-column justify-content-center align-items-center">
                                            <h4>02</h4>
                                            <div>Nov</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-md-6 col-xl-4 mt-2">
                                <div class="d-flex flex-column">
                                    <h4 class="fw-bold">Senin</h4>
                                    <div>
                                        19:00 - 06:00
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive-md">
                            <table class="table table-hover">
                                <thead>
                                    <tr class="table-secondary py-3">
                                        <td scope="col" class="text-center fw-semibold">NAMA</td>
                                        <td scope="col" class="text-center fw-semibold">ALAMAT</td>
                                        <td scope="col" class="text-center fw-semibold">STATUS KEHADIRAN</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">Dina</td>
                                        <td class="text-center">Blok P9</td>
                                        <td class="text-center"><span class="badge text-bg-secondary">Hadir</span></td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">Muammar</td>
                                        <td class="text-center">Blok P2</td>
                                        <td class="text-center"><span class="badge text-bg-secondary">Hadir</span></td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">Taufik</td>
                                        <td class="text-center">Blok P3</td>
                                        <td class="text-center"><span class="badge text-bg-secondary">Hadir</span></td>
                                    </tr>
                                   
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-10">
                <div class="card border-0 shadow-sm px-4 py-3">
                    <div class="card-header bg-transparent py-3">
                        <div class="row">
                            <div class="col-4 col-md-4 col-xl-2">
                                <div class="">
                                    <div class="card py-2 bg-active">
                                        <div class="d-flex flex-column justify-content-center align-items-center">
                                            <h4>02</h4>
                                            <div>Nov</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-md-6 col-xl-4 mt-2">
                                <div class="d-flex flex-column">
                                    <h4 class="fw-bold">Senin</h4>
                                    <div>
                                        19:00 - 06:00
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive-md">
                            <table class="table table-hover">
                                <thead>
                                    <tr class="table-secondary py-3">
                                        <td scope="col" class="text-center fw-semibold">NAMA</td>
                                        <td scope="col" class="text-center fw-semibold">ALAMAT</td>
                                        <td scope="col" class="text-center fw-semibold">STATUS KEHADIRAN</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">Dina</td>
                                        <td class="text-center">Blok P9</td>
                                        <td class="text-center"><span class="badge text-bg-secondary">Hadir</span></td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">Muammar</td>
                                        <td class="text-center">Blok P2</td>
                                        <td class="text-center"><span class="badge text-bg-secondary">Hadir</span></td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">Taufik</td>
                                        <td class="text-center">Blok P3</td>
                                        <td class="text-center"><span class="badge text-bg-secondary">Hadir</span></td>
                                    </tr>
                                   
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-10">
                <div class="card border-0 shadow-sm px-4 py-3">
                    <div class="card-header bg-transparent py-3">
                        <div class="row">
                            <div class="col-4 col-md-4 col-xl-2">
                                <div class="">
                                    <div class="card py-2 bg-active">
                                        <div class="d-flex flex-column justify-content-center align-items-center">
                                            <h4>02</h4>
                                            <div>Nov</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-md-6 col-xl-4 mt-2">
                                <div class="d-flex flex-column">
                                    <h4 class="fw-bold">Senin</h4>
                                    <div>
                                        19:00 - 06:00
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive-md">
                            <table class="table table-hover">
                                <thead>
                                    <tr class="table-secondary py-3">
                                        <td scope="col" class="text-center fw-semibold">NAMA</td>
                                        <td scope="col" class="text-center fw-semibold">ALAMAT</td>
                                        <td scope="col" class="text-center fw-semibold">STATUS KEHADIRAN</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">Dina</td>
                                        <td class="text-center">Blok P9</td>
                                        <td class="text-center"><span class="badge text-bg-secondary">Hadir</span></td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">Muammar</td>
                                        <td class="text-center">Blok P2</td>
                                        <td class="text-center"><span class="badge text-bg-secondary">Hadir</span></td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">Taufik</td>
                                        <td class="text-center">Blok P3</td>
                                        <td class="text-center"><span class="badge text-bg-secondary">Hadir</span></td>
                                    </tr>
                                   
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-10">
                <div class="card border-0 shadow-sm px-4 py-3">
                    <div class="card-header bg-transparent py-3">
                        <div class="row">
                            <div class="col-4 col-md-4 col-xl-2">
                                <div class="">
                                    <div class="card py-2 bg-active">
                                        <div class="d-flex flex-column justify-content-center align-items-center">
                                            <h4>02</h4>
                                            <div>Nov</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-md-6 col-xl-4 mt-2">
                                <div class="d-flex flex-column">
                                    <h4 class="fw-bold">Senin</h4>
                                    <div>
                                        19:00 - 06:00
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive-md">
                            <table class="table table-hover">
                                <thead>
                                    <tr class="table-secondary py-3">
                                        <td scope="col" class="text-center fw-semibold">NAMA</td>
                                        <td scope="col" class="text-center fw-semibold">ALAMAT</td>
                                        <td scope="col" class="text-center fw-semibold">STATUS KEHADIRAN</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">Dina</td>
                                        <td class="text-center">Blok P9</td>
                                        <td class="text-center"><span class="badge text-bg-secondary">Hadir</span></td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">Muammar</td>
                                        <td class="text-center">Blok P2</td>
                                        <td class="text-center"><span class="badge text-bg-secondary">Hadir</span></td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">Taufik</td>
                                        <td class="text-center">Blok P3</td>
                                        <td class="text-center"><span class="badge text-bg-secondary">Hadir</span></td>
                                    </tr>
                                   
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-10">
                <div class="card border-0 shadow-sm px-4 py-3">
                    <div class="card-header bg-transparent py-3">
                        <div class="row">
                            <div class="col-4 col-md-4 col-xl-2">
                                <div class="">
                                    <div class="card py-2 bg-active">
                                        <div class="d-flex flex-column justify-content-center align-items-center">
                                            <h4>02</h4>
                                            <div>Nov</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-md-6 col-xl-4 mt-2">
                                <div class="d-flex flex-column">
                                    <h4 class="fw-bold">Senin</h4>
                                    <div>
                                        19:00 - 06:00
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive-md">
                            <table class="table table-hover">
                                <thead>
                                    <tr class="table-secondary py-3">
                                        <td scope="col" class="text-center fw-semibold">NAMA</td>
                                        <td scope="col" class="text-center fw-semibold">ALAMAT</td>
                                        <td scope="col" class="text-center fw-semibold">STATUS KEHADIRAN</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">Dina</td>
                                        <td class="text-center">Blok P9</td>
                                        <td class="text-center"><span class="badge text-bg-secondary">Hadir</span></td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">Muammar</td>
                                        <td class="text-center">Blok P2</td>
                                        <td class="text-center"><span class="badge text-bg-secondary">Hadir</span></td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">Taufik</td>
                                        <td class="text-center">Blok P3</td>
                                        <td class="text-center"><span class="badge text-bg-secondary">Hadir</span></td>
                                    </tr>
                                   
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-10">
                <div class="card border-0 shadow-sm px-4 py-3">
                    <div class="card-header bg-transparent py-3">
                        <div class="row">
                            <div class="col-4 col-md-4 col-xl-2">
                                <div class="">
                                    <div class="card py-2 bg-active">
                                        <div class="d-flex flex-column justify-content-center align-items-center">
                                            <h4>02</h4>
                                            <div>Nov</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-md-6 col-xl-4 mt-2">
                                <div class="d-flex flex-column">
                                    <h4 class="fw-bold">Senin</h4>
                                    <div>
                                        19:00 - 06:00
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive-md">
                            <table class="table table-hover">
                                <thead>
                                    <tr class="table-secondary py-3">
                                        <td scope="col" class="text-center fw-semibold">NAMA</td>
                                        <td scope="col" class="text-center fw-semibold">ALAMAT</td>
                                        <td scope="col" class="text-center fw-semibold">STATUS KEHADIRAN</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">Dina</td>
                                        <td class="text-center">Blok P9</td>
                                        <td class="text-center"><span class="badge text-bg-secondary">Hadir</span></td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">Muammar</td>
                                        <td class="text-center">Blok P2</td>
                                        <td class="text-center"><span class="badge text-bg-secondary">Hadir</span></td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">Taufik</td>
                                        <td class="text-center">Blok P3</td>
                                        <td class="text-center"><span class="badge text-bg-secondary">Hadir</span></td>
                                    </tr>
                                   
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-10">
                <div class="card border-0 shadow-sm px-4 py-3">
                    <div class="card-header bg-transparent py-3">
                        <div class="row">
                            <div class="col-4 col-md-4 col-xl-2">
                                <div class="">
                                    <div class="card py-2 bg-active">
                                        <div class="d-flex flex-column justify-content-center align-items-center">
                                            <h4>02</h4>
                                            <div>Nov</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-md-6 col-xl-4 mt-2">
                                <div class="d-flex flex-column">
                                    <h4 class="fw-bold">Senin</h4>
                                    <div>
                                        19:00 - 06:00
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive-md">
                            <table class="table table-hover">
                                <thead>
                                    <tr class="table-secondary py-3">
                                        <td scope="col" class="text-center fw-semibold">NAMA</td>
                                        <td scope="col" class="text-center fw-semibold">ALAMAT</td>
                                        <td scope="col" class="text-center fw-semibold">STATUS KEHADIRAN</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">Dina</td>
                                        <td class="text-center">Blok P9</td>
                                        <td class="text-center"><span class="badge text-bg-secondary">Hadir</span></td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">Muammar</td>
                                        <td class="text-center">Blok P2</td>
                                        <td class="text-center"><span class="badge text-bg-secondary">Hadir</span></td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">Taufik</td>
                                        <td class="text-center">Blok P3</td>
                                        <td class="text-center"><span class="badge text-bg-secondary">Hadir</span></td>
                                    </tr>
                                   
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>

@include('template.footer')
@endsection
