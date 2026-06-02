<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PKL | {{ $title }}</title>
  @include('partials.header')
  @yield('header')
</head>

<body class="hold-transition sidebar-mini">

    <div class="wrapper">

        <!-- Navbar -->
        @include('partials.navbar')

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="/" class="brand-link">
                <img src="{{ asset('assets/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Sistem<b>PKL</b></span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                @auth
                @if (auth()->user()->role == "peserta")
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <!-- Memuat foto profil dari direktori storage/foto/ -->
                        <img src="{{ asset('storage/' . auth()->user()->foto) }}" class="img-circle elevation-2" alt="User Image">
                        <!-- Menggunakan auth()->user()->foto untuk mendapatkan nama file gambar dari pengguna yang sedang login -->
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{ auth()->user()->username }}</a>
                    </div>
                </div>
                @else
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <!-- Memuat foto profil dari direktori storage/foto/ -->
                        <img src="{{ asset('storage/' . auth()->user()->foto) }}" class="img-circle elevation-2" alt="User Image">
                        <!-- Menggunakan auth()->user()->foto untuk mendapatkan nama file gambar dari pengguna yang sedang login -->
                    </div>
                    <div class="info">
                        <a href="{{ route('admin.pegawai.edit', auth()->user()->id) }}" class="d-block">{{ auth()->user()->username }}</a>
                    </div>
                </div>
                @endif
                @endauth

                <!-- Sidebar Menu -->
                @yield('sidebar')
            </div>
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            @yield('content-header')
            

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    @yield('main-content')
                </div>
            </div>
        </div>

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- Default to the left -->
            {{-- <strong>Copyright &copy; 2021 <a href="https://bithouse.id/">BIT House</a>.</strong> All rights reserved. --}}
        </footer>

    </div>

    @include('partials.scripts')
    @yield('scripts')
</body>
</html>
