<?php

namespace App\Http\Controllers;

use App\Models\PKL;
use App\Models\IRS;
use App\Models\KHS;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PKLMhsController extends Controller
{
    public function index()
    {
        return view('mahasiswa.IsiPklMhs', [
            'title' => 'Isi PKL Mahasiswa'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'semester' => 'required',
            'instansi' => 'required|string',
            'dosenpengampu' => 'required|string',
            'scanpkl' => 'required|file|mimes:pdf'
        ]);

        $mahasiswa_id = auth()->user()->mahasiswa->nim;
        $semester = $validatedData['semester'];

        $irsStatus = IRS::where('mahasiswa_id', $mahasiswa_id)
            ->where('semester', $semester)
            ->where('isverified', true)
            ->exists();

        $khsStatus = KHS::where('mahasiswa_id', $mahasiswa_id)
            ->where('semester', $semester)
            ->where('isverified', true)
            ->exists();

        // dd($irsStatus, $khsStatus);
        if ($irsStatus && $khsStatus) {
            $existingPKL = PKL::where('mahasiswa_id', $mahasiswa_id)->where('isverified', 0)->count();

            if ($existingPKL >= 1) {
                return redirect('/dashboardmahasiswa/IsiPKLMahasiswa')->with('gagal', 'Anda Sudah memasukan data PKL');
            } else {
                $scanpkl = $request->file('scanpkl');
                $scanpklFileName = $scanpkl->getClientOriginalName();

                $scanpkl->storeAs('public/post-scanpkl/', $scanpklFileName);

                $pklData = [
                    'mahasiswa_id' => $mahasiswa_id,
                    'semester' => $validatedData['semester'],
                    'instansi' => $validatedData['instansi'],
                    'dosenpengampu' => $validatedData['dosenpengampu'],
                    'scanpkl' => $scanpklFileName
                ];

                PKL::create($pklData);

                return redirect('/dashboardmahasiswa/IsiPKLMahasiswa')->with('success', 'Data berhasil di masukkan');
            }
        } elseif (!$irsStatus && !$khsStatus) {
            return redirect('/dashboardmahasiswa/IsiPKLMahasiswa')->with('gagal', 'IRS dan KHS belum diisi untuk semester yang dipilih');
        } elseif (!$irsStatus) {
            return redirect('/dashboardmahasiswa/IsiPKLMahasiswa')->with('gagal', 'IRS belum diisi untuk semester yang dipilih');
        } elseif (!$khsStatus) {
            return redirect('/dashboardmahasiswa/IsiPKLMahasiswa')->with('gagal', 'KHS belum diisi untuk semester yang dipilih');
        } else {
            return redirect('/dashboardmahasiswa/IsiPKLMahasiswa')->with('gagal', 'IRS atau KHS belum disetujui untuk semester yang dipilih');
        }
    }
}