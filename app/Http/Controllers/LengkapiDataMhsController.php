<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\MHS;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LengkapiDataMhsController extends Controller
{
    //


    public function index()
    {
        // $mahasiswa = MHS::where('nim', $nim)->firstOrFail();
        // $mahasiswa = MHS::find($nim);
        $user_id = Auth::id();
        $mahasiswa = MHS::where('user_id', $user_id)->firstOrFail();

        return view('LengkapiData', compact('mahasiswa'));
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'nullable|max:255',
            'alamat' => 'required|string',
            'kab_kota' => 'required|string',
            'propinsi' => 'required|string',
            'email' => 'required|max:255',
            'jalur_masuk' => 'required|in:SNMPTN,SBMPTN,MANDIRI',
            'handphone' => 'required|string|regex:/^[0-9]+$/|between:10,12',
            'new_password' => 'required|min:5|max:255',
            'foto_mahasiswa' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user_id = Auth::id(); // Mendapatkan ID pengguna yang sedang login
        $mahasiswa = MHS::where('user_id', $user_id)->firstOrFail();

        $mahasiswa->nama = $validatedData['nama'];
        $mahasiswa->alamat = $validatedData['alamat'];
        $mahasiswa->kab_kota = $validatedData['kab_kota'];
        $mahasiswa->propinsi = $validatedData['propinsi'];
        $mahasiswa->email = $validatedData['email'];
        if (array_key_exists('jalur_masuk', $validatedData)) {
            $mahasiswa->jalur_masuk = $validatedData['jalur_masuk'];
        }
        $mahasiswa->handphone = $validatedData['handphone'];

        if ($request->hasFile('foto_mahasiswa')) {
            $file = $request->file('foto_mahasiswa');
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/photo/', $fileName);
            $mahasiswa->foto_mahasiswa = $fileName;
        }
        if ($validatedData['new_password']) {
            $user = User::find($user_id);
            $user->password = Hash::make($validatedData['new_password']);
            $user->save();
        }

        $mahasiswa->save();

        return redirect('/dashboardmahasiswa')->with('success', 'Data berhasil diperbarui');
    }

}