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
            <h3>Selamat datang Aditya Pratama</h3>
            <p class="card-title">Maaf pengajuan Praktik Kerja Lapangan (PKL) anda <span class="font-weight-bold text-danger">ditolak</span> oleh admin </p>
            <p class="card-title">Terima kasih telah mendaftar Praktik Kerja Lapangan (PKL) pada BIT House</p>
        </div>
    </div>
@endsection