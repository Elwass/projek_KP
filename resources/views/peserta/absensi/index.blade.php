@extends('base')

@section('header')
    <link rel="stylesheet" href="{{ asset('assets/AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/AdminLTE/plugins/toastr/toastr.min.css') }}">
    <style>
        #video-absensi, #preview-foto {
            width: 100%;
            max-height: 360px;
            object-fit: cover;
            border: 1px solid #dee2e6;
            border-radius: .25rem;
            background: #000;
        }
    </style>
@endsection

@section('sidebar')
    @include('peserta.sidebar')
@endsection

@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"><h1 class="m-0">Absensi Scan Wajah</h1></div>
                <div class="col-sm-6"><ol class="breadcrumb float-sm-right"><li class="breadcrumb-item"><a href="{{ route('peserta.index') }}">Home</a></li><li class="breadcrumb-item active">Absensi Scan Wajah</li></ol></div>
            </div>
        </div>
    </div>
@endsection

@section('main-content')
    <div class="row">
        <div class="col-md-5">
            <div class="card card-primary card-outline">
                <div class="card-header"><h3 class="card-title">Scan Wajah dan Lokasi</h3></div>
                <div class="card-body">
                    <form action="{{ route('peserta.absensi.store') }}" method="POST" id="form-absensi">
                        @csrf
                        <input type="hidden" name="foto_wajah" id="foto_wajah">
                        <input type="hidden" name="latitude" id="latitude">
                        <input type="hidden" name="longitude" id="longitude">
                        <input type="hidden" name="alamat" id="alamat">
                        <input type="hidden" name="face_detected" id="face_detected" value="0">
                        <input type="hidden" name="status_absen" id="status_absen" value="hadir">

                        <div class="mb-3">
                            <video id="video-absensi" autoplay muted playsinline></video>
                            <canvas id="canvas-absensi" class="d-none"></canvas>
                            <img id="preview-foto" class="d-none mt-2" alt="Preview foto wajah">
                        </div>
                        <div class="mb-3">
                            <button type="button" class="btn btn-primary" id="btn-kamera"><i class="fas fa-video"></i> Mulai Kamera</button>
                            <button type="button" class="btn btn-info" id="btn-lokasi"><i class="fas fa-map-marker-alt"></i> Ambil Lokasi</button>
                            <button type="button" class="btn btn-warning" id="btn-capture" disabled><i class="fas fa-camera"></i> Scan & Capture</button>
                        </div>
                        <div class="alert alert-info" id="status-scan">Mulai kamera dan ambil lokasi sebelum menyimpan absensi.</div>

                        <div class="mb-3">
                            <label>Waktu Perangkat</label>
                            <input type="text" class="form-control" id="waktu-preview" readonly>
                        </div>
                        <div class="row">
                            <div class="col-md-6"><div class="mb-3"><label>Latitude</label><input type="text" class="form-control" id="latitude-preview" readonly></div></div>
                            <div class="col-md-6"><div class="mb-3"><label>Longitude</label><input type="text" class="form-control" id="longitude-preview" readonly></div></div>
                        </div>
                        <div class="mb-3">
                            <label>Alamat</label>
                            <textarea class="form-control" id="alamat-preview" rows="3" readonly></textarea>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <button type="submit" class="btn btn-success" id="btn-simpan" disabled>Simpan Absensi</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="card card-primary card-outline">
                <div class="card-header"><h3 class="card-title">Riwayat Absensi Saya</h3></div>
                <div class="card-body">
                    <table id="tabel-absensi" class="table table-bordered table-hover">
                        <thead><tr><th>No</th><th>Waktu</th><th>Lokasi</th><th>Status</th><th>Foto</th></tr></thead>
                        <tbody>
                            @foreach ($absensis as $absensi)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $absensi->tanggal_waktu }}</td>
                                    <td>{{ $absensi->alamat }}</td>
                                    <td class="text-center">@include('absensi.status', ['status' => $absensi->status_absen])</td>
                                    <td class="text-center"><a href="{{ asset('storage/'.$absensi->foto_wajah) }}" target="_blank" class="btn btn-sm btn-warning"><i class="fas fa-image"></i></a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/AdminLTE/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/AdminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/AdminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/AdminLTE/plugins/toastr/toastr.min.js') }}"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/face-api.js@0.22.2/dist/face-api.min.js"></script>
    <script>
        $(function () {
            $('#tabel-absensi').DataTable({"paging": true,"lengthChange": true,"searching": true,"ordering": true,"info": true,"autoWidth": false,"responsive": true});
        });

        const video = document.getElementById('video-absensi');
        const canvas = document.getElementById('canvas-absensi');
        const previewFoto = document.getElementById('preview-foto');
        const statusScan = document.getElementById('status-scan');
        const btnKamera = document.getElementById('btn-kamera');
        const btnLokasi = document.getElementById('btn-lokasi');
        const btnCapture = document.getElementById('btn-capture');
        const btnSimpan = document.getElementById('btn-simpan');
        const waktuPreview = document.getElementById('waktu-preview');
        let kameraAktif = false;
        let lokasiAktif = false;
        let modelWajahSiap = false;

        function updateWaktu() {
            waktuPreview.value = new Date().toLocaleString('id-ID');
        }
        updateWaktu();
        setInterval(updateWaktu, 1000);

        window.addEventListener('load', async function () {
            if (typeof faceapi === 'undefined') {
                statusScan.className = 'alert alert-warning';
                statusScan.textContent = 'Library face-api.js belum termuat. Periksa koneksi internet/browser.';
                return;
            }

            try {
                await faceapi.nets.tinyFaceDetector.loadFromUri('https://cdn.jsdelivr.net/gh/justadudewhohacks/face-api.js@master/weights');
                modelWajahSiap = true;
            } catch (error) {
                statusScan.className = 'alert alert-warning';
                statusScan.textContent = 'Model deteksi wajah gagal dimuat. Periksa koneksi internet lalu refresh halaman.';
            }
        });

        btnKamera.addEventListener('click', async function () {
            try {
                const stream = await navigator.mediaDevices.getUserMedia({ video: { facingMode: 'user' }, audio: false });
                video.srcObject = stream;
                kameraAktif = true;
                btnCapture.disabled = !lokasiAktif;
                statusScan.className = 'alert alert-info';
                statusScan.textContent = 'Kamera aktif. Pastikan wajah terlihat jelas, lalu lakukan scan.';
            } catch (error) {
                statusScan.className = 'alert alert-danger';
                statusScan.textContent = 'Kamera tidak dapat diakses. Berikan izin kamera pada browser.';
            }
        });

        btnLokasi.addEventListener('click', function () {
            if (! navigator.geolocation) {
                statusScan.className = 'alert alert-danger';
                statusScan.textContent = 'Browser/perangkat tidak mendukung GPS.';
                return;
            }

            statusScan.className = 'alert alert-info';
            statusScan.textContent = 'Mengambil koordinat lokasi...';
            navigator.geolocation.getCurrentPosition(async function (position) {
                const latitude = position.coords.latitude.toFixed(7);
                const longitude = position.coords.longitude.toFixed(7);
                document.getElementById('latitude').value = latitude;
                document.getElementById('longitude').value = longitude;
                document.getElementById('latitude-preview').value = latitude;
                document.getElementById('longitude-preview').value = longitude;

                let alamat = latitude + ', ' + longitude;
                try {
                    const response = await fetch('https://nominatim.openstreetmap.org/reverse?format=json&lat=' + latitude + '&lon=' + longitude + '&zoom=18&addressdetails=1');
                    const data = await response.json();
                    if (data.display_name) {
                        alamat = data.display_name;
                    }
                } catch (error) {
                    alamat = latitude + ', ' + longitude + ' (alamat reverse geocoding tidak tersedia)';
                }

                document.getElementById('alamat').value = alamat;
                document.getElementById('alamat-preview').value = alamat;
                lokasiAktif = true;
                btnCapture.disabled = !kameraAktif;
                statusScan.className = 'alert alert-info';
                statusScan.textContent = 'Lokasi berhasil diambil. Silakan scan wajah.';
            }, function () {
                statusScan.className = 'alert alert-danger';
                statusScan.textContent = 'Lokasi tidak dapat diakses. Berikan izin lokasi/GPS pada browser.';
            }, { enableHighAccuracy: true, timeout: 15000, maximumAge: 0 });
        });

        btnCapture.addEventListener('click', async function () {
            if (! kameraAktif || ! lokasiAktif) {
                statusScan.className = 'alert alert-danger';
                statusScan.textContent = 'Kamera dan lokasi wajib aktif sebelum capture.';
                return;
            }

            if (! modelWajahSiap) {
                statusScan.className = 'alert alert-danger';
                statusScan.textContent = 'Model deteksi wajah belum siap. Tunggu beberapa saat lalu coba lagi.';
                return;
            }

            const detection = await faceapi.detectSingleFace(video, new faceapi.TinyFaceDetectorOptions());
            if (! detection) {
                document.getElementById('face_detected').value = '0';
                btnSimpan.disabled = true;
                statusScan.className = 'alert alert-danger';
                statusScan.textContent = 'Wajah belum terdeteksi. Pastikan wajah terlihat jelas di kamera.';
                return;
            }

            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
            const fotoWajah = canvas.toDataURL('image/png');
            document.getElementById('foto_wajah').value = fotoWajah;
            document.getElementById('face_detected').value = '1';
            previewFoto.src = fotoWajah;
            previewFoto.classList.remove('d-none');
            btnSimpan.disabled = false;
            statusScan.className = 'alert alert-success';
            statusScan.textContent = 'Wajah dan lokasi berhasil divalidasi. Absensi siap disimpan.';
        });
    </script>
    @if (session()->has('success'))
        <script>toastr.success('{{ session('success') }}');</script>
    @endif
    @if (session()->has('error'))
        <script>toastr.error('{{ session('error') }}');</script>
    @endif
@endsection
