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
                    <h1 class="m-0">Data Pendaftaran Peserta</h1>
                </div>
                {{-- breadcrumb --}}
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                        <li class="breadcrumb-item active">Data Pendaftaran Peserta</li>
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
            <table id="tabel-instansi" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Instansi</th>
                        <th>Jurusan</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pendaftars as $pendaftar)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $pendaftar->name }}</td>
                            <td>{{ $pendaftar->universitas }}</td>
                            <td>{{ $pendaftar->jurusan }}</td>
                            @if ($pendaftar->status == "daftar")
                                <td class="text-center"><button type="button" class="btn btn-sm btn-block btn-warning">{{ $pendaftar->status }}</button></td>
                            @elseif ($pendaftar->status == "diterima")
                                <td class="text-center"><button type="button" class="btn btn-sm btn-block btn-success">{{ $pendaftar->status }}</button></td>
                            @else
                                <td class="text-center"><button type="button" class="btn btn-sm btn-block btn-danger">{{ $pendaftar->status }}</button></td>
                            @endif
                            <td class="text-center">
                                @if (auth()->user()->role != "admin")
                                    <a href="{{ route('admin.pendaftaran.detail', $pendaftar->id) }}" class="btn btn-sm btn-primary" aria-label="detail"><i class="fas fa-eye"></i></a>
                                @else 
                                    <a href="{{ route('admin.pendaftaran.detail', $pendaftar->id) }}" class="btn btn-sm btn-primary" aria-label="detail"><i class="fas fa-eye"></i></a>
                                    @if ($pendaftar->status == 'daftar')
                                        <a href="{{ route('admin.pendaftaran.terima', $pendaftar->id) }}" class="btn btn-sm btn-success" aria-label="terima"><i class="fas fa-check-circle"></i></a>
                                        <button class="btn btn-sm btn-danger modal-tolak" 
                                        data-id="{{ $pendaftar->id }}" data-nama="{{ $pendaftar->name }}" title="tolak"><i class="fas fa-times-circle"></i></button>
                                    @else
                                        <button class="btn btn-sm btn-success" aria-label="terima" disabled><i class="fas fa-check-circle"></i></button>
                                        <button class="btn btn-sm btn-danger modal-tolak" data-id="{{ $pendaftar->id }}" data-nama="{{ $pendaftar->name }}" title="tolak" disabled><i class="fas fa-times-circle"></i></button>
                                    @endif
                                    @if ($pendaftar->status == 'ditolak')
                                        <button class="btn btn-sm btn-danger modal-hapus" aria-label="hapus" 
                                        data-id_pendaftar="{{ $pendaftar->id }}" 
                                        data-id_user="{{ $pendaftar->id_user }}" 
                                        data-nama_user="{{ $pendaftar->name }}"
                                        data-foto="{{ $pendaftar->foto }}" 
                                        data-cv="{{ $pendaftar->cv }}" 
                                        data-pengajuan="{{ $pendaftar->pengajuan }}" 
                                        ><i class="fas fa-trash"></i></button>
                                    @else
                                        <button class="btn btn-sm btn-danger" aria-label="hapus" disabled><i class="fas fa-trash"></i></button>
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
    <div class="modal fade" id="modalTolak">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tolak pengajuan PKL?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.pendaftaran.tolak') }}" method="post">
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

    <div class="modal fade" id="modalHapus">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus data pendaftaran PKL?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.pendaftaran.hapus') }}" method="post">
                    @csrf
                    <input type="hidden" name="id_user" id="id_user">
                    <input type="hidden" name="id_pendaftar" id="id_pendaftar">
                    <input type="hidden" name="nama_user" id="nama_user">
                    <input type="hidden" name="foto" id="foto">
                    <input type="hidden" name="cv" id="cv">
                    <input type="hidden" name="pengajuan" id="pengajuan">
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

    {{-- MODAL --}}
    <script>
        $(function() {
            $('.modal-tolak').on('click', function() {
                var id = $(this).attr('data-id');
                $('#id').val(id);
                var nama = $(this).attr('data-nama');
                $('#nama').val(nama);

                $('#modalTolak').modal('show');   
            });     
        });

        $(function() {
            $('.modal-hapus').on('click', function() {
                var id_user = $(this).attr('data-id_user');
                $('#id_user').val(id_user);
                var id_pendaftar = $(this).attr('data-id_pendaftar');
                $('#id_pendaftar').val(id_pendaftar);
                var nama_user = $(this).attr('data-nama_user');
                $('#nama_user').val(nama_user);
                var foto = $(this).attr('data-foto');
                $('#foto').val(foto);
                var cv = $(this).attr('data-cv');
                $('#cv').val(cv);
                var pengajuan = $(this).attr('data-pengajuan');
                $('#pengajuan').val(pengajuan);

                $('#modalHapus').modal('show');   
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
@endsection