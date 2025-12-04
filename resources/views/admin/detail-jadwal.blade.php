@extends('template.template-admin')
@section('title', 'Detail jadwal');


@section('body')

@if(Session::has('status'))
<script>
     Swal.fire({
        title: "{{ Session::get('status') }}",
        icon: "{{ Session::get('icon') }}",
        draggable: true,
        text:"{{ Session::get('message') }}"
    });
</script>
@endif
<div class="row mb-4">
    <div class="col-12">
        <h1>
            Detail Jadwal beserta Daftar warga yang terdaftar dalam jadwal
        </h1>
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
                             {{ \Carbon\Carbon::parse($jadwal->jadwal_masuk)->translatedFormat('j F Y') }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-muted small">Waktu</div>
                        <div class="fw-semibold fs-5">19:00 – 06:00</div>
                    </div>
                    <div class="col-md-6">
                    @php
                    $is_aktif = $jadwal->is_aktif === 1;  
                    $route = $is_aktif ? "jadwal.non_aktifkan":"jadwal.aktifkan";
                    @endphp
                    <form action="{{ route($route, $jadwal->id) }}" data-aktif="{{ $jadwal->is_aktif }}" id="form-nonaktif" method="post">
                            @csrf
                            <button type="submit" class="btn btn-{{ $is_aktif ?'danger':'success' }}">
                                {{ $is_aktif ?'Nonaktifkan':'Aktifkan' }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card border shadow">
            <div class="card-body">

                <!-- Header -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold mb-0">Anggota Ronda</h5>

                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahAnggota">
                        <i class="bi bi-person-plus"></i> Tambah
                    </button>
                </div>

                <!-- List Anggota -->
                @if(count($jadwals) > 0)
                <ul class="list-group list-group-flush" id="container-jadwal">
                    
                    @foreach($jadwals as $absen)
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                        <div class="d-flex align-items-center">
                            <img src="https://ui-avatars.com/api/?name={{ str_replace(' ', '+', $absen->nama_lengkap) }}&background=random"
                                class="rounded-circle me-3" width="48" height="48">
                            <div class="fw-semibold">
                                {{ $absen->nama_lengkap }}
                            </div> 
                        </div>
                        <div class="d-flex justify-content-evenly gap-2">
                            <button type="button" class="btn btn-{{ $absen->status === 0 ? 'dark':'primary' }}">
                                {{ $absen->status === 0 ? 'Belum absen':'Sudah absen' }}
                            </button>
                            @if($is_aktif)
                            <form class="form-hapus" action="{{ route('absensi.hapus', $absen->id) }}" method="post">
                                @csrf
                                <button class="btn btn-outline-danger btn-sm py-2 px-4 btn-hapus" >
                                    <i class="bi bi-trash"></i>Hapus
                                </button>
                            </form>
                            @endif

                        </div>
                    </li>
                    @endforeach

                    <!-- <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                        <div class="d-flex align-items-center">
                            <img src="https://ui-avatars.com/api/?name=Muammar&background=random"
                                class="rounded-circle me-3" width="48" height="48">
                            <div class="fw-semibold">Dedi Firmansyah</div>
                        </div>
                        <button class="btn btn-outline-danger btn-sm">
                            <i class="bi bi-trash"></i>
                        </button>
                    </li>

                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                        <div class="d-flex align-items-center">
                            <img src="https://ui-avatars.com/api/?name=Rudi+Hartono&background=random"
                                class="rounded-circle me-3" width="48" height="48">
                            <div class="fw-semibold">Rudi Hartono</div>
                        </div>
                        <button class="btn btn-outline-danger btn-sm">
                            <i class="bi bi-trash"></i>Hapus
                        </button>
                    </li> -->

                </ul>
                @else
                    <strong class="fs-4">Belum ada warga yang terdaftar pada jadwal ini, silahkan tambah terlebih dahulu</strong>
                @endif
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modalTambahAnggota" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <form class="modal-content rounded-4 shadow" method="post" action="{{ route('absensi.add', $jadwal_id) }}">
        @csrf

      <div class="modal-header">
        <h5 class="modal-title fw-bold">Tambah Anggota Ronda</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <label class="form-label fw-semibold">Pilih Warga</label>
        <select class="form-select form-select-lg" id="daftar-user" name="user">
            <option selected disabled>-- Pilih Warga --</option>
            @foreach($users as $user)
            <option value="{{ $user->id }}">
                {{ $user->nama_lengkap }}
            </option>
            @endforeach
        </select>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Tambahkan</button>
      </div>

    </form>
  </div>
</div>
@endsection

@push('scripts')
<script type="module" src="{{ asset('resources/js/admin/nonaktifkan.js') }}"></script>
@endpush