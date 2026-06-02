<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Peserta;
use App\Models\History;
use Illuminate\Http\Request;

class PenjadwalanController extends Controller
{
    public function index()
    {
        $jadwal = [
            'senin' => [], 
            'selasa' => [], 
            'rabu' => [], 
            'kamis' => [], 
            'jumat' => [],
        ];

        $max = 0;
        foreach ($jadwal as $hari => $value) {
            $jadwal[$hari] = Jadwal::join('pesertas', 'pesertas.id', '=', 'jadwals.id_peserta')
                ->join('pendaftars', 'pendaftars.id', '=', 'pesertas.id_pendaftar')
                ->join('users', 'users.id', '=', 'pendaftars.id_user')
                ->where('jadwal', $hari)
                ->orderBy('users.name', 'ASC')
                ->get(array(
                    'users.name AS nama',
                    'pesertas.id AS id'
                ))->toArray();
            
            if (count($jadwal[$hari]) >= $max) {
                $max = count($jadwal[$hari]);
            }
        }

        return view('admin.penjadwalan.index', [
            'title' => 'Penjadwalan',
            'active' => 'penjadwalan',
            'jadwal' => $jadwal,
            'iterasi' => $max,
            'days' => [['senin','primary'],['selasa','success'],['rabu','danger'],['kamis','warning'],['jumat','info']],
        ]);
    }
    
    public function edit(Request $request)
    {
        $pesertas = Peserta::join('pendaftars', 'pendaftars.id', '=', 'pesertas.id_pendaftar')
            ->join('users', 'users.id', '=', 'pendaftars.id_user')
            ->where('pesertas.status','belum dimulai')
            ->orWhere('pesertas.status','berlangsung')
            ->get(array(
                'pesertas.id AS id',
                'users.name AS nama',
            ));
        
        foreach ($pesertas as $peserta) {
            $jadwals = Jadwal::where('id_peserta', $peserta->id)->get();
            $jadwal_peserta[$peserta->id] = [];
            foreach ($jadwals as $key => $jadwal) {
                array_push($jadwal_peserta[$peserta->id], $jadwal->jadwal);
            }
        }

        if ($request->isMethod('POST')){
            Jadwal::truncate();
            if (isset($request['jadwal'])) {
                foreach ($request['jadwal'] as $id_peserta => $jadwal) {
                    foreach ($jadwal as $hari) {
                        Jadwal::create([
                            'id_peserta' => $id_peserta,
                            'jadwal' => $hari,
                        ]);
                    }
                }
            }

            History::create([
                'user' => auth()->user()->name,
                'aktivitas' => 'Mengubah jadwal peserta PKL',
            ]);
            return redirect(route('admin.penjadwalan.index'))->with('success', 'Penjadwalan peserta PKL berhasil diubah');
        }

        return view('admin.penjadwalan.edit', [
            'title' => 'Edit Penjadwalan',
            'active' => 'penjadwalan',
            'pesertas' => $pesertas,
            'jadwal_peserta' => $jadwal_peserta,
        ]);
    }
}
