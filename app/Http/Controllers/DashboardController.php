<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        if (isset(auth()->user()->role)) {
            if (auth()->user()->role == "peserta") {
                return redirect(route('peserta.index'));
            } else {
                return redirect(route('admin.index'));
            }
        }
        
        return view('dashboard',[
            'title' => 'Dashboard'
        ]);
    }
}
