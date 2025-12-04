@extends('template.template-admin')

@section('title', "Jadwal")

@section('body')
<div class="row justify-content-between gy-4" id="container-jadwal">
    <div class="col-12 col-md-6">
        <h1>Jadwal</h1>
    </div>
    <div class="col-12 col-md-6">
        <button type="button" class="btn btn-success btn-jadwal-add">
            <i class="bi bi-plus-lg me-2"></i>Tambah Jadwal
        </button>
    </div>
</div>
<div class="row g-2 mt-4">
    @foreach($jadwals as $jadwal)
        @php
        $is_aktif = $jadwal->is_aktif === 0;
        @endphp
        <div class="col-12 col-md-8 col-xl-4">
            <div class="card shadow-0 border {{ $is_aktif ? 'bg-dark text-white fw-semibold':false }}">
                <div class="card-body">
                    <h5 class="card-title mb-2 {{ $is_aktif ? 'text-white fw-bold':false }}">
                          {{ \Carbon\Carbon::parse($jadwal->jadwal_masuk)->translatedFormat('j F Y') }}
                    </h5>
                    <p class="text-muted mb-1"><i class="bi bi-clock"></i> 19:00 - 06:00</p>
                    <p class="text-muted"><i class="bi bi-people"></i> {{ $jadwal->total_anggota }} Anggota</p>
                    <div class="d-flex justify-content-end">
                        <a href="/jadwal/detail/{{ $jadwal->id }}" class="btn btn-outline-primary btn-sm">Detail</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection

@push('scripts')
<script type="module" src="{{ asset('resources/js/admin/jadwal.js') }}"></script>
@endpush
