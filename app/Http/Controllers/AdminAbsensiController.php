<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\User;
use Illuminate\Http\Request;

class AdminAbsensiController extends Controller
{
    public function index(Request $request)
    {
        $query = $this->queryAbsensiSesuaiRole();

        if ($request['tanggal']) {
            $query->whereDate('absensi.tanggal_waktu', $request['tanggal']);
        }

        if ($request['user_id']) {
            $query->where('absensi.user_id', $request['user_id']);
        }

        $absensis = $query->orderBy('absensi.tanggal_waktu', 'DESC')
            ->get(array(
                'absensi.*',
                'users.name AS nama_peserta',
                'pendaftars.nim AS nim',
                'pendamping.name AS nama_pendamping',
            ));

        $pesertas = $this->queryPesertaSesuaiRole()->get(array(
            'users.id AS id',
            'users.name AS name',
            'pendaftars.nim AS nim',
        ));

        return view('admin.absensi.index', [
            'title' => 'Absensi Scan Wajah',
            'active' => 'absensi',
            'absensis' => $absensis,
            'pesertas' => $pesertas,
        ]);
    }

    public function detail($id)
    {
        $absensi = $this->queryAbsensiSesuaiRole()
            ->where('absensi.id', $id)
            ->first(array(
                'absensi.*',
                'users.name AS nama_peserta',
                'users.email AS email_peserta',
                'pendaftars.nim AS nim',
                'pendaftars.universitas AS universitas',
                'pendaftars.jurusan AS jurusan',
                'pendamping.name AS nama_pendamping',
            ));

        abort_if($absensi === null, 404);

        return view('admin.absensi.detail', [
            'title' => 'Detail Absensi Scan Wajah',
            'active' => 'absensi',
            'absensi' => $absensi,
        ]);
    }

    private function queryAbsensiSesuaiRole()
    {
        $query = Absensi::join('users', 'users.id', '=', 'absensi.user_id')
            ->leftJoin('pendaftars', 'pendaftars.id_user', '=', 'users.id')
            ->leftJoin('pesertas', 'pesertas.id_pendaftar', '=', 'pendaftars.id')
            ->leftJoin('users as pendamping', 'pendamping.id', '=', 'pesertas.id_user');

        if (auth()->user()->role != 'admin') {
            $query->where('pesertas.id_user', auth()->user()->id);
        }

        return $query;
    }

    private function queryPesertaSesuaiRole()
    {
        $query = User::join('pendaftars', 'pendaftars.id_user', '=', 'users.id')
            ->join('pesertas', 'pesertas.id_pendaftar', '=', 'pendaftars.id')
            ->where('users.role', 'peserta');

        if (auth()->user()->role != 'admin') {
            $query->where('pesertas.id_user', auth()->user()->id);
        }

        return $query;
    }
}
