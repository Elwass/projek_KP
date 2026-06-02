@extends('base')

@section('sidebar')
    @include('admin.sidebar')
@endsection

@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Detail Data Peserta PKL</h1>
                </div>
                {{-- breadcrumb --}}
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.peserta.index') }}">Data Peserta PKL</a></li>
                        <li class="breadcrumb-item active">Detail Data Peserta PKL</li>
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
                            <input type="text" class="form-control" id="nama" value="{{ $peserta->name }}" name="nama" readonly>
                        </div>
                    </div>
                    {{-- form email --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" value="{{ $peserta->email }}" name="email" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    {{-- form tempat lahir --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="tempat_lahir" class="form-label">Tempat lahir</label>
                            <input type="text" class="form-control" id="tempat_lahir" value="{{ $peserta->tempat_lahir }}" name="tempat_lahir" readonly>
                        </div>
                    </div>
                    {{-- form tgl lahir --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="tgl_lahir" value="{{ $peserta->tgl_lahir }}" name="tgl_lahir" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    {{-- form alamat --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="alamat" value="{{ $peserta->alamat }}" name="alamat" readonly>
                        </div>
                    </div>
                    {{-- form jenis kelamin --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <select class="custom-select" name="jk">
                                <option value="pria" {{ $peserta->jk === 'pria' ? 'selected' : 'disabled' }}>Pria</option>
                                <option value="perempuan" {{ $peserta->jk === 'perempuan' ? 'selected' : 'disabled' }}>Perempuan</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    {{-- form agama --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="agama" class="form-label">Agama</label>
                            <input type="text" class="form-control" id="agama" value="{{ $peserta->agama }}" name="agama" readonly>
                        </div>
                    </div>
                    {{-- form no ktp --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="no_ktp" class="form-label">No KTP</label>
                            <input type="text" class="form-control" id="no_ktp" value="{{ $peserta->no_ktp }}" name="no_ktp" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    {{-- form no_telp --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="no_telp" class="form-label">No Telpon</label>
                            <input type="text" class="form-control" id="no_telp" value="{{ $peserta->no_telp }}" name="no_telp" readonly>
                        </div>
                    </div>
                    {{-- form nim --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nim" class="form-label">NIM/NRP</label>
                            <input type="text" class="form-control" id="nim" value="{{ $peserta->nim }}" name="nim" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    {{-- form univ --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="univ" class="form-label">Universitas</label>
                            <input type="text" class="form-control" id="univ" value="{{ $peserta->universitas }}" name="univ" readonly>
                        </div>
                    </div>
                    {{-- form jurusan --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="jurusan" class="form-label">Jurusan</label>
                            <input type="text" class="form-control" id="jurusan" value="{{ $peserta->jurusan }}" name="jurusan" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    {{-- form tgl_mulai --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="tgl_mulai" class="form-label">Tanggal mulai PKL</label>
                            <input type="date" class="form-control" id="tgl_mulai" value="{{ $peserta->tgl_mulai }}" name="tgl_mulai" readonly>
                        </div>
                    </div>
                    {{-- form tgl_selesai --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="tgl_selesai" class="form-label">Tanggal selesai PKL</label>
                            <input type="date" class="form-control" id="tgl_selesai" value="{{ $peserta->tgl_selesai }}" name="tgl_selesai" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    {{-- form pendamping --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Pendamping Lapangan</label>
                            <select class="custom-select" name="pendamping">
                                @foreach ($pendampings as $pendamping)
                                    <option value="{{ $pendamping->id }}" {{ $peserta->pendamping == $pendamping->id ? 'selected' : 'disabled' }}>{{ $pendamping->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    {{-- form Instansi --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Instansi</label>
                            <select class="custom-select" name="instansi">
                                @foreach ($instansis as $instansi)
                                    <option value="{{ $instansi->id }}" {{ $peserta->id_instansi == $instansi->id ? 'selected' : 'disabled' }}>{{ $instansi->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    {{-- form jadwal --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="jadwal" class="form-label">Jadwal</label>
                            <input type="text" class="form-control" id="jadwal" value="{{ $jadwal }}" name="jadwal" readonly>
                        </div>
                    </div>
                    {{-- form cv --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="cv" class="form-label">Curriculum vitae (CV)</label>
                            <p class="mt-2"><a href="{{ asset('storage/'.$peserta->cv) }}">download file</a></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    {{-- form pengajuan --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="pengajuan" class="form-label">Dokumen Pengajuan PKL</label>
                            <p class="mt-2"><a href="{{ asset('storage/'.$peserta->pengajuan) }}">download file</a></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    {{-- form foto --}}
                    <div class="col-md-6">
                        <label for="foto" class="form-label">Pas Photo</label>
                        <p>
                            <img src="{{ asset('storage/'.$peserta->foto) }}" style="width: 150px">
                        </p>
                    </div>
                </div>
                <br>
                <a href="{{ route('admin.peserta.index') }}" class="btn btn-default">kembali</a>
            </form>
        </div>
    </div>
@endsection