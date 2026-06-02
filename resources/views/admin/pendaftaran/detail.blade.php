@extends('base')

@section('sidebar')
    @include('admin.sidebar')
@endsection

@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Detail Data Pendaftaran Peserta</h1>
                </div>
                {{-- breadcrumb --}}
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.pendaftaran.index') }}">Data ...</a></li>
                        <li class="breadcrumb-item active">Detail Data Pendaftaran Peserta</li>
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
                            <input type="text" class="form-control" id="nama" value="{{ $pendaftar->name }}" name="nama" readonly>
                        </div>
                    </div>
                    {{-- form email --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" value="{{ $pendaftar->email }}" name="email" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    {{-- form tempat lahir --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="tempat_lahir" class="form-label">Tempat lahir</label>
                            <input type="text" class="form-control" id="tempat_lahir" value="{{ $pendaftar->tempat_lahir}}" name="tempat_lahir" readonly>
                        </div>
                    </div>
                    {{-- form tgl lahir --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="tgl_lahir" value="{{ $pendaftar->tgl_lahir }}" name="tgl_lahir" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    {{-- form alamat --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="alamat" value="{{ $pendaftar->alamat }}" name="alamat" readonly>
                        </div>
                    </div>
                    {{-- form jenis kelamin --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <select class="custom-select" name="jk">
                                <option value="pria" {{  $pendaftar->jk === 'pria' ? 'selected' : 'disabled' }}>Pria</option>
                                <option value="perempuan" {{  $pendaftar->jk === 'perempuan' ? 'selected' : 'disabled' }}>Perempuan</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    {{-- form agama --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="agama" class="form-label">Agama</label>
                            <input type="text" class="form-control" id="agama" value="{{ $pendaftar->agama }}" name="agama" readonly>
                        </div>
                    </div>
                    {{-- form no ktp --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="no_ktp" class="form-label">No KTP</label>
                            <input type="text" class="form-control" id="no_ktp" value="{{ $pendaftar->no_ktp }}" name="no_ktp" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    {{-- form no_telp --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="no_telp" class="form-label">No Telpon</label>
                            <input type="text" class="form-control" id="no_telp" value="{{ $pendaftar->no_telp }}" name="no_telp" readonly>
                        </div>
                    </div>
                    {{-- form nim --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nim" class="form-label">NIM/NRP</label>
                            <input type="text" class="form-control" id="nim" value="{{ $pendaftar->nim }}" name="nim" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    {{-- form univ --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="univ" class="form-label">Universitas</label>
                            <input type="text" class="form-control" id="univ" value="{{ $pendaftar->universitas }}" name="univ" readonly>
                        </div>
                    </div>
                    {{-- form jurusan --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="jurusan" class="form-label">Jurusan</label>
                            <input type="text" class="form-control" id="jurusan" value="{{ $pendaftar->jurusan }}" name="jurusan" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    {{-- form tgl_mulai --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="tgl_mulai" class="form-label">Tanggal mulai PKL</label>
                            <input type="date" class="form-control" id="tgl_mulai" value="{{ $pendaftar->tgl_mulai }}" name="tgl_mulai" readonly>
                        </div>
                    </div>
                    {{-- form tgl_selesai --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="tgl_selesai" class="form-label">Tanggal selesai PKL</label>
                            <input type="date" class="form-control" id="tgl_selesai" value="{{ $pendaftar->tgl_selesai }}" name="tgl_selesai" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    {{-- form tgl_daftar --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="tgl_daftar" class="form-label">Tanggal Pendaftaran</label>
                            <input type="date" class="form-control" id="tgl_daftar" value="{{ $pendaftar->tgl_daftar }}" name="tgl_daftar" readonly>
                        </div>
                    </div>
                    {{-- form cv --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="cv" class="form-label">Curriculum vitae (CV)</label>
                            <p class="mt-2"><a href="{{ asset('storage/'.$pendaftar->cv) }}">download file</a></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    {{-- form pengajuan --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="pengajuan" class="form-label">Dokumen Pengajuan PKL</label>
                            <p class="mt-2"><a href="{{ asset('storage/'.$pendaftar->pengajuan) }}">download file</a></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    {{-- form foto --}}
                    <div class="col-md-6">
                        <label for="foto" class="form-label">Pas Photo</label>
                        <p>
                            <img src="{{ asset('storage/'.$pendaftar->foto) }}" style="width: 150px">
                        </p>
                    </div>
                </div>
                <br>
                <a href="{{ route('admin.pendaftaran.index') }}" class="btn btn-default">kembali</a>
            </form>
        </div>
    </div>
@endsection