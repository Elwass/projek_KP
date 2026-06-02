@extends('base')

@section('header')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/AdminLTE/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('sidebar')
    @include('admin.sidebar')
@endsection

@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Detail Data Pegawai</h1>
                </div>
                {{-- breadcrumb --}}
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.pegawai.index') }}">Data ...</a></li>
                        <li class="breadcrumb-item active">Detail Data Pegawai</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('main-content')
    <div class="card card-primary card-outline">
        <div class="card-body">
            <form>
                <div class="row">
                    {{-- form nama --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="{{ $pegawai->name }}" readonly>
                        </div>
                    </div>
                    {{-- form email --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $pegawai->email }}" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    {{-- form username --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" value="{{ $pegawai->username }}" readonly>
                        </div>
                    </div>
                    {{-- form no_telp --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="no_telp" class="form-label">No Telpon</label>
                            <input type="text" class="form-control" id="no_telp" name="no_telp" value="{{ $pegawai->no_telp }}" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    {{-- form tempat lahir --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="tempat_lahir" class="form-label">Tempat lahir</label>
                            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="{{ $pegawai->tempat_lahir }}" readonly>
                        </div>
                    </div>
                    {{-- form tgl lahir --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" value="{{ $pegawai->tgl_lahir }}" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    {{-- form alamat --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $pegawai->alamat }}" readonly>
                        </div>
                    </div>
                    {{-- form jenis kelamin --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <select class="custom-select" name="jk">
                                <option value="pria" {{ $pegawai->jk === 'pria' ? 'selected' : 'disabled' }}>Pria</option>
                                <option value="perempuan" {{ $pegawai->jk === 'perempuan' ? 'selected' : 'disabled' }}>Perempuan</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    {{-- form agama --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="agama" class="form-label">Agama</label>
                            <input type="text" class="form-control" id="agama" name="agama" value="{{ $pegawai->agama }}" readonly>
                        </div>
                    </div>
                    {{-- form no ktp --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="no_ktp" class="form-label">No KTP</label>
                            <input type="text" class="form-control" id="no_ktp" name="no_ktp" value="{{ $pegawai->no_ktp }}" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    {{-- form role --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Role</label>
                            <select class="custom-select" name="role">
                                <option value="admin" {{ $pegawai->role === 'admin' ? 'selected' : 'disabled' }}>Admin</option>
                                <option value="pendamping" {{ $pegawai->role === 'pendamping' ? 'selected' : 'disabled' }}>Pendamping Lapangan</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    {{-- form foto --}}
                    <div class="col-md-6">
                        <label for="foto">Pas Photo</label>
                        <p><img src="{{ asset("storage/$pegawai->foto") }}" alt="" style="width: 150px"></p>
                    </div>
                </div>
                <br>
                <a href="{{ route('admin.pegawai.index') }}" class="btn btn-default">Kembali</a>
            </form>
        </div>
    </div>
    @if ($pegawai->role === "pendamping")
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="m-0">Data Peserta PKL</h5>
            </div>
            <div class="card-body">
                {{-- Tabel Peserta --}}
                <table id="tabel-peserta" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Bagian/Sub Bagian</th>
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
                                <td>{{ $peserta->name }}</td>
                                <td>{{ $peserta->nama }}</td>
                                <td>{{ $peserta->tgl_mulai }}</td>
                                <td>{{ $peserta->tgl_selesai }}</td>
                                <td>{{ $peserta->status_peserta }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.peserta.detail', $peserta->id_peserta) }}" class="btn btn-sm btn-warning" aria-label="detail"><i class="fas fa-eye"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
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
@endsection