<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <a href="{{ route('admin.index') }}" class="nav-link {{ $active === 'index' ? 'active' : '' }}">
                <i class="nav-icon fas fa-home"></i>
                <p>
                    Dashboard
                </p>
            </a>
        </li>
        <li class="nav-item {{ in_array($active, ['pendaftaran','peserta','instansi','pegawai']) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ in_array($active, ['pendaftaran','peserta','instansi','pegawai']) ? 'active' : '' }}">
                <i class="nav-icon fas fa-table"></i>
                <p>
                    Master Data
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('admin.pendaftaran.index') }}" class="nav-link {{ $active === 'pendaftaran' ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Pendaftaran</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.peserta.index') }}" class="nav-link {{ $active === 'peserta' ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Peserta PKL</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.instansi.index') }}" class="nav-link {{ $active === 'instansi' ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Bagian/Sub Bagian</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.pegawai.index') }}" class="nav-link {{ $active === 'pegawai' ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Pegawai</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.penjadwalan.index') }}" class="nav-link {{ $active === 'penjadwalan' ? 'active' : '' }}">
                <i class="nav-icon fas fa-calendar-alt"></i>
                <p>
                    Penjadwalan
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('login.logout') }}" class="nav-link">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>
                    Logout
                </p>
            </a>
        </li>
    </ul>
</nav>