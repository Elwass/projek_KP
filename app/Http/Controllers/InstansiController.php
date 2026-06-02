<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\Instansi;
use App\Models\Peserta;
use App\Models\User;
use Illuminate\Http\Request;

class InstansiController extends Controller
{
    public function index()
    {
        $instansis = Instansi::all();

        if (count($instansis) == 0) {
            $jumlah_peserta = 0;
            $status = 0;
        } else {
            foreach ($instansis as $instansi) {
                $jumlah_peserta[$instansi->id] = Peserta::join('pendaftars', 'pendaftars.id', '=', 'pesertas.id_pendaftar')
                                                    ->where('id_instansi', $instansi->id)
                                                    ->count();

                $belum_dimulai = Peserta::where('id_instansi', $instansi->id)
                                    ->where('status', 'belum dimulai')
                                    ->count();
                $berlangsung = Peserta::where('id_instansi', $instansi->id)
                                ->where('status', 'berlangsung')
                                ->count();
                if ($belum_dimulai == 0 && $berlangsung == 0) {
                    $status[$instansi->id] = 'Selesai';
                } else {
                    $status[$instansi->id] = 'Berlangsung';
                }
            }
        }

        return view('admin.instansi.index', [
            'title' => 'Data Instansi',
            'active' => 'instansi',
            'instansis' => $instansis,
            'jumlah_peserta' => $jumlah_peserta,
            'status' => $status,
        ]);
    }
    
    public function tambah(Request $request)
    {
        if ($request->isMethod('POST')){
            $validatedData = $request->validate([
                'nama' => 'required|max:255',
                'alamat' => 'required|max:255',
            ]);

            Instansi::create($validatedData);
            History::create([
                'user' => auth()->user()->name,
                'aktivitas' => 'Menambah data instansi '.$request['nama'],
                // 'tanggal' => date('Y-m-d H:i:s'),
            ]);
            return redirect(route('admin.instansi.index'))->with('success', 'Data instansi berhasil dibuat');
        }

        return view('admin.instansi.tambah', [
            'title' => 'Tambah Data Instansi',
            'active' => 'instansi',
        ]);
    }
    
    public function edit(Request $request, $id)
    {
        $instansi = Instansi::where('id', $id)->first();

        if ($request->isMethod('POST')){
            $validatedData = $request->validate([
                'nama' => 'required|max:255',
                'alamat' => 'required|max:255',
            ]);

            Instansi::where('id',$id)->update($validatedData);
            History::create([
                'user' => auth()->user()->name,
                'aktivitas' => 'Merubah data instansi '.$request['nama'],
            ]);
            return redirect(route('admin.instansi.index'))->with('success', 'Data instansi berhasil diubah');
        }

        return view('admin.instansi.edit', [
            'title' => 'Edit Data Instansi',
            'active' => 'instansi',
            'instansi' => $instansi,
        ]);
    }
    
    public function detail($id)
    {
        $instansi = Instansi::where('id',$id)->first();
        $pesertas = User::join('pendaftars', 'users.id', '=', 'pendaftars.id_user')
            ->join('pesertas', 'pendaftars.id', '=', 'pesertas.id_pendaftar')
            ->where('pesertas.id_instansi', $instansi->id)
            ->get(array(
                '*',
                'pesertas.status AS status_peserta',
                'pesertas.id AS id_peserta',
            ));

        return view('admin.instansi.detail', [
            'title' => 'Detail Data Instansi',
            'active' => 'instansi',
            'instansi' => $instansi,
            'pesertas' => $pesertas,
        ]);
    }

    public function hapus(Request $request)
    {
        Instansi::where('id', $request['id'])->delete();
        History::create([
            'user' => auth()->user()->name,
            'aktivitas' => 'Menghapus data instansi '.$request['nama'],
        ]);

        return redirect(route('admin.instansi.index'))->with('success', 'Data instansi berhasil dihapus');
    }
}
