<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;


class LoginController extends Controller
{
    public function index()
    {
        return view('login.index', [
            'title' => 'Login',
            'active' => 'login',
        ]);
    }
    
    public function auth(Request $request)
    {
        app('App\Http\Controllers\DataPesertaController')->cek_status();

        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            $role = User::where('email',$credentials['email'])->value('role');
            if ($role == 'peserta') {
                return redirect()->intended(route('peserta.index'));
            } else {
                return redirect()->intended(route('admin.index'));                
            }
        }

        return back()->with('loginError', 'Login failed');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
