@extends('template.template-admin')
@section('title', 'Detail Warga');


@section('body')
<div class="container py-2 py-md-4">

    <!-- Header Profil -->
    <div class="card border mb-4">
        <div class="card-body">
            <div class="row align-items-center">

                <div class="col-md-10">
                    <div class="d-flex align-items-center">

                        <img src="https://ui-avatars.com/api/?name={{ str_replace(' ', '+',$user->nama_lengkap) }}&background=random"
                            class="rounded-circle me-4" width="90" height="90">

                        <div>
                            <h3 class="fw-bold mb-1">
                                {{$user->nama_lengkap}}
                            </h3>

                            <p class="text-muted mb-2">
                                <i class="bi bi-person-circle"></i>
                                Username : {{$user->username}}
                            </p>

                            <span class="badge bg-{{ $user->status == 1 ? 'success':'danger' }} px-3 py-2">
                                {{$user->status == 1 ? 'Warga Aktif': 'Tidak Aktif'}}
                            </span>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>


    <!-- KPI -->
    <div class="row mb-4 justify-content-evenly">

        <div class="col-6 col-lg-3">
            <div class="card border">
                <div class="card-body text-center">
                    <h2 class="fw-bold text-primary">{{ $statistikUser["total_jadwal"] }}</h2>
                    <small>Total Jadwal</small>
                </div>
            </div>
        </div>

        <div class="col-6 col-lg-3">
            <div class="card border">
                <div class="card-body text-center">
                    <h2 class="fw-bold text-success">{{ $statistikUser["total_hadir"] }}</h2>
                    <small>Hadir</small>
                </div>
            </div>
        </div>

        <div class="col-6 col-lg-3">
            <div class="card border">
                <div class="card-body text-center">
                    <h2 class="fw-bold text-warning">{{ $statistikUser["total_izin"] }}</h2>
                    <small>Izin</small>
                </div>
            </div>
        </div>

        <div class="col-6 col-lg-3">
            <div class="card border">
                <div class="card-body text-center">
                    <h2 class="fw-bold text-danger">{{ $statistikUser["total_belum_absen"] }}</h2>
                    <small>Belum Absen</small>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="card border">
                <div class="card-body text-center">
                    <h2 class="fw-bold text-">{{ $statistikUser["total_laporan"] }}</h2>
                    <small>Total Laporan</small>
                </div>
            </div>
        </div>

    </div>


    <div class="row g-4">

        <!-- Informasi Warga -->
        <div class="col-lg-6 d-flex">

            <div class="card border h-100 w-100">

                <div class="card-header bg-white border-0 py-3">
                    <h5 class="fw-bold mb-0">
                        <i class="bi bi-person-vcard me-2 text-primary"></i>
                        Informasi Warga
                    </h5>
                </div>

                <div class="card-body">

                    <div class="row mb-4">
                        <div class="col-4 text-muted fw-semibold">
                            Nama
                        </div>

                        <div class="col-8 fw-semibold">
                            {{ $user->nama_lengkap }}
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-4 text-muted fw-semibold">
                            Username
                        </div>

                        <div class="col-8">
                            {{ $user->username }}
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-4 text-muted fw-semibold">
                            No. HP
                        </div>

                        <div class="col-8">
                            {{ $user->no_wa == '' ? '-' : $user->no_wa }}
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-4 text-muted fw-semibold">
                            Status
                        </div>

                        <div class="col-8">

                            <span
                                class="badge bg-{{ $user->status == 1 ? 'success' : 'danger' }} px-3 py-2">
                                {{ $user->status == 1 ? 'Aktif' : 'Tidak Aktif' }}
                            </span>

                        </div>

                    </div>

                </div>

            </div>

        </div>



        <!-- Ringkasan Kehadiran -->
        <div class="col-lg-6 d-flex">

            <div class="card border h-100 w-100">

                <div class="card-header bg-white border-0 py-3">
                    <h5 class="fw-bold mb-0">
                        <i class="bi bi-bar-chart-fill me-2 text-success"></i>
                        Ringkasan Kehadiran
                    </h5>
                </div>

                <div class="card-body">

                    <div class="mb-4">

                        <div class="d-flex justify-content-between mb-2">

                            <span class="fw-semibold">
                                Hadir
                            </span>

                            <span class="text-success fw-bold">
                                {{ $statistikUser['persentase_hadir'] }}%
                            </span>

                        </div>

                        <div class="progress" style="height:24px">

                            <div class="progress-bar bg-success"
                                style="width: {{ $statistikUser['persentase_hadir'] }}%;">
                            </div>

                        </div>

                    </div>



                    <div class="mb-4">

                        <div class="d-flex justify-content-between mb-2">

                            <span class="fw-semibold">
                                Izin
                            </span>

                            <span class="text-warning fw-bold">
                                {{ $statistikUser['persentase_izin'] }}%
                            </span>

                        </div>

                        <div class="progress" style="height:24px">

                            <div class="progress-bar bg-warning"
                                style="width: {{ $statistikUser['persentase_izin'] }}%;">
                            </div>

                        </div>

                    </div>



                    <div>

                        <div class="d-flex justify-content-between mb-2">

                            <span class="fw-semibold">
                                Belum Absen
                            </span>

                            <span class="text-danger fw-bold">
                                {{ $statistikUser['persentase_belum_absen'] }}%
                            </span>

                        </div>

                        <div class="progress" style="height:24px">

                            <div class="progress-bar bg-danger"
                                style="width: {{ $statistikUser['persentase_belum_absen'] }}%;">
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <!-- Riwayat -->
            <div class="card border mt-4">

                <div class="card-header bg-white">

                    <h5 class="fw-bold mb-0">
                        Riwayat Kehadiran
                    </h5>

                </div>

                @if($riwayatKehadiran->count() > 0)
                    <div class="table-responsive">

                        <table class="table table-hover align-middle mb-0">

                            <thead class="table-light">

                                <tr>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                </tr>

                            </thead>

                            <tbody>
                                @foreach ($riwayatKehadiran as $row)
                                    @php
                                        if ($row->clear_absen == 0) {
                                            $color = 'danger';
                                            $status = 'Belum Absen';
                                        } else {
                                            if ($row->status == 0) {
                                                $color = 'warning';
                                                $status = 'Izin';
                                            } else {
                                                $color = 'success';
                                                $status = 'Hadir';
                                            }
                                        }
                                    @endphp
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($row->jadwal_masuk)->translatedFormat('d F Y') }}</td>
                                    <td>
                                        <span class="badge bg-{{ $color }}">
                                            {{ $status }}
                                        </span>
                                    </td>
                                    
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-center">Belum ada Riwayat Kehadiran/Absensi</p>
                @endif

            </div>
        </div>
        <div class="col-12">
            <!-- Riwayat -->
            <div class="card border mt-4">

                <div class="card-header bg-white">

                    <h5 class="fw-bold mb-0">
                        Riwayat Laporan
                    </h5>

                </div>
                @if($riwayatLaporan->count() > 0)
                    <div class="table-responsive">

                        <table class="table table-hover align-middle mb-0">

                            <thead class="table-light">

                                <tr>
                                    <th>Tanggal</th>
                                    <th>Kategori</th>
                                    <th>Status</th>
                                    <th>Tindakan</th>
                                </tr>

                            </thead>

                            <tbody>
                                @foreach ($riwayatLaporan as $row)
                                    @php
                                        if ($row->status == "selesai") {
                                            $color = 'success';
                                        } else if($row->status=="ditinjau") {
                                            $color = 'warning';
                                        } else {
                                            $color = "primary";
                                        }
                                    @endphp
                                <tr>
                                    <td> {{ formatTanggalIndonesia($row->created_at) }}</td>
                                    <td>
                                        <span>{{ $row->kategori }}</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $color }}">
                                            {{ $row->status }}
                                        </span>
                                    </td>
                                   
                                    <td>
                                        <a href="/admin/detail/laporan/{{ $row->id }}">Lihat Detail</a>
                                    </td>
                                    
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-center">Belum Ada Riwayat Laporan</p>
                @endif
            </div>
        </div>
    </div>





</div>
@endsection

@push("scripts")

<script>
    const labels = [
        "05 Jan",
        "12 Jan",
        "19 Jan",
        "26 Jan",
        "02 Feb",
        "09 Feb",
        "16 Feb"
    ];

    const hadir = [
        1, 0, 1, 1, 0, 1, 0
    ];

    const izin = [
        0, 1, 0, 0, 0, 0, 1
    ];

    const belum = [
        0, 0, 0, 0, 1, 0, 0
    ];

    const ctx = document.getElementById("grafikKehadiranUser");

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                    label: "Hadir",
                    data: hadir,
                    borderColor: "#198754",
                    backgroundColor: "#198754",
                    tension: .3,
                    pointRadius: 6
                },
                {
                    label: "Izin",
                    data: izin,
                    borderColor: "#ffc107",
                    backgroundColor: "#ffc107",
                    tension: .3,
                    pointRadius: 6
                },
                {
                    label: "Belum Absen",
                    data: belum,
                    borderColor: "#dc3545",
                    backgroundColor: "#dc3545",
                    tension: .3,
                    pointRadius: 6
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    min: 0,
                    max: 1,
                    ticks: {
                        stepSize: 1,
                        callback: function (value) {
                            return value == 1 ? "Ya" : "";
                        }
                    }
                }
            }
        }
    });

</script>
@endpush
