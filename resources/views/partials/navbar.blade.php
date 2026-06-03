<nav class="main-header navbar navbar-expand navbar-white navbar-light app-top-navbar">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button" aria-label="Toggle sidebar"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <ul class="navbar-nav ml-auto align-items-center">
        <li class="nav-item mr-2">
            <div class="navbar-theme-mode" aria-label="Mode tampilan">
                <i class="fas fa-adjust navbar-theme-icon" aria-hidden="true"></i>
                <select id="theme-mode" class="custom-select custom-select-sm navbar-theme-select" aria-label="Pilih mode tampilan">
                    <option value="light">Light</option>
                    <option value="dark">Dark</option>
                    <option value="auto">Auto</option>
                </select>
            </div>
        </li>
        @auth
            @php
                $user = auth()->user();
                $profileUrl = $user->role === 'peserta' ? route('siswa.biodata') : route('admin.pegawai.edit', $user->id);
                $displayName = $user->name ?: $user->username;
                $avatarUrl = $user->foto ? route('file.user', [$user->id, 'foto']) . '?v=' . optional($user->updated_at)->timestamp : asset('assets/img/avatar5.png');
            @endphp
            <li class="nav-item">
                <a href="{{ $profileUrl }}" class="nav-link navbar-user-profile" aria-label="Profil {{ $displayName }}">
                    <img src="{{ $avatarUrl }}" class="navbar-user-avatar" alt="Avatar {{ $displayName }}">
                    <span class="navbar-user-name">{{ $displayName }}</span>
                </a>
            </li>
        @endauth
    </ul>
</nav>
