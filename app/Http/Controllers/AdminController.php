<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\Instansi;
use App\Models\Pendaftar;
use App\Models\Peserta;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        app('App\Http\Controllers\DataPesertaController')->cek_status();

        $jumlah['pendaftar']=Pendaftar::where('status','daftar')->count();
        $jumlah['peserta']=Peserta::where('status','berlangsung')->count();
        $jumlah['pendamping']=User::where('role','pendamping')->count();
        $jumlah['instansi']=Instansi::count();

        return view('admin.index', [
            'title' => 'Dashboard',
            'active' => 'index',
            'jumlah' => $jumlah,
            'histories' => History::orderBy('created_at', 'DESC')->get(),
        ]);
    }
}
