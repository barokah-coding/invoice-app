<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function postLogin(Request $request){
        $validasi = $request->only('username', 'password');

        if (Auth::attempt($validasi)) {
            return redirect()->route('dashboard')->with('status', 'Login Berhasil');
        }
        return back()->with('status', 'Login Gagal');
    }

    public function logout(){
        auth()->logout();
        return redirect()->route('login');
    }
}
