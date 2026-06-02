<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Pendaftar;
use App\Models\Peserta;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\ValidationException;

class AbsensiController extends Controller
{
    public function index()
    {
        $absensis = Absensi::where('user_id', auth()->user()->id)
            ->orderBy('tanggal_waktu', 'DESC')
            ->get();

        return view('peserta.absensi.index', [
            'title' => 'Absensi Scan Wajah',
            'active' => 'absensi',
            'absensis' => $absensis,
        ]);
    }

    public function store(Request $request)
    {
        if (! $this->pesertaDiterima()) {
            return redirect(route('peserta.absensi.index'))->with('error', 'Absensi hanya dapat dilakukan oleh peserta PKL yang sudah diterima.');
        }

        $validatedData = $request->validate([
            'foto_wajah' => 'required|string',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'alamat' => 'required|max:1000',
            'status_absen' => 'required|in:hadir,terlambat,izin',
            'face_detected' => 'required|accepted',
        ]);

        $fotoWajah = $this->simpanFotoWajah($validatedData['foto_wajah']);
        $tanggalWaktu = Carbon::now();

        Absensi::create([
            'user_id' => auth()->user()->id,
            'foto_wajah' => $fotoWajah,
            'tanggal_waktu' => $tanggalWaktu,
            'latitude' => $validatedData['latitude'],
            'longitude' => $validatedData['longitude'],
            'alamat' => $validatedData['alamat'],
            'status_absen' => $this->statusAbsen($tanggalWaktu, $validatedData['status_absen']),
        ]);

        return redirect(route('peserta.absensi.index'))->with('success', 'Absensi scan wajah berhasil disimpan');
    }

    private function simpanFotoWajah($fotoWajah)
    {
        if (! preg_match('/^data:image\/(png|jpeg|jpg);base64,/', $fotoWajah, $matches)) {
            throw ValidationException::withMessages([
                'foto_wajah' => 'Format foto wajah tidak valid.',
            ]);
        }

        $fotoWajah = substr($fotoWajah, strpos($fotoWajah, ',') + 1);
        $fotoWajah = base64_decode($fotoWajah);

        if ($fotoWajah === false) {
            throw ValidationException::withMessages([
                'foto_wajah' => 'Foto wajah gagal diproses.',
            ]);
        }

        if (strlen($fotoWajah) > 5 * 1024 * 1024) {
            throw ValidationException::withMessages([
                'foto_wajah' => 'Ukuran foto wajah maksimal 5 MB.',
            ]);
        }

        $folder = 'absensi_wajah/'.date('Y-m-d');
        $namaFile = auth()->user()->id.'_'.time().'.png';
        $path = $folder.'/'.$namaFile;
        $storagePath = storage_path('app/'.$folder);

        if (! File::exists($storagePath)) {
            File::makeDirectory($storagePath, 0755, true);
        }

        File::put(storage_path('app/'.$path), $fotoWajah);

        return $path;
    }

    private function statusAbsen(Carbon $tanggalWaktu, $statusAbsen)
    {
        if ($statusAbsen == 'izin') {
            return 'izin';
        }

        if ($tanggalWaktu->format('H:i') > '08:00') {
            return 'terlambat';
        }

        return 'hadir';
    }

    private function pesertaDiterima()
    {
        $pendaftar = Pendaftar::where('id_user', auth()->user()->id)
            ->where('status', 'diterima')
            ->first();

        if ($pendaftar === null) {
            return false;
        }

        return Peserta::where('id_pendaftar', $pendaftar->id)->exists();
    }
}
