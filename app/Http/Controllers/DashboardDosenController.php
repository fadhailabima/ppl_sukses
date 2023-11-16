<?php

namespace App\Http\Controllers;

use App\Models\IRS;
use App\Models\KHS;
use App\Models\PKL;
use App\Models\Skripsi;
use App\Models\User;
use App\Models\MHS;
use App\Models\DosenWali;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DashboardDosenController extends Controller
{
    public function index()
    {
        // Menghitung jumlah mahasiswa berdasarkan perwalian dari dosen
        $jmlmhs = MHS::query()
            ->where('dosen_wali', '=', auth()->user()->dosenWali->nip)
            ->count();

        // IRS
        $irsData = DB::table('irs')
            ->join('mahasiswas', 'irs.mahasiswa_id', '=', 'mahasiswas.nim')
            ->where('dosen_wali', '=', auth()->user()->dosenWali->nip)
            ->select('mahasiswas.nim as mahasiswanim', 'irs.semester', 'irs.isverified')
            ->get();

        $irsCollection = collect($irsData);
        $uniqueUsersIRS = $irsCollection->groupBy('mahasiswaid');

        $irsCountNotVerified = $uniqueUsersIRS->flatMap(function ($group) {
            return $group->where('isverified', 0)->pluck('mahasiswaid')->unique();
        })->count();

        $irsCountVerified = $uniqueUsersIRS->flatMap(function ($group) {
            return $group->where('isverified', 1)->pluck('mahasiswaid')->unique();
        })->count();
        $irsbelum = max(0, $jmlmhs - $irsCountNotVerified - $irsCountVerified);

        // KHS
        $khsData = DB::table('k_h_s')
            ->join('mahasiswas', 'k_h_s.mahasiswa_id', '=', 'mahasiswas.nim')
            ->where('dosen_wali', '=', auth()->user()->dosenWali->nip)
            ->select('mahasiswas.nim as mahasiswanim', 'k_h_s.semester', 'k_h_s.isverified')
            ->get();

        $khsCollection = collect($khsData);
        $uniqueUsersKHS = $khsCollection->groupBy('mahasiswaid');

        $khsCountNotVerified = $uniqueUsersKHS->flatMap(function ($group) {
            return $group->where('isverified', 0)->pluck('mahasiswaid')->unique();
        })->count();

        $khsCountVerified = $uniqueUsersKHS->flatMap(function ($group) {
            return $group->where('isverified', 1)->pluck('mahasiswaid')->unique();
        })->count();
        $khsbelum = max(0, $jmlmhs - $khsCountNotVerified - $khsCountVerified);

        // PKL
        $pklCountNotVerified = DB::table('p_k_l_s')
            ->join('mahasiswas', 'p_k_l_s.mahasiswa_id', '=', 'mahasiswas.nim')
            ->where('dosen_wali', '=', auth()->user()->dosenWali->nip)
            ->where('isverified', '=', '0')
            ->count();
        $pklCountVerified = DB::table('p_k_l_s')
            ->join('mahasiswas', 'p_k_l_s.mahasiswa_id', '=', 'mahasiswas.nim')
            ->where('dosen_wali', '=', auth()->user()->dosenWali->nip)
            ->where('isverified', '=', '1')
            ->count();

        // $pklCountNotVerified = $pklData->where('isverified', 0)->count();
        // $pklCountVerified = $pklData->where('isverified', 1)->count();
        $pklbelum = $jmlmhs - $pklCountNotVerified - $pklCountVerified;

        // Skripsi
        $skripsicountnotverified = DB::table('skripsis')
            ->join('mahasiswas', 'skripsis.mahasiswa_id', '=', 'mahasiswas.nim')
            ->where('dosen_wali', '=', auth()->user()->dosenWali->nip)
            ->where('isverified', '=', '0')
            ->count();
        $skripsicountverified = DB::table('skripsis')
            ->join('mahasiswas', 'skripsis.mahasiswa_id', '=', 'mahasiswas.nim')
            ->where('dosen_wali', '=', auth()->user()->dosenWali->nip)
            ->where('isverified', '=', '1')
            ->count();
        $skripsibelum = $jmlmhs - $skripsicountnotverified - $skripsicountverified;


        return view(
            'dosen.dashboardDosen',
            compact(
                'jmlmhs',
                'irsCountNotVerified',
                'irsCountVerified',
                'irsbelum',
                'khsCountNotVerified',
                'khsCountVerified',
                'khsbelum',
                'pklCountNotVerified',
                'pklCountVerified',
                'pklbelum',
                'skripsicountnotverified',
                'skripsicountverified',
                'skripsibelum'
            )
        );
    }
}