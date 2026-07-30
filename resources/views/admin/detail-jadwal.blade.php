@extends('template.template-admin')
@section('title', 'Detail jadwal');


@section('body')

@if(Session::has('status'))
<script type="module">
    import {showSnackMessage} from "{{ asset('resources/js/utility/alert.js') }}";
    showSnackMessage("{{ Session::get('message') }}","{{ Session::get('icon') }}");
</script>
@endif

<div class="row mb-4">
    <div class="col-12">
        <h3>
            Detail Jadwal beserta Daftar warga yang terdaftar dalam jadwal
        </h3>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card border shadow-0 mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="fw-bold mb-0">Jadwal Ronda</h4>
                    <span class="badge bg-primary bg-gradient fs-6 py-2 px-3">
                        {{ $jadwal->is_aktif === 1 ? 'Aktif':'Tidak Aktif' }}
                    </span>
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="text-muted small">Tanggal</div>
                        <div class="fw-semibold fs-5">
                            {{ formatTanggalIndonesia($jadwal->jadwal_masuk) }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-muted small">Waktu</div>
                        <div class="fw-semibold fs-5">19:00 – 06:00</div>
                    </div>
                    <div class="col-12 col-md-6 d-flex gap-2">
                        @php
                        $is_aktif = $jadwal->is_aktif === 1;
                        $route = $is_aktif ? "jadwal.non_aktifkan":"jadwal.aktifkan";
                        @endphp
                        <form action="{{ route($route, $jadwal->id) }}" data-aktif="{{ $jadwal->is_aktif }}"
                            id="form-nonaktif" method="post">
                            @csrf
                            <button type="submit" class="btn btn-{{ $is_aktif ?'danger':'success' }}">
                                {{ $is_aktif ?'Nonaktifkan':'Aktifkan' }}
                            </button>
                        </form>
                        <button class="btn btn-primary">
                            <a href="/absensi/cetak" target="_blank" class="text-decoration-none text-white">Cetak
                                absensi</a>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card border shadow">
            <div class="card-body">
                <!-- Header -->
                <div class="d-flex flex-column flex-md-row flex-xl-row justify-content-center justify-content-md-between justify-content-xl-between align-items-center mb-3">
                    <h5 class="fw-bold mb-3 mb-md-0">Anggota Ronda</h5>
                    @if($is_aktif)
                    <div class="d-flex gap-2">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahAnggota">
                            <i class="bi bi-person-plus"></i> Tambah
                        </button>
                        <button type="button" id="btn-hapus" class="btn btn-danger d-none">Hapus warga yang
                            terpilih</button>
                    </div>
                    @endif
                </div>

                <!-- List Anggota -->
                @if(count($jadwals) > 0)
                <ul class="list-group list-group-flush" id="container-jadwal">

                    @foreach($jadwals as $absen)
                    <li class="list-group-item py-3 anggota-ronda">

                        <div class="row align-items-center g-3">

                            <!-- Informasi Anggota -->
                            <div class="col-12 col-md-6">
                                <div class="d-flex align-items-center">
                                    @if($is_aktif)
                                        <div class="form-check me-3">
                                            <input class="form-check-input checkbox-absen {{$absen->clear_absen == 1 ? 'd-none':''}}" type="checkbox" value="{{ $absen->id }}" id="check-absen-{{$absen->id}}" data-uid="{{$absen->user_id}}" data-name="{{ $absen->nama_lengkap }}">
                                        </div>
                                    @endif

                                    <img src="https://ui-avatars.com/api/?name={{ str_replace(' ', '+', $absen->nama_lengkap) }}&background=random"
                                        class="rounded-circle me-3" width="52" height="52">

                                    <div>
                                        <div class="fw-semibold fs-5">
                                            {{ $absen->nama_lengkap }}
                                        </div>

                                        <small class="text-muted">
                                            ID #{{ $absen->id }}
                                        </small>
                                    </div>

                                </div>
                            </div>

                            <!-- Tombol -->
                            <div class="col-12 col-md-6">

                                <div class="d-flex justify-content-md-end gap-2 flex-wrap">
                                    <button type="button"
                                        class="btn btn-{{ $absen->status == 0 ? 'dark' : 'primary' }}">
                                        @if($absen->clear_absen == 0)
                                            <span>Belum Absen</span>
                                        @else
                                            @if($absen->status == 0)
                                                <span>Sudah Absen (Izin)</span>
                                            @else
                                                <span>Sudah Absen (Hadir)</span>
                                            @endif
                                        @endif
            
                                    </button>

                                    @if($is_aktif)
                                    <button data-id="{{$absen->id}}" data-name="{{$absen->nama_lengkap}}" data-idu="{{$absen->user_id}}" class="btn btn-outline-danger btn-hapus-warga {{$absen->clear_absen == 1 ? 'd-none':''}}">
                                        <i class="bi bi-trash me-1"></i>
                                        Hapus
                                    </button>
                                    @endif


                                </div>
                            </div>
                        </div>

                    </li>
                    @endforeach

                </ul>
                @else
                <strong class="fs-4">Belum ada warga yang terdaftar pada jadwal ini, silahkan tambah terlebih
                    dahulu</strong>
                @endif
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modalTambahAnggota" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <form class="modal-content rounded-4 shadow" method="post" id="form-tambah-anggota"
            action="{{ route('absensi.add', $jadwal_id) }}">
            @csrf

            <div class="modal-header">
                <h5 class="modal-title fw-bold">Tambah Anggota Ronda</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label fw-semibold">Pilih Warga</label>

                    <!-- Pencarian -->
                    <div class="input-group mb-3">

                        <input type="search" class="form-control" id="search-user" placeholder="Cari nama warga...">
                    </div>

                    <!-- Warga yang Dipilih -->
                    <div class="mb-3">
                        <label class="form-label small text-muted">
                            Warga Terpilih
                        </label>

                        <div id="selected-user-container" class="border rounded p-2 bg-light" style="min-height:60px;">
                        </div>

                        <small class="text-muted">
                            Warga yang dipilih akan muncul di sini.
                        </small>
                    </div>

                    <!-- Daftar Warga -->
                    <div class="border rounded px-2" style="max-height:250px; overflow-y:auto;" id="list-user">

                        @foreach($users as $user)

                        <div class="form-check py-2 border-bottom user-item">

                            <input class="form-check-input user-check" data-id="{{$user->id}}"
                                data-name="{{$user->nama_lengkap}}" type="checkbox" name="users[]"
                                value="{{ $user->id }}" id="user{{ $user->id }}">

                            <label class="form-check-label w-100" for="user{{ $user->id }}" style="cursor:pointer;">
                                {{ $user->nama_lengkap }}
                            </label>

                        </div>

                        @endforeach

                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" data-id="{{ $jadwal->id }}"
                    id="btn-tambah-anggota">Tambahkan</button>
            </div>

        </form>
    </div>
</div>
@endsection

@push('scripts')
<script type="module" src="{{ asset('resources/js/admin/nonaktifkan.js') }}"></script>
<script type="module" src="{{ asset('resources/js/admin/tambah_anggota_ronda.js') }}"></script>
@endpush
