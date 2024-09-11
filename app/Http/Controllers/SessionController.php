<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    function index()
    {
    return view("sesi/index");
    }
    public function login(Request $request)
{
    // Validasi input
    $request->validate([
        'email' => 'required',
        'password' => 'required'
    ], [
        'email.required' => 'email wajib diisi', 
        'password.required' => 'password wajib diisi',
    ]);

    
    $infologin = [
        'email' => $request->email,
        'password' => $request->password,
    ];

   
    if (Auth::attempt($infologin)) {
        return redirect('Mahasiswa')->with('success', 'berhasil login');
    } else {
        // Kalau autentikasi gagal
        return 'gagal';
    }
}

function logout()
{
    Auth::logout();
    return redirect('Sesi')->with('success', 'anda berhasil logout');
}   
}

