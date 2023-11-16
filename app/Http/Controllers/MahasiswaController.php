<?php

namespace App\Http\Controllers;

use App\Models\IRS;
use App\Models\KHS;
use App\Models\PKL;
use App\Models\Skripsi;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index()
    {
        $irs = IRS::where('mahasiswa_id', auth()->user()->mahasiswa->nim)
            ->orderBy('semester', 'desc')
            ->first();
        $k_h_s = KHS::where('mahasiswa_id', auth()->user()->mahasiswa->nim)
            ->orderBy('semester', 'desc')
            ->first();
        $p_k_l_s = PKL::query()
            ->where('mahasiswa_id', '=', auth()->user()->mahasiswa->nim)
            ->get();
        $skripsis = Skripsi::query()
            ->where('mahasiswa_id', '=', auth()->user()->mahasiswa->nim)
            ->get();
        ;

        return view('mahasiswa.dashboardMhs', compact('irs', 'k_h_s', 'p_k_l_s', 'skripsis'));
    }
}