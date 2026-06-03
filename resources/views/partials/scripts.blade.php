<!-- jQuery -->
<script src="{{ asset('assets/AdminLTE/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('assets/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/AdminLTE/dist/js/adminlte.min.js') }}"></script>
<script>
    (function () {
        var storageKey = 'theme-mode';
        var toggleButton = document.getElementById('theme-toggle');
        var toggleIcon = document.getElementById('theme-toggle-icon');
        var toggleText = document.getElementById('theme-toggle-text');
        var mediaQuery = window.matchMedia('(prefers-color-scheme: dark)');

        function preferredTheme() {
            return mediaQuery.matches ? 'dark' : 'light';
        }

        function selectedTheme() {
            return localStorage.getItem(storageKey) || preferredTheme();
        }

        function applyTheme(theme) {
            var darkMode = theme === 'dark';

            document.documentElement.classList.toggle('theme-dark', darkMode);
            document.body.classList.toggle('dark-mode', darkMode);

            if (toggleButton) {
                toggleButton.setAttribute('aria-pressed', darkMode ? 'true' : 'false');
            }

            if (toggleIcon) {
                toggleIcon.className = darkMode ? 'fas fa-sun' : 'fas fa-moon';
            }

            if (toggleText) {
                toggleText.textContent = darkMode ? 'Light' : 'Dark';
            }
        }

        applyTheme(selectedTheme());

        if (toggleButton) {
            toggleButton.addEventListener('click', function () {
                var nextTheme = document.body.classList.contains('dark-mode') ? 'light' : 'dark';
                localStorage.setItem(storageKey, nextTheme);
                applyTheme(nextTheme);
            });
        }

        function syncAutoTheme() {
            if (!localStorage.getItem(storageKey)) {
                applyTheme(preferredTheme());
            }
        }

        if (mediaQuery.addEventListener) {
            mediaQuery.addEventListener('change', syncAutoTheme);
        } else if (mediaQuery.addListener) {
            mediaQuery.addListener(syncAutoTheme);
        }
    })();
</script>
