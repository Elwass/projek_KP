<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\Instansi;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pendaftar;
use App\Models\Peserta;
use Illuminate\Support\Facades\File;

class PendaftaranController extends Controller
{
    public function index()
    {
        $pendaftar = User::join('pendaftars', 'users.id', '=', 'pendaftars.id_user')
            ->orderBy('pendaftars.created_at', 'DESC')
            ->get();

        return view('admin.pendaftaran.index', [
            'title' => 'Data Pendaftaran Peserta',
            'active' => 'pendaftaran',
            'pendaftars' => $pendaftar,
        ]);
    }
    
    public function detail($id)
    {
        $pendaftar = User::join('pendaftars', 'users.id', '=', 'pendaftars.id_user')
            ->where('pendaftars.id', $id)
            ->first();

        return view('admin.pendaftaran.detail', [
            'title' => 'Detail Data Pendaftaran Peserta',
            'active' => 'pendaftaran',
            'pendaftar' => $pendaftar,
        ]);
    }
    
    public function terima(Request $request, $id)
    {   
        $pendaftar = User::join('pendaftars', 'users.id', '=', 'pendaftars.id_user')
            ->where('pendaftars.id', $id)
            ->first();
        
        $pendampings = User::where('role','pendamping')->get();
        $instansis = Instansi::all();

        if ($request->isMethod('POST')){
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
            ]);

            User::where('id', $pendaftar->id_user)
                ->update([
                    'name' => $validatedData['nama'],
                    'tgl_lahir' => $validatedData['tgl_lahir'],
                    'tempat_lahir' => $validatedData['tempat_lahir'],
                    'alamat' => $validatedData['alamat'],
                    'jk' => $validatedData['jk'],
                    'agama' => $validatedData['agama'],
                    'no_ktp' => $validatedData['no_ktp'],
                    'no_telp' => $validatedData['no_telp'],
                ]);
            
            Pendaftar::where('id', $id)
                -> update([
                    'universitas' => $validatedData['univ'],
                    'nim' => $validatedData['nim'],
                    'jurusan' => $validatedData['jurusan'],
                    'tgl_mulai' => $validatedData['tgl_mulai'],
                    'tgl_selesai' => $validatedData['tgl_selesai'],
                    'status' => 'diterima',
                ]);

            if (date('Y-m-d') < $request['tgl_mulai']) {
                $status = 'belum dimulai';
            }
            elseif (date('Y-m-d') >= $request['tgl_mulai'] && date('Y-m-d') <= $request['tgl_selesai']){
                $status = 'berlangsung';
            }
            else {
                $status = 'selesai';
            }

            Peserta::create([
                'id_pendaftar' => $id,
                'id_user' => $request['pendamping'],
                'id_instansi' => $request['instansi'],
                'status' => $status,
            ]);

            History::create([
                'user' => auth()->user()->name,
                'aktivitas' => 'Menerima pengajuan PKL dari '.$request['nama'],
            ]);

            return redirect(route('admin.pendaftaran.index'))->with('success', 'Pengajuan peserta berhasil diterima');
        }
        

        return view('admin.pendaftaran.terima', [
            'title' => 'Penerimaan Pendaftaran Peserta',
            'active' => 'pendaftaran',
            'pendaftar' => $pendaftar,
            'pendampings' => $pendampings,
            'instansis' => $instansis,
        ]);
    }

    public function tolak(Request $request)
    {
        Pendaftar::where('id', $request['id'])->update(['status' => 'ditolak']);

        History::create([
            'user' => auth()->user()->name,
            'aktivitas' => 'Menolak pengajuan PKL dari '.$request['nama'],
        ]);

        return redirect(route('admin.pendaftaran.index'))->with('success', 'Pengajuan PKL peserta berhasil ditolak');
    }

    public function hapus(Request $request)
    {
        File::delete(public_path('storage').'/'.$request['foto']);
        File::delete(public_path('storage').'/'.$request['cv']);
        File::delete(public_path('storage').'/'.$request['pengajuan']);

        Pendaftar::where('id',$request['id_pendaftar'])->delete();
        
        User::where('id', $request['id_user'])
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
        
        History::create([
            'user' => auth()->user()->name,
            'aktivitas' => 'Menghapus data pendaftar '.$request['nama_user'],
        ]);

        return redirect(route('admin.pendaftaran.index'))->with('success', 'data pendaftar berhasil dihapus');
    }
}
