@extends('base')

@section('sidebar')
    @include('admin.sidebar')
@endsection

@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Data Peserta PKL</h1>
                </div>
                {{-- breadcrumb --}}
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.peserta.index') }}">Data Peserta PKL</a></li>
                        <li class="breadcrumb-item active">Edit Data Peserta PKL</li>
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
            <form action="{{ route('admin.peserta.edit', $peserta->id_peserta) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    {{-- form nama --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" value="{{ old('nama', $peserta->name) }}" name="nama">
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
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ $peserta->email }}" name="email" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    {{-- form tempat lahir --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="tempat_lahir" class="form-label">Tempat lahir</label>
                            <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir" value="{{ old('tempat_lahir', $peserta->tempat_lahir) }}" name="tempat_lahir">
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
                            <input type="date" class="form-control @error('tgl_lahir') is-invalid @enderror" id="tgl_lahir" value="{{ old('tgl_lahir', $peserta->tgl_lahir) }}" name="tgl_lahir">
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
                            <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" value="{{ old('alamat', $peserta->alamat) }}" name="alamat">
                        </div>
                    </div>
                    {{-- form jenis kelamin --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <select class="custom-select" name="jk">
                                <option value="pria" {{ old('jk', $peserta->jk) === 'pria' ? 'selected' : '' }}>Pria</option>
                                <option value="perempuan" {{ old('jk', $peserta->jk) === 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    {{-- form agama --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="agama" class="form-label">Agama</label>
                            <input type="text" class="form-control @error('agama') is-invalid @enderror" id="agama" value="{{ old('agama', $peserta->agama) }}" name="agama">
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
                            <input type="text" class="form-control @error('no_ktp') is-invalid @enderror" id="no_ktp" value="{{ old('no_ktp', $peserta->no_ktp) }}" name="no_ktp">
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
                            <input type="text" class="form-control @error('no_telp') is-invalid @enderror" id="no_telp" value="{{ old('no_telp', $peserta->no_telp) }}" name="no_telp">
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
                            <input type="text" class="form-control @error('nim') is-invalid @enderror" id="nim" value="{{ old('nim', $peserta->nim) }}" name="nim">
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
                            <input type="text" class="form-control @error('univ') is-invalid @enderror" id="univ" value="{{ old('univ', $peserta->universitas) }}" name="univ">
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
                            <input type="text" class="form-control @error('jurusan') is-invalid @enderror" id="jurusan" value="{{ old('jurusan', $peserta->jurusan) }}" name="jurusan">
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
                            <input type="date" class="form-control @error('tgl_mulai') is-invalid @enderror" id="tgl_mulai" value="{{ old('tgl_mulai', $peserta->tgl_mulai) }}" name="tgl_mulai">
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
                            <input type="date" class="form-control @error('tgl_selesai') is-invalid @enderror" id="tgl_selesai" value="{{ old('tgl_selesai', $peserta->tgl_selesai) }}" name="tgl_selesai">
                            @error('tgl_selesai')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
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
                                    <option value="{{ $pendamping->id }}" {{ old('pendamping', $peserta->pendamping) == $pendamping->id ? 'selected' : '' }}>{{ $pendamping->name }}</option>
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
                                    <option value="{{ $instansi->id }}" {{ old('instansi', $peserta->id_instansi) == $instansi->id ? 'selected' : '' }}>{{ $instansi->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    {{-- form cv --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="cv">Curriculum vitae (CV)</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input @error('cv') is-invalid @enderror" id="cv" name="cv">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                                @error('cv')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @else
                                    <small id="emailHelp" class="form-text text-muted">upload file baru jika ingin mengubah file sebelumnya</small>
                                @enderror
                            </div>
                          </div>
                    </div>
                    {{-- form pengajuan --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="pengajuan">Dokumen Pengajuan PKL</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input @error('pengajuan') is-invalid @enderror" id="pengajuan" name="pengajuan">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                                @error('pengajuan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @else
                                    <small id="emailHelp" class="form-text text-muted">upload file baru jika ingin mengubah file sebelumnya</small>
                                @enderror
                            </div>
                          </div>
                    </div>
                </div>
                <div class="row">
                    {{-- form foto --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="foto">Pas Photo</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input @error('foto') is-invalid @enderror" id="foto" name="foto">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                                @error('foto')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @else
                                    <small id="emailHelp" class="form-text text-muted">upload file baru jika ingin mengubah file sebelumnya</small>
                                @enderror
                            </div>
                          </div>
                    </div>
                </div>
                <br>
                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{ route('admin.peserta.index') }}" class="btn btn-default">Batal</a>
            </form>
        </div>
    </div>
@endsection