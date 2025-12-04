<div class="container">
    <div class="d-flex flex-column">
        <div class="mb-2">Deskripsi Kejadian</div>
        <div class="text-body-secondary">
            {{ $report->isi_laporan }}
        </div>
        <div class="fw-semibold mb-2 mt-2">Bukti Foto</div>

        <div class="card border-0 text-bg-dark" style="width:200px;" data-bs-toggle="modal" data-bs-target="#modalFoto">
            <img src="{{ asset('storage/images-report/'.$report->foto) }}" data-id="{{ $report->id }}"
                class="card-img modal-foto" alt="...">
        </div>
        <div class="fw-semibold mt-2 mb-2">
            Status & Tindak Lanjut
        </div>
        <div class="mt-2">

            <div class="mb-2">Riwayat Pengajuan</div>
            <ul>
                <li>
                    <div class="text-dark">Laporan diajukan</div>
                    <div class="text-body-secondary">
                        Laporan telah berhasil dikirim dan menunggu verifikasi ketua RT
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
