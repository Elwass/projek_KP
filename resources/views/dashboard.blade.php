<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Informasi Magang Berdampak</title>
    <link rel="icon" href="{{ asset('assets/img/images-removebg-preview.png') }}" type="image/png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #b91c1c;
            --primary-dark: #991b1b;
            --primary-soft: #fef2f2;
            --text: #111827;
            --muted: #4b5563;
            --line: #e5e7eb;
            --bg-soft: #f9fafb;
            --white: #ffffff;
        }

        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            color: var(--text);
            background: var(--white);
            font-family: 'Inter', Arial, sans-serif;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        img {
            max-width: 100%;
            display: block;
        }

        .container {
            width: min(1120px, calc(100% - 32px));
            margin: 0 auto;
        }

        .nav-container {
            width: 100%;
        }

        .site-navbar {
            position: fixed;
            top: 0;
            left: 0;
            z-index: 50;
            width: 100%;
            border-bottom: 1px solid var(--primary);
            background: var(--white);
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        .site-navbar.is-hidden {
            transform: translateY(-100%);
        }

        .site-navbar.is-scrolled {
            box-shadow: 0 2px 12px rgba(15, 23, 42, 0.08);
        }

        .nav-inner {
            min-height: 72px;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            padding: 10px 40px;
        }

        @media (min-width: 768px) {
            .nav-inner {
                min-height: 78px;
                padding-top: 12px;
                padding-bottom: 12px;
            }
        }

        @media (min-width: 1280px) {
            .nav-inner {
                padding-left: 64px;
                padding-right: 64px;
            }
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            min-width: 250px;
        }

        .brand img {
            width: auto;
            height: 42px;
            object-fit: contain;
        }

        @media (min-width: 768px) {
            .brand {
                gap: 12px;
            }

            .brand img {
                height: 48px;
            }
        }

        .brand-title {
            margin: 0;
            color: #0f172a;
            font-size: 13px;
            line-height: 1.2;
            font-weight: 700;
        }

        .brand-subtitle {
            margin: 4px 0 0;
            font-size: 11px;
            color: #64748b;
        }

        .nav-links {
            display: flex;
            align-self: stretch;
            align-items: stretch;
            gap: 2px;
        }

        .nav-link,
        .dropdown-trigger {
            position: relative;
            height: 100%;
            display: flex;
            align-items: center;
            gap: 2px;
            border: 0;
            background: transparent;
            padding: 0 10px;
            color: #1f2937;
            font: inherit;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: color 0.2s ease;
        }

        .nav-link::after,
        .dropdown-trigger::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 0;
            height: 2px;
            background: var(--primary);
            transition: width 0.2s ease;
        }

        .nav-link:hover,
        .nav-link:focus,
        .dropdown-item:hover .dropdown-trigger,
        .dropdown-item:focus-within .dropdown-trigger {
            color: var(--primary-dark);
        }

        .nav-link:hover::after,
        .nav-link:focus::after,
        .dropdown-item:hover .dropdown-trigger::after,
        .dropdown-item:focus-within .dropdown-trigger::after {
            width: 100%;
        }

        .dropdown-item {
            position: relative;
            height: 100%;
            display: flex;
            align-items: center;
        }

        .chevron {
            font-size: 16px;
            line-height: 1;
            transition: transform 0.2s ease;
        }

        .dropdown-item:hover .chevron,
        .dropdown-item:focus-within .chevron {
            transform: rotate(180deg);
        }

        .dropdown-menu {
            position: absolute;
            top: 100%;
            left: 0;
            z-index: 50;
            min-width: 188px;
            padding: 6px;
            background: var(--white);
            box-shadow: 0 10px 24px rgba(15, 23, 42, 0.15);
            opacity: 0;
            pointer-events: none;
            transform: translateY(-4px);
            transition: opacity 0.15s ease, transform 0.15s ease;
        }

        .dropdown-item:hover .dropdown-menu,
        .dropdown-item:focus-within .dropdown-menu {
            opacity: 1;
            pointer-events: auto;
            transform: translateY(0);
        }

        .dropdown-menu a,
        .dropdown-menu button {
            display: block;
            width: 100%;
            border: 0;
            background: transparent;
            padding: 7px 10px;
            color: #1f2937;
            font: inherit;
            font-size: 13px;
            text-align: left;
            transition: color 0.2s ease;
            cursor: pointer;
        }

        .dropdown-menu a:hover,
        .dropdown-menu button:hover {
            color: var(--primary);
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #334155;
        }

        .icon-button,
        .mobile-toggle {
            width: 36px;
            height: 36px;
            border: 0;
            background: transparent;
            color: #334155;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 6px;
            transition: color 0.2s ease;
        }

        .icon-button:hover,
        .mobile-toggle:hover {
            color: var(--primary-dark);
        }

        .icon-button svg,
        .mobile-toggle svg {
            width: 18px;
            height: 18px;
            stroke: currentColor;
            stroke-width: 2;
            fill: none;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .mobile-toggle {
            display: none;
        }

        .mobile-menu {
            display: none;
            border-top: 1px solid var(--line);
            background: var(--white);
            padding: 12px 16px 18px;
        }

        .mobile-menu-group {
            padding: 8px 0;
        }

        .mobile-menu p,
        .mobile-menu a {
            display: block;
            margin: 0;
            padding: 4px 0;
            color: #1f2937;
            font-size: 13px;
            font-weight: 600;
        }

        .mobile-menu .mobile-sub-link {
            padding-left: 12px;
            color: #4b5563;
            font-weight: 500;
        }

        .hero {
            min-height: calc(100vh - 72px);
            margin-top: 72px;
            position: relative;
            overflow: hidden;
            background: url('{{ asset('assets/img/profil.jpg') }}') center/cover no-repeat;
        }

        @media (min-width: 768px) {
            .hero {
                min-height: calc(100vh - 78px);
                margin-top: 78px;
            }
        }

        .hero-inner {
            min-height: calc(100vh - 78px);
            position: relative;
            z-index: 1;
            display: flex;
            align-items: center;
            padding: 80px 0;
        }

        .hero-copy {
            max-width: 680px;
            color: var(--white);
        }

        .eyebrow {
            margin: 0 0 16px;
            color: #fee2e2;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 0.2em;
            text-transform: uppercase;
        }

        .hero h1 {
            margin: 0;
            font-size: clamp(34px, 5.6vw, 58px);
            line-height: 1.08;
            font-weight: 700;
        }

        .hero p {
            max-width: 720px;
            margin: 22px 0 0;
            color: #e5e7eb;
            font-size: clamp(15px, 1.6vw, 17px);
            line-height: 1.8;
        }

        .hero-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 14px;
            margin-top: 32px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 44px;
            padding: 0 22px;
            border: 1px solid transparent;
            font-weight: 700;
            transition: transform 0.2s ease, background 0.2s ease, border-color 0.2s ease;
        }

        .btn:hover {
            transform: translateY(-1px);
        }

        .btn-primary {
            background: var(--primary);
            color: var(--white);
        }

        .btn-primary:hover {
            background: var(--primary-dark);
        }

        .btn-outline {
            border-color: rgba(255, 255, 255, 0.8);
            color: var(--white);
        }

        .btn-outline:hover {
            background: rgba(255, 255, 255, 0.12);
        }

        .section {
            padding: 72px 0;
        }

        .section-tight {
            padding-top: 44px;
        }

        .section-soft {
            background: var(--bg-soft);
        }

        .section-title {
            margin: 0;
            font-size: 24px;
            line-height: 1.3;
            font-weight: 700;
        }

        .section-title.center,
        .section-lead.center {
            text-align: center;
            margin-left: auto;
            margin-right: auto;
        }

        .section-lead {
            max-width: 860px;
            margin: 14px 0 0;
            color: var(--muted);
            line-height: 1.8;
        }

        .profil-grid,
        .terms-grid {
            margin-top: 32px;
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 16px;
        }

        .terms-grid {
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 24px;
        }

        .info-card,
        .term-card,
        .faq-card,
        .contact-card {
            border: 1px solid var(--line);
            background: var(--white);
            box-shadow: 0 12px 32px rgba(15, 23, 42, 0.06);
        }

        .info-card,
        .term-card {
            border-radius: 14px;
            padding: 22px;
        }

        .info-card h3,
        .term-card h3,
        .timeline-card h3 {
            margin: 0 0 12px;
            font-size: 16px;
        }

        .ordered-list,
        .bullet-list {
            margin: 0;
            padding-left: 20px;
            color: var(--muted);
            font-size: 13px;
            line-height: 1.75;
        }

        .timeline-wrap {
            position: relative;
            margin-top: 44px;
            padding-bottom: 8px;
        }

        .timeline-line {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 50%;
            width: 2px;
            transform: translateX(-50%);
            overflow: hidden;
            background: var(--line);
        }

        .timeline-progress {
            width: 100%;
            height: 0;
            background: #ef4444;
            transition: height 0.2s ease;
        }

        .timeline-item {
            position: relative;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 88px;
            align-items: center;
            margin-bottom: 56px;
        }

        .timeline-dot {
            position: absolute;
            left: 50%;
            top: 38px;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            transform: translateX(-50%);
            background: #ef4444;
            box-shadow: 0 0 0 7px rgba(239, 68, 68, 0.16);
            z-index: 2;
        }

        .timeline-side.right {
            grid-column: 2;
        }

        .timeline-card-wrap {
            position: relative;
        }

        .timeline-card-wrap::before {
            content: '';
            position: absolute;
            inset: -8px;
            border-radius: 20px;
            background: #fef2f2;
            filter: blur(14px);
            opacity: 0.62;
        }

        .step-badge {
            display: inline-flex;
            align-items: center;
            margin-bottom: 8px;
            border-radius: 999px;
            padding: 5px 16px;
            background: #ef4444;
            color: var(--white);
            font-size: 11px;
            font-weight: 700;
            box-shadow: 0 10px 20px rgba(239, 68, 68, 0.18);
        }

        .timeline-card {
            position: relative;
            border: 1px solid #f3f4f6;
            border-radius: 18px;
            padding: 22px;
            background: var(--white);
            box-shadow: 0 14px 34px rgba(15, 23, 42, 0.07);
        }

        .faq-card,
        .contact-card {
            margin-top: 24px;
            border-radius: 24px;
            padding: 24px;
        }

        .faq-item {
            border: 1px solid var(--line);
            border-radius: 16px;
            overflow: hidden;
        }

        .faq-item + .faq-item {
            margin-top: 12px;
        }

        .faq-question {
            width: 100%;
            border: 0;
            background: var(--white);
            padding: 18px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            color: #1f2937;
            text-align: left;
            font: inherit;
            font-weight: 700;
            cursor: pointer;
        }

        .faq-answer {
            display: none;
            padding: 0 18px 18px;
            color: var(--muted);
            line-height: 1.75;
            font-size: 13px;
        }

        .faq-item.is-open .faq-answer {
            display: block;
        }

        .faq-icon {
            transition: transform 0.2s ease;
        }

        .faq-item.is-open .faq-icon {
            transform: rotate(180deg);
        }

        .contact-card p,
        .footer p {
            color: var(--muted);
            line-height: 1.8;
        }

        .contact-list {
            margin: 22px 0 0;
            padding-left: 20px;
            color: #374151;
            line-height: 1.8;
        }

        .contact-list a:hover,
        .footer a:hover {
            color: var(--primary);
            text-decoration: underline;
        }

        .footer {
            border-top: 1px solid var(--line);
            background: var(--bg-soft);
            padding: 52px 0 24px;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 1.2fr 1fr 1fr;
            gap: 48px;
        }

        .footer-brand {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .footer-brand img {
            width: 50px;
            height: 50px;
            object-fit: contain;
        }

        .footer h3,
        .footer h4 {
            margin: 0 0 14px;
        }

        .footer ul {
            margin: 0;
            padding: 0;
            list-style: none;
            color: var(--muted);
            line-height: 2;
        }

        .footer-bottom {
            margin-top: 34px;
            padding-top: 20px;
            border-top: 1px solid var(--line);
            display: flex;
            justify-content: space-between;
            gap: 20px;
            flex-wrap: wrap;
            color: #6b7280;
            font-size: 13px;
        }

        .footer-bottom-links {
            display: flex;
            gap: 18px;
        }

        @media (max-width: 960px) {
            .nav-links,
            .nav-actions {
                display: none;
            }

            .nav-inner {
                padding-left: 16px;
                padding-right: 16px;
            }

            .mobile-toggle {
                display: inline-flex;
            }

            .mobile-menu.is-open {
                display: block;
            }

            .profil-grid,
            .terms-grid,
            .footer-grid {
                grid-template-columns: 1fr 1fr;
            }

            .timeline-line {
                left: 8px;
            }

            .timeline-item {
                display: block;
                padding-left: 42px;
                margin-bottom: 36px;
            }

            .timeline-dot {
                left: 8px;
                top: 34px;
            }
        }

        @media (max-width: 640px) {
            .container {
                width: min(100% - 24px, 1120px);
            }

            .brand {
                min-width: 0;
            }

            .brand img {
                height: 42px;
            }

            .brand-title {
                font-size: 13px;
            }

            .brand-subtitle {
                display: none;
            }

            .hero-inner {
                padding: 64px 0;
            }

            .hero-buttons,
            .footer-bottom,
            .footer-bottom-links {
                flex-direction: column;
                align-items: stretch;
            }

            .btn {
                width: 100%;
            }

            .profil-grid,
            .terms-grid,
            .footer-grid {
                grid-template-columns: 1fr;
            }

            .section {
                padding: 56px 0;
            }
        }
    </style>
</head>
<body>
    <header class="site-navbar" id="siteNavbar">
        <div class="nav-container nav-inner">
            <a href="#beranda" class="brand" aria-label="DPRD Kabupaten Banyumas">
                <img src="{{ asset('assets/img/logo.png') }}" alt="Logo DPRD Kabupaten Banyumas">
                <div>
                    <p class="brand-title">DPRD Kabupaten Banyumas</p>
                    <p class="brand-subtitle">Sistem Informasi Magang Berdampak</p>
                </div>
            </a>

            @php
                $menuItems = [
                    ['label' => 'Beranda', 'href' => '#beranda'],
                    ['label' => 'Tentang', 'children' => [
                        ['label' => 'Profil Magang', 'href' => '#profil-magang'],
                        ['label' => 'Alur Magang', 'href' => '#alur-magang'],
                        ['label' => 'Syarat & Ketentuan', 'href' => '#syarat-ketentuan'],
                    ]],
                    ['label' => 'Kegiatan', 'children' => [
                        ['label' => 'Absensi', 'href' => route('login.index')],
                        ['label' => 'Logbook', 'href' => route('login.index')],
                        ['label' => 'Tugas', 'href' => route('login.index')],
                    ]],
                    ['label' => 'Dashboard', 'href' => route('login.index')],
                    ['label' => 'Penilaian', 'children' => [
                        ['label' => 'Evaluasi', 'href' => route('login.index')],
                        ['label' => 'Feedback', 'href' => route('login.index')],
                    ]],
                    ['label' => 'Dokumen', 'children' => [
                        ['label' => 'Template', 'href' => route('login.index')],
                        ['label' => 'Upload', 'href' => route('login.index')],
                    ]],
                    ['label' => 'AI Assistant', 'children' => [
                        ['label' => 'Ringkasan', 'href' => route('login.index')],
                        ['label' => 'Laporan Otomatis', 'href' => route('login.index')],
                    ]],
                    ['label' => 'Informasi', 'children' => [
                        ['label' => 'Pengumuman', 'href' => '#profil-magang'],
                        ['label' => 'FAQ', 'href' => '#faq'],
                        ['label' => 'Kontak', 'href' => '#kontak-bantuan'],
                    ]],
                ];
            @endphp

            <nav class="nav-links" aria-label="Navigasi utama">
                @foreach ($menuItems as $item)
                    @if (isset($item['href']))
                        <a class="nav-link" href="{{ $item['href'] }}">{{ $item['label'] }}</a>
                    @else
                        <div class="dropdown-item">
                            <button type="button" class="dropdown-trigger">
                                {{ $item['label'] }}
                                <span class="chevron" aria-hidden="true">⌄</span>
                            </button>
                            <div class="dropdown-menu">
                                @foreach ($item['children'] as $child)
                                    <a href="{{ $child['href'] }}">{{ $child['label'] }}</a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endforeach
            </nav>

            <div class="nav-actions" aria-hidden="true">
                <button type="button" class="icon-button" title="Bahasa">
                    <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"></circle><path d="M2 12h20"></path><path d="M12 2a15.3 15.3 0 0 1 0 20"></path><path d="M12 2a15.3 15.3 0 0 0 0 20"></path></svg>
                </button>
                <button type="button" class="icon-button" title="Cari">
                    <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"></circle><path d="m21 21-4.35-4.35"></path></svg>
                </button>
            </div>

            <button type="button" class="mobile-toggle" id="mobileToggle" aria-controls="mobileMenu" aria-expanded="false" aria-label="Buka menu">
                <svg class="menu-icon" viewBox="0 0 24 24"><path d="M3 12h18"></path><path d="M3 6h18"></path><path d="M3 18h18"></path></svg>
                <svg class="close-icon" viewBox="0 0 24 24" style="display:none"><path d="M18 6 6 18"></path><path d="m6 6 12 12"></path></svg>
            </button>
        </div>
        <div class="container mobile-menu" id="mobileMenu">
            @foreach ($menuItems as $item)
                <div class="mobile-menu-group">
                    @if (isset($item['href']))
                        <a href="{{ $item['href'] }}">{{ $item['label'] }}</a>
                    @else
                        <p>{{ $item['label'] }}</p>
                        @foreach ($item['children'] as $child)
                            <a href="{{ $child['href'] }}" class="mobile-sub-link">{{ $child['label'] }}</a>
                        @endforeach
                    @endif
                </div>
            @endforeach
        </div>
    </header>

    <main>
        <section class="hero" id="beranda">
            <div class="container hero-inner">
                <div class="hero-copy">
                    <p class="eyebrow">DPRD Kabupaten Banyumas</p>
                    <h1>Sistem Informasi Magang Berdampak</h1>
                    <p>Platform resmi untuk pendaftaran, verifikasi berkas, logbook, monitoring mentor, penilaian, dan laporan akhir program magang DPRD Kabupaten Banyumas.</p>
                    <div class="hero-buttons">
                        <a class="btn btn-primary" href="{{ route('login.index') }}">Masuk Sistem</a>
                        <a class="btn btn-outline" href="{{ route('login.index') }}">Daftar Magang</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="section section-tight" id="profil-magang">
            <div class="container">
                <h2 class="section-title">Profil Program Magang</h2>
                <p class="section-lead">Program magang DPRD Banyumas memberikan kesempatan bagi mahasiswa untuk terlibat langsung dalam lingkungan kerja pemerintahan serta mengembangkan kemampuan teknis dan keterampilan profesional secara terstruktur melalui pendampingan mentor, pencatatan logbook harian, serta evaluasi berkala.</p>

                <div class="profil-grid">
                    <article class="info-card">
                        <h3>Skema Magang</h3>
                        <ol class="ordered-list">
                            <li>Kegiatan berbasis logbook harian</li>
                            <li>Pendampingan oleh mentor instansi</li>
                            <li>Evaluasi berkala selama program</li>
                            <li>Terintegrasi dengan aktivitas kerja instansi</li>
                        </ol>
                    </article>
                    <article class="info-card">
                        <h3>Durasi & Pelaksanaan</h3>
                        <ol class="ordered-list">
                            <li>Durasi menyesuaikan kebijakan kampus dan instansi asal mahasiswa</li>
                            <li>Waktu kegiatan mengikuti operasional instansi</li>
                            <li>Berbasis aktivitas kerja nyata di lingkungan instansi</li>
                        </ol>
                    </article>
                    <article class="info-card">
                        <h3>Bidang Kegiatan</h3>
                        <ol class="ordered-list">
                            <li>Administrasi pemerintahan</li>
                            <li>Sistem informasi dan teknologi</li>
                            <li>Pengelolaan data dan dokumentasi</li>
                            <li>Hukum dan kebijakan publik</li>
                        </ol>
                    </article>
                    <article class="info-card">
                        <h3>Output Program</h3>
                        <ol class="ordered-list">
                            <li>Laporan kegiatan magang</li>
                            <li>Penilaian kinerja dari mentor</li>
                            <li>Rekap logbook harian</li>
                            <li>Pengalaman kerja profesional</li>
                        </ol>
                    </article>
                </div>
            </div>
        </section>

        <section class="section" id="alur-magang">
            <div class="container">
                <h2 class="section-title center">Alur Magang</h2>
                <p class="section-lead center">Proses pelaksanaan magang di DPRD Banyumas secara sistematis dan terstruktur.</p>

                <div class="timeline-wrap" id="timelineWrap">
                    <div class="timeline-line" aria-hidden="true">
                        <div class="timeline-progress" id="timelineProgress"></div>
                    </div>

                    @php
                        $steps = [
                            ['title' => 'Pendaftaran', 'items' => ['Mengisi form pendaftaran online', 'Upload berkas (CV, surat pengantar, dll)']],
                            ['title' => 'Verifikasi', 'items' => ['Seleksi administrasi oleh instansi', 'Penyesuaian bidang magang']],
                            ['title' => 'Pelaksanaan', 'items' => ['Kegiatan magang di instansi', 'Pengisian logbook harian', 'Pendampingan mentor']],
                            ['title' => 'Evaluasi', 'items' => ['Penilaian kinerja peserta', 'Review kegiatan oleh mentor']],
                            ['title' => 'Selesai', 'items' => ['Penyusunan laporan akhir', 'Sertifikat magang']],
                        ];
                    @endphp

                    @foreach ($steps as $index => $step)
                        @php($isRight = $index % 2 === 1)
                        <div class="timeline-item">
                            <span class="timeline-dot" aria-hidden="true"></span>
                            @if ($isRight)
                                <div></div>
                            @endif
                            <div class="timeline-side {{ $isRight ? 'right' : 'left' }}">
                                <span class="step-badge">Step {{ $index + 1 }}</span>
                                <div class="timeline-card-wrap">
                                    <article class="timeline-card">
                                        <h3>{{ $step['title'] }}</h3>
                                        <ul class="bullet-list">
                                            @foreach ($step['items'] as $item)
                                                <li>{{ $item }}</li>
                                            @endforeach
                                        </ul>
                                    </article>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="section section-soft" id="syarat-ketentuan">
            <div class="container">
                <h2 class="section-title center">Syarat & Ketentuan</h2>
                <p class="section-lead center">Ketentuan dan persyaratan yang harus dipenuhi oleh mahasiswa sebelum mengikuti program magang di DPRD Banyumas.</p>

                <div class="terms-grid">
                    <article class="term-card">
                        <h3>Persyaratan Peserta</h3>
                        <ol class="ordered-list">
                            <li>Mahasiswa aktif dari perguruan tinggi</li>
                            <li>Memiliki surat pengantar dari kampus</li>
                            <li>Bersedia mengikuti seluruh rangkaian kegiatan magang</li>
                            <li>Memiliki minat di bidang pemerintahan dan pelayanan publik</li>
                        </ol>
                    </article>
                    <article class="term-card">
                        <h3>Ketentuan Umum</h3>
                        <ol class="ordered-list">
                            <li>Durasi magang menyesuaikan kebijakan kampus dan instansi</li>
                            <li>Jam kegiatan mengikuti operasional instansi</li>
                            <li>Peserta wajib menjaga etika dan kedisiplinan</li>
                            <li>Wajib mengikuti arahan mentor dan pembimbing</li>
                        </ol>
                    </article>
                    <article class="term-card">
                        <h3>Berkas yang Diperlukan</h3>
                        <ol class="ordered-list">
                            <li>Curriculum Vitae (CV)</li>
                            <li>Surat pengantar dari kampus</li>
                            <li>Transkrip nilai (opsional)</li>
                            <li>Dokumen pendukung lainnya jika diperlukan</li>
                        </ol>
                    </article>
                </div>
            </div>
        </section>

        <section class="section" id="faq">
            <div class="container">
                <h2 class="section-title">FAQ Magang Berdampak</h2>
                <div class="faq-card" id="faqList">
                    <article class="faq-item is-open">
                        <button class="faq-question" type="button" aria-expanded="true">
                            <span>Siapa saja yang dapat mendaftar program magang ini?</span>
                            <span class="faq-icon">⌄</span>
                        </button>
                        <div class="faq-answer">Program ini terbuka bagi mahasiswa aktif yang memenuhi persyaratan administrasi dari kampus dan ketentuan instansi DPRD Banyumas.</div>
                    </article>
                    <article class="faq-item">
                        <button class="faq-question" type="button" aria-expanded="false">
                            <span>Bagaimana alur pendaftaran magang dilakukan?</span>
                            <span class="faq-icon">⌄</span>
                        </button>
                        <div class="faq-answer">Pendaftaran dilakukan secara online melalui sistem, dimulai dari registrasi akun, melengkapi data diri, mengunggah berkas, hingga menunggu proses verifikasi.</div>
                    </article>
                    <article class="faq-item">
                        <button class="faq-question" type="button" aria-expanded="false">
                            <span>Dokumen apa saja yang perlu disiapkan?</span>
                            <span class="faq-icon">⌄</span>
                        </button>
                        <div class="faq-answer">Dokumen umum yang biasanya dibutuhkan meliputi surat pengantar kampus, CV, transkrip nilai, dan dokumen pendukung lain sesuai ketentuan periode magang.</div>
                    </article>
                    <article class="faq-item">
                        <button class="faq-question" type="button" aria-expanded="false">
                            <span>Bagaimana cara memantau status seleksi?</span>
                            <span class="faq-icon">⌄</span>
                        </button>
                        <div class="faq-answer">Status pendaftaran dapat dipantau langsung melalui dashboard akun pada Sistem Informasi Magang setelah proses pengajuan selesai.</div>
                    </article>
                </div>
            </div>
        </section>

        <section class="section section-soft" id="kontak-bantuan">
            <div class="container">
                <h2 class="section-title">Kontak & Bantuan</h2>
                <div class="contact-card">
                    <p>Pertanyaan seputar Magang Berdampak? Silakan hubungi unit layanan akademik.</p>
                    <ul class="contact-list">
                        <li><strong>Email:</strong> <a href="mailto:sekwan.inter@gmail.com">sekwan.inter@gmail.com</a></li>
                        <li><strong>WhatsApp:</strong> <a href="https://wa.me/6285175394358" target="_blank" rel="noreferrer">+62 85175394358</a></li>
                    </ul>
                </div>
            </div>
        </section>
    </main>

    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div>
                    <div class="footer-brand">
                        <img src="{{ asset('assets/img/logo.png') }}" alt="Logo DPRD Kabupaten Banyumas">
                        <h3>DPRD Kabupaten Banyumas</h3>
                    </div>
                    <p>Platform informasi dan pendaftaran Magang Berdampak DPRD Kabupaten Banyumas.</p>
                </div>
                <div>
                    <h4>Kontak</h4>
                    <ul>
                        <li><a href="mailto:sekwan.inter@gmail.com">sekwan.inter@gmail.com</a></li>
                        <li><a href="https://wa.me/6285175394358" target="_blank" rel="noreferrer">+62 85175394358</a></li>
                    </ul>
                </div>
                <div>
                    <h4>Tautan Cepat</h4>
                    <ul>
                        <li><a href="#profil-magang">Profil Magang</a></li>
                        <li><a href="{{ route('login.index') }}">Pendaftaran</a></li>
                        <li><a href="#faq">FAQ</a></li>
                        <li><a href="#kontak-bantuan">Kontak & Bantuan</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <span>© 2025 DPRD Kabupaten Banyumas. All rights reserved.</span>
                <div class="footer-bottom-links">
                    <a href="#">Kebijakan Privasi</a>
                    <a href="#">Syarat & Ketentuan</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        (function () {
            const navbar = document.getElementById('siteNavbar');
            const mobileToggle = document.getElementById('mobileToggle');
            const mobileMenu = document.getElementById('mobileMenu');
            const timelineWrap = document.getElementById('timelineWrap');
            const timelineProgress = document.getElementById('timelineProgress');

            function updateNavbar() {
                const scrollY = window.scrollY;
                const showThreshold = window.innerHeight * 0.45;

                if (scrollY <= 20) {
                    navbar.classList.remove('is-hidden', 'is-scrolled');
                } else if (scrollY > showThreshold) {
                    navbar.classList.remove('is-hidden');
                    navbar.classList.add('is-scrolled');
                } else {
                    navbar.classList.add('is-hidden');
                    navbar.classList.remove('is-scrolled');
                }
            }

            function updateTimeline() {
                if (!timelineWrap || !timelineProgress) return;
                const rect = timelineWrap.getBoundingClientRect();
                const visible = window.innerHeight - rect.top;
                const percent = Math.max(0, Math.min(1, visible / rect.height));
                timelineProgress.style.height = (percent * 100) + '%';
            }

            window.addEventListener('scroll', function () {
                updateNavbar();
                updateTimeline();
            }, { passive: true });

            mobileToggle.addEventListener('click', function () {
                const isOpen = mobileMenu.classList.toggle('is-open');
                mobileToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
                mobileToggle.querySelector('.menu-icon').style.display = isOpen ? 'none' : 'block';
                mobileToggle.querySelector('.close-icon').style.display = isOpen ? 'block' : 'none';
            });

            mobileMenu.querySelectorAll('a').forEach(function (link) {
                link.addEventListener('click', function () {
                    mobileMenu.classList.remove('is-open');
                    mobileToggle.setAttribute('aria-expanded', 'false');
                    mobileToggle.querySelector('.menu-icon').style.display = 'block';
                    mobileToggle.querySelector('.close-icon').style.display = 'none';
                });
            });

            document.querySelectorAll('.faq-question').forEach(function (button) {
                button.addEventListener('click', function () {
                    const item = button.closest('.faq-item');
                    const isOpen = item.classList.toggle('is-open');
                    button.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
                });
            });

            updateNavbar();
            updateTimeline();
        })();
    </script>
</body>
</html>
