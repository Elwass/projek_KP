@csrf
<div class="row">
    <div class="col-md-4">
        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" value="{{ old('tanggal', $logbook->tanggal ?? '') }}">
            @error('tanggal')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-4">
        <div class="mb-3">
            <label for="jam_mulai" class="form-label">Jam Mulai</label>
            <input type="time" class="form-control @error('jam_mulai') is-invalid @enderror" id="jam_mulai" name="jam_mulai" value="{{ old('jam_mulai', isset($logbook) ? substr($logbook->jam_mulai, 0, 5) : '') }}">
            @error('jam_mulai')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-4">
        <div class="mb-3">
            <label for="jam_selesai" class="form-label">Jam Selesai</label>
            <input type="time" class="form-control @error('jam_selesai') is-invalid @enderror" id="jam_selesai" name="jam_selesai" value="{{ old('jam_selesai', isset($logbook) ? substr($logbook->jam_selesai, 0, 5) : '') }}">
            @error('jam_selesai')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
<div class="mb-3">
    <label for="judul_kegiatan" class="form-label">Judul Kegiatan</label>
    <input type="text" class="form-control @error('judul_kegiatan') is-invalid @enderror" id="judul_kegiatan" name="judul_kegiatan" value="{{ old('judul_kegiatan', $logbook->judul_kegiatan ?? '') }}">
    @error('judul_kegiatan')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="mb-3">
    <label for="deskripsi_kegiatan" class="form-label">Deskripsi Kegiatan</label>
    <textarea class="form-control @error('deskripsi_kegiatan') is-invalid @enderror" id="deskripsi_kegiatan" name="deskripsi_kegiatan" rows="5">{{ old('deskripsi_kegiatan', $logbook->deskripsi_kegiatan ?? '') }}</textarea>
    @error('deskripsi_kegiatan')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="mb-3">
    <label for="lokasi" class="form-label">Lokasi</label>
    <input type="text" class="form-control @error('lokasi') is-invalid @enderror" id="lokasi" name="lokasi" value="{{ old('lokasi', $logbook->lokasi ?? '') }}">
    @error('lokasi')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="mb-3">
    <label for="bukti_kegiatan" class="form-label">Bukti Kegiatan</label>
    <input type="file" class="form-control @error('bukti_kegiatan') is-invalid @enderror" id="bukti_kegiatan" name="bukti_kegiatan">
    <small class="form-text text-muted">Opsional. Format: JPG, JPEG, PNG, PDF. Maksimal 10 MB.</small>
    @isset($logbook)
        @if ($logbook->bukti_kegiatan)
            <p class="mt-2">Bukti saat ini: <a href="{{ asset('storage/'.$logbook->bukti_kegiatan) }}" target="_blank">lihat file</a></p>
        @endif
    @endisset
    @error('bukti_kegiatan')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<br>
<button type="submit" class="btn btn-success">Simpan</button>
<a href="{{ route('peserta.logbook.index') }}" class="btn btn-default">Batal</a>
