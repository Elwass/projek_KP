@extends('base')

@section('header')
    <link rel="stylesheet" href="{{ asset('assets/AdminLTE/plugins/toastr/toastr.min.css') }}">
@endsection

@section('sidebar')
    @include('peserta.sidebar')
@endsection

@section('content-header')
    <div class="content-header"><div class="container-fluid"><div class="row mb-2"><div class="col-sm-6"><h1 class="m-0">Detail Logbook Magang</h1></div><div class="col-sm-6"><ol class="breadcrumb float-sm-right"><li class="breadcrumb-item"><a href="{{ route('peserta.index') }}">Home</a></li><li class="breadcrumb-item"><a href="{{ route('peserta.logbook.index') }}">Logbook Magang</a></li><li class="breadcrumb-item active">Detail</li></ol></div></div></div></div>
@endsection

@section('main-content')
    <div class="card card-primary card-outline"><div class="card-body">
        <div class="row"><div class="col-md-6"><div class="mb-3"><label>Tanggal</label><input type="text" class="form-control" value="{{ $logbook->tanggal }}" readonly></div></div><div class="col-md-6"><div class="mb-3"><label>Status</label><p>@include('logbook.status', ['status' => $logbook->status])</p></div></div></div>
        <div class="row"><div class="col-md-6"><div class="mb-3"><label>Jam Mulai</label><input type="text" class="form-control" value="{{ substr($logbook->jam_mulai, 0, 5) }}" readonly></div></div><div class="col-md-6"><div class="mb-3"><label>Jam Selesai</label><input type="text" class="form-control" value="{{ substr($logbook->jam_selesai, 0, 5) }}" readonly></div></div></div>
        <div class="mb-3"><label>Judul Kegiatan</label><input type="text" class="form-control" value="{{ $logbook->judul_kegiatan }}" readonly></div>
        <div class="mb-3"><label>Deskripsi Kegiatan</label><textarea class="form-control" rows="5" readonly>{{ $logbook->deskripsi_kegiatan }}</textarea></div>
        <div class="mb-3"><label>Lokasi</label><input type="text" class="form-control" value="{{ $logbook->lokasi ?? '-' }}" readonly></div>
        <div class="mb-3"><label>Catatan Pembimbing</label><textarea class="form-control" rows="3" readonly>{{ $logbook->catatan_pembimbing ?? '-' }}</textarea></div>
        <div class="mb-3"><label>Bukti Kegiatan</label><p>@if ($logbook->bukti_kegiatan)<a href="{{ route('file.logbook', $logbook->id) }}" target="_blank">lihat file</a>@else - @endif</p></div>
        @if ($logbook->status != 'disetujui')<a href="{{ route('peserta.logbook.edit', $logbook->id) }}" class="btn btn-primary">Edit</a>@endif
        <a href="{{ route('peserta.logbook.index') }}" class="btn btn-default">Kembali</a>
    </div></div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/AdminLTE/plugins/toastr/toastr.min.js') }}"></script>
    @if (session()->has('error'))<script>toastr.error('{{ session('error') }}');</script>@endif
@endsection
