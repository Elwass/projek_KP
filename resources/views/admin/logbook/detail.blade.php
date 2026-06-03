@extends('base')

@section('header')
    <link rel="stylesheet" href="{{ asset('assets/AdminLTE/plugins/toastr/toastr.min.css') }}">
@endsection

@section('sidebar')
    @include('admin.sidebar')
@endsection

@section('content-header')
    <div class="content-header"><div class="container-fluid"><div class="row mb-2"><div class="col-sm-6"><h1 class="m-0">Detail Logbook Magang</h1></div><div class="col-sm-6"><ol class="breadcrumb float-sm-right"><li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li><li class="breadcrumb-item"><a href="{{ route('admin.logbook.index') }}">Logbook Magang</a></li><li class="breadcrumb-item active">Detail</li></ol></div></div></div></div>
@endsection

@section('main-content')
    <div class="row">
        <div class="col-md-8">
            <div class="card card-primary card-outline"><div class="card-body">
                <div class="row"><div class="col-md-6"><div class="mb-3"><label>Nama Peserta</label><input type="text" class="form-control" value="{{ $logbook->nama_peserta }}" readonly></div></div><div class="col-md-6"><div class="mb-3"><label>NIM</label><input type="text" class="form-control" value="{{ $logbook->nim ?? '-' }}" readonly></div></div></div>
                <div class="row"><div class="col-md-6"><div class="mb-3"><label>Universitas</label><input type="text" class="form-control" value="{{ $logbook->universitas ?? '-' }}" readonly></div></div><div class="col-md-6"><div class="mb-3"><label>Jurusan</label><input type="text" class="form-control" value="{{ $logbook->jurusan ?? '-' }}" readonly></div></div></div>
                <div class="row"><div class="col-md-6"><div class="mb-3"><label>Tanggal</label><input type="text" class="form-control" value="{{ $logbook->tanggal }}" readonly></div></div><div class="col-md-6"><div class="mb-3"><label>Status</label><p>@include('logbook.status', ['status' => $logbook->status])</p></div></div></div>
                <div class="row"><div class="col-md-6"><div class="mb-3"><label>Jam Mulai</label><input type="text" class="form-control" value="{{ substr($logbook->jam_mulai, 0, 5) }}" readonly></div></div><div class="col-md-6"><div class="mb-3"><label>Jam Selesai</label><input type="text" class="form-control" value="{{ substr($logbook->jam_selesai, 0, 5) }}" readonly></div></div></div>
                <div class="mb-3"><label>Judul Kegiatan</label><input type="text" class="form-control" value="{{ $logbook->judul_kegiatan }}" readonly></div>
                <div class="mb-3"><label>Deskripsi Kegiatan</label><textarea class="form-control" rows="5" readonly>{{ $logbook->deskripsi_kegiatan }}</textarea></div>
                <div class="mb-3"><label>Lokasi</label><input type="text" class="form-control" value="{{ $logbook->lokasi ?? '-' }}" readonly></div>
                <div class="mb-3"><label>Bukti Kegiatan</label><p>@if ($logbook->bukti_kegiatan)<a href="{{ route('file.logbook', $logbook->id) }}" target="_blank">lihat file</a>@else - @endif</p></div>
                <a href="{{ route('admin.logbook.index') }}" class="btn btn-default">Kembali</a>
            </div></div>
        </div>
        <div class="col-md-4">
            <div class="card card-primary card-outline"><div class="card-header"><h3 class="card-title">Validasi Pembimbing/Admin</h3></div><div class="card-body">
                <form action="{{ route('admin.logbook.status', $logbook->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Status</label>
                        <select class="custom-select @error('status') is-invalid @enderror" name="status">
                            <option value="disetujui" {{ old('status', $logbook->status) == 'disetujui' ? 'selected' : '' }}>disetujui</option>
                            <option value="revisi" {{ old('status', $logbook->status) == 'revisi' ? 'selected' : '' }}>revisi</option>
                            <option value="ditolak" {{ old('status', $logbook->status) == 'ditolak' ? 'selected' : '' }}>ditolak</option>
                        </select>
                        @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label for="catatan_pembimbing">Catatan Pembimbing</label>
                        <textarea class="form-control @error('catatan_pembimbing') is-invalid @enderror" id="catatan_pembimbing" name="catatan_pembimbing" rows="5">{{ old('catatan_pembimbing', $logbook->catatan_pembimbing) }}</textarea>
                        <small class="form-text text-muted">Wajib diisi jika status revisi atau ditolak.</small>
                        @error('catatan_pembimbing')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <button type="submit" class="btn btn-success btn-block">Simpan Status</button>
                </form>
            </div></div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/AdminLTE/plugins/toastr/toastr.min.js') }}"></script>
    @if (session()->has('success'))<script>toastr.success('{{ session('success') }}');</script>@endif
@endsection
