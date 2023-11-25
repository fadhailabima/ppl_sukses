<?php

namespace App\Http\Controllers;

use App\Models\IRS;
use App\Models\KHS;
use App\Models\PKL;
use App\Models\Skripsi;
use App\Models\MHS;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index()
    {
        $nim = auth()->user()->mahasiswa->nim;

        $irs = IRS::where('mahasiswa_id', $nim)
            ->orderBy('semester', 'desc')
            ->first();

        $k_h_s = KHS::where('mahasiswa_id', $nim)
            ->orderBy('semester', 'desc')
            ->first();

        $p_k_l_s = PKL::query()
            ->where('mahasiswa_id', $nim)
            ->get();

        $skripsis = Skripsi::query()
            ->where('mahasiswa_id', $nim)
            ->get();

        $mahasiswa = MHS::where('nim', $nim)
            ->with('irs', 'khs', 'pkl', 'skripsi')
            ->first();

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

            // Skripsi
            $skripsiStatus = $mahasiswa->skripsi ? $mahasiswa->skripsi->where('semester', $i)->first() : null;

            if ($irsStatus && $irsStatus->isverified && $khsStatus && $khsStatus->isverified && $pklStatus && $pklStatus->isverified) {
                $semesterStatus[$i] = 'yellow';
            } elseif ($irsStatus === null && $khsStatus === null && $pklStatus === null) {
                $semesterStatus[$i] = 'red'; // Jika IRS *dan* KHS disetujui, maka warna biru
            } elseif ($irsStatus && $irsStatus->isverified && $khsStatus && $khsStatus->isverified && $skripsiStatus && $skripsiStatus->isverified) {
                $semesterStatus[$i] = 'green'; // Jika Skripsi disetujui, maka warna hijau
            } elseif ($irsStatus === null && $khsStatus === null && $skripsiStatus === null) {
                $semesterStatus[$i] = 'red';
            } elseif ($irsStatus && $irsStatus->isverified && $khsStatus && $khsStatus->isverified) {
                $semesterStatus[$i] = 'blue';
            } elseif ($irsStatus === null && $khsStatus === null) {
                $semesterStatus[$i] = 'red'; // Jika PKL disetujui, maka warna kuning
            }
        }

        return view('mahasiswa.dashboardMhs', compact('irs', 'k_h_s', 'p_k_l_s', 'skripsis', 'mahasiswa', 'semesterStatus'));
    }

}