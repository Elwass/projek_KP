@extends('base')

@section('header')
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
                    <h1 class="m-0">Penjadwalan Peserta</h1>
                </div>
                {{-- breadcrumb --}}
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                        <li class="breadcrumb-item active">Penjadwalan Peserta</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('main-content')
    <div class="row mb-3">
        <div class="col-sm-12">
            <a href="{{ route('admin.penjadwalan.edit') }}" class="btn btn-default btn-block"><b><i class="fas fa-edit"></i> Ubah Penjadwalan</b></a>
        </div>
    </div>
    <div class="row text-center">
        @foreach ($days as $day)
            <div class="col">
                <div class="card card-{{ $day[1] }}">
                    <div class="card-header">
                        <h5 class="m-0 text-capitalize">{{ $day[0] }}</h5>
                    </div>
                    <div class="card-body">
                        @foreach ($jadwal[$day[0]] as $item)
                            <a href="{{ route('admin.peserta.detail', $item['id']) }}" class="btn btn-{{ $day[1] }} btn-block btn-sm">{{ \Illuminate\Support\Str::limit($item['nama'], 15) }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@section('scripts')
    <!-- Toastr -->
    <script src="{{ asset('assets/AdminLTE/plugins/toastr/toastr.min.js') }}"></script>

    {{-- alert berhasil regis --}}
    @if (session()->has('success'))
        <script>
            toastr.success('{{ session('success') }}');
        </script>
    @endif
@endsection