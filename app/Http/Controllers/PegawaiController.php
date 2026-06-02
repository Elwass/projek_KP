<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\History;
use App\Models\Peserta;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\File;

class PegawaiController extends Controller
{
    public function index()
    {
        $pegawais = User::where('role', '!=', 'peserta')->get();
        $jumlah_peserta = [];
        foreach ($pegawais as $pegawai) {
            $jumlah_peserta[$pegawai->id] = Peserta::where('id_user', $pegawai->id)->count();
        }

        return view('admin.pegawai.index', [
            'title' => 'Data Pegawai',
            'active' => 'pegawai',
            'pegawais' => $pegawais,
            'jumlah_peserta' => $jumlah_peserta,
        ]);
    }
    
    public function tambah(Request $request)
    {
        if ($request->isMethod('POST')){
            $validatedData = $request->validate([
                'name' => 'required|max:255',
                'username' => 'required|alpha_dash|min:3|max:255|unique:users',
                'email' => 'required|email:dns|unique:users',
                'password' => 'required|min:5|max:255',
                'tempat_lahir' => 'required|max:255',
                'tgl_lahir' => 'required',
                'alamat' => 'required|max:255',
                'agama' => 'required|max:255',
                'jk' => 'required|max:255',
                'no_ktp' => 'required|max:255',
                'no_telp' => 'required|max:255',
                'role' => 'required|max:255',
                'foto' => 'required|image|file|max:1024',
            ]);

            $validatedData['password'] = Hash::make($validatedData['password']);
            $validatedData['foto'] = $request->file('foto')->store('foto');

            User::create($validatedData);

            History::create([
                'user' => auth()->user()->name,
                'aktivitas' => 'Menambah data pegawai '.$request['name'],
            ]);

            return redirect(route('admin.pegawai.index'))->with('success', 'Data pegawai berhasil dibuat');
        }

        return view('admin.pegawai.tambah', [
            'title' => 'Tambah Data Pegawai',
            'active' => 'pegawai',
        ]);
    }
    
    public function edit(Request $request, $id)
    {
        $pegawai = User::where('id', $id)->first();

        if ($request->isMethod('POST')){
            $validatedData = $request->validate([
                'name' => 'required|max:255',
                'username' => 'required|alpha_dash|min:3|max:255|unique:users,username,'.$pegawai->id,
                'email' => 'required|email:dns|unique:users,email,'.$pegawai->id,
                'tempat_lahir' => 'required|max:255',
                'tgl_lahir' => 'required',
                'alamat' => 'required|max:255',
                'agama' => 'required|max:255',
                'jk' => 'required|max:255',
                'no_ktp' => 'required|max:255',
                'no_telp' => 'required|max:255',
                'role' => 'required|max:255',
                'foto' => 'image|file|max:1024',
            ]);

            if ($request->file('foto')) {
                File::delete(public_path('storage').'/'.$pegawai->foto);
                $validatedData['foto'] = $request->file('foto')->store('foto');
            }else {
                $validatedData['foto'] = $pegawai->foto;
            }
            
            User::where('id', $id)->update($validatedData);

            History::create([
                'user' => auth()->user()->name,
                'aktivitas' => 'Mengubah data pegawai '.$request['name'],
            ]);

            return redirect(route('admin.pegawai.index'))->with('success', 'Data pegawai berhasil diubah');
        }

        return view('admin.pegawai.edit', [
            'title' => 'Edit Data Pegawai',
            'active' => 'pegawai',
            'pegawai' => $pegawai,
        ]);
    }
    
    public function detail($id)
    {
        $pegawai = User::where('id', $id)->first();
        $pesertas = User::join('pendaftars', 'users.id', '=', 'pendaftars.id_user')
            ->join('pesertas', 'pendaftars.id', '=', 'pesertas.id_pendaftar')
            ->join('instansis', 'pesertas.id_instansi', '=', 'instansis.id')
            ->where('pesertas.id_user', $pegawai->id)
            ->get(array(
                '*',
                'pesertas.status AS status_peserta',
                'pesertas.id AS id_peserta',
            ));

        return view('admin.pegawai.detail', [
            'title' => 'Detail Data Pegawai',
            'active' => 'pegawai',
            'pegawai' => $pegawai,
            'pesertas' => $pesertas,
        ]);
    }

    public function hapus(Request $request)
    {
        User::where('id', $request['id'])->delete();
        History::create([
            'user' => auth()->user()->name,
            'aktivitas' => 'Menghapus data pegawai '.$request['name'],
        ]);

        return redirect(route('admin.pegawai.index'))->with('success', 'Data pegawai berhasil dihapus');
    }

    public function change_password(Request $request, $id)
    {
        if ($request->isMethod('POST')){
            $validatedData = $request->validate([
                'old_password' => 'required|min:5|max:255',
                'new_password' => 'required|min:5|max:255',
            ]);

            $user = User::where('id', $id)->first();

            if (Hash::check($validatedData['old_password'], $user->password)) {
                $new_password = Hash::make($validatedData['new_password']);
                User::where('id',$id)->update(['password' => $new_password]);
                
                History::create([
                    'user' => auth()->user()->name,
                    'aktivitas' => 'Mengubah password pegawai '.$user->name,
                ]);

                return redirect(route('admin.pegawai.index'))->with('success', 'Password berhasil diubah');
            } else {
                return redirect(route('admin.pegawai.change_password', $id))->with('error', 'Old Password tidak sesuai dengan password saat ini');
            }

        }
        
        return view('admin.pegawai.change_password', [
            'title' => 'Change Password',
            'active' => 'pegawai',
            'id' => $id,
        ]);
    }
}
