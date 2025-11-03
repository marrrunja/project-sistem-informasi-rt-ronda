@extends('template.template')
@section('title', 'Main')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Protest+Guerrilla&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('resources/css/main.css') }}">
@endpush

@section('body')
@include('template.navbar')


<section id="hero" class="pt-3 pb-5">
    <div class="container">
        <div class="row d-flex flex-column-reverse flex-md-column-reverse flex-xl-row">
            <div class="col-12 col-md-12 col-xl-6 mb-3 mb-md-3 mb-xl-0">
                <h1 class="fw-bold f-1 color-utama">SIRATA</h1>
                <h3 class="color-utama">Sistem Informasi Ronda <br>Terpadu Area RT</h3>
                <p class="color-utama lh-lg">
                    Kelola jadwal ronda, absensi, dan laporan kejadian di lingkungan secara digital agar kegiatan
                    siskamling lebih aman, tertib dan transparan.
                </p>
                <div class="d-flex gap-3">
                    <a href="/login" class="btn btn-success py-2 fw-semibold shadow-sm">Masuk ke Sistem</a>
                    <a href="/register" class="btn btn-outline-success py-2 fw-semibold color-utama shadow-sm">Daftar Akun
                        Warga</a>
                </div>
            </div>
            <div class="col-12 col-md-12 col-xl-6 text-center mb-4 mb-md-4 mb-xl-0">
                <img src="{{ asset('resources/images/hero.png') }}" alt="Hero" class="img-fluid img-hero">
            </div>
        </div>
    </div>
</section>

<section id="about" class="pt-5 pb-5">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-12 col-md-10 col-xl-10">
                <div class="card bg-utama py-5">
                    <div class="card-body px-3 px-md-4">
                        <h1 class="card-title text-center mb-4">Apa itu SIRATA?</h1>
                        <p class="card-text text-center lh-lg fw-light">
                        SIRATA adalah sistem terpadu yang dirancang untuk meningkatkan keamanan masyarakat RT. Kami
                        memanfaatkan teknologi untuk menciptakan lingkungan tempat tinggal yang lebih aman, terhubung,
                        dan efisien bagi seluruh warga. Platform ini mengintegrasikan fungsi-fungsi penting dalam bidang
                        keamanan ke dalam satu sistem yang mudah digunakan dan dapat diakses oleh semua warga.
                    </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="service" class="pt-5 pb-5">
    
    <div class="container">
        <h1 class="text-center color-utama mb-4">Layanan Unggulan Kami</h1>
        <p class="color-utama text-center mb-4">Kami menyediakan berbagai fitur untuk membantu meningkatkan<br> keamanan dan
            kenyamanan di lingkungan Anda</p>
        <div class="row d-flex justify-content-center gap-3 mt-5">
            <div class="col-12 col-md-5">
                <table>
                    <tr>
                        <td rowspan="2" style="vertical-align: top;">
                            <i class="bi bi-calendar3 color-utama fs-2"></i>
                        </td>
                        <td>
                            <h4 class="color-utama mt-2 ms-2">Jadwal Ronda Otomatis</h4>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p class="ms-2">Sistem membuat dan menyedarkan jadwal ronda secara otomatis</p>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-12 col-md-5">
                <table>
                    <tr>
                        <td rowspan="2" style="vertical-align: top;">
                            <i class="bi bi-check-circle-fill color-utama fs-2"></i>
                        </td>
                        <td>
                            <h4 class="color-utama mt-2 ms-2">Absensi Online</h4>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p class="ms-2">Warga yang bertugas ronda dapat melakukan absensi secara digital.</p>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row d-flex justify-content-center gap-3 mt-4">
            <div class="col-12 col-md-5">
                <table>
                    <tr>
                        <td rowspan="2" style="vertical-align: top;">
                            <i class="bi bi-megaphone-fill color-utama fs-2"></i>
                        </td>
                        <td>
                            <h4 class="color-utama mt-2 ms-2">Laporan Kejadian</h4>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p class="ms-2">Warga dapat melaporkan kejadian keamanan secara langsung melalui sistem, dan laporan diterima secara real-time.</p>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-12 col-md-5">
                <table>
                    <tr>
                        <td rowspan="2" style="vertical-align: top;">
                            <i class="bi bi-bar-chart-fill color-utama fs-2"></i>
                        </td>
                        <td>
                            <h4 class="color-utama mt-2 ms-2">Laporan Kejadian</h4>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p class="ms-2">Ketua RT dapat memantau keamanan dalam tampilan grafik yang informatif.</p>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</section>
@include('template.footer')
@endsection
