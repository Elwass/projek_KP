<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome Icons -->
<link rel="stylesheet" href="{{ asset('assets/AdminLTE/plugins/fontawesome-free/css/all.min.css') }}">
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('assets/AdminLTE/dist/css/adminlte.min.css') }}">
<script>
    (function () {
        var savedTheme = localStorage.getItem('theme-mode');
        var useDarkMode = savedTheme === 'dark' || (!savedTheme && window.matchMedia('(prefers-color-scheme: dark)').matches);

        if (useDarkMode) {
            document.documentElement.classList.add('theme-dark');
        }
    })();
</script>
<style>
    .app-top-navbar {
        min-height: 60px;
        border-bottom: 1px solid rgba(0, 0, 0, .06);
        box-shadow: 0 2px 14px rgba(15, 23, 42, .06);
        padding-left: 1rem;
        padding-right: 1rem;
    }

    .navbar-user-profile {
        align-items: center;
        border-radius: 999px;
        display: inline-flex;
        gap: .5rem;
        padding: .35rem .75rem !important;
        transition: background-color .2s ease, color .2s ease;
    }

    .navbar-user-profile:hover {
        background-color: rgba(0, 123, 255, .08);
    }

    .navbar-user-avatar {
        border: 2px solid rgba(0, 123, 255, .18);
        border-radius: 50%;
        height: 34px;
        object-fit: cover;
        width: 34px;
    }

    .navbar-user-name {
        color: #1f2937;
        font-weight: 600;
        max-width: 180px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .navbar-theme-toggle {
        align-items: center;
        border: 1px solid rgba(108, 117, 125, .25);
        border-radius: 999px;
        display: inline-flex;
        gap: .35rem;
        padding: .4rem .75rem;
    }

    html.theme-dark .app-top-navbar,
    body.dark-mode .app-top-navbar {
        background-color: #111827 !important;
        border-bottom-color: rgba(255, 255, 255, .08);
        box-shadow: 0 2px 14px rgba(0, 0, 0, .3);
    }

    html.theme-dark .navbar-user-name,
    body.dark-mode .navbar-user-name,
    html.theme-dark .app-top-navbar .nav-link,
    body.dark-mode .app-top-navbar .nav-link {
        color: #f9fafb !important;
    }

    html.theme-dark .navbar-user-profile:hover,
    body.dark-mode .navbar-user-profile:hover {
        background-color: rgba(255, 255, 255, .08);
    }

    html.theme-dark .navbar-theme-toggle,
    body.dark-mode .navbar-theme-toggle {
        background-color: #1f2937;
        border-color: rgba(255, 255, 255, .16);
        color: #f9fafb;
    }

    @media (max-width: 575.98px) {
        .app-top-navbar {
            padding-left: .5rem;
            padding-right: .5rem;
        }

        .navbar-user-name {
            max-width: 120px;
        }

        .navbar-user-profile {
            padding-left: .45rem !important;
            padding-right: .45rem !important;
        }
    }
</style>
