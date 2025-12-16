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
        <div class="row">
            <div class="col-12">
                <h1>Selamat datang, {{ Session::get('username') }}</h1>
            </div>
            <div class="col-12 mt-2">
                <p class="color-utama">Berikut adalah ringkasan informasi keamanan di lingkungan Anda</p>
            </div>
        </div>
    </div>
</section>

<section id="main" class="pt-2 pb-5">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-12 col-xl-8">
                <div class="row mb-2">
                    <div class="col-12 col-md-6 col-xl-6 mb-2 mb-md-2 mb-xl-0">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body p-4">
                                <div class="row d-flex align-items-center">
                                    <div
                                        class="col-12 col-md-12 col-xl-3 me-0 text-center text-md-center text-xl-start">
                                        <i class="bi bi-person-circle fw-bold" style="font-size:4rem;"></i>
                                    </div>
                                    <div
                                        class="col-12 col-md-12 ms-0 col-xl-9 text-center text-md-center text-xl-start">
                                        <h3 class="fw-semibold">{{$user->nama_lengkap}}</h3>
                                        <div class="fw-light">{{$user->alamat ?? '-'}}</div>
                                        <div class="fw-semibold color-utama">{{$user->status == 1 ? 'Anggota Ronda Aktif': 'Anggota Tidak Aktif'}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-xl-6 mb-2 mb-md-2 mb-xl-0">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body p-3">
                                <h5 class="card-title mt-2">Absensi Ronda</h5>
                                @if($absensi_user && $absensi_user->clear_absen != 1)
                                <p class="card-text">
                                    {{ \Carbon\Carbon::parse($absensi_user->jadwal_masuk)->translatedFormat('l, j F Y') }}
                                </p>
                                <div class="d-flex gap-2">
                                    <button class="btn btn-utama border-0 shadow-sm  w-50" id="btnHadir" data-id="{{ $absensi_user->id_absen }}">Hadir</button>
                                    <button class="btn btn-secondary border-0 shadow-sm w-50" id="btnIzin" data-id="{{ $absensi_user->id_absen }}">Izin</button>
                                </div>
                                @elseif($absensi_user && $absensi_user->clear_absen == 1)
                                    <p class="mb-4 mt-2">Anda sudah melakukan absensi:)</p>
                                @else
                                    <p class="mb-4 mt-2">Anda belum terdaftar di jadwal</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-2 mb-md-2 mb-xl-0">
                    <div class="col-12">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body p-4">
                                <h5 class="card-title mb-3">Jadwal Ronda</h5>
                                <div class="row">
                                    @foreach($jadwals as $jadwal)
                                    @php
                                    $isAktif = count(\App\Models\User::checkUserInJadwal($data->id, $jadwal->id)) > 0;
                                    @endphp
                                 
                                    <div class="col-6 col-md-4 col-xl-3 mb-2 mb-md-2 mb-xl-2">
                                        <div class="card {{ $isAktif? 'bg-active':false}} bg-jadwal border-0 shadow-sm">
                                            <div class="card-body">
                                                <h5 class="card-title">
                                                    {{ \Carbon\Carbon::parse($jadwal->jadwal_masuk)->translatedFormat('l') }}
                                                </h5>
                                                <p class="card-subtitle mb-2 text-body-secondary">{{ \Carbon\Carbon::parse($jadwal->jadwal_masuk)->translatedFormat('j F Y') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-12 col-xl-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title mt-2 mt-md-2">Laporan kejadian</h5>
                            <button class="btn btn-utama" style="width:100px;">
                                <a href="/user/laporan" class="text-decoration-none text-white">Baru</a>
                            </button>
                        </div>
                        <div class="d-flex flex-column">
                            @foreach($reports as $report)
                            @php $color = 'primary'; @endphp

                            @switch($report->status)
                                @case('diajukan')
                                    @php $color = 'primary'; @endphp
                                    @break

                                @case('ditinjau')
                                    @php $color = 'warning'; @endphp
                                    @break

                                @case('selesai')
                                    @php $color = 'success'; @endphp
                                    @break

                                @default
                                    @php $color = 'primary'; @endphp
                            @endswitch
                            <div class="card px-2 py-3 border-0 shadow-sm mt-3 bg-abu">
                                <div class="d-flex justify-content-between px-2">
                                    <i class="bi bi-eye"></i>
                                    <div class=""><strong>{{ $report->kategori }}</strong></div>
                                    <span class="badge text-bg-{{ $color }} rounded">{{ $report->status }}</span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="card px-2 py-2 border-0 shadow-sm mt-2">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title mt-2 mt-md-2">Statistik Keamanan</h5>
                        </div>
                        <div class="d-flex flex-column">
                            <div class="card border-0">
                                <span>Tingkat Kehadiran Ronda</span>
                                <div>
                                    <meter id="kehadiran" value="{{ $statistik['jumlah_absen_user'] }}" min="0" max="100" low="40" high="80" optimum="100"></meter>
                                    <div class="text-end me-2">{{ $statistik['jumlah_absen_user'] }}%</div>
                                </div>
                                <div>Jumlah Laporan</div>
                                <div>
                                    <span class="fw-semibold fs-3 me-2">{{ $jumlah_laporan }}</span> <span>Laporan</span>
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
<script type="module" src="{{ asset('resources/js/absensi.js') }}"></script>
@endpush
