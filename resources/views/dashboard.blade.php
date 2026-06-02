<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem informasi Praktek Kerja Lapangan</title>
    <link rel="icon" href="assets/img/images-removebg-preview.png" type="image/png">
    <link href="https://fonts.googleapis.com/css?family=Heebo:400,500,700|Fira+Sans:600" rel="stylesheet">
    <link rel="stylesheet" href="assets/landing/dist/css/style.css">
    <script src="https://unpkg.com/animejs@2.2.0/anime.min.js"></script>
    <script src="https://unpkg.com/scrollreveal@4.0.0/assets/landing/dist/scrollreveal.min.js"></script>
</head>
<body class="is-boxed has-animations">
    <div class="body-wrap boxed-container">
        <header class="site-header">
            <div class="header-shape header-shape-1">
                <svg width="337" height="222" viewBox="0 0 337 222" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <linearGradient x1="50%" y1="55.434%" x2="50%" y2="0%" id="header-shape-1">
                            <stop stop-color="#E0E1FE" stop-opacity="0" offset="0%"/>
                            <stop stop-color="#E0E1FE" offset="100%"/>
                        </linearGradient>
                    </defs>
                    <path d="M1103.21 0H1440v400h-400c145.927-118.557 166.997-251.89 63.21-400z" transform="translate(-1103)" fill="url(#header-shape-1)" fill-rule="evenodd"/>
                </svg>
            </div>
            <div class="header-shape header-shape-2">
                <svg width="128" height="128" viewBox="0 0 128 128" xmlns="http://www.w3.org/2000/svg" style="overflow:visible">
                    <defs>
                        <linearGradient x1="93.05%" y1="19.767%" x2="15.034%" y2="85.765%" id="header-shape-2">
                            <stop stop-color="#FF3058" offset="0%"/>
                            <stop stop-color="#FF6381" offset="100%"/>
                        </linearGradient>
                    </defs>
                    <circle class="anime-element fadeup-animation" cx="64" cy="64" r="64" fill="url(#header-shape-2)" fill-rule="evenodd"/>
                </svg>
            </div>
            <div class="container">
                <div class="site-header-inner">
                    <div class="brand header-brand">
                        <h1 class="m-0">
                            <a href="#">

                                <title>Sistem Monitoring Praktek Kerja Lapangan</title>

                                <div class="site-header-inner">
                                    <div class="brand header-brand">
                                        <h1 class="m-0">
                                            <a href="#">
                                                <!-- Menambahkan tag <img> untuk menampilkan logo -->
                                                <img class="header-logo-image" src="{{ asset('assets/img/logo.png') }}" alt="Logo" width="300" height="50">
                                            </a>
                                        </h1>
                                    </div>
                                </div>
                            </a>
                        </h1>
                    </div>
                </div>
            </div>
        </header>

        <main>
            <section class="hero">
                <div class="container">
                    <div class="hero-inner">
                        <div class="hero-copy">
                            <h1 class="hero-title mt-0">SIS-PKL</h1>
                            <p class="hero-paragraph">Sistem Monitoring Praktek Kerja Lapangan (PKL)<br>merupakan suatu aplikasi berbasis web yang <br> digunakan untuk mengelola data Praktek Kerja Lapangan <br>di Kantor Sekretariat DPRD Kabupaten Banyumas.</p>
                            <div class="hero-form field field-grouped">
                                <div class="control">
                                    <a class="button button-primary button-block" href="{{ route('login.index') }}">Masuk ke Aplikasi</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="hero-media">
                            <img src="assets/img/alimochtar.png" alt="Image" width="400" height="400">
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <script src="assets/landing/dist/js/main.min.js"></script>
    </body>
    </html>
