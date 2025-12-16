@extends('template.template-admin')

@section('body')
<div class="row pt-3 pb-2">
    <div class="col">
        <h3>Laporan kejadian</h3>
        <p>Kelola dan tinjau semua laporan yang masuk dari warga.</p>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="row gy-2">
            <div class="col-12 col-md-8 col-xl-7">
                <!-- <form action="">
                    <input type="search" class="form-control" placeholder="Cari laporan (pelapor, status...)">
                </form> -->

            </div>
            <div class="col-12">
                <div class="card border shadow-sm px-2 table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Jenis Laporan</th>
                                <th scope="col">PELAPOR</th>
                                <th scope="col">TANGGAL</th>
                                <!-- <th scope="col">WAKTU</th> -->
                                <th scope="col">STATUS</th>
                                <th scope="col">TINDAKAN</th>

                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $color = null;
                            @endphp
                            @foreach($reports as $report)
                            @switch($report->status)
                                @case('diajukan')
                                    @php $color = 'primary'; @endphp
                                    @break

                                @case('ditinjau')
                                    @php $color = 'warning'; @endphp
                                    @break

                                @case('selesai')
                                    @php $color = 'success'; @endphp
                                    @break

                                @default
                                    @php $color = 'primary'; @endphp
                            @endswitch
                            <tr>
                                <td>{{ $report->kategori }}</td>
                                <td>{{ $report->nama_lengkap }}</td>
                                <td> {{ \Carbon\Carbon::parse($report->created_at)->translatedFormat('j F Y') }}</td>
                                <td>
                                    <span class="badge text-bg-{{ $color }}">
                                        {{ $report->status }}
                                    </span>
                                </td>
                                <td>
                                    <a href="/admin/detail/laporan/{{ $report->id }}">
                                        Lihat detail
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $reports->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
