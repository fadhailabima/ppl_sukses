<?php

namespace App\Http\Controllers;

use App\Models\Skripsi;
use App\Models\IRS;
use App\Models\KHS;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class SkripsiMhsController extends Controller
{
    public function index()
    {
        return view('mahasiswa.IsiSkripsiMhs');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'semester' => 'required',
            'tglsidang' => 'required|date',
            'dosenpembimbing' => 'required|string',
            'scansidang' => 'required|file|mimes:pdf'
        ]);

        $mahasiswa_id = auth()->user()->mahasiswa->nim;

        $irsStatus = IRS::where('mahasiswa_id', $mahasiswa_id)
            ->where('semester', $validatedData['semester'])
            ->where('isverified', true)
            ->exists();

        $khsStatus = KHS::where('mahasiswa_id', $mahasiswa_id)
            ->where('semester', $validatedData['semester'])
            ->where('isverified', true)
            ->exists();

        if (!$irsStatus || !$khsStatus) {
            if (!$irsStatus && !$khsStatus) {
                return redirect('/dashboardmahasiswa/IsiSkripsiMahasiswa')->with('gagal', 'IRS dan KHS belum diisi untuk semester yang dipilih');
            } elseif (!$irsStatus) {
                return redirect('/dashboardmahasiswa/IsiSkripsiMahasiswa')->with('gagal', 'IRS belum diisi untuk semester yang dipilih');
            } elseif (!$khsStatus) {
                return redirect('/dashboardmahasiswa/IsiSkripsiMahasiswa')->with('gagal', 'KHS belum diisi untuk semester yang dipilih');
            }
        } else {
            $existingSkripsi = Skripsi::where('mahasiswa_id', $mahasiswa_id)->where('isverified', 0)->count();

            if ($existingSkripsi >= 1) {
                return redirect('/dashboardmahasiswa/IsiSkripsiMahasiswa')->with('gagal', 'Anda Sudah memasukan data Skripsi');
            } else {
                $scansidang = $request->file('scansidang');
                $scansidangFileName = $scansidang->getClientOriginalName();

                $scansidang->storeAs('public/post-scansidang/', $scansidangFileName);

                $skripsiData = [
                    'mahasiswa_id' => $mahasiswa_id,
                    'semester' => $validatedData['semester'],
                    'tglsidang' => $validatedData['tglsidang'],
                    'dosenpembimbing' => $validatedData['dosenpembimbing'],
                    'scansidang' => $scansidangFileName
                ];

                Skripsi::create($skripsiData);

                return redirect('/dashboardmahasiswa/IsiSkripsiMahasiswa')->with('success', 'Data berhasil di masukkan');
            }
        }
    }
}