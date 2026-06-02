@extends('base')

@section('header')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/AdminLTE/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('sidebar')
    @include('admin.sidebar')
@endsection

@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Penjadwalan Peserta</h1>
                </div>
                {{-- breadcrumb --}}
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.penjadwalan.index') }}">Penjadwalan ...</a></li>
                        <li class="breadcrumb-item active">Edit Penjadwalan Peserta</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('main-content')
    <div class="card card-primary card-outline">
        <div class="card-body">
            <form action="{{ route('admin.penjadwalan.edit') }}" method="POST">
                @csrf
                <table id="tabel-jadwal" class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Nama</th>
                            <th scope="col" class="text-center">Senin</th>
                            <th scope="col" class="text-center">Selasa</th>
                            <th scope="col" class="text-center">Rabu</th>
                            <th scope="col" class="text-center">Kamis</th>
                            <th scope="col" class="text-center">Jumat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pesertas as $peserta)
                            <tr>
                                <td><a href="{{ route('admin.peserta.detail', $peserta->id) }}">{{ $peserta->nama }}</a></td>
                                <td class="text-center">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="senin-{{ $peserta->id }}" value="senin" name="jadwal[{{ $peserta->id }}][]" {{ in_array("senin", $jadwal_peserta[$peserta->id]) ? 'checked' : '' }}>
                                        <label for="senin-{{ $peserta->id }}" class="custom-control-label"></label>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="selasa-{{ $peserta->id }}" value="selasa" name="jadwal[{{ $peserta->id }}][]" {{ in_array("selasa", $jadwal_peserta[$peserta->id]) ? 'checked' : '' }}>
                                        <label for="selasa-{{ $peserta->id }}" class="custom-control-label"></label>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="rabu-{{ $peserta->id }}" value="rabu" name="jadwal[{{ $peserta->id }}][]" {{ in_array("rabu", $jadwal_peserta[$peserta->id]) ? 'checked' : '' }}>
                                        <label for="rabu-{{ $peserta->id }}" class="custom-control-label"></label>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="kamis-{{ $peserta->id }}" value="kamis" name="jadwal[{{ $peserta->id }}][]" {{ in_array("kamis", $jadwal_peserta[$peserta->id]) ? 'checked' : '' }}>
                                        <label for="kamis-{{ $peserta->id }}" class="custom-control-label"></label>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="jumat-{{ $peserta->id }}" value="jumat" name="jadwal[{{ $peserta->id }}][]" {{ in_array("jumat", $jadwal_peserta[$peserta->id]) ? 'checked' : '' }}>
                                        <label for="jumat-{{ $peserta->id }}" class="custom-control-label"></label>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <br>
                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{ route('admin.penjadwalan.index') }}" class="btn btn-default">Batal</a>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('assets/AdminLTE/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/AdminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/AdminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/AdminLTE/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/AdminLTE/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script>
        $(function () {
            $('#tabel-jadwal').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": false,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endsection