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
                    <h1 class="m-0">Data Peserta PKL</h1>
                </div>
                {{-- breadcrumb --}}
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                        <li class="breadcrumb-item active">Data Peserta PKL</li>
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
            <table id="tabel-peserta" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Instansi</th>
                        <th>Mulai</th>
                        <th>Selesai</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pesertas as $peserta)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $peserta->nama }}</td>
                            <td>{{ $peserta->instansi }}</td>
                            <td>{{ $peserta->tgl_mulai }}</td>
                            <td>{{ $peserta->tgl_selesai }}</td>
                            @if ($peserta->status == "belum dimulai")
                                <td class="text-center"><button type="button" class="btn btn-sm btn-block btn-warning">{{ $peserta->status }}</button></td>
                            @elseif ($peserta->status == "berlangsung")
                                <td class="text-center"><button type="button" class="btn btn-sm btn-block btn-success">{{ $peserta->status }}</button></td>
                            @elseif ($peserta->status == "selesai")
                                <td class="text-center"><button type="button" class="btn btn-sm btn-block btn-danger">{{ $peserta->status }}</button></td>
                            @else
                                <td class="text-center"><button type="button" class="btn btn-sm btn-block btn-danger">{{ $peserta->status }}</button></td>
                            @endif
                            <td class="text-center">
                                @if (auth()->user()->role != "admin")
                                    <a href="{{ route('admin.peserta.detail', $peserta->id) }}" class="btn btn-sm btn-warning" aria-label="detail"><i class="fas fa-eye"></i></a>
                                @else
                                    <a href="{{ route('admin.peserta.edit', $peserta->id) }}" class="btn btn-sm btn-primary" aria-label="edit"><i class="fas fa-pencil-alt"></i></a>
                                    <a href="{{ route('admin.peserta.detail', $peserta->id) }}" class="btn btn-sm btn-warning" aria-label="detail"><i class="fas fa-eye"></i></a>
                                    @if ($peserta->status != 'selesai' && $peserta->status != 'berhenti')
                                        <button class="btn btn-sm btn-danger modal-berhenti" data-id="{{ $peserta->id }}" data-name="{{ $peserta->nama }}" title="berhenti"><i class="fas fa-ban"></i></button>
                                        <button class="btn btn-sm btn-danger modal-hapus" title="hapus" disabled><i class="fas fa-trash"></i></button>
                                    @else
                                        <button class="btn btn-sm btn-danger modal-berhenti" data-id="{{ $peserta->id }}" data-name="{{ $peserta->nama }}" title="berhenti" disabled><i class="fas fa-ban"></i></button>
                                        <button class="btn btn-sm btn-danger modal-hapus" 
                                        data-id="{{ $peserta->id }}" 
                                        data-name="{{ $peserta->nama }}" 
                                        data-foto="{{ $peserta->foto }}"
                                        data-cv="{{ $peserta->cv }}"
                                        data-pengajuan="{{ $peserta->pengajuan }}"
                                        data-user="{{ $peserta->user }}"
                                        data-id_pendaftar="{{ $peserta->id_pendaftar }}"
                                        title="hapus"><i class="fas fa-trash"></i></button>
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
                    <h4 class="modal-title">Hapus data peserta?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.peserta.hapus') }}" method="post">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="name" id="name">
                    <input type="hidden" name="foto" id="foto">
                    <input type="hidden" name="cv" id="cv">
                    <input type="hidden" name="pengajuan" id="pengajuan">
                    <input type="hidden" name="user" id="user">
                    <input type="hidden" name="id_pendaftar" id="id_pendaftar">
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Ya</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    {{-- MODAL --}}
    <div class="modal fade" id="modalBerhenti">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Hentikan kegiatan PKL peserta?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.peserta.berhenti') }}" method="post">
                    @csrf
                    <input type="hidden" name="id" id="id_berhenti">
                    <input type="hidden" name="name" id="name_berhenti">
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
            $('#tabel-peserta').DataTable({
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
                var name = $(this).attr('data-name');
                $('#name').val(name);
                var foto = $(this).attr('data-foto');
                $('#foto').val(foto);
                var cv = $(this).attr('data-cv');
                $('#cv').val(cv);
                var pengajuan = $(this).attr('data-pengajuan');
                $('#pengajuan').val(pengajuan);
                var user = $(this).attr('data-user');
                $('#user').val(user);
                var id_pendaftar = $(this).attr('data-id_pendaftar');
                $('#id_pendaftar').val(id_pendaftar);

                $('#modalHapus').modal('show');   
            });     
        });
        $(function() {
            $('.modal-berhenti').on('click', function() {
                var id = $(this).attr('data-id');
                $('#id_berhenti').val(id);
                var name = $(this).attr('data-name');
                $('#name_berhenti').val(name);

                $('#modalBerhenti').modal('show');   
            });     
        });
    </script>
@endsection