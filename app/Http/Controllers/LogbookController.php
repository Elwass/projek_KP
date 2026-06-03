<?php

namespace App\Http\Controllers;

use App\Models\Logbook;
use App\Models\Pendaftar;
use App\Models\Peserta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class LogbookController extends Controller
{
    public function index()
    {
        $logbooks = Logbook::where('id_user', auth()->user()->id)
            ->orderBy('tanggal', 'DESC')
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('peserta.logbook.index', [
            'title' => 'Logbook Magang',
            'active' => 'logbook',
            'logbooks' => $logbooks,
        ]);
    }

    public function tambah(Request $request)
    {
        if (! $this->pesertaDiterima()) {
            return redirect(route('peserta.logbook.index'))->with('error', 'Logbook hanya dapat dibuat oleh peserta PKL yang sudah diterima.');
        }

        if ($request->isMethod('POST')) {
            $validatedData = $this->validasi($request);

            if ($request->file('bukti_kegiatan')) {
                $validatedData['bukti_kegiatan'] = $request->file('bukti_kegiatan')->store('bukti_kegiatan', 'public');
            }

            $validatedData['id_user'] = auth()->user()->id;
            $validatedData['status'] = 'pending';

            Logbook::create($validatedData);

            return redirect(route('peserta.logbook.index'))->with('success', 'Logbook magang berhasil dibuat');
        }

        return view('peserta.logbook.tambah', [
            'title' => 'Tambah Logbook Magang',
            'active' => 'logbook',
        ]);
    }

    public function edit(Request $request, $id)
    {
        $logbook = $this->ambilLogbookPeserta($id);
        if ($logbook->status == 'disetujui') {
            return redirect(route('peserta.logbook.detail', $logbook->id))->with('error', 'Logbook yang sudah disetujui tidak dapat diubah.');
        }

        if ($request->isMethod('POST')) {
            $validatedData = $this->validasi($request);

            if ($request->file('bukti_kegiatan')) {
                if ($logbook->bukti_kegiatan) {
                    Storage::disk('public')->delete($logbook->bukti_kegiatan);
                    Storage::delete($logbook->bukti_kegiatan);
                }
                $validatedData['bukti_kegiatan'] = $request->file('bukti_kegiatan')->store('bukti_kegiatan', 'public');
            }

            $validatedData['status'] = 'pending';
            $validatedData['catatan_pembimbing'] = null;
            Logbook::where('id', $logbook->id)->update($validatedData);

            return redirect(route('peserta.logbook.index'))->with('success', 'Logbook magang berhasil diubah');
        }

        return view('peserta.logbook.edit', [
            'title' => 'Edit Logbook Magang',
            'active' => 'logbook',
            'logbook' => $logbook,
        ]);
    }

    public function detail($id)
    {
        $logbook = $this->ambilLogbookPeserta($id);

        return view('peserta.logbook.detail', [
            'title' => 'Detail Logbook Magang',
            'active' => 'logbook',
            'logbook' => $logbook,
        ]);
    }

    public function hapus(Request $request)
    {
        $logbook = $this->ambilLogbookPeserta($request['id']);
        if ($logbook->status == 'disetujui') {
            return redirect(route('peserta.logbook.index'))->with('error', 'Logbook yang sudah disetujui tidak dapat dihapus.');
        }

        if ($logbook->bukti_kegiatan) {
            Storage::disk('public')->delete($logbook->bukti_kegiatan);
            Storage::delete($logbook->bukti_kegiatan);
        }
        Logbook::where('id', $logbook->id)->delete();

        return redirect(route('peserta.logbook.index'))->with('success', 'Logbook magang berhasil dihapus');
    }

    private function validasi(Request $request)
    {
        return $request->validate([
            'tanggal' => 'required|date',
            'judul_kegiatan' => 'required|max:255',
            'deskripsi_kegiatan' => 'required',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'lokasi' => 'nullable|max:255',
            'bukti_kegiatan' => 'nullable|mimes:jpg,jpeg,png,pdf|max:10000',
        ]);
    }

    private function ambilLogbookPeserta($id)
    {
        $logbook = Logbook::where('id', $id)
            ->where('id_user', auth()->user()->id)
            ->first();

        abort_if($logbook === null, 404);

        return $logbook;
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
