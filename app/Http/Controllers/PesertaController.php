<?php

namespace App\Http\Controllers;

use App\Models\Pendaftar;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PesertaController extends Controller
{
    public function index()
    {
        return view('peserta.index', [
            'title' => 'Dashboard',
            'active' => 'index',
        ]);
    }
    
    public function daftar(Request $request)
    {
        $user = auth()->user();
        $pendaftar = $user->pendaftar()
            ->with(['user', 'pendamping'])
            ->first();
        $namaPeserta = $this->namaPeserta($user, $pendaftar);
        $pendamping = $pendaftar ? $pendaftar->pendamping : null;
        if ($pendaftar === null) {
            if ($request->isMethod('POST')){
                self::daftar_baru($request);
                return redirect(route('peserta.daftar'))->with('success', 'Pendaftaran berhasil!');
            }
            return view('peserta.daftar', [
                'title' => 'Pendaftaran',
                'active' => 'daftar',
                'user' => $user,
                'namaPeserta' => $namaPeserta,
                'pendamping' => $pendamping,
            ]);
        }
        else {
            if ($pendaftar['status'] == 'daftar') {
                if ($request->isMethod('POST')){
                    self::ubah($request, $pendaftar);
                    return redirect(route('peserta.daftar'))->with('success', 'Perubahan telah disimpan');
                }
                return view('peserta.ubah', [
                    'title' => 'Pendaftaran',
                    'active' => 'daftar',
                    'user' => $user,
                    'pendaftar' => $pendaftar,
                    'namaPeserta' => $namaPeserta,
                    'pendamping' => $pendamping,
                ]);
            }
            elseif ($pendaftar['status'] == 'diterima') {
                return view('peserta.diterima', [
                    'title' => 'Pendaftaran',
                    'active' => 'daftar',
                    'user' => $user,
                    'pendaftar' => $pendaftar,
                    'namaPeserta' => $namaPeserta,
                    'pendamping' => $pendamping,
                ]);
            }
            elseif ($pendaftar['status'] == 'ditolak'){
                return view('peserta.ditolak', [
                    'title' => 'Pendaftaran',
                    'active' => 'daftar',
                    'user' => $user,
                    'pendaftar' => $pendaftar,
                    'namaPeserta' => $namaPeserta,
                    'pendamping' => $pendamping,
                ]);
            }
        }

        
    }
    

    private function namaPeserta($user, $pendaftar = null)
    {
        if ($pendaftar && $pendaftar->user && $pendaftar->user->name) {
            return $pendaftar->user->name;
        }

        if ($user && $user->name) {
            return $user->name;
        }

        if ($user && $user->username) {
            return $user->username;
        }

        return 'Peserta';
    }
    public static function daftar_baru($request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|max:255',
            'email' => 'required|email:dns',
            'tempat_lahir' => 'required|max:255',
            'tgl_lahir' => 'required',
            'alamat' => 'required|max:255',
            'agama' => 'required|max:255',
            'jk' => 'required|max:255',
            'no_ktp' => 'required|max:255',
            'no_telp' => 'required|max:255',
            'nim' => 'required|max:255',
            'univ' => 'required|max:255',
            'jurusan' => 'required|max:255',
            'tgl_mulai' => 'required',
            'tgl_selesai' => 'required',
            'cv' => 'required|mimes:pdf,doc,docx|max:10000',
            'pengajuan' => 'required|mimes:pdf,doc,docx|max:10000',
            'foto' => 'required|image|mimes:jpg,png,jpeg|max:1024',
        ]);
        
        $validatedData['cv'] = $request->file('cv')->store('cv', 'public');
        $validatedData['pengajuan'] = $request->file('pengajuan')->store('pengajuan', 'public');
        $validatedData['foto'] = $request->file('foto')->store('mahasiswa', 'public');

        User::where('id', auth()->user()->id)
            ->update([
                'name' => $validatedData['nama'],
                'tgl_lahir' => $validatedData['tgl_lahir'],
                'tempat_lahir' => $validatedData['tempat_lahir'],
                'alamat' => $validatedData['alamat'],
                'jk' => $validatedData['jk'],
                'agama' => $validatedData['agama'],
                'no_ktp' => $validatedData['no_ktp'],
                'no_telp' => $validatedData['no_telp'],
                'foto' => $validatedData['foto'],
                ]);

        Pendaftar::create([
            'id_user' => auth()->user()->id,
            'universitas' => $validatedData['univ'],
            'nim' => $validatedData['nim'],
            'jurusan' => $validatedData['jurusan'],
            'cv' => $validatedData['cv'],
            'pengajuan' => $validatedData['pengajuan'],
            'tgl_mulai' => $validatedData['tgl_mulai'],
            'tgl_selesai' => $validatedData['tgl_selesai'],
            'tgl_daftar' => date('Y-m-d'),
            'status' => 'daftar',
        ]);
    }

    public static function ubah($request, $pendaftar)
    {
        $validatedData = $request->validate([
            'nama' => 'required|max:255',
            'email' => 'required|email:dns',
            'tempat_lahir' => 'required|max:255',
            'tgl_lahir' => 'required',
            'alamat' => 'required|max:255',
            'agama' => 'required|max:255',
            'jk' => 'required|max:255',
            'no_ktp' => 'required|max:255',
            'no_telp' => 'required|max:255',
            'nim' => 'required|max:255',
            'univ' => 'required|max:255',
            'jurusan' => 'required|max:255',
            'tgl_mulai' => 'required',
            'tgl_selesai' => 'required',
            'cv' => 'mimes:pdf,doc,docx|max:10000',
            'pengajuan' => 'mimes:pdf,doc,docx|max:10000',
            'foto' => 'image|mimes:jpg,png,jpeg|max:1024',
        ]);

        $fotoLama = auth()->user()->foto;
        if ($request->hasFile('foto')) {
            $validatedData['foto'] = $request->file('foto')->store('mahasiswa', 'public');
        } else {
            $validatedData['foto'] = $fotoLama;
        }

        if ($request->file('cv')) {
            Storage::disk('public')->delete($pendaftar->cv);
            Storage::delete($pendaftar->cv);
            $validatedData['cv'] = $request->file('cv')->store('cv', 'public');
        }else {
            $validatedData['cv'] = $pendaftar->cv;
        }

        if ($request->file('pengajuan')) {
            Storage::disk('public')->delete($pendaftar->pengajuan);
            Storage::delete($pendaftar->pengajuan);
            $validatedData['pengajuan'] = $request->file('pengajuan')->store('pengajuan', 'public');
        }else {
            $validatedData['pengajuan'] = $pendaftar->pengajuan;
        }

        User::where('id', auth()->user()->id)
            ->update([
                'name' => $validatedData['nama'],
                'tgl_lahir' => $validatedData['tgl_lahir'],
                'tempat_lahir' => $validatedData['tempat_lahir'],
                'alamat' => $validatedData['alamat'],
                'jk' => $validatedData['jk'],
                'agama' => $validatedData['agama'],
                'no_ktp' => $validatedData['no_ktp'],
                'no_telp' => $validatedData['no_telp'],
                'foto' => $validatedData['foto'],
            ]);
        
        Pendaftar::where('id', $pendaftar->id)
            -> update([
                'universitas' => $validatedData['univ'],
                'nim' => $validatedData['nim'],
                'jurusan' => $validatedData['jurusan'],
                'cv' => $validatedData['cv'],
                'pengajuan' => $validatedData['pengajuan'],
                'tgl_mulai' => $validatedData['tgl_mulai'],
                'tgl_selesai' => $validatedData['tgl_selesai'],
                'status' => 'daftar',
            ]);

        if ($request->hasFile('foto') && $fotoLama && Storage::disk('public')->exists($fotoLama)) {
            Storage::disk('public')->delete($fotoLama);
        }
    }
    

    public function showBiodata()
    {
        $user = auth()->user();
        $pendaftar = $user->pendaftar()->first();

        return view('peserta.biodata', [
            'title' => 'Biodata Siswa',
            'active' => 'biodata',
            'user' => $user,
            'pendaftar' => $pendaftar,
        ]);
    }

    public function hapus()
    {
        $pendaftar = auth()->user()->pendaftar()->first();

        if ($pendaftar === null) {
            return redirect(route('peserta.daftar'))->with('success', 'Data pendaftaran tidak ditemukan');
        }

        $fotoLama = auth()->user()->foto;
        if ($fotoLama && Storage::disk('public')->exists($fotoLama)) {
            Storage::disk('public')->delete($fotoLama);
        }
        Storage::disk('public')->delete($pendaftar->cv);
        Storage::delete($pendaftar->cv);
        Storage::disk('public')->delete($pendaftar->pengajuan);
        Storage::delete($pendaftar->pengajuan);
        Pendaftar::where('id', $pendaftar->id)->delete();

        User::where('id', auth()->user()->id)
            ->update([
                'tgl_lahir' => null,
                'tempat_lahir' => null,
                'alamat' => null,
                'jk' => null,
                'agama' => null,
                'no_ktp' => null,
                'no_telp' => null,
                'foto' => null,
            ]);

        return redirect(route('peserta.daftar'))->with('success', 'Pendaftaran PKL telah dibatalkan');
    }
}
