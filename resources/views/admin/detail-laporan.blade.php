@extends('template.template-admin')
@section('body')

<div class="row">
    @if(Session::has('message'))
    <script>
        Swal.fire({
        title: "{{ Session::get('status') }}",
        icon: "{{ Session::get('icon') }}",
        draggable: true,
        text:"{{ Session::get('message') }}"
    });
    </script>
    @endif
    <div class="col-12 col-md-12 col-xl-7">
        <div class="row">
            <div class="col-12">
                <div class="card py-2 px-2 border shadow-0">
                    <div class="card-header border-bottom bg-white mb-0">
                        <h2>{{ $report->kategori }}</h2>
                    </div>
                    <div class="card-body mt-0">

                        <h4 class="card-title">
                            Deskripsi Kejadian
                        </h4>
                        <div class="card-text">
                            {{ $report->isi_laporan }}
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-12">
                <div class="card py-2 px-2 border shadow-0">
                    <div class="card-body mt-0">
                        <h4 class="card-title mb-2">Bukti Foto</h4>
                        <img src="{{ asset('storage/images-report/'.$report->foto) }}"class="border p-3 img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-12 col-xl-5">
        <div class="row">
            <div class="col-12">
                <div class="card border shadow-0">
                    <div class="card-body">
                        <h4 class="card-title mb-2">Kelola Laporan</h4>
                        <form action="{{ route('admin.ubah-laporan', $report->id) }}" method="post">
                            @csrf
                            <label for="status" class="form-label">
                                Ubah status
                            </label>
                            <select class="form-control mb-3" name="status" id="status" {{ $report->status === 'selesai' ? 'disabled':'' }}>
                                <option value="Diajukan" {{ $report->status === 'diajukan' ? 'selected':'' }}>Diajukan
                                </option>
                                <option value="Ditinjau" {{ $report->status === 'ditinjau' ? 'selected':'' }}>
                                    Ditinjau
                                </option>
                                <option value="Selesai" {{ $report->status === 'selesai' ? 'selected':'' }}>
                                    Selesai
                                </option>
                            </select>
                            <button type="submit" class="btn btn-success form-control">Simpan Perubahan</button>
                        </form>
                    </div>

                </div>
            </div>
            <div class="col-12">
                <div class="card border shadow-0">
                    <div class="card-body">
                        <h4 class="ms-2">Informasi Pelapor</h4>
                        <table class="table">
                            <tr>
                                <td>Nama</td>
                                <td>{{ $report->nama_lengkap }}</td>
                            </tr>
                            <tr>
                                <td>Tanggal</td>
                                <td>
                                    {{ \Carbon\Carbon::parse($report->created_at)->translatedFormat('j F Y') }}
                                </td>
                            </tr>
                            <tr>
                                <td>Waktu</td>
                                <td>
                                    {{ $report->created_at }}
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 col-md-12 col-xl-8">

    </div>
</div>

@endsection
