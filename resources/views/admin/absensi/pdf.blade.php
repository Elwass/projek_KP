<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Absensi Scan Wajah</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        h2 { margin-bottom: 4px; }
        .meta { margin-bottom: 16px; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #333; padding: 6px; text-align: left; }
        th { background: #f0f0f0; }
        .text-center { text-align: center; }
    </style>
</head>
<body>
    <h2>Laporan Absensi Scan Wajah</h2>
    <div class="meta">Tanggal: {{ $tanggal ?: 'Semua tanggal' }}</div>
    <table>
        <thead>
            <tr>
                <th>Nama Peserta</th>
                <th>Jurusan</th>
                <th>Universitas</th>
                <th>Waktu Absen</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($absensis as $absensi)
                <tr>
                    <td>{{ $absensi->nama_peserta }}</td>
                    <td>{{ $absensi->jurusan ?? '-' }}</td>
                    <td>{{ $absensi->universitas ?? '-' }}</td>
                    <td>{{ $absensi->tanggal_waktu }}</td>
                    <td>{{ $absensi->status_absen }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Tidak ada data absensi.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
