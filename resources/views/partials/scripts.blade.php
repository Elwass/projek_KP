<!-- jQuery -->
<script src="{{ asset('assets/AdminLTE/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('assets/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/AdminLTE/dist/js/adminlte.min.js') }}"></script>
<script>
    (function () {
        var storageKey = 'theme-mode';
        var modeSelect = document.getElementById('theme-mode');
        var mediaQuery = window.matchMedia('(prefers-color-scheme: dark)');

        function preferredTheme() {
            return mediaQuery.matches ? 'dark' : 'light';
        }

        function selectedMode() {
            return localStorage.getItem(storageKey) || 'auto';
        }

        function resolvedTheme(mode) {
            return mode === 'auto' ? preferredTheme() : mode;
        }

        function applyTheme(mode) {
            var activeMode = mode || selectedMode();
            var darkMode = resolvedTheme(activeMode) === 'dark';

            document.documentElement.classList.toggle('theme-dark', darkMode);
            document.body.classList.toggle('dark-mode', darkMode);

            if (modeSelect) {
                modeSelect.value = activeMode;
            }
        }

        applyTheme(selectedMode());

        if (modeSelect) {
            modeSelect.addEventListener('change', function () {
                localStorage.setItem(storageKey, this.value);
                applyTheme(this.value);
            });
        }

        function syncAutoTheme() {
            if (selectedMode() === 'auto') {
                applyTheme('auto');
            }
        }

        if (mediaQuery.addEventListener) {
            mediaQuery.addEventListener('change', syncAutoTheme);
        } else if (mediaQuery.addListener) {
            mediaQuery.addListener(syncAutoTheme);
        }
    })();
</script>
