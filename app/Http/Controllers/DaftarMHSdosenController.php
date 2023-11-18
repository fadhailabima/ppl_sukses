<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MHS;
use App\Models\IRS;
use App\Models\PKL;
use App\Models\KHS;
use App\Models\Skripsi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DaftarMHSdosenController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $mahasiswa = DB::table('mahasiswas')
                ->where('dosen_wali', '=', auth()->user()->dosenWali->nip)
                ->where(function ($query) use ($request) {
                    $query->where('nama', 'LIKE', '%' . $request->search . '%')
                        ->orWhere('nim', 'LIKE', '%' . $request->search . '%');
                })
                ->paginate(10);
        } else {
            $mahasiswa = DB::table('mahasiswas')
                ->where('dosen_wali', '=', auth()->user()->dosenWali->nip)
                ->paginate(10);
        }
        return view('dosen.DataMhsdosen', compact('mahasiswa'));
    }

    public function detail(Request $request, $nim)
    {
        $mahasiswa = MHS::where('nim', $nim)
            ->where('dosen_wali', auth()->user()->dosenWali->nip)
            ->with('irs', 'khs', 'pkl', 'skripsi')
            ->first();

        if (!$mahasiswa) {
            return redirect()->back()->with('error', 'Mahasiswa tidak ditemukan atau tidak terkait dengan perwalian Anda.');
        }

        $semesterStatus = [];

        // Loop untuk setiap semester
        for ($i = 1; $i <= 14; $i++) {
            $semesterStatus[$i] = 'red'; // Set default status merah

            // IRS
            $irsStatus = $mahasiswa->irs ? $mahasiswa->irs->where('semester', $i)->first() : null;

            // KHS
            $khsStatus = $mahasiswa->khs->where('semester', $i)->first();

            // PKL
            $pklStatus = $mahasiswa->pkl ? $mahasiswa->pkl->where('semester', $i)->first() : null;
            ;

            // Skripsi
            $skripsiStatus = $mahasiswa->skripsi ? $mahasiswa->skripsi->where('semester', $i)->first() : null;

            if ($irsStatus && $irsStatus->isverified && $khsStatus && $khsStatus->isverified) {
                $semesterStatus[$i] = 'blue';
            } elseif ($irsStatus === null && $khsStatus === null) {
                $semesterStatus[$i] = 'red'; // Jika IRS **dan** KHS disetujui, maka warna biru
            } elseif ($irsStatus && $irsStatus->isverified && $khsStatus && $khsStatus->isverified && $pklStatus && $pklStatus->isverified) {
                $semesterStatus[$i] = 'yellow';
            } elseif ($irsStatus === null && $khsStatus === null && $pklStatus === null) {
                $semesterStatus[$i] = 'red'; // Jika PKL disetujui, maka warna kuning
            } elseif ($skripsiStatus && $skripsiStatus->isverified) {
                $semesterStatus[$i] = 'green'; // Jika Skripsi disetujui, maka warna hijau
            } elseif ($skripsiStatus === null) {
                $semesterStatus[$i] = 'red';
            }
        }

        return view('dosen.detailDataMHS', compact('mahasiswa', 'semesterStatus'));
    }


    public function detailAkademik(Request $request, $nim)
    {
        // $mahasiswa = MHS::with(['irs', 'k_h_s', 'p_k_l_s', 'skripsis'])
        //     ->where('dosen_wali', auth()->user()->dosenWali->nip)
        //     ->where('nim', $nim)
        //     ->first();

        // if (!$mahasiswa) {
        //     return redirect()->back()->with('error', 'Mahasiswa tidak ditemukan.');
        // }

        // $semesterStatus = [];

        // // Loop setiap semester yang diinginkan
        // for ($i = 1; $i <= 14; $i++) { // Misalnya dari semester 1 sampai 8
        //     $semesterStatus[$i] = 'red';
        // }

        // return view('dosen.detailAkademik');
    }
}
