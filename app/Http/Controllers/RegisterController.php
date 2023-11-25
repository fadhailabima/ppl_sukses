<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\MHS;
use App\Models\DosenWali;
use App\Imports\UserImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    public function index()
    {
        $data['dosens'] = DosenWali::select('nama', 'nip')->get();
        return view('operator.register', $data, [
            'title' => 'Daftar User Baru'
        ]);
    }
    public function store(Request $request)
    {
        $validatedata = $request->validate([
            'nama' => 'required|max:255',
            'nim' => 'required|unique:mahasiswas,nim',
            'angkatan' => 'required',
            'level' => 'required',
            'status' => 'required',
            'dosen_wali_nama' => [
                'required',
                Rule::exists('dosenwalis', 'nama') // Validasi keberadaan nama dosen wali di tabel DosenWali
            ],
            'password' => 'required|min:5|max:255'
        ]);
        $user = new User();
        $user->username = $validatedata['nim']; // Menggunakan NIM sebagai username
        $user->password = Hash::make($validatedata['password']); // Enkripsi password
        $user->level = $validatedata['level'];

        // Temukan dosen wali berdasarkan nama yang dipilih
        $dosenWali = DosenWali::where('nama', $validatedata['dosen_wali_nama'])->first();
        // Simpan akun baru
        $user->save();

        // Buat data mahasiswa
        $mahasiswa = new MHS();
        $mahasiswa->nim = $validatedata['nim'];
        $mahasiswa->nama = $validatedata['nama'];
        $mahasiswa->angkatan = $validatedata['angkatan'];
        $mahasiswa->status = $validatedata['status'];
        $mahasiswa->dosen_wali = $dosenWali->nip;
        $mahasiswa->user_id = $user->id; // Hubungkan dengan id user yang baru dibuat
        $mahasiswa->save();
        // Tambahkan field lainnya sesuai kebutuhan


        return redirect('/dashboardadmin/register')->with('success', 'Registrasi Berhasil');
    }

    public function import(Request $request)
    {
        Excel::import(new UserImport(), $request->file('input_excel'));

        return redirect()->route('register.user')->with('success', 'Akun Mahasiswa Berhasil Ditambahkan.');
    }
}