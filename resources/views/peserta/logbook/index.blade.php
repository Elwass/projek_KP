@extends('base')

@section('header')
    <link rel="stylesheet" href="{{ asset('assets/AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/AdminLTE/plugins/toastr/toastr.min.css') }}">
@endsection

@section('sidebar')
    @include('peserta.sidebar')
@endsection

@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Logbook Magang</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('peserta.index') }}">Home</a></li>
                        <li class="breadcrumb-item active">Logbook Magang</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('main-content')
    <div class="card card-primary card-outline">
        <div class="card-header">
            <a href="{{ route('peserta.logbook.tambah') }}" class="btn btn-success"><i class="fas fa-plus"></i> Tambah Logbook</a>
        </div>
        <div class="card-body">
            <table id="tabel-logbook" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Judul Kegiatan</th>
                        <th>Jam</th>
                        <th>Lokasi</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($logbooks as $logbook)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $logbook->tanggal }}</td>
                            <td>{{ $logbook->judul_kegiatan }}</td>
                            <td>{{ substr($logbook->jam_mulai, 0, 5) }} - {{ substr($logbook->jam_selesai, 0, 5) }}</td>
                            <td>{{ $logbook->lokasi ?? '-' }}</td>
                            <td class="text-center">@include('logbook.status', ['status' => $logbook->status])</td>
                            <td class="text-center">
                                <a href="{{ route('peserta.logbook.detail', $logbook->id) }}" class="btn btn-sm btn-warning" aria-label="detail"><i class="fas fa-eye"></i></a>
                                @if ($logbook->status != 'disetujui')
                                    <a href="{{ route('peserta.logbook.edit', $logbook->id) }}" class="btn btn-sm btn-primary" aria-label="edit"><i class="fas fa-pencil-alt"></i></a>
                                    <button class="btn btn-sm btn-danger modal-hapus" data-id="{{ $logbook->id }}" data-judul="{{ $logbook->judul_kegiatan }}" title="hapus"><i class="fas fa-trash"></i></button>
                                @else
                                    <button class="btn btn-sm btn-primary" disabled><i class="fas fa-pencil-alt"></i></button>
                                    <button class="btn btn-sm btn-danger" disabled><i class="fas fa-trash"></i></button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="modalHapus">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus logbook?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{ route('peserta.logbook.hapus') }}" method="post">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <div class="modal-body">
                        <p>Yakin ingin menghapus logbook <strong id="judul"></strong>?</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Ya</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/AdminLTE/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/AdminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/AdminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/AdminLTE/plugins/toastr/toastr.min.js') }}"></script>
    <script>
        $(function () {
            $('#tabel-logbook').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });

            $('.modal-hapus').on('click', function() {
                $('#id').val($(this).attr('data-id'));
                $('#judul').text($(this).attr('data-judul'));
                $('#modalHapus').modal('show');
            });
        });
    </script>
    @if (session()->has('success'))
        <script>toastr.success('{{ session('success') }}');</script>
    @endif
    @if (session()->has('error'))
        <script>toastr.error('{{ session('error') }}');</script>
    @endif
@endsection
