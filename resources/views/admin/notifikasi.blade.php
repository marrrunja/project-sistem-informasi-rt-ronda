@extends('template.template-admin')

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link rel="stylesheet" href="{{ asset('resources/css/notifikasi.css') }}">
@endpush
@section('body')

<div class="row justify-content-center">
    <div class="col-12 col-lg-9">

        <h4 class="fw-bold mb-4">Semua Notifikasi</h4>

        <div class="card notif-card p-4">

            <div class="row mb-3">
                <div class="col">
                    <h6 class="fw-semibold text-secondary mb-0">Terbaru</h6>
                </div>
            </div>

            <!-- NOTIFICATION ITEM -->
            <div class="row align-items-start notif-item gx-3">
                <div class="col-auto">
                    <div class="notif-icon icon-blue">
                        📄
                    </div>
                </div>

                <div class="col">
                    <div class="notif-title">
                        Laporan Kejadian Baru
                    </div>
                    <div class="notif-desc">
                        Laporan “Aktivitas Mencurigakan” dari Dina Putri.
                    </div>
                    <div class="notif-time mt-1">
                        5 menit yang lalu
                    </div>
                </div>

                <div class="col-auto d-none d-md-block">
                    <span class="notif-unread"></span>
                </div>
            </div>

            <!-- NOTIFICATION ITEM -->
            <div class="row align-items-start notif-item gx-3">
                <div class="col-auto">
                    <div class="notif-icon icon-red">
                        ⏰
                    </div>
                </div>

                <div class="col">
                    <div class="notif-title">
                        Absensi Belum Lengkap
                    </div>
                    <div class="notif-desc">
                        Taufiqurrahman belum melakukan absensi ronda kemarin.
                    </div>
                    <div class="notif-time mt-1">
                        10 menit yang lalu
                    </div>
                </div>

                <div class="col-auto d-none d-md-block">
                    <span class="notif-unread"></span>
                </div>
            </div>

            <!-- NOTIFICATION ITEM -->
            <div class="row align-items-start notif-item gx-3">
                <div class="col-auto">
                    <div class="notif-icon icon-gray">
                        ✔
                    </div>
                </div>

                <div class="col">
                    <div class="notif-title">
                        Laporan Diselesaikan
                    </div>
                    <div class="notif-desc">
                        Laporan “Kehilangan” dari Kiara Laura telah selesai.
                    </div>
                    <div class="notif-time mt-1">
                        5 hari yang lalu
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
