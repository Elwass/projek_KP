@extends('base')

@section('header')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/AdminLTE/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('assets/AdminLTE/plugins/toastr/toastr.min.css') }}">
@endsection

@section('sidebar')
    @include('admin.sidebar')
@endsection

@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Bagian/Sub Bagian</h1>
                </div>
                {{-- breadcrumb --}}
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                        <li class="breadcrumb-item active">Data Bagian/Sub Bagian</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('main-content')

    {{-- tabel data peserta --}}
    <div class="card card-primary card-outline">
        <div class="card-body">
            @if (auth()->user()->role === "admin")
                <a href="{{ route('admin.instansi.tambah') }}" class="btn btn-success btn-sm float-right"><i class="fas fa-plus"></i> Tambah</a>
            @endif
            <table id="tabel-instansi" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Jumlah peserta</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($instansis as $instansi)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $instansi->nama }}</td>
                            <td>{{ $jumlah_peserta[$instansi->id] }}</td>
                            @if ($status[$instansi->id] == "Berlangsung")
                                <td class="text-center"><button type="button" class="btn btn-sm btn-block btn-success">{{ $status[$instansi->id] }}</button></td>
                            @else
                                <td class="text-center"><button type="button" class="btn btn-sm btn-block btn-danger">{{ $status[$instansi->id] }}</button></td>
                            @endif
                            <td class="text-center">
                                @if (auth()->user()->role != "admin")
                                    <a href="{{ route('admin.instansi.detail', $instansi->id) }}" class="btn btn-sm btn-warning" aria-label="detail"><i class="fas fa-eye"></i></a>
                                @else
                                    <a href="{{ route('admin.instansi.edit', $instansi->id) }}" class="btn btn-sm btn-primary" aria-label="edit"><i class="fas fa-pencil-alt"></i></a>
                                    <a href="{{ route('admin.instansi.detail', $instansi->id) }}" class="btn btn-sm btn-warning" aria-label="detail"><i class="fas fa-eye"></i></a>
                                    @if ($jumlah_peserta[$instansi->id] == 0)
                                        <button class="btn btn-sm btn-danger modal-hapus" data-id="{{ $instansi->id }}" data-nama="{{ $instansi->nama }}" title="tolak"><i class="fas fa-trash"></i></button>
                                    @else
                                        <button class="btn btn-sm btn-danger modal-hapus" data-id="{{ $instansi->id }}" data-nama="{{ $instansi->nama }}" title="tolak" disabled><i class="fas fa-trash"></i></button>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


    {{-- MODAL --}}
    <div class="modal fade" id="modalHapus">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus data bagian/sub bagian?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.instansi.hapus') }}" method="post">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="nama" id="nama">
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
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('assets/AdminLTE/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/AdminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/AdminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/AdminLTE/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/AdminLTE/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script>
        $(function () {
            $('#tabel-instansi').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>

    <!-- Toastr -->
    <script src="{{ asset('assets/AdminLTE/plugins/toastr/toastr.min.js') }}"></script>

    {{-- alert berhasil regis --}}
    @if (session()->has('success'))
        <script>
            toastr.success('{{ session('success') }}');
        </script>
    @endif

    {{-- MODAL --}}
    <script>
        $(function() {
            $('.modal-hapus').on('click', function() {
                var id = $(this).attr('data-id');
                $('#id').val(id);
                var nama = $(this).attr('data-nama');
                $('#nama').val(nama);

                $('#modalHapus').modal('show');   
            });     
        });
    </script>
@endsection