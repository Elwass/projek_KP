<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\Logbook;
use Illuminate\Http\Request;

class AdminLogbookController extends Controller
{
    public function index()
    {
        $logbooks = $this->queryLogbookSesuaiRole()
            ->orderBy('logbooks.tanggal', 'DESC')
            ->orderBy('logbooks.created_at', 'DESC')
            ->get(array(
                'logbooks.*',
                'users.name AS nama_peserta',
                'pendaftars.nim AS nim',
                'pendamping.name AS nama_pendamping',
            ));

        return view('admin.logbook.index', [
            'title' => 'Logbook Magang',
            'active' => 'logbook',
            'logbooks' => $logbooks,
        ]);
    }

    public function detail($id)
    {
        $logbook = $this->ambilLogbookSesuaiRole($id);

        return view('admin.logbook.detail', [
            'title' => 'Detail Logbook Magang',
            'active' => 'logbook',
            'logbook' => $logbook,
        ]);
    }

    public function status(Request $request, $id)
    {
        $logbook = $this->ambilLogbookSesuaiRole($id);
        $validatedData = $request->validate([
            'status' => 'required|in:disetujui,revisi,ditolak',
            'catatan_pembimbing' => 'required_if:status,revisi|required_if:status,ditolak',
        ]);

        Logbook::where('id', $logbook->id)->update([
            'status' => $validatedData['status'],
            'catatan_pembimbing' => $validatedData['catatan_pembimbing'],
        ]);

        History::create([
            'user' => auth()->user()->name,
            'aktivitas' => 'Memperbarui status logbook '.$logbook->judul_kegiatan.' menjadi '.$validatedData['status'],
        ]);

        return redirect(route('admin.logbook.detail', $logbook->id))->with('success', 'Status logbook berhasil diperbarui');
    }

    private function queryLogbookSesuaiRole()
    {
        $query = Logbook::join('users', 'users.id', '=', 'logbooks.id_user')
            ->leftJoin('pendaftars', 'pendaftars.id_user', '=', 'users.id')
            ->leftJoin('pesertas', 'pesertas.id_pendaftar', '=', 'pendaftars.id')
            ->leftJoin('users as pendamping', 'pendamping.id', '=', 'pesertas.id_user');

        if (auth()->user()->role != 'admin') {
            $query->where('pesertas.id_user', auth()->user()->id);
        }

        return $query;
    }

    private function ambilLogbookSesuaiRole($id)
    {
        $logbook = $this->queryLogbookSesuaiRole()
            ->where('logbooks.id', $id)
            ->first(array(
                'logbooks.*',
                'users.name AS nama_peserta',
                'users.email AS email_peserta',
                'pendaftars.nim AS nim',
                'pendaftars.universitas AS universitas',
                'pendaftars.jurusan AS jurusan',
                'pendamping.name AS nama_pendamping',
            ));

        abort_if($logbook === null, 404);

        return $logbook;
    }
}
