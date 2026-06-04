<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Logbook;
use App\Models\Pendaftar;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function pendaftar($id, $field)
    {
        abort_unless(in_array($field, ['cv', 'pengajuan', 'foto']), 404);

        $pendaftar = Pendaftar::where('id', $id)->firstOrFail();
        abort_unless(auth()->user()->role != 'peserta' || $pendaftar->id_user == auth()->id(), 403);

        return $this->responseFile($pendaftar->{$field}, $field != 'foto');
    }

    public function user($id, $field)
    {
        abort_unless($field == 'foto', 404);

        $user = User::where('id', $id)->firstOrFail();
        abort_unless(auth()->user()->role != 'peserta' || $user->id == auth()->id(), 403);

        return $this->responseFile($user->{$field}, false);
    }

    public function logbook($id)
    {
        $logbook = Logbook::where('id', $id)->firstOrFail();
        abort_unless($this->bolehAksesPeserta($logbook->id_user), 403);

        return $this->responseFile($logbook->bukti_kegiatan, true);
    }

    public function absensi($id)
    {
        $absensi = Absensi::where('id', $id)->firstOrFail();
        abort_unless($this->bolehAksesPeserta($absensi->user_id), 403);

        return $this->responseFile($absensi->foto_wajah, false);
    }

    private function bolehAksesPeserta($userId)
    {
        if (auth()->id() == $userId || auth()->user()->role == 'admin') {
            return true;
        }

        if (auth()->user()->role == 'peserta') {
            return false;
        }

        return Pendaftar::where('id_user', $userId)
            ->whereHas('peserta', function ($query) {
                $query->where('id_user', auth()->id());
            })
            ->exists();
    }

    private function responseFile($path, $download = false)
    {
        $path = $this->normalizePath($path);

        if (! $path) {
            return $download ? abort(404, 'File tidak ditemukan.') : response()->file(public_path('assets/img/default-foto-profile.jpg'));
        }

        if (Storage::disk('public')->exists($path)) {
            return $download ? Storage::disk('public')->download($path) : response()->file(Storage::disk('public')->path($path));
        }

        if (Storage::exists($path)) {
            return $download ? Storage::download($path) : response()->file(Storage::path($path));
        }

        return $download ? abort(404, 'File tidak ditemukan.') : response()->file(public_path('assets/img/default-foto-profile.jpg'));
    }

    private function normalizePath($path)
    {
        if (! $path) {
            return null;
        }

        $path = str_replace('\\', '/', $path);
        $path = preg_replace('#^.*storage/app/public/#', '', $path);
        $path = preg_replace('#^.*storage/app/#', '', $path);
        $path = preg_replace('#^.*public/storage/#', '', $path);
        $path = preg_replace('#^/?storage/#', '', $path);
        $path = preg_replace('#^/?public/#', '', $path);

        return ltrim($path, '/');
    }
}
