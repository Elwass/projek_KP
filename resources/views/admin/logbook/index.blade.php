@extends('base')

@section('header')
    <link rel="stylesheet" href="{{ asset('assets/AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
@endsection

@section('sidebar')
    @include('admin.sidebar')
@endsection

@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"><h1 class="m-0">Logbook Magang</h1></div>
                <div class="col-sm-6"><ol class="breadcrumb float-sm-right"><li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li><li class="breadcrumb-item active">Logbook Magang</li></ol></div>
            </div>
        </div>
    </div>
@endsection

@section('main-content')
    <div class="card card-primary card-outline"><div class="card-body">
        <table id="tabel-logbook" class="table table-bordered table-hover">
            <thead><tr><th>No</th><th>Peserta</th><th>NIM</th><th>Tanggal</th><th>Judul Kegiatan</th><th>Pendamping</th><th>Status</th><th class="text-center">Aksi</th></tr></thead>
            <tbody>
                @foreach ($logbooks as $logbook)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $logbook->nama_peserta }}</td>
                        <td>{{ $logbook->nim ?? '-' }}</td>
                        <td>{{ $logbook->tanggal }}</td>
                        <td>{{ $logbook->judul_kegiatan }}</td>
                        <td>{{ $logbook->nama_pendamping ?? '-' }}</td>
                        <td class="text-center">@include('logbook.status', ['status' => $logbook->status])</td>
                        <td class="text-center"><a href="{{ route('admin.logbook.detail', $logbook->id) }}" class="btn btn-sm btn-warning" aria-label="detail"><i class="fas fa-eye"></i></a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div></div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/AdminLTE/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/AdminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/AdminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script>$(function () { $('#tabel-logbook').DataTable({"paging": true,"lengthChange": true,"searching": true,"ordering": true,"info": true,"autoWidth": false,"responsive": true}); });</script>
@endsection
