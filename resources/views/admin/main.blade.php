@extends('template.template-admin')

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
@endpush
@section('body')

<div class="row mb-4">
    <div class="col-lg-12">
        <h4 class="fw-bold mt-3">Selamat Datang {{ Session::get('username') }}</h4>
        <p class="text-muted">Berikut adalah ringkasan status keamanan di lingkungan Anda</p>
    </div>
</div>

<div class="row">

    <!-- Kehadiran -->
    <div class="col-12 col-lg-3 col-md-6">
        <div class="card p-3 shadow-sm border rounded-2">
            <h6 class="text-muted">Kehadiran Ronda</h6>
            <h3 class="fw-bold">{{$persentase_kehadiran}}%</h3>
            <small class="text-muted">Minggu ini</small>
        </div>
    </div>

    <!-- Laporan Kejadian -->
    <div class="col-12 col-lg-3 col-md-6">
        <div class="card p-3 shadow-sm border rounded-2">
            <h6 class="text-muted">Jumlah Laporan Kejadian</h6>
            <h3 class="fw-bold">{{$total_laporan}}</h3>
            <small class="text-muted">Total laporan diterima</small>
        </div>
    </div>

    <!-- Warga Terdaftar -->
    <div class="col-12 col-lg-3 col-md-6">
        <div class="card p-3 shadow-sm border rounded-2">
            <h6 class="text-muted">Warga Terdaftar</h6>
            <h3 class="fw-bold">{{ $total_warga }}</h3>
            <small class="text-muted">Stabil</small>
        </div>
    </div>

    <!-- Jadwal Aktif -->
    <div class="col-12 col-lg-3 col-md-6">
        <div class="card p-3 shadow-sm border rounded-2">
            <h6 class="text-muted">Total Jadwal Aktif</h6>
            <h3 class="fw-bold">{{ $total }}</h3>
            <small class="text-muted">Akumulasi</small>
        </div>
    </div>
    <!-- Jadwal Aktif -->
    <div class="col-12 col-lg-3 col-md-6">
        <div class="card p-3 shadow-sm border rounded-2">
            <h6 class="text-muted">Jadwal Aktif</h6>
            <h3 class="fw-bold">{{ $total_jadwal }}</h3>
            <small class="text-muted">Minggu ini</small>
        </div>
    </div>

</div>


<div class="row mt-4">

    <!-- Grafik -->
    <div class="col-12">
        <div class="card p-4 shadow-sm border rounded-2">
            <div class="d-flex justify-content-between">
                <h5 class="fw-bold">Statistik Kehadiran Ronda</h5>
                <div>
                    <a href="#" class="text-muted me-2">Mingguan</a>
                    <!-- <a href="#" class="text-muted">Bulanan</a> -->
                </div>
            </div>

            <div style="height:300px; position:relative;">
                <canvas id="grafikKehadiran"></canvas>
            </div>
        </div>
    </div>

</div>

<div class="row mt-4 justify-content-center">
    <div class="col-lg-8">
        <div class="card border shadow-sm rounded-4">
            <div class="card-header bg-white border-0 py-3">
                <h5 class="fw-bold mb-0">
                    <i class="bi bi-pie-chart-fill text-primary me-2"></i>
                    Distribusi Laporan Berdasarkan Kategori
                </h5>
            </div>

            <div class="card-body">
                <div class="h-100 h-md-75 h-xl-25">
                    <canvas id="chartKategoriPie"></canvas>
                </div>
            </div>
        </div>
    </div>
    <!-- Aksi Cepat -->
    <div class="col-lg-4">
        <div class="card p-4 shadow-sm border rounded-2">
            <h5 class="fw-bold mb-3">Aksi Cepat</h5>

            <div class="d-grid gap-3">
                <a href="/admin/jadwal" class="btn btn-light border rounded-4 text-start py-3">
                    📅 Kelola Jadwal Ronda
                </a>
                <a href="/admin/laporan" class="btn btn-light border rounded-4 text-start py-3">
                    📝 Kelola Laporan Kejadian
                </a>
                <a href="/admin/manage" class="btn btn-light border rounded-4 text-start py-3">
                    👥 Kelola Data Warga
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@push("scripts")
<script>
    const labels = @json($labels);
    const dataHadir = @json($dataHadir);
    const dataIzin = @json($dataIzin);
    const dataBelumAbsen = @json($dataBelumAbsen);

    const ctx = document.getElementById('grafikKehadiran');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                    label: 'Hadir (%)',
                    data: dataHadir,
                    backgroundColor: 'rgba(75, 123, 124, 0.6)',
                    borderColor: 'rgba(75, 123, 124, 1)',
                    borderWidth: 1,
                    borderRadius: 8
                },
                {
                    label: 'Izin (%)',
                    data: dataIzin,
                    backgroundColor: 'rgba(255, 193, 7, 0.6)',
                    borderColor: 'rgba(255, 193, 7, 1)',
                    borderWidth: 1,
                    borderRadius: 8
                },
                {
                    label: 'Belum Absen (%)',
                    data: dataBelumAbsen,
                    backgroundColor: 'rgba(220,53,69,0.7)',
                    borderColor: 'rgba(220,53,69,1)',
                    borderWidth: 1,
                    borderRadius: 8
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    max: 100
                }
            }
        }
    });

</script>

<script>
    const labelKategori = @json($labelCategories);
    const data = @json($dataCategories);

    console.log(labelKategori);

    const colors = [
        "#0d6efd",
        "#198754",
        "#ffc107",
        "#dc3545",
        "#6f42c1",
        "#20c997",
        "#fd7e14",
        "#6610f2",
        "#6c757d",
        "#0dcaf0"
    ];

    const contextKategori = document.getElementById("chartKategoriPie");

    new Chart(contextKategori, {

        type: "pie",

        data: {
            labels: labelKategori,
            datasets: [{

                data: data,

                backgroundColor: colors,

                borderColor: "#ffffff",

                borderWidth: 2,

                hoverOffset: 15

            }]
        },

        options: {

            responsive: true,

            maintainAspectRatio: false,

            plugins: {

                legend: {
                    position: "bottom",

                    labels: {
                        usePointStyle: true,
                        pointStyle: "circle",
                        padding: 20,
                        font: {
                            size: 13
                        }
                    }
                },

                tooltip: {

                    callbacks: {

                        label: function (context) {

                            const total = context.dataset.data.reduce((a, b) => a + b, 0);

                            const value = context.raw;

                            const percentage = ((value / total) * 100).toFixed(2);

                            return `${context.label} : ${value} laporan (${percentage}%)`;

                        }

                    }

                }

            }

        }

    });

</script>
@endpush
