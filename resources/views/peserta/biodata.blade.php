@extends('base')

@section('sidebar')
    @include('peserta.sidebar')
@endsection

@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Biodata Siswa</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('peserta.index') }}">Home</a></li>
                        <li class="breadcrumb-item active">Biodata Siswa</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('main-content')
    @php
        $emptyValue = '-';
        $genderLabels = [
            'pria' => 'Pria',
            'perempuan' => 'Perempuan',
        ];
    @endphp

    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title">Biodata Siswa</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 text-center mb-4">
                    <label class="d-block">Foto Profil</label>
                    <img src="{{ $user->foto ? route('file.user', [$user->id, 'foto']) : asset('assets/img/avatar5.png') }}" alt="Foto profil {{ $user->name }}" class="img-fluid rounded border mb-3" style="max-height: 220px; object-fit: cover;">
                </div>

                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama</label>
                                <p class="form-control-plaintext border rounded px-3 py-2 bg-light">{{ $user->name ?: $emptyValue }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Username</label>
                                <p class="form-control-plaintext border rounded px-3 py-2 bg-light">{{ $user->username ?: $emptyValue }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email</label>
                                <p class="form-control-plaintext border rounded px-3 py-2 bg-light">{{ $user->email ?: $emptyValue }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>No HP</label>
                                <p class="form-control-plaintext border rounded px-3 py-2 bg-light">{{ $user->no_telp ?: $emptyValue }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tempat Lahir</label>
                                <p class="form-control-plaintext border rounded px-3 py-2 bg-light">{{ $user->tempat_lahir ?: $emptyValue }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal Lahir</label>
                                <p class="form-control-plaintext border rounded px-3 py-2 bg-light">{{ $user->tgl_lahir ?: $emptyValue }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Agama</label>
                        <p class="form-control-plaintext border rounded px-3 py-2 bg-light">{{ $user->agama ?: $emptyValue }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <p class="form-control-plaintext border rounded px-3 py-2 bg-light">{{ $genderLabels[$user->jk] ?? $emptyValue }}</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>No KTP</label>
                        <p class="form-control-plaintext border rounded px-3 py-2 bg-light">{{ $user->no_ktp ?: $emptyValue }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>NIM/NRP</label>
                        <p class="form-control-plaintext border rounded px-3 py-2 bg-light">{{ optional($pendaftar)->nim ?: $emptyValue }}</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Universitas</label>
                        <p class="form-control-plaintext border rounded px-3 py-2 bg-light">{{ optional($pendaftar)->universitas ?: $emptyValue }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Jurusan</label>
                        <p class="form-control-plaintext border rounded px-3 py-2 bg-light">{{ optional($pendaftar)->jurusan ?: $emptyValue }}</p>
                    </div>
                </div>
            </div>

            <div class="form-group mb-0">
                <label>Alamat</label>
                <p class="form-control-plaintext border rounded px-3 py-2 bg-light mb-0">{{ $user->alamat ?: $emptyValue }}</p>
            </div>
        </div>
    </div>
@endsection
