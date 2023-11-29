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

class OperatorController extends Controller
{
    public function index()
    {
        //status
        $useractivecount = MHS::query()
            ->where('status', '=', 'Aktif')
            ->count();
        $userMangkircount = MHS::query()
            ->where('status', '=', 'Mangkir')
            ->count();
        $userCuticount = MHS::query()
            ->where('status', '=', 'Cuti')
            ->count();
        $userDropoutcount = MHS::query()
            ->where('status', '=', 'DO')
            ->count();
        $userLuluscount = MHS::query()
            ->where('status', '=', 'Lulus')
            ->count();


        //level
        $mahasiswa = User::query()
            ->where('level', '=', 'mahasiswa')
            ->count();
        $dosen = User::query()
            ->where('level', '=', 'dosen')
            ->count();
        $department = User::query()
            ->where('level', '=', 'department')
            ->count();
        $operator = User::query()
            ->where('level', '=', 'operator')
            ->count();



        return view(
            'operator.dashboardoperator',
            compact(
                'useractivecount',
                'mahasiswa',
                'dosen',
                'department',
                'operator',
                'userMangkircount',
                'userCuticount',
                'userDropoutcount',
                'userLuluscount'
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
        return view('operator.dataMHSoperator', compact('mahasiswa'));
    }

    public function ubahstatus(Request $request)
    {
        $datamhs = MHS::find($request->nim);

        if (!$datamhs) {
            return redirect('/dashboardadmin/daftarmahasiswa')->with('error', 'Mahasiswa tidak ditemukan');
        }

        $datamhs->status = $request->status;
        $datamhs->save();

        return redirect('/dashboardadmin/daftarmahasiswa')->with('success', 'Status mahasiswa berhasil diubah');
    }

    // public function nonubahstatus(Request $request)
    // {
    //     $datamhs = MHS::find($request->nim);

    //     $datamhs->status = 'NON AKTIF'; // Mengubah status menjadi 'NON AKTIF'
    //     $datamhs->save(); // Simpan perubahan

    //     return redirect('/dashboardadmin/daftarmahasiswa')->with('success', 'Status mahasiswa berhasil di non aktifkan');
    // }
}