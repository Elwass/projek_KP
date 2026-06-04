<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Informasi Magang Berdampak</title>
    <link rel="icon" href="{{ asset('assets/img/images-removebg-preview.png') }}" type="image/png">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        html { scroll-behavior: smooth; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-white text-gray-900 antialiased">
    @php
        $loginUrl = route('login.index');
        $logoUrl = asset('assets/img/dprd-logo.webp');
        $heroImageUrl = asset('assets/img/hero-bg.jpg');

        $menuItems = [
            ['label' => 'Beranda', 'href' => '#beranda'],
            ['label' => 'Tentang', 'children' => [
                ['label' => 'Profil Magang', 'href' => '#profil-magang'],
                ['label' => 'Alur Magang', 'href' => '#alur-magang'],
                ['label' => 'Syarat & Ketentuan', 'href' => '#syarat-ketentuan'],
            ]],
            ['label' => 'Kegiatan', 'children' => [
                ['label' => 'Absensi', 'href' => $loginUrl],
                ['label' => 'Logbook', 'href' => $loginUrl],
                ['label' => 'Tugas', 'href' => $loginUrl],
            ]],
            ['label' => 'Dashboard', 'href' => $loginUrl],
            ['label' => 'Penilaian', 'children' => [
                ['label' => 'Evaluasi', 'href' => $loginUrl],
                ['label' => 'Feedback', 'href' => $loginUrl],
            ]],
            ['label' => 'Dokumen', 'children' => [
                ['label' => 'Template', 'href' => $loginUrl],
                ['label' => 'Upload', 'href' => $loginUrl],
            ]],
            ['label' => 'AI Assistant', 'children' => [
                ['label' => 'Ringkasan', 'href' => $loginUrl],
                ['label' => 'Laporan Otomatis', 'href' => $loginUrl],
            ], 'highlight' => true],
            ['label' => 'Informasi', 'children' => [
                ['label' => 'Pengumuman', 'href' => '#profil-magang'],
                ['label' => 'FAQ', 'href' => '#faq'],
                ['label' => 'Kontak', 'href' => '#kontak-bantuan'],
            ]],
        ];

        $profilCards = [
            [
                'title' => 'Skema Magang',
                'items' => [
                    'Kegiatan berbasis logbook harian',
                    'Pendampingan oleh mentor instansi',
                    'Evaluasi berkala selama program',
                    'Terintegrasi dengan aktivitas kerja instansi',
                ],
            ],
            [
                'title' => 'Durasi & Pelaksanaan',
                'items' => [
                    'Durasi menyesuaikan kebijakan kampus dan instansi asal mahasiswa',
                    'Waktu/jam kegiatan mengikuti operasional instansi',
                    'Berbasis aktivitas kerja nyata di lingkungan instansi',
                ],
            ],
            [
                'title' => 'Bidang Kegiatan',
                'items' => [
                    'Administrasi pemerintahan',
                    'Sistem informasi dan teknologi',
                    'Pengelolaan data dan dokumentasi',
                    'Hukum dan kebijakan publik',
                    'Keuangan dan pengelolaan anggaran',
                    'Pelayanan publik',
                ],
            ],
            [
                'title' => 'Output Program',
                'items' => [
                    'Laporan kegiatan magang',
                    'Penilaian kinerja dari mentor',
                    'Rekap logbook harian',
                    'Pengalaman kerja profesional',
                ],
            ],
        ];

        $steps = [
            [
                'title' => 'Pendaftaran',
                'items' => ['Mengisi form pendaftaran online', 'Upload berkas (CV, surat pengantar, dll)'],
            ],
            [
                'title' => 'Verifikasi',
                'items' => ['Seleksi administrasi oleh instansi', 'Penyesuaian bidang magang'],
            ],
            [
                'title' => 'Pelaksanaan',
                'items' => ['Kegiatan magang di instansi', 'Pengisian logbook harian', 'Pendampingan mentor'],
            ],
            [
                'title' => 'Evaluasi',
                'items' => ['Penilaian kinerja peserta', 'Review kegiatan oleh mentor'],
            ],
            [
                'title' => 'Selesai',
                'items' => ['Penyusunan laporan akhir', 'Sertifikat magang'],
            ],
        ];

        $faqItems = [
            [
                'question' => 'Siapa saja yang dapat mendaftar program magang ini?',
                'answer' => 'Program ini terbuka bagi mahasiswa aktif yang memenuhi persyaratan administrasi dari kampus dan ketentuan instansi DPRD Banyumas.',
            ],
            [
                'question' => 'Bagaimana alur pendaftaran magang dilakukan?',
                'answer' => 'Pendaftaran dilakukan secara online melalui sistem, dimulai dari registrasi akun, melengkapi data diri, mengunggah berkas, hingga menunggu proses verifikasi.',
            ],
            [
                'question' => 'Dokumen apa saja yang perlu disiapkan?',
                'answer' => 'Dokumen umum yang biasanya dibutuhkan meliputi surat pengantar kampus, CV, transkrip nilai, dan dokumen pendukung lain sesuai ketentuan periode magang.',
            ],
            [
                'question' => 'Bagaimana cara memantau status seleksi?',
                'answer' => 'Status pendaftaran dapat dipantau langsung melalui dashboard akun pada Sistem Informasi Magang setelah proses pengajuan selesai.',
            ],
        ];
    @endphp

    {{-- Navbar --}}
    <header id="landing-navbar" class="fixed top-0 left-0 z-50 w-full border-b border-red-600 bg-white transition-transform duration-300 ease-in-out">
        <div class="flex min-h-[84px] w-full items-center justify-between px-10 py-3 xl:px-16 md:min-h-[92px] md:py-4">
            <a href="#beranda" class="flex items-center gap-3 md:gap-4" aria-label="DPRD Kabupaten Banyumas">
                <img src="{{ $logoUrl }}" alt="Logo DPRD Kab. Banyumas" class="h-12 w-auto object-contain md:h-14">
                <div>
                    <h1 class="font-extrabold leading-tight text-slate-900">DPRD Kabupaten Banyumas</h1>
                    <p class="text-xs text-slate-500">Sistem Informasi Magang Berdampak</p>
                </div>
            </a>

            <nav class="hidden self-stretch items-stretch gap-1 lg:flex" aria-label="Navigasi utama">
                @foreach ($menuItems as $item)
                    @if (isset($item['href']))
                        <a
                            href="{{ $item['href'] }}"
                            class="group relative flex h-full items-center px-3 text-sm font-bold text-gray-800 transition-colors duration-200 after:absolute after:left-0 after:bottom-0 after:h-[2px] after:w-0 after:bg-red-600 after:transition-all after:duration-200 after:content-[''] hover:text-red-700 hover:after:w-full {{ $loop->first ? 'text-red-600 after:w-full' : '' }}"
                        >
                            {{ $item['label'] }}
                        </a>
                    @else
                        <div class="group relative flex h-full items-center">
                            <button
                                type="button"
                                class="relative flex h-full items-center gap-1 px-3 text-sm font-bold text-gray-800 transition-colors duration-200 after:absolute after:left-0 after:bottom-0 after:h-[2px] after:w-0 after:bg-red-600 after:transition-all after:duration-200 after:content-[''] hover:text-red-700 group-hover:after:w-full"
                            >
                                {{ $item['label'] }}
                                <svg class="h-4 w-4 transition-transform duration-200 group-hover:rotate-180" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path d="M5 8L10 13L15 8" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>

                            <div class="pointer-events-none absolute left-0 top-full z-50 min-w-52 -translate-y-1 bg-white p-2 opacity-0 shadow-md transition-all duration-150 group-hover:pointer-events-auto group-hover:translate-y-0 group-hover:opacity-100">
                                <div class="space-y-1">
                                    @foreach ($item['children'] as $child)
                                        <a href="{{ $child['href'] }}" class="block w-full px-3 py-2 text-left text-sm text-gray-800 transition-colors duration-200 hover:text-red-600">
                                            {{ $child['label'] }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </nav>

            <div class="hidden items-center gap-2 text-slate-700 lg:flex" aria-hidden="true">
                <button type="button" class="p-2 transition-colors hover:text-red-700" aria-label="Bahasa">
                    <svg class="h-[18px] w-[18px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10" />
                        <path d="M2 12h20" />
                        <path d="M12 2a15.3 15.3 0 0 1 0 20" />
                        <path d="M12 2a15.3 15.3 0 0 0 0 20" />
                    </svg>
                </button>
                <button type="button" class="p-2 transition-colors hover:text-red-700" aria-label="Cari">
                    <svg class="h-[18px] w-[18px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8" />
                        <path d="m21 21-4.35-4.35" />
                    </svg>
                </button>
            </div>

            <button id="mobile-menu-button" type="button" class="p-2 lg:hidden" aria-expanded="false" aria-controls="mobile-menu" aria-label="Toggle menu">
                <svg id="mobile-menu-open-icon" class="h-[22px] w-[22px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M4 12h16" />
                    <path d="M4 6h16" />
                    <path d="M4 18h16" />
                </svg>
                <svg id="mobile-menu-close-icon" class="hidden h-[22px] w-[22px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M18 6 6 18" />
                    <path d="m6 6 12 12" />
                </svg>
            </button>
        </div>

        <div id="mobile-menu" class="hidden border-t border-gray-200 bg-white px-4 pb-4 lg:hidden">
            @foreach ($menuItems as $item)
                <div class="py-2">
                    @if (isset($item['href']))
                        <a href="{{ $item['href'] }}" class="block text-sm font-bold text-gray-800">{{ $item['label'] }}</a>
                    @else
                        <p class="text-sm font-bold text-gray-800">{{ $item['label'] }}</p>
                        <div class="space-y-1 pl-3 pt-1 text-sm text-gray-600">
                            @foreach ($item['children'] as $child)
                                <a href="{{ $child['href'] }}" class="block hover:text-red-600">{{ $child['label'] }}</a>
                            @endforeach
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </header>

    <main>
        {{-- Hero --}}
        <section id="beranda" class="relative min-h-[calc(100vh-96px)] bg-cover bg-center bg-no-repeat" style="background-image: url('{{ $heroImageUrl }}');">
            <div class="absolute inset-0 z-0 bg-slate-950/55"></div>

            <div class="relative z-10 flex min-h-[calc(100vh-96px)] w-full items-center px-10 pt-[96px] xl:px-16">
                <div class="max-w-4xl text-white">
                    <p class="mb-3 text-sm font-semibold uppercase tracking-[0.25em] text-red-100">DPRD Kabupaten Banyumas</p>
                    <h1 class="mb-4 text-4xl font-bold leading-tight md:text-6xl">Sistem Informasi Magang Berdampak</h1>
                    <p class="mb-6 text-base leading-7 text-slate-100 md:text-lg">
                        Platform resmi untuk pendaftaran, verifikasi berkas, logbook, monitoring mentor, penilaian, dan laporan akhir program magang DPRD Kabupaten Banyumas.
                    </p>

                    <div class="flex flex-wrap items-center gap-4">
                        <a href="{{ $loginUrl }}" class="bg-red-700 px-6 py-3 font-semibold text-white transition-colors hover:bg-red-800">Masuk Sistem</a>
                        <a href="{{ $loginUrl }}" class="border border-white px-6 py-3 font-semibold text-white transition-colors hover:bg-white/10">Daftar Magang</a>
                    </div>
                </div>
            </div>
        </section>

        {{-- ProfilMagang --}}
        <section id="profil-magang" class="bg-white pt-12 pb-6">
            <div class="mx-auto max-w-6xl px-4">
                <h2 class="text-2xl font-semibold text-gray-900">Profil Program Magang</h2>
                <p class="mt-3 w-full leading-relaxed text-gray-600">
                    Program magang DPRD Banyumas memberikan kesempatan bagi mahasiswa untuk terlibat langsung dalam lingkungan kerja pemerintahan serta mengembangkan kemampuan teknis (hard skills) dan keterampilan profesional (soft skills) secara terstruktur melalui pendampingan mentor, pencatatan logbook harian, serta evaluasi berkala agar proses pembelajaran berjalan optimal dan sesuai kebutuhan instansi.
                </p>

                <div class="mt-8 grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4">
                    @foreach ($profilCards as $card)
                        <article class="rounded-sm border border-gray-200 bg-white p-4">
                            <h3 class="mb-2 text-sm font-semibold text-gray-900">{{ $card['title'] }}</h3>
                            <ol class="list-decimal space-y-1 pl-4 text-sm text-gray-600">
                                @foreach ($card['items'] as $item)
                                    <li>{{ $item }}</li>
                                @endforeach
                            </ol>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- AlurMagang --}}
        <section id="alur-magang" class="bg-white pt-6 pb-12">
            <div class="relative mx-auto max-w-5xl px-4">
                <h2 class="text-center text-2xl font-semibold text-gray-900">Alur Magang</h2>
                <p class="mx-auto mt-2 max-w-2xl text-center text-gray-600">Proses pelaksanaan magang di DPRD Banyumas secara sistematis dan terstruktur</p>

                <div id="timeline-line" class="absolute left-1/2 top-20 hidden h-full w-[2px] -translate-x-1/2 overflow-hidden bg-gray-200 md:block">
                    <div id="timeline-progress" class="w-full bg-red-500 transition-all duration-300" style="height: 0%;"></div>
                </div>
                <div class="absolute left-4 top-20 bottom-0 w-[2px] bg-gray-200 opacity-70 md:hidden"></div>

                <div class="mt-10">
                    @foreach ($steps as $index => $step)
                        @php($isLeft = $index % 2 === 0)
                        <div class="relative mb-16 flex items-center justify-between">
                            <div class="timeline-dot absolute left-4 z-10 h-4 w-4 -translate-x-1/2 scale-75 rounded-full bg-red-500 opacity-30 shadow-[0_0_0_6px_rgba(239,68,68,0.15)] transition-all duration-300 md:left-1/2"></div>

                            <div class="w-full pl-10 md:w-[42%] md:pl-0 md:pr-6 md:text-left">
                                @if ($isLeft)
                                    <span class="mb-1 inline-block rounded-full bg-red-500 px-4 py-1 text-xs text-white shadow-md">Step {{ $index + 1 }}</span>
                                    <div class="relative">
                                        <div class="absolute -inset-2 rounded-xl bg-red-50 opacity-40 blur-xl"></div>
                                        <div class="relative rounded-xl border border-gray-100 bg-white p-5 text-sm shadow-[0_10px_30px_rgba(0,0,0,0.06)] transition-all duration-300 hover:shadow-[0_15px_40px_rgba(0,0,0,0.1)]">
                                            <h3 class="text-base font-semibold text-gray-900">{{ $step['title'] }}</h3>
                                            <ul class="mt-1 list-inside list-disc space-y-1 text-sm text-gray-600">
                                                @foreach ($step['items'] as $item)
                                                    <li>{{ $item }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="hidden w-[42%] md:block">
                                @unless ($isLeft)
                                    <div class="w-full pl-6 text-left">
                                        <span class="mb-1 inline-block rounded-full bg-red-500 px-4 py-1 text-xs text-white shadow-md">Step {{ $index + 1 }}</span>
                                        <div class="relative">
                                            <div class="absolute -inset-2 rounded-xl bg-red-50 opacity-40 blur-xl"></div>
                                            <div class="relative rounded-xl border border-gray-100 bg-white p-5 text-sm shadow-[0_10px_30px_rgba(0,0,0,0.06)] transition-all duration-300 hover:shadow-[0_15px_40px_rgba(0,0,0,0.1)]">
                                                <h3 class="text-base font-semibold text-gray-900">{{ $step['title'] }}</h3>
                                                <ul class="mt-1 list-inside list-disc space-y-1 text-sm text-gray-600">
                                                    @foreach ($step['items'] as $item)
                                                        <li>{{ $item }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @endunless
                            </div>

                            @unless ($isLeft)
                                <div class="w-full pl-10 md:hidden">
                                    <span class="mb-1 inline-block rounded-full bg-red-500 px-4 py-1 text-xs text-white shadow-md">Step {{ $index + 1 }}</span>
                                    <div class="relative">
                                        <div class="absolute -inset-2 rounded-xl bg-red-50 opacity-40 blur-xl"></div>
                                        <div class="relative rounded-xl border border-gray-100 bg-white p-5 text-sm shadow-[0_10px_30px_rgba(0,0,0,0.06)] transition-all duration-300 hover:shadow-[0_15px_40px_rgba(0,0,0,0.1)]">
                                            <h3 class="text-base font-semibold text-gray-900">{{ $step['title'] }}</h3>
                                            <ul class="mt-1 list-inside list-disc space-y-1 text-sm text-gray-600">
                                                @foreach ($step['items'] as $item)
                                                    <li>{{ $item }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endunless
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- SyaratKetentuan --}}
        <section id="syarat-ketentuan" class="bg-gray-50 pt-6 pb-12">
            <div class="mx-auto max-w-5xl px-4">
                <h2 class="text-center text-2xl font-semibold text-gray-900">Syarat & Ketentuan</h2>
                <p class="mx-auto mt-2 max-w-2xl text-center text-gray-600">
                    Ketentuan dan persyaratan yang harus dipenuhi oleh mahasiswa sebelum mengikuti program magang di DPRD Banyumas
                </p>

                <div class="mt-10 grid gap-6 md:grid-cols-3">
                    <div class="rounded-lg border border-gray-200 bg-white p-5 shadow-sm">
                        <h3 class="mb-3 font-semibold text-gray-900">Persyaratan Peserta</h3>
                        <ol class="list-inside list-decimal space-y-2 text-sm text-gray-600">
                            <li>Mahasiswa aktif dari perguruan tinggi</li>
                            <li>Memiliki surat pengantar dari kampus</li>
                            <li>Bersedia mengikuti seluruh rangkaian kegiatan magang</li>
                            <li>Memiliki minat di bidang pemerintahan dan pelayanan publik</li>
                        </ol>
                    </div>

                    <div class="rounded-lg border border-gray-200 bg-white p-5 shadow-sm">
                        <h3 class="mb-3 font-semibold text-gray-900">Ketentuan Umum</h3>
                        <ol class="list-inside list-decimal space-y-2 text-sm text-gray-600">
                            <li>Durasi magang menyesuaikan kebijakan kampus dan instansi</li>
                            <li>Jam kegiatan mengikuti operasional instansi</li>
                            <li>Peserta wajib menjaga etika dan kedisiplinan</li>
                            <li>Wajib mengikuti arahan mentor dan pembimbing</li>
                        </ol>
                    </div>

                    <div class="rounded-lg border border-gray-200 bg-white p-5 shadow-sm">
                        <h3 class="mb-3 font-semibold text-gray-900">Berkas yang Diperlukan</h3>
                        <ol class="list-inside list-decimal space-y-2 text-sm text-gray-600">
                            <li>Curriculum Vitae (CV)</li>
                            <li>Surat pengantar dari kampus</li>
                            <li>Transkrip nilai (opsional)</li>
                            <li>Dokumen pendukung lainnya (jika diperlukan)</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        {{-- FAQSection --}}
        <section id="faq" class="mx-auto max-w-6xl px-4">
            <h2 class="mb-4 text-2xl font-semibold text-gray-900">FAQ Magang Berdampak</h2>

            <div class="rounded-2xl border border-gray-100 bg-white p-5 shadow-md md:p-8">
                <div class="space-y-3">
                    @foreach ($faqItems as $index => $item)
                        <article class="faq-item rounded-xl border border-gray-200 bg-white">
                            <button
                                type="button"
                                class="faq-toggle flex w-full items-center justify-between gap-4 rounded-xl px-4 py-4 text-left text-gray-800 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-red-500 focus-visible:ring-offset-2"
                                aria-expanded="{{ $index === 0 ? 'true' : 'false' }}"
                            >
                                <span class="text-sm font-semibold md:text-base">{{ $item['question'] }}</span>
                                <svg class="faq-chevron h-5 w-5 shrink-0 text-gray-500 transition-transform duration-300 {{ $index === 0 ? 'rotate-180' : 'rotate-0' }}" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path d="M5 8L10 13L15 8" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>

                            <div class="faq-panel grid transition-all duration-300 ease-in-out {{ $index === 0 ? 'grid-rows-[1fr] opacity-100' : 'grid-rows-[0fr] opacity-0' }}">
                                <div class="overflow-hidden">
                                    <p class="px-4 pb-4 text-sm leading-7 text-gray-600">{{ $item['answer'] }}</p>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- KontakBantuanSection --}}
        <section id="kontak-bantuan" class="mx-auto mt-12 max-w-6xl px-4">
            <h2 class="mb-4 text-2xl font-semibold text-gray-900">Kontak & Bantuan</h2>

            <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-md md:p-8">
                <p class="text-sm leading-7 text-gray-600">
                    Pertanyaan seputar Magang Berdampak? Silakan hubungi unit layanan akademik.
                </p>

                <ul class="mt-5 list-disc space-y-3 pl-5 text-sm text-gray-700">
                    <li>
                        <span class="font-semibold">Email:</span>
                        <a href="mailto:sekwan.inter@gmail.com" class="text-gray-600 hover:underline">sekwan.inter@gmail.com</a>
                    </li>
                    <li>
                        <span class="font-semibold">WhatsApp:</span>
                        <a href="https://wa.me/6285175394358" target="_blank" rel="noreferrer" class="text-gray-600 hover:underline">+62 85175394358</a>
                    </li>
                </ul>
            </div>
        </section>
    </main>

    {{-- FooterSection --}}
    <footer class="mt-12 w-full border-t border-gray-200 bg-gray-50">
        <div class="mx-auto max-w-6xl px-4 py-12 md:py-14">
            <div>
                <div class="flex items-center gap-3">
                    <img src="{{ $logoUrl }}" alt="Logo DPRD Kab. Banyumas" class="h-12 w-auto object-contain">
                    <h3 class="text-lg font-semibold text-gray-900">DPRD Kabupaten Banyumas</h3>
                </div>
                <p class="mt-4 max-w-[320px] text-sm leading-7 text-gray-600">
                    Platform informasi dan pendaftaran Magang Berdampak DPRD Kabupaten Banyumas.
                </p>
            </div>

            <div class="mt-10 grid grid-cols-1 gap-10 md:grid-cols-3">
                <div>
                    <h4 class="mb-4 text-sm font-semibold text-gray-900">Kontak</h4>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li><a href="mailto:sekwan.inter@gmail.com" class="hover:text-gray-800 hover:underline">sekwan.inter@gmail.com</a></li>
                        <li><a href="https://wa.me/6285175394358" target="_blank" rel="noreferrer" class="hover:text-gray-800 hover:underline">+62 85175394358</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="mb-4 text-sm font-semibold text-gray-900">Alamat</h4>
                    <p class="text-sm leading-7 text-gray-600">
                        Jl. Kabupaten No.1, Purwokerto, Sokanegara, Kec. Purwokerto Tim., Kabupaten Banyumas, Jawa Tengah 53115
                    </p>
                </div>

                <div>
                    <h4 class="mb-4 text-sm font-semibold text-gray-900">Tautan Cepat</h4>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li><a href="#profil-magang" class="hover:text-gray-800 hover:underline">Profil Magang</a></li>
                        <li><a href="{{ $loginUrl }}" class="hover:text-gray-800 hover:underline">Pendaftaran</a></li>
                        <li><a href="#faq" class="hover:text-gray-800 hover:underline">FAQ</a></li>
                        <li><a href="#kontak-bantuan" class="hover:text-gray-800 hover:underline">Kontak &amp; Bantuan</a></li>
                    </ul>
                </div>
            </div>

            <div class="mt-8 border-t border-gray-200 pt-4">
                <div class="flex flex-col gap-3 text-sm text-gray-500 md:flex-row md:items-center md:justify-between">
                    <p>© 2025 DPRD Kabupaten Banyumas. All rights reserved.</p>
                    <div class="flex gap-4">
                        <a href="#" class="hover:text-gray-700 hover:underline">Kebijakan Privasi</a>
                        <a href="#syarat-ketentuan" class="hover:text-gray-700 hover:underline">Syarat &amp; Ketentuan</a>
                    </div>
                    
                </div>
                
                    
            </div>
           
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const navbar = document.getElementById('landing-navbar');
            const mobileButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');
            const openIcon = document.getElementById('mobile-menu-open-icon');
            const closeIcon = document.getElementById('mobile-menu-close-icon');
            const timelineLine = document.getElementById('timeline-line');
            const timelineProgress = document.getElementById('timeline-progress');
            const timelineDots = document.querySelectorAll('.timeline-dot');

            const setMobileOpen = function (isOpen) {
                mobileButton.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
                mobileMenu.classList.toggle('hidden', !isOpen);
                openIcon.classList.toggle('hidden', isOpen);
                closeIcon.classList.toggle('hidden', !isOpen);
            };

            const handleScroll = function () {
                const scrollY = window.scrollY;
                const showThreshold = window.innerHeight * 0.45;

                if (scrollY <= 20) {
                    navbar.classList.remove('-translate-y-full', 'shadow-sm');
                } else if (scrollY > showThreshold) {
                    navbar.classList.remove('-translate-y-full');
                    navbar.classList.add('shadow-sm');
                } else {
                    navbar.classList.add('-translate-y-full');
                    navbar.classList.remove('shadow-sm');
                }

                if (!timelineLine || !timelineProgress) return;
                const rect = timelineLine.getBoundingClientRect();
                const visible = window.innerHeight - rect.top;
                const percent = Math.max(0, Math.min(1, visible / rect.height));
                timelineProgress.style.height = `${percent * 100}%`;

                timelineDots.forEach(function (dot, index) {
                    const dotThreshold = (index + 1) / Math.max(timelineDots.length, 1) - 0.08;
                    const isActive = percent >= dotThreshold;
                    dot.classList.toggle('scale-100', isActive);
                    dot.classList.toggle('opacity-100', isActive);
                    dot.classList.toggle('scale-75', !isActive);
                    dot.classList.toggle('opacity-30', !isActive);
                });
            };

            mobileButton.addEventListener('click', function () {
                setMobileOpen(mobileMenu.classList.contains('hidden'));
            });

            mobileMenu.querySelectorAll('a').forEach(function (link) {
                link.addEventListener('click', function () {
                    setMobileOpen(false);
                });
            });

            document.querySelectorAll('.faq-toggle').forEach(function (button) {
                button.addEventListener('click', function () {
                    const item = button.closest('.faq-item');
                    const panel = item.querySelector('.faq-panel');
                    const chevron = item.querySelector('.faq-chevron');
                    const isOpen = button.getAttribute('aria-expanded') === 'true';

                    button.setAttribute('aria-expanded', isOpen ? 'false' : 'true');
                    panel.classList.toggle('grid-rows-[1fr]', !isOpen);
                    panel.classList.toggle('opacity-100', !isOpen);
                    panel.classList.toggle('grid-rows-[0fr]', isOpen);
                    panel.classList.toggle('opacity-0', isOpen);
                    chevron.classList.toggle('rotate-180', !isOpen);
                    chevron.classList.toggle('rotate-0', isOpen);
                });
            });

            window.addEventListener('scroll', handleScroll, { passive: true });
            handleScroll();
        });
    </script>
</body>
</html>
