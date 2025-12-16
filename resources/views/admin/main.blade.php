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

<div class="row g-3">

    <!-- Kehadiran -->
    <div class="col-md-3">
        <div class="card p-3 shadow-sm border rounded-2">
            <h6 class="text-muted">Kehadiran Ronda</h6>
            <h3 class="fw-bold">{{$persentase_kehadiran}}%</h3>
            <small class="text-muted">Minggu ini</small>
        </div>
    </div>

    <!-- Laporan Kejadian -->
    <div class="col-md-3">
        <div class="card p-3 shadow-sm border rounded-2">
            <h6 class="text-muted">Jumlah Laporan Kejadian</h6>
            <h3 class="fw-bold">{{$total_laporan}}</h3>
            <small class="text-muted">Total laporan diterima</small>
        </div>
    </div>

    <!-- Warga Terdaftar -->
    <div class="col-md-3">
        <div class="card p-3 shadow-sm border rounded-2">
            <h6 class="text-muted">Warga Terdaftar</h6>
            <h3 class="fw-bold">{{ $total_warga }}</h3>
            <small class="text-muted">Stabil</small>
        </div>
    </div>

    <!-- Jadwal Aktif -->
    <div class="col-md-3">
        <div class="card p-3 shadow-sm border rounded-2">
            <h6 class="text-muted">Jadwal Aktif</h6>
            <h3 class="fw-bold">{{ $total_jadwal }}</h3>
            <small class="text-muted">Minggu ini</small>
        </div>
    </div>

</div>


<div class="row mt-4">

    <!-- Grafik -->
    <div class="col-lg-8">
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


{{-- Chart JS --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
   var labels = @json($labels);
    var data = @json($data);

    const ctx = document.getElementById('grafikKehadiran');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Persentase Kehadiran (%)',
                data: data,
                backgroundColor: 'rgba(75, 123, 124, 0.6)',
                borderColor: 'rgba(75, 123, 124, 1)',
                borderWidth: 1,
                borderRadius: 8
            }]
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

@endsection
