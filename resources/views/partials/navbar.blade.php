<nav class="main-header navbar navbar-expand navbar-white navbar-light app-top-navbar">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button" aria-label="Toggle sidebar"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <ul class="navbar-nav ml-auto align-items-center">
        @auth
            @php
                $user = auth()->user();
                $profileUrl = $user->role === 'peserta' ? '#' : route('admin.pegawai.edit', $user->id);
                $displayName = $user->name ?: $user->username;
                $avatarUrl = $user->foto ? route('file.user', [$user->id, 'foto']) : asset('assets/img/avatar5.png');
            @endphp
            <li class="nav-item">
                <a href="{{ $profileUrl }}" class="nav-link navbar-user-profile" aria-label="Profil {{ $displayName }}">
                    <img src="{{ $avatarUrl }}" class="navbar-user-avatar" alt="Avatar {{ $displayName }}">
                    <span class="navbar-user-name">{{ $displayName }}</span>
                </a>
            </li>
        @endauth
        <li class="nav-item ml-2">
            <button type="button" class="btn btn-sm navbar-theme-toggle" id="theme-toggle" aria-label="Toggle dark mode" aria-pressed="false">
                <i class="fas fa-moon" id="theme-toggle-icon"></i>
                <span class="d-none d-sm-inline" id="theme-toggle-text">Dark</span>
            </button>
        </li>
    </ul>
</nav>
