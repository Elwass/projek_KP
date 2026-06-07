# Sistem Informasi Praktek Kerja Lapangan

Sistem Informasi Praktek Kerja Lapangan (PKL) adalah aplikasi berbasis web untuk
mengelola proses pendaftaran, pendataan peserta, instansi, logbook, absensi scan
wajah, serta laporan absensi pada Kantor Sekretariat DPRD Kabupaten Banyumas.

## Dokumentasi Teknologi

| Komponen | Teknologi | Keterangan |
| --- | --- | --- |
| Backend | Laravel 10.50.2 | Mengelola route, controller, model, middleware, validasi, autentikasi, otorisasi role, dan proses bisnis aplikasi. |
| Bahasa pemrograman | PHP 8.2 | Bahasa utama pada sisi server sesuai konfigurasi dependency proyek melalui Composer. |
| Database | MySQL/MariaDB | Menyimpan data pengguna, pendaftaran, peserta, instansi, logbook, absensi, serta data pendukung lainnya. |
| Frontend | Blade, Bootstrap, AdminLTE, JavaScript | Membangun tampilan halaman publik, dashboard admin, dashboard peserta, form, tabel, dan interaksi pengguna. |
| Template dashboard | AdminLTE | Menyediakan struktur layout dashboard, sidebar, navbar, card, form, tabel, dan komponen UI berbasis Bootstrap. |
| Tabel interaktif | DataTables | Mendukung pencarian, paging, pengurutan, tampilan responsif, dan pengelolaan data dalam tabel. |
| Notifikasi | Toastr | Menampilkan pesan sukses, gagal, atau informasi proses pada halaman login, pendaftaran, data peserta, logbook, instansi, dan absensi. |
| Absensi | face-api.js, MediaDevices API, Geolocation API | Mendeteksi wajah peserta, mengakses kamera, mengambil foto wajah, membaca koordinat latitude-longitude, dan menyimpan alamat lokasi absensi. |
| Reverse geocoding | Nominatim OpenStreetMap API | Mengubah koordinat lokasi menjadi alamat yang lebih mudah dibaca pengguna. |
| Laporan | PDF export | Menyediakan rekap absensi dalam bentuk file PDF melalui controller aplikasi. |
| Dependency backend | Composer | Mengelola package PHP seperti Laravel Framework, Laravel Sanctum, Guzzle, dan dependency pengembangan. |
| Dependency frontend | NPM dan Laravel Mix | Mengelola asset frontend dan proses build JavaScript/CSS. |
| Pengujian | PHPUnit | Menyediakan kerangka pengujian unit dan feature test Laravel. |

## Kebutuhan Sistem

- PHP 8.2 atau versi kompatibel dengan konfigurasi Composer.
- Composer untuk instalasi dependency backend.
- Node.js dan NPM untuk instalasi dependency frontend.
- MySQL atau MariaDB sebagai database.
- Browser modern yang mendukung kamera dan Geolocation API untuk fitur absensi.

## Fitur Utama

- Login dan autentikasi pengguna berdasarkan role.
- Pengelolaan pendaftaran PKL.
- Pengelolaan data peserta dan instansi.
- Pengelolaan logbook kegiatan peserta.
- Absensi peserta menggunakan scan wajah dan lokasi.
- Riwayat absensi peserta.
- Rekap absensi dan export laporan PDF.
