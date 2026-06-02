@extends('base')

@section('sidebar')
    @include('peserta.sidebar')
@endsection

@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div>
                {{-- breadcrumb --}}
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('peserta.index') }}">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('main-content')
    <div class="card card-primary card-outline">
        <div class="card-body text-center">
            <h3 class="text-primary font-weight-bold">Sekretariat DPRD Kab. Banyumas</h3>
            <p class="card-text">Sekretariat DPRD Kabupaten Banyumas adalah lembaga yang bertugas mendukung kelancaran penyelenggaraan fungsi, tugas, dan wewenang Dewan Perwakilan Rakyat Daerah Kabupaten Banyumas. Sekretariat DPRD menyediakan layanan administratif, fasilitasi rapat, serta pengelolaan tata usaha dan keuangan DPRD. Selain itu, Sekretariat DPRD juga berperan dalam mendukung komunikasi, dokumentasi, serta penyediaan informasi publik terkait kegiatan kedewanan di Kabupaten Banyumas.</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 d-flex align-items-stretch">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="text-primary font-weight-bold">Misi kami</h5>
                    <p class="card-text">Terwujudnya pelayanan prima dalam mendukung tugas dan fungsi DPRD Kabupaten Banyumas, melalui peningkatan kualitas pelayanan administratif, fasilitasi rapat dan sidang, pengelolaan arsip serta dokumentasi, serta penguatan komunikasi publik yang transparan dan akuntabel demi terciptanya tata kelola pemerintahan daerah yang baik.</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 d-flex align-items-stretch">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="text-primary font-weight-bold">Visi kami</h5>
                    <p class="card-text">Meningkatkan pelayanan bidang adminitrasi, rapat, informasi serta sarana prasarana. Meningkatkan kualitas SDM anggota DPRD</p>
                </div>
            </div>
        </div>
    </div>
@endsection