@extends('template.template-admin')

@section('body')
<div class="row pt-3 pb-2">
    <h3>Mengatur status Akun warga</h3>
    <p>Berikut adalah daftar akun warga yang telah terdaftar pada sistem</p>
</div>
<div class="row">
     <div class="col-12">
        <div class="card border shadow-0">
            <div class="card-body table-responsive">
                <h4>Tabel Akun warga RT</h4>
                <table class="table">
                    <thead>
                        <tr>
                            <th>NAMA</th>
                            <th>Alamat</th>
                            <th>Status Akun</th>
                            <th>Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        @php
                        $isActive = $user->status === 1;
                        @endphp
                        <tr class="{{ $isActive ? 'fw-bolder':'' }} ">
                            <td>{{ $user->nama_lengkap }}</td>
                            <td>{{ $user->alamat ?? '-' }}</td>
                            <td>{{ $isActive ? 'Aktif' : 'Tidak aktif' }}</td>
                            <td>
                                <button data-id="{{ $user->id }}" data-status="{{ $user->status }}" type="button" class="btn btn-blokir btn-outline-{{ $isActive ? 'danger':'primary'  }}">
                                    {{ $isActive ? 'Nonaktifkan': 'Aktifkan' }}
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$users->links()}}
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="module" src="{{ asset('resources/js/admin/blokir.js') }}"></script>
@endpush