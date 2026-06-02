@extends('base')

@section('sidebar')
    @include('peserta.sidebar')
@endsection

@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Pendaftaran</h1>
                </div>
                {{-- breadcrumb --}}
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('peserta.index') }}">Home</a></li>
                        <li class="breadcrumb-item active">Pendaftaran</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('main-content')
    <div class="card card-primary card-outline">
        <div class="card-body">
            <h3>Selamat datang {{ $namaPeserta }}</h3>
            <p class="card-title">Pengajuan Praktik Kerja Lapangan (PKL) telah <span class="font-weight-bold text-success">diterima</span> oleh admin </p>
            <p class="card-title">silahkan hubungi pendamping lapangan berikut untuk mendapatkan informasi PKL lebih lanjut</p>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Pendaftar</h3>
        </div>
        <div class="card-body">
            <table class="table table-sm table-borderless col-6">
                <tbody>
                    <tr>
                        <td>Nama</td>
                        <td> : </td>
                        <td>{{ $namaPeserta }}</td>
                    </tr>
                    <tr>
                        <td>No Telpon</td>
                        <td> : </td>
                        <td>{{ $user->no_telp ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td> : </td>
                        <td>{{ $user->email ?? '-' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Pendamping Lapangan</h3>
        </div>
        <div class="card-body">
            <table class="table table-sm table-borderless col-6">
                <tbody>
                  <tr>
                    <td>Nama</td>
                    <td> : </td>
                    <td>{{ $pendamping->name ?? '-' }}</td>
                  </tr>
                  <tr>
                    <td>No Telpon</td>
                    <td> : </td>
                    <td>{{ $pendamping->no_telp ?? '-' }}</td>
                  </tr>
                  <tr>
                    <td>Email</td>
                    <td> : </td>
                    <td>{{ $pendamping->email ?? '-' }}</td>
                  </tr>
                </tbody>
              </table>
        </div>
    </div>
@endsection
