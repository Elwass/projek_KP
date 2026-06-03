@extends('base')

@section('sidebar')
    @include('admin.sidebar')
@endsection

@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"><h1 class="m-0">Detail Absensi Scan Wajah</h1></div>
                <div class="col-sm-6"><ol class="breadcrumb float-sm-right"><li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li><li class="breadcrumb-item"><a href="{{ route('admin.absensi.index') }}">Absensi Scan Wajah</a></li><li class="breadcrumb-item active">Detail</li></ol></div>
            </div>
        </div>
    </div>
@endsection

@section('main-content')
    <div class="row">
        <div class="col-md-5">
            <div class="card card-primary card-outline">
                <div class="card-header"><h3 class="card-title">Foto Wajah</h3></div>
                <div class="card-body text-center">
                    <img src="{{ route('file.absensi', $absensi->id) }}" alt="Foto wajah absensi" class="img-fluid rounded border">
                    <p class="mt-3"><a href="{{ route('file.absensi', $absensi->id) }}" target="_blank" class="btn btn-warning"><i class="fas fa-image"></i> Buka Foto</a></p>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="card card-primary card-outline">
                <div class="card-header"><h3 class="card-title">Data Absensi</h3></div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6"><div class="mb-3"><label>Nama Peserta</label><input type="text" class="form-control" value="{{ $absensi->nama_peserta }}" readonly></div></div>
                        <div class="col-md-6"><div class="mb-3"><label>NIM</label><input type="text" class="form-control" value="{{ $absensi->nim ?? '-' }}" readonly></div></div>
                    </div>
                    <div class="row">
                        <div class="col-md-6"><div class="mb-3"><label>Universitas</label><input type="text" class="form-control" value="{{ $absensi->universitas ?? '-' }}" readonly></div></div>
                        <div class="col-md-6"><div class="mb-3"><label>Jurusan</label><input type="text" class="form-control" value="{{ $absensi->jurusan ?? '-' }}" readonly></div></div>
                    </div>
                    <div class="row">
                        <div class="col-md-6"><div class="mb-3"><label>Waktu Absensi</label><input type="text" class="form-control" value="{{ $absensi->tanggal_waktu }}" readonly></div></div>
                        <div class="col-md-6"><div class="mb-3"><label>Status</label><p>@include('absensi.status', ['status' => $absensi->status_absen])</p></div></div>
                    </div>
                    <div class="row">
                        <div class="col-md-6"><div class="mb-3"><label>Latitude</label><input type="text" class="form-control" value="{{ $absensi->latitude }}" readonly></div></div>
                        <div class="col-md-6"><div class="mb-3"><label>Longitude</label><input type="text" class="form-control" value="{{ $absensi->longitude }}" readonly></div></div>
                    </div>
                    <div class="mb-3"><label>Alamat</label><textarea class="form-control" rows="4" readonly>{{ $absensi->alamat }}</textarea></div>
                    <p><a href="https://www.google.com/maps?q={{ $absensi->latitude }},{{ $absensi->longitude }}" target="_blank" class="btn btn-info"><i class="fas fa-map-marker-alt"></i> Buka Lokasi</a></p>
                    <a href="{{ route('admin.absensi.index') }}" class="btn btn-default">Kembali</a>
                </div>
            </div>
        </div>
    </div>
@endsection
