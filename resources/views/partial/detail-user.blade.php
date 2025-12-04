<form action="" method="post">
    <div class="mb-4">
        <label class="fw-medium form-label">Nama Lengkap</label>
        <input type="text" id="nama" name="nama" class="form-control" value="{{ $user->nama_lengkap }}">
    </div>
    <div class="mb-4">
        <label class="fw-medium form-label">Nomor Telfon</label>
        <input type="text" name="wa" id="wa" value="{{ $user->no_wa ?? '-' }}" class="form-control">
    </div>
    <div class="mb-4">
        <label class="fw-medium form-label">Alamat lengkap</label>
        <input type="text" name="alamat" id="alamat" class="form-control" value="{{ $user->alamat ?? '-' }}">
    </div>
    <div class="mb-4">
        <label class="fw-medium form-label">Status keanggotaan</label>
        <input type="text" class="form-control" value="{{ $user->status === 1 ? 'Aktif': 'Tidak Aktif' }}" disabled>
    </div>
    <div class="text-end">
        <div class="d-flex gap-2 justify-content-end">
            <button type="button" class="btn btn-secondary shadow-sm border-0 btn-batal">Batal</button>
            <button type="button" class="btn btn-utama shadow-sm border-0 btn-simpan">Simpan Perubahan</button>
        </div>
    </div>
</form>
