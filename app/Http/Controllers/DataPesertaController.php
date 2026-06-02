<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Models\Instansi;
use App\Models\History;
use App\Models\Jadwal;
use App\Models\Pendaftar;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class DataPesertaController extends Controller
{
    public function index()
    {
        $pesertas = Peserta::join('pendaftars', 'pendaftars.id', '=', 'pesertas.id_pendaftar')
            ->join('users', 'users.id', '=', 'pendaftars.id_user')
            ->join('instansis', 'instansis.id', '=', 'pesertas.id_instansi')
            ->orderBy('pendaftars.created_at', 'DESC')
            ->get(array(
                '*',
                'users.name AS nama',
                'instansis.nama AS instansi',
                'pendaftars.tgl_mulai AS tgl_mulai',
                'pendaftars.tgl_selesai AS tgl_selesai',
                'pesertas.status AS status',
                'pesertas.id AS id',
                'users.id AS user',
            ));

        return view('admin.peserta.index', [
            'title' => 'Data Peserta PKL',
            'active' => 'peserta',
            'pesertas' => $pesertas,
        ]);
    }

    public function edit(Request $request, $id)
    {
        $peserta = Peserta::join('pendaftars', 'pendaftars.id', '=', 'pesertas.id_pendaftar')
            ->join('users', 'users.id', '=', 'pendaftars.id_user')
            ->where('pesertas.id', $id)
            ->first(array(
                '*',
                'pesertas.id AS id_peserta',
                'pesertas.id_user AS pendamping',
                'pendaftars.id_user AS user',
                'pesertas.status AS status_peserta',
            ));
        
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
                'pendamping' => 'required|max:255',
                'instansi' => 'required|max:255',
                'cv' => 'mimes:pdf|max:10000',
                'pengajuan' => 'mimes:pdf|max:10000',
                'foto' => 'image|file|max:1024',
            ]);

            if ($request->file('foto')) {
                File::delete(public_path('storage').'/'.$peserta->foto);
                $validatedData['foto'] = $request->file('foto')->store('foto');
            }else {
                $validatedData['foto'] = $peserta->foto;
            }
    
            if ($request->file('cv')) {
                File::delete(public_path('storage').'/'.$peserta->cv);
                $validatedData['cv'] = $request->file('cv')->store('cv');
            }else {
                $validatedData['cv'] = $peserta->cv;
            }
    
            if ($request->file('pengajuan')) {
                File::delete(public_path('storage').'/'.$peserta->pengajuan);
                $validatedData['pengajuan'] = $request->file('pengajuan')->store('pengajuan');
            }else {
                $validatedData['pengajuan'] = $peserta->pengajuan;
            }

            User::where('id', $peserta->user)
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
            
            Pendaftar::where('id', $peserta->id_pendaftar)
                -> update([
                    'universitas' => $validatedData['univ'],
                    'nim' => $validatedData['nim'],
                    'jurusan' => $validatedData['jurusan'],
                    'cv' => $validatedData['cv'],
                    'pengajuan' => $validatedData['pengajuan'],
                    'tgl_mulai' => $validatedData['tgl_mulai'],
                    'tgl_selesai' => $validatedData['tgl_selesai'],
                ]);
            
            if ($peserta->status_peserta == 'berhenti') {
                $status = $peserta->status_peserta;
            } else {
                if (date('Y-m-d') < $request['tgl_mulai']) {
                    $status = 'belum dimulai';
                }
                elseif (date('Y-m-d') >= $request['tgl_mulai'] && date('Y-m-d') <= $request['tgl_selesai']){
                    $status = 'berlangsung';
                }
                else {
                    $status = 'selesai';
                }
            }
            Peserta::where('id', $peserta->id_peserta)
                ->update([
                    'id_user' => $request['pendamping'],
                    'id_instansi' => $request['instansi'],
                    'status' => $status,
                ]);

            History::create([
                'user' => auth()->user()->name,
                'aktivitas' => 'Mengubah data peserta '.$request['nama'],
            ]);

            return redirect(route('admin.peserta.index'))->with('success', 'data peserta berhasil diubah');
        }

        return view('admin.peserta.ubah', [
            'title' => 'Edit Data Peserta PKL',
            'active' => 'peserta',
            'peserta' => $peserta,
            'pendampings' => $pendampings,
            'instansis' => $instansis,
        ]);
    }

    public function detail($id)
    {
        $peserta = Peserta::join('pendaftars', 'pendaftars.id', '=', 'pesertas.id_pendaftar')
            ->join('users', 'users.id', '=', 'pendaftars.id_user')
            ->where('pesertas.id', $id)
            ->first(array(
                '*',
                'pesertas.id AS id_peserta',
                'pesertas.id_user AS pendamping',
                'pendaftars.id_user AS user',
            ));
        
        $jadwal = Jadwal::where('id_peserta',$id)->get('jadwal')->toArray();
        $jadwal = implode(', ',array_column($jadwal,'jadwal'));

        $pendampings = User::where('role','pendamping')->get();
        $instansis = Instansi::all();
        
        return view('admin.peserta.detail', [
            'title' => 'Detail Data Peserta PKL',
            'active' => 'peserta',
            'peserta' => $peserta,
            'pendampings' => $pendampings,
            'instansis' => $instansis,
            'jadwal' => $jadwal,
        ]);
    }

    public function hapus(Request $request)
    {
        File::delete(public_path('storage').'/'.$request['foto']);
        File::delete(public_path('storage').'/'.$request['cv']);
        File::delete(public_path('storage').'/'.$request['pengajuan']);

        Jadwal::where('id_peserta',$request['id'])->delete();
        Peserta::where('id', $request['id'])->delete();
        Pendaftar::where('id',$request['id_pendaftar'])->delete();
        
        User::where('id', $request['user'])
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
            'aktivitas' => 'Menghapus data peserta '.$request['name'],
        ]);

        return redirect(route('admin.peserta.index'))->with('success', 'data peserta berhasil dihapus');
    }

    public function berhenti(Request $request)
    {
        Peserta::where('id',$request['id'])
            ->update([
                'status' => 'berhenti',
            ]);

        History::create([
            'user' => auth()->user()->name,
            'aktivitas' => 'Memberhentikan kegiatan PKL peserta '.$request['name'],
        ]);

        return redirect(route('admin.peserta.index'))->with('success', 'data peserta berhasil diberhentikan');
    }
    
    public function cek_status()
    {
        $pesertas = Peserta::join('pendaftars', 'pendaftars.id', '=', 'pesertas.id_pendaftar')
            ->get(array(
                '*',
                'pesertas.id AS id_peserta',
                'pesertas.status AS status_peserta',
            ));
        
        foreach ($pesertas as $key => $peserta) {
            if ($peserta->status_peserta !== "berhenti" && $peserta->status_peserta !== "selesai") {
                if (date('Y-m-d') >= $peserta->tgl_mulai && date('Y-m-d') <= $peserta->tgl_selesai){
                    Peserta::where('id',$peserta->id_peserta)->update(['status' => 'berlangsung',]);
                }
                elseif (date('Y-m-d') > $peserta->tgl_selesai) {
                    Peserta::where('id',$peserta->id_peserta)->update(['status' => 'selesai',]);
                }
            }
        }
    }
}
