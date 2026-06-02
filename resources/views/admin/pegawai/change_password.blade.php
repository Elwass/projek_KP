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
                    <h1 class="m-0">Change Password</h1>
                </div>
                {{-- breadcrumb --}}
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.pegawai.index') }}">Data ...</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.pegawai.edit', $id) }}">Edit ...</a></li>
                        <li class="breadcrumb-item active">Change Password</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('main-content')
    <div class="card card-primary card-outline">
        <div class="card-body">
            <form action="{{ route('admin.pegawai.change_password', $id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    {{-- form old_password --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="old_password" class="form-label">Old Password</label>
                            <input type="password" class="form-control @error('old_password') is-invalid @enderror" id="old_password" name="old_password">
                            @error('old_password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    {{-- form new_password --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="new_password" class="form-label">New Password</label>
                            <input type="password" class="form-control @error('new_password') is-invalid @enderror" id="new_password" name="new_password">
                            @error('new_password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <br>
                <button type="submit" class="btn btn-success">Save</button>
                <a href="{{ route('admin.pegawai.edit', $id) }}" class="btn btn-default">Batal</a>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
     <!-- Toastr -->
     <script src="{{ asset('assets/AdminLTE/plugins/toastr/toastr.min.js') }}"></script>

     @if (session()->has('success'))
         <script>
             toastr.success('{{ session('success') }}');
         </script>
     @endif
     @if (session()->has('error'))
        <script>
            toastr.error('{{ session('error') }}');
        </script>
     @endif
@endsection