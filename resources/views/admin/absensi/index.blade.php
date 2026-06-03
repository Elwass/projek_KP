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
                <div class="col-sm-6"><h1 class="m-0">Absensi Scan Wajah</h1></div>
                <div class="col-sm-6"><ol class="breadcrumb float-sm-right"><li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li><li class="breadcrumb-item active">Absensi Scan Wajah</li></ol></div>
            </div>
        </div>
    </div>
@endsection

@section('main-content')
    <div class="card card-primary card-outline">
        <div class="card-header">
            <form action="{{ route('admin.absensi.index') }}" method="GET">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group mb-0">
                            <label for="tanggal">Filter Tanggal</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ request('tanggal') }}">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group mb-0">
                            <label for="user_id">Filter Peserta</label>
                            <select class="custom-select" id="user_id" name="user_id">
                                <option value="">Semua peserta</option>
                                @foreach ($pesertas as $peserta)
                                    <option value="{{ $peserta->id }}" {{ request('user_id') == $peserta->id ? 'selected' : '' }}>{{ $peserta->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary mr-2"><i class="fas fa-search"></i> Filter</button>
                        <a href="{{ route('admin.absensi.index') }}" class="btn btn-default">Reset</a>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <a href="{{ route('admin.absensi.export.pdf', request()->only(['tanggal', 'user_id'])) }}" class="btn btn-danger">
                    <i class="fas fa-file-pdf"></i> Export PDF
                </a>
            </div>
            <table id="tabel-absensi" class="table table-bordered table-hover">
                <thead><tr><th>Nama Peserta</th><th>Jurusan</th><th>Universitas</th><th>Waktu</th><th>Status</th><th class="text-center">Aksi</th></tr></thead>
                <tbody>
                    @foreach ($absensis as $absensi)
                        <tr>
                            <td>{{ $absensi->nama_peserta }}</td>
                            <td>{{ $absensi->jurusan ?? '-' }}</td>
                            <td>{{ $absensi->universitas ?? '-' }}</td>
                            <td>{{ $absensi->tanggal_waktu }}</td>
                            <td class="text-center">@include('absensi.status', ['status' => $absensi->status_absen])</td>
                            <td class="text-center"><a href="{{ route('admin.absensi.detail', $absensi->id) }}" class="btn btn-sm btn-warning" aria-label="detail"><i class="fas fa-eye"></i></a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/AdminLTE/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/AdminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/AdminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script>$(function () { $('#tabel-absensi').DataTable({"paging": true,"lengthChange": true,"searching": true,"ordering": true,"info": true,"autoWidth": false,"responsive": true}); });</script>
@endsection
