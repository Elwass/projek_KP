@extends('base')

@section('sidebar')
    @include('admin.sidebar')
@endsection

@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Penerimaan Pendaftaran Peserta</h1>
                </div>
                {{-- breadcrumb --}}
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.pendaftaran.index') }}">Data ...</a></li>
                        <li class="breadcrumb-item active">Penerimaan Pendaftaran Peserta</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('main-content')
    <form action="{{ route('admin.pendaftaran.terima', $pendaftar->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card card-primary card-outline">
            <div class="card-body">
                <div class="row">
                    {{-- form nama --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" value="{{ old('nama', $pendaftar->name) }}" name="nama">
                            @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    {{-- form email --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ $pendaftar->email }}" name="email" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    {{-- form tempat lahir --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="tempat_lahir" class="form-label">Tempat lahir</label>
                            <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir" value="{{ old('tempat_lahir', $pendaftar->tempat_lahir) }}" name="tempat_lahir">
                            @error('tempat_lahir')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    {{-- form tgl lahir --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control @error('tgl_lahir') is-invalid @enderror" id="tgl_lahir" value="{{ old('tgl_lahir', $pendaftar->tgl_lahir) }}" name="tgl_lahir">
                            @error('tgl_lahir')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    {{-- form alamat --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" value="{{ old('alamat', $pendaftar->alamat) }}" name="alamat">
                        </div>
                    </div>
                    {{-- form jenis kelamin --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <select class="custom-select" name="jk">
                                <option value="pria" {{ old('jk', $pendaftar->jk) === 'pria' ? 'selected' : '' }}>Pria</option>
                                <option value="perempuan" {{ old('jk', $pendaftar->jk) === 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    {{-- form agama --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="agama" class="form-label">Agama</label>
                            <input type="text" class="form-control @error('agama') is-invalid @enderror" id="agama" value="{{ old('agama', $pendaftar->agama) }}" name="agama">
                            @error('agama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    {{-- form no ktp --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="no_ktp" class="form-label">No KTP</label>
                            <input type="text" class="form-control @error('no_ktp') is-invalid @enderror" id="no_ktp" value="{{ old('no_ktp', $pendaftar->no_ktp) }}" name="no_ktp">
                            @error('no_ktp')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    {{-- form no_telp --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="no_telp" class="form-label">No Telpon</label>
                            <input type="text" class="form-control @error('no_telp') is-invalid @enderror" id="no_telp" value="{{ old('no_telp', $pendaftar->no_telp) }}" name="no_telp">
                            @error('no_telp')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    {{-- form nim --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nim" class="form-label">NIM/NRP</label>
                            <input type="text" class="form-control @error('nim') is-invalid @enderror" id="nim" value="{{ old('nim', $pendaftar->nim) }}" name="nim">
                            @error('nim')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    {{-- form univ --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="univ" class="form-label">Universitas</label>
                            <input type="text" class="form-control @error('univ') is-invalid @enderror" id="univ" value="{{ old('univ', $pendaftar->universitas) }}" name="univ">
                            @error('univ')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    {{-- form jurusan --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="jurusan" class="form-label">Jurusan</label>
                            <input type="text" class="form-control @error('jurusan') is-invalid @enderror" id="jurusan" value="{{ old('jurusan', $pendaftar->jurusan) }}" name="jurusan">
                            @error('jurusan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    {{-- form tgl_mulai --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="tgl_mulai" class="form-label">Tanggal mulai PKL</label>
                            <input type="date" class="form-control @error('tgl_mulai') is-invalid @enderror" id="tgl_mulai" value="{{ old('tgl_mulai', $pendaftar->tgl_mulai) }}" name="tgl_mulai">
                            @error('tgl_mulai')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    {{-- form tgl_selesai --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="tgl_selesai" class="form-label">Tanggal selesai PKL</label>
                            <input type="date" class="form-control @error('tgl_selesai') is-invalid @enderror" id="tgl_selesai" value="{{ old('tgl_selesai', $pendaftar->tgl_selesai) }}" name="tgl_selesai">
                            @error('tgl_selesai')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
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
            </div>
        </div>
        <div class="card card-primary card-outline">
            <div class="card-body">
                <div class="row">
                    {{-- form pendamping --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Pendamping Lapangan</label>
                            <select class="custom-select" name="pendamping">
                                @foreach ($pendampings as $pendamping)
                                    <option value="{{ $pendamping->id }}">{{ $pendamping->name }}</option>
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
                                    <option value="{{ $instansi->id }}">{{ $instansi->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <br>
                <button type="submit" class="btn btn-success">Terima</button>
                <a href="{{ route('admin.pendaftaran.index') }}" class="btn btn-default">batal</a>
            </div>
        </div>
    </form>
@endsection