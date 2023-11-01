<?php

namespace App\Http\Controllers;

use App\Models\User;
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
            'email' => 'required|email:dns',
            'password' => 'required'
        ]);

        // $credentials = [
        //     'email' => $request->input('email'),
        //     'password' => $request->input('password'),
        // ];
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if (auth()->user()->level == "user") {
                return redirect()->intended('/dashboardmahasiswa');
            } else if (auth()->user()->level == "admin") {
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