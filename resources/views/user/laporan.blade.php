@extends('template.template')

@section('title', 'Dashboard')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Protest+Guerrilla&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('resources/css/main.css') }}">
<link rel="stylesheet" href="{{ asset('resources/css/upload.css') }}">

@endpush


@section('body')
@include('template.user-navbar')

<section id="welcome" class="pt-4 pb-3">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Laporkan kejadian</h1>
            </div>
            <div class="col-12 mt-2">
                <p class="color-utama">Gunakan formulir ini untuk melaporkan kejadian di lingkungan anda</p>
            </div>
        </div>
    </div>
</section>

<section id="laporan" class="pt-1 pb-3">
    <div class="container">
        @if(Session::has('alert'))
        <div id="message" data-alert="{{ Session::get('alert') }}">{{Session::get('message')}}</div>
        @endif
        <form action="{{ route('reports.add') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-12 col-md-10">
                    <div class="card border-0 shadow-sm py-3 px-4">
                        <div class="mb-3">
                            <h3>Formulir Laporan</h3>
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Jenis Laporan</label>
                            <select class="form-select @error('kategori') is-invalid @enderror" name="kategori"
                                aria-label="Default select example">
                                <option selected value="">Pilih jenis laporan</option>
                                @foreach(\App\Models\Kategori::all() as $kategori)
                                <option value="{{ $kategori->id }}">{{ $kategori->kategori }}</option>
                                @endforeach
                            </select>
                            @error('kategori')
                            <span class="error invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi Kejadian</label>
                            <textarea name="deskripsi" rows="5" id="deskripsi"
                                placeholder="Jelaskan kejadian secara rinci.."
                                class="form-control @error('deskripsi') is-invalid @enderror">
                                {{ old('deskripsi') ?? '' }}
                            </textarea>
                            @error('deskripsi')
                            <span class="error invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Unggah Satu Foto Bukti <span
                                    class="text-muted">(Optional)</span></label>
                            <!--  accept=".png, .jpg, .jpeg" -->
                            <div class="upload-box @error('foto') invalid-box @enderror" id="uploadArea">
                                <input type="file" name="foto" id="fileInput">
                                <i class="bi bi-cloud-arrow-up mb-2 @error('foto') text-danger @enderror"></i>
                                <div class="upload-label @error('foto') text-danger @enderror">Unggah file</div>
                                <p class="@error('foto') text-danger @enderror">PNG dan JPG hingga 3MB</p>
                            </div>
                            @error('foto')
                            <span class="text-danger mt-2 fs-6">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3 text-end">
                            <button class="btn btn-utama w-sm-50 w-md-25" style="font-size:1.1rem;"><i
                                    class="bi bi-send-fill me-2"></i>Kirim</button>
                        </div>
                    </div>
                </div>
        </form>
    </div>
</section>

<section id="laporan-terbaru" class="pt-3 pb-3">
    <div class="container">
        <div class="row d-flex justify-content-between mb-3">
            <div class="col-sm-7 col-md-6">
                <h2>Laporan kejadian terbaru</h2>
            </div>
            <div class="col-4 ms-md-5">
                <a href="/user/laporan/all">Semua</a>
            </div>
        </div>
        <div class="row gy-3">
            @php
            $color = null;
            @endphp
            @foreach($reports as $report)
                @php $color = 'primary'; @endphp

                @switch($report->status)
                    @case('Diajukan')
                        @php $color = 'primary'; @endphp
                        @break

                    @case('Ditinjau')
                        @php $color = 'warning'; @endphp
                        @break

                    @case('Selesai')
                        @php $color = 'success'; @endphp
                        @break

                    @default
                        @php $color = 'primary'; @endphp
                @endswitch
            <div class="col-12 col-md-10">
                <div class="card py-2 px-3 border-0">
                    <div class="card-body">
                        <div class="row d-flex justify-content-between align-items-center">
                            <div class="col-12 col-md-12 col-xl-10">
                                <div class="d-flex flex-column">
                                    <h5 class="card-title">{{$report->kategori}}</h5>
                                    <div class="mb-2">{{ Str::words($report->isi_laporan, 20) }}</div>
                                    <small>Dilaporkan oleh {{$report->nama_lengkap}}</small>
                                </div>
                            </div>
                            <div class="col-5 col-md-5 col-xl-2">
                                <div class="d-flex flex-column">
                                    <small>
                                        {{ \Carbon\Carbon::parse($report->created_at)->translatedFormat('j F Y') }}
                                    </small>
                                    <span class="badge text-bg-{{ $color }} w-sm-25 w-md-25 w-lg-25 mt-2">
                                        {{ $report->status }}
                                    </span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</section>
@include('template.footer')

@endsection

@push('scripts')
<script src="{{ asset('resources/js/upload.js') }}">

</script>
@endpush
