<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\MHS;
use App\Models\DosenWali;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('login', [
            'title' => 'login'
        ]);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if (auth()->user()->level == "mahasiswa") {
                $mahasiswa = auth()->user()->mahasiswa; // Mengambil data mahasiswa yang terkait dengan pengguna

                if (empty($mahasiswa->foto_mahasiswa)) {
                    return redirect('/lengkapidata')->with('datablmLengkap','Lengkapi Data Terlebih Dahulu');
                } else {
                    return redirect()->intended('/dashboardmahasiswa');
                }
            } else if (auth()->user()->level == "operator") {
                return redirect()->intended('/dashboardadmin');
            } else if (auth()->user()->level == "dosen") {
                return redirect()->intended('/dashboarddosen');
            } else if (auth()->user()->level == "department") {
                return redirect()->intended('/dashboarddepartment');
            }
        }

        return back()->with('logingagal', 'Login gagal!');
        // return $credentials;
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}