<?php

namespace App\Http\Controllers;

use App\Models\Pendaftar;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

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
        $pendaftar = Pendaftar::where('id_user', auth()->user()->id)->first();
        if ($pendaftar === null) {
            if ($request->isMethod('POST')){
                self::daftar_baru($request);
                return redirect(route('peserta.daftar'))->with('success', 'Pendaftaran berhasil!');
            }
            return view('peserta.daftar', [
                'title' => 'Pendaftaran',
                'active' => 'daftar',
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
                    'user' => auth()->user(),
                    'pendaftar' => $pendaftar,
                ]);
            }
            elseif ($pendaftar['status'] == 'diterima') {
                $pendamping = User::join('pendaftars', 'pendaftars.id_user', '=', 'users.id')
                    ->join('pesertas', 'pesertas.id_pendaftar', '=', 'pendaftars.id')
                    ->join('users as pendamping', 'pendamping.id', '=', 'pesertas.id_user')
                    ->where('users.id',auth()->user()->id)
                    ->first(array('pendamping.*'));

                return view('peserta.diterima', [
                'title' => 'Pendaftaran',
                'active' => 'daftar',
                'pendamping' => $pendamping,
                ]);
            }
            elseif ($pendaftar['status'] == 'ditolak'){
                return view('peserta.ditolak', [
                    'title' => 'Pendaftaran',
                    'active' => 'daftar',
                ]);
            }
        }

        
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
            'cv' => 'required|mimes:pdf|max:10000',
            'pengajuan' => 'required|mimes:pdf|max:10000',
            'foto' => 'required|image|file|max:1024',
        ]);
        
        $validatedData['cv'] = $request->file('cv')->store('cv');
        $validatedData['pengajuan'] = $request->file('pengajuan')->store('pengajuan');
        $validatedData['foto'] = $request->file('foto')->store('foto');

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
            'cv' => 'mimes:pdf|max:10000',
            'pengajuan' => 'mimes:pdf|max:10000',
            'foto' => 'image|file|max:1024',
        ]);

        if ($request->file('foto')) {
            File::delete(public_path('storage').'/'.auth()->user()->foto);
            $validatedData['foto'] = $request->file('foto')->store('foto');
        }else {
            $validatedData['foto'] = auth()->user()->foto;
        }

        if ($request->file('cv')) {
            File::delete(public_path('storage').'/'.$pendaftar->cv);
            $validatedData['cv'] = $request->file('cv')->store('cv');
        }else {
            $validatedData['cv'] = $pendaftar->cv;
        }

        if ($request->file('pengajuan')) {
            File::delete(public_path('storage').'/'.$pendaftar->pengajuan);
            $validatedData['pengajuan'] = $request->file('pengajuan')->store('pengajuan');
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
    }
    
    public function hapus()
    {
        $pendaftar = Pendaftar::where('id_user', auth()->user()->id)->first();
        File::delete(public_path('storage').'/'.auth()->user()->foto);
        File::delete(public_path('storage').'/'.$pendaftar->cv);
        File::delete(public_path('storage').'/'.$pendaftar->pengajuan);
        Pendaftar::where('id_user', auth()->user()->id)->delete();

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
