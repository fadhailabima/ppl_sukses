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

class DepartmentsController extends Controller
{
    public function index()
    {
        // Menghitung jumlah mahasiswa
        $jmlmhs = MHS::count();

        // IRS
        $irsData = DB::table('irs')
            ->join('mahasiswas', 'irs.mahasiswa_id', '=', 'mahasiswas.nim')
            // ->where('dosen_wali', '=', auth()->user()->dosenWali->nip)
            ->select('mahasiswas.nim as mahasiswanim', 'irs.semester', 'irs.isverified')
            ->get();

        $irsCollection = collect($irsData);
        $uniqueUsersIRS = $irsCollection->groupBy('mahasiswanim');

        $irsCountNotVerified = $uniqueUsersIRS->flatMap(function ($group) {
            return $group->where('isverified', 0)->pluck('mahasiswanim')->unique();
        })->count();

        $irsCountVerified = $uniqueUsersIRS->flatMap(function ($group) {
            return $group->where('isverified', 1)->pluck('mahasiswanim')->unique();
        })->count();
        $irsbelum = max(0, $jmlmhs - $irsCountNotVerified - $irsCountVerified);

        // KHS
        $khsData = DB::table('k_h_s')
            ->join('mahasiswas', 'k_h_s.mahasiswa_id', '=', 'mahasiswas.nim')
            // ->where('dosen_wali', '=', auth()->user()->dosenWali->nip)
            ->select('mahasiswas.nim as mahasiswanim', 'k_h_s.semester', 'k_h_s.isverified')
            ->get();

        $khsCollection = collect($khsData);
        $uniqueUsersKHS = $khsCollection->groupBy('mahasiswanim');

        $khsCountNotVerified = $uniqueUsersKHS->flatMap(function ($group) {
            return $group->where('isverified', 0)->pluck('mahasiswanim')->unique();
        })->count();

        $khsCountVerified = $uniqueUsersKHS->flatMap(function ($group) {
            return $group->where('isverified', 1)->pluck('mahasiswanim')->unique();
        })->count();
        $khsbelum = max(0, $jmlmhs - $khsCountNotVerified - $khsCountVerified);

        // PKL
        $pklCountNotVerified = DB::table('p_k_l_s')
            ->join('mahasiswas', 'p_k_l_s.mahasiswa_id', '=', 'mahasiswas.nim')
            // ->where('dosen_wali', '=', auth()->user()->dosenWali->nip)
            ->where('isverified', '=', '0')
            ->count();
        $pklCountVerified = DB::table('p_k_l_s')
            ->join('mahasiswas', 'p_k_l_s.mahasiswa_id', '=', 'mahasiswas.nim')
            // ->where('dosen_wali', '=', auth()->user()->dosenWali->nip)
            ->where('isverified', '=', '1')
            ->count();

        // $pklCountNotVerified = $pklData->where('isverified', 0)->count();
        // $pklCountVerified = $pklData->where('isverified', 1)->count();
        $pklbelum = $jmlmhs - $pklCountNotVerified - $pklCountVerified;

        // Skripsi
        $skripsicountnotverified = DB::table('skripsis')
            ->join('mahasiswas', 'skripsis.mahasiswa_id', '=', 'mahasiswas.nim')
            // ->where('dosen_wali', '=', auth()->user()->dosenWali->nip)
            ->where('isverified', '=', '0')
            ->count();
        $skripsicountverified = DB::table('skripsis')
            ->join('mahasiswas', 'skripsis.mahasiswa_id', '=', 'mahasiswas.nim')
            // ->where('dosen_wali', '=', auth()->user()->dosenWali->nip)
            ->where('isverified', '=', '1')
            ->count();
        $skripsibelum = $jmlmhs - $skripsicountnotverified - $skripsicountverified;


        return view(
            'department.dashboardDepartment',
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

    public function dataMHS(Request $request)
    {
        if ($request->has('search')) {
            $mahasiswa = DB::table('mahasiswas')
                // ->where('dosen_wali', '=', auth()->user()->dosenWali->nip)
                ->where(function ($query) use ($request) {
                    $query->where('nama', 'LIKE', '%' . $request->search . '%')
                        ->orWhere('nim', 'LIKE', '%' . $request->search . '%');
                })
                ->paginate(10);
        } else {
            $mahasiswa = DB::table('mahasiswas')
                // ->where('dosen_wali', '=', auth()->user()->dosenWali->nip)
                ->paginate(10);
        }
        return view('department.DataMhsdepartment', compact('mahasiswa'));
    }

    public function detailMHS(Request $request, $nim)
    {
        $mahasiswa = MHS::where('nim', $nim)
            // ->where('dosen_wali', auth()->user()->dosenWali->nip)
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


        return view('department.detailMHS', compact('mahasiswa', 'semesterStatus'));
    }
}
