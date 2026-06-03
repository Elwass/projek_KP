@extends('base')

@section('sidebar')
    @include('peserta.sidebar')
@endsection

@section('content-header')
    <div class="content-header"><div class="container-fluid"><div class="row mb-2"><div class="col-sm-6"><h1 class="m-0">Tambah Logbook Magang</h1></div><div class="col-sm-6"><ol class="breadcrumb float-sm-right"><li class="breadcrumb-item"><a href="{{ route('peserta.index') }}">Home</a></li><li class="breadcrumb-item"><a href="{{ route('peserta.logbook.index') }}">Logbook Magang</a></li><li class="breadcrumb-item active">Tambah</li></ol></div></div></div></div>
@endsection

@section('main-content')
    <div class="card card-primary card-outline"><div class="card-body"><form action="{{ route('peserta.logbook.tambah') }}" method="POST" enctype="multipart/form-data">@include('peserta.logbook.form')</form></div></div>
@endsection
